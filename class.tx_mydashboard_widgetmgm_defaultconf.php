<?php
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

class tx_mydashboard_widgetmgm_defaultconf
{
    /*
     * Return the default conf for this extension
     */
    public function getConf()
    {
        return array(
            'config' => array(
                'theme' => 'default',
                'rows' => 3,
            ),
            'items' => array(
                'userstatsstartme1' => array(
                    'widgetkey' => 'userstats',
                    'config' => array(
                        'item_output' => 10,
                    ),
                ),
                'rssfeedstartme2' => array(
                    'widgetkey' => 'rssfeed',
                    'config' => array(
                        'item_limit' => 8,
                        'feed_title' => 'typo3blogger.de',
                        'feed_url' => 'http://typo3blogger.de/feed/',
                    ),
                ),
                'rssfeedstartme3' => array(
                    'widgetkey' => 'rssfeed',
                    'config' => array(
                        'item_limit' => 8,
                        'feed_title' => 'typo3.org',
                        'feed_url' => 'http://news.typo3.org/rss.xml',
                    ),
                ),
            ),
            'position' => array(
                0 => array(
                    'rssfeedstartme2',
                    'rssfeedstartme3',
                ),
                1 => array(
                    'userstatsstartme1',
                ),
            ),
        );
    } # function - getConf	
} # class - tx_mydashboard_widgetmgm_defaultconf
