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
 * Controller for goodies counter
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

class Tx_PtConference_Controller_ReceiveGoodiesController extends Tx_PtConference_Controller_ConferenceBaseController {
	
	/**
	 * @var Tx_PtConference_Domain_Repository_persdataRepository
	 */
	protected $persdataRepository;
	
	
	/**
	 * @var Tx_PtConference_Domain_Model_Counter_CheckInCounter
	 */
	protected $receiveGoodiesCounter;
	

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {	
		$this->persdataRepository = t3lib_div::makeInstance('Tx_PtConference_Domain_Repository_persdataRepository');
		
		$this->receiveGoodiesCounter = Tx_PtConference_Domain_Model_Counter_ReceiveGoodiesCounterFactory::createInstance();
	}

	
	/**
	 * show action
	 *
	 * @return string The rendered show action
	 */
	public function showAction() {
		
		$this->saveFlashmessages();
		
		
		$attendeeStatus = $this->createSubController('attendeeStatus');			
		$goodies = $this->createSubController('receiveGoodies');
		$shirts = $this->createSubController('receiveGoodiesShirts');
		$articles = $this->createSubController('receiveGoodiesArticles');			
			
		$this->view->assign('attendeeStatus',$attendeeStatus->listAction());
		$this->view->assign('receiveGoodiesList',$goodies->listAction());
		$this->view->assign('receiveShirtsList',$shirts->listAction());
		$this->view->assign('receiveArticlesList',$articles->listAction());
		
		
		
		$this->restoreFlashMessages();
		
		$this->view->assign('counter',$this->receiveGoodiesCounter);
	}
	
	/**
	 * submit action
	 * @param string $scanInput
	 */
	public function submitAction($scanInput) {

		try {
			$scannerCommand = $this->receiveGoodiesCounter->getScanner()->scan($scanInput);
			$this->receiveGoodiesCounter->getScanner()->persistToSession();
			
			if($scannerCommand !== true) {
				
				if($scannerCommand == 'submit') {
					$this->receiveGoodiesCounter->submitScannerList();
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
			$messageKey = 'tx_ptconference_domain_model_receivegoodies.' . $message;
			
			$this->flashMessageContainer->add($messageKey);
			$this->flashMessageContainer->persist();
		}
	}
}
?>