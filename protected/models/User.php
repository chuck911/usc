<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $openid
 * @property string $name
 * @property string $avatar
 */
class User extends CActiveRecord
{
	public function hasRequestToPick($pickID)
	{
		return PickApplication::model()->exists(
			'userID=:userID AND pickID=:pickID',
			array(':userID'=>$this->id,':pickID'=>$pickID)
		);
	}

	public function getTa()
	{
		if($this->gender=='男') return '他';
		if($this->gender=='女') return '她';
		return 'ta';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'user';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('openid, name, avatar','required'),
			array('openid, name', 'length', 'max'=>64),
			array('avatar', 'length', 'max'=>128),

			array('id, openid, name, avatar', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'openid' => 'Openid',
			'name' => 'Name',
			'avatar' => 'Avatar',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('avatar',$this->avatar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static $currentUser;
	public static function current(){
		if(Yii::app()->user->isGuest) return false;
		if(!self::$currentUser)
			self::$currentUser = User::model()->findByPk(Yii::app()->user->id);
		return self::$currentUser;
	}
}
