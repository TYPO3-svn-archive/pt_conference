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
 * Class implements testcase for best paper voting
 *
 * @package Tests
 * @subpackage Domain/Model
 * @author Daniel Lienert <lienert@punkt.de>
 */
class Tx_PtExtlist_Tests_Domain_Model_bestPaperVoting_testcase extends Tx_Extbase_BaseTestcase {

	public function testSetGetVote() {
		$vote = new Tx_PtConference_Domain_Model_bestPaperVoting();
		$vote->setRating(4);
		
		$this->assertEquals($vote->getRating(), 4);
	}
	
	public function testCheckExceptionIfVoteExceedsMaxLimit() {
		
		$vote = new Tx_PtConference_Domain_Model_bestPaperVoting();
		try {
			$vote->setRating(99);
		} catch(Exception $e) {
			$this->assertTrue(true);
			return;
		}
		
		$this->fail('No Exception is thrown when vote exceeds limit!');
	}
	
	public function testCheckExceptionIfVoteExceedsMinLimit() {
		
		$vote = new Tx_PtConference_Domain_Model_bestPaperVoting();
		try {
			$vote->setRating(-1);
		} catch(Exception $e) {
			$this->assertTrue(true);
			return;
		}
		
		$this->fail('No Exception is thrown when vote exceeds limit!');
	}
	
}
?>