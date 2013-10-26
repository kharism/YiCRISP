<?php
/* @var $this PromotionController */
/* @var $data Promotion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('registration_fee')); ?>:</b>
	<?php echo CHtml::encode($data->registration_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tuition_fee')); ?>:</b>
	<?php echo CHtml::encode($data->tuition_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('material_fee')); ?>:</b>
	<?php echo CHtml::encode($data->material_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ammount')); ?>:</b>
	<?php echo CHtml::encode($data->ammount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('months')); ?>:</b>
	<?php echo CHtml::encode($data->months); ?>
	<br />


</div>