<?php
sleep(5);

$token = $_POST["token"];
$url = 'https://fcm.googleapis.com/fcm/send';
$data = array(
  'notification' => array(
    'title' => 'Hello world',
    'body' => 'Notification body goes here',
    'click_action' => 'https://google.com'
  ),
  'to' => $token
);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\nAuthorization: key=AAAA<key_omitted>",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === false) {
    echo "An internal error occurred";
}
