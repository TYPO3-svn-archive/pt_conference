# BestPaperVoting
# @version  $Id:$
# @author   Christoph Ehscheidt <ehscheidt@punkt.de>
################################################################################

plugin.tx_ptextlist.settings.listConfig.bestCharVoting < plugin.tx_ptextlist.settings.listConfig.bestCharVotingStats
plugin.tx_ptextlist.settings.listConfig.bestCharVoting {
        backendConfig {
            
           
			baseFromClause {
				cObject {
					
					19 = TEXT
					19.noTrimWrap = | |
					20 = TEXT
					20.dataWrap = AND voting.attendee = {TSFE:fe_user|user|uid}
				}
			}
     
     		#baseGroupByClause >
        }

        fields {

        }
        
        columns {
        	20 >
         	30.renderTemplate = EXT:pt_conference/Resources/Private/Partials/ExtList/BestCharVoting.html
         	35 >
        	40 >
        }
        
        filters {
            
        }
        
        pager {
            itemsPerPage = 15
        }
          
}
