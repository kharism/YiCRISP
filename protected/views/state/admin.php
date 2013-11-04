<?php
/* @var $this StateController */
/* @var $model State */

$this->breadcrumbs=array(
	'States'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List State', 'url'=>array('index')),
	array('label'=>'Create State', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#state-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage States</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'state-grid',
	'dataProvider'=>$model->search(),
    'htmlOptions'=>array('style'=>'width:60%'),
	//'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array('width'=>'5')
        ),
		array(
            'name'=>'state_name',
            'htmlOptions'=>array('width'=>'40')
        ),
		array(
			'class'=>'CButtonColumn',
            'htmlOptions'=>array('width'=>'40'),
            'template' => '{view} {update} {logs}',
			'buttons'=>array(
				'logs'=>array(
					'label'=>'',
					'url'=>'Yii::app()->createUrl("log/viewLog",array("model"=>"State","model_id"=>$data->id))',
					'options'=>array(
						'class'=>' icon-exclamation-sign'
					),
				),
            ),
		),
	),
)); ?>
