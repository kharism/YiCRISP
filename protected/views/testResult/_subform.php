<?php
/* @var $this StudentController */

?>
Class Id:<?php
$listData = array('-1' => 'Select Class');
foreach($class as $key=>$val){
    $listData[$key]=$val;
}
//$listData = array_merge($listData, $class);
echo CHtml::dropDownList('class_id', '', $listData, array(
    'ajax' => array(
        'type' => 'POST',
        'url' => CController::createUrl('testResult/ajaxgetclassspreadsheet'),
        'update' => '#spreadsheed',
        'data' => 'js:jQuery(this).serialize()',
    )
))
?>
<div id="spreadsheed">

</div>
<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function($) {
        jQuery('body').on('change','#class_id',function(){jQuery.ajax({
                'type':'POST',
                'beforeSend':function(jxhr,settings){
                    jQuery("#spreadsheed").html('<?php echo CHtml::image('images/ajax-loader.gif');?>');
                },
                'url':'<?php echo Yii::app()->createAbsoluteUrl('');?>?r=testResult/ajaxgetclassspreadsheet',
                'data':$("#spreadsheet-form").serialize(),
                'cache':false,
                'success':function(html){
                    jQuery("#spreadsheed").html(html)}
            });return false;});
    });
    /*]]>*/
</script>
