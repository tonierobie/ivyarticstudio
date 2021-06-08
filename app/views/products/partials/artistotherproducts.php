<?php use Core\FH;
  $currency = FH::getCurrencyAndCode()['currency'];
  $currencyCode = FH::getCurrencyAndCode()['currencyCode'];
  $currencyExRate = FH::getCurrencyAndCode()['currencyExRate'];
 ?>
<div class="row justify-content-md-center">
  <div class="col-md-auto">
    <h3 class="text-center">Others by the Artist</h3>
    <main class="products-wrapper">
        <?php foreach($this->artistProducts as $artistProduct):
          $shipping = ($artistProduct->shipping == '0.00')? 'Free Shipping!' : ('Shipping: ' . $currencyCode . ' ' . number_format(($artistProduct->shipping*$currencyExRate),2));
          $list = ($artistProduct->list != '0.00')? ($currencyCode . number_format(($artistProduct->list*$currencyExRate),2)) : '';
         ?>
          <div class="card">
              <img src="<?= PROOT .$artistProduct->url?>" class="card-img-top" alt="<?=$artistProduct->name?>">
            <div class="card-body">
              <h5 class="card-title"><a href="<?=PROOT?>products/details/<?=$artistProduct->id?>"><?=$artistProduct->name?></a></h5>
              <p class="card-text"><?=$currencyCode . number_format(($artistProduct->price*$currencyExRate),2)?> <span class="list-price"><?=$list?></span></p>
              <p class="card-text"><?= $shipping?></p>
              <a href="<?=PROOT?>products/details/<?=$artistProduct->id?>" class="btn btn-primary">See Details</a>
            </div>
          </div>
        <?php endforeach; ?>
      </main>
  </div>
</div>
