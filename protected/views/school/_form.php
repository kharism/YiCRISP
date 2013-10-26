<?php
/* @var $this SchoolController */
/* @var $model School */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'school-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'school_name'); ?>
		<?php echo $form->textField($model,'school_name'); ?>
		<?php echo $form->error($model,'school_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_school'); ?>
		<?php echo $form->dropDownList($model,'category_school',CHtml::listData(SchoolCategory::model()->findAll(),'id','category_of_school'));?>
		<?php echo $form->error($model,'category_school'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->dropDownList($model,'state',CHtml::listData(State::model()->findAll(),'id','state_name'),array(
            'ajax'=>array(
                'url'=>CController::createUrl('city/ajaxGetAllCity'),
                'type'=>'POST',
                'update'=>'#School_city'
            ),
        ));?>
        <?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->dropDownList($model,'city',CHtml::listData(City::model()->findAll(),'id','city_name')); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'level_of_school'); ?>
		<?php echo $form->dropDownList($model,'level_of_school',CHtml::listData(SchoolLevel::model()->findAll(),'id','school_level')); ?>
		<?php echo $form->error($model,'level_of_school'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->