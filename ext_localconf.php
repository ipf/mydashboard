<?php
defined('TYPO3_MODE') or die();

// Load the Widgets from "myDashboard"
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/mydashboard/class.tx_mydashboard_widgetmgm.php']['addWidget']['serverinfo'] = 'EXT:mydashboard/widgets/class.tx_mydashboard_serverinfo.php:tx_mydashboard_serverinfo';
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/mydashboard/class.tx_mydashboard_widgetmgm.php']['addWidget']['userstats'] = 'EXT:mydashboard/widgets/class.tx_mydashboard_userstats.php:tx_mydashboard_userstats';
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/mydashboard/class.tx_mydashboard_widgetmgm.php']['addWidget']['rssfeed'] = 'EXT:mydashboard/widgets/class.tx_mydashboard_rssfeed.php:tx_mydashboard_rssfeed';
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/mydashboard/class.tx_mydashboard_widgetmgm.php']['addWidget']['sysnotepad'] = 'EXT:mydashboard/widgets/class.tx_mydashboard_sysnotepad.php:tx_mydashboard_sysnotepad';

// Move to tt_news
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/mydashboard/class.tx_mydashboard_widgetmgm.php']['addWidget']['latestnews'] = 'EXT:mydashboard/widgets/class.tx_mydashboard_latestnews.php:tx_mydashboard_latestnews';
