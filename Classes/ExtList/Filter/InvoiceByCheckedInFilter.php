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
class  Tx_PtConference_ExtList_Filter_InvoiceByCheckedInFilter extends Tx_PtExtlist_Domain_Model_Filter_SelectFilter {
	
	protected function buildFilterCriteria() {
		
		$filterValue = current($this->filterValues);
		
		if($filterValue) {
			$criteriaBuilderMethod = 'build' . ucfirst($filterValue) . 'Criteria';
			tx_pttools_assert::isTrue(method_exists($this, $criteriaBuilderMethod), array('message' => 'No buildermethod for '.$filterValue.' available!'));
			$criteria = $this->$criteriaBuilderMethod();
		}
		
		
		return $criteria;
	}
	
	protected function buildCheckedinCriteria() {
		$someOneCheckedInQuery = '(select sum(ciPersdata.checkedin) from tx_ptconference_domain_model_persdata ciPersdata where ciPersdata.tx_ptgsashop_orders_articles_uid = articles.uid)';
		$criteria = Tx_PtExtlist_Domain_QueryObject_Criteria::greaterThan($someOneCheckedInQuery, '0');
		return $criteria;
	}
	
	protected function buildNoonecheckedinCriteria() {
		$someOneCheckedInQuery = '(select sum(ciPersdata.checkedin) from tx_ptconference_domain_model_persdata ciPersdata where ciPersdata.tx_ptgsashop_orders_articles_uid = articles.uid)';
		$criteria = Tx_PtExtlist_Domain_QueryObject_Criteria::equals($someOneCheckedInQuery, '0');
		return $criteria;
	}
}
?>