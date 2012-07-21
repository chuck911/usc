<?php
class NotifyLabel extends CWidget
{
	public $count;
	public function init()
	{
		$this->count = Notification::model()->count(
			'userID=:userID AND `read`=0',
			array(':userID'=>Yii::app()->user->id)
		);
	}

	public function run()
	{
		$this->render('notifylabel');
	}
}
