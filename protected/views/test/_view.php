<?php
/* @var $this TestController */
/* @var $data Test */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_one')); ?>:</b>
	<?php echo CHtml::encode($data->category_one); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_two')); ?>:</b>
	<?php echo CHtml::encode($data->category_two); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exercise_id')); ?>:</b>
	<?php echo CHtml::encode($data->exercise_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_of_question')); ?>:</b>
	<?php echo CHtml::encode($data->number_of_question); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_limit')); ?>:</b>
	<?php echo CHtml::encode($data->time_limit); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('time_counted')); ?>:</b>
	<?php echo CHtml::encode($data->time_counted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mistakes')); ?>:</b>
	<?php echo CHtml::encode($data->mistakes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_predicted')); ?>:</b>
	<?php echo CHtml::encode($data->time_predicted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evaluation_category')); ?>:</b>
	<?php echo CHtml::encode($data->evaluation_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school')); ?>:</b>
	<?php echo CHtml::encode($data->school); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class')); ?>:</b>
	<?php echo CHtml::encode($data->class); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('student')); ?>:</b>
	<?php echo CHtml::encode($data->student); ?>
	<br />

	*/ ?>

</div>