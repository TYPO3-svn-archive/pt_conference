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
 * Receive goodies counter
 *
 * @package pt_conference
 * @subpackage Domain/Model/Counter/
 * @author Daniel Lienert <lienert@punkt.de>
 */
class Tx_PtConference_Domain_Model_Counter_ReceiveGoodiesCounter extends Tx_PtConference_Domain_Model_Counter_AbstractCounter {
	
	/**
	 * (non-PHPdoc)
	 * @see Classes/Domain/Model/Counter/Tx_PtConference_Domain_Model_Counter_AbstractCounter::setRestrictedTicketCodes()
	 * 
	 * TODO: Add criteria for current event!!!
	 */
	protected function setRestrictedTicketCodes() {
		$ticketObjects = $this->persDataRepository->findAllByGoodiesReceived(1);
		$restrictedTicketCodes = array();
		
		foreach ($ticketObjects as $ticketObject) {
			$restrictedTicketCodes[] = $ticketObject->getArticlecode();
		}
		
		$this->ticketScanner->setRestrictedTicketCodes($restrictedTicketCodes);
	}
	
	
	/**
	 * Get the scanned tickets from scannerCache 
	 * and set the property goodiesReceived of the scanned tickets
	 */
	public function submitScannerList() {
		$ticketCodes = $this->ticketScanner->getTicketCodes();
		$persDataObjects = $this->getTicketObjectsForTicketCodes($ticketCodes);
		
		if(count($persDataObjects) == 0) {
			throw Exception('errNoTicketsToSubmit');
		}
		
		$this->markTicketObjectsAsGoodiesReceived($persDataObjects);
		$persistenceManager = Tx_Extbase_Dispatcher::getPersistenceManager();
		$persistenceManager->persistAll();
		
		$this->ticketScanner->reset();
	}
	
	
	protected function getTicketObjectsForTicketCodes($ticketCodes) {
		return $this->persDataRepository->findAllByTicketCodes($ticketCodes);
	}
	
	
	protected function markTicketObjectsAsGoodiesReceived(array $persDataObjects) {
		foreach($persDataObjects as $persDataObject) {
			$persDataObject->setGoodiesReceived(1);
			$this->persDataRepository->update($persDataObject);
		}
	}
	
}
?>