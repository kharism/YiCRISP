<?php

class InvoiceController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    // Uncomment the following methods and override them if needed

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
                'actions' => array('index', 'view', 'search','reportIncome','export','reportRefund','exportRefund'),
                'roles' => array('admin', 'accounting'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    

    public function actionSearch() {
        $invoice = new Invoice;
        $payment = array();
        if (isset($_POST['Invoice'])) {
            if (!isset($_POST['Invoice']['id'])) {
                $invoice->attributes = $_POST['Invoice'];
                $temp = Invoice::model()->findByAttributes(array(
                    'payment_method' => $_POST['Invoice']['payment_method'],
                    'refferal_id' => $_POST['Invoice']['refferal_id'],
                    
                ));
                if ($temp != null)
                    $invoice = $temp;
                $temp2 = Payment::model()->findAllByAttributes(array('refferal_id'=>$_POST['Invoice']['refferal_id']));
                if($temp2 != null){
                    $payment = $temp2;
                }
            }
            else {
                $model = Invoice::model()->findByPk($_POST['Invoice']['id']);
                $model->income_date = $_POST['Invoice']['income_date'];
                if(!$model->save()){
                    var_dump($model->errors);
                    die();
                }
                $invoice = $model;
            }
            //var_dump($invoice);
        }
        $this->render('searchInvoice', array('model' => $invoice,'payment'=>$payment));
    }
    public function actionReportIncome(){
        $year = substr($_GET['d'], 0, 4);
        $month = substr($_GET['d'], 4, 2);
        $criteria = new CDbCriteria();
        $time = "$year-$month%";
        $criteria->params = array(':time'=>$time);
        $criteria->addCondition('date like :time');
        $invoices = Invoice::model()->findAll($criteria);
        $this->render('reporting',array('model'=>$invoices));
    }
    
    public function actionReportRefund(){
        $year = substr($_GET['d'], 0, 4);
        $month = substr($_GET['d'], 4, 2);
        $criteria = new CDbCriteria();
        $time = "$year-$month%";
        $criteria->params = array(':time'=>$time);
        $criteria->addCondition('date like :time');
        $invoices = RefundInvoice::model()->findAll($criteria);
        $this->render('reportRefund',array('model'=>$invoices));
    }
    public function actionExportRefund(){
        $year = substr($_GET['d'], 0, 4);
        $month = substr($_GET['d'], 4, 2);
        $criteria = new CDbCriteria();
        $time = "$year-$month%";
        $criteria->params = array(':time'=>$time);
        $criteria->addCondition('date like :time');
        $invoices = RefundInvoice::model()->findAll($criteria);
        header('Content-type: text/csv');
        header('Content-disposition: attachment;filename=export.csv');
        echo "id;name;student id;ammount;date\n";
        $total = 0;
        foreach($invoices as $i){
            echo $i->id.";".$i->student->student_name.';'.$i->student->registrationId.';'.$i->ammount.';'.$i->date."\n";
            $total+=$i->ammount;
            
        }
        echo ";;;".$total.";";
    }
    public function actionExport(){
        $year = substr($_GET['d'], 0, 4);
	$month = substr($_GET['d'], 4, 2);
	//var_dump($_GET);die();
        $criteria = new CDbCriteria();
        $time = "$year-$month%";
        $total = 0;
        $criteria->params = array(':time'=>$time);
        $criteria->addCondition('date like :time');
        $invoices = Invoice::model()->findAll($criteria);
	//var_dump($_GET);die();
	header('Content-type: text/csv');
        header('Content-disposition: attachment;filename=export.csv');
	echo "Id;Payment Method;Refferal Id;Student Name;Grade Received;Student ID;Ammount;Date\n";
	//var_dump($_GET);die();
        foreach($invoices as $i){
            echo $i->id.';'.$i->payment_name->name.';'.$i->refferal_id.';'.$i->student->student_name.';'.$i->grade_received.';'.$i->student->registrationId.';'.$i->ammount.';'.$i->date."\n";
            $total +=$i->ammount;
	}
//var_dump($_GET);die();
        echo " ; ; ; ; ; ;$total; ";
    }
}
