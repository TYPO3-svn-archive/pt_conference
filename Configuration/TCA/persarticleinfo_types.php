<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_ptconference_domain_model_persarticleinfo_types'] = array(
	'ctrl' => $TCA['tx_ptconference_domain_model_persarticleinfo_types']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'title,description,inputtype,inputdefault,gsa_shop_articles'
	),
	'types' => array(
		'1' => array('showitem' => 'title,description,inputtype,inputdefault,gsa_shop_articles')
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
				'foreign_table' => 'tx_ptconference_domain_model_persarticleinfo_types',
				'foreign_table_where' => 'AND tx_ptconference_domain_model_persarticleinfo_types.uid=###REC_FIELD_l18n_parent### AND tx_ptconference_domain_model_persarticleinfo_types.sys_language_uid IN (-1,0)',
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
		'title' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persarticleinfo_types.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'description' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persarticleinfo_types.description',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'inputtype' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persarticleinfo_types.inputtype',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'inputdefault' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persarticleinfo_types.inputdefault',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'gsa_shop_articles' => array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:pt_gsaconfmgm/locallang_db.xml:tx_ptgsaconfmgm_persarticleinfo_types.gsa_shop_articles',        
            'config' => array (
                'type' => 'select',    
                'foreign_table' => 'tx_ptgsashop_cache_articles',    
                'foreign_table_where' => 'ORDER BY tx_ptgsashop_cache_articles.uid',    
                'size' => 5,    
                'minitems' => 0,
                'maxitems' => 100,
            )
        ),
	),
);
?>