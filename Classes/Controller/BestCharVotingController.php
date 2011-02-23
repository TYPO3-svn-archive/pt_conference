<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Christoph Ehscheidt <ehscheidt@punkt.de>, punkt.de
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
 * Controller for the BestCharVoting object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

class Tx_PtConference_Controller_BestCharVotingController extends Tx_PtConference_Controller_ConferenceBaseController {
	
	/**
	 * @var Tx_PtConference_Domain_Repository_CharRepository
	 */
	protected $charRepository;
	
	/**
	 * @var Tx_PtConference_Domain_Repository_BestCharVotingRepository
	 */
	protected $bestCharRepository;
	

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->charRepository = t3lib_div::makeInstance('Tx_PtConference_Domain_Repository_CharRepository');
		$this->bestCharRepository = t3lib_div::makeInstance('Tx_PtConference_Domain_Repository_BestCharVotingRepository');
	}
	
	/**
	 * List action
	 *
	 * @return string The rendered list action
	 */
	public function listAction() {
		$attendee = $GLOBALS['TSFE']->fe_user->user['uid'];
		tx_pttools_assert::isNotEmpty($attendee, array(message => 'You need to be logged in to vote. 1284549457'));
		
		$list = $this->createSubController('bestCharVoting');		
		return $list->listAction();	
	}
	
	
	/**
	 * Stats action
	 *
	 * @return string The rendered stats action
	 */
	public function statsAction() {
		$list = $this->createSubController('bestCharVotingStats');
		return $list->listAction();
	}

	/**
	 * Vote for a paper
	 * 
	 * @param int $char 
	 * @param int $rating
	 */
	public function voteAction($char, $rating) {
		
		$vote = $this->bestCharRepository->findByCharAndUser($char);
		$charObj = $this->charRepository->findByUid($char);
		if($vote === NULL) {

			$vote = $this->createNewVote($rating, $charObj);
		
			if($vote !== NULL)
				$this->bestCharRepository->add($vote);
				
		} else {
			$vote->setRating($rating);
			$this->bestCharRepository->update($vote);
		}
		$persistenceManager = Tx_Extbase_Dispatcher::getPersistenceManager();
		$persistenceManager->persistAll();
		
		$this->forward('list');
	}
	
	
	
	/**
	 * Creates a new vote filled with attendee and rating.
	 *
	 * @param integer $rating
	 * @param Tx_PtConference_Domain_Model_Char $char
	 */
	protected function createNewVote($rating, Tx_PtConference_Domain_Model_Char $char) {
		$vote = t3lib_div::makeInstance(Tx_PtConference_Domain_Model_BestCharVoting);
		$vote->setRating($rating);
		$vote->setChar($char);
		
		$attendee = $GLOBALS['TSFE']->fe_user->user['uid'];
		
		tx_pttools_assert::isNotEmpty($attendee, array(message => 'You need to be logged in to vote. 1284543073'));

		$vote->setAttendee($attendee);

		return $vote;
	}
	
}
?>