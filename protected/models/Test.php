<?php

/**
 * This is the model class for table "test".
 *
 * The followings are the available columns in table 'test':
 * @property integer $id
 * @property integer $category_one
 * @property integer $category_two
 * @property string $date
 * @property integer $exercise_id
 * @property integer $number_of_question
 * @property string $time_limit
 * @property string $time_counted
 * @property integer $mistakes
 * @property string $time_predicted
 * @property integer $evaluation_category
 * @property integer $school
 * @property integer $class
 * @property integer $student
 */
class Test extends CActiveRecord {

    var $_school;
    var $_cat1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Test the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'test';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_one, date,  number_of_question, time_limit, school, grade', 'required'),
            array('category_one,school, grade, student', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, category_one, date, exercise_id, number_of_question, time_limit, time_counted, mistakes, time_predicted, evaluation_category, school, class, student,_cat1,_school', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'CategoryOne' => array(self::BELONGS_TO, 'CategoryTestOne', 'category_one'),
            'CategoryTwo' => array(self::BELONGS_TO, 'CategoryTestTwo', 'category_two'),
            'School' => array(self::BELONGS_TO, 'School', 'school'),
            'Result' => array(self::HAS_MANY, 'TestResult', 'test_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'category_one' => 'Category One',
            'category_two' => 'Category Two',
            'date' => 'Date',
            'exercise_id' => 'Exercise',
            'number_of_question' => 'Number Of Question',
            'time_limit' => 'Time Limit',
            'time_counted' => 'Time Counted',
            'mistakes' => 'Mistakes',
            'time_predicted' => 'Time Predicted',
            'evaluation_category' => 'Evaluation Category',
            'school' => 'School',
            'class' => 'Class',
            'student' => 'Student',
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
        $criteria->with = array('School', 'CategoryOne');
        if (isset($this->id))
            $criteria->compare('id', $this->id);
        if (isset($this->category_one))
            $criteria->compare('category_one', $this->category_one, True);
        if (isset($this->category_two))
            $criteria->compare('category_two', $this->category_two, True);
        if (isset($this->date))
            $criteria->compare('date', $this->date, true);
        if (isset($this->exercise_id))
            $criteria->compare('exercise_id', $this->exercise_id);
        if (isset($this->number_of_question))
            $criteria->compare('number_of_question', $this->number_of_question);
        if (isset($this->time_limit))
            $criteria->compare('time_limit', $this->time_limit, true);
        if (isset($this->time_counted))
            $criteria->compare('time_counted', $this->time_counted, true);
        if (isset($this->school))
            $criteria->compare('school', $this->school);
        if (isset($this->grade))
            $criteria->compare('grade', $this->grade);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'id',
                    'date',
                    '_cat1' => array(
                        'asc' => 'CategoryOne.category',
                        'desc' => 'CategoryOne.category desc',
                    ),
                    '_school' => array(
                        'asc' => 'School.school_name',
                        'desc' => 'School.school_name desc',
                    ),
                    'grade',
                    'number_of_question',
                    'time_limit',
                )
            )
        ));
    }

    public function getAverage() {
        $test = Yii::app()->db->createCommand("select avg((answered-mistake)*100/number_of_question) as average, class_id from test_result join test on test_result.test_id=test.id where test_id=" . $this->id . " group by class_id")->query();
        return $test->readAll();
    }

}