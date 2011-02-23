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
 * Viewhelper for translated flash message
 *
 * @package pt_conference
 * @subpackage ViewHelpers
 * @author Daniel Lienert <lienert@punkt.de>
 */
class Tx_PtConference_ViewHelpers_TranslatedFlashMessagesViewHelper extends Tx_Fluid_ViewHelpers_FlashMessagesViewHelper {
	
	/**
	 * Render method.
	 *
	 * @return string rendered Flash Messages, if there are any.
	 */
	public function render() {
		
		$flashMessages = $this->controllerContext->getFlashMessageContainer()->getAllAndFlush();
		$this->controllerContext->getFlashMessageContainer()->persist();
		
		$translateViewHelper = new Tx_Fluid_ViewHelpers_TranslateViewHelper();
		$translateViewHelper->setControllerContext($this->controllerContext);
		
		if (count($flashMessages) > 0) {
			$tagContent = '';
			
			foreach ($flashMessages as $singleFlashMessage) {
				
				$translatedFlashMessage = $translateViewHelper->render($singleFlashMessage, $singleFlashMessage);
				
				$tagContent .=  sprintf('<div class="%sMessage">%s</div>', substr(array_pop(explode('.',$singleFlashMessage)),0,3), htmlspecialchars($translatedFlashMessage));
			}
			
			$this->tag->setContent($tagContent);
			return $this->tag->render();
		}
		return '';
	}	
}
?>