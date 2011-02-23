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
 * Controller for the persdata object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */


class Tx_PtConference_Controller_persdataController extends Tx_PtConference_Controller_ConferenceBaseController {
	
	/**
	 * @var Tx_PtConference_Domain_Repository_persdataRepository
	 */
	protected $persdataRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->persdataRepository = t3lib_div::makeInstance('Tx_PtConference_Domain_Repository_persdataRepository');
	}
	
	/**
	 * list action
	 *
	 * @return string The rendered list action
	 */
	public function listAction() {

		$list = $this->createSubController('attendeeList');
		return $list->listAction();

	}
	
	/**
	 * Edit Action
	 *
	 * @param int $persdataUid The uid of the recordset to edit
	 * @return string The rendered edit action
	 */
	public function editAction($persdataUid) {
		$persdata = $this->persdataRepository->findByUid($persdataUid);
		$this->view->assign('persdata',$persdata);
	}
	
	
	/**
	 * Update Action
	 * 
	 * @param Tx_PtConference_Domain_Model_persdata $persdata
	 * @return string Forwarded to the listAction return value
	 */
	public function updateAction(Tx_PtConference_Domain_Model_persdata $persdata) {
		
		$persdata->setCurrenthash($persdata->generateHash());
		$this->persdataRepository->update($persdata);
		
					
		if(isset($this->settings['persdataListPid'])) {
			$this->redirect('list',NULL,NULL,NULL,$this->settings['persdataListPid']);
		} else {
			$persistenceManager = Tx_Extbase_Dispatcher::getPersistenceManager();
			$persistenceManager->persistAll();
			$this->forward('list');
		}
	}
	
	/**
	 * create action
	 *
	 * @return string The rendered create action
	 */
	public function createAction() {
	}
	
}
?>