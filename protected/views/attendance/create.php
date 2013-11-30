<h1>Insert Attendence Data</h1>
<?php echo CHtml::form('','post',array('id'=>'attendance_create')); ?>
<div class="control-group">
    <?php
    $l = array(0 => 'school');
    $l = array_merge($l, Chtml::listData(School::model()->findAll(), 'id', 'school_name'))
?>
	<div>
		<span class="span3">School</span>
		<span class="span3">Grade</span>	
		<span class="span3">Class</span>
		<span class="span3">Date</span>
	</div>
    <?php
	    echo CHtml::dropDownList('Attendance[school_id]', '', $l, array(
		    'class'=>'span3',
        'ajax' => array(
            'type' => 'POST',
            'url' => CController::createUrl('attendance/ajaxGetClass'),
            'update' => '#Attendance_class',
        ),
    ))
    ?>

    <?php
    echo CHtml::dropDownList('Attendance[grade]', '', array(0,1,2,3,4,5,6,7,8,9), array(
	    'class'=>'span3',
     	    'ajax' => array(
            'type' => 'POST',
            'url' => CController::createUrl('attendance/ajaxGetAttendanceList'),
            'update' => '#Attendance_list',
        )
    ));
    ?>
     <?php
    echo CHtml::dropDownList('Attendance[class]', '', array(), array(
	    'class'=>'span3',
     	    'ajax' => array(
            'type' => 'POST',
            'url' => CController::createUrl('attendance/ajaxGetAttendanceList'),
            'update' => '#Attendance_list',
        ),
    ));
    ?>       <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'Attendance[date]',
            'options' => array(
		    'class'=>'span3',
     		    'changeYear' => true,
                'changeMonth' => true,
                'dateFormat' => 'yy-mm-dd',
            )
        ));
        ?>
<div class="control-group" id="Attendance_list">

</div>
<?php echo CHtml::ajaxSubmitButton('Submit', $this->createUrl('attendance/ajaxGetAttendanceList'),array(
    'complete'=>'$(".alert-success").show()',
),array('class'=>'btn'))?>
<div class="alert-success">Success insert</div>
<script>
    $(".alert-success").toggle();
</script>
<?php echo CHtml::endForm(); ?>
