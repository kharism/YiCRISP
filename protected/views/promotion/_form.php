<?php
/* @var $this PromotionController */
/* @var $model Promotion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promotion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'registration_fee'); ?>
		<?php echo CHtml::activeDropDownList($model,'registration_fee',array(1=>'Yes',0=>'No')); ?>
		<?php echo $form->error($model,'registration_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tuition_fee'); ?>
		<?php echo CHtml::activeDropDownList($model,'tuition_fee',array(1=>'Yes',0=>'No')); ?>
		<?php echo $form->error($model,'tuition_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'material_fee'); ?>
		<?php echo CHtml::activeDropDownList($model,'material_fee',array(1=>'Yes',0=>'No'));?>
		<?php echo $form->error($model,'material_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ammount'); ?>
		<?php echo $form->textField($model,'ammount'); ?>
		<?php echo $form->error($model,'ammount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'months'); ?>
		<?php echo $form->textField($model,'months'); ?>
		<?php echo $form->error($model,'months'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
