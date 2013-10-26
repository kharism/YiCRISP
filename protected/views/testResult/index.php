<?php echo CHtml::beginForm(array('testresult/index'), 'POST', array('id' => 'spreadsheet-form')) ?>
Test Date:<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'date',
    'id'=>'date',
    // additional javascript options for the date picker plugin
    'options' => array(
        'showAnim' => 'fold',
        'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions' => array(
        'style' => 'height:20px;',
    ),
));?>
Test Id:<?php
$listData = array('-1' => 'Select Test');
$p = CHtml::listData(Test::model()->findAll(), 'id', 'id');

echo CHtml::dropDownList('test_id', -1, array(), array(
    'ajax' => array(
        'type' => 'POST',
        'url' => CController::createUrl('testResult/ajaxgetclasschooser'),
        'update' => '#spreadsheed-class',
        'data' => 'js:jQuery(this).serialize()',
        'beforeSend' => "js:function(jxhr,settings){
            $('#spreadsheed-class').html('" . CHtml::image('images/ajax-loader.gif') . "');
            }",
    )
))
?>
<div id="spreadsheed-class">

</div>
<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        Submiting
    </div>
    <div class="modal-body">
        <div id="progres-bar" class="progress progress-striped active">
            <div class="bar" style="width: 40%;"></div>
        </div>
        <div id="ppp" style="visibility: hidden">
            Success
        </div>
    </div>
</div>
<?php echo CHtml::ajaxSubmitButton('Submit', CController::createUrl('testResult/getClassResult'), array('type' => 'POST', 'beforeSubmit' => 'js:$("#myModal").modal()', 'success' => 'js:function(data){successSubmit();}'), array('class' => 'btn btn-primary')); ?>
<script>
    $('#date').change(function(){
        jQuery.ajax({
            'type':'GET',
            'url':'<?php echo Yii::app()->createAbsoluteUrl('');?>?r=testResult/ajaxGetTestByDate',
            'data':$('#date').serialize(),
            'success':function(data){
                $('#test_id').html(data);
            }
        });
    })
    function successSubmit() {
        $("#ppp").css('visibility', 'visible');
        $("#progres-bar").css('visibility', 'hidden');
    }
</script>
<?php echo CHtml::endForm(); ?>