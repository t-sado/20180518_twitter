<?php

require_once 'vendor/autoload.php';
use \Abraham\TwitterOAuth\TwitterOAuth;
 
//�ݒ�
$keyword = "JustinBieber";//�����L�[���[�h
$consumerKey = "";
$consumerSecret = "";
$accessToken = "";
$accessTokenSecret = "";
 
 
//�F��
$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
 
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

// img�f�B���N�g���쐬
if (!file_exists('img')) {
	mkdir('img', 0777);
}

if($string){
	//�������ʂ�json_decode�Ŕz��ɂ���foreach
	$obj = json_decode($string);
	
	$count = 0;
	$url_list = [];
	foreach ($obj->statuses as $status) {
		if (isset($status->entities->media)) {			
			$url = $status->entities->media[0]->media_url;
			$data = file_get_contents($url);
			$filepath = pathinfo($url);
			// �قȂ�摜���擾���邽�߂ɉ摜URL���`�F�b�N
			if (in_array($filepath['basename'], $url_list)) {
				continue;
			}
			$count++;
        	file_put_contents("img/img_{$count}.{$filepath['extension']}", $data);
        	$url_list[] = $filepath['basename'];
		}
		// 10���ۑ�������I��
		if ($count === 10) {
			break;
		}
	}
}