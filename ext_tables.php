<?php
defined('TYPO3_MODE') or die();

if (TYPO3_MODE === 'BE') {

    // Module Tools->Log
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Tx.Mydashboard',
        'user',
        'mydashboard',
        '',
        array(
            'Dashboard' => 'main, config, addWidget, saveConfiguration, setStartModule, ajax'
        ),
        array(
            'access' => 'user,group',
            'icon' => 'EXT:mydashboard/mod1/moduleicon.gif',
            'labels' => 'LLL:EXT:mydashboard/mod1/locallang_mod.xml',
        )
    );
}

$tempColumns = array(
    'tx_mydashboard_config' => array(
        'exclude' => 0,
        'label' => 'LLL:EXT:mydashboard/locallang_db.xml:be_users.tx_mydashboard_config',
        'config' => array('type' => 'none'),
    ),
    'tx_mydashboard_selfadmin' => array(
        'exclude' => 0,
        'label' => 'LLL:EXT:mydashboard/locallang_db.xml:be_users.tx_mydashboard_selfadmin',
        'config' => array('type' => 'check'),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('be_users', $tempColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('be_users', 'tx_mydashboard_order;;;;1-1-1, tx_mydashboard_selfadmin');
