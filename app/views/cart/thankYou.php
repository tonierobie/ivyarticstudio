<?php use Core\FH;
$amount = ceil(($this->grandTotal*KENYA_SHILLING_EXCHANGE_RATE));
?>
<?php $this->setSiteTitle('Thank You!');?>

<?php $this->start('body')?>
<div class="row">
  <div class="col-md-8 offset-md-2 text-center">
    <h2 class="text-info">Thank You!</h2>
    <p>Your purchase of <?='KSH ' . number_format($amount,2)?> was successful.</p>
    <p>Your purchase will be shipped to the following address.</p>
    <p> <?=$this->name?> <br/>
        <?=$this->shipping_address1?> <br/>
        <?=$this->shipping_address2?> <br/>
        <?=$this->email?> <br/>
        <?=$this->phone?> <br/>
        <?=$this->shipping_city?> <br/>
        <?=$this->shipping_state?> <br/>
        <?=$this->shipping_zip?> <br/>
        <?=$this->shipping_country?> <br/>
    </p>
    <a href="<?=PROOT?>" class="btn btn-lg btn-primary">Continue</a>
  </div>
</div>
<?php $this->end()?>
