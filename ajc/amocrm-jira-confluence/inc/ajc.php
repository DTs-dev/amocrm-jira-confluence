<?php
function amo_jira() {
	$functionName = __FUNCTION__;
	global $actionType;

	// Configuration
	defined('PARENT_DIR') or define('PARENT_DIR', __DIR__ . '/');

	require 'config.php';

	// Check Jira Issue Exist
	include 'check-jira-issue-exist.php';

	// Conformity users of amoCRM & Jira
	include 'users.php';

	// Get lead info by ID in amoCRM
	include 'lead-info.php';

	// Get contact info by ID in amoCRM
	include 'contact-info.php';

	// Get company info by ID in amoCRM
	include 'company-info.php';

	// Create Jira Issue from amoCRM
	include 'create-jira-issue.php';

	// Post amoCRM Remote link to Jira Issue
	include 'add-link-to-amo-in-jira.php';

	// Add link to Jira Issue in amoCRM Task
	include 'add-link-to-jira-in-amo.php';

	// Create Confluence Page from amoCRM
	if( isset( $firstDeal ) ) {
		include 'create-confl-page.php';
	}

}
?>
