<?php
		$fileName =__FILE__;

		$jdata = json_encode($data);

		$objCurl = curl_init();

		$curlArray = array(
			CURLOPT_URL => JIRA_URL . '/rest/api/2/issue',
			CURLOPT_USERPWD => JIRA_USERNAME . ':' . JIRA_PASSWORD,
			CURLOPT_HTTPHEADER => array('Content-type: application/json'),
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $jdata,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => 2,
			CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array( $objCurl, $curlArray );

		$response = curl_exec( $objCurl );
		$jsonDecode = json_decode($response, true);

		include PARENT_DIR . 'response-log.php';
?>
