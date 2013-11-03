<?php

/**
 * This is the model class for table "student".
 *
 * The followings are the available columns in table 'student':
 * @property integer $id
 * @property string $student_name
 * @property integer $grade
 * @property integer $class
 * @property integer $absence_number
 * @property string $student_nick_name
 * @property integer $gender
 * @property string $date_of_birth
 * @property string $date_enter 
 */
class Student extends LoggableModel {

    var $school_id2;
    var $reg2;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Student the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    function getRegistrationId() {
        $date = explode('-', $this->date_enter);
        $ge = sprintf("%02d", $this->grade_enter);
        $sid = sprintf("%03d", $this->school_id);
        $urutan = sprintf("%06d", $this->id);
        $active = sprintf("%02d", $this->active);
        return @$date[0][2] . @$date[0][3] . $ge . $sid . $urutan . $active;
    }
    
    public function findByRegistrationId($id) {
        $year = $id[0] . $id[1];
        $classEnter = $id[2] . $id[3];
        $juku = $id[4] . $id[5] . $id[6];
        $urutan = $id[7] . $id[8] . $id[9] . $id[10] . $id[11] . $id[12];
        $criteria = new CDbCriteria();
        $searchCreiteria = array(
            'id' => $urutan,
        );
        $criteria->addColumnCondition($searchCreiteria);

        //var_dump($criteria);
        //die();
        $model = Student::model()->find($criteria);
        return $model;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'student';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('student_name, date_enter,school_id, grade, class, gender, date_of_birth, place_of_birth, students_of, birth_order', 'required'),
            array('id, grade, class,  gender,grade_enter', 'numerical', 'integerOnly' => true),
            array('student_name', 'length', 'max' => 128),
            array('student_nick_name', 'length', 'max' => 16),
            array('urutan,absence_number,active,reg2', 'safe'),
            array('home_address, emergency_adress, emergency_telephone,parent_job', 'unsafe'),
            array('emergency_telephone,income_level,birth_order', 'numerical'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, student_name, school_id, grade, class, absence_number, student_nick_name, gender, date_of_birth', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        $now = new DateTime();
        //var_dump($now);
        $year = $now->format('Y');
        $month = $now->format('m');
        return array(
            'School' => array(self::BELONGS_TO, 'School', 'school_id'),
            'Class' => array(self::BELONGS_TO, 'Classm', 'class'),
            'Payment' => array(self::HAS_MANY, 'Payment', 'student_id',
                'order' => 'year desc, month desc',),
            'lastPayment' => array(self::HAS_ONE, 'Payment', 'student_id',
                'order' => 'year desc, month desc',
                'condition' => "year = $year and month=$month",
            ),
            'Parent'=>array(self::BELONGS_TO,'User','parent_id'),
            'TestResult'=>array(self::HAS_MANY,'TestResult','student_id'),
        );
    }
    
    public function getCurrentTestResult(){
		$criteria = new CDbCriteria();
		$criteria->with = array('TestResult','Class','Class.Terms');
		$criteria->addCondition('');
	}

    public function getSex() {
        if ($this->gender == 1)
            return "Male";
        else if ($this->gender == 0)
            return "Female";
        else
            return "Futanari";
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'student_name' => 'Student Name',
            'school_id' => 'Juku',
            'parent_id' => 'Parent',
            'grade' => 'Grade',
            'grade_enter' => 'Grade Enter',
            'class' => 'Class',
            'absence_number' => 'Absence Number',
            'student_nick_name' => 'Student Nick Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'students_of' => 'Original School',
            'birth_order' => 'n-th children',
        );
    }

    public function getAge() {
        $birth = new DateTime($this->date_of_birth);
        $Now = new DateTime();
        return $birth->diff($Now, true)->format('%Y');
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        //$criteria->with = array('School');
        $criteria->with = array('Class', 'School');
        $criteria->compare('id', $this->id);
        $criteria->compare('student_name', $this->student_name, true);
        $criteria->compare('t.school_id', $this->school_id);
        $criteria->compare('t.grade', $this->grade);
        $criteria->compare('t.class', $this->class);
        $criteria->compare('absence_number', $this->absence_number);
        $criteria->compare('student_nick_name', $this->student_nick_name, true);
        $criteria->compare('gender', $this->gender);
        $criteria->compare('date_of_birth', $this->date_of_birth, true);
        //$criteria->select = array('*','Year(t.date_enter) as reg2');
        //$criteria->compare('Year(t.date_enter)', $this->reg2);
	$dp =  new CActiveDataProvider($this, array(
            'criteria' => $criteria,
	    'sort' => array(
                'class' => 'CSort',
                'attributes' => array(
                    'id',
                    'student_name',
                    'school_id' => array(
                        'asc' => '`School`.school_name',
                        'desc' => '`School`.school_name desc',
                    ),
                    'class' => array(
                        'asc' => 'Class.class',
                        'desc' => 'Class.class desc',
                    ),
                    'reg2' => array(
                        'asc' => 'Year(t.date_enter),grade_enter,t.school_id,t.id',
                        'desc' => 'Year(t.date_enter) desc, grade_enter desc,t.school_id desc,t.id desc',
                    ),
                    'grade',
                )
            )
    ));
	$dp->pagination = array('pageSize'=>$dp->totalItemCount);
        return $dp;
    }

}
