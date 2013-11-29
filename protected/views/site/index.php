<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>
pick a menu from top bar
</p>
<?php if(Yii::app()->user->admin)$this->renderPartial("adminMenu");?>

