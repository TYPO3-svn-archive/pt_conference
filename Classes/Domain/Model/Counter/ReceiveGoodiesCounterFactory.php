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
 * checkInCounter factory
 *
 * @package Domain
 * @subpackage Model/Counter/
 * @author Daniel Lienert <lienert@punkt.de>
 */
class Tx_PtConference_Domain_Model_Counter_ReceiveGoodiesCounterFactory {
	
	
	public static function createInstance() {
		
		$receiveGoodiesCounter = new Tx_PtConference_Domain_Model_Counter_ReceiveGoodiesCounter();
		
		$receiveGoodiesCounter->injectTicketScanner(self::buildTicketScanner());
		$receiveGoodiesCounter->init();
		
		return $receiveGoodiesCounter;
	}
	
	
	protected static function buildTicketScanner() {
		
		$ticketScanner = Tx_PtConference_Domain_Model_Scanner_TicketScannerFactory::createInstance('receivegoodies');
		$ticketScanner->registerControlCodes(array('submit'));
		
		return $ticketScanner;
	}
	
}
?>