<?php
/* @var $this ClassmController */
/* @var $model Classm */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'classm-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'class'); ?>
        <?php echo $form->textField($model, 'class'); ?>
        <?php echo $form->error($model, 'class'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'school_id'); ?>
        <?php echo $form->dropDownList($model, 'school_id', CHtml::listData(School::model()->findAll(), 'id', 'school_name')); ?>
        <?php echo $form->error($model, 'school_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'grade'); ?>
        <?php echo $form->dropDownList($model, 'grade', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7')); ?>
        <?php echo $form->error($model, 'grade'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'terms_id'); ?>
        <?php echo $form->dropDownList($model, 'terms_id', CHtml::listData(Terms::model()->findAll(), 'id', 'range')); ?>
        <?php echo $form->error($model, 'grade'); ?>
    </div>    

    <div class="row">
        <?php echo $form->labelEx($model, 'schedule'); ?>
        <?php echo $form->textArea($model, 'schedule'); ?>
        <?php echo $form->error($model, 'schedule'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'max_capacity'); ?>
        <?php echo $form->textField($model, 'max_capacity'); ?>
        <?php echo $form->error($model, 'max_capacity'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->