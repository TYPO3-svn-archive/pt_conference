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
 * Personal data
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_PtConference_Domain_Model_persdata extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * company
	 * @var string
	 */
	protected $company;
	
	/**
	 * title
	 * @var string
	 */
	protected $title;
	
	/**
	 * firstname
	 * @var string
	 */
	protected $firstname;
	
	/**
	 * lastname
	 * @var string
	 */
	protected $lastname;
	
	/**
	 * email
	 * @var string
	 */
	protected $email;
	
	/**
	 * jobstatus
	 * @var string
	 */
	protected $jobstatus;
	
	/**
	 * country
	 * @var string
	 */
	protected $country;
	
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
	 * checkedin
	 * @var integer
	 */
	protected $checkedin;
	
	/**
	 * goodiesreceived
	 * @var integer
	 */
	protected $goodiesreceived;
	
	/**
	 * badgeprinted
	 * @var integer
	 */
	protected $badgeprinted;
	
	
	/**
	 * Current data hash
	 * 
	 * @var string
	 */
	protected $currenthash;
	
	
	/**
	 * Hash of data when last printed
	 * @var string 
	 */
	protected $printedhash;
	
	
	/**
	 * event
	 * @var Tx_PtConference_Domain_Model_event
	 */
	protected $event;
	
	
	
	/**
	 * Setter for company
	 *
	 * @param string $company company
	 * @return void
	 */
	public function setCompany($company) {
		$this->company = $company;
	}

	
	
	public function setChangedafterprint($changedafterprint) {
		$this->changedafterprint = $changedafterprint;
	}
	
	
	
	public function getchangedafterprint($changedafterprint) {
		return $this->changedafterprint;
	}
	
	
	
	/**
	 * Getter for company
	 *
	 * @return string company
	 */
	public function getCompany() {
		return $this->company;
	}
	
	/**
	 * Setter for title
	 *
	 * @param string $title title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Getter for title
	 *
	 * @return string title
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * Setter for firstname
	 *
	 * @param string $firstname firstname
	 * @return void
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * Getter for firstname
	 *
	 * @return string firstname
	 */
	public function getFirstname() {
		return $this->firstname;
	}
	
	/**
	 * Setter for lastname
	 *
	 * @param string $lastname lastname
	 * @return void
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * Getter for lastname
	 *
	 * @return string lastname
	 */
	public function getLastname() {
		return $this->lastname;
	}
	
	/**
	 * Setter for email
	 *
	 * @param string $email email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Getter for email
	 *
	 * @return string email
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * Setter for jobstatus
	 *
	 * @param string $jobstatus jobstatus
	 * @return void
	 */
	public function setJobstatus($jobstatus) {
		$this->jobstatus = $jobstatus;
	}

	/**
	 * Getter for jobstatus
	 *
	 * @return string jobstatus
	 */
	public function getJobstatus() {
		return $this->jobstatus;
	}
	
	/**
	 * Setter for country
	 *
	 * @param string $country country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Getter for country
	 *
	 * @return string country
	 */
	public function getCountry() {
		return $this->country;
	}
	
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
	 * Setter for checkedin
	 *
	 * @param boolean $checkedin checkedin
	 * @return void
	 */
	public function setCheckedin($checkedin) {
		$this->checkedin = $checkedin;
	}

	/**
	 * Getter for checkedin
	 *
	 * @return boolean checkedin
	 */
	public function getCheckedin() {
		return $this->checkedin;
	}
	
	/**
	 * Setter for goodiesreceived
	 *
	 * @param string $goodiesreceived goodiesreceived
	 * @return void
	 */
	public function setGoodiesreceived($goodiesreceived) {
		$this->goodiesreceived = $goodiesreceived;
	}

	/**
	 * Getter for goodiesreceived
	 *
	 * @return string goodiesreceived
	 */
	public function getGoodiesreceived() {
		return $this->goodiesreceived;
	}
	
	/**
	 * Setter for badgeprinted
	 *
	 * @param string $badgeprinted badgeprinted
	 * @return void
	 */
	public function setBadgeprinted($badgeprinted) {
		$this->badgeprinted = $badgeprinted;
	}

	/**
	 * Getter for badgeprinted
	 *
	 * @return string badgeprinted
	 */
	public function getBadgeprinted() {
		return $this->badgeprinted;
	}
	
	/**
	 * Setter for event
	 *
	 * @param Tx_PtConference_Domain_Model_event $event event
	 * @return void
	 */
	public function setEvent(Tx_PtConference_Domain_Model_event $event) {
		$this->event = $event;
	}

	/**
	 * Getter for event
	 *
	 * @return Tx_PtConference_Domain_Model_event event
	 */
	public function getEvent() {
		return $this->event;
	}
	
	public function getCurrenthash() {
		return $this->currenthash;
	}
	
	public function setCurrenthash($currentHash) {
		$this->currenthash = $currentHash;
	}
	
	
	/**
	 * Getter for printedhash
	 *
	 * @return string printedhash
	 */
	public function getPrintedhash() {
		return $this->printedhash;
	}
	
	
	/**
	 * Setter for printedhash
	 *
	 * @param string $printedhash printedhash
	 * @return void
	 */
	public function setPrintedhash($printedHash) {
		$this->printedhash = $printedHash;
	}
	
	/**
	 * Generate a hashsum over the relevant data
	 * @return string;
	 */
	public function generateHash() {
		$relevantData = array('company','country','firstname','lastname','jobstatus');
		foreach($relevantData as $relevantField) {
			$getterMethod = 'get'. ucfirst($relevantField);
			$badgeDataString = '';
			
			if(method_exists($this, $getterMethod)) {
				$badgeDataString .= $this->$getterMethod();
			}
		}
		
		return md5($badgeDataString);
	}
}
?>