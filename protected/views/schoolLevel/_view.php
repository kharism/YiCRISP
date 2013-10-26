<?php
/* @var $this SchoolLevelController */
/* @var $data SchoolLevel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_level')); ?>:</b>
	<?php echo CHtml::encode($data->school_level); ?>
	<br />


</div>