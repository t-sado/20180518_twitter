<?php

require_once 'vendor/autoload.php';

use \Abraham\TwitterOAuth\TwitterOAuth;
 
//設定
$keyword = "JustinBieber";//検索キーワード　「http」をAND検索するとより確実なように思う
$consumerKey = "UhuBsj54DbRnnHGQYaPywHmAi";
$consumerSecret = "e1zSaGoQorVKzyW5W7U8LaAmkUsf3nnjdIHCxh45Y03bnnBj86";
$accessToken = "42566916-5CI2BDtmiUQdWFKtTY6ajgxmLlYjURI4ftW2K88h3";
$accessTokenSecret = "YHfdFB1RJxIcHQ6XOriX0GZhmZmFpNmI5wegaBIRDflIU";
 
 
//認証
$connection = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);
 
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
 
if($string){
	//検索結果をjson_decodeで配列にしてforeach
	$obj = json_decode($string);
	
	foreach ($obj->statuses as $status) {
		if (isset($status->entities->media)) {
			var_dump($status->entities->media[0]->media_url);
		}
	}
}