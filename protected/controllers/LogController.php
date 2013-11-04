<?php
class LogController extends CController{
	public $layout='//layouts/column2';
	public $menu = array();
	public function actionViewLog(){
		$model = $_GET['model'];
		$model_id = $_GET['model_id'];
		$logs = Logs::model()->findAllByAttributes(array('model'=>$model,'model_id'=>$model_id),array('order'=>'date desc'));
		//var_dump($logs);
		$this->render('view',array('logs'=>$logs));
	}
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('viewLog'),
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
		);
	}

}
