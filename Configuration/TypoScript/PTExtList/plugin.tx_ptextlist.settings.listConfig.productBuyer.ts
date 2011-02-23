# Attendee List
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
################################################################################


plugin.tx_ptextlist.settings.listConfig.productBuyer < plugin.tx_ptextlist.settings.listConfig.invoices
plugin.tx_ptextlist.settings.listConfig.productBuyer {
    
    backendConfig {
		
		baseGroupByClause (
			fschrift.NUMMER, articles.art_no
		)
	}
	
	fields {
		product {
			table = articles 
			field = art_no
		}
		
		productsInInvoice {
			special = GROUP_CONCAT(articles.art_no SEPARATOR  '<br />')
		}
	}


	columns {
		40 >
		50 > 
		60 >
		
		100 {
			columnIdentifier = products
			fieldIdentifier = productsInInvoice
			label = Products
		}
	}
  
	pager.itemsPerPage = 30
  
  	aggregateData >
	aggregateRows >
  
	filters {
		filterbox1 {
			filterConfigs {
				
				25 >
				
				100 < plugin.tx_ptextlist.prototype.filter.select
				100 {
					label = Products
					fieldIdentifier = product
					filterIdentifier = product
					inactiveOption = [Show All]
				}
			}
		}
	}
}



plugin.tx_ptextlist.settings.listConfig.productBuyerExport < plugin.tx_ptextlist.settings.listConfig.productBuyer
plugin.tx_ptextlist.settings.listConfig.productBuyerExport {
	
	fields {
		
		productsInInvoice {
			special = GROUP_CONCAT(articles.art_no SEPARATOR  ',')
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
			columnIdentifier = emailColumn
			fieldIdentifier = email
			label = Customer eMail 
		}
		
		30 {
			renderUserFunctions >
			renderObj >
		}
	}
	
	aggregateData >
	aggregateRows >
	
	pager.itemsPerPage = 0
}