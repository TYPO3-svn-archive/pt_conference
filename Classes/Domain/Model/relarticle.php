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
 * relarticle
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_PtConference_Domain_Model_relarticle extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * tx_ptgsashop_orders_articles_uid
	 * @var integer
	 */
	protected $tx_ptgsashop_orders_articles_uid;
	
	/**
	 * tx_ptgsashop_customer_uid
	 * @var integer
	 */
	protected $tx_ptgsashop_customer_uid;
	
	/**
	 * articlecode
	 * @var string
	 */
	protected $articlecode;
	
	/**
	 * persdata
	 * @var Tx_PtConference_Domain_Model_persdata
	 */
	protected $persdata;
	
	
	
	/**
	 * Setter for tx_ptgsashop_orders_articles_uid
	 *
	 * @param integer $tx_ptgsashop_orders_articles_uid tx_ptgsashop_orders_articles_uid
	 * @return void
	 */
	public function setTx_ptgsashop_orders_articles_uid($tx_ptgsashop_orders_articles_uid) {
		$this->tx_ptgsashop_orders_articles_uid = $tx_ptgsashop_orders_articles_uid;
	}

	/**
	 * Getter for tx_ptgsashop_orders_articles_uid
	 *
	 * @return integer tx_ptgsashop_orders_articles_uid
	 */
	public function getTx_ptgsashop_orders_articles_uid() {
		return $this->tx_ptgsashop_orders_articles_uid;
	}
	
	/**
	 * Setter for tx_ptgsashop_customer_uid
	 *
	 * @param integer $tx_ptgsashop_customer_uid tx_ptgsashop_customer_uid
	 * @return void
	 */
	public function setTx_ptgsashop_customer_uid($tx_ptgsashop_customer_uid) {
		$this->tx_ptgsashop_customer_uid = $tx_ptgsashop_customer_uid;
	}

	/**
	 * Getter for tx_ptgsashop_customer_uid
	 *
	 * @return integer tx_ptgsashop_customer_uid
	 */
	public function getTx_ptgsashop_customer_uid() {
		return $this->tx_ptgsashop_customer_uid;
	}
	
	/**
	 * Setter for articlecode
	 *
	 * @param string $articlecode articlecode
	 * @return void
	 */
	public function setArticlecode($articlecode) {
		$this->articlecode = $articlecode;
	}

	/**
	 * Getter for articlecode
	 *
	 * @return string articlecode
	 */
	public function getArticlecode() {
		return $this->articlecode;
	}
	
	/**
	 * Setter for persdata
	 *
	 * @param Tx_PtConference_Domain_Model_persdata $persdata persdata
	 * @return void
	 */
	public function setPersdata(Tx_PtConference_Domain_Model_persdata $persdata) {
		$this->persdata = $persdata;
	}

	/**
	 * Getter for persdata
	 *
	 * @return Tx_PtConference_Domain_Model_persdata persdata
	 */
	public function getPersdata() {
		return $this->persdata;
	}
	
}
?>