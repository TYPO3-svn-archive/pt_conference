################################################################################
# TShirtStatistics
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
# @since    2010-05-28
################################################################################
plugin.tx_ptextlist.settings.listConfig.voucherStats {
	
	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {
		
		baseFromClause (
			tx_ptgsavoucher_voucher voucher
			LEFT JOIN tx_ptgsavoucher_voucher_encash encash on encash.voucher_uid = voucher.uid
		)
	
		baseGroupByClause (
			voucher.uid
		)
	}
	
	fields {
		
		multi {
			table = voucher
			field = type
		}
		
		code {
			table = voucher
			field = code
		}
		
		voucherType {
			table = voucher
			field = is_percent
		}
		
		voucherTypeName {
			special = if(is_percent = 1, 'Percent','Absolute')
		}
		
		amount {
			table = voucher
			field = amount
		}
		
		encashedAmount {
			special = IFNULL(sum(encash.amount),0)
		}
		
		expirydate {
			table = voucher
			field = expiry_date 
		}
		
		
	}
	
	columns {
		
		10 {
			fieldIdentifier = code
			label = Voucher Code
			columnIdentifier = voucherCode
		}
		
		20 {
			fieldIdentifier = voucherTypeName
			label = Amount Type
			columnIdentifier = amountType
			}
		
		30 {
			fieldIdentifier = voucherType, amount
			label = Amount
			columnIdentifier = amount
			
			renderObj = COA
			renderObj {
					10 = TEXT
					10.data = field:amount
					
					20 = TEXT
					20.value = %
					20.if {
						value.data = field:voucherType
						equals = 1
					}
				}
			}
		
		40 {
			fieldIdentifier = encashedAmount
			columnIdentifier = encashedAmount
			label = Encashed Amount
		}
		
		50 {
			fieldIdentifier = expirydate 
			columnIdentifier = expiryDate 
			label = Expiry Date 
		}		
	}
}