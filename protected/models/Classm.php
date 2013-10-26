<?php

/**
 * This is the model class for table "class".
 *
 * The followings are the available columns in table 'class':
 * @property integer $id
 * @property integer $class
 */
class Classm extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Classm the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'class';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('class, school_id', 'required'),
            array('terms_id, schedule, max_capacity', 'safe'),
            array('max_capacity', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, class, grade', 'safe', 'on' => 'search'),
        );
    }
    public function getActiveClass($schoolId){
        $criteria = new CDbCriteria();
	$criteria->addColumnCondition(array('school_id'=> $schoolId));
	$criteria->with = array(
            'Terms' => array(
		    'condition' => 'date_begin <now() and date_end>now()'
            )
        );
 	return Classm::model()->findAll($criteria);
    }
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'School' => array(self::BELONGS_TO, 'School', 'school_id'),
            'Terms' => array(self::BELONGS_TO, 'Terms', 'terms_id'),
	    'Capacity'=>array(self::STAT,'Student','class'),
	    'Students'=>array(self::HAS_MANY,'Student','class'),
        );
    }
    public function getRange(){
        if($this->terms_id>0)
        return $this->Terms->getRange();
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'class' => 'Class',
            'school_id' => 'School',
            'grade' => 'Grade',
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
        $criteria->with = array('School','Terms');
        $criteria->compare('id', $this->id);
        $criteria->compare('school_id', $this->school_id);
        $criteria->compare('class', $this->class);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'attributes'=>array(
                    'id',
                    'school_id'=>array(
                        'asc'=>'School.school_name',
                        'desc'=>'School.school_name desc'
                    ),
                    'class',
                    'range'=>array(
                        'asc'=>'Terms.date_begin, Terms.date_end',
                        'desc'=>'Terms.date_begin desc, Terms.date_end desc',
                    )
                )
            )
        ));
    }

    /**
     *
     * @return type array('average','id') 
     */
    public function getAverageClass() {
        $data = Yii::app()->db->createCommand("select avg((answered-mistake)*100/number_of_question) as average,test.id as id from test_result right join test on test.id = test_id where class_id=$this->id group by test_id")->query();
        return $data->readAll();
    }

}
