<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_ptconference_domain_model_persdata'] = array(
	'ctrl' => $TCA['tx_ptconference_domain_model_persdata']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'company,title,firstname,lastname,email,jobstatus,country,tx_ptgsashop_orders_articles_uid,tx_ptgsashop_customer_uid,articlecode,checkedin,goodiesreceived,badgeprinted,event,printedhash,currenthash'
	),
	'types' => array(
		'1' => array('showitem' => 'company,title,firstname,lastname,email,jobstatus,country,tx_ptgsashop_orders_articles_uid,tx_ptgsashop_customer_uid,articlecode,checkedin,goodiesreceived,badgeprinted,event,printedhash,currenthash')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_ptconference_domain_model_persdata',
				'foreign_table_where' => 'AND tx_ptconference_domain_model_persdata.uid=###REC_FIELD_l18n_parent### AND tx_ptconference_domain_model_persdata.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'=>array(
				'type'=>'passthrough')
		),
		't3ver_label' => array(
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array(
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		'company' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.company',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'title' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'firstname' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.firstname',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'lastname' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.lastname',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'email' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.email',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'jobstatus' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.jobstatus',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'country' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.country',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'tx_ptgsashop_orders_articles_uid' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.tx_ptgsashop_orders_articles_uid',
			'config'  => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'tx_ptgsashop_customer_uid' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.tx_ptgsashop_customer_uid',
			'config'  => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'articlecode' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.articlecode',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'checkedin' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.checkedin',
			'config'  => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'goodiesreceived' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.goodiesreceived',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'badgeprinted' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.badgeprinted',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'currenthash' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.currenthash',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			)
		),
		'printedhash' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.printedhash',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			)
		),
		'event' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata.event',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_ptconference_domain_model_event',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
	),
);
?>