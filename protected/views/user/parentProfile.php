<h2>Update User Data</h2>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$form = $this->beginWidget('CActiveForm',array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
        'htmlOptions'=>array(
            'class'=>'form form-horizontal',
        ),
    ));
?>
<?php if(Yii::app()->user->hasFlash('success')):?>
<div class="alert alert-success">
    <?php echo Yii::app()->user->getFlash('success');?>
</div>
<?php endif;?>
<div class="control-group">
    <label class="control-label">Password</label>
    <div class="controls">
        <?php echo $form->passwordField($model,'password');?>
    </div>    
</div>
<div class="control-group">
    <label class="control-label">Father Name</label>
    <div class="controls">
        <?php echo $form->textField($model,'father_name');?>
    </div>    
</div>
<div class="control-group">
    <label class="control-label">Mother Name</label>
    <div class="controls">
        <?php echo $form->textField($model,'mother_name');?>
    </div>    
</div>

<div class="control-group">
    <label class="control-label">Father Phone</label>
    <div class="controls">
        <?php echo $form->textField($model,'father_phone');?>
    </div>    
</div>

<div class="control-group">
    <label class="control-label">Mother Phone</label>
    <div class="controls">
        <?php echo $form->textField($model,'mother_phone');?>
    </div>    
</div>

<div class="control-group">
    <div class="controls">
        <?php echo Chtml::submitButton('Submit');?>
    </div>
</div>
<?php $this->endWidget();?>