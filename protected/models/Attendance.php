<?php

/**
 * This is the model class for table "attendance".
 *
 * The followings are the available columns in table 'attendance':
 * @property string $id
 * @property string $date
 * @property string $class
 * @property integer $student_id
 * @property string $teacher_id
 * @property integer $attend
 */
class Attendance extends LoggableModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Attendance the static model class
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
		return 'attendance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, class, student_id, teacher_id, attend', 'required'),
			array('student_id, attend', 'numerical', 'integerOnly'=>true),
			array('class, teacher_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, class, student_id, teacher_id, attend', 'safe', 'on'=>'search'),
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
                    'Teacher'=>array(self::BELONGS_TO,'User','teacher_id'),
                    'Class'=>array(self::BELONGS_TO,'Classm','class'),
                    'Student'=>array(self::BELONGS_TO,'Student','student_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date' => 'Date',
			'class' => 'Class',
			'student_id' => 'Student',
			'teacher_id' => 'Teacher',
			'attend' => 'Attend',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('class',$this->class,true);
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('teacher_id',$this->teacher_id,true);
		$criteria->compare('attend',$this->attend);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
