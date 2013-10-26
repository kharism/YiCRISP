<?php
/* @var $this TermsController */
/* @var $model Terms */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'terms-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_begin'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		//'name' => 'Terms[date_begin]',
		'model'=> $model,'attribute'=>'date_begin',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;'
            ),
            'value'=>@$_POST['Terms']['date_begin'],
        ));
        ;
        ?>
        <?php echo $form->error($model, 'date_begin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_end'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model'=> $model,'attribute'=>'date_end',// additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;'
            ),
        ));
        ;
        ?>
        <?php echo $form->error($model, 'date_end'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
