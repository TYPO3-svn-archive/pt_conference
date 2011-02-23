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
 * Ticketscanner
 *
 * @package pt_conference
 * @subpackage Domain/Model/Scanner/
 * @author Daniel Lienert <lienert@punkt.de>
 */
class Tx_PtConference_Domain_Model_Scanner_TicketScanner {
	
	/**
	 * Array of currently scanned tickets
	 * 
	 * @var array
	 */
	protected $ticketCodes;
	
	
	/**
	 * @var string scannerIdentifier
	 */
	protected $scannerIndentifier;
	
	
	/**
	 * Array of restricted ticketNumbers
	 * these array can be set with already processed tickets, eg to avoid a double check in 
	 * 
	 * @var array
	 */
	protected $restrictedTicketCodes;
	
	
	/**
	 * Scanner recognizes his internal control codes and 
	 * registered control codes, everey other sdtring is treated as ticketCode
	 * 
	 * @var array
	 */
	protected $registeredControlCodes;
	
	
	/**
	 * Sets the scanner identifier
	 * 
	 * @param string $scannerIdentifier
	 */
	public function __construct($scannerIdentifier) {
		$this->scannerIndentifier = $scannerIdentifier;
	}
	
	
	
	public function init() {		
		$this->loadFromSession();
	}
	

	
	/**
	 * Register the recognized control codes
	 * 
	 * @param array $controlCodes
	 */
	public function registerControlCodes($controlCodes) {
		$this->registeredControlCodes = $controlCodes;
	}
	
	
	
	/**
	 * Process the input
	 * 
	 * @param string $input
	 */
	public function scan($input) {
		$input = strtolower(trim($input));
		if(!$input) return true;
		
		switch ($input) {
			case 'reset':
				 $this->reset();
				 break;
			default:
				if(in_array($input, $this->registeredControlCodes)) {
					return $input;
				} else {
					$this->processTicketCode($input);
					return true;
				}
				break;
		}
		
		return true;
	}
	
	
	
	/**
	 * Reset scanner
	 */
	public function reset() {
		unset($this->ticketCodes);
		$this->persistToSession();
	}
	
	
		
	/**
	 * Add a ticket code to the ticket list
	 * 
	 * @param integer $ticketCode
	 */
	protected function addTicketCode($ticketCode) {
		$this->checkTicketCodeBeforeAdd($ticketCode);
		$this->ticketCodes[$ticketCode] = $ticketCode;
	}
	
	
	
	/**
	 * Remove ticket code from list
	 * 
	 * @param integer $ticketCode
	 * @throws Exception
	 */
	protected function removeTicketCode($ticketCode) {
		if(!in_array($ticketCode, $this->ticketCodes)) {
			throw new Exception('errTicketNotInList');
		}
		
		unset($this->ticketCodes[$ticketCode]);
	}
	
	
	
	
	/**
	 * Check if it is posible to add the ticket
	 * 
	 * @param integer $ticketNumber
	 * @throws Exception if ticket is in local ticketlist or restricted list
	 */
	protected function checkTicketCodeBeforeAdd($ticketCode) {		
		if(in_array($ticketCode, $this->restrictedTicketCodes)) {
			throw new Exception('errTicketInRestrictedList');
		}
	}
	
	
	
	
	/**
	 * process ticket code by current mode
	 * 
	 * @param integer $ticketNumber
	 */
	public function processTicketCode($ticketCode) {
		if(in_array($ticketCode, $this->ticketCodes)) {
			$this->removeTicketCode($ticketCode);
		} else {
			$this->addTicketCode($ticketCode);
		}
	}
	
	
	/**
	 * return an array of the current ticketcodes
	 * 
	 * @return array ticketCodes
	 */
	public function getTicketCodes() {
		return $this->ticketCodes;
	}
	
	
	/**
	 * Set restrictedTicketNumbers
	 * 
	 * @param array $restrictedTicketNumbers
	 */
	public function setRestrictedTicketCodes(array $restrictedTicketCodes) {
		$this->restrictedTicketCodes = $restrictedTicketCodes;
	}
	

	/**
	 * Returns namespace for this object
	 * 
	 * @return string Namespace to identify this object
	 */
	public function getObjectNamespace() {
		return 'tx_ptconference_pi1.ticketScanner.' . $this->scannerIdentifier;
	}
	
	
	
	/**
	 * Load the data from sessiom
	 */
	public function loadFromSession() {
		
		$sessionData = tx_pttools_sessionStorageAdapter::getInstance()->read($this->getObjectNamespace());
		
		if(array_key_exists('ticketCodes', $sessionData) && is_array($sessionData['ticketCodes'])) {
			$this->ticketCodes = $sessionData['ticketCodes'];
		}
	}
	
	
	
	public function persistToSession() {	
		$sessionData = array('ticketCodes' => $this->ticketCodes);
		tx_pttools_sessionStorageAdapter::getInstance()->store($this->getObjectNamespace(), $sessionData);
	}	
}
?>