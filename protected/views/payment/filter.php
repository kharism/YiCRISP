<?php
/* @var $this PaymentController */
/* @var $model Payment */
$this->menu = array(
    array('label' => 'Report Paid', 'url' => array('report')),
    array('label' => 'Report Unpaid', 'url' => array('reportUnpaid')),
    array('label' => 'Search', 'url' => array('search')),
);
echo CHtml::form('', 'post', array('class' => 'form form-horizontal'));
?>
<script type="text/javascript">
$(function() {
    $('.date-picker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'mm yy',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });
});
</script>
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>
<div class="control-group">
    <label class="control-label">Grade</label>
    <div class="controls">
        <?php
        echo CHtml::dropDownList('Filter[grade]', @$_POST['Filter']['grade'], array(
            -1 => 'all',
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
                )
        )
        ?>
    </div>
</div>
<div class="control-group">
    <label class="control-label">Start</label>
    <div class="controls">
		<input name="Filter[startDate]" id="startDate" class="date-picker" />
    </div>
</div>
<div class="control-group">
    <label class="control-label">End</label>
    <div class="controls">
        <input name="Filter[endDate]" id="startDate" class="date-picker" />
    </div>
</div>
<div class="control-group">
    <label class="control-label">Student Id</label>
    <div class="controls">
<?php echo CHtml::textField('Filter[student_id]', '') ?>
    </div>    
</div>
<?php echo CHtml::submitButton('Search', array('class' => 'btn')) ?>
<?php echo Chtml::endForm(); ?>
<?php if (is_array($model)): ?>
    <?php
    $time = array();
    $table = array();
    foreach ($model as $payment) {
        $timeTemp = $payment->year . '-' . $payment->month;
        if (!in_array($timeTemp, $time)) {
            array_push($time, $timeTemp);
        }
        $j = $payment->student;
        if($payment->refund_id==0){
            $table[$j->id][$timeTemp] = "#00ff00";            
        }            
        else
        {
            $table[$j->id][$timeTemp] = "#00ffff";
        }
    }
    sort($time);
    //var_dump($table);
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Students name</th>
                <?php foreach ($time as $t): ?>
                    <th><?php echo $t; ?></th>
    <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($table as $student => $payment): ?>
                <tr>
                    <td <?php if(Student::model()->findByPk($student)->active==0):?>style="background-color: #ffff00"<?php endif;?>>
                    <?php echo Student::model()->findByPk($student)->student_name; ?>
                    </td>
                    <?php foreach ($time as $t): ?>
            <?php if (array_key_exists($t, $payment)): ?>
                            <td style="background-color: <?php echo "$payment[$t]"?>">

                            </td>                            
            <?php else: ?>
                            <?php if(Student::model()->findByPk($student)->active==1):?>
                            <td style="background-color: #ff0000">

                            </td>
                            <?php else:?>
                            <td style="background-color: #ffff00">

                            </td>
                            <?php endif;?>
                        <?php endif; ?>
                <?php endforeach; ?>
                </tr>
    <?php endforeach; ?>
        </tbody>
    </table>    
<?php endif; ?>
