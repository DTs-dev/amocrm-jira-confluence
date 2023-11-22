<?php
		$companyEmail = NULL;
		$companyPhone = NULL;
		$website = NULL;

		if( !$contact && !$lead ) {
			$companyId = $task['element_id'];
		}

		if( $companyId ) {
			include 'get/get-amo-company.php';

			if( isset( $jsonDecode['_embedded']['items'][0]['name'] ) ) {
				$company = str_replace( array( "\r\n", "\r", "\n" ), '', $jsonDecode['_embedded']['items'][0]['name'] );
				$count = 2;
				for( $i = 0; $i < $count; $i++ ) {
					$customFields = $jsonDecode['_embedded']['items'][0]['custom_fields'];
					foreach( $customFields as $fieldsArray => $customField ) {
						if( $customField['code'] === $emailField ) {
							$email = $customField['values'][0]['value'];
							if( $i === 0 ) {
								$companyEmail = $email;
							}
						}
						if( $customField['code'] === $phoneField ) {
							$phone = $customField['values'][0]['value'];
							if( $i === 0 ) {
								$companyPhone = $phone;
							}
						}
						if( $customField['code'] === $positionField ) {
							$position = $customField['values'][0]['value'];
						}
						if( $customField['code'] === $websiteField ) {
							$website = $customField['values'][0]['value'];
						}
					}
					if( $i === 0 && !isset( $contactId ) && isset( $jsonDecode['_embedded']['items'][0]['contacts']['id'][0] ) ) {
						$contactId = $jsonDecode['_embedded']['items'][0]['contacts']['id'][0];
						include 'get/get-amo-contact.php';
						$contact = str_replace( array( "\r\n", "\r", "\n" ), '', $jsonDecode['_embedded']['items'][0]['name'] );
					} else {
						continue;
					}
				}
			}

			if( !$email ) {
				$email = $companyEmail;
			}
			if( !$phone ) {
				$phone = $companyPhone;
			}
		}

		if ( $company && !$lead ) {
			$summary = $amoTaskType . ': ' . $company;
		} elseif ( $lead && $company ) {
			$leadEpic = $lead . ' в ' . $company;
			$summary = $amoTaskType . ': ' . $lead . ' в ' . $company;
		} elseif ( $lead && $contact ) {
			$leadEpic = $lead . ': ' . $contact;
			$summary = $amoTaskType . ': ' . $lead . ': ' . $contact;
		} elseif ( $lead ) {
			$leadEpic = $lead;
			$summary = $amoTaskType . ': ' . $lead;
		} else {
			$summary = $amoTaskType . ': ' . $contact;
		}

		$summaryOrign = $summary;
?>
