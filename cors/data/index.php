<?php
include('../config.php');

header("Access-Control-Allow-Origin: *");

if(isset($_GET["user"])) {
    $user = $_GET["user"];
    $maxId = isset($_GET["timeLine"]) ? $_GET["timeLine"] : '';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.instagram.com/api/v1/feed/user/' . $user . '/username/?count=12&max_id=' . $maxId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Authority: www.instagram.com';
    $headers[] = 'Accept: */*';
    $headers[] = 'Accept-Language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7';
    $headers[] = 'Cookie: ' . $cookie;
    $headers[] = 'Dpr: 2';
    $headers[] = 'Referer: https://www.instagram.com/google/';
    $headers[] = 'Sec-Ch-Prefers-Color-Scheme: light';
    $headers[] = 'Sec-Ch-Ua: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Google Chrome\";v=\"120\"';
    $headers[] = 'Sec-Ch-Ua-Full-Version-List: \"Not_A Brand\";v=\"8.0.0.0\", \"Chromium\";v=\"120.0.6099.130\", \"Google Chrome\";v=\"120.0.6099.130\"';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?1';
    $headers[] = 'Sec-Ch-Ua-Model: \"Nexus 5\"';
    $headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
    $headers[] = 'Sec-Ch-Ua-Platform-Version: \"6.0\"';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36';
    $headers[] = 'Viewport-Width: 436';
    $headers[] = 'X-Asbd-Id: 129477';
    $headers[] = 'X-Csrftoken: ' . $csfrToken;
    $headers[] = 'X-Ig-App-Id: ' . $igAppId;
    $headers[] = 'X-Ig-Www-Claim: hmac.AR3RTleIqct_RIze_1XSELEl2jcfmJmWH11ZuFnxpRZf_pit';
    $headers[] = 'X-Requested-With: XMLHttpRequest';

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    curl_close($ch);

    $jsonArray = array();
    $imgArray = array();

    $data = json_decode($result, true);
    $posts = $data['items'];
    $moreAvailable = $data['more_available'];
    $profilePic = $data['user']['profile_pic_url'];
    $jsonArray["profilePic"] = $profilePic;
    $jsonArray["moreAvailable"] = $moreAvailable;

    if($moreAvailable) {
        $nextId = $data['next_max_id'];
        $jsonArray["nextId"] = $nextId;
    }

    foreach ($posts as $p) {
        array_push($imgArray, $p['image_versions2']['candidates'][0]['url']);
    }

    $jsonArray["posts"] = $imgArray;
    $json = json_encode($jsonArray);
    http_response_code(200);

    echo $json;
} else {
    echo "Hello";
}
?>