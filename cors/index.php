<?php

$imgurl = $_GET["imgurl"];
$url1 = base64_decode($imgurl);

header("Access-Control-Allow-Origin: *");
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url1);


curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Sec-Ch-Ua: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Google Chrome\";v=\"120\"';
$headers[] = 'Referer: https://www.instagram.com/';
$headers[] = 'Origin: https://www.instagram.com';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
header('Content-type: image/png');
echo $result;
?>

