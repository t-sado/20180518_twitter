<?php

require_once 'vendor/autoload.php';
use \Abraham\TwitterOAuth\TwitterOAuth;
 
//設定
$keyword = "JustinBieber";//検索キーワード
$consumerKey = "";
$consumerSecret = "";
$accessToken = "";
$accessTokenSecret = "";
 
 
//認証
$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
 
//検索結果の取得($stringはJSONの検索結果が入る）
$string = $connection->oAuthRequest(
	'https://api.twitter.com/1.1/search/tweets.json',
	'GET',
	array(
			"q" => rawurlencode($keyword), //検索キーワード
			"result_type" => "recent", //新着順に取得
			"count" => 100, //取得件数（100件が上限）
			"include_entities" => true //trueにすると添付URLについての情報を追加で取得できる
	)
);

// imgディレクトリ作成
if (!file_exists('img')) {
	mkdir('img', 0777);
}

if($string){
	//検索結果をjson_decodeで配列にしてforeach
	$obj = json_decode($string);
	
	$count = 0;
	$url_list = [];
	foreach ($obj->statuses as $status) {
		if (isset($status->entities->media)) {			
			$url = $status->entities->media[0]->media_url;
			$data = file_get_contents($url);
			$filepath = pathinfo($url);
			// 異なる画像を取得するために画像URLをチェック
			if (in_array($filepath['basename'], $url_list)) {
				continue;
			}
			$count++;
        	file_put_contents("img/img_{$count}.{$filepath['extension']}", $data);
        	$url_list[] = $filepath['basename'];
		}
		// 10件保存したら終了
		if ($count === 10) {
			break;
		}
	}
}