<?php
class Notifications extends CWidget
{
	public $notifications;
	public $markAllRead = true;
		
	public function init()
	{
		$this->notifications = Notification::model()->findAll(
			'userID=:userID',
			array(':userID'=>Yii::app()->user->id)
		);
		//if(!$markAllRead) return;
		foreach ($this->notifications as $notification) {
			$notification->read = 1;
			$notification->save();
		}
	}

	public function run()
	{
		$this->render('notifications');
	}
}	
