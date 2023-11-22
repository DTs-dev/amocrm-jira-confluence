<?php
		$fileName =__FILE__;

		$jdata = json_encode($data);

		$objCurl = curl_init();

		$curlArray = array(
			CURLOPT_URL => CONFL_URL . '/rest/api/content/' . $conflPageId . '/label',
			CURLOPT_USERPWD => CONFL_USERNAME . ':' . CONFL_PASSWORD,
			CURLOPT_HTTPHEADER => array('Content-type: application/json'),
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $jdata,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array( $objCurl, $curlArray );

		$response = curl_exec( $objCurl );
		$jsonDecode = json_decode($response, true);

		include PARENT_DIR . 'response-log.php';

		curl_close( $objCurl );
?>
