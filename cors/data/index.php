<?php
header("Access-Control-Allow-Origin: *");

if(isset($_GET["user"])) {
    $user = $_GET["user"];
    $nextTimeLine = isset($_GET["timeLine"]) ? $_GET["timeLine"] : '';
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.instafollowers.co/phpCurl');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "user=" . $user ."&productAsks=%7B%22sm_domain%22%3A%22https%3A%2F%2Fwww.instagram.com%2F%22%2C%22preview%22%3A%220%22%2C%22sm_type_id%22%3A4%2C%22sm_id%22%3A1%2C%22link_status%22%3A0%2C%22image_way%22%3A%22%22%2C%22pid%22%3A2%2C%22page_id%22%3A174%7D&multiOptionTake=1&nextTimeline=" . $nextTimeLine);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Authority: www.instafollowers.co';
    $headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
    $headers[] = 'Accept-Language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Cookie: _ga=GA1.1.1139604816.1703075622; global=%7B%22cartAmount%22%3A0%2C%22cartName%22%3A0%7D; csrf_token=2bslGyUWYFDLEJLT4RChMfQXkWgc0QsXjwcf4jWB; XSRF-TOKEN=eyJpdiI6IlBwZ0dpT2Rqc0M1aVM0UkZtSGQrM0E9PSIsInZhbHVlIjoiZ3FlaXhRU1BjSGFYRXZ0MTV3UklwOTVNQVJJSVNTYjhoWXJIQUFjNGlsRmZJSlVjU2FqOHBUUVRlSWxjT0JNWSIsIm1hYyI6Ijg5MzkxMjNhM2Q5MjYxMWJhNzBiM2JmZjk1YmFlODI5MGVmZWM1YjA2ZjNhODY1YjAyYWY5Y2I2ZmYxMGM4NTIifQ%3D%3D; _ga_24KR2R4PF0=GS1.1.1703779540.9.1.1703779574.26.0.0';
    $headers[] = 'Origin: https://www.instafollowers.co';
    $headers[] = 'Referer: https://www.instafollowers.co/buy-instagram-likes';
    $headers[] = 'Sec-Ch-Ua: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Google Chrome\";v=\"120\"';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?1';
    $headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36';
    $headers[] = 'X-Csrf-Token: 7rRHOzWRENjUaVgdz3NBBEwJMZhnOxeT9sdwBtWM';
    $headers[] = 'X-Requested-With: XMLHttpRequest';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    print_r($result);
    } else {
        echo "Hello";
    }


?>

