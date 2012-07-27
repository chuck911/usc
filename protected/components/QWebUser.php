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
		}
		$user->service = $identity->getState('service');
		foreach ($identity->attributes as $key => $value) {
			if($value) $user->$key = $value;
		}
		$user->save();
		if($user->id) $identity->setLocalId($user->id);
	}
}
