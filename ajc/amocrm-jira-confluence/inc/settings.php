<?php
		// Get current amoCRM entity
		if( $functionName != 'jira_amo_update' ) {
			if( $actionType == 'leads' ) {
				$amoLead = $_REQUEST['leads']['status'][0];
				$entityId = $amoLead['id'];
			} else {
				$task = $_REQUEST['task'][$actionType][0];
				$entityId = $task['id'];
			}
		}
		$entityText = null;
		
		// amoCRM cookie authentication
		defined('COOKIE_AMO') or define('COOKIE_AMO', PARENT_DIR . 'cookie-amo.txt');
		require PARENT_DIR . 'auth-amo.php';

		// Settings for amoCRM actions
		if( $functionName != 'jira_amo_update' ) {
			if( $actionType == 'leads' ) {
				return;
			}

			$username = JIRA_USERNAME;
			if( $actionType != 'delete' ) {
				// Backslash replace in amoCRM text field
				$text = htmlspecialchars_decode($task['text']);
				$entityText = $text;

				// Get amoCRM task type
				include 'get/get-amo-task-type.php';

				$amoTaskType = trim( $jsonDecode['_embedded']['task_types'][$task['task_type']]['name'] );
				$amoTaskTypeOrign = $amoTaskType;

				$dateAmoFilter = date('d.m.Y', strtotime($task['date_create']));
				$amoTaskUrl = AMO_URL . '/todo/list/?filter_date_switch=created&filter_date_from=' . $dateAmoFilter . '&filter_date_to=' . $dateAmoFilter . '&filter%5Btask_type%5D%5B%5D=' . $task['task_type'] . '&filter%5Bstatus%5D%5B%5D=compl&filter%5Bstatus%5D%5B%5D=uncompl&filter%5Bmain_user%5D%5B%5D=' . $task['responsible_user_id'] . '&useFilter=y';

				$amoTimezone = str_replace( '\\', '', $jsonDecode['timezone'] );
				date_default_timezone_set( $amoTimezone );
			}
		}

		// Check locale for jira user and set epic name to that locale
		if( $functionName != 'amo_jira' && !isset( $amoLead ) ) {
			include PARENT_DIR . 'get/get-jira-user.php';
			if( $jsonDecode['locale'] === $jiraSecondLocale ) {
				$issueTypeNameEpic = $issueTypeNameEpicInSecondLocale;
			}
		}
?>
