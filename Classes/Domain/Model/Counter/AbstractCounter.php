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
 * Abstract counter model
 *
 * @package pt_conference
 * @subpackage Domain/Model/Counter/
 * @author Daniel Lienert <lienert@punkt.de>
 */
abstract class Tx_PtConference_Domain_Model_Counter_AbstractCounter {
	
	/**
	 * Holds the state of the ticketScanner
	 * 
	 * @var Tx_PtConference_Domain_Model_Scanner_TicketScanner
	 */
	protected $ticketScanner;

	
	/**
	 * @var Tx_PtConference_Domain_Repository_persdataRepository
	 */
	protected $persDataRepository;
	
	
	public function __construct() {
		$this->persDataRepository = new Tx_PtConference_Domain_Repository_persdataRepository();
	}

	
	/*
	 * init the counter
	 */
	public function init() {
		$this->setRestrictedTicketCodes();
	}

	
	/**
	 * set restricted ticket codes - eg already scanned in ticketScanner
	 */
	abstract protected function setRestrictedTicketCodes();
	
	
	/**
	 * inject the ticket scanner object
	 * 
	 * @param Tx_PtConference_Domain_Model_Scanner_TicketScanner $ticketScanner
	 */
	public function injectTicketScanner(Tx_PtConference_Domain_Model_Scanner_TicketScanner $ticketScanner) {
		$this->ticketScanner = $ticketScanner;
	}

	
	
	/**
	 * return the ticket scanner
	 * @return Tx_PtConference_Domain_Model_Scanner_TicketScanner scanner
	 */
	public function getScanner() {
		return $this->ticketScanner;
	}
}
?>