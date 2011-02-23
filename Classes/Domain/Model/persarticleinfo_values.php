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
 * persarticleinfo_values
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_PtConference_Domain_Model_persarticleinfo_values extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * tx_ptgsaconfmgm_persdata_uid
	 * @var string
	 */
	protected $tx_ptgsaconfmgm_persdata_uid;
	
	/**
	 *   	tx_ptgsaconfmgm_relarticle_uid
	 * @var string
	 */
	protected $tx_ptgsaconfmgm_relarticle_uid;
	
	/**
	 * infovalue
	 * @var string
	 */
	protected $infovalue;
	
	/**
	 * infotype
	 * @var Tx_PtConference_Domain_Model_persarticleinfo_types
	 */
	protected $infotype;
	
	
	
	/**
	 * Setter for tx_ptgsaconfmgm_persdata_uid
	 *
	 * @param string $tx_ptgsaconfmgm_persdata_uid tx_ptgsaconfmgm_persdata_uid
	 * @return void
	 */
	public function setTx_ptgsaconfmgm_persdata_uid($tx_ptgsaconfmgm_persdata_uid) {
		$this->tx_ptgsaconfmgm_persdata_uid = $tx_ptgsaconfmgm_persdata_uid;
	}

	/**
	 * Getter for tx_ptgsaconfmgm_persdata_uid
	 *
	 * @return string tx_ptgsaconfmgm_persdata_uid
	 */
	public function getTx_ptgsaconfmgm_persdata_uid() {
		return $this->tx_ptgsaconfmgm_persdata_uid;
	}
	
	/**
	 * Setter for   	tx_ptgsaconfmgm_relarticle_uid
	 *
	 * @param string $  	tx_ptgsaconfmgm_relarticle_uid   	tx_ptgsaconfmgm_relarticle_uid
	 * @return void
	 */
	public function setTx_ptgsaconfmgm_relarticle_uid($tx_ptgsaconfmgm_relarticle_uid) {
		$this->tx_ptgsaconfmgm_relarticle_uid = $tx_ptgsaconfmgm_relarticle_uid;
	}

	/**
	 * Getter for   	tx_ptgsaconfmgm_relarticle_uid
	 *
	 * @return string   	tx_ptgsaconfmgm_relarticle_uid
	 */
	public function getTx_ptgsaconfmgm_relarticle_uid() {
		return $this->tx_ptgsaconfmgm_relarticle_uid;
	}
	
	/**
	 * Setter for infovalue
	 *
	 * @param string $infovalue infovalue
	 * @return void
	 */
	public function setInfovalue($infovalue) {
		$this->infovalue = $infovalue;
	}

	/**
	 * Getter for infovalue
	 *
	 * @return string infovalue
	 */
	public function getInfovalue() {
		return $this->infovalue;
	}
	
	/**
	 * Setter for infotype
	 *
	 * @param Tx_PtConference_Domain_Model_persarticleinfo_types $infotype infotype
	 * @return void
	 */
	public function setInfotype(Tx_PtConference_Domain_Model_persarticleinfo_types $infotype) {
		$this->infotype = $infotype;
	}

	/**
	 * Getter for infotype
	 *
	 * @return Tx_PtConference_Domain_Model_persarticleinfo_types infotype
	 */
	public function getInfotype() {
		return $this->infotype;
	}
	
}
?>