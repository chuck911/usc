<?php

class QWebUser extends CWebUser
{
	public function login($identity,$duration=0)
	{
		$this->registerUser($identity);
		return parent::login($identity,$duration=0);
	}

	protected function registerUser($identity)
	{
		$user = User::model()->find('openid=:openid',array(':openid'=>$identity->getId()));
		if(!$user){
			$user = new User;			
			$user->openid = $identity->getId();
			$user->name = $identity->getName();
		}
		$user->avatar = $identity->avatar;
		$user->gender = $identity->gender;
		$user->save();
		if($user->id) $identity->setLocalId($user->id);
	}
}
