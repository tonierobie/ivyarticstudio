<?php use Core\FH;
  $currency = FH::getCurrencyAndCode()['currency'];
  $currencyCode = FH::getCurrencyAndCode()['currencyCode'];
  $currencyExRate = FH::getCurrencyAndCode()['currencyExRate'];
  $amount = $this->tx->amount;
  $convertedAmount = ($amount * $currencyExRate);
?>
<h3>Purchase Summary</h3>
<?php foreach($this->items as $item):?>
  <div class="cart-preview-item">
    <div class="cart-preview-item-img"><img src="<?=PROOT . $item->url?>" alt="<?=$item->name?>" /></div>
    <div class="cart-preview-item-info">
      <p>
        <?=$item->name?>
        <?php if(!empty($item->option)):?>
          <span> (<?=$item->option?>)</span>
        <?php endif; ?>
      </p>
      <p><?= $item->qty?> @ <?=$currencyCode . number_format((($item->price)*$currencyExRate*(SITE_CHARGES+1)),2)?></p>
      <p>Shipping: <?=$currencyCode . number_format((($item->shipping)*$currencyExRate),2)?></p>
    </div>
  </div>
<?php endforeach; ?>

<div class="d-flex justify-content-between">
  <div class="font-weight-bold">Total:</div>
  <div class="font-weight-bold"><?=$currencyCode . number_format((($this->grandTotal)*$currencyExRate),2)?></div>
</div>
<div class="font-weight-bold ">
  <p>To be paid through : <?= $this->checkout?></p>

</div>
