<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Conference Managment (extBase)'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Conference Managment (extBase)');

//$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';

// ADD FLEXFORM
$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature]='layout,select_key,pages';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform.xml');


t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_persdata','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_persdata.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_persdata');
$TCA['tx_ptconference_domain_model_persdata'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persdata',
		'label' 			=> 'company',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/persdata.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_persdata.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_event','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_event.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_event');
$TCA['tx_ptconference_domain_model_event'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_event',
		'label' 			=> 'code',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/event.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_event.png'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_relarticle','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_relarticle.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_relarticle');
$TCA['tx_ptconference_domain_model_relarticle'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_relarticle',
		'label' 			=> 'tx_ptgsashop_orders_articles_uid',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/relarticle.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_relarticle.gif'
	)
);


t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_goodies','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_goodies.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_goodies');
$TCA['tx_ptconference_domain_model_goodies'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_goodies',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/goodies.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_goodies.png'
	)
);


t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_persarticleinfo_types','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_persarticleinfo_types.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_persarticleinfo_types');
$TCA['tx_ptconference_domain_model_persarticleinfo_types'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persarticleinfo_types',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/persarticleinfo_types.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_persarticleinfo_types.png'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_persarticleinfo_options','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_persarticleinfo_options.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_persarticleinfo_options');
$TCA['tx_ptconference_domain_model_persarticleinfo_options'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persarticleinfo_options',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/persarticleinfo_options.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_persarticleinfo_options.png'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_persarticleinfo_values','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_persarticleinfo_values.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_persarticleinfo_values');
$TCA['tx_ptconference_domain_model_persarticleinfo_values'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_persarticleinfo_values',
		'label' 			=> 'tx_ptgsaconfmgm_persdata_uid',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/persarticleinfo_values.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_persarticleinfo_values.png'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_paper','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_paper.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_paper');
$TCA['tx_ptconference_domain_model_paper'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_paper',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/paper.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_paper.gif'
	)
);


t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_char','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_char.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_char');
$TCA['tx_ptconference_domain_model_paper'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_char',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/char.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_char.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_targetos','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_targetos.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_targetos');
$TCA['tx_ptconference_domain_model_targetos'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_targetos',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/targetos.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_targetos.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_targetaudience','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_targetaudience.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_targetaudience');
$TCA['tx_ptconference_domain_model_targetaudience'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_targetaudience',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/targetaudience.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_targetaudience.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_bestpapervoting','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_bestpapervoting.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_bestpapervoting');
$TCA['tx_ptconference_domain_model_bestpapervoting'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_bestpapervoting',
		'label' 			=> 'rating',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/bestPaperVoting.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_bestpapervoting.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_ptconference_domain_model_bestcharvoting','EXT:pt_conference/Resources/Private/Language/locallang_csh_tx_ptconference_domain_model_bestcharvoting.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_ptconference_domain_model_bestcharvoting');
$TCA['tx_ptconference_domain_model_bestcharvoting'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:pt_conference/Resources/Private/Language/locallang_db.xml:tx_ptconference_domain_model_bestcharvoting',
		'label' 			=> 'rating',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/bestCharVoting.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_ptconference_domain_model_bestcharvoting.gif'
	)
);

?>