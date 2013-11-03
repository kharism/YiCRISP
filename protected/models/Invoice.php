<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property string $id
 * @property string $student_id
 * @property string $receiver_id
 * @property integer $ammount
 * @property integer $date
 */
class Invoice extends LoggableModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
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
		return 'invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, receiver_id, ammount, payment_method', 'required'),
			array('ammount', 'numerical', 'integerOnly'=>true),
			array('student_id, receiver_id', 'length', 'max'=>20),
                        array('date','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, receiver_id, ammount, date', 'safe', 'on'=>'search'),
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
                    'payment_name'=>array(self::BELONGS_TO,'PaymentMethod','payment_method'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'student_id' => 'Student',
			'receiver_id' => 'Receiver',
			'ammount' => 'Ammount',
			'date' => 'Date',
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
		$criteria->compare('receiver_id',$this->receiver_id,true);
		$criteria->compare('ammount',$this->ammount);
		$criteria->compare('date',$this->date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
