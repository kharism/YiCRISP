<?php
Yii::import('application.vendors.*');
require_once('phplot/phplot.php');
class ClassmController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'update', 'create', 'delete', 'admin','printout', 'ajaxGetAllClass',
						'classPerformanceGraph','ajaxGetDetail','getStudentPerformance'),
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Classm;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Classm'])) {
            $model->attributes = $_POST['Classm'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Classm'])) {
            $model->attributes = $_POST['Classm'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Classm');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
    
    public function actionPrintout($id){
        $this->layout = "//layouts/printLayout";
		//$school = School::model()->findByPk($id);
		$classes = Classm::model()->findAllByPk(array($id));
		//var_dump($class);
        $content = "";
                
		foreach($classes as $class){
			$criteria = new CDbCriteria();
			$criteria->distinct=true;
			$rrr=Yii::app()->db->createCommand("select distinct student_id from test_result where class_id=".$id);
			$rrr = $rrr->query()->readAll();
			foreach($rrr as $key=>$val){
				$rrr[$key] = $val['student_id'];
			}
			$students = Student::model()->findAllByPk($rrr);
			$this->render('_studentView',array('students'=>$students));			
		}
                
	}
	
	public function actionGetStudentPerformance($id){
		$performances = TestResult::model()->findAll(array(
            'with' => array('test'),
            'order' => 'test.date',
            'condition' => 'student_id=' . $id
        ));
        $res = TestResult::model()->getStudentCurrentResult($id);
		$data = array();
		$dummy = array();
		//var_dump($res);
		$legends = array();
		$ids = array();
		foreach($res as $t){
			$dummy[$t->test->category_one][] = $t->mark;
			$legends[$t->test->category_one] = CategoryTestOne::model()->findByPk($t->test->category_one)->category;	
			$ids[] = $t->test->category_one;
		}
		//var_dump($legends);
		//var_dump($dummy);
		$maxNum = 0;
		foreach($dummy as $y){
			$maxNum = max($maxNum,count($y));
		}
		//echo "rr".$maxNum;		
		for($i=0;$i<$maxNum;$i++){
			$data[$i][] = $i+1;
			foreach(array_keys($dummy) as $t)
			{
				$data[$i][] = $dummy[$t][$i];
			} 				
		}
		//var_dump($data);die();
		$plot = new PHPlot();
        $plot->SetDataValues($data);
        $plot->SetPlotAreaWorld(0, 0, null, 100);
        $plot->SetXTickLabelPos('none');
        $plot->SetXTickPos('none');
        $plot->SetTitle("Mark");
        $plot->SetLegend($legends);
        $plot->DrawGraph();
	}

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Classm('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Classm']))
            $model->attributes = $_GET['Classm'];
        if(isset($_GET['showAll']))
			$model->AllTerm = true;
        $this->render('admin', array(
            'model' => $model,
        ));
    }
    public function actionAjaxGetDetail(){
        $id = $_GET['id'];
        $t = Classm::model()->findByPk($id);
        echo $t->schedule;
    }

    public function actionAjaxGetAllClass() {
        $Student = @$_POST['Student'];
        if ($Student != null) {
            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('school_id' => $Student['school_id']));
            $criteria->with = array('Terms');
            $criteria->addCondition('Terms.date_begin<now() and Terms.date_end>now()');
            //var_dump($criteria->condition);die();
            $model = Classm::model()->findAll($criteria);
            //$data = CHtml::listData($model, 'id', 'class');
            /* var_dump($data);
              die(); */
            foreach ($model as $value) {
                echo CHtml::tag('option', array('value' => $value->id), CHtml::encode($value->class."($value->Capacity/$value->max_capacity)"), true);
            }
        }
        if ($Student == null) {
            $Student = @$_POST['Test'];
            $model = Classm::model()->findAllByAttributes(array('school_id' => $Student['school']));
            $data = CHtml::listData($model, 'id', 'class');
            /* var_dump($data);
              die(); */
            foreach ($data as $value => $name) {
                echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Classm the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Classm::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Classm $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'classm-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionClassPerformanceGraph($id){
        $model=Classm::model()->findByPk($id);
        $avg = $model->averageClass;
        $data = array();
        foreach($avg as $res){
            array_push($data, array("Test ".$res['id'],$res['average']));
        }
        $plot = new PHPlot();
        $plot->SetPlotType('bars');
        $plot->SetDataValues($data);
        $plot->SetXTickLabelPos('none');
        $plot->SetXTickPos('none');
        $plot->SetTitle("Class Average");
        $plot->SetLegend(array('Mark'));
        $plot->DrawGraph();
    }

}
