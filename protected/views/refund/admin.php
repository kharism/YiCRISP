<?php
/* @var $this RefundController */
/* @var $model Refund */

$this->breadcrumbs = array(
    'Refunds' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Refund', 'url' => array('index')),
    array('label' => 'Create Refund', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#refund-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php if (Yii::app()->user->hasFlash('Error')): ?>
    <div class="alert alert-error">
        <?php echo Yii::app()->user->getFlash('Error'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('Success')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('Success'); ?>
    </div>
<?php endif; ?>
<h1>Manage Refunds</h1>

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
    'id' => 'refund-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'payment_id',
        'ammount',
        'reason',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
