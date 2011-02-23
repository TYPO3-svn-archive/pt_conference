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
 * Article info type
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_PtConference_Domain_Model_persarticleinfo_types extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * title
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;
	
	/**
	 * description
	 * @var string
	 */
	protected $description;
	
	/**
	 * inputtype
	 * @var string
	 */
	protected $inputtype;
	
	/**
	 * inputdefault
	 * @var string
	 */
	protected $inputdefault;
	
	/**
	 * gsa_shop_articles
	 * @var select
	 */
	protected $gsa_shop_articles;
	
	
	
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
	 * Setter for inputtype
	 *
	 * @param string $inputtype inputtype
	 * @return void
	 */
	public function setInputtype($inputtype) {
		$this->inputtype = $inputtype;
	}

	/**
	 * Getter for inputtype
	 *
	 * @return string inputtype
	 */
	public function getInputtype() {
		return $this->inputtype;
	}
	
	/**
	 * Setter for inputdefault
	 *
	 * @param string $inputdefault inputdefault
	 * @return void
	 */
	public function setInputdefault($inputdefault) {
		$this->inputdefault = $inputdefault;
	}

	/**
	 * Getter for inputdefault
	 *
	 * @return string inputdefault
	 */
	public function getInputdefault() {
		return $this->inputdefault;
	}
	
	/**
	 * Setter for gsa_shop_articles
	 *
	 * @param select $gsa_shop_articles gsa_shop_articles
	 * @return void
	 */
	public function setGsa_shop_articles($gsa_shop_articles) {
		$this->gsa_shop_articles = $gsa_shop_articles;
	}

	/**
	 * Getter for gsa_shop_articles
	 *
	 * @return select gsa_shop_articles
	 */
	public function getGsa_shop_articles() {
		return $this->gsa_shop_articles;
	}
	
}
?>