<?php
/* @var $this TestController */
/* @var $model Test */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'test-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_one'); ?>
		<?php echo $form->dropDownList($model,'category_one',CHtml::listData(CategoryTestOne::model()->findAll(),'id', 'category')); ?>
		<?php echo $form->error($model,'category_one'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'model'=>$model,
            'attribute'=>'date',
            'options'=>array(
                'changeYear' => true,
                'changeMonth' => true,
                'dateFormat' => 'yy-mm-dd',
            )
         )); ?><?php echo $form->error($model,'date'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'number_of_question'); ?>
		<?php echo $form->textField($model,'number_of_question'); ?>
		<?php echo $form->error($model,'number_of_question'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_limit'); ?>
		<?php echo $form->textField($model,'time_limit'); ?>
		<?php echo $form->error($model,'time_limit'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'school'); ?>
		<?php echo $form->dropDownList($model,'school',CHtml::listData(School::model()->findAll(),'id','school_name')); ?>
		<?php echo $form->error($model,'school'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grade'); ?>
		<?php echo $form->dropDownList($model,'grade',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6')); ?>
		<?php echo $form->error($model,'grade'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->