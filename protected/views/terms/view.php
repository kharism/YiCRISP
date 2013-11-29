<?php
/* @var $this TermsController */
/* @var $model Terms */

$this->breadcrumbs=array(
	'Terms'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Terms', 'url'=>array('index')),
	array('label'=>'Create Terms', 'url'=>array('create')),
	array('label'=>'Update Terms', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Terms', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Terms', 'url'=>array('admin')),
);
?>

<h1>View Terms #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date_begin',
		'date_end',
	),
)); ?>
<a class="btn" href="<?php echo $this->createUrl("classm/create",array("terms"=>$model->id));?>"><i class="icon-plus"></i>Create Class</a>
<h3>Classes</h3>
<?php $schools = School::model()->findAll();?>
<?php foreach($schools as $ind=>$s):?>
	<?php if($ind%3==0):?>
		<div class="row">
	<?php endif;?>
	<div class="span4">
	<h4><?php echo $s->school_name;?></h4>
	<?php for($i=1;$i<=9;$i++):?>
		<h5>Level <?php echo $i?></h5>
		<ul>
		<?php foreach($model->getClasses($s->id) as $t):?>
			<li><a href="<?php echo $this->createUrl("levelClass/view",array("level"=>$i,"class"=>$t->id))?>">Level <?php echo $i.$t->class?> : <?php echo $t->getStudentCount($i);?> Student(s)</a></li>
		<?php endforeach;?>
		</ul>
	<?php endfor;?>
	</div>
	<?php if(($ind+1)%3==0):?>
	</div>
	<?php endif;?>
<?php endforeach;?>

