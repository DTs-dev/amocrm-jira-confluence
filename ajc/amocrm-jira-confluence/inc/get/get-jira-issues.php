<?php
		$fileName =__FILE__;

		$objCurl = curl_init();

		$curlArray = array(
			CURLOPT_URL => JIRA_URL . '/rest/api/2/search?jql=project+%3D+'.PROJECT_KEY.'+AND+cf%5B'.$amoTaskIdField.'%5D+is+not+EMPTY+AND+cf%5B'.$amoTaskTypeField.'%5D+%3D+%22'.urlencode(addslashes(str_replace(" ","-",$amoTaskType))).'%22+AND+cf%5B'.$leadField.'%5D+%3D+%22'.urlencode(addslashes(str_replace(" ","-",$lead))).'%22+AND+issuetype+%3D+'.$issueTypeName,
			CURLOPT_USERPWD => JIRA_USERNAME . ':' . JIRA_PASSWORD,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array( $objCurl, $curlArray );

		$response = curl_exec( $objCurl );
		$jsonDecode = json_decode($response, true);

		include PARENT_DIR . 'response-log.php';

		curl_close( $objCurl );
?>
