<?php
/* @var $this SchoolCategoryController */
/* @var $data SchoolCategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_of_school')); ?>:</b>
	<?php echo CHtml::encode($data->category_of_school); ?>
	<br />


</div>