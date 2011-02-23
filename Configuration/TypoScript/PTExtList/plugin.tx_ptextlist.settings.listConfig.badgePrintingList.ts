# Attendee List
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
################################################################################

plugin.tx_ptextlist.settings.listConfig.badgePrintingList {
	
	controller.List {
		list {
			template = EXT:pt_conference/Resources/Private/Templates/ExtList/List/BadgePrinting.html
		}
	}

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
				
				#10 = TEXT
				#10 {
				#	dataWrap = And (Select Count(FSTORNO.NUMMER) From tx_ptgsaminidb_FSCHRIFT FSTORNO Where FSTORNO.ALTNUMMER = tx_ptgsaminidb_FSCHRIFT.NUMMER) = 0
				#}

				#20 = USER
				#20 {
				#	userFunc = tx_ptgsaconfmgm_userFuncs->getSelectedEvent
				#}
			}
		}
	}
	
	fields {
		
		persDataUid {
			table = persdata
			field = uid
		}
	
		persdatauid {
			table = persdata
			field = uid
		}
	
		firstName {
			table = persdata
			field = firstname
		}
		
		middleName {
			table = persdata
			field = middlename
		}
		
		
		lastName {
			table = persdata
			field = lastname
		}
		
		company {
			table = persdata
			field = company
		}
		
		country {
			special ( 
				if(persdata.country <> '',persdata.country, (
					select countries.cn_short_en from static_countries countries
					INNER JOIN tx_ptgsaminidb_px_laender laender on laender.weblkz = countries.cn_tldomain
					INNER JOIN tx_ptgsaminidb_ADRESSE adresse on adresse.land = laender.kuerzel where adresse.NUMMER = persdata.tx_ptgsashop_customer_uid
					limit 0,1))
			)
		}
		
		email {
			table = persdata
			field = email
		}
		
		jobstatus {
			table = persdata
			field = jobstatus
		}
		
		badgePrintedDate {
			special = if(persdata.badgeprinted > 0, FROM_UNIXTIME(persdata.badgeprinted,'%Y-%d-%m %H:%i'), 'Not printed')
		}
		
		badgePrinted {
			special = if(persdata.badgeprinted > 0, if(persdata.currenthash != persdata.printedhash,2,1),0)
		}
		
		ticket {
			table = articles
			field = art_no
		}
		
		checkedIn {
			table = persdata
			field = checkedin
		}
		
		tutorial {
			special ( 
				SELECT art_no FROM `tx_ptconference_domain_model_relarticle` relarticle 
				INNER JOIN tx_ptgsashop_orders_articles articles on articles.uid = `tx_ptgsashop_orders_articles_uid` 
				WHERE relarticle.persdata = persdata.uid 
				GROUP BY persdata.uid 
				LIMIT 0,1
			)
		}
		
		invoiceNo {
			table = orderwrappers
			field = related_doc_no
		}
		
		articlecode {
			table = persdata
			field = articlecode
		}
		
		country {
			table = persdata
			field = country
		}
	}
	
	columns >
	columns {
		
		 5{
			columnIdentifier = articleCodeColumn
			fieldIdentifier = articlecode
			label = Ticket Code
		  }
		
		10 {
			columnIdentifier = companyColumn
			fieldIdentifier = company 
			label = Company
			sorting = company, lastName, firstName
		}
		
		20 {
			columnIdentifier = nameColumn
			fieldIdentifier = lastName, firstName
			label = Name
			renderObj = TEXT
			renderObj.dataWrap = {field:firstName} {field:middleName} {field:lastName}
		}

		25 {
			columnIdentifier = country
			fieldIdentifier = country
			label = Country
		}		
		
		30 {
			columnIdentifier = ticket
			fieldIdentifier = ticket 
			label = Ticket
		}
		
		40 {
			columnIdentifier = tutorial 
			fieldIdentifier = tutorial
			label = Tutorial
		}
		
		
		50 {
			columnIdentifier = printedColumn
			label = Printed
			fieldIdentifier = badgePrintedDate
		}
	}
		
	
	pager.itemsPerPage = 0
	
	filters {
		filterBox1 {
			showReset = 0 
			filterConfigs {		
				10 < plugin.tx_ptextlist.prototype.filter.select
				10 {
					filterIdentifier = badgePrintedFilter
					label = Printed state
					fieldIdentifier = badgePrinted
					inactiveOption = [Show all]	
					inactiveValue = showAll
					options {
						0 = Not printed
						1 = Already printed
						2 = Updated since print
					}
					renderObj >
				}
				
				20 < plugin.tx_ptextlist.prototype.filter.select
				20 {
					filterIdentifier = exportsFilter
					label = Exports
					fieldIdentifier = badgePrintedDate
					inactiveOption = [Show all]	
					inactiveValue = showAll
					excludeFilters = filterBox1.badgePrintedFilter
				}

				30 < plugin.tx_ptextlist.prototype.filter.select
				30 {
					filterIdentifier = checkedInFilter
					label = Checked In
					fieldIdentifier = checkedIn
					inactiveOption = [Show all]	
					inactiveValue = showAll
					options {
						0 = Not checked in
						1 = Checked in
					}
					renderObj >
				}				
			}
		}
	}
}


plugin.tx_ptextlist.settings.listConfig.badgePrintingListExportList < plugin.tx_ptextlist.settings.listConfig.badgePrintingList
plugin.tx_ptextlist.settings.listConfig.badgePrintingListExportList {
	
	pager.itemsPerPage = 0
	
	columns {
		
		40 {
			columnIdentifier = tutorial 
			fieldIdentifier = tutorial,ticket
			label = Tutorial
			
			renderObj = COA
			renderObj {
				10 = TEXT
				10.data = field:ticket
				10.if {
					isFalse.field = tutorial
				}
				
				20 = TEXT
				20.data = field:tutorial
				20.if {
					isTrue.field = tutorial
				}
			}
		}
		
		100 {
			columnIdentifier = jobstatus
			fieldIdentifier = jobstatus
		}
		
		120 {
			columnIdentifier = country
			fieldIdentifier = country
		}
	}
}