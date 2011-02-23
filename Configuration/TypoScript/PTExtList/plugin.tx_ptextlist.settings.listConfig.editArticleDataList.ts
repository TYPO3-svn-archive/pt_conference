################################################################################
# Invoices List
# @author   Christoph Ehscheidt <ehscheidt@punkt.de>
# @since    2010-05-28
################################################################################

plugin.tx_ptextlist.settings.listConfig.editArticleData {
	
	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {
	
		baseFromClause (
			tx_ptgsaminidb_FSCHRIFT
			Inner Join tx_ptgsashop_order_wrappers On tx_ptgsashop_order_wrappers.related_doc_no = tx_ptgsaminidb_FSCHRIFT.AUFNR
			Inner Join tx_ptgsashop_orders On tx_ptgsashop_order_wrappers.orders_id = tx_ptgsashop_orders.uid
			Inner Join tx_ptgsashop_orders_articles articles On articles.orders_id = tx_ptgsashop_orders.uid
			INNER JOIN tx_ptconference_domain_model_persdata persdata on persdata.tx_ptgsashop_orders_articles_uid = articles.uid
			INNER JOIN tx_ptconference_domain_model_event events ON persdata.event = events.uid
		)
		
		baseWhereClause = TEXT
		baseWhereClause {
			cObject = COA
			cObject {
				10 = TEXT
				10 {
					dataWrap (
					 persdata.tx_ptgsashop_customer_uid = {TSFE:fe_user|user|tx_ptgsauserreg_gsa_adresse_id}			
					 AND tx_ptgsaminidb_FSCHRIFT.ERFART = '04RE' And (Select Count(FSTORNO.NUMMER) From tx_ptgsaminidb_FSCHRIFT FSTORNO Where FSTORNO.ALTAUFNR = tx_ptgsaminidb_FSCHRIFT.AUFNR) = 0
					 )
				}
			}
		}
	}
    
	fields {
		
		
		persdataUid {
			table = persdata
			field = uid
		}
	
		eventCode {
			table = events
			field = code
		}
	
		eventStartDate {
			table = events
			field = startdate
		}
	
		eventTitle {
			table = events
			field = title
		}
	
		articleCode {
			table = articles
			field = description
		}
	
		articleUid {
			table = persdata
			field = uid
		}
	
		# ArticleCode
		ticketCode {
		  table = persdata
		  field = articlecode
		}
	
		company {
			table = persdata
			field =  company
		}

		firstname {
			table = persdata
			field =  firstname
		}

		lastname {
			table = persdata
			field =  lastname
		}	
	
		jobstatus {
			table = persdata
			field = jobstatus
		}		
	}


	columns {
		
		7 {
		  columnIdentifier = articleCodeColumn
		  fieldIdentifier = articleCode
		  label = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_articleCode
		}
		
		10 {
		  columnIdentifier = ticketCodeColumn
		  fieldIdentifier = ticketCode
		  label = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_ticketCode
		}
		
		20 {
		  columnIdentifier = companyColumn
		  fieldIdentifier = company
		  label = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_company
		}
		
		30 {
		  columnIdentifier = nameColumn
		  fieldIdentifier = lastname, firstname
		  label = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_name
		}
		
		40 {
		  columnIdentifier = jobStatusColumn
		  fieldIdentifier = jobstatus
		  label = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_jobstatus
		}
		
		50 {
			columnIdentifier = editDataColumn
			fieldIdentifier = persdataUid, eventStartDate
			isSortable = 0
		  
			renderObj = COA
			renderObj {
				10 = TEXT
				10 {
					data = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_edit
					typolink {
						parameter = {$plugin.tx_ptgsaconfmgm.editPersonalDataPage}
						additionalParams.dataWrap = &tx_ptgsaconfmgm_controller_persarticle[action]=editSinglePersData&tx_ptgsaconfmgm_controller_persarticle[persDataUid]={field:persdataUid}&tx_ptgsaconfmgm_controller_persarticle[listPageUid]={page:uid}
				   }
				  
				   if.value.field = eventStartDate
				   if.isGreatherThan = SIM_EXEC_TIME
				}
			}
		}


		
	}
  
	pager.itemsPerPage = 50
}

plugin.tx_ptextlist.settings.listConfig.editRelData {
	
	backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
    backendConfig {
	
		baseFromClause (
			tx_ptgsaminidb_FSCHRIFT
			Inner Join tx_ptgsashop_order_wrappers On tx_ptgsashop_order_wrappers.related_doc_no = tx_ptgsaminidb_FSCHRIFT.AUFNR
			Inner Join tx_ptgsashop_orders On tx_ptgsashop_order_wrappers.orders_id = tx_ptgsashop_orders.uid
			Inner Join tx_ptgsashop_orders_articles articles On articles.orders_id = tx_ptgsashop_orders.uid
			INNER JOIN tx_ptconference_domain_model_relarticle relarticle on articles.uid = relarticle.tx_ptgsashop_orders_articles_uid
			INNER JOIN tx_ptconference_domain_model_persdata persdata on persdata.uid = relarticle.persdata
			INNER JOIN tx_ptconference_domain_model_event events ON persdata.event = events.uid
		)
		
		baseWhereClause = TEXT
		baseWhereClause {
			cObject = COA
			cObject {
	
				10 = TEXT
				10 {
					dataWrap ( 
						persdata.tx_ptgsashop_customer_uid = {TSFE:fe_user|user|tx_ptgsauserreg_gsa_adresse_id}
						and tx_ptgsaminidb_FSCHRIFT.ERFART = '04RE' And (Select Count(FSTORNO.NUMMER) From tx_ptgsaminidb_FSCHRIFT FSTORNO Where FSTORNO.ALTAUFNR = tx_ptgsaminidb_FSCHRIFT.AUFNR) = 0
					)
				}
			}
		}
	}
    
	fields {
		relarticleUid {
			table = relarticle
			field = uid
		}

		eventCode {
			table = events
			field = code
		}

		eventStartDate {
			table = events
			field = startdate
		}

		eventTitle {
			table = events
			field = title
		}

		articleCode {
			table = articles
			field = description
		}

		articleUid {
			table = persdata
			field = uid
		}

		# ArticleCode
		ticketCode {
			table = persdata
			field = articlecode
		}

		company {
			table = persdata
			field =  company
		}

		firstname {
			table = persdata
			field =  firstname
		}

		lastname {
			table = persdata
			field =  lastname
		}	

		jobstatus {
			table = persdata
			field = jobstatus
		}

		tutorials {
			special = (SELECT group_concat(infooptions.title SEPARATOR ',') FROM tx_ptconference_domain_model_persarticleinfo_values infovalues INNER JOIN tx_ptconference_domain_model_persarticleinfo_options infooptions ON infovalues.infovalue = infooptions.uid where infovalues.relarticle = relarticle.uid group by infovalues.relarticle limit 0,1)
		}		
	}


	columns {

		10 {
			columnIdentifier = articleCodeColumn
			fieldIdentifier  = articleCode
			label = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_articleCode
		}

		20 {
			columnIdentifier = ticketCodeColumn
			fieldIdentifier  = ticketCode
			label = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_ticketCode
		}
		
		30 {
			columnIdentifier = tutorialColumn
			fieldIdentifier  = tutorials
			label = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_tutorial
		}

		50 {
			columnIdentifier = nameColumn
			fieldIdentifier  = lastname, firstname
			label = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_name
		}

		60 {
			columnIdentifier = editDataColumn
			fieldIdentifier  = relarticleUid
			isSortable = 0

			renderObj = COA
			renderObj {
				10 = TEXT
				10 {
					data = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_edit
					typolink {
						parameter = {$plugin.tx_ptgsaconfmgm.editPersonalDataPage}
						additionalParams.dataWrap = &tx_ptgsaconfmgm_controller_persarticle[action]=editSingleRelData&tx_ptgsaconfmgm_controller_persarticle[relDataUid]={field:relarticleUid}&tx_ptgsaconfmgm_controller_persarticle[listPageUid]={page:uid}
					}
				}
				
				if.value.field = eventStartDate
				if.isGreatherThan = SIM_EXEC_TIME
			}
		}


		
	}
  
	pager.itemsPerPage = 50
}
