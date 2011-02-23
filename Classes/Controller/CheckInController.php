<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Daniel Lienert <lienert@punkt.de>, punkt.de
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

/**
 * Controller for checkin
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

class Tx_PtConference_Controller_CheckInController extends Tx_PtConference_Controller_ConferenceBaseController {
	
	/**
	 * @var Tx_PtConference_Domain_Repository_persdataRepository
	 */
	protected $persdataRepository;
	
	
	/**
	 * @var Tx_PtConference_Domain_Model_Counter_CheckInCounter
	 */
	protected $checkInCounter;
	

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {	
		$this->persdataRepository = t3lib_div::makeInstance('Tx_PtConference_Domain_Repository_persdataRepository');
		
		$this->checkInCounter = Tx_PtConference_Domain_Model_Counter_CheckInCounterFactory::createInstance();
	}

	
	/**
	 * show action
	 *
	 * @return string The rendered show action
	 */
	public function showAction() {
		
		$this->saveFlashmessages();
		
		
		$attendeeStatus = $this->createSubController('attendeeStatus');			
		$checkInList = $this->createSubController('checkInList');			
			
		$this->view->assign('attendeeStatus',$attendeeStatus->listAction());
		$this->view->assign('checkInList',$checkInList->listAction());
		
		
		$this->restoreFlashMessages();
		
		$this->view->assign('counter',$this->checkInCounter);
	}
	
	/**
	 * submit action
	 * @param string $scanInput
	 */
	public function submitAction($scanInput) {

		try {
			$scannerCommand = $this->checkInCounter->getScanner()->scan($scanInput);
			$this->checkInCounter->getScanner()->persistToSession();
			
			if($scannerCommand !== true) {
				
				if(strtolower($scannerCommand) == 'submit') {
					$this->checkInCounter->submitScannerList();
					$this->forward('show');
				}
				
			}
			
		} catch (Exception $e) {
			$this->addTranslatedFlashMessage($e->getMessage());
		}
	
		$this->forward('show');
	}
	
	
	protected function addTranslatedFlashMessage($message) {
		if(trim($message)) {
			$messageKey = 'tx_ptconference_domain_model_checkin.' . $message;
			
			$this->flashMessageContainer->add($messageKey);
			$this->flashMessageContainer->persist();
		}
	}
}
?>