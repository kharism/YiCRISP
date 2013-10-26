<?php
/* @var $this PaymentController */
/* @var $model Payment */
/* @var $form CActiveForm */
$this->menu = array(
    array('label' => 'Report Paid', 'url' => array('report')),
    array('label' => 'Report Unpaid', 'url' => array('reportUnpaid')),
    array('label' => 'Search', 'url' => array('search')),
);
?>
<h1>Create Payment</h1>
<div class="row">
<div class="span5">
    <div class="form">
        <?php if (isset($invoice)): ?>
            <div class="alert alert-success">
                ID Invoice:<?php echo $invoice->id; ?>
            </div>
        <?php endif; ?>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'payment-formCreate-form',
            'enableAjaxValidation' => false,
        ));
        ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>
        <?php if (isset($model->success)): ?>
            <div class="alert alert-success">Success</div>
        <?php endif; ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'student_id'); ?>
            <?php echo $form->textField($model, 'student_id'); ?>
            <?php echo $form->error($model, 'student_id'); ?>


        </div>


        <div class="row">
            <?php echo $form->labelEx($model, 'year'); ?>
            <?php echo $form->textField($model, 'year'); ?>
            <?php echo $form->error($model, 'year'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'payment_method'); ?>
            <?php echo $form->dropDownList($model, 'payment_method', Payment::getPaymentMethodDropDown()); ?>
            <?php echo $form->error($model, 'payment_method'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'refferal_id'); ?>
            <?php echo $form->textField($model, 'refferal_id'); ?>
            <?php echo $form->error($model, 'refferal_id'); ?>
        </div>

        <div class="row">
            <label>Promotion Package</label>
            <?php $dd = array_merge(array(0=>'No Promotion'),CHtml::listData(Promotion::model()->findAll(),'id','name'));echo $form->dropDownList($model, 'paket',$dd); ?>
        </div>
        <div class="row" id="months">
            <?php echo $form->labelEx($model, 'month'); ?>
            <div style="-moz-column-count:3;-webkit-column-count:3;column-count:3;">
                <?php
                $year = date("Y");
                $month = date("n");
                if($month<6){
                    $range = 6-$month;
                }
                else{
                    $range = 6+12-$month;
                }
                $payMonth = array();
                for($i=1;$i<=$range;$i++){
                    $payMonth[$i]=$i;
                }
                echo $form->dropDownList($model, 'months', $payMonth);
                ?>
            </div>
            <?php echo $form->error($model, 'month'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'ammount'); ?>
            <?php echo $form->textField($model, 'ammount'); ?>
            <?php echo $form->error($model, 'ammount'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'paid'); ?>
            <?php echo $form->dropDownList($model, 'paid', array('y' => 'Yes', 'n' => 'No')); ?>
            <?php echo $form->error($model, 'paid'); ?>
        </div>


        <div class="row buttons">
            <?php echo CHtml::submitButton('Submit', array('class' => 'btn')); ?>
        </div>
        <script>
            tuituion = <?php echo Helper::getConfig('tuition');?>;
            book = <?php echo Helper::getConfig('book');?>;
            $("#Payment_paket").change(function() {
                //alert($("#Payment_paket").is(':checked'));
                if ($("#Payment_paket").is(':checked'))
                    $("#months").hide("slow");
                else
                    $("#months").show("slow");
                //$("#Payment_ammount").val($('#tuition').html()*6);
            })
            $("#Payment_months").change(function() {
                //alert((parseInt(book)+parseInt($('#tuition').html())));
                $("#Payment_ammount").val( (parseInt(book)+parseInt($('#tuition').html()))* $("#Payment_months").val());
            })
        </script>
        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div><!--span6-->
<div class="span5">
    <div class="pull-right" id="studentInfo">
    </div>
		<script>

		$("#Payment_paket").change(function(){
			if($("#Payment_paket").val()!=0)
			{
			    $("#months").toggle("slow");
			    $("#Payment_ammount").val( (parseInt(book)+parseInt($('#tuition').html()))* $("#Payment_months").val());
			}
		$("#Payment_ammount").val(promotion[$("#Payment_paket").val()]);
	});
        $('#Payment_student_id').blur(function() {
            jQuery.ajax({
		    url: '<?php echo Yii::app()->createUrl("")?>?r=student/ajaxGetStudent&id=' + $('#Payment_student_id').val() + "&payment=1",
                type: 'get',
                success: function(html) {
                    $('#studentInfo').html(html);
                    //alert($('#tuition').html());
                    tuituion = $('#tuition').html();
                    
                }
            })
        })
    </script>
</div>
</div>
