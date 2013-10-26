<?php
/* @var $this RefundController */
/* @var $model Refund */
/* @var $form CActiveForm */
?>
<div class="row">
    <div class="span5">
        <div class="form">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'refund-form',
                'enableAjaxValidation' => false,
            ));
            ?>
            <?php if (Yii::app()->user->hasFlash('Error')): ?>
                <div class="alert alert-error">
                    <?php echo Yii::app()->user->getFlash('Error'); ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::app()->user->hasFlash('Success')): ?>
                <div class="alert alert-success">
                    <?php echo Yii::app()->user->getFlash('Success'); ?>
                </div>
            <?php endif; ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <label>Student ID</label>
                <?php echo CHtml::textField('student_id', @$_POST['student_id'], array('id' => 'Payment_student_id')); ?>


            </div>
            <div class="row">
                <label>Date Start</label>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    //'model' => $model,
                    //'attribute' => 'date[start]',
                    'name'=>'Date[start]',
                    'options' => array(
                        'changeYear' => true,
                        'changeMonth' => true,
                        'dateFormat' => 'yy-mm-dd',
                    )
                ));
                ?>
            </div>


            <!--div class="row">
                <label>Start Year</label>
                <?php echo CHtml::textField('Date[startYear]', @$_POST['Date']['startYear']) ?>
                <label>Start month</label>
                <?php
                echo CHtml::dropDownList('Date[startMonth]', @$_POST['Date']['startMonth'], array(
                    1 => 'Jan',
                    2 => 'Feb',
                    3 => 'Mar',
                    4 => 'Apr',
                    5 => 'May',
                    6 => 'Jun',
                    7 => 'Jul',
                    8 => 'Aug',
                    9 => 'Sep',
                    10 => 'Okt',
                    11 => 'Nov',
                    12 => 'Dec',
                        ), array(
                    'placeholder' => 'start month'
                ))
                ?>
            </div-->
            <div class="row">
                <label>End Year</label>
                <?php echo CHtml::textField('Date[endYear]', @$_POST['Date']['endYear']) ?>
                <label>End month</label>
                <?php
                echo CHtml::dropDownList('Date[endMonth]', @$_POST['Date']['endMonth'], array(
                    1 => 'Jan',
                    2 => 'Feb',
                    3 => 'Mar',
                    4 => 'Apr',
                    5 => 'May',
                    6 => 'Jun',
                    7 => 'Jul',
                    8 => 'Aug',
                    9 => 'Sep',
                    10 => 'Okt',
                    11 => 'Nov',
                    12 => 'Dec',
                        ), array(
                    'placeholder' => 'end month'
                ))
                ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'reason'); ?>
                <?php echo $form->textArea($model, 'reason', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, 'reason'); ?>
            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>
    <div class="span5">
        <div class="pull-right" id="studentInfo">
        </div>
        <script>
            $('#Payment_student_id').blur(function() {
                jQuery.ajax({
                    url: '<?php echo Yii::app()->createUrl("")?>?r=student/ajaxGetStudent&id=' + $('#Payment_student_id').val() + "&payment=1",
                    type: 'get',
                    success: function(html) {
                        $('#studentInfo').html(html);
                    }
                })
            })
        </script>
    </div>
</div>
