<?php
$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__));
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

error_reporting(E_ALL);
ini_set( 'error_log', $_SERVER['DOCUMENT_ROOT'] . '/amocrm-jira-confluence/logs/ajc.error.log' );

require_once( $_SERVER['DOCUMENT_ROOT'] . '/amocrm-jira-confluence/amocrm-jira-confluence.php' );

if( isset( $_REQUEST['account']['id'] ) && $_REQUEST['account']['id'] === 'XXXXXXXX' ) {	// "XXXXXXXX" - Your amoCRM account id
	if( isset( $_REQUEST['leads']['status'] ) ) {
		$actionType = key( $_REQUEST );
	} else {
		$actionType = key( $_REQUEST['task'] );
	}
	if( $actionType == 'add' && function_exists('amo_jira') ) {
		amo_jira();
	} elseif( in_array( $actionType, ['update', 'delete', 'leads'] ) && function_exists('amo_jira_update') ) {
		amo_jira_update();
	}
} elseif( isset( $_REQUEST['user_key'] ) && function_exists('jira_amo_update') ) {
	jira_amo_update();
} else {
	http_response_code(404);
	echo 'Not found';
	exit;
}
?>
