################################################################################
# Configuration for Article List
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
# @since    2010-07-07
################################################################################

plugin.tx_ptextlist.settings.listConfig.purchasedTickets  {
	
	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
	backendConfig {
		baseFromClause (
			tx_ptgsaminidb_FSCHRIFT
			Inner Join tx_ptgsashop_order_wrappers orderwrappers On orderwrappers.related_doc_no = tx_ptgsaminidb_FSCHRIFT.AUFNR
			Inner Join tx_ptgsashop_orders orders On orderwrappers.orders_id = orders.uid
			Inner Join tx_ptgsashop_orders_articles articles On articles.orders_id = orders.uid

			INNER JOIN tx_ptconference_domain_model_persdata persdata on persdata.tx_ptgsashop_orders_articles_uid = articles.uid
			INNER JOIN tx_ptconference_domain_model_event events ON persdata.event = events.uid
		)

		baseWhereClause = TEXT
		baseWhereClause {
			cObject = COA
			cObject {
				
			5 = TEXT
			5.value (
					tx_ptgsaminidb_FSCHRIFT.ERFART = '04RE' 
					AND (tx_ptgsaminidb_FSCHRIFT.GUTSUMME = 0 OR tx_ptgsaminidb_FSCHRIFT.GUTSUMME != tx_ptgsaminidb_FSCHRIFT.ENDPRB)
					)
			
			#	10 = TEXT
			#	10 {
			#		dataWrap = tx_ptgsaminidb_FSCHRIFT.ERFART = '04RE' And (Select Count(FSTORNO.NUMMER) From tx_ptgsaminidb_FSCHRIFT FSTORNO Where FSTORNO.ALTAUFNR = tx_ptgsaminidb_FSCHRIFT.AUFNR) = 0
			#	}
			}

			#20 = USER
			#20 {
			#	userFunc = tx_ptgsaconfmgm_userFuncs->getSelectedEvent
			#}
		}
		
		baseGroupByClause (
			articles.art_no
		)
	}
  

	fields {
		artNo {
			field = art_no
			table = articles
		}

		artDescription {
			field = description
			table = articles
		}

		artCount {
			special =  count(articles.quantity)
		}
	}

	columns {
		10 {
			columnIdentifier = artnoColumn
			fieldIdentifier = artNo
			label = 'Article No'
		}

		20 {
			columnIdentifier = artDescriptionColumn
			fieldIdentifier = artDescription
			label = 'Description'
		}

		30 {
			columnIdentifier = artCountColumn
			fieldIdentifier = artCount
			label = 'Count'
		}
	}
	
	aggregateData {
		ticketsTotalSum {
			fieldIdentifier = artCount
			method = sum
		}
	}
	
	aggregateRows {
		10 {
			artDescriptionColumn {
				aggregateDataIdentifier = ticketsTotalSum
				renderObj = TEXT
				renderObj.value = Total:
			}
			
			artCountColumn {
				aggregateDataIdentifier = ticketsTotalSum
			}
		}
	}
}