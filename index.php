<?php

$email = 'email@domain.com';
$api_key = 'API-KEY-HERE'; //Mailchimp API Key
$list_id = 'LIST-ID'; //Audience/List ID
$data_center = substr($api_key, strpos($api_key, '-') + 1);

$url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members';
 
$tags = array('Your Tag');

$json = json_encode([
    'email_address' => $email,
    'status'        => 'subscribed',
    'tags'          => $tags
]);
 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
$result = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if($status_code == 200) {
    echo 'Email successfully added to the list.';
} else {
    echo 'Email failed to be added to the list.';
}
