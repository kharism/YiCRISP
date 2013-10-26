<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $father_name 
 * @property string $mother_name
 */
class User extends CActiveRecord {

    private $groupsInts;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public static function getAllParent(){
        $criteria = new CDbCriteria();
        $criteria->with = array('groups'=>array(
            'condition'=>'name="parent"',
        ));
        return User::model()->findAll($criteria);
    }
    public function getGroupsInt(){
        $a = array();
        foreach($this->groups as $group){
            $a[$group->id] = $group->name;
        }
        return $a;
    }
    public function getGroupsString(){
        $a = "";
        foreach($this->groups as $group){
            $a .= $group->name.",";
        }
        return $a;
    }
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }
    
    

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, email', 'required','on'=>'insert'),
            array('username, password, email', 'length', 'max' => 128),
            array('email','unique','attributeName'=>'email'),
            array('father_name, mother_name, address, father_phone, mother_phone, father_job, mother_job','safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, email, role, groupsInt', 'safe', 'on' => 'search'),
        );
    }

    /**
     * 
     */
    

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'groups' => array(self::MANY_MANY, 'Group', 'users_groups(user_id,group_id)'),
            'children' =>array(self::HAS_MANY,'Student','parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Mobile Phone Number',
            
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

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}