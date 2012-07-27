<?php
class RenrenCommand extends CConsoleCommand
{
	public function actionInfo()
	{
		$users = User::model()->findAll();
		$ids = array();
		foreach ($users as $user) {
			if($user->service=='renren'){
				$ids[]=$user->openid;
			}
		}
		$ids = implode(',',$ids);
		$token = '202527|6.a0a23e173cc3e1b27adc7c0db6443f74.2592000.1345978800-240530621';
		$infos = RenrenInfo::fetch($token,$ids);
		foreach ($infos as $info) {
			$uid = $info['uid'];
			$user = User::model()->find('openid=:openid',array(':openid'=>$uid));
			if(isset($info['hometown_location']['province'])) $user->homeProvince = $info['hometown_location']['province'];
			if(isset($info['hometown_location']['city'])) $user->homeCity = $info['hometown_location']['city'];
			if(isset($info['sex'])) $user->gender = $info['sex']==1 ? '男':'女'; 
			if(isset($info['birthday'])) $user->birthday = $info['birthday'];
			if(isset($info['mainurl'])) $user->largeAvatar = $info['mainurl'];
			elseif(isset($info['headurl'])) $user->largeAvatar = $info['headurl'];
			echo $info['name'].',';
			$user->save();
		}
	}
}
