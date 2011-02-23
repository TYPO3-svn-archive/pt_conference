<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_ptconference_domain_model_paper'] = array(
	'ctrl' => $TCA['tx_ptconference_domain_model_paper']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'title,author,abstract,accepted_as_talk,accepted_as_tutorial,uploadpath,sendmail,targetos,targetaudience'
	),
	'types' => array(
		'1' => array('showitem' => 'title,author,abstract,accepted_as_talk,accepted_as_tutorial,uploadpath,sendmail,targetos,targetaudience')
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
				'foreign_table' => 'tx_ptconference_domain_model_paper',
				'foreign_table_where' => 'AND tx_ptconference_domain_model_paper.uid=###REC_FIELD_l18n_parent### AND tx_ptconference_domain_model_paper.sys_language_uid IN (-1,0)',
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
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_paper.title',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'author' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_paper.author',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'abstract' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_paper.abstract',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'accepted_as_talk' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_paper.accepted_as_talk',
			'config'  => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'accepted_as_tutorial' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_paper.accepted_as_tutorial',
			'config'  => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'uploadpath' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_paper.uploadpath',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'sendmail' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_paper.sendmail',
			'config'  => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'targetos' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_paper.targetos',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_ptconference_domain_model_targetos',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
		'targetaudience' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_paper.targetaudience',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_ptconference_domain_model_targetaudience',
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