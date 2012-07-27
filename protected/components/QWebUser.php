<?php

class QWebUser extends RWebUser
{
	public function login($identity,$duration=0)
	{
		$this->registerUser($identity);
		return parent::login($identity,$duration);
	}

	protected function registerUser($identity)
	{
		// var_dump($identity->attributes);Yii::app()->end();
		$user = User::model()->find('openid=:openid',array(':openid'=>$identity->getId()));
		if(!$user){
			$user = new User;			
			$user->openid = $identity->getId();
			$user->name = $identity->getName();
			$user->service = $identity->getState('service');
			foreach ($identity->attributes as $key => $value) {
				if($value) $user->$key = $value;
			}
			if($user->accessToken && $user->service == 'renren'){
				$arr = RenrenInfo::fetch($user->accessToken);
				$info = $arr[0];
				if(isset($info['hometown_location']['province'])) $user->homeProvince = $info['hometown_location']['province'];
				if(isset($info['hometown_location']['city'])) $user->homeCity = $info['hometown_location']['city'];
				if(isset($info['sex'])) $user->gender = $info['sex']==1 ? '男':'女'; 
				if(isset($info['birthday'])) $user->birthday = $info['birthday'];
				if(isset($info['mainurl'])) $user->largeAvatar = $info['mainurl'];
				elseif(isset($info['headurl'])) $user->largeAvatar = $info['headurl'];
			}
			$user->save();
		}
		
		if($user->id) $identity->setLocalId($user->id);
	}
}
