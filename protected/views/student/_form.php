<?php
/* @var $this StudentController */
/* @var $model Student */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'student-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php foreach ($model->errors as $key => $value): ?>
        <div class="alert alert-error">
            <p><?php echo $value ?></p>
        </div>
    <?php endforeach; ?>
    <?php if (Yii::app()->user->hasFlash('error')): ?>
        <div class="alert alert-error">
            <p><?php echo Yii::app()->user->getFlash('error') ?></p>
        </div>
    <?php endif; ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'student_name'); ?>
        <?php echo $form->textField($model, 'student_name', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'student_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'gender'); ?>
        <?php echo $form->dropdownList($model, 'gender', array(1 => 'Male', 0 => 'Female')); ?>
        <?php echo $form->error($model, 'gender'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'place_of_birth'); ?>
        <?php echo $form->textField($model, 'place_of_birth', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'place_of_birth'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_of_birth'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'date_of_birth',
            'options' => array(
                'changeYear' => true,
                'changeMonth' => true,
                'dateFormat' => 'yy-mm-dd',
            )
        ));
        ?>
        <?php echo $form->error($model, 'date_of_birth'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'school_id'); ?>
        <?php
        $datalist = array('-1' => 'Select School');
        $datalist = array_merge($datalist, CHtml::listData(School::model()->findAll(), 'id', 'school_name'))
        ?>
        <?php
        echo $form->dropDownList($model, 'school_id', $datalist, array(
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('classm/AjaxGetAllClass'),
                'update' => '#Student_class'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'school_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'emergency_telephone'); ?>
        <?php echo $form->textField($model, 'emergency_telephone', array('size' => 16, 'maxlength' => 16)); ?>
        <?php echo $form->error($model, 'emergency_telephone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'birth_order'); ?>
        <?php echo $form->textField($model, 'birth_order', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'birth_order'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'active'); ?>
        <?php echo $form->dropDownList($model, 'active', array(0 => 'Inactive', 1 => 'Active')); ?>
        <?php echo $form->error($model, 'active'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'students_of'); ?>
        <?php echo $form->textField($model, 'students_of', array('size' => 60, 'maxlength' => 60)); ?>
        <?php echo $form->error($model, 'students_of'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'home_address'); ?>
        <?php echo $form->textField($model, 'home_address', array('size' => 60, 'maxlength' => 60)); ?>
        <?php echo $form->error($model, 'home_address'); ?>
    </div>
    <?php
    $availableClass = array();
    if (!$model->isNewRecord) {
        $availableClass = CHtml::listData(Classm::model()->findAllByAttributes(array('school_id' => $model->school_id)), 'id', 'class');
    }
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'class'); ?>
        <?php echo $form->dropDownList($model, 'class', $availableClass); ?>
        <?php echo $form->error($model, 'class'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'grade'); ?>
        <?php echo $form->dropDownList($model, 'grade', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9')); ?>
        <?php echo $form->error($model, 'grade'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'parent_id'); ?>
        <?php
        $parentData = array(0 => 'new Parent');
        //$parentData = array_merge($parentData, CHtml::listData(User::model()->findAll(), 'id', 'email'));
        foreach (CHtml::listData(User::model()->findAll(), 'id', 'email') as $key => $i) {
            $parentData[$key] = $i;
        }
        //echo $form->dropDownList($model, 'parent_id', $parentData);
        ?>
        <?php
        $this->widget('ext.combobox.EJuiComboBox', array(
            'model' => $model,
            'attribute' => 'parent_id',
            'data' => $parentData,
        ));
        ?>
        <?php echo $form->error($model, 'parent_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'absence_number'); ?>
        <?php echo $form->textField($model, 'absence_number'); ?>
        <?php echo $form->error($model, 'absence_number'); ?>
    </div>



    <div class="row">
        <?php echo $form->labelEx($model, 'emergency_adress'); ?>
        <?php echo $form->textField($model, 'emergency_adress', array('size' => 60, 'maxlength' => 60)); ?>
        <?php echo $form->error($model, 'emergency_adress'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->