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
 * Invoice filter
 *
 * @package ExtList
 * @subpackage Filter/InvoiceFilter
 * @author Daniel Lienert <lienert@punkt.de>
 */
class  Tx_PtConference_ExtList_Filter_InvoiceFilter extends Tx_PtExtlist_Domain_Model_Filter_SelectFilter {
	
	protected function buildFilterCriteria() {
		
		$filterValue = current($this->filterValues);
		
		if($filterValue) {
			$criteriaBuilderMethod = 'build' . ucfirst($filterValue) . 'Criteria';
			tx_pttools_assert::isTrue(method_exists($this, $criteriaBuilderMethod), array('message' => 'No buildermethod for '.$filterValue.' available!'));
			$criteria = $this->$criteriaBuilderMethod();
		}
		
		
		return $criteria;
	}
	
	
	
	protected function buildOutstandingCriteria() {
		$outstandingCriteria = Tx_PtExtlist_Domain_QueryObject_Criteria::notOp(Tx_PtExtlist_Domain_QueryObject_Criteria::equals('(fschrift.BEZSUMME - fschrift.ENDPRB)', '0'));
		$criteria = Tx_PtExtlist_Domain_QueryObject_Criteria::andOp($outstandingCriteria, 
							Tx_PtExtlist_Domain_QueryObject_Criteria::notOp(
							$this->buildCanceledCriteria()));
		return $criteria;
	}
	
	
	
	protected function buildCanceledCriteria() {
		$stornoQuery = '(IFNULL((SELECT NUMMER from tx_ptgsaminidb_FSCHRIFT fschriftstorno WHERE ERFART = "06ST" AND fschriftstorno.ALTAUFNR = fschrift.AUFNR limit 0,1),0))';
		$criteria = Tx_PtExtlist_Domain_QueryObject_Criteria::notOp(Tx_PtExtlist_Domain_QueryObject_Criteria::equals($stornoQuery, '0'));
		return $criteria;
	}
	
	
	
	protected function buildPartlyCanceledCriteria() {
		$criteria = Tx_PtExtlist_Domain_QueryObject_Criteria::greaterThan('fschrift.GUTSUMME', 0);
		return $criteria;
	}
	
	
	
	protected function buildPaidCriteria() {
		$paidCriteria = Tx_PtExtlist_Domain_QueryObject_Criteria::equals('(fschrift.BEZSUMME - fschrift.ENDPRB)', '0');
		return $paidCriteria;
	}
	
	
	
	protected function buildPartlyPaidCriteria() {
		$partlypaidCriteria = Tx_PtExtlist_Domain_QueryObject_Criteria::greaterThan('fschrift.BEZSUMME', '0');
		return $partlypaidCriteria;
	}
}
?>