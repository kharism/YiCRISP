<?php
/* @var $this TestController */
/* @var $model Test */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_one'); ?>
		<?php echo $form->dropDownList($model,'category_one',CHtml::listData(CategoryTestOne::model()->findAll(), 'id', 'category')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_two'); ?>
		<?php echo $form->dropDownList($model,'category_two',CHtml::listData(CategoryTestTwo::model()->findAll(), 'id', 'category')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'model'=>$model,
            'attribute'=>'date',
            'options'=>array(
                'changeYear' => true,
                'changeMonth' => true,
                'dateFormat' => 'yy-mm-dd',
            )
         )); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'number_of_question'); ?>
		<?php echo $form->textField($model,'number_of_question'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time_limit'); ?>
		<?php echo $form->textField($model,'time_limit'); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'school'); ?>
		<?php echo $form->dropDownList($model,'school',CHtml::listData(School::model()->findAll(),'id','school_name')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'grade'); ?>
		<?php echo $form->dropDownList($model,'grade',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'student'); ?>
		<?php echo $form->textField($model,'student'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->