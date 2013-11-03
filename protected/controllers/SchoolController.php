<?php
Yii::import('application.vendors.*');
require_once('phplot/phplot.php');
class SchoolController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
                'actions' => array('index', 'view', 'update', 'create', 'delete', 'admin','getPerformance','printout'),
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
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
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new School;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['School']))
		{
			$model->attributes=$_POST['School'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
		'model'=>$model,
		));
	}
	public function actionPrintout($id){
                $this->layout = "//layouts/printLayout";
		$school = School::model()->findByPk($id);
		$classes = Classm::model()->getActiveClass($id);
		//var_dump($class);
                $content = "";
		foreach($classes as $class){
			$students = $class->Students;
			$this->render('_studentView',array('students'=>$students));
			
		}
                
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

		if(isset($_POST['School']))
		{
			$model->attributes=$_POST['School'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
    public function actionGetPerformance($id){
        $grade = @$_GET['grade_id'];
        $avg = School::model()->findbyPk($id)->getAverageGrade($grade);
        $p = array();
        foreach($avg as $res){
           if(!array_key_exists($res['test_id'], $p)){
               $p[$res['test_id']]=array();
           }
           $p[$res['test_id']][$res['class']] = $res['average'];
        }
        //var_dump($p);
        $classes = Classm::model()->findAllByAttributes(array('school_id'=>$id));
        $data = array();
        $legend = array();
        foreach($p as $test_id=>$result){
            $temp = array($test_id);
            foreach($classes as $class){
                if(key_exists($class->class, $result))
                    array_push ($temp, $result[$class->class]);
                else
                    array_push ($temp, '');
            }
            array_push($data,$temp);
        }
        foreach($classes as $class){
            array_push($legend,$class->class);
        }
        /*foreach($avg as $res){
            array_push($data, array($res['class'],$res['average']));
        }*/
        //var_dump($data);
        $plot = new PHPlot();
        $plot->SetXLabel('Test Id');
        $plot->SetYLabel('Mark');
        $plot->SetDataValues($data);
        $plot->SetXTickLabelPos('none');
        $plot->SetXTickPos('none');
        $plot->SetTitle("Class Average");
        $plot->SetLegend($legend);
        $plot->DrawGraph();
    }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('School');
		$dataProvider->setPagination(
			array(
				//'class'=>'CPagination',
				'pageSize'=>20,
			)
		);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new School('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['School']))
			$model->attributes=$_GET['School'];
                
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return School the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=School::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param School $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='school-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
