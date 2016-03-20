<?php
namespace Tx\Mydashboard\Controller;

/***************************************************************
*  Copyright notice
*
*  (c) 2008 Tim Lochmueller <webmaster@fruit-lab.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Module 'Dashboard' for the 'mydashboard' extension.
 */
class DashboardController extends ActionController
{

    private $jsLoaded = array();

    /**
     * @var \Tx\Mydashboard\Manager\Widgetmgm
     */
    protected $mgm;

    /*
     * @return	void
     */
    public function __construct()
    {
        $this->mgm = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Tx\Mydashboard\Manager\Widgetmgm::class);
    }

    /*
     * Render the AJAX Content for widgets
     */
    public function ajaxAction()
    {
        $user = $GLOBALS['BE_USER']->user['uid'];
        $this->mgm->loadUserConf($user);

        switch ($_REQUEST['action']) {
            case 'refresh':
                $widget = $this->mgm->getWidget($_REQUEST['key']);
                $this->content = $widget->getContent();
                break;

            case 'refresh_config':
                parse_str($_REQUEST['value'], $output);
                if ($this->mgm->setWidgetConf($_REQUEST['key'], $output)) {
                    $this->mgm->safeUserConf($user);
                }
                $widget = $this->mgm->getWidget($_REQUEST['key']);
                $this->content = $widget->getContent();
                break;

            case 'config':
                $widget = $this->mgm->getWidget($_REQUEST['key']);
                $this->content = $widget->getConfig();
                break;

            case 'delete':
                if ($this->mgm->removeWidget($_REQUEST['key'])) {
                    $this->mgm->safeUserConf($user);
                }
                $this->content = '';
                break;

            case 'reorder':
                parse_str($_REQUEST['data'], $output);
                if ($this->mgm->setNewOrder($output)) {
                    $this->mgm->safeUserConf($user);
                }
                break;

            default:
                $this->content = 'No Action';
                break;
        } # switch
    }

    /*
     * Render the Main Content
     */
    public function mainAction()
    {
#        global $LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;

        $user = $GLOBALS['BE_USER']->user['uid'];
        $this->mgm->loadUserConf($user);

        $config = $this->mgm->getUserConf('config');

        $this->view->assign('realName', $GLOBALS['BE_USER']->user['realName']);
        $this->view->assign('username', $GLOBALS['BE_USER']->user['username']);



        // Config an preload
        $this->mgm->loadUserConf($GLOBALS['BE_USER']->user['uid']);
        $userConf = $this->mgm->getUserConf();
        $content = array('', '', '', '');

        $this->view->assign('rows', intval($userConf['config']['rows']));
        $this->view->assign('userConf', $userConf);

        // Javascript
        $js = '';
        $container = array();
        $newOrder = array();
        for ($i = 0; $i < intval($userConf['config']['rows']); ++$i) {
            if (!is_array($userConf['position'][$i])) {
                continue;
            }

            $js .= 'Sortable.create("container'.$i.'",{tag: \'div\',dropOnEmpty:true,containment:[###CONTAINER###],constraint:false, onUpdate:sendNewOrder});'."\n";
            $container[] = '"container'.$i.'"';
            $newOrder[] = 'parms = Sortable.serialize("container'.$i.'", {name: \''.$i.'\'})+"&"+parms;';
        }

        $js = "<script type=\"text/javascript\">\n".str_replace('###CONTAINER###', implode(',', $container), $js)."
		
		function sendNewOrder(){
			var parms = '';
			".implode("\n", $newOrder)."
			new Ajax.Request('index.php', {
				parameters: { ajax: 1, action: 'reorder', data: parms },
			});
		}
		</script>";

        $this->view->assign('content', $content . $js);

    }

    /**
     * Add widget
     *
     * @param string $widgetKey
     */
    public function addWidgetAction($widgetKey) {
        if ($this->mgm->addWidget($widgetKey)) {
            $this->addFlashMessage(
                'The Widget with the Key "' . $widgetKey . '" is added to the Dashboard'
            );
            $this->mgm->safeUserConf($GLOBALS['BE_USER']);
        }
        $this->redirect('main');
    }

    /**
     * Set dashboard as hoe module
     */
    public function setStartModuleAction() {
        /** @TODO */
        // Set the Dashboard as Home
        if (isset($_REQUEST['dashHome'])) {
            $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'be_users', 'uid='.intval($user), '', '', 1);
            if (!$GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
                $content .= 'Error<hr />';
            } else {
                $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
                $uc = unserialize($row['uc']);
                if (is_array($uc)) {
                    $uc['startModule'] = 'user_txmydashboardM1';
                    $GLOBALS['BE_USER']->uc['startModule'] = 'user_txmydashboardM1';
                    $GLOBALS['TYPO3_DB']->exec_UPDATEquery('be_users', 'uid='.intval($user), array('uc' => serialize($uc)));
                    $content .= '<span class="notice">Notice:</span> The Dashboard is set as startpage (current user)!<hr />';
                } # if
            } # if
        } # if

        $this->redirect('config');
    }

    /**
     *
     */
    public function saveConfigurationAction() {
        /** @TODO */
        // Set the Dashboard as Home
        if (isset($_REQUEST['configForm'])) {

            // Set the new Value
            if (isset($_REQUEST['config_rows'])) {
                $config['rows'] = intval($_REQUEST['config_rows']);
            }
            if ($this->mgm->setUserConf('config', $config)) {
                $this->mgm->safeUserConf($user);
            }
            $content .= '<span class="notice">Notice:</span> Config update!<hr />';
        } # if

        $this->redirect('main');
    }

    /*
     * Render the Configuration module
     */
    public function configAction()
    {
        $this->mgm->loadUserConf($GLOBALS['BE_USER']->user['uid']);
        $this->view->assign('config', $this->mgm->getUserConf('config'));
        $this->view->assign('startModule', $GLOBALS['BE_USER']->uc['startModule']);
        $this->view->assign('widgets', $this->mgm->getAllWidgets());
    }

}
