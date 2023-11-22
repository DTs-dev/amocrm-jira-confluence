<?php
		$fileName =__FILE__;

		$jdata = json_encode($data);

		$objCurl = curl_init();

		$curlArray = array(
			CURLOPT_USERAGENT => 'amoCRM-API-client/1.0',
			CURLOPT_URL => AMO_URL . '/api/v2/tasks',
			CURLOPT_HTTPHEADER => array('Content-type: application/json'),
			CURLOPT_HEADER => false,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $jdata,
			CURLOPT_COOKIEFILE => COOKIE_AMO,
			CURLOPT_COOKIEJAR => COOKIE_AMO,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => 2,
			CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array( $objCurl, $curlArray );

		$response = curl_exec( $objCurl );
		$jsonDecode = json_decode($response, true);

		include PARENT_DIR . 'response-log.php';

		curl_close( $objCurl );
?>
