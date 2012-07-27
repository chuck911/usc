<?php
class Bizrule {
	public static function PickUpdate()
	{
		$pickID = Yii::app()->request->getParam('id');
		if(!$pickID) return false;
		$pick = Pick::model()->findByPk($pickID);
		if($pick->userID === Yii::app()->user->id)
			return true;
		return false;
	}
	
	public static function EditOwn()
	{
		return Yii::app()->user->id == Yii::app()->request->getParam('id');
	}
}
