<?php
defined('TYPO3_MODE') or die();

if (TYPO3_MODE === 'BE') {
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
            'icon' => 'EXT:mydashboard/Resources/Public/Icons/moduleicon.gif',
            'labels' => 'LLL:EXT:mydashboard/Resources/Private/Language/locallang_mod.xml',
        )
    );
}
