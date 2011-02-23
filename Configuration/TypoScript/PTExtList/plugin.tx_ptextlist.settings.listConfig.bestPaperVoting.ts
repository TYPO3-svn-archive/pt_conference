# BestPaperVoting
# @version  $Id:$
# @author   Christoph Ehscheidt <ehscheidt@punkt.de>
################################################################################

plugin.tx_ptextlist.settings.listConfig.bestPaperVoting < plugin.tx_ptextlist.settings.listConfig.bestPaperVotingStats
plugin.tx_ptextlist.settings.listConfig.bestPaperVoting {
        backendConfig {
            
           
			baseFromClause {
				cObject {

					20 = TEXT
					20.dataWrap = AND voting.attendee = {TSFE:fe_user|user|uid}
				}
			}
     
     		#baseGroupByClause >
        }

        fields {

        }
        
        columns {
         	30.renderTemplate = EXT:pt_conference/Resources/Private/Partials/ExtList/BestPaperVoting.html
         	35 >
        	40 >
        }
        
        filters {
            
        }
        
        pager {
            itemsPerPage = 30
        }
          
}
