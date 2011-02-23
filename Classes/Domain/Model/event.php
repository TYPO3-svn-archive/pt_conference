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
 * Events
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_PtConference_Domain_Model_event extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * Event code
	 * @var string
	 */
	protected $code;
	
	/**
	 * title
	 * @var string
	 */
	protected $title;
	
	/**
	 * description
	 * @var string
	 */
	protected $description;
	
	/**
	 * venue
	 * @var string
	 */
	protected $venue;
	
	/**
	 * startdate
	 * @var integer
	 */
	protected $startdate;
	
	/**
	 * enddate
	 * @var integer
	 */
	protected $enddate;
	
	
	
	/**
	 * Setter for code
	 *
	 * @param string $code Event code
	 * @return void
	 */
	public function setCode($code) {
		$this->code = $code;
	}

	/**
	 * Getter for code
	 *
	 * @return string Event code
	 */
	public function getCode() {
		return $this->code;
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
	 * Setter for description
	 *
	 * @param string $description description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Getter for description
	 *
	 * @return string description
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Setter for venue
	 *
	 * @param string $venue venue
	 * @return void
	 */
	public function setVenue($venue) {
		$this->venue = $venue;
	}

	/**
	 * Getter for venue
	 *
	 * @return string venue
	 */
	public function getVenue() {
		return $this->venue;
	}
	
	/**
	 * Setter for startdate
	 *
	 * @param integer $startdate startdate
	 * @return void
	 */
	public function setStartdate($startdate) {
		$this->startdate = $startdate;
	}

	/**
	 * Getter for startdate
	 *
	 * @return integer startdate
	 */
	public function getStartdate() {
		return $this->startdate;
	}
	
	/**
	 * Setter for enddate
	 *
	 * @param integer $enddate enddate
	 * @return void
	 */
	public function setEnddate($enddate) {
		$this->enddate = $enddate;
	}

	/**
	 * Getter for enddate
	 *
	 * @return integer enddate
	 */
	public function getEnddate() {
		return $this->enddate;
	}
	
}
?>