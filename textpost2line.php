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
$strget = $_POST["strget"];
//$strget = iconv(mb_detect_encoding($strget, mb_detect_order(), true), "UTF-8", $strget);
//$strget = utf8_decode($strget)
//$strget = mb_convert_encoding($strget, 'UTF-8');
$text = $strget;
$text = "TestTest";
	
	
if (!is_null($text)) {
//if (!empty($_POST)){
	//$text = "ä´éÃÑº Mail ¨Ò¡ :".$return_path."\nËÑÇ¢éÍ :".$subject."\nà¹×èÍËÒ".$plain;
	$messages = t1($text);
	$url = 'https://api.line.me/v2/bot/message/push';
	$data = [
  		'to' => 'C11cbe42083840cd830306f601e985184',
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
	curl_setopt($ch, CURLOPT_PROXY, $proxy);
	curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
	$result = curl_exec($ch);
	curl_close($ch);
	echo $result . "\r\n";	
}
?>
