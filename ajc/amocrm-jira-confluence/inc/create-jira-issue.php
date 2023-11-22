<?php
		// Checking for Epic Jira Issue exist
		$issueTypeName = $issueTypeNameEpic;
		$amoTaskType = $amoTaskTypeDeal;

		if( $lead ) {
			include 'get/get-jira-issues.php';
		}

		$amoTaskType = $amoTaskTypeOrign;
		$count = 1;

		// Create Jira Issue with Epic type if amoCRM task type is Deal
		if( ( $lead ) && ( $amoTaskType == $amoTaskTypeDeal ) && ( !isset( $jsonDecode['issues'][0]['key'] ) ) ) {
			$firstDeal = true;
			$epicThis = true;
			$summary = $leadEpic;
			$epic = 'customfield_'.$epicNameField;
			$epicValue = $summary;
			$count = 2;
		} elseif( isset( $jsonDecode['issues'][0]['key'] ) ) {
			$epicThis = false;
			$issueTypeName = $amoTaskType == $amoTaskTypeTS ? $issueTypeNameTS : $issueTypeNameEpicChild;
			$epic = 'customfield_'.$epicLinkField;
			$epicValue = $jsonDecode['issues'][0]['key'];
		} else {
			$epicThis = false;
			$issueTypeName = $issueTypeNameDefault;
			$epic = null;
			$epicValue = null;
		}

		for( $i = 1; $i <= $count; $i++ ) {
			$data = array(
				'fields'=>array(
					'summary' => $summary,
					'description' => $text,
					'issuetype' => array('name' => $issueTypeName),
					'assignee' => array('name' => ASSIGNEE_NAME),
					'reporter' => array('name' => REPORTER_NAME),
					'project' => array('key' => PROJECT_KEY),
					'duedate' => date('Y-m-d', strtotime($task['complete_till'])),
					'priority' => array('name' => PRIORITY_NAME),
					'customfield_'.$amoLeadIdField => $task['element_id'],
					'customfield_'.$amoTaskIdField => $task['id'],
					'customfield_'.$amoTaskTypeField => array( str_replace(" ", "-", $amoTaskType) ),
					'customfield_'.$companyField => array( str_replace(" ", "-", $company) ),
					'customfield_'.$contactField => array( str_replace(" ", "-", $contact) ),
					'customfield_'.$leadField => array( str_replace(" ", "-", $lead) ),
					'customfield_'.$directionFieldIssue => $directions,
					$epic => $epicValue
				)
			);

			if( $company && !$lead ) {
				$data['fields']['customfield_'.$leadField] = array( str_replace(" ", "-", $amoNoLead) );
				unset( $data['fields']['customfield_'.$directionFieldIssue] );
			} elseif( $lead && !$company ) {
				unset( $data['fields']['customfield_'.$companyField] );
			} elseif( $contact && !$company && !$lead ) {
				$data['fields']['customfield_'.$leadField] = array( str_replace(" ", "-", $amoNoLead) );
				unset( $data['fields']['customfield_'.$companyField] );
				unset( $data['fields']['customfield_'.$directionFieldIssue] );
			} elseif( !$lead && !$company && !$contact ) {
				$data['fields']['customfield_'.$leadField] = array( str_replace(" ", "-", $amoNoLead) );
				unset( $data['fields']['customfield_'.$companyField] );
				unset( $data['fields']['customfield_'.$contactField] );
				unset( $data['fields']['customfield_'.$directionFieldIssue] );
			}

			if( $epicThis ) {
				unset( $data['fields']['description'] );
				unset( $data['fields']['assignee'] );
				unset( $data['fields']['duedate'] );
			} else {
				unset( $data['fields']['customfield_'.$amoLeadIdField] );
			}

			if( $issueTypeName === $issueTypeNameDefault ) {
				unset( $data['fields'][$epic] );
			}

			if( $amoTaskType == $amoTaskTypeTS ) {
				$data['fields']['assignee']['name'] = $issueAssigneeTS;
				unset( $data['fields']['customfield_'.$leadField] );
				unset( $data['fields']['customfield_'.$contactField] );
				unset( $data['fields']['customfield_'.$directionFieldIssue] );
			}

			include 'post/post-jira-issue.php';

			if( !isset( $jsonDecode['key'] ) ) {
				exit;
			}
			$issueKey = $jsonDecode['key'];
			$epicValue = $issueKey;
			$epicThis = false;
			$issueTypeName = $issueTypeNameEpicChild;
			$summary = $summaryOrign;
			$epic = 'customfield_'.$epicLinkField;
		}
?>
