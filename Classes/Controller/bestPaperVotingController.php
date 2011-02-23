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
 * Controller for the bestPaperVoting object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

class Tx_PtConference_Controller_bestPaperVotingController extends Tx_PtConference_Controller_ConferenceBaseController {
	
	/**
	 * @var Tx_PtConference_Domain_Repository_paperRepository
	 */
	protected $paperRepository;
	
	/**
	 * @var Tx_PtConference_Domain_Repository_bestPaperVotingRepository
	 */
	protected $bestPaperRepository;
	

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->paperRepository = t3lib_div::makeInstance('Tx_PtConference_Domain_Repository_paperRepository');
		$this->bestPaperRepository = t3lib_div::makeInstance('Tx_PtConference_Domain_Repository_bestPaperVotingRepository');
	}
	
	/**
	 * List action
	 *
	 * @return string The rendered list action
	 */
	public function listAction() {
		$attendee = $GLOBALS['TSFE']->fe_user->user['uid'];
		tx_pttools_assert::isNotEmpty($attendee, array(message => 'You need to be logged in to vote. 1284549457'));
		
		$list = $this->createSubController('bestPaperVoting');		
		return $list->listAction();	
		
		$this->restoreFlashMessages();
	}
	
	
	/**
	 * Stats action
	 *
	 * @return string The rendered stats action
	 */
	public function statsAction() {
		$list = $this->createSubController('bestPaperVotingStats');
		return $list->listAction();
	}

	/**
	 * Vote for a paper
	 * 
	 * @param int $paper 
	 * @param int $rating
	 */
	public function voteAction($paper, $rating) {
		
		$vote = $this->bestPaperRepository->findByPaperAndUser($paper);
		$paperObj = $this->paperRepository->findByUid($paper);
		if($vote === NULL) {
			
			$vote = $this->createNewVote($rating, $paperObj);
		
			if($vote !== NULL)
				$this->bestPaperRepository->add($vote);
				
		} else {
			try {
				$vote->setRating($rating);
				$this->bestPaperRepository->update($vote);	
			} catch (Exception $e) {
				$this->addTranslatedFlashMessage($e->getMessage());
			}
			
		}
		$persistenceManager = Tx_Extbase_Dispatcher::getPersistenceManager();
		$persistenceManager->persistAll();
		
		$this->forward('list');
	}
	
	
	
	/**
	 * Creates a new vote filled with attendee and rating.
	 *
	 * @param integer $rating
	 * @param Tx_PtConference_Domain_Model_paper $paper
	 */
	protected function createNewVote($rating, Tx_PtConference_Domain_Model_paper $paper) {
		$vote = t3lib_div::makeInstance(Tx_PtConference_Domain_Model_bestPaperVoting);
		$vote->setRating($rating);
		$vote->setPaper($paper);
		
		$attendee = $GLOBALS['TSFE']->fe_user->user['uid'];
		
		tx_pttools_assert::isNotEmpty($attendee, array(message => 'You need to be logged in to vote. 1284543073'));

		$vote->setAttendee($attendee);
		
		return $vote;
	}
	
	
	protected function addTranslatedFlashMessage($message) {
		if(trim($message)) {
			$messageKey = 'tx_ptconference_domain_model_bestPaper.' . $message;
			
			$this->flashMessageContainer->add($messageKey);
			$this->flashMessageContainer->persist();
		}
	}
	
}
?>