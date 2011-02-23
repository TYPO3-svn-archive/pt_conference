<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_ptconference_domain_model_relarticle'] = array(
	'ctrl' => $TCA['tx_ptconference_domain_model_relarticle']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'tx_ptgsashop_orders_articles_uid,tx_ptgsashop_customer_uid,articlecode,persdata'
	),
	'types' => array(
		'1' => array('showitem' => 'tx_ptgsashop_orders_articles_uid,tx_ptgsashop_customer_uid,articlecode,persdata')
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
				'foreign_table' => 'tx_ptconference_domain_model_relarticle',
				'foreign_table_where' => 'AND tx_ptconference_domain_model_relarticle.uid=###REC_FIELD_l18n_parent### AND tx_ptconference_domain_model_relarticle.sys_language_uid IN (-1,0)',
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
		'tx_ptgsashop_orders_articles_uid' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_relarticle.tx_ptgsashop_orders_articles_uid',
			'config'  => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'tx_ptgsashop_customer_uid' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_relarticle.tx_ptgsashop_customer_uid',
			'config'  => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'articlecode' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_relarticle.articlecode',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'persdata' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_relarticle.persdata',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_ptconference_domain_model_persdata',
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