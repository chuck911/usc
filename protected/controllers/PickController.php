<?php

class PickController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/pick';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','apply','aspicker','mine','confirm'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'pick'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pick;
		// $this->performAjaxValidation($model);
		if(isset($_POST['Pick']))
		{
			$model->userID = Yii::app()->user->id;
			$model->attributes=$_POST['Pick'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pick']))
		{
			$model->attributes=$_POST['Pick'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionApply($id)
	{
		$application = new PickApplication;
		$application->pickID = $id;
		if(isset($_POST['PickApplication']))
		{
			$application->userID = Yii::app()->user->id;
			$application->attributes = $_POST['PickApplication'];
			if($application->save()){
				Notification::add($application->pick->userID,Notification::PICK_REQUEST,array(
					'pickerID'=>$application->userID,
					'pickerName'=>$application->user->name,
					'pickerAvatar'=>$application->user->avatar,
					'pickerTa'=>$application->user->ta,
					'pickID'=>$application->pick->id,
				));
				$this->redirect(array('view','id'=>$application->pickID));	
			}
		}
		$pick = $this->loadModel($id); 
		$this->render('apply',array('pick'=>$pick,'application'=>$application));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pick');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionMine()
	{
		$criteria = new CDbCriteria(array(
			'condition'=>'t.userID=:userID',
			'params'=>array(':userID'=>Yii::app()->user->id),
			'order'=>'t.id DESC',
			'with'=>array('applications'),
		));
		$dataProvider=new CActiveDataProvider('Pick', array('criteria'=>$criteria));
		$this->render('mine',array('dataProvider'=>$dataProvider));
	}

	public function actionConfirm()
	{
		$id = Yii::app()->request->getParam('application_id');
		$application = PickApplication::model()->findByPk($id);
		if($application){
			$application->confirmText = Yii::app()->request->getParam('pick_confirm');
			$application->confirm = 1;
			if($application->save()){
				Notification::add($application->userID,Notification::PICK_CONFIRM,array(
					'pickedID'=>$application->pick->user->id,
					'pickedName'=>$application->pick->user->name,
					'pickedAvatar'=>$application->pick->user->avatar,
					'pickedTa'=>$application->pick->user->ta,
					'pickID'=>$application->pick->id,
				));
			}
		}
		$this->redirect(array('pick/mine'));
	}

	public function actionAspicker()
	{
		$criteria = new CDbCriteria(array(
			'condition'=>'t.userID=:userID',
			'params'=>array(':userID'=>Yii::app()->user->id),
			'order'=>'t.id DESC',
			'with'=>array('pick'),
		));
		$dataProvider=new CActiveDataProvider('PickApplication', array('criteria'=>$criteria));
		$this->render('aspicker',array('dataProvider'=>$dataProvider));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pick('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pick']))
			$model->attributes=$_GET['Pick'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Pick::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pick-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
