<?php
/* @var $this RefundController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Refunds',
);

$this->menu=array(
	array('label'=>'Create Refund', 'url'=>array('create')),
	array('label'=>'Manage Refund', 'url'=>array('admin')),
);
?>

<h1>Refunds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
