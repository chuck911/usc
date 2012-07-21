<?php

/**
 * This is the model class for table "pick".
 *
 * The followings are the available columns in table 'pick':
 * @property string $id
 * @property integer $userID
 * @property string $flightNum
 * @property string $from
 * @property string $to
 * @property string $arrivalTime
 */
class Pick extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pick the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pick';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID,company,flightNum,from,to,arrivalTime,arrivalDate', 'required'),
			array('info','safe'),
			array('userID', 'numerical', 'integerOnly'=>true),
			array('flightNum, from, to', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userID, flightNum, from, to, arrivalTime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user'=>array(self::BELONGS_TO,'User','userID'),
			'applications'=>array(self::HAS_MANY,'PickApplication','pickID'),
			'applicationCount'=>array(self::STAT,'PickApplication','pickID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userID' => 'User',
			'company'=>'航空公司',
			'flightNum' => '航班号',
			'from' => '出发机场',
			'to' => '到达机场',
			'arrivalTime' => '到达时间',
			'arrivalDate' => '到达日期',	
			'info' => '留言'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('flightNum',$this->flightNum,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('arrivalTime',$this->arrivalTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
