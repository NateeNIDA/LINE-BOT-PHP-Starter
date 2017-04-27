<?php

function defalutReply(&$event,$access_token){
	// Get text sent
	$text = "กรุณาส่ง Location เพื่อบันทึกข้อมูลลงฐานข้อมูลพิกัด ภ.5 โดยท่านสามารถดูหน้าแผนที่ได้ที่ http://1.179.187.126/linegps/linemap.php";
	// Get replyToken
	$replyToken = $event['replyToken'];

	// Build message to reply back
	$messages = [
		'type' => 'text',
		'text' => $text
	];

	// Make a POST Request to Messaging API to reply to sender
	$url = 'https://api.line.me/v2/bot/message/reply';
	$data = [
		'replyToken' => $replyToken,
		'messages' => [$messages],
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
}

function saveGps1(&$event,$access_token){
	$latitude = $event['message']['latitude'];
	$longitutde = $event['message']['longitude'];



	// Send GPD to My server====Step 1
	$cSession = curl_init();
	// Step 2
	curl_setopt($cSession,CURLOPT_URL,"http://1.179.187.126/linegps/insertpoi.php?gpsname=ทดสอบ&gpsgroup=FTTx&gpslat=$latitude&gpslong=$longitutde");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false);
	// Step 3
	$result=curl_exec($cSession);
	// Step 4
	curl_close($cSession);
	// ====


	// Get text sent
	$text = "บันทึก Location เรียบร้อยแล้ว ดูตำแหน่งได้ที่ http://1.179.187.126/linegps/linemapzoom.php?gpslat=".$latitude."&gpslong=".$longitutde;
	// Get replyToken
	$replyToken = $event['replyToken'];
	// Build message to reply back
	$messages = [
		'type' => 'text',
		'text' => $text
	];
	// Make a POST Request to Messaging API to reply to sender
	$url = 'https://api.line.me/v2/bot/message/reply';
	$data = [
		'replyToken' => $replyToken,
		'messages' => [$messages],
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
}

$access_token = 'TuW0H/TfMxwVBHwEi6Zt729tKALS9WMIj0KTS2ahufD2Yttfk9E2yZQqGjrucaIguFuB2DdxnnXQ2QrN7Im9n/Yv5lwr4q7a1952aLTyJJEVm1F97R9GjbxoWm/iOhUwxanRbPWXsec15hNJxNAJXgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message') {

			if ($event['message']['type'] == 'location') {
				saveGps1($event,$access_token);
			}else{
				defalutReply($event,$access_token);
			}

		}

	}

}

echo "OK";
