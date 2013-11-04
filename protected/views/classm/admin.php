<?php
/* @var $this ClassmController */
/* @var $model Classm */

$this->breadcrumbs = array(
    'Classms' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Classm', 'url' => array('index')),
    array('label' => 'Create Classm', 'url' => array('create')),
    array('label' => 'ShowAll', 'url' => array('admin','showAll'=>'1'))
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#classm-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Classes</h1>

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
$dp =$model->search();
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'classm-grid',
    'dataProvider' => $dp,
    'filter' => $model,
    'htmlOptions' => array('style' => 'width:80%'),
    'columns' => array(
        'id',
        array(
            'value' => '$data->School->school_name',
            'header' => 'School name',
            'filter' => CHtml::dropDownList('Classm[school_id]', @$_GET['Classm']['school_id'], CHtml::listData(School::model()->findAll(), 'id', 'school_name')),
            'name'=>'school_id',
        ),
        'class',
        'range',
        array(
            'class' => 'CButtonColumn',
            'buttons'=>array(
				'print'=>array(
					'label'=>'',
					'url'=>'Yii::app()->createUrl("classm/printout", array("id"=>$data->id))',
					'options'=>array('class'=>'icon-print'),	
				),
				'logs'=>array(
					'label'=>'',
					'url'=>'Yii::app()->createUrl("log/viewLog",array("model"=>"Classm","model_id"=>$data->id))',
					'options'=>array(
						'class'=>' icon-exclamation-sign'
					),
				),
			),
			'template'=>'{view} {update} {logs} {print}'
        ),
    ),
));
?>
