<?php
		// If amoCRM ip address changed and authorization is not valid
		$origCurlArray = $curlArray;
		$entityId = $functionName != 'amo_jira' ? ( $functionName == 'amo_jira_update' ? ( $actionType != 'leads' ? preg_replace( '/[\s\S]+\/(?=[A-Z]+-[\d]+$)/', '', $entityText ) : $entityId ) : $issueKey ) : $entityId;
		if( isset( $jsonDecode['response']['error_code'] ) && $jsonDecode['response']['error_code'] === '110' ) {
			$i = 1;
			while( isset( $jsonDecode['response']['error_code'] ) && $i <= 3 ) {
				file_put_contents( LOG_DIR . 'unauthorized-amo.txt', date("Y-m-d H:i:s") . ': AMO Unauthorized for "' . $entityId . '"' . "\n", FILE_APPEND );
				curl_close( $objCurl );

				// Re-authorization
				include PARENT_DIR . 'auth-amo.php';

				$objCurl = curl_init();
				curl_setopt_array( $objCurl, $origCurlArray );
				$response = curl_exec( $objCurl );
				$jsonDecode = json_decode( $response, true );
				$i++;
			}
		}

		$code = curl_getinfo( $objCurl, CURLINFO_HTTP_CODE );
		$code = (int)$code;

		if( !in_array($code, [200, 201, 204]) ) {
			$errorLogFile = LOG_DIR . 'aj.request-errors.log';
			$logMessage = curl_errno( $objCurl ) ? '[CURL_ERROR]: ' . curl_error( $objCurl ) : ( $jsonDecode ? $response : json_encode( simplexml_load_string( $response, 'SimpleXMLElement', LIBXML_NOCDATA ) ) );
			$log = date("Y-m-d H:i:s") . ' [ERROR] ' . $code . ' ' . $functionName . ' on "' . $entityId . '" in file "' . $fileName  . '":' . "\n" . $logMessage;
			file_put_contents( $errorLogFile, $log . "\n", FILE_APPEND );
		}
?>
