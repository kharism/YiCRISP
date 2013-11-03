<?php 
class LoggingBehaviour extends CBehavior{
	public function log(){
		$log = new Logs();
		$log->model = get_class($this->owner);
		$log->model_id = @$this->owner->id;
		$date = new DateTime;
		$log->date = $date->format(DateTime::ATOM);
		$log->value = CJSON::encode($this->owner->attributes);
		$log->modifier = Yii::app()->user->id;
		if(!$log->save()){
			var_dump($this->owner->attributes);
			var_dump($log->errors);
			die();
		}
	}
}
