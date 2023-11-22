<?php
		/********** JIRA CONFIG **********/
		// Main jira config
		defined('JIRA_DOMAIN') or define('JIRA_DOMAIN', 'jira.company.org');			// Your domain for jira
		defined('JIRA_URL_SCHEME') or define('JIRA_URL_SCHEME', 'https');			// Scheme for jira URL
		defined('JIRA_USERNAME') or define('JIRA_USERNAME', 'int-user');			// Integration jira user
		defined('JIRA_PASSWORD') or define('JIRA_PASSWORD', 'p@ssw0rd');			// Password for integration jira user
		defined('JIRA_PROJECT_KEY') or define('JIRA_PROJECT_KEY', 'CRM');			// Jira project key for tasks from amoCRM
		defined('JIRA_PRIORITY_NAME') or define('JIRA_PRIORITY_NAME', 'Medium');		// Priority for jira issues
		defined('JIRA_URL') or define('JIRA_URL', JIRA_URL_SCHEME . '://' . JIRA_DOMAIN);

		// Jira second locale
		$jiraSecondLocale = 'de_DE';								// Specify the second locale from your jira instance (primary locale is always "en_US")

		// Jira issue types
		$issueTypeNameDefault = 'Sale';
		$issueTypeNameEpic = 'Epic';
		$issueTypeNameEpicInSecondLocale = 'Thema';
		$issueTypeNameEpicChild = 'Story';
		$issueTypeNameTS = 'Commercial support';
		$issueAssigneeTS = 'willson.j';
		$issueTypeName = $issueTypeNameDefault;
		
		// Jira custom fields
		$epicNameField = '18888';
		$epicLinkField = '19999';
		$amoLeadIdField = '11111';
		$amoTaskIdField = '12222';
		$amoTaskTypeField = '13333';
		$companyField = '14444';
		$contactField = '15555';
		$leadField = '16666';
		$directionFieldIssue = '17777';
		
		// Jira statuses
		$jiraIssueStatusToDo = '22222';
		$jiraIssueStatusInProgress = '33333';
		$jiraIssueStatusDone = '44444';
		
		// Jira transitions
		$transitionToDo = '31';
		$transitionToDoDone = '41';
		$transitionInProgressDone = '51';
		
		// Jira resolutions
		$resolutionDoneId = '1';
		$resolutionNotDoneId = '3';
		
		// Default jira comment for empty result
		$noResultComment = 'Ready';

		// Jira cookie authentication
//		defined('COOKIE_JIRA') or define('COOKIE_JIRA', PARENT_DIR . 'cookie-jira.txt');
//		require_once PARENT_DIR . 'auth-jira.php';



		/********** CONFLUENCE CONFIG **********/
		// Main confluence config
		defined('CONFL_DOMAIN') or define('CONFL_DOMAIN', 'docs.company.org');			// Your domain for confluence
		defined('CONFL_URL_SCHEME') or define('CONFL_URL_SCHEME', 'https');			// Scheme for confluence URL
		defined('CONFL_USERNAME') or define('CONFL_USERNAME', 'int-user');			// Integration confluence user
		defined('CONFL_PASSWORD') or define('CONFL_PASSWORD', 'p@ssw0rd');			// Password for integration confluence user
		defined('SPACE_KEY') or define('SPACE_KEY', 'CRM');					// Confluence space key for creating pages
		defined('ANCESTORS') or define('ANCESTORS', 11111111);					// Confluence page id in space for creating pages
		defined('CONFL_URL') or define('CONFL_URL', CONFL_URL_SCHEME . '://' . CONFL_DOMAIN);
		
		// Confluence application links
		$conflAppName = 'Jira'									// Jira application name from confluence application links
		$conflAppId = '61d2kfu7-987e-28c8-960a-2d2c73f97bn1';					// Jira application id from url of this application editing

		// Confluence cookie authentication
//		defined('COOKIE_CONFL') or define('COOKIE_CONFL', PARENT_DIR . 'cookie-confl.txt');
//		require_once PARENT_DIR . 'auth-confl.php';



		/********** AMOCRM CONFIG **********/
		// Main amoCRM config
		defined('AMO_SUBDOMAIN') or define('AMO_SUBDOMAINL', 'company');			// Your subdomain for amoCRM
		defined('AMO_USERNAME') or define('AMO_USERNAME', 'int-user@example.com');		// For account mapping in systems all user email's in amoCRM must match user email in Jira
		defined('AMO_KEY') or define('AMO_KEY', '34cad4ed55e5d5501ab3f108283442832567234d');	// amoCRM key for int. user (Only for first versions, for new versions a module update is required)
		defined('AMO_URL') or define('AMO_URL', 'https://' . AMO_SUBDOMAIN . '.amocrm.ru');

		// amoCRM task types
		$amoTaskTypeDeal = 'TCP';
		$amoTaskTypeTS = 'Send to support';

		// amoCRM fields
		$emailField = 'EMAIL';
		$phoneField = 'PHONE';
		$positionField = 'POSITION';
		$websiteField = 'WEB';
		$directionField = 'DIRECTION';

		// Stage for not imple leads
		$amoLeadNotImpleStageId = '143';
		
		// Text for the lead field if there is no lead
		$amoNoLead = '!!!NO LEAD!!!';

		include 'settings.php';
?>
