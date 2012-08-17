<?php
define("CLIXXIE_APP_ID", "cb6b65d98f78e668d7eed4d6b93fb6b7");
define("CLIXXIE_APP_SECRET", "5257144835fea3d3a7f92556c61b3783");
define("CLIXXIE_API_BASEPATH", "http://tunnel.sniko.pl/api/");
define("CLIXXIE_API_VERSION", "v1.1.0");

	
	$content = array('client_id' => CLIXXIE_APP_ID, 'client_secret' => CLIXXIE_APP_SECRET);
	$_POST['content'] = $_POST['content'] ?: array();
	foreach($_POST['content'] as $key => $val) {
		$content[$key] = $val;
	}
	$content['locale'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?: 'en',0,2);
	$content = http_build_query($content);
	$opts = array('http' =>
		array(
			'method'=> $_POST['method']
		,	'header' => array(
				'API-VERSION: application/vnd.clixxie-fotobuch-' . CLIXXIE_API_VERSION
			,	'Content-type: application/x-www-form-urlencoded'
			,	'Content-Length: ' . strlen($content)
			)
		,	'content' => $content
		,	'ignore_errors' => true
		)
	);
	$context  = stream_context_create($opts);
	$result = file_get_contents(CLIXXIE_API_BASEPATH . $_POST['url'], false, $context);
	echo $result;
?>
