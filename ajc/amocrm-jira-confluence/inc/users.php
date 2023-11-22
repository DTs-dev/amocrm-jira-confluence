<?php
		include 'get/get-amo-users.php';

		$reporter = $jsonDecode['_embedded']['users'][$task['created_user_id']]['login'];
		$reporter = preg_replace( '/@\w+\.\D+$/', '', $reporter );

		$assignee = $jsonDecode['_embedded']['users'][$task['responsible_user_id']]['login'];
		$assignee = preg_replace( '/@\w+\.\D+$/', '', $assignee );

		define('REPORTER_NAME', $reporter);
		define('ASSIGNEE_NAME', $assignee);
?>
