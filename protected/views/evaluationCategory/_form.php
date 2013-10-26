<?php
/* @var $this EvaluationCategoryController */
/* @var $model EvaluationCategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'evaluation-category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'evaluation'); ?>
		<?php echo $form->textField($model,'evaluation',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'evaluation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mistakes'); ?>
		<?php echo $form->textField($model,'mistakes'); ?>
		<?php echo $form->error($model,'mistakes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->