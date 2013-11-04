<h1>ChaangeLog for <?php echo $_GET['model']?> <?php echo $_GET['model_id']?></h1>

<?php 
$dataProvider = new CArrayDataProvider($logs);
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
