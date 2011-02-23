# Standard PersoInfo Table (Has to be defined for specific statistics)
# @version  1.0
# @author   Daniel Lienert <lienert@punkt.de>
# @since    2010-05-28
################################################################################

includeLibs.tx_ptgsaconfmgm_userFuncs = EXT:pt_conference/Classes/Utility/user_Functions.php

plugin.tx_ptextlist.settings.listConfig.persInfoBase {

	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {

		baseFromClause (
			tx_ptgsaminidb_FSCHRIFT
			Inner Join tx_ptgsashop_order_wrappers orderwrappers On orderwrappers.related_doc_no = tx_ptgsaminidb_FSCHRIFT.AUFNR
			Inner Join tx_ptgsashop_orders orders On orderwrappers.orders_id = orders.uid
			Inner Join tx_ptgsashop_orders_articles articles On articles.orders_id = orders.uid
			
			INNER JOIN tx_ptconference_domain_model_persdata persdata on persdata.tx_ptgsashop_orders_articles_uid = articles.uid
			INNER JOIN tx_ptconference_domain_model_event events ON persdata.event = events.uid
			LEFT OUTER JOIN tx_ptconference_domain_model_persarticleinfo_values persvalues ON persvalues.persdata = persdata.uid
			LEFT OUTER JOIN tx_ptconference_domain_model_persarticleinfo_types infotypes ON persvalues.infotype = infotypes.uid
			LEFT OUTER JOIN tx_ptconference_domain_model_persarticleinfo_options infooptions on persvalues.infovalue = infooptions.uid
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
			
				#10 = TEXT
				#10 {
				#	dataWrap = tx_ptgsaminidb_FSCHRIFT.ERFART = '04RE' And (Select Count(FSTORNO.NUMMER) From tx_ptgsaminidb_FSCHRIFT FSTORNO Where FSTORNO.ALTNUMMER = tx_ptgsaminidb_FSCHRIFT.NUMMER) = 0
				#}

				#20 = USER
				#20 {
				#	userFunc = tx_ptgsaconfmgm_userFuncs->getSelectedEvent
				#}
			}
		}
	}

	fields {
		infovalue {
			table = persvalues
			field = infovalue
		}

		infotitle {
			table = infotypes
			field = title
		}

		infooptionstitle {
			table = infooptions
			field = title
		}
	}
  
	columns {

		10 {
			columnIdentifier = infoTypeColumn
			fieldIdentifier = infotitle 
			label = 'InfoTitle'
		}

		20 {
			columnIdentifier = infoValueColumn
			fieldIdentifier = infovalue 
			label = 'InfoValue'
		}

		30 {
			columnIdentifier = infoOptionTitleColumn
			fieldIdentifier = infooptionstitle 
			label = 'InfoOptionsValue'
		}

	}
  
	filters {
	}
}