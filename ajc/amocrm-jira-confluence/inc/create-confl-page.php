<?php
		$username = REPORTER_NAME;
		include 'get/get-confl-user.php';
		$reporterUserKey = $jsonDecode['userKey'];

		$username = ASSIGNEE_NAME;
		include 'get/get-confl-user.php';
		$assigneeUserKey = $jsonDecode['userKey'];

		$companyCont = $company;

		if( !$company ) {
			$company = $contact;
			$companyCont = null;
		}

		$amoTaskUrl = AMO_URL . '/todo/list/?filter_date_switch=created&amp;filter_date_from=' . $dateAmoFilter . '&amp;filter_date_to=' . $dateAmoFilter . '&amp;filter&#37;5Btask_type&#37;5D&#37;5B&#37;5D=' . $task['task_type'] . '&amp;filter&#37;5Bstatus&#37;5D&#37;5B&#37;5D=compl&amp;filter&#37;5Bstatus&#37;5D&#37;5B&#37;5D=uncompl&amp;filter&#37;5Bmain_user&#37;5D&#37;5B&#37;5D=' . $task['responsible_user_id'] . '&amp;useFilter=y';

		// Get subtask for table
		include 'get/get-jira-issue-subtask.php';
		array_unshift( $jsonDecode, [ 'key' => $issueKey ] );
		$tasksTr = '';
		foreach( $jsonDecode as $issue ) {
			$issueKey = $issue['key'];
			$tasksTr .= '
    <tr>
      <td>
        <div class="content-wrapper">
          <span style="color: rgb(112,112,112);">
            <ac:structured-macro ac:name="jira" ac:schema-version="1">
              <ac:parameter ac:name="showSummary">true</ac:parameter>
              <ac:parameter ac:name="server">' . $conflAppName . '</ac:parameter>
              <ac:parameter ac:name="serverId">' . $conflAppId . '</ac:parameter>
              <ac:parameter ac:name="key">' . $issueKey . '</ac:parameter>
            </ac:structured-macro>
          </span>
        </div>
      </td>
      <td>
        <div class="content-wrapper">
          <span style="color: rgb(112,112,112);">
            <ac:link>
              <ri:user ri:userkey="' . $assigneeUserKey . '"/>
            </ac:link>
          </span>
        </div>
      </td>
      <td>
        <div class="content-wrapper">
          <span style="color: rgb(112,112,112);">
            <time datetime="' . gmdate('Y-m-d', strtotime($task['complete_till'])) . '"/>
          </span>
        </div>
      </td>
    </tr>';
		}

		$data = array(
			'type' => 'page',
			'title' => date('d/m/Y', $leadDateCreate) . ' #' . $company . '. ' . $lead,
			'ancestors' => array(array('id' => ANCESTORS)),
			'space' => array('key' => SPACE_KEY),
			'body' => array( 'storage' => array( 'value' => '<p class="auto-cursor-target">
  <br/>
</p>
<ac:structured-macro ac:name="details" ac:schema-version="1">
  <ac:rich-text-body>
    <p class="auto-cursor-target">
      <br/>
    </p>
    <table class="wrapped">
      <colgroup>
        <col style="width: 242.0px;"/>
        <col style="width: 455.0px;"/>
      </colgroup>
      <tbody>
        <tr>
          <th>Lead status</th>
          <td>
            <div class="content-wrapper">
              <p>
                <ac:structured-macro ac:name="status" ac:schema-version="1">
                  <ac:parameter ac:name="colour">Blue</ac:parameter>
                  <ac:parameter ac:name="title">For execution</ac:parameter>
                  <ac:parameter ac:name=""/>
                </ac:structured-macro>
              </p>
            </div>
          </td>
        </tr>
        <tr>
          <th>Manager</th>
          <td>
            <div class="content-wrapper">
              <p>
                <ac:link>
                  <ri:user ri:userkey="' . $reporterUserKey . '"/>
                </ac:link>
              </p>
            </div>
          </td>
        </tr>
        <tr>
          <th colspan="1">
            <span>Project manager</span>
          </th>
          <td colspan="1">
            <ac:placeholder>Use @ to fill this field</ac:placeholder>
          </td>
        </tr>
        <tr>
          <th colspan="1">Lead source</th>
          <td colspan="1"><a href="' . $amoLeadUrl . '">amoCRM</a></td>
        </tr>
        <tr>
          <th colspan="1">Lead creation date</th>
          <td colspan="1">
            <div class="content-wrapper">
              <p>
                <time datetime="' . gmdate('Y-m-d', $leadDateCreate) . '"/> </p>
            </div>
          </td>
        </tr>
        <tr>
          <th colspan="1">Due date</th>
          <td colspan="1">
            <div class="content-wrapper">
              <p>
                <time datetime="' . gmdate('Y-m-d', strtotime($task['complete_till'])) . '"/> </p>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <p class="auto-cursor-target">
      <br/>
    </p>
  </ac:rich-text-body>
</ac:structured-macro>
<p>
  <strong>
    <br/>
  </strong>
</p>
<p>
  <strong>Dear colleagues, based on the results of the meeting with a potential Customer.</strong>
</p>
<p>
  <strong>Contacts:</strong>
</p>
<table class="wrapped">
  <colgroup>
    <col style="width: 112.0px;"/>
    <col style="width: 442.0px;"/>
    <col style="width: 54.0px;"/>
    <col style="width: 83.0px;"/>
    <col style="width: 57.0px;"/>
    <col style="width: 49.0px;"/>
    <col style="width: 69.0px;"/>
  </colgroup>
  <tbody>
    <tr>
      <th>Organization</th>
      <th colspan="1">Position</th>
      <th>Full name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Web</th>
      <th colspan="1">Region</th>
    </tr>
    <tr>
      <td>' . $companyCont . '</td>
      <td colspan="1">
        <p>
          <span style="color: rgb(49,57,66);">' . $position . '</span>
        </p>
      </td>
      <td>
        <p>
          <span style="color: rgb(49,57,66);">' . $contact . '</span> </p>
      </td>
      <td>
        <p><span style="color: rgb(49,57,66);">' . $phone . '</span>
        </p>
      </td>
      <td><a href="mailto:' . $email . '">' . $email . '</a>
      </td>
      <td> <a href="' . $website . '">' . $website . '</a>
      </td>
      <td colspan="1"></td>
    </tr>
  </tbody>
</table>
<p>
    <br/>
</p>
<p>
  <strong>Work on lead:</strong>
</p>
<table class="wrapped">
  <colgroup>
    <col/>
    <col/>
  </colgroup>
  <tbody>
    <tr>
      <th style="text-align: center;">
        <p>Задача в Jira и ее статус</p>
        <p><em>(Макрос "Jira Issue/Filter" с опцией "Show summary")</em></p>
      </th>
      <th style="text-align: center;">
        <p>@ Ответственный</p>
      </th>
      <th style="text-align: center;">
        <p>// Дата исполнения</p>
      </th>
    </tr>
    ' . $tasksTr . '
  </tbody>
</table>
<p>
    <br/>
</p>
<p>
  <strong>Primary information:</strong>
</p>
<p>
  <br/>
</p>
<p>
  <strong>Client request:</strong>
</p>
<p>
  <br/>
</p>
<p>
  <strong>
    <span style="color: rgb(0,0,0);">Agreement as a result of the meeting:</span>
  </strong>
</p>
<p>
  <br/>
</p>', 'representation' => 'storage' ) )
		);

		include 'post/post-confl-page.php';

		$conflPageId = $jsonDecode['id'];

		// Post amoCRM lead id to confluence page property
		$data = [
			'key' => 'amoLeadId',
			'value' => $leadId
		];
		include 'post/post-confl-property.php';

		// Post confluence page label
		$data = array(
			array(
				'prefix' => 'global',
				'name' => 'amosale'
			)
		);
		include 'post/post-confl-label.php';
?>
