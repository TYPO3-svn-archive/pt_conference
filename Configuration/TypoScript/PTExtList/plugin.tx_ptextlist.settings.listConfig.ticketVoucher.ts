################################################################################
# Ticket Voucher
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
# @since    2010-05-28
################################################################################

plugin.tx_ptextlist.settings.listConfig.ticketVoucher {
	
	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {
		
		baseFromClause (
			tx_ptgsaconfmgm_voucher voucher
			LEFT JOIN tx_ptgsaminidb_ADRESSE address ON address.NUMMER = voucher.gsa_uid
		)
	}
	
	fields {
		
		note {
			table = voucher
			field = is_sentto_cust 	
		}
		
		code {
			table = voucher
			field = code
		}
		
		encashed {
			table = voucher
			field = is_encashed
		}
		
		articles {
			special = CONCAT_WS(', ', (select ARTNR from tx_ptgsaminidb_ARTIKEL where NUMMER IN(voucher.article_confinement)))
		}

		encashCustomer {
			table = address
			field = NAME
		}
	}
	
	pager.itemsPerPage = 40
	
	
	
	columns {
		
		5  {
			fieldIdentifier = code
			columnIdentifier = codeColumn
			label = VoucherCode
		}
		
		10 {
			fieldIdentifier = note
			label = Note
			columnIdentifier = note
		}
		
		30 {
			fieldIdentifier = encashed
			label = Encashed
			columnIdentifier = encashed
		}
		
		35 {
			fieldIdentifier = encashCustomer
			label = Encash Customer
			columnIdentifier = encashCustomer
		}
		
		40 {
			fieldIdentifier = articles
			columnIdentifier = articles
			label = Articles
		}		
	}
	
	
	filters {
		filterBox1 {
			showReset = 0 
			filterConfigs {
				10 < plugin.tx_ptextlist.prototype.filter.string
				10 {
					filterIdentifier = voucherCode
					label = Voucher code
					fieldIdentifier = code
				}
				
				20 < plugin.tx_ptextlist.prototype.filter.string
				20 {
					filterIdentifier = note
					label = Note
					fieldIdentifier = note
				}
				
				30 < plugin.tx_ptextlist.prototype.filter.string
				30 {
					filterIdentifier = encashCustomer
					label = Encash Customer
					fieldIdentifier = encashCustomer
				}
				
				40 < plugin.tx_ptextlist.prototype.filter.select
				40 {
					filterIdentifier = encashed
					label = Is Encashed
					fieldIdentifier = encashed
					
					options {
						1 = Encashed
						0 = Not Encashed
					}
					
					inactiveOption = [Show all]	
					inactiveValue = showAll
					renderObj >
				}
			}
		}
	}
}