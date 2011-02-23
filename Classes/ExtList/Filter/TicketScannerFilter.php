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
 * Ticket scanner filter
 *
 * @package ExtList
 * @subpackage Filter/TicketScannerFilter
 * @author Daniel Lienert <lienert@punkt.de>
 */
class  Tx_PtConference_ExtList_Filter_TicketScannerFilter extends Tx_PtExtlist_Domain_Model_Filter_AbstractFilter {
	
	protected $scannerIdentifier;
	
	/**
	 * Build the filter criteria for this scanner
	 */
	protected function buildFilterCriteria() {
		
		$ticketScanner = Tx_PtConference_Domain_Model_Scanner_TicketScannerFactory::createInstance($this->scannerIdentifier);
		
		$criteria = NULL;
		$columnName = $this->fieldIdentifier->getTableFieldCombined();
		$filterValues = array_filter($ticketScanner->getTicketCodes());
		
		if (!is_array($filterValues) || count($filterValues) == 0) {
			$criteria = Tx_PtExtlist_Domain_QueryObject_Criteria::equals($columnName, '-');
		} elseif (is_array($filterValues) && count($filterValues) > 0) {
			$criteria = Tx_PtExtlist_Domain_QueryObject_Criteria::in($columnName, $filterValues);
		}

		return $criteria;
	}
	
	
	
	/**
	 * @see Tx_PtExtlist_Domain_Model_Filter_AbstractFilter::initFilterByTsConfig()
	 *
	 */
	protected function initFilterByTsConfig() {
	
		$filterSettings = $this->filterConfig->getSettings();
		
		tx_pttools_assert::isNotEmptyString($filterSettings['scannerIdentifier'], array('message' => 'No scanner identifier given. 1284063229'));
		$this->scannerIdentifier = $filterSettings['scannerIdentifier'];
	}
	
	
	
	protected function initFilter() {
		$this->initFilterByTsConfig();
	}
	
	
	
	protected function initFilterByGpVars() {}
	protected function initFilterBySession() {}
	
	public function reset() {}
	public function persistToSession() {}
	 public function getFilterBreadCrumb() {}
	
	
	/**
	 * (non-PHPdoc)
	 * @see Classes/Domain/Model/Filter/Tx_PtExtlist_Domain_Model_Filter_AbstractFilter::setActiveState()
	 */
	protected function setActiveState() {
		$this->isActive = true;
	}
	
}
?>