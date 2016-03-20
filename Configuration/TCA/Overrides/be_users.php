<?php

$tempColumns = array(
    'tx_mydashboard_config' => array(
        'exclude' => 0,
        'label' => 'LLL:EXT:mydashboard/Resources/Private/Language/locallang_db.xml:be_users.tx_mydashboard_config',
        'config' => array(
            'type' => 'text',
            'readOnly' => true
        ),
    ),
    'tx_mydashboard_widgets' => array(
        'exclude' => 0,
        'label' => 'LLL:EXT:mydashboard/Resources/Private/Language/locallang_db.xml:be_users.tx_mydashboard_widgets',
        'config' => array(
            'type' => 'inline',
            'foreign_table' => 'tx_mydashboard_domain_model_widget',
            'foreign_field' => 'be_user'

        ),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('be_users', $tempColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('be_users', 'tx_mydashboard_config,tx_mydashboard_widgets');
