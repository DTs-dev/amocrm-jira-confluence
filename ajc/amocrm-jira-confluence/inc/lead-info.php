<?php
		$lead = null;
		$directions = null;
		$leadDateCreate = null;
		$companyId = null;

		$leadId = $task['element_id'];
		include 'get/get-amo-lead.php';

		if( isset( $jsonDecode['_embedded']['items'][0]['name'] ) ) {
			$lead = str_replace( [ "\r\n", "\r", "\n", "\t" ], [ '', '', '', ' ' ], $jsonDecode['_embedded']['items'][0]['name'] );
			$amoLeadUrl = AMO_URL . '/leads/detail/' . $leadId;
			$customFields = $jsonDecode['_embedded']['items'][0]['custom_fields'];

			foreach( $customFields as $customField ) {
				if( $customField['name'] === $directionField ) {
					$directions = array_column( $customField['values'], 'value' );
					if( !function_exists( 'space_to_dash' ) ) {
						function space_to_dash( $direction ) {
							return ( str_replace(" ", "-", $direction) );
						}
					}
					$directions = array_map( 'space_to_dash', $directions );
				}
			}

			$leadDateCreate = $jsonDecode['_embedded']['items'][0]['created_at'];

			if( isset( $jsonDecode['_embedded']['items'][0]['main_contact']['id'] ) ) {
				$contactId = $jsonDecode['_embedded']['items'][0]['main_contact']['id'];
			}

			if( isset( $jsonDecode['_embedded']['items'][0]['company']['id'] ) ) {
				$companyId = $jsonDecode['_embedded']['items'][0]['company']['id'];
			}
		}
?>
