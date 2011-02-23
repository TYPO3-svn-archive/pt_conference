<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'CheckIn' => 'show,submit',
		'ReceiveGoodies' => 'show, submit',
		'persdata' => 'index, show, new, create, edit, update, delete',
		'relarticle' => 'index, show, new, create, edit, update, delete',
		'paper' => 'index, show, new, create, edit, update, delete',
		'bestPaperVoting' => 'list, vote, stats',
		'BadgePrinting' => 'show, exportAll',
		'BestCharVoting' => 'list, vote, stats',
	),
	array(
		'CheckIn' => 'show,submit',
		'ReceiveGoodies' => 'show, submit',
		'persdata' => 'create, update, delete',
		'relarticle' => 'create, update, delete',
		'paper' => 'create, update, delete',
		'bestPaperVoting' => 'list, vote, stats',
		'BadgePrinting' => 'exportAll',
		'BestCharVoting' => 'list, vote, stats',
	)
);

?>