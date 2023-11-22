<?php
		$fileName = __FILE__;

		$data = array(
			'USER_LOGIN' => AMO_USERNAME,
			'USER_HASH' => AMO_KEY
		);

		$jdata = json_encode($data);

		$objCurl = curl_init();

		$curlArray = array(
			CURLOPT_USERAGENT => 'amoCRM-API-client/1.0',
			CURLOPT_URL => AMO_URL . '/private/api/auth.php?type=json',
			CURLOPT_HTTPHEADER => array('Content-type: application/json'),
			CURLOPT_HEADER => false,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $jdata,
			CURLOPT_COOKIEFILE => COOKIE_AMO,
			CURLOPT_COOKIEJAR => COOKIE_AMO,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_SSL_VERIFYHOST => 0
		);

		curl_setopt_array( $objCurl, $curlArray );

		$response = curl_exec( $objCurl );
		$jsonDecode = json_decode($response, true);

//		include PARENT_DIR . 'response-log.php';

		curl_close( $objCurl );
?>
