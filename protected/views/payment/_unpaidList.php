<?php
/*@var $data Student*/
?>

<h5><?php echo $data->student_name?></h5>
Last Payment
<?php echo @$data->lastPayment->year."-".@$data->lastPayment->month;?>
<hr/>