################################################################################
# TShirtStatistics
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
# @since    2010-05-28
################################################################################
plugin.tx_ptextlist.settings.listConfig.shirtSizeStats  < plugin.tx_ptextlist.settings.listConfig.persInfoBase
plugin.tx_ptextlist.settings.listConfig.shirtSizeStats {
	
    backendConfig {

		baseWhereClause.cObject.30 = TEXT
		baseWhereClause.cObject.30 {
			noTrimWrap = | and persvalues.infotype = 1 |
		}
	
		baseGroupByClause (
			persvalues.infovalue
		)
	}
	
	fields {
		shirtSizeSum {
			special = count(persvalues.uid)
		}
	}
	
	columns >
	columns {
		10 {
			columnIdentifier = infoOptionTitleColumn
			fieldIdentifier = infooptionstitle 
			label = 'Shirt Size'
			
			renderObj = COA
			renderObj {
				10 = TEXT
				10 {
					data = field:infooptionstitle
					if.isTrue.data = field:infooptionstitle
				}
				
				20 = TEXT
				20 {
					value = [Not Specified]
					if.isFalse.data = field:infooptionstitle
				}
				
			}
			
		}
		
		20 {
			columnIdentifier = shirtSizeSumColumn
			fieldIdentifier = shirtSizeSum 
			label = 'Count'
		}	
	}
	
	aggregateData {
		shirtsTotalSum {
			fieldIdentifier = shirtSizeSum
			method = sum
		}
	}
	
	aggregateRows {
		10 {
			infoOptionTitleColumn {
				aggregateDataIdentifier = shirtsTotalSum
				renderObj = TEXT
				renderObj.value = Total:
			}
			
			shirtSizeSumColumn {
				aggregateDataIdentifier = shirtsTotalSum
			}
		}
	}
}