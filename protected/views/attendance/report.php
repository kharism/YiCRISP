<?php
/* @var $model Attendance */
?>
<h1>View Attendence Report</h1>
<?php
echo CHtml::form('', 'POST', array('class' => 'form'));
?>
    <?php
    $l = array(0 => 'school');
    $l = array_merge($l, Chtml::listData(School::model()->findAll(), 'id', 'school_name'))
    ?>
    <?php
    echo CHtml::dropDownList('Attendance[school_id]',@$_POST['Attendance']['school_id'], $l, array(
        'ajax' => array(
            'type' => 'POST',
            'url' => CController::createUrl('attendance/ajaxGetClass'),
            'update' => '#Filter_class',
        ),
    ))
    ?>
 
<?php 
    $t = array();
	if(isset($_POST['Attendance']['school_id']))$t=CHtml::listData(Classm::model()->findAllByAttributes(array('school_id'=> $_POST['Attendance']['school_id'])),'id','class'); 
	echo CHtml::dropDownList('Filter[class]', (isset($_POST['Attendance']['school_id'])?$_POST['Filter']['class']:''),$t);
    ?>
    <?php echo CHtml::dropDownList('Filter[grade]', isset($_POST['Attendance']['school_id'])?$_POST['Filter']['grade']:'', array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6)); ?>
<div class="control-group">
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    'name' => 'Filter[start_date]',
	    'value'=>@$_POST['Filter']['start_date'],
        // additional javascript options for the date picker plugin
        'options' => array(
            'showAnim' => 'fold',
            'dateFormat' => 'yy-mm-dd',
        ),
        'htmlOptions' => array(
            'style' => 'height:20px;',
            'placeholder'=>'Start Date',
        ),
    ));
    ?>
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    'name' => 'Filter[end_date]',
	    'value'=>@$_POST['Filter']['end_date'],
        // additional javascript options for the date picker plugin
        'options' => array(
            'showAnim' => 'fold',
            'dateFormat' => 'yy-mm-dd',
        ),
        'htmlOptions' => array(
            'style' => 'height:20px;',
            'placeholder'=>'End Date',
        ),
    ));
    ?>
</div>
<?php echo CHtml::submitButton('Submit')?>
<?php echo CHtml::endForm(); ?>
<div class="row">
<span class="span3">&nbsp;</span>
<?php if(is_array($model)):
    //echo var_dump($model);
    $keys = array_keys($model);
    if(count($keys)>0):
    foreach($model[$keys[0]] as $tanggal=>$kehadiran):?>
<span class="span3"><?php echo $tanggal;?></span>
<?php        
    endforeach;?></div><?php
    foreach($model as $id=>$attendance):
?>
<div class="row">
    <span class="span3"><?php echo Student::model()->findByPk($id)->student_name;?></span>
    <?php foreach($attendance as $y):?>
    <span class="span3"><a href="<?php echo Yii::app()->createUrl("log/viewLog",array("model"=>"Attendance","model_id"=>$y->id))?>"><?php echo $y->attend;?></a></span>
    <?php endforeach;?>
</div>    
<?php 
    endforeach;
    else:?>
<div class="alert alert-error">No Data</div>
    <?php
    endif;
    endif;
?>
