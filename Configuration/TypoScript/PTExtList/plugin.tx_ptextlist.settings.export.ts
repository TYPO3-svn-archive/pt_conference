# Export Settings
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
################################################################################

plugin.tx_ptextlist.settings.export {
	exportConfigs {
		
		badgeExport < plugin.tx_ptextlist.prototype.export
		badgeExport {
			viewClassName = Tx_PtConference_ExtList_View_BadgeExportView
			fileExtension = inc			
			templatePath = typo3conf/ext/pt_conference/Resources/Private/Templates/ExtList/Export/export.html

			dateFormat = Y-m_d-H-i
		}
	}
	
}