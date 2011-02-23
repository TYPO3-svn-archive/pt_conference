# Attendee List
# @version  $Id:$
# @author   Daniel Lienert <lienert@punkt.de>
################################################################################


plugin.tx_ptextlist.settings.listConfig.attendeeList  < plugin.tx_ptextlist.settings.listConfig.persInfoBase
plugin.tx_ptextlist.settings.listConfig.attendeeList {
	
    backendConfig {
		baseGroupByClause (
			persdata.uid
		)
	}
	
	fields {
		persdatauid {
			table = persdata
			field = uid
		}
		
		articlecode {
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
		
		company {
			table = persdata
			field = company
		}
				
		email {
			table = persdata
			field = email
		}
		
		jobstatus {
			table = persdata
			field = jobstatus
		}
		
		checkedin {
			table = persdata
			field = checkedin
		}
		
		goodiesreceived {
			table = persdata
			field = goodiesreceived
		}
		
		articleArtNo {
			table = articles
			field = art_no
		}
		
		invoiceNo {
			table = orderwrappers
			field = related_doc_no
		}
		
		infoTypeTitle {
			table = infotypes
			field = title
			expandGroupRows = 1
		}
		
		infoOptionTitle {
			table = infooptions
			field = title
			expandGroupRows = 1
		}
		
		persValue {
			table = persvalues
			field = infovalue
			expandGroupRows = 1			
		}
		
		tutorial {
			special (
				IFNULL((select oArt.art_no from tx_ptconference_domain_model_relarticle iRelArticle
				INNER JOIN tx_ptgsashop_orders_articles oArt on oArt.uid = iRelArticle.tx_ptgsashop_orders_articles_uid
				INNER JOIN tx_ptgsacategories_cat_art_rel art_rel on art_rel.art_uid = 
				oArt.gsa_id_artikel
				where art_rel.cat_uid = 2
				and iRelArticle.persdata = persdata.uid
				limit 1),'NOT BOOKED')
			)
		}
		
		
		infoCombined {
			special (
				select group_concat(concat_WS( ',', iOptions.title, iValues.infoValue)) AS allTutorialsCombined 
				FROM tx_ptconference_domain_model_persarticleinfo_options iOptions
				INNER JOIN tx_ptconference_domain_model_persarticleinfo_values iValues ON iOptions.uid = iValues.infoValue
				where iValues.persdata = persdata.uid
				group by iValues.persdata
			)
		}
	}
	
	columns >
	columns {
		
		10 {
			columnIdentifier = companyColumn
			fieldIdentifier = company
			label = Company
			sorting = company, lastName, firstName
		}
		
		20 {
			columnIdentifier = nameColumn
			fieldIdentifier = firstName, lastName, email
			label = Name / Email
			
			renderObj = COA
			renderObj {
				10 = TEXT
				10.dataWrap = {field:firstName} {field:lastName} <br />
				
				20 = TEXT
				20.data = field:email
				20.typolink.parameter.dataWrap = {field:email}
			}
		} 
		
		
		40 {
			columnIdentifier = tickeColumn
			fieldIdentifier = articleArtNo, invoiceNo 
			label = Ticket Info
			
			renderUserFunctions {
				10 = EXT:pt_conference/Classes/Utility/Tx_PtConference_Utility_RenderUserFunctions.php:user_Tx_PtConference_Utility_UserFunctions->getInvoicePDFLink
			}

			renderObj = TEXT
			renderObj {
				dataWrap = {field:articleArtNo} <br /><a href="|">{field:invoiceNo}</a>
				current = 1
			}
		}
		
		50 {
			columnIdentifier = attendeeInformation
			fieldIdentifier = infoTypeTitle, infoOptionTitle, persValue
			label = Attendee Information
			renderTemplate = typo3conf/ext/pt_conference/Resources/Private/Partials/ExtList/AttendeeInformation.html
		}
		
		60 {
			columnIdentifier = editColumn
			isSortable = 0
			fieldIdentifier = persdatauid
			
			renderObj = COA
			renderObj {
				10 = TEXT
				10 {
					data = LLL:EXT:pt_gsaconfmgm/locallang.xml:persdata_column_edit
					typolink {
						parameter = {$config.pt_conference.persdataEditPid}
						additionalParams.dataWrap = &tx_ptconference_pi1[action]=edit&tx_ptconference_pi1[persdataUid]={field:persdatauid}
					}
					#if.value = {$config.pt_conference.persdataEditPid}
					if.isTrue = {$config.pt_conference.persdataEditPid}
				}
				
				20 < .10
				20 {
					typolink {
						parameter.data = TSFE:id 
					}
					if.negate = 1
				}
				
				#if.value.field = eventStartDate
				#if.isGreatherThan = SIM_EXEC_TIME
			}
		}
	}
	
	# list sorting with GUI columns
	defaults {
		sortingColumn = companyColumn
		sortingDirection = ASC
	}
	
	pager.itemsPerPage = 50
	
	filters {
		filterBox1 {
			showReset = 0 
			filterConfigs {
				10 < plugin.tx_ptextlist.prototype.filter.string
				10 {
					filterIdentifier = firstNameSearch
					label = Firstname
					fieldIdentifier = firstName
				}
				
				11 < plugin.tx_ptextlist.prototype.filter.string
				11 {
					filterIdentifier = lastNameSearch
					label = Lastname
					fieldIdentifier = lastName
				}
				
				20 < plugin.tx_ptextlist.prototype.filter.string
				20 {
					filterIdentifier = companySearch
					label = Company
					fieldIdentifier = company
				}
				
				30 < plugin.tx_ptextlist.prototype.filter.select
				30 {
					filterIdentifier = ticketTypeSearch
					submitOnChange = 1
					label = Ticket Type
					fieldIdentifier = articleArtNo
					inactiveOption = [Show all]	
				}

				40 < plugin.tx_ptextlist.prototype.filter.string
				40 {
					filterIdentifier = invoiceSearch
					label = Invoicec No
					fieldIdentifier = invoiceNo	
				}
				
				50 < plugin.tx_ptextlist.prototype.filter.select
				50 {
					filterIdentifier = tutorialBooked
					submitOnChange = 1
					label = Tutorial booked
					fieldIdentifier = tutorial
					inactiveOption = [Show all]	
					inactiveValue = showAll
				}
				
				60 < plugin.tx_ptextlist.prototype.filter.select
				60 {
					filterIdentifier = checkedIn
					submitOnChange = 1
					label = CheckIn State
					fieldIdentifier = checkedin
					inactiveOption = [Show all]	
					inactiveValue = showAll
					options {
						0 = Not Checked In
						1 = Checked In
					}
					renderObj >
				}
				
				70  < plugin.tx_ptextlist.prototype.filter.string
				70 {
					filterIdentifier = allTutorials
					fieldIdentifier = infoCombined
					label = Attendee Info
				}
			}
		}
	}
}

plugin.tx_ptextlist.settings.listConfig.attendeeListExport < plugin.tx_ptextlist.settings.listConfig.attendeeList
plugin.tx_ptextlist.settings.listConfig.attendeeListExport {
	pager.itemsPerPage = 0
	
	columns >
	columns {
		5 {
			columnIdentifier = articlecode
			fieldIdentifier = articlecode
			label = Ticket Code
		}
		10 {
			columnIdentifier = companyColumn
			fieldIdentifier = company
			label = Company
		}
		20 {
			columnIdentifier = firstName
			fieldIdentifier = firstName
			label = Firstname
		}
		30 {
			columnIdentifier = lastName
			fieldIdentifier = lastName
			label = LastName
		}
		40 {
			columnIdentifier = email
			fieldIdentifier = email
			label = Email
		}
		50 {
			columnIdentifier = companyColumn
			fieldIdentifier = company
			label = Company
		}
		60 {
			columnIdentifier = articleArtNo
			fieldIdentifier = articleArtNo
			label = Article No
		}
		70 {
			columnIdentifier = invoiceNo
			fieldIdentifier = invoiceNo
			label = Invoice No
		}
	}
}