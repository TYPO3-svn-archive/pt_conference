################################################################################
# Invoices List
# @author   Daniel Lienert <lienert@punkt.de>
# @since    2010-05-28
################################################################################

config.spamProtectEmailAddresses = 0

plugin.tx_ptextlist.settings.listConfig.invoices {
	
	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {
	
		baseFromClause (
			tx_ptgsaminidb_FSCHRIFT fschrift
			INNER JOIN tx_ptgsashop_order_wrappers wrappers on wrappers.related_doc_no = fschrift.AUFNR
			INNER JOIN tx_ptgsaminidb_ADRESSE address on wrappers.customer_id = address.Nummer
			INNER JOIN tx_ptgsashop_orders_articles articles on articles.orders_id = wrappers.orders_id
			LEFT JOIN tx_ptconference_domain_model_persdata persdata on persdata.tx_ptgsashop_orders_articles_uid = articles.uid
		)

		baseWhereClause (
			fschrift.ERFART = "04RE"
		)
		
		baseGroupByClause (
			fschrift.NUMMER
		)
	}
    
	fields {
		invoiceDate {
			table = fschrift
			field = DATUM
		}

		invoiceNo {
			table = fschrift
			field = AUFNR
		}

		company {
			table = fschrift
			field = NAME
		}

		attendeeEmail {
			special = GROUP_CONCAT(persdata.email SEPARATOR ';')
		}
		
		sumGross{
			special = FORMAT(fschrift.ENDPRB,2)
		}
		
		sumPaid {
			special = FORMAT(fschrift.BEZSUMME,2)
		}
		
		sumCancled {
			special = FORMAT(fschrift.GUTSUMME,2)
		}
		
		sumOpen {
			special = FORMAT(fschrift.ENDPRB - (fschrift.BEZSUMME + fschrift.GUTSUMME),2)
		}
		
		email {
			table = address
			field = EMAIL1
		}
		
		storno {
			special = IFNULL((SELECT NUMMER from tx_ptgsaminidb_FSCHRIFT fschriftstorno WHERE ERFART = "06ST" AND fschriftstorno.ALTAUFNR = fschrift.AUFNR Limit 0,1),0)
		}
	}


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
			columnIdentifier = invoiceDateColumn
			fieldIdentifier = invoiceDate
			label = Invoice Date
		}

		20 {
			columnIdentifier = companyColumn
			fieldIdentifier = company, email
			label = Company
			
			renderObj = COA
			renderObj {
				10 = TEXT
				10.data = field:company
				10.wrap = | <br />
				
				20 = TEXT
				20.data = field:email
				20.typolink.parameter.dataWrap = {field:email}

			}
		}

		30 {
			columnIdentifier = invoiceNoColumn
			fieldIdentifier = invoiceNo 
			label = Invoice Number	

			renderUserFunctions {
				10 = EXT:pt_conference/Classes/Utility/Tx_PtConference_Utility_RenderUserFunctions.php:user_Tx_PtConference_Utility_UserFunctions->getInvoicePDFLink
			}

			renderObj = TEXT
			renderObj {
				dataWrap = <a href="|">{field:invoiceNo}</a>
				current = 1
			}
		}

		40 {
			columnIdentifier = sumGrossColumn
			fieldIdentifier = sumGross 
			label = Sum Gross
		}
		
		50 {
			columnIdentifier = sumPaidColumn
			fieldIdentifier = sumPaid
			label = Paid Gross
		}
		
		55 {
			columnIdentifier = sumCancledColumn
			fieldIdentifier = sumCancled
			label = Cancled Gross
		}
		
		60 {
			columnIdentifier = sumOpenColumn
			fieldIdentifier = sumOpen
			label = Open Gross
		}
		
	}
  
	pager.itemsPerPage = 30
  
	filters {
		filterbox1 {
			showReset = 0

			filterConfigs {
				10 < plugin.tx_ptextlist.prototype.filter.string
				10 {
					filterIdentifier = companySearch
					label = Company
					fieldIdentifier = company
					submitValue =  Set
				}
				
				20 < plugin.tx_ptextlist.prototype.filter.string
				20 {
					filterIdentifier = invoiceSearch
					label = Invoicec No
					fieldIdentifier = invoiceNo
					submitValue = Set		
				}
				
				25 < plugin.tx_ptextlist.prototype.filter.select
				25 {
					filterClassName = Tx_PtConference_ExtList_Filter_InvoiceByCheckedInFilter
					filterIdentifier = anyOfThisInvoiceCheckedin 
					label = Checked In
					fieldIdentifier = invoiceNo 
					options {
						checkedin = Someone Checked in 
						noonecheckedin = Noone Checked In
					}

					inactiveOption = [Show All]
					renderObj >		
				}
				
				30 < plugin.tx_ptextlist.prototype.filter.select
				30 {
					filterClassName = Tx_PtConference_ExtList_Filter_InvoiceFilter
					filterIdentifier = invoiceFilter
					label = Payment
					fieldIdentifier = invoiceNo
					options {
						outstanding = Outstanding
						paid = Paid
						partlyPaid = Complete or partly paid
						canceled = Complete Canceled
						partlyCanceled = Complete or partly cancled
					}
					
					renderObj >
					inactiveOption = [Show All]
				}
			}
		}
	}
	
	aggregateData {
		sumGross {
			fieldIdentifier = sumGross
			method = sum
		}
		
		sumPaid {
			fieldIdentifier = sumPaid
			method = sum
		}
		
		sumOpen {
			fieldIdentifier = sumOpen
			method = sum
		}
		
		sumCancled {
			fieldIdentifier = sumCancled
			method = sum
		}
	}
	
	aggregateRows {
		10 {
			invoiceNoColumn {
				aggregateDataIdentifier = sumPaid
				renderObj = TEXT
				renderObj.value = Total:
			}
			
			sumGrossColumn {
				aggregateDataIdentifier = sumGross
			}
			
			sumPaidColumn {
				aggregateDataIdentifier = sumPaid
			}
			
			sumCancledColumn {
				aggregateDataIdentifier = sumCancled
			}
			
			sumOpenColumn {
				aggregateDataIdentifier = sumOpen
			}
		}
	}
}



plugin.tx_ptextlist.settings.listConfig.invoicesExport < plugin.tx_ptextlist.settings.listConfig.invoices
plugin.tx_ptextlist.settings.listConfig.invoicesExport {
	
	fields {
		
		sumNET{
			special = FORMAT(fschrift.ENDPRN,2)
		}
		
		street {
			table = address
			field = STRASSE
		}
		
		zip {
			table = address
			field = PLZ
		}
		
		city {
			table = address
			field = ORT
		}

		country {
			table = address
			field = LAND
		}
	}
	
	
	
	
	columns {
		5 {
			renderObj = COA
			renderObj {
				
				5 = TEXT
				5.wrap = STORNO
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
					10.value = PAID
					10.if {
						value.data = field:sumOpen
						equals = 0
					}

						
					20 = TEXT
					20.wrap = OPEN
					20.if {
						value.data = field:sumOpen
						isLessThan = 1
					}
				}
			}
		}
		
		20 {	
			columnIdentifier = companyColumn
			fieldIdentifier = company
			label = Company
			renderObj >
		}
		
		21 {	
			columnIdentifier = streeColumn
			fieldIdentifier = street
			label = Street
		}
		
		22 {	
			columnIdentifier = zipColumn
			fieldIdentifier = zip
			label = Zip
		}
		
		23 {	
			columnIdentifier = cityColumn
			fieldIdentifier = city
			label = City
		}
		
		24 {	
			columnIdentifier = countryColumn
			fieldIdentifier = country
			label = Country
		}
		
		26 {	
			columnIdentifier = emailColumn
			fieldIdentifier = email
			label = Customer eMail 
		}
		
		27 {	
			columnIdentifier = attendeeEmailColumn
			fieldIdentifier = attendeeEmail
			label = Attendee eMail 
		}
		
		30 {
			renderUserFunctions >
			renderObj >
		}
		
		41 {
			columnIdentifier = sumNetColumn
			fieldIdentifier = sumNET
			label = Sum Net
		}
	}
	
	pager.itemsPerPage = 0
}