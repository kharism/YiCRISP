<?php

Yii::import('application.vendors.*');
require_once('phplot/phplot.php');

class StudentController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    public function actions() {
        return array(
            'exportTable' => array(
                'class' => 'ext.htmltableui.actions.HtmlExportCsv',
                'path' => '/csv/',
            ),
            'aclist' => array(
                'class' => 'application.components.EAutoCompleteAction',
                'model' => 'User', //My model's class name
                'attribute' => 'username', //The attribute of the model i will search
            ),
        );
    }
    
    

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
                'actions' => array('index', 'view', 'update', 'create', 'delete', 'admin', 'exportTable', 'performanceGraph', 'report', 'ajaxGetStudent', 'aclist','test'),
                'roles' => array('admin'),
            ),
            array('allow',
                'actions' => array('myChild'),
                'roles' => array('admin', 'parent')),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function acttionTest(){
        
    }

    public function actionMyChild() {
        $dataProvider = new CActiveDataProvider('Student', array(
            'criteria' => array(
                'condition' => 'parent_id=' . Yii::app()->user->id,
            )
        ));
        $this->render('index', array('dataProvider' => $dataProvider));
    }

    public function actionAjaxGetStudent($id) {
        $id = $_GET['id'];
        $model = Student::model()->findByRegistrationId($id);
        //var_dump($model);
        //die();
        $this->renderPartial('_view', array('data' => $model));
        if (isset($_GET['payment'])) {
            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('student_id' => $model->id,'refund_id'=>0));
            $criteria->order = 'year desc,month desc';
            $criteria->limit = '6';
            $payment = Payment::model()->findAll($criteria);
	    $tuition = Helper::getConfig('tuition'.$model->grade);
	    $promotion = Promotion::model()->findAll();
	    $promotions = array();
	    foreach($promotion as $o){
	    	$promotions[$o->id] = $o->getPrice($model->id);
	    }
	    $this->renderPartial('lastPayment', array('paymentData' => $payment,'tuition'=>$tuition,'promotion'=>$promotions));            
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $performance = TestResult::model()->findAll(array(
            'with' => array('test'),
            'order' => 'test.date',
            'condition' => 'student_id=' . $id
        ));
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'performance' => $performance,
        ));
    }

    public function actionPerformanceGraph($id) {
        $performances = TestResult::model()->findAll(array(
            'with' => array('test'),
            'order' => 'test.date',
            'condition' => 'student_id=' . $id
        ));
        $data = array();
        foreach ($performances as $performance) {
            array_push($data, array($performance->test_id, $performance->mark, $performance->calculatedMark));
        }
        //var_dump($data);die();
        $plot = new PHPlot();
        $plot->SetDataValues($data);
        $plot->SetXTickLabelPos('none');
        $plot->SetXTickPos('none');
        $plot->SetTitle("Mark");
        $plot->SetLegend(array('Mark', 'Calculated Mark'));
        if (@$_GET['forPDF'] == 1) {
            $plot->SetIsInline(TRUE);
            $plot->SetOutputFile(Yii::app()->basePath.'/temp.png');
        }
        $plot->DrawGraph();
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Student;
        $model->date_enter = date("Y-m-d");
        $parentModel = new User;
        $payment = new Payment;
        $payment->ammount = Config::model()->findByAttributes(array('name' => 'tuition'))->value;
        $payment->ammount += Config::model()->findByAttributes(array('name' => 'book'))->value;
        $payment->ammount += Helper::getConfig('registration');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

	if (isset($_POST['Student'])) {
		//var_dump($_POST['Student']);die();
		$model->attributes = $_POST['Student'];
		$acc = User::model()->findByAttributes(array('email'=>$_POST['Student']['parent_id']));
		//$model->parent_id=$acc->id;
		//var_dump($model->attributes);die();
		$model->grade_enter = $model->grade;
                $model->class_enter = $model->class;
            $model->parent_id = $acc->id;
            //die();
            if ($model->parent_id == 0) {
                $parentModel->attributes = $_POST["User"];
                foreach ($_POST["User"] as $attr => $val) {
                    $parentModel->$attr = $val;
                }
                $parentModel->password = md5($parentModel->password);
                if ($parentModel->save()) {
                    $model->parent_id = $parentModel->id;
                    $groupModel = new UserGroup();
                    $groupModel->user_id = $parentModel->id;
                    $groupModel->group_id = 6;
                    $groupModel->save();
                } else {
                    
                }
            }
			//echo count($parentModel->errors)." <<<<";
            if (count($parentModel->errors) == 0 && $model->save()) {
		    //var_dump($model->getPrimaryKey());
                if (isset($_POST['Payment'])) {
                    $invoice = new Invoice;
                    $invoice->ammount = $_POST['Payment']['ammount'];
                    $invoice->receiver_id = Yii::app()->user->id;
					$invoice->student_id = $model->id;
					$invoice->grade_received = $_POST['Student']['grade'];
                    $invoice->payment_method = $_POST['Payment']['payment_method'];
                    $invoice->refferal_id = $_POST['Payment']['refferal_id'];
                    $invoice->save();

                    $payment = new Payment;
                    $payment->year = date("Y");
                    $payment->attributes = $_POST['Payment'];
                    $payment->student_id = $model->id;
                    $payment->applyPayment();
                }


                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'parentModel' => $parentModel,
            'paymentModel' => $payment,
        ));
    }

    public function actionReport($id) {
        $performance = TestResult::model()->findAll(array(
            'with' => array('test'),
            'order' => 'test.date',
            'condition' => 'student_id=' . $id
        ));

        $html = $this->renderPartial(
                'view', array(
            'model' => $this->loadModel($id),
            'performance' => $performance,
            'forPDF' => 1,
                ), true);
        //echo $html;
        //$r = new HTML2PDF($orientation, $html, $langue);
        $html2pdf = Yii::app()->ePdf->HTML2PDF('p', 'A4', 'en');
        $html2pdf->WriteHTML($html);
        $html2pdf->setTestIsImage(FALSE);
        $html2pdf->Output();
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $oldStatus = $model->active;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->parent_id = User::model()->findByPk($model->parent_id)->email;
        if (isset($_POST['Student'])) {
            $model->attributes = $_POST['Student'];
            $canSave = true;
            $model->parent_id = User::model()->findByAttributes(array('email'=>$_POST['Student']['parent_id']))->id;
            if ($oldStatus != $model->active) {
                if ($model->active == 0) {
                    $criteria = new CDbCriteria();
                    $criteria->addColumnCondition(array('student_id' => $model->id));
                    $criteria->order = 'year desc,month desc';
                    $criteria->limit = '1';
                    $lastPayment = Payment::model()->findAll($criteria);
                    if (count($lastPayment) > 0) {
                        $lastPayment = $lastPayment[0];
                        $now = date("Y-m");
                        $lastPaymentDate = $lastPayment->year . "-" . $lastPayment->month;
                        
                        if (strcmp($now, $lastPaymentDate) <= 0) {
                            $canSave = true;
                        } else {
                            $canSave = false;
                            Yii::app()->user->setFlash('error', 'need to pay arrears first');
                        }
                    }
                    else{
                        $canSave = false;
                        Yii::app()->user->setFlash('error', 'need to pay arrears first');
                    }
                } else {
                    Payment::reactivateStudent($model->id);                    
                }
            }
            //die();
            
            if ($canSave && $model->save())
                $this->redirect(array('view', 'id' => $model->id));
            else if (!$canSave) {
                
            } else {
                var_dump($model->errors);
                die();
            }
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
        $dataProvider = new CActiveDataProvider('Student');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Student('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Student']))
            $model->attributes = $_GET['Student'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Student the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Student::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Student $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'student-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
