<?php
		// Get Jira issue by amoCRM task ID
		$amoTaskId = $task['id'];
		include 'get/get-jira-issue.php';

		if( isset( $jsonDecode['issues'][0]['key'] ) ) {
			file_put_contents( PARENT_DIR . 'logs/exist-issues.txt', date("Y-m-d H:i:s") . ': ' . $jsonDecode['issues'][0]['key'] . "\n", FILE_APPEND );
			exit;
		}
?>
