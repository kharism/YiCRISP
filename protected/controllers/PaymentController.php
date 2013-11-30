<?php

class PaymentController extends Controller {

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        $this->menu = array(
            array('label' => 'Report Paid', 'url' => array('report')),
            array('label' => 'Add Payment', 'url' => array('admin2')),
            //array('label' => 'Report Unpaid', 'url' => array('reportUnpaid')),
            
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function filters() {
        // return the filter configuration for this controller, e.g.:
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'update', 'create', 'delete', 'admin2', 'report', 'reportUnpaid'),
                'roles' => array('admin', 'office1'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionReport() {
        $this->breadcrumbs = array(
            'Payment'=>array('payment/index'),
            'Report Payment'
        );
        $model = new Payment;
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        if (isset($_POST['Filter'])) {
            $filter = $_POST['Filter'];
            $yy = explode(" ",$filter['startDate']);
            $filter['yearStart'] = $yy[1];
            $filter['monthStart'] = $yy[0];
            $yy = explode(" ",$filter['endDate']);
            $filter['yearEnd'] = $yy[1];
            $filter['monthEnd'] = $yy[0];
            $criteria = new CDbCriteria();
            $criteria->order = "year desc, month desc";
            $criteria->addColumnCondition(array('refund_id'=>0));
            /* if($filter['status']==0){
              $criteria->addColumnCondition(array('paid'=>'0'));
              } */
            if ($filter['student_id'] != '') {
                $student = Student::model()->findByRegistrationId($filter['student_id']);
                $criteria->addColumnCondition(array('student_id' => $student->id));
            }
            if ($filter['grade'] != -1) {
                $criteria->with = array(
                    'student' => array(
                        'condition' => 'grade = ' . $filter['grade'],
                    )
                );
                //var_dump($criteria);die();
            }
            if($filter['startDate']!=''){
                $criteria->addCondition("concat(year,'-',month)>='".$filter['yearStart']."-".$filter['monthStart']."'");
                
            }
            if($filter['yearEnd']!=''){
                if($filter['monthEnd']=='')
                    $filter['monthEnd']=12;
                if($filter['monthEnd']<10)
                    $filter['monthEnd']='0'.$filter['monthEnd'];
                $criteria->addCondition("concat(year,'-',month)<='".$filter['yearEnd']."-".$filter['monthEnd']."'");
                
            }
            $model = Payment::model()->findAll($criteria);
        } else {
            
        }
        $this->render('filter', array(
            'model' => $model,
        ));
    }
    public function actionReportUnpaid() {
        $now = new DateTime();
        //var_dump($now);
        $year = $now->format('Y');
        $month = $now->format('m');
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'lastPayment' => array(
                'condition' => '',
            ),
        );
        $criteria->select = "id";
        $model = Student::model()->findAll($criteria);
        //var_dump($model);
        $paying = array();
        foreach ($model as $p) {
            array_push($paying, $p->id);
        }
        $criteria2 = new CDbCriteria();
        $criteria2->addNotInCondition('id', $paying);
        $unpaid = Student::model()->findAll($criteria2);
        $dataProvider = new CArrayDataProvider($unpaid);
        $this->render('unpaidList', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin2() {
        $this->breadcrumbs = array(
            'Payment'=>array('payment/index'),
            'Create'
        );
        $model = new Payment;
        $invoice = null;
        $model->ammount = Config::model()->findByAttributes(array('name' => 'tuition'))->value;
        $model->ammount += Config::model()->findByAttributes(array('name' => 'book'))->value;
        $model->year = date("Y");
        if (isset($_POST['Payment'])) {
            //var_dump($_POST['Payment']);
            //die();
            $model->attributes = $_POST['Payment'];
            $student = Student::model()->findByRegistrationId($model->student_id);
            $model->student_id = $student->id;
            //$model->save();
            $invoice = new Invoice();
            $invoice->ammount = $_POST['Payment']['ammount'];
            $invoice->receiver_id = Yii::app()->user->id;
	    $invoice->student_id = $model->student_id;
	    $invoice->grade_received = $student->grade;
            $invoice->payment_method = $_POST['Payment']['payment_method'];
            $invoice->refferal_id = $_POST['Payment']['refferal_id'];
            $invoice->save();
            $model->applyPayment();
            
            //var_dump($_POST['Payment']);
            //$model->success = true;
        }
        $this->render('formCreate', array(
            'model' => $model,
            'invoice' => $invoice,
        ));
    }

    // Uncomment the following methods and override them if needed
    /*


      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
