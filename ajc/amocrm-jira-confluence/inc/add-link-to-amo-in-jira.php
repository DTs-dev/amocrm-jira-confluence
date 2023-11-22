<?php
		$data = array(
			'globalId' => 'system=' . $task['id'],
			'object' => array(
				'url' => $amoTaskUrl,
				'title' => $summary,
				'icon' => array( 'url16x16' => 'https://www.amocrm.ru/favicon.ico' )
			)
		);

		include 'post/post-jira-link.php';
?>
