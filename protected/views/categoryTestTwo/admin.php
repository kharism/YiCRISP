<?php
/* @var $this CategoryTestTwoController */
/* @var $model CategoryTestTwo */

$this->breadcrumbs = array(
    'Category Test Twos' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List CategoryTestTwo', 'url' => array('index')),
    array('label' => 'Create CategoryTestTwo', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-test-two-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Category Test Twos</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'category-test-two-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'htmlOptions' => array(
        'style' => 'width:80%'
    ),
    'columns' => array(
        array(
            'name' => 'id'
            ),
        'category',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
