<?php
/* @var $this RefundController */
/* @var $model Refund */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'refund-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_id'); ?>
		<?php echo $form->textField($model,'payment_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'payment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ammount'); ?>
		<?php echo $form->textField($model,'ammount'); ?>
		<?php echo $form->error($model,'ammount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textArea($model,'reason',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->