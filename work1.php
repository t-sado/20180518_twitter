<?php

require_once 'vendor/autoload.php';

use \Abraham\TwitterOAuth\TwitterOAuth;
 
//�ݒ�
$keyword = "JustinBieber";//�����L�[���[�h�@�uhttp�v��AND��������Ƃ��m���Ȃ悤�Ɏv��
$consumerKey = "UhuBsj54DbRnnHGQYaPywHmAi";
$consumerSecret = "e1zSaGoQorVKzyW5W7U8LaAmkUsf3nnjdIHCxh45Y03bnnBj86";
$accessToken = "42566916-5CI2BDtmiUQdWFKtTY6ajgxmLlYjURI4ftW2K88h3";
$accessTokenSecret = "YHfdFB1RJxIcHQ6XOriX0GZhmZmFpNmI5wegaBIRDflIU";
 
 
//�F��
$connection = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);
 
//�������ʂ̎擾($string��JSON�̌������ʂ�����j
$string = $connection->oAuthRequest(
	'https://api.twitter.com/1.1/search/tweets.json',
	'GET',
	array(
			"q" => rawurlencode($keyword), //�����L�[���[�h
			"result_type" => "recent", //�V�����Ɏ擾
			"count" => 100, //�擾�����i100��������j
			"include_entities" => true //true�ɂ���ƓY�tURL�ɂ��Ă̏���ǉ��Ŏ擾�ł���
		)
	);
 
if($string){
	//�������ʂ�json_decode�Ŕz��ɂ���foreach
	$obj = json_decode($string);
	
	foreach ($obj->statuses as $status) {
		if (isset($status->entities->media)) {
			var_dump($status->entities->media[0]->media_url);
		}
	}
}