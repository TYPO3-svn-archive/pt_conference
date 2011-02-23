<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Daniel Lienert <lienert@punkt.de>, Michael Knoll <knoll@punkt.de>,
*  Christoph Ehscheidt <ehscheidt@punkt.de>
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

class Tx_PtConference_ViewHelpers_CharVotingStarsViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper  {

	/**
	 * Renders the rating starts for a defined column index.
	 * 
	 * @param float $rating
	 * @param int $paper
	 * @param int $link
	 */
	public function render($rating, $paper,$link=0) {
		if(!is_numeric($rating)) $rating = 0;
		if($rating > 5) $rating = 5;
		if($rating < 0) $rating = 0;
		
		
		$content = '';
		$rate = 1;

		
		$full = intval($rating);
		
		for($i=0; $i < $full; $i++) {
			$content .= $this->renderLink('star_full.png',$paper,$rate,$link);
			$rate++;
		}
		
		$half = ($rating - $full) >= 0.5 ? true : false;
		if($half) {
			$content .= $this->renderLink('star_half.png',$paper,$rate,$link);
			$rate++;
		}
		
		
		$rest = 5 - $full;
		if($half) $rest -= 1;
		
		for($i=0; $i < $rest; $i++) {
			$content .= $this->renderLink('star_grey.png',$paper,$rate,$link);
			$rate++;
		}
		
		return $content;
	}
	

	
	public function renderLink($img, $paper, $rate, $link = 0) {
		$path = 'typo3conf/ext/pt_conference/Resources/Public/Icons/';
		$img = '<img width="20" src="'.$path.$img.'" />';
		if($link == 0) return $img;
		
		$uriBuilder = $this->controllerContext->getUriBuilder();
		
		
		$uri = $uriBuilder
			->reset()
			->setNoCache(false)
			->setUseCacheHash(false)	
			->uriFor('vote', array('char' => $paper, 'rating'=>$rate), 'BestCharVoting', 'ptconference');
		
		$link = '<a href="'.$uri.'" >'.$img.'</a>';
			
		return $link;
	}
}

?>