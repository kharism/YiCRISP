<?php
/* @var $this SchoolCategoryController */
/* @var $model SchoolCategory */

$this->breadcrumbs=array(
	'School Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SchoolCategory', 'url'=>array('index')),
	array('label'=>'Manage SchoolCategory', 'url'=>array('admin')),
);
?>

<h1>Create SchoolCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>