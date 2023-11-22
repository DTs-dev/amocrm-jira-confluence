<?php
		$fileName =__FILE__;

		$objCurl = curl_init();

		$curlArray = array(
			CURLOPT_URL => JIRA_URL . '/rest/api/2/issue/'.$issueKey.'/subtask',
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
