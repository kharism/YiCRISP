<ul>
    <?php foreach($paymentData as $payment):?>
    <li><?php echo $payment->year."-".$payment->month?></li>
    <?php endforeach;?>
</ul>
