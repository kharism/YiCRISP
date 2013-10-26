<?php

/**
 * This is the model class for table "school".
 *
 * The followings are the available columns in table 'school':
 * @property integer $id
 * @property integer $category_school
 * @property integer $state
 * @property integer $city
 * @property integer $level_of_school
 */
class School extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return School the static model class
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
		return 'school';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('school_name, category_school, state, city, level_of_school', 'required'),
			array('id, category_school, state, city, level_of_school', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_school, state, city, level_of_school', 'safe', 'on'=>'search'),
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
            'State'=>array(self::BELONGS_TO,'State','state'),
            'City'=>array(self::BELONGS_TO,'City','city'),
            'Category'=>array(self::BELONGS_TO,'SchoolCategory','category_school'),
            'Level'=>array(self::BELONGS_TO,'SchoolLevel','level_of_school')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_school' => 'Category School',
			'state' => 'State',
			'city' => 'City',
			'level_of_school' => 'Level Of School',
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
		$criteria->compare('category_school',$this->category_school);
		$criteria->compare('state',$this->state);
		$criteria->compare('city',$this->city);
		$criteria->compare('level_of_school',$this->level_of_school);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function getAverageGrade($i){
        $test = Yii::app()->db->createCommand("select average,class,test_id from (select avg((answered-mistake)*100/number_of_question) as average, class_id,test_id from test_result join test on test_result.test_id=test.id group by class_id,test_id) t join class on t.class_id=class.id where grade=".$i." and school_id=".$this->id." order by test_id,class")->query();
        return $test->readAll();
    }
}
