<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Daniel Lienert <lienert@punkt.de>, Michael Knoll <knoll@punkt.de>
*  All rights reserved
*
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * @package pt_conference
 * @subpackage Utility  
 * @author  Daniel Lienert <lienert@punkt.de>
 */

class user_Tx_PtConference_Utility_UserFunctions {
	
	
	/**
	 * Get the PDF Download Link
	 * 
	 * @param array $params
	 * @return string pdfLink
	 */
	public static function getInvoicePDFLink(array $params) {
		require_once t3lib_extMgm::extPath('pt_gsapdfdocs') . 'res/class.tx_ptgsapdfdocs_div.php';
		
		$invoiceNo = $params['values']['invoiceNo'];
		return tx_ptgsapdfdocs_div::urlToInvoice($invoiceNo);
	}
	
	
	/**
	 * Render the Attendee Information to display in a single pt_list column
	 * 
	 * @param array $params
	 * @return string
	 */
	public static function renderAttendeeInformation(array $params) {
		$userInfoGrouped = $params['values']['userInfoGrouped'];
		$infoArray = explode(';', $userInfoGrouped);
		$infos = array();
		
		foreach($infoArray as $info) {
			$infoChunks = explode(',', $info);
			if(trim($infoChunks[1]) || trim($infoChunks[2])) {
				$infos[$infoChunks[0]] = trim($infoChunks[2]) ? trim($infoChunks[2]) : trim($infoChunks[1]);	
			}
		}
		
		// render with Fluid
		$renderer = t3lib_div::makeInstance('Tx_Fluid_View_TemplateView');
		$controllerContext = t3lib_div::makeInstance('Tx_Extbase_MVC_Controller_ControllerContext');
		$controllerContext->setRequest(t3lib_div::makeInstance('Tx_Extbase_MVC_Request'));
		$renderer->setControllerContext($controllerContext);
		
		$template = t3lib_extMgm::extPath(strtolower('pt_conference')) . 'Resources/Private/Templates/ExtList/Field/AttendeeInformation.html';
		$renderer->setTemplatePathAndFilename($template);
		$renderer->assign('infos', $infos);
		$rendered = $renderer->render();
		
		return $rendered;
	}
	
}

?>