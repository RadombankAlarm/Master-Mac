<?php
include 'headbot.php';
// Function Return message
function t1($tt1)
{
	$messages = [
		'type' => 'text',
		'text' => $tt1
		];
	return $messages;
}
//$StrGet = $_GET["strget"];
//$text = $StrGet;
$text = "Test";
	
	
if (!is_null($text)) {
	$messages = t1($text);
	$url = 'https://api.line.me/v2/bot/message/push';
	$data = [
  		'to' => 'U1225f0099fd26468bf40e85bc7dac258',
		'messages' => [$messages]
		];
	$post = json_encode($data);
	$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	echo $result . "\r\n";	
}
?>
