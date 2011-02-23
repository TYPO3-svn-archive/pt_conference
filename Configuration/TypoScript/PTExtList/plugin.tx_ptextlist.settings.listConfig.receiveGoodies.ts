# Attendee List
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
################################################################################


plugin.tx_ptextlist.settings.listConfig.receiveGoodies {

	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {
	
		baseFromClause (
			tx_ptconference_domain_model_persdata persdata
			INNER JOIN tx_ptgsashop_orders_articles articles on persdata.tx_ptgsashop_orders_articles_uid = articles.uid,
			tx_ptconference_domain_model_goodies goodies
		)
		
		baseWhereClause (
			FIND_IN_SET(articles.gsa_id_artikel,goodies.gsa_shop_articles)
		)
		
		baseGroupByClause(
			goodies.uid
		)
	}
	
	fields >
	fields {

		ticketCode {
			table = persdata
			field = articlecode
		}
	
		firstName {
			table = persdata
			field = firstname
		}
		
		lastName {
			table = persdata
			field = lastname
		}
				
		goodieName {
			table = goodies
			field = name
		}
		
		goodieDescription {
			table = goodies
			field = description
		}
		
		goodiesCount {
			special = count(*)
		}
		
		attendee {
			special = group_concat(CONCAT_WS(' ',persdata.firstName, persdata.lastName) SEPARATOR ', ')
		}
		
	}
	
	columns {
		
		10 {
			columnIdentifier = count 
			fieldIdentifier = goodiesCount
			label = Count
		}
		
		20 {
			columnIdentifier = typeName
			fieldIdentifier = goodieName
			label = Name
		}
		
		30 {
			columnIdentifier = attendee
			fieldIdentifier = attendee
			label = Attendee
		}
	}
	
	pager.itemsPerPage = 30
	
	filters {
		filterBox1 {
			filterConfigs {
				10 < plugin.tx_ptextlist.prototype.filter.string
				10 {
					filterClassName = Tx_PtConference_ExtList_Filter_TicketScannerFilter
					filterIdentifier = ticketFilter
					label = Name
					fieldIdentifier = ticketCode
					scannerIdentifier = receivegoodies
				}
			}
		}
	}
}



plugin.tx_ptextlist.settings.listConfig.receiveGoodiesShirts {

	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {
	
		baseFromClause (
			tx_ptconference_domain_model_persdata persdata
			INNER JOIN tx_ptconference_domain_model_persarticleinfo_values infovalues ON persdata.uid = infovalues.persdata
			LEFT JOIN tx_ptconference_domain_model_persarticleinfo_options infooptions ON infovalues.infovalue = infooptions.uid
		)
		
		baseWhereClause = TEXT
		baseWhereClause = infovalues.infotype = {$config.pt_conference.tShirtSizeInfoType}
		
		baseGroupByClause(
			infovalues.infovalue
		)
	}
	
	fields >
	fields {
		persdatauid {
			table = persdata
			field = uid
		}
	
		ticketCode {
			table = persdata
			field = articlecode
		}
	
		firstName {
			table = persdata
			field = firstname
		}
		
		lastName {
			table = persdata
			field = lastname
		}
		
		shirtSize {
			table = infooptions
			field = title
		}
		
		shirtCount {
			special = count(*)
		}
		
		attendee {
			special = group_concat(CONCAT_WS(' ',persdata.firstName, persdata.lastName) SEPARATOR ', ')
		}
		
	}
	
	columns {
		
		10 {
			columnIdentifier = count 
			fieldIdentifier = shirtCount
			label = Count
		}
		
		20 {
			columnIdentifier = typeName
			fieldIdentifier = shirtSize
			label = Size
		}
		
		30 {
			columnIdentifier = attendee
			fieldIdentifier = attendee
			label = Attendee
		}
	}
	
	pager.itemsPerPage = 30
	
	filters {
		filterBox1 {
			filterConfigs {
				10 < plugin.tx_ptextlist.prototype.filter.string
				10 {
					filterClassName = Tx_PtConference_ExtList_Filter_TicketScannerFilter
					filterIdentifier = ticketFilter
					label = Name
					fieldIdentifier = ticketCode
					scannerIdentifier = receivegoodies
				}
			}
		}
	}
}



plugin.tx_ptextlist.settings.listConfig.receiveGoodiesArticles {

	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {
	
		baseFromClause (
			tx_ptconference_domain_model_persdata persdata
			INNER JOIN tx_ptgsaminidb_FPOS fpos ON persdata.tx_ptgsashop_customer_uid = fpos.ADRINR
			INNER JOIN tx_ptgsacategories_cat_art_rel artrel on fpos.ARTINR = artrel.art_uid
		)
		
		baseWhereClause (
			artrel.cat_uid = 5
			AND fpos.GUTSCHRIFT = 0
			AND (SELECT COUNT(*) as alreadyCheckedInCount FROM tx_ptconference_domain_model_persdata innerPersData where innerPersData.tx_ptgsashop_customer_uid = persdata.tx_ptgsashop_customer_uid AND goodiesreceived = 1) = 0
		)
		
		baseGroupByClause(
			fpos.ARTINR 	
		)
	}
	
	fields >
	fields {
		persdatauid {
			table = persdata
			field = uid
		}
	
		ticketCode {
			table = persdata
			field = articlecode
		}
	
		firstName {
			table = persdata
			field = firstname
		}
		
		lastName {
			table = persdata
			field = lastname
		}
		
		goodieName {
			table = fpos
			field = ARTNR
		}
	
		goodiesCount {
			special = count(*)
		}
		
		attendee {
			special = group_concat(CONCAT_WS(' ',persdata.firstName, persdata.lastName) SEPARATOR ', ')
		}
		
	}
	
	columns {
		
		10 {
			columnIdentifier = count 
			fieldIdentifier = goodiesCount
			label = Count
		}
		
		20 {
			columnIdentifier = typeName
			fieldIdentifier = goodieName
			label = Name
		}
		
		30 {
			columnIdentifier = attendee
			fieldIdentifier = attendee
			label = Attendee
		}
	}
	
	pager.itemsPerPage = 30
	
	filters {
		filterBox1 {
			filterConfigs {
				10 < plugin.tx_ptextlist.prototype.filter.string
				10 {
					filterClassName = Tx_PtConference_ExtList_Filter_TicketScannerFilter
					filterIdentifier = ticketFilter
					label = Name
					fieldIdentifier = ticketCode
					scannerIdentifier = receivegoodies
				}
			}
		}
	}
}