<?php

/**
 * This is the model class for table "refund".
 *
 * The followings are the available columns in table 'refund':
 * @property string $id
 * @property string $payment_id
 * @property integer $ammount
 * @property string $reason
 */
class Refund extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Refund the static model class
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
		return 'refund';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_id, ammount, reason', 'required','on'=>'create'),
			array('ammount', 'numerical', 'integerOnly'=>true),
			array('payment_id', 'length', 'max'=>20),
                        array('reason','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, payment_id, ammount, reason', 'safe', 'on'=>'search'),
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
                    'payment'=>array(self::BELONGS_TO,'Payment','payment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'payment_id' => 'Payment',
			'ammount' => 'Ammount',
			'reason' => 'Reason',
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
		$criteria->compare('payment_id',$this->payment_id,true);
		$criteria->compare('ammount',$this->ammount);
		$criteria->compare('reason',$this->reason,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}