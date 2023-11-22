<?php
		$contact = null;
		$company = null;
		$email = null;
		$phone = null;
		$position = null;

		if( !$lead ) {
			$contactId = $task['element_id'];
		}

		if( isset( $contactId ) ) {
			include 'get/get-amo-contact.php';

			if( isset( $jsonDecode['_embedded']['items'][0]['name'] ) ) {
				$contact = str_replace( array( "\r\n", "\r", "\n" ), '', $jsonDecode['_embedded']['items'][0]['name'] );
				if( isset( $jsonDecode['_embedded']['items'][0]['company']['name'] ) ) {
					$company = str_replace( array( "\r\n", "\r", "\n" ), '', $jsonDecode['_embedded']['items'][0]['company']['name'] );
					$companyId = $jsonDecode['_embedded']['items'][0]['company']['id'];
				}
				$customFields = $jsonDecode['_embedded']['items'][0]['custom_fields'];
				foreach( $customFields as $customField ) {
					if( $customField['code'] === $emailField ) {
						$email = $customField['values'][0]['value'];
					}
					if( $customField['code'] === $phoneField ) {
						$phone = $customField['values'][0]['value'];
					}
					if( $customField['code'] === $positionField ) {
						$position = $customField['values'][0]['value'];
					}
				}
			} else {
				unset( $contactId );
			}
		}
?>
