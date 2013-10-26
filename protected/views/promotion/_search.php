<?php
/* @var $this PromotionController */
/* @var $model Promotion */
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
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'registration_fee'); ?>
		<?php echo $form->textField($model,'registration_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tuition_fee'); ?>
		<?php echo $form->textField($model,'tuition_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'material_fee'); ?>
		<?php echo $form->textField($model,'material_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ammount'); ?>
		<?php echo $form->textField($model,'ammount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'months'); ?>
		<?php echo $form->textField($model,'months'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->