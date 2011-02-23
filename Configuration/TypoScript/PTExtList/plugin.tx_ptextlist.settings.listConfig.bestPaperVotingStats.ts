# BestPaperVotingStats
# @version  $Id:$
# @author   Christoph Ehscheidt <ehscheidt@punkt.de>
################################################################################

plugin.tx_ptextlist.settings {

    listConfig.bestPaperVotingStats {
    
    	#controller.List.list.template = EXT:pt_conference/Resources/Private/Templates/bestPaperVoting/list.html
    
        backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
        backendConfig {
            
            tables (
                paper,
                voting
            )

            baseFromClause = TEXT
			baseFromClause {
				cObject = COA
				cObject {
					10 = TEXT
					10.value (
						tx_ptconference_domain_model_paper AS paper
						LEFT JOIN tx_ptconference_domain_model_bestpapervoting AS voting
							ON paper.uid = voting.paper
							AND voting.hidden = 0
							AND voting.deleted = 0
					)
					
				}
			}
            
            baseWhereClause (
          		paper.hidden = 0 
          		AND paper.deleted = 0
            )
            
            baseGroupByClause (
            	paper.uid
            ) 
        }

        fields {
        	paper {
        		table = paper
        		field = uid
        	}
        
            title {
                table = paper
                field = title
            }
            
            author {
                 table = paper
                 field = author
            }
            
            votes {
            	special = IF(COUNT(voting.rating) > 0, SUM(voting.rating)/COUNT(voting.rating), 0)
            }
            
            voteCount {
            	special = COUNT(voting.rating)
            }
        }
        
        columns {
                
            10 {
                  fieldIdentifier = title
                  columnIdentifier = title
                  label = Title
            }
            
            20 {
                fieldIdentifier = author
                columnIdentifier = author
                label = Author
            }
            
            30 {
                fieldIdentifier = votes, paper
                columnIdentifier = votes
                label = Rating
				renderTemplate = EXT:pt_conference/Resources/Private/Partials/ExtList/BestPaperVotingStats.html
            }
            
            35 {
           		fieldIdentifier = votes
                columnIdentifier = votes2
                label = Rating
            }
            
            40 {
            	fieldIdentifier = voteCount
                columnIdentifier = voteCount
                label = Votes
            }
        }
        
        filters {
            filterBox1 {
	        	filterConfigs {
	              10 < plugin.tx_ptextlist.prototype.filter.string 
	              10 {
	                  filterIdentifier = author
	                  label = Author
	                  fieldIdentifier = author
	              }
	              20 < plugin.tx_ptextlist.prototype.filter.string 
	              20 {
	                  filterIdentifier = title
	                  label = Title
	                  fieldIdentifier = title
	              }
	            }
	        }
        }
        
        pager {
            itemsPerPage = 30
        }
          
    }
}
