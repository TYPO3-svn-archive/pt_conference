################################################################################
# Event Selector
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
# @since    2010-05-28
################################################################################


plugin.tx_ptextlist.settings.listConfig.eventSelector {

	############################################################################
	# General settings
	############################################################################

	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {
	
		baseFromClause (
			tx_ptconference_domain_model_event	events
		)
		
		# Comma separated list of typo3 table names
		tables (
			tx_ptconference_domain_model_event events
		)

	}
	
	############################################################################
	# Setting up the data descriptions
	############################################################################

	fields {

		eventCode {
			table = events
			field = code
		}

		eventTitle {
			table = events
			field = title
		}	
	}


	############################################################################
	# Display columns configuration
	############################################################################

	columns {
		5 {
			columnIdentifier = eventCodeColumn
			fieldIdentifier = eventCode
			label = LLL:EXT:pt_conference/locallang.xml:persdata_column_eventCode
		}
	}


	############################################################################
	# Filters configuration
	############################################################################

	filters {

		defaultFilterbox {
			
			showReset = 0
			showSubmit = 0
			
			filterConfigs {
				10 < plugin.tx_ptextlist.prototype.filter.select
				10 {
					filterIdentifier = groupEvent
					submitOnChange = 1
					label = Event
					fieldIdentifier = eventTitle
					filterField = eventCode
					displayFields = eventTitle
					inactiveOption = [Show all]	
					renderObj.dataWrap = {field:eventTitle} 
					showRowCount = 0
				}					
			 }	
		}
	}
}
