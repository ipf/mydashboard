<?php

$l10n = 'LLL:EXT:mydashboard/Resources/Private/Language/locallang_db.xml';

return array(
    'ctrl' => array(
        'title' => $l10n . ':tx_mydashboard_widget',
        'label' => 'be_user',
        'label_alt' => 'class_name,x,y',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
#        'versioningWS' => true,
#        'origUid' => 't3_origuid',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'rootLevel' => true,
        'dividers2tabs' => true,
        'enablecolumns' => array(
#            'disabled' => 'hidden',
        ),
        'iconfile' => 'EXT:mydashboard/Resources/Public/Icons/mydashboard.svg',
    ),
    'interface' => array(
        'showRecordFieldList' => 'class_name,x,y,configuration'
    ),
    'columns' => array(
        'class_name' => array(
            'exclude' => 1,
            'label' => $l10n . ':tx_mydashboard_widget.class_name',
            'config' => array(
                'type' => 'input',
                'size' => '25',
                'max' => '256',
                'eval' => 'required',
                'readOnly' => true
            )
        ),
        'x' => array(
            'exclude' => 1,
            'label' => $l10n . ':tx_mydashboard_widget.x',
            'config' => array(
                'type' => 'input',
                'size' => '25',
                'max' => '256',
                'eval' => 'nospace,alphanum_x,lower',
                'readOnly' => true
            )
        ),
        'y' => array(
            'exclude' => 1,
            'label' => $l10n . ':tx_mydashboard_widget.y',
            'config' => array(
                'type' => 'input',
                'size' => '25',
                'max' => '256',
                'eval' => 'nospace,alphanum_x,lower',
                'readOnly' => true
            )
        ),
        'configuration' => array(
            'exclude' => 1,
            'label' => $l10n . ':tx_mydashboard_widget.configuration',
            'config' => array(
                'type' => 'text',
                'rows' => '5',
                'readOnly' => true
            )
        ),
    ),
    'palettes' => array(

    ),
    'types' => array(
        '1' => array(
            'showitem' => 'class_name,x,y,configuration'
        )
    )
);
