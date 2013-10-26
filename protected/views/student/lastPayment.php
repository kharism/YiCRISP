Last Payment
<ul>
    <?php $paymentData = array_reverse($paymentData)?>
    <?php foreach($paymentData as $payment):?>
    <li><?php echo $payment->year."-".$payment->month?></li>
    <?php endforeach;?>
</ul>
<span id="tuition" style="visibility: hidden"><?php echo $tuition?></span>
<script>var promotion = <?php echo CJSON::encode($promotion);?>;</script>
