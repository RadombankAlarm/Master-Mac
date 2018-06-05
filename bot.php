<?php
include 'headbot.php';
include 'functionbot.php';
// Get POST body content
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {
  foreach ($events['events'] as $event) {
    // Reply only when Follow me.
		if (($event['type'] == 'follow') or ($event['type'] == 'join')) {
			// Get user follow or join me
			$touserid = $event['source']['userId'];
			$toroomid = $event['source']['roomId'];
			$togroupid = $event['source']['groupId'];
			// Gen Text Reply
			$gentext = "ขอบคุณที่ติดตาม CAC ครับ";
			// Get Replytoken
			$replyToken = $event['replyToken'];
			//Make a POST Request to Messaging API to reply to follower
			$messages = t1($gentext);
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = data1($replyToken,$messages);
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
			
			// Find User Data
			$url = 'https://api.line.me/v2/bot/profile/'.$touserid;
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			curl_close($ch);
			//echo $result . "\r\n";
			$events = json_decode($result, true);
			// Make Push Messageing
			$displayName = $events['displayName'];
			$userId = $events['userId'];
			$text = $displayName." User\n".$userId;
			$messages = [
				'type' => 'text',
				'text' => $text
				//.'\nRequest '.$reqtext
			];
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
			
			
			// Find Group Data
			$text = "Group\n".$togroupid;
			$messages = [
				'type' => 'text',
				'text' => $text
				//.'\nRequest '.$reqtext
			];
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
  }
}
?>
