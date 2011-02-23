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
 * Best paper voting
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_PtConference_Domain_Model_bestPaperVoting extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * rating
	 * @var integer
	 */
	protected $rating;
	
	/**
	 * paper
	 * @var Tx_PtConference_Domain_Model_paper
	 */
	protected $paper;
	
	/**
	 * attendee
	 * @var integer
	 */
	protected $attendee;
	
	
	
	/**
	 * Setter for rating
	 *
	 * @param integer $rating rating
	 * @return void
	 * @throws Exception
	 */
	public function setRating($rating) {
		
		if($rating < 0 || $rating > 5) {
			throw new Exception('errVoteExceedsRange');
		}
		
		$this->rating = $rating;
	}

	/**
	 * Getter for rating
	 *
	 * @return integer rating
	 */
	public function getRating() {
		return $this->rating;
	}
	
	/**
	 * Setter for paper
	 *
	 * @param Tx_PtConference_Domain_Model_paper $paper paper
	 * @return void
	 */
	public function setPaper(Tx_PtConference_Domain_Model_paper $paper) {
		$this->paper = $paper;
	}

	/**
	 * Getter for paper
	 *
	 * @return Tx_PtConference_Domain_Model_paper paper
	 */
	public function getPaper() {
		return $this->paper;
	}
	
	/**
	 * Setter for attendee
	 *
	 * @param integer $attendee
	 * @return void
	 */
	public function setAttendee( $attendee) {
		$this->attendee = $attendee;
	}

	/**
	 * Getter for attendee
	 *
	 * @return integer attendee
	 */
	public function getAttendee() {
		return $this->attendee;
	}
	
}
?>