<?php

class PickController extends RController
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
			'rights', // perform access control for CRUD operations
		);
	}

	public function allowedActions()
	{
		return 'index,view';
	}

	// public function accessRules()
	// {
	// 	return array(
	// 		array('allow',  // allow all users to perform 'index' and 'view' actions
	// 			'actions'=>array('index','view'),
	// 			'users'=>array('*'),
	// 		),
	// 		array('allow', // allow authenticated user to perform 'create' and 'update' actions
	// 			'actions'=>array('create','update','admin','delete','apply','aspicker','mine','confirm'),
	// 			'users'=>array('@'),
	// 		),
	// 		array('deny',  // deny all users
	// 			'users'=>array('*'),
	// 		),
	// 	);
	// }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->pageTitle = '接机信息 #'.$id;
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
		$this->pageTitle = '求接机';
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
		$this->pageTitle = '更新接机信息';
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
		$this->pageTitle = '确认请求接机';
		$pick = $this->loadModel($id);
		$applied = PickApplication::model()->exists(
			'userID=:userID AND pickID=:pickID',
			array(':userID'=>Yii::app()->user->id,':pickID'=>$pick->id)
		);
		$application = new PickApplication;
		$application->pickID = $id;
		if(isset($_POST['PickApplication']) && !$applied)
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
		$this->render('apply',array('pick'=>$pick,'application'=>$application,'applied'=>$applied));
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
		$this->pageTitle = '接机';
		$dataProvider=new CActiveDataProvider('Pick');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionMine()
	{
		$this->pageTitle = '谁来接我';
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
		$this->pageTitle = '确认接机';
		$id = Yii::app()->request->getParam('application_id');
		$application = PickApplication::model()->findByPk($id);
		if($application && $application->pick->userID == Yii::app()->user->id ){
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
		$this->pageTitle = '我要接谁';
		$criteria = new CDbCriteria(array(
			'condition'=>'t.userID=:userID',
			'params'=>array(':userID'=>Yii::app()->user->id),
			'order'=>'t.id DESC',
			'with'=>array('pick'),
		));
		$dataProvider=new CActiveDataProvider('PickApplication', array('criteria'=>$criteria));
		$this->render('aspicker',array('dataProvider'=>$dataProvider));
	}

	public function actionAssign($id)
	{
		$pick = $this->loadModel($id);
		if(isset($_POST['assigned'])){
			$application = new PickApplication;
			$application->pickID = $id;
			$application->userID = $_POST['assigned'];
			$application->message = '管理员指派';
			$application->confirm = 2;
			if($application->save()){
				$this->redirect(array('view','id'=>$application->pickID));
			}
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->pageTitle = '接机管理';
		$model=new Pick('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pick']))
			$model->attributes=$_GET['Pick'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Pick::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pick-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
