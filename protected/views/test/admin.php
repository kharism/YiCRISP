<?php
/* @var $this TestController */
/* @var $model Test */

$this->breadcrumbs=array(
	'Tests'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Test', 'url'=>array('index')),
	array('label'=>'Create Test', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#test-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tests</h1>

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
	'id'=>'test-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'htmlOptions'=>array(
        'style'=>'width:80%'
    ),
	'columns'=>array(
		'id',
		array(
                    'value'=>'$data->CategoryOne->category',
                    'name'=>'_cat1',
                    'header'=>'Test Category'
                ),
		'date',
		array(
                    'value'=>'$data->School->school_name',
                    'name'=>'_school',
                ),
		'grade',
		'number_of_question',
		'time_limit',
		/*'time_counted',
		'mistakes',
		'time_predicted',
		'evaluation_category',
		'student',
		*/
		array(
			'class'=>'CButtonColumn',
			'template' => '{view} {update} {logs}',
			'buttons'=>array(
				'logs'=>array(
					'label'=>'',
					'url'=>'Yii::app()->createUrl("log/viewLog",array("model"=>"Test","model_id"=>$data->id))',
					'options'=>array(
						'class'=>' icon-exclamation-sign'
					),
				),
            ),
		),
	),
)); ?>
