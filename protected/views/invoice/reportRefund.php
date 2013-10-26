<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$year = substr($_GET['d'], 0,4);
$month = substr($_GET['d'], 4,2);
$prevYear = $nextYear = $year;
$prevMonth = $month-1;
if($prevMonth==0){
    $prevMonth = 12;
    $prevYear -= 1;
}
if($prevMonth<10){
    $prevMonth = "0".$prevMonth;
}
$nextMonth = $month+1;
if($nextMonth ==13){
    $nextMonth = 1;
    $nextYear +=1;
}
if($nextMonth<10){
    $nextMonth = "0".$nextMonth;
}
?>
<h3>Payment for <?php echo "$year-$month"?></h3>
<?php echo CHtml::link('Previous month',array('invoice/reportRefund','d'=>"$prevYear$prevMonth"),array('class'=>'btn'))?>
<?php echo CHtml::link('Next Month',array('invoice/reportRefund','d'=>"$nextYear$nextMonth"),array('class'=>'btn'))?>
<?php echo CHtml::link("Export to CSV",array('invoice/exportRefund','d'=>"$year$month"),array('class'=>'btn'))?>
<?php
$this->renderPartial('_reportRefundTable',array('model'=>$model));