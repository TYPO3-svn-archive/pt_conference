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
 * Badges Model
 *
 * @package Domain
 * @subpackage Model
 * @author Daniel Lienert <lienert@punkt.de>
 */
class  Tx_PtConference_Domain_Model_Badges  {
	
	
	/**
	 * Mark all by list badgePrintingList selected tickets as printed
	 */
	public function markListedBadgesAsPrinted() {
		
		$persDataRepository = t3lib_div::makeInstance('Tx_PtConference_Domain_Repository_persdataRepository');
		$persDataCollection = $persDataRepository->findAllByTicketCodes($this->getListedBadgeTicketCodes());

		foreach($persDataCollection as $persDataObject) {
			$persDataObject->setBadgeprinted(time());
			
			$persDataHash = $persDataObject->generateHash();
			$persDataObject->setPrintedhash($persDataHash);
			$persDataObject->setCurrenthash($persDataHash);
		}
		
		$persistenceManager = Tx_Extbase_Dispatcher::getPersistenceManager();
		$persistenceManager->persistAll();
	}
	
	
	/**
	 * Get currently selected ListIds
	 * 
	 * @return array
	 */
	protected function getListedBadgeTicketCodes() {
		$extListDataBackend = Tx_PtExtlist_Utility_ExternalPlugin::getDataBackend('badgePrintingList');
		$listData = $extListDataBackend->getListData();
		
		$ticketCodes = array();
		
		foreach($listData as $row) {
			$ticketCodes[] = $row['articlecode']->getValue();
		}
		
		return $ticketCodes;
	}
}
?>