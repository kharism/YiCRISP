<?php

/**
 * This is the model class for table "promotion".
 *
 * The followings are the available columns in table 'promotion':
 * @property integer $id
 * @property string $name
 * @property integer $registration_fee
 * @property integer $tuition_fee
 * @property integer $material_fee
 * @property integer $ammount
 * @property integer $months
 */
class Promotion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Promotion the static model class
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
		return 'promotion';
	}
	public function getPrice($studentID){
		if($this->ammount!=0)
			return $this->ammount;
		else{
			$t = 0;
			if($this->registration_fee==1)
				$t+=Helper::getConfig('registration');
			$y=0;
			if($this->material_fee==1)
				$y+=Helper::getConfig('book');
			if($this->tuition_fee==1){
				$student = Student::model()->findByPk($studentID);
				$monthly = Helper::getConfig('tuition'.$student->grade);
				$y=($y+$monthly)*$this->months;
				$t+=$y;
				//var_dump($t);die();
			}
			return $t;
		}
	}
	public function getPriceGrade($grade){
		if($this->ammount!=0)
			return $this->ammount;
		else{
			$t = 0;
			if($this->registration_fee==1)
				$t+=Helper::getConfig('registration');
			if($this->material_fee==1)
				$t+=Helper::getConfig('book');
			if($this->tuition_fee==1){
				$monthly = Helper::getConfig('tuition'.$grade);
				$t+=$this->months*$monthly;
				//var_dump($t);die();
			}
			return $t;
		}
	}
	public function pricePerMonth($studentId){
		return $this->getPrice($studentId)/$this->months;
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, registration_fee, tuition_fee, material_fee, ammount, months', 'required'),
			array('registration_fee, tuition_fee, material_fee, ammount, months', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, registration_fee, tuition_fee, material_fee, ammount, months', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'registration_fee' => 'Registration Fee',
			'tuition_fee' => 'Tuition Fee',
			'material_fee' => 'Material Fee',
			'ammount' => 'Ammount',
			'months' => 'Months',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('registration_fee',$this->registration_fee);
		$criteria->compare('tuition_fee',$this->tuition_fee);
		$criteria->compare('material_fee',$this->material_fee);
		$criteria->compare('ammount',$this->ammount);
		$criteria->compare('months',$this->months);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
