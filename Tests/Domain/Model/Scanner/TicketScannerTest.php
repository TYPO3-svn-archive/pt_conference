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
 * Class implements testcase for ticket scanner
 *
 * @package pt_conference
 * @subpackage Tests/Domain/Model/Scanner
 * @author Daniel Lienert <lienert@punkt.de>
 */
class Tx_PtExtlist_Tests_Domain_Model_Scanner_TicketScanner_testcase extends Tx_Extbase_BaseTestcase {

	public function testAddTicket() {
		$scanner = new Tx_PtConference_Domain_Model_Scanner_TicketScanner('testScanner');
		$scanner->processTicketCode('3424324324');
		
		$ticketCodes = $scanner->getTicketCodes();
		$this->assertEquals('3424324324', current($ticketCodes));
	}
	
	
	public function testRemoveTicket() {
		$ticketCode = '3424324324';
		
		$scanner = new Tx_PtConference_Domain_Model_Scanner_TicketScanner('testScanner');
		$scanner->processTicketCode($ticketCode);
		
		$ticketCodes = $scanner->getTicketCodes();
		$this->assertEquals($ticketCode, current($ticketCodes));
		
		$scanner->processTicketCode($ticketCode);
		
		$ticketCodes = $scanner->getTicketCodes();
		$this->assertEquals(0, count($ticketCodes));
	}

	
	public function testExceptionIfTicketIsInRestrictedList() {
		$ticketCode = '3424324324';
		
		$scanner = new Tx_PtConference_Domain_Model_Scanner_TicketScanner('testScanner');
		
		$scanner->setRestrictedTicketCodes(array('111'));
		
		$scanner->processTicketCode($ticketCode);
		
		try {
			$scanner->processTicketCode('111');
		} catch (Exception $e) {
			return;
		}
		
		$this->fail('No Exception is thrown if ticket is in restricted list');
	}
	
	
	
	public function testReset() {
		$ticketCode = '3424324324';
		
		$scanner = new Tx_PtConference_Domain_Model_Scanner_TicketScanner('testScanner');
		$scanner->scan($ticketCode);
		
		$scanner->reset();
		
		$this->assertEquals(0, count($scanner->getTicketCodes()), 'TicketCodes should be flushed when resetting');
	}
	
	
	public function testScanAddCode() {
		$ticketCode = '3424324324';
		
		$scanner = new Tx_PtConference_Domain_Model_Scanner_TicketScanner('testScanner');

		$ret = $scanner->scan($ticketCode);
		$this->assertTrue($ret);
		
		$ticketCodes = $scanner->getTicketCodes();
		$this->assertEquals(1, count($ticketCodes));
		$this->assertEquals($ticketCode, current($ticketCodes));
	}
	
	public function testScanExternalCommand() {
		$scanner = new Tx_PtConference_Domain_Model_Scanner_TicketScanner('testScanner');
		$scanner->registerControlCodes(array('test'));
		
		$ret = $scanner->scan('test');
		$this->assertEquals($ret, 'test');
		$this->assertEquals(0, count($scanner->getTicketCodes()));
	}
	
}
?>