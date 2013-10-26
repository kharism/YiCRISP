<?php

/**
 * This is the model class for table "payment".
 *
 * The followings are the available columns in table 'payment':
 * @property string $id
 * @property string $student_id
 * @property integer $year
 * @property integer $month
 * @property integer $ammount
 * @property integer $paid
 * @property string $payment_date
 * @property integer $paket 
 */
class Payment extends CActiveRecord {

    var $months;
    var $paket;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Payment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'payment';
    }

    public static function getPaymentMethodDropDown() {
        return CHtml::listData(PaymentMethod::model()->findAll(), 'id', 'name');
    }
    public static function reactivateStudent($studentId) {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('student_id' => $studentId));
        $criteria->order = 'year desc,month desc';
        $criteria->limit = '1';
        $lastPayment = Payment::model()->findAll($criteria);
        $lastPayment = $lastPayment[0];
        $now = new DateTime();
        $lastPaymentDate = new DateTime($lastPayment->year.'-'.$lastPayment->month.'-01');
        $diff = $now->diff($lastPaymentDate);
        $resolve = $diff->m;
        $standardAttr = array(
            'ammount'=>0,
            'payment_method'=>0,
            'student_id'=>$studentId,
        );
        for($i=1;$i<$resolve;$i++){
            $pay = new Payment;
            $pay->attributes = $standardAttr;
            $pay->month = $lastPayment->month+$i;
            $pay->payment_date = date("Y-m-d");
            $yearAdd = 0;
            if($pay->month>12){
                $yearAdd = ceil($pay->month/12);
                $pay->month = ($pay->month%12)+1;
            }
            if($pay->month<10){
                $pay->month = "0".$pay->month;
            }
            $pay->year = $lastPayment->year+$yearAdd;
            if(!$pay->save()){
                var_dump($pay->errors);die();
            }
        }
    }

    public function applyPayment() {
        $student = Student::model()->findByPk($this->student_id);
        if ($this->paket != 0) {
		$promotion = Promotion::model()->findByPk($this->paket);
		$criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('student_id' => $this->student_id));
            $criteria->order = 'year desc,month desc';
            $criteria->limit = '1';
            $lastPayment = Payment::model()->findAll($criteria);
            //array_reverse($lastPayment);
            $MonthStart = 0;
            if (count($lastPayment) == 0) {
                $student = Student::model()->findByPk($this->student_id);
                $date = explode('-', $student->date_enter);
                //var_dump($student->date_enter);
                $MonthStart = $date[1];
                $this->year = $date[0];
            } else {
                $MonthStart = ($lastPayment[0]->month) + 1;
            }
	    for($i=0;$i<$promotion->months;$i++){
	   	$pay = new Payment;
                $pay->attributes = $this->attributes;
                unset($pay->months);
                $pay->month = $MonthStart + $i;
                if ($pay->month > 12) {
                    $pay->year = $this->year + 1;
                }
                if ($pay->month > 12) {
                    $pay->month = $pay->month - 12;
                }
                if ($pay->month < 10) {
                    $pay->month = "0" . $pay->month;
                }
                $date = new DateTime();
                $pay->payment_date = $date->format('Y-m-d');
                $pay->paid = 1;
                $pay->ammount = $promotion->pricePerMonth($this->student_id);
                $pay->refferal_id = $_POST['Payment']['refferal_id'];
                //var_dump($pay->attributes);
                if ($pay->save()) {
                    
                } else {
                    var_dump($pay->errors);
                    die();
                }
	    }
	} else {
            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('student_id' => $this->student_id));
            $criteria->order = 'year desc,month desc';
            $criteria->limit = '1';
            $lastPayment = Payment::model()->findAll($criteria);
            //array_reverse($lastPayment);
            $MonthStart = 0;
            if (count($lastPayment) == 0) {
                $student = Student::model()->findByPk($this->student_id);
                $date = explode('-', $student->date_enter);
                //var_dump($student->date_enter);
                $MonthStart = $date[1];
                $this->year = $date[0];
            } else {
                $MonthStart = ($lastPayment[0]->month) + 1;
            }
            for ($i = 0; $i < $this->months; $i++) {
                $pay = new Payment;
                $pay->attributes = $this->attributes;
                unset($pay->months);
                $pay->month = $MonthStart + $i;
                if ($pay->month > 12) {
                    $pay->year = $this->year + 1;
                }
                if ($pay->month > 12) {
                    $pay->month = $pay->month - 12;
                }
                if ($pay->month < 10) {
                    $pay->month = "0" . $pay->month;
                }
                $date = new DateTime();
                $pay->payment_date = $date->format('Y-m-d');
                $pay->paid = 1;
                $pay->ammount = Helper::getConfig('tuition') + Helper::getConfig('book');
                $pay->refferal_id = $_POST['Payment']['refferal_id'];
                //var_dump($pay->attributes);
                if ($pay->save()) {
                    
                } else {
                    var_dump($pay->errors);
                    die();
                }
            }
        }
        //die();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('student_id, year, month, ammount, payment_date', 'required'),
            array('year, ammount, paid', 'numerical', 'integerOnly' => true),
            array('student_id', 'length', 'max' => 20),
            array('payment_date', 'length', 'max' => 32),
            array('paket,months,payment_method, month', 'safe'),
            array('income_date,refferal_id', 'unsafe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, student_id, year, month, ammount, paid, payment_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'student' => array(self::BELONGS_TO, 'Student', 'student_id'),
            'refund'=>array(self::HAS_ONE,'Refund','payment_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'student_id' => 'Student',
            'year' => 'Year',
            'month' => 'Month',
            'months' => 'berapa bulan?',
            'ammount' => 'Ammount',
            'paid' => 'Paid',
            'payment_date' => 'Payment Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('student_id', $this->student_id, true);
        $criteria->compare('year', $this->year);
        $criteria->compare('month', $this->month);
        $criteria->compare('ammount', $this->ammount);
        $criteria->compare('paid', $this->paid);
        $criteria->compare('payment_date', $this->payment_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
