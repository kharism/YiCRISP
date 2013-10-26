<?php
/* @var $this SchoolCategoryController */
/* @var $model SchoolCategory */

$this->breadcrumbs=array(
	'School Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SchoolCategory', 'url'=>array('index')),
	array('label'=>'Create SchoolCategory', 'url'=>array('create')),
	array('label'=>'View SchoolCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SchoolCategory', 'url'=>array('admin')),
);
?>

<h1>Update SchoolCategory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>