<?php
		$amoTaskId = $task['id'];
		$jiraIssueLink = JIRA_URL . '/browse/' . $issueKey;
		$description = $text . ' ' . $jiraIssueLink;

		$data = array(
			'update' => array(
				array(
					'id' => $amoTaskId,
					'updated_at' => time(),
					'text' => $description
				)
			)
		);

		include PARENT_DIR . 'post/post-amo-task.php';
?>
