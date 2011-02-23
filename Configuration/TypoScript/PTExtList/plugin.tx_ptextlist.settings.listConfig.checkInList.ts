# Attendee List
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
################################################################################


plugin.tx_ptextlist.settings.listConfig.checkInList {

	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {
	
		baseFromClause (
			tx_ptgsaminidb_FSCHRIFT fschrift
			INNER JOIN tx_ptgsaminidb_ADRESSE adresse on adresse.NUMMER = fschrift.ADRINR 
			Inner Join tx_ptgsashop_order_wrappers orderwrappers On orderwrappers.related_doc_no = fschrift.AUFNR
			Inner Join tx_ptgsashop_orders orders On orderwrappers.orders_id = orders.uid
			Inner Join tx_ptgsashop_orders_articles articles On articles.orders_id = orders.uid
			
			INNER JOIN tx_ptconference_domain_model_persdata persdata on persdata.tx_ptgsashop_orders_articles_uid = articles.uid
			INNER JOIN tx_ptconference_domain_model_event events ON persdata.event = events.uid
		)
	
		baseGroupByClause (	
			fschrift.NUMMER
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
			expandGroupRows = 1
		}
	
		articleArtNo {
			table = articles
			field = art_no
		}
	
		firstName {
			table = persdata
			field = firstname
			expandGroupRows = 1
		}
		
		lastName {
			table = persdata
			field = lastname
			expandGroupRows = 1
		}
		
		company {
			table = adresse
			field = MATCH
		}
		
		email {
			table = persdata
			field = email
		}
		
		invoiceNo {
			table = orderwrappers
			field = related_doc_no
		}
		
		invoiceDate {
			special = FROM_UNIXTIME(orderwrappers.order_timestamp,'%Y-%d-%m %H:%i')
		}
		
		sumGross{
			special = FORMAT(fschrift.ENDPRB,2)
		}
		
		sumPaid {
			special = FORMAT(fschrift.BEZSUMME,2)
		}
		
		sumOpen {
			special = FORMAT(fschrift.ENDPRB - (fschrift.BEZSUMME + fschrift.GUTSUMME),2)
		}
		
		sumStorno {
			special = FORMAT(fschrift.GUTSUMME,2)
		}
		
		storno {
			special = IFNULL((SELECT NUMMER from tx_ptgsaminidb_FSCHRIFT fschriftstorno WHERE ERFART = "06ST" AND fschriftstorno.ALTAUFNR = fschrift.AUFNR limit 0,1),0)
		}
		
		onThisInvoice {
			special (
				SELECT GROUP_CONCAT(CONCAT_WS(' ',otiPersdata.firstname, otiPersdata.lastname) SEPARATOR '<br />')
				FROM tx_ptconference_domain_model_persdata otiPersdata 
				INNER JOIN tx_ptgsashop_orders_articles otiArticles on otiPersdata.tx_ptgsashop_orders_articles_uid = otiArticles.uid 
				WHERE otiArticles.orders_id = orders.uid
				AND otiPersdata.uid != persdata.uid
			)
		}
	}
	
	columns >
	columns {
		
		5 {
			columnIdentifier = paymentIndicatorColumn
			fieldIdentifier = sumGross, sumOpen, storno
			label = P
			isSortable = 0
			
			renderObj = TEST
			renderObj {
			}
			
			cellCSSClass {
				renderObj = COA
				renderObj {
					
					5 = TEXT
					5.wrap = grayBox
					5.if {
						value.data = field:storno
						isLessThan = 0
					}
					
					10 = COA
					10 {
						if {
							value.data = field:storno
							isLessThan = 0
							negate = 1
						}
						
						10 = TEXT
						10.value = greenBox
						10.if {
							value.data = field:sumOpen
							equals = 0
						}

							
						20 = TEXT
						20.wrap = redBox
						20.if {
							value.data = field:sumOpen
							isLessThan = 1
						}
					}
				}
			}
		}
		
		10 {
			columnIdentifier = invoiceNoColumn
			fieldIdentifier = invoiceNo, company, invoiceDate
			label = Invoice Number	

			renderUserFunctions {
				10 = EXT:pt_conference/Classes/Utility/Tx_PtConference_Utility_RenderUserFunctions.php:user_Tx_PtConference_Utility_UserFunctions->getInvoicePDFLink
			}

			renderObj = TEXT
			renderObj {
				dataWrap = <b>{field:company}</b><br /><a href="|">{field:invoiceNo}</a><br />{field:invoiceDate}
				current = 1
			}
		}
		
		30 {
			columnIdentifier = attendeInformation
			fieldIdentifier = ticketCode, firstName, lastName, articleArtNo
			label = Attendee Information
			renderTemplate = typo3conf/ext/pt_conference/Resources/Private/Partials/ExtList/CheckinAttendeeInformation.html
		}
		
		35 {
			columnIdentifier = onThisInvoice
			fieldIdentifier = onThisInvoice
			label = Also on this invoice
		}
		
		40 {
			columnIdentifier = paymentStatus
			fieldIdentifier = sumGross, sumPaid, sumOpen, storno , sumStorno
			label = Payment state
			
			renderObj = TEXT
			renderObj {
				dataWrap = Gross: {field:sumGross}<br /> Canc.: {field:sumStorno}<br /> Paid: {field:sumPaid}<br />Open: <span style="font-weight:bold; font-size:2em">{field:sumOpen}</span>
				current = 1
			}
			
			cellCSSClass {
				renderObj = COA
				renderObj {
					
					5 = TEXT
					5.wrap = grayBox
					5.if {
						value.data = field:storno
						isLessThan = 0
					}
					
					10 = COA
					10 {
						if {
							value.data = field:storno
							isLessThan = 0
							negate = 1
						}
						
						10 = TEXT
						10.value = greenBox
						10.if {
							value.data = field:sumOpen
							equals = 0
						}

							
						20 = TEXT
						20.wrap = redBox
						20.if {
							value.data = field:sumOpen
							isLessThan = 1
						}
					}
				}
			}
		}
		
	}
	
	# list sorting with GUI columns
	defaults {
		sortingColumn = invoiceColumn
		sortingDirection = ASC
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
					scannerIdentifier = checkin
				}
			}
		}
	}
}