<?php
class RenrenInfo
{
	public static function fetch($access_token,$uids = null)
	{
		Yii::import('ext.renrensdk.RenrenRestApiService');
		$config				= new stdClass;

		$config->APIURL		= 'http://api.renren.com/restserver.do'; //RenRen网的API调用地址，不需要修改
		$config->APIKey		= 'e29c5ee4ce004e0e8956cde4654a82f6';	//你的API Key，请自行申请
		$config->SecretKey	= 'ee062f6a045e4f599c5951281e7c776b';	//你的API 密钥
		$config->APIVersion	= '1.0';	//当前API的版本号，不需要修改
		$config->decodeFormat	= 'json';	//默认的返回格式，根据实际情况修改，支持：json,xml
		$api = new RenrenRestApiService($config);
		$params = array('fields'=>'uid,name,sex,birthday,mainurl,hometown_location,university_history,tinyurl,headurl');
		$params['access_token'] = $access_token;
		if($uids) $params['uids'] = $uids;
		$res = $api->rr_post_curl('users.getInfo', $params);
		return $res;
	}
}
