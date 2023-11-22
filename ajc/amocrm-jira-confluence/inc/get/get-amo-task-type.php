<?php
		$fileName =__FILE__;

		$objCurl = curl_init();

		$curlArray = array(
			CURLOPT_URL => AMO_URL . '/api/v2/account?with=task_types',
			CURLOPT_COOKIEFILE => COOKIE_AMO,
			CURLOPT_COOKIEJAR => COOKIE_AMO,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array( $objCurl, $curlArray );

		$response = curl_exec( $objCurl );
		$jsonDecode = json_decode($response, true);

		include PARENT_DIR . 'response-log.php';

		curl_close( $objCurl );
?>
