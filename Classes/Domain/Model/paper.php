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
 * paper
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_PtConference_Domain_Model_paper extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * title
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;
	
	/**
	 * author
	 * @var string
	 * @validate NotEmpty
	 */
	protected $author;
	
	/**
	 * abstract
	 * @var string
	 */
	protected $abstract;
	
	/**
	 * accepted_as_talk
	 * @var boolean
	 */
	protected $accepted_as_talk;
	
	/**
	 * accepted_as_tutorial
	 * @var boolean
	 */
	protected $accepted_as_tutorial;
	
	/**
	 * uploadpath
	 * @var string
	 */
	protected $uploadpath;
	
	/**
	 * sendmail
	 * @var boolean
	 */
	protected $sendmail;
	
	/**
	 * targetos
	 * @var Tx_PtConference_Domain_Model_targetos
	 */
	protected $targetos;
	
	/**
	 * targetaudience
	 * @var Tx_PtConference_Domain_Model_targetaudience
	 */
	protected $targetaudience;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_PtConference_Domain_Model_bestPaperVoting>
	   Votings for this paper 
	 */
	protected $votes;
	
	
	/**
	 * A template method to initialize an object. This can be used to manipulate the object after
	 * reconstitution and before the clean state of it's properties is stored.
	 *
	 * @return void
	 */
	protected function initializeObject() {
		$this->votes = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}
	
	
	public function addVote(Tx_PtConference_Domain_Model_bestPaperVoting $vote) {
		$this->votes->attach($vote);
	}
	
	public function getVotes() {
		return clone $this->votes;
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
	 * Setter for author
	 *
	 * @param string $author author
	 * @return void
	 */
	public function setAuthor($author) {
		$this->author = $author;
	}

	/**
	 * Getter for author
	 *
	 * @return string author
	 */
	public function getAuthor() {
		return $this->author;
	}
	
	/**
	 * Setter for abstract
	 *
	 * @param string $abstract abstract
	 * @return void
	 */
	public function setAbstract($abstract) {
		$this->abstract = $abstract;
	}

	/**
	 * Getter for abstract
	 *
	 * @return string abstract
	 */
	public function getAbstract() {
		return $this->abstract;
	}
	
	/**
	 * Setter for accepted_as_talk
	 *
	 * @param boolean $accepted_as_talk accepted_as_talk
	 * @return void
	 */
	public function setAccepted_as_talk($accepted_as_talk) {
		$this->accepted_as_talk = $accepted_as_talk;
	}

	/**
	 * Getter for accepted_as_talk
	 *
	 * @return boolean accepted_as_talk
	 */
	public function getAccepted_as_talk() {
		return $this->accepted_as_talk;
	}
	
	/**
	 * Returns the boolean state of accepted_as_talk
	 *
	 * @return bool The state of accepted_as_talk
	 */
	public function isAccepted_as_talk() {
		$this->getAccepted_as_talk();
	}
	
	/**
	 * Setter for accepted_as_tutorial
	 *
	 * @param boolean $accepted_as_tutorial accepted_as_tutorial
	 * @return void
	 */
	public function setAccepted_as_tutorial($accepted_as_tutorial) {
		$this->accepted_as_tutorial = $accepted_as_tutorial;
	}

	/**
	 * Getter for accepted_as_tutorial
	 *
	 * @return boolean accepted_as_tutorial
	 */
	public function getAccepted_as_tutorial() {
		return $this->accepted_as_tutorial;
	}
	
	/**
	 * Returns the boolean state of accepted_as_tutorial
	 *
	 * @return bool The state of accepted_as_tutorial
	 */
	public function isAccepted_as_tutorial() {
		$this->getAccepted_as_tutorial();
	}
	
	/**
	 * Setter for uploadpath
	 *
	 * @param string $uploadpath uploadpath
	 * @return void
	 */
	public function setUploadpath($uploadpath) {
		$this->uploadpath = $uploadpath;
	}

	/**
	 * Getter for uploadpath
	 *
	 * @return string uploadpath
	 */
	public function getUploadpath() {
		return $this->uploadpath;
	}
	
	/**
	 * Setter for sendmail
	 *
	 * @param boolean $sendmail sendmail
	 * @return void
	 */
	public function setSendmail($sendmail) {
		$this->sendmail = $sendmail;
	}

	/**
	 * Getter for sendmail
	 *
	 * @return boolean sendmail
	 */
	public function getSendmail() {
		return $this->sendmail;
	}
	
	/**
	 * Returns the boolean state of sendmail
	 *
	 * @return bool The state of sendmail
	 */
	public function isSendmail() {
		$this->getSendmail();
	}
	
	/**
	 * Setter for targetos
	 *
	 * @param Tx_PtConference_Domain_Model_targetos $targetos targetos
	 * @return void
	 */
	public function setTargetos(Tx_PtConference_Domain_Model_targetos $targetos) {
		$this->targetos = $targetos;
	}

	/**
	 * Getter for targetos
	 *
	 * @return Tx_PtConference_Domain_Model_targetos targetos
	 */
	public function getTargetos() {
		return $this->targetos;
	}
	
	/**
	 * Setter for targetaudience
	 *
	 * @param Tx_PtConference_Domain_Model_targetaudience $targetaudience targetaudience
	 * @return void
	 */
	public function setTargetaudience(Tx_PtConference_Domain_Model_targetaudience $targetaudience) {
		$this->targetaudience = $targetaudience;
	}

	/**
	 * Getter for targetaudience
	 *
	 * @return Tx_PtConference_Domain_Model_targetaudience targetaudience
	 */
	public function getTargetaudience() {
		return $this->targetaudience;
	}
	
}
?>