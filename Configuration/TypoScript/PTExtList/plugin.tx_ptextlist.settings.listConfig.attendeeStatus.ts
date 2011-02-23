# Attendee List
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
################################################################################


plugin.tx_ptextlist.settings.listConfig.attendeeStatus  < plugin.tx_ptextlist.settings.listConfig.persInfoBase
plugin.tx_ptextlist.settings.listConfig.attendeeStatus {
	
    backendConfig {
		baseFromClause (
			tx_ptgsaminidb_FSCHRIFT
			Inner Join tx_ptgsashop_order_wrappers orderwrappers On orderwrappers.related_doc_no = tx_ptgsaminidb_FSCHRIFT.AUFNR
			Inner Join tx_ptgsashop_orders orders On orderwrappers.orders_id = orders.uid
			Inner Join tx_ptgsashop_orders_articles articles On articles.orders_id = orders.uid
			
			INNER JOIN tx_ptconference_domain_model_persdata persdata on persdata.tx_ptgsashop_orders_articles_uid = articles.uid
			INNER JOIN tx_ptconference_domain_model_event events ON persdata.event = events.uid
		)
	}
	
	fields >
	fields {
		countAttendees {
			special = count(distinct(persdata.uid))
		}
	
		countCheckedIn {
			special = sum(checkedin)
		}
		
		countGoodiesReceived {
			special = sum(goodiesreceived)
		}
	}
	
	columns >
	columns {
		10 {
			columnIdentifier = attendeeColumn
			fieldIdentifier = countAttendees 
			label = Attendees
			isSortable = 0
		}
		
		20 {
			columnIdentifier = checkedInColumn
			fieldIdentifier = countCheckedIn 
			label = Checked In
			isSortable = 0
		}
		
		30 {
			columnIdentifier = goodiesReceivedColumn
			fieldIdentifier = countGoodiesReceived 
			label = Goodies Received
			isSortable = 0
		}
	}
}