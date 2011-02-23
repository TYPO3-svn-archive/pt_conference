<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Christoph Ehscheidt <ehscheidt@punkt.de>, punkt.de
*  			
*  All rights reserved
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

abstract class Tx_PtConference_Controller_ConferenceBaseController extends Tx_Extbase_MVC_Controller_ActionController {
	
	
	/**
	 * Save the flashmessages before calling a subcontroller
	 *
	 * @var array
	 */
	protected $localFlashMessages;
	
	/**
	 * Creates a subcontroller
	 * 
	 * @param string $listIdentifier
	 * @return Tx_PtExtlist_Controller_SubcontrollerWrapper
	 */
	protected function createSubController($listIdentifier) {
		tx_pttools_assert::isNotEmptyString($listIdentifier, array(message=>'Can not create SubController with a empty listIdentifier. 1284548670'));
		
		$subcontrollerFactory = Tx_PtExtlist_Controller_SubcontrollerFactory::getInstanceByListIdentifier($listIdentifier);
		
		$settings = array(
	    	"settings" => array(
	            'listIdentifier' => $listIdentifier,
			),
		);
		
			
		return $subcontrollerFactory->createListController($settings);
	}
	
	protected function saveFlashmessages() {
		$this->localFlashMessages = $this->flashMessageContainer->getAllAndFlush();
		$this->flashMessageContainer->persist();	
	}
	
	protected function restoreFlashMessages() {
		
		$this->flashMessageContainer = new Tx_Extbase_MVC_Controller_FlashMessages();
		
		foreach($this->localFlashMessages as $flashMessage) {
			$this->flashMessageContainer->add($flashMessage);
		}
		
		$this->flashMessageContainer->persist();
		
	}
}
?>