<?php
class LoggableModel extends CActiveRecord{
	public function __construct($scenario="insert"){
		parent::__construct($scenario);
		$this->attachBehavior("log",new LoggingBehaviour());
	}
	protected function afterSave(){
		parent::afterSave();
		$this->log();
	}
	public static function model($class = __CLASS__){return parent::model($class);}
}
