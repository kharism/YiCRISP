<?php

/**
 * This is the model class for table "test_result".
 *
 * The followings are the available columns in table 'test_result':
 * @property string $id
 * @property string $student_id
 * @property string $class_id
 * @property string $test_id
 * @property integer $answered
 * @property integer $mistake
 * @property integer $time_minute
 * @property integer $time_second
 */
class TestResult extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TestResult the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'test_result';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, class_id, test_id', 'required'),
			array('answered, mistake, time_minute, time_second', 'numerical', 'integerOnly'=>true),
			array('student_id, class_id, test_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, class_id, test_id, answered, mistake, time_minute, time_second', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'student'=>array(self::BELONGS_TO,'Student','student_id'),
            'class'=>array(self::BELONGS_TO,'Classm','class_id'),
            'test'=>array(self::BELONGS_TO,'Test','test_id'),
		);
	}
    public function getDate(){
        return $this->test->date;
    }
    public function getMark(){
        return ($this->answered-$this->mistake)*100/$this->test->number_of_question;
    }
    public function getTotalTime(){
        return 60*$this->time_minute+$this->time_second;
    }
    public function getTargetTime(){
        if(60*$this->time_minute+$this->time_second<=$this->test->time_limit)
            return "Yes";
        else
            return "No";
    }
    public function getPredictedTime(){
	    if($this->answered==0)
		return 0;    
	    else if($this->answered<$this->test->number_of_question)
        return $this->totalTime/$this->answered*$this->test->number_of_question;//'(T19+(((40-R19)*420)/R19)';
        else
            return $this->totalTime;
    }
    public function getCorrection(){
        return ($this->answered-$this->mistake)/$this->answered;
    }
    public function getCorrectAnswer(){
        return ($this->answered-$this->mistake); 
    }
    public function getPredictedMistake(){
        if($this->totalTime>0)
        return $this->mistake*$this->predictedTime/$this->totalTime;//'(T19+(((40-R19)*420)/R19)';      
        else
            return 0;
    }
    public function getCalculatedTime(){
        return ($this->predictedMistake*5)+$this->predictedTime;
    }
    public function getCalculatedMark(){
        return ($this->test->number_of_question-$this->predictedMistake)*100/$this->test->number_of_question;
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'student_id' => 'Student',
			'class_id' => 'Class',
			'test_id' => 'Test',
			'answered' => 'Answered',
			'mistake' => 'Mistake',
			'time_minute' => 'Time Minute',
			'time_second' => 'Time Second',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('class_id',$this->class_id,true);
		$criteria->compare('test_id',$this->test_id,true);
		$criteria->compare('answered',$this->answered);
		$criteria->compare('mistake',$this->mistake);
		$criteria->compare('time_minute',$this->time_minute);
		$criteria->compare('time_second',$this->time_second);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
