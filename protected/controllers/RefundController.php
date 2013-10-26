<?php

class RefundController extends Controller {

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
                'actions' => array('index', 'view', 'update', 'create', 'delete', 'admin'),
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
        $model = new Refund;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Refund'])) {
            $model->attributes = $_POST['Refund'];
            
            $date = $_POST['Date'];
            if($date['endMonth']<10){
                $date['endMonth']='0'.$date['endMonth'];
            }
            
            $gg = CDateTimeParser::parse($date['start'], 'yyyy-mm-dd');
            
            $date['startMonth'] = date("m",$gg);
            $date['startYear'] = intval(date("Y",$gg));
            $g0 = CDateTimeParser::parse($date['startYear'].'-'.$date['startMonth'].'-01', 'yyyy-mm-dd');
            $date['weekStart'] = intval(date("W",$gg));
            $date['firstWeek'] = date("W",  $g0);
            //var_dump(date_diff($gg, $g0));
            
            
            
            
            $student = Student::model()->findByRegistrationId($_POST['student_id']);
            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('student_id' => $student->id));
            $sql = 'concat(year,"-",month)>:start and concat(year,"-",month)<=:end';
            $criteria->params[':start'] = $date['startYear'] . '-' . $date['startMonth'];
            $criteria->params[':end'] = $date['endYear'] . '-' . $date['endMonth'];
            $criteria->addCondition($sql);
            $payments = Payment::model()->findAll($criteria);
            $total = 0;
            if ($date['startYear'] < date('Y') || ($date['startYear'] == date('Y') && $date['startMonth'] < date('n'))) {
                $model->addError('reason', 'Year Start Invalid');
            }
            //var_dump($payments);die();
            if (!$model->hasErrors()) {
                foreach ($payments as $i=>$payment) {
                    $refund = new Refund;
                    $refund->payment_id = $payment->id;
                    if($i==0){
                        $refund->ammount = ($payment->ammount-Helper::getConfig('book'))*($date['weekStart']-$date['firstWeek'])/4;
                    }else
                    $refund->ammount = $payment->ammount-Helper::getConfig('book');
                    $total+=$refund->ammount;
                    $refund->reason = $model->reason;
                    if ($refund->save()) {
                        $payment->refund_id = $refund->id;
                        $payment->save();
                    } else {
                        var_dump($refund->errors);
                        die();
                    }
                }
                $invoice = new RefundInvoice;
                $invoice->ammount = $total;
                $invoice->student_id = $student->id;
                if (!$invoice->save()) {
                    var_dump($invoice->errors);
                    die();
                }
                Yii::app()->user->setFlash('Success','Success Refund');
                $this->redirect(array('admin'));
            }
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

        if (isset($_POST['Refund'])) {
            $model->attributes = $_POST['Refund'];
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
        $dataProvider = new CActiveDataProvider('Refund');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Refund('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Refund']))
            $model->attributes = $_GET['Refund'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Refund the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Refund::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Refund $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'refund-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
