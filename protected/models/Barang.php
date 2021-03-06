<?php

/**
 * This is the model class for table "barang".
 *
 * The followings are the available columns in table 'barang':
 * @property string $id
 * @property string $nama
 * @property string $id_kategori
 * @property integer $harga
 *
 * The followings are the available model relations:
 * @property Kategori $idKategori
 */
class Barang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Barang the static model class
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
		return 'barang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, id_kategori', 'required'),
			array('harga', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>32),
			array('id_kategori', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nama, id_kategori, harga', 'safe', 'on'=>'search'),
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
			'idKategori' => array(self::BELONGS_TO, 'Kategori', 'id_kategori'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama' => 'Nama',
			'id_kategori' => 'Id Kategori',
			'harga' => 'Harga',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('id_kategori',$this->id_kategori,true);
		$criteria->compare('harga',$this->harga);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
