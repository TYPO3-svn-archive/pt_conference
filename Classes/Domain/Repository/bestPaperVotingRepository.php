<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Christoph Ehscheidt <ehscheidt@punkt.de>
*  All rights reserved
*
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
 * Repository for Tx_PtConference_Domain_Model_bestPaperVoting
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_PtConference_Domain_Repository_bestPaperVotingRepository extends Tx_Extbase_Persistence_Repository {
	
	/**
	 * Returns a voting object for a given user and paper.
	 * 
	 * @param Tx_PtConference_Domain_Model_paper $paper
	 * @param integer $feUserUid
	 */
	public function findByPaperAndUser($paper,$feUserUid=NULL) {
		if($feUserUid === NULL) $feUserUid = $GLOBALS['TSFE']->fe_user->user['uid'];
		
		$query = $this->createQuery();
		$result = $query->matching(
					$query->logicalAnd(
						$query->equals('attendee', $feUserUid),
						$query->equals('paper', $paper)
					)
				)
				->setLimit(1)
				->execute();
		
		$object = NULL;
		if (count($result) > 0) {
			$object = current($result);
		}
		return $object;
	}	
}


?>