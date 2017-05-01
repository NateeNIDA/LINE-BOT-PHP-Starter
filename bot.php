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


function sendMsg(&$event,$access_token,$text){
	// Get text sent
	//$text = "กรุณาส่ง Location เพื่อบันทึกข้อมูลลงฐานข้อมูลพิกัด ภ.5 โดยท่านสามารถดูหน้าแผนที่ได้ที่ http://1.179.187.126/linegps/linemap.php";
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


function ansMessage(&$event,$access_token,$textm){
	// Get text sent
	$text = $textm;
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

	// Send GPs to My server====Step 1
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

function checkstate($userid){

	// Send GPD to My server====Step 1
	$cSession = curl_init();
	// Step 2
	curl_setopt($cSession,CURLOPT_URL,"http://1.179.187.126/linegps/checkstate.php?userid=$userid");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false);
	// Step 3
	$result=curl_exec($cSession);
	// Step 4
	curl_close($cSession);
	// ====
	return $result;

}

function addstate($userid,$state){

	// Send GPD to My server====Step 1
	$cSession = curl_init();
	// Step 2
	curl_setopt($cSession,CURLOPT_URL,"http://1.179.187.126/linegps/addstate.php?userid=$userid&state=$state");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false);
	// Step 3
	$result=curl_exec($cSession);
	// Step 4
	curl_close($cSession);
	// ====
	return $result;

}

function updatestate($userid,$state){

	// Send GPD to My server====Step 1
	$cSession = curl_init();
	// Step 2
	curl_setopt($cSession,CURLOPT_URL,"http://1.179.187.126/linegps/updatestate.php?userid=$userid&state=$state");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false);
	// Step 3
	$result=curl_exec($cSession);
	// Step 4
	curl_close($cSession);
	// ====
	return $result;

}

function addTempGPS(&$event,$access_token,$userid){
	$latitude = $event['message']['latitude'];
	$longitutde = $event['message']['longitude'];

	// Send GPs to My server====Step 1
	$cSession = curl_init();
	// Step 2
	curl_setopt($cSession,CURLOPT_URL,"http://1.179.187.126/linegps/addtempgps.php?gpslat=$latitude&gpslong=$longitutde&userid=$userid");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false);
	// Step 3
	$result=curl_exec($cSession);
	// Step 4
	curl_close($cSession);
	// ====

	// Get text sent
	$text = "กรุณาพิมพ์ตัวเลขเพื่อระบุประเภท 1.ADSL 2.FTTX 3.WINET 4.LLI";
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

function updateTempGroup($group,$userid){
	$latitude = $event['message']['latitude'];
	$longitutde = $event['message']['longitude'];

	// Send GPs to My server====Step 1
	$cSession = curl_init();
	// Step 2
	curl_setopt($cSession,CURLOPT_URL,"http://1.179.187.126/linegps/updatetempgroup.php?group=$group&userid=$userid");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false);
	// Step 3
	$result=curl_exec($cSession);
	// Step 4
	curl_close($cSession);
	// ====

	// Get text sent
	$text = "บันทึก Location เรียบร้อยแล้ว ดูตำแหน่งได้ที่ http://1.179.187.126/linemapzoom.php?gpslat=".$latitude."&gpslong=".$longitutde;
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

function temp2Poi($userid){

	// Send GPD to My server====Step 1
	$cSession = curl_init();
	// Step 2
	curl_setopt($cSession,CURLOPT_URL,"http://1.179.187.126/linegps/temp2poi.php?userid=$userid");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false);
	// Step 3
	$result=curl_exec($cSession);
	// Step 4
	curl_close($cSession);
	// ====
	return $result;

}

function delTemp($userid){

	// Send GPD to My server====Step 1
	$cSession = curl_init();
	// Step 2
	curl_setopt($cSession,CURLOPT_URL,"http://1.179.187.126/linegps/deltemp.php?userid=$userid");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false);
	// Step 3
	$result=curl_exec($cSession);
	// Step 4
	curl_close($cSession);
	// ====
	return $result;

}

function delState($userid){

	// Send GPD to My server====Step 1
	$cSession = curl_init();
	// Step 2
	curl_setopt($cSession,CURLOPT_URL,"http://1.179.187.126/linegps/delstate.php?userid=$userid");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false);
	// Step 3
	$result=curl_exec($cSession);
	// Step 4
	curl_close($cSession);
	// ====
	return $result;

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

			$userid = $event['source']['userId'];

			$userstate = checkstate($userid);

			sendMsg($event,$access_token,"ทดสอบ1");


			if($userstate == 0){
				sendMsg($event,$access_token,"ทดสอบ2");
				if ($event['message']['type'] == 'location') {
					addTempGPS($event,$access_token,$userid);
					addstate($userid,1);
				}else{
					defalutReply($event,$access_token);
				}

			}elseif($userstate==1){
				sendMsg($event,$access_token,"ทดสอบ3");
				if($event['message']['type'] == 'text'){
					$text = $event['message']['text'];

					if($text>=1 &&$text<=4){
						if($text==1){
							updateTempGroup("ADSL",$userid);
						}
						if($text==2){
							updateTempGroup("FTTX",$userid);
						}
						if($text==3){
							updateTempGroup("WINET",$userid);
						}
						if($text==4){
							updateTempGroup("LLI",$userid);
						}

						temp2Poi($userid);
						delTemp($userid);
						delState($userid);
					}else{
						ansMessage($event,$access_token,"กรุณาพิมพ์ใหม่");
					}

				}
				else{
					ansMessage($event,$access_token,"กรุณาพิมพ์ใหม่");
				}
			}
			else{
				sendMsg($event,$access_token,"ทดสอบ3");
				defalutReply();
			}

			//*/
		}

	}

}

echo "OK";
