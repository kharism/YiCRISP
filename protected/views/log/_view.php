<?php
/* @var $this StudentController */
/* @var $data Student */
?>

<div class="view">

	<?php echo $data->date?> by 
	<?php echo $data->User->username;?>
	<br />
	<ul>
	<?php 
	$stat = CJSON::decode($data->value);
	foreach($stat as $key=>$val):?>
	 <li>
		 <?php echo $key.":".$val;?>
	 </li>
	<?php
	endforeach;
	?>
	</ul>
</div>
