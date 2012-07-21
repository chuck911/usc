<?php

/**
 * This is the model class for table "notification".
 *
 * The followings are the available columns in table 'notification':
 * @property string $id
 * @property integer $userID
 * @property string $type
 * @property integer $data
 */
class Notification extends CActiveRecord
{
	const PICK_REQUEST = 'pick_request';
	const PICK_CONFIRM = 'pick_confirm';

	public static function add($userID,$type,$data)
	{
		$notification = new Notification;
		$notification->userID = $userID;
		$notification->type = $type;
		$notification->data = json_encode($data);
		return $notification->save();
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'notification';
	}

	public function rules()
	{
		return array(
			array('userID, type, data', 'required'),
			array('userID', 'numerical', 'integerOnly'=>true),
			array('id, userID, type, data', 'safe', 'on'=>'search'),
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
			'userID' => 'User',
			'typeID' => 'Type',
			'data' => 'Data',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('typeID',$this->typeID);
		$criteria->compare('data',$this->data);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
