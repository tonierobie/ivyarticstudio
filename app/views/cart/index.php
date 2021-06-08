
<?php use Core\{FH,H};
use App\Models\{Products, ProductOptionRefs};
?>
<?php $this->setSiteTitle("Shopping Cart"); ?>
<?php $this->start('head') ?>
  <script type="text/javascript" src="<?=PROOT?>js/jQuery-3.3.1.min.js"></script>
<?php $this->end() ?>
<?php $this->start('body')?>
<?php
  $currency = FH::getCurrencyAndCode()['currency'];
  $currencyCode = FH::getCurrencyAndCode()['currencyCode'];
  $currencyExRate = FH::getCurrencyAndCode()['currencyExRate']

  //H::dnd($this->items);
?>
<h2>Shopping Cart (<?=$this->itemCount?> item<?=($this->itemCount == 1)?"" : "s"?>)</h2>
<hr />
<div class="row">
  <?php if(sizeof($this->items) == 0): ?>
    <div class="col col-md-8 offset-md-2 text-center">
      <h3>Your shopping cart is empty!</h3>
      <a href="<?=PROOT?>" class="btn btn-lg btn-info">Continue Shopping</a>
    </div>
<?php else: ?>
  <div class="col col-md-8">
    <?php foreach($this->items as $item):
      $available = 0;
      $model = (!empty($item->option_id))? ProductOptionRefs::findByProductId($item->product_id,$item->option_id) : Products::findById($item->product_id);
      if($model){
        $available = $model->inventory;
      }
       //H::dnd($available);
       //H::dnd($item->qtyAvailable());
      $shipping = ($item->shipping == 0)? "Free Shipping" : "Shipping:". $currencyCode . number_format(($item->shipping*$currencyExRate),2);
      ?>
      <div class="shopping-cart-item">
        <div class="shopping-cart-item-img">
          <img src="<?=PROOT. $item->url?>" alt="<?=$item->name?>">
        </div>
        <div class="shopping-cart-item-name">
          <a href="<?=PROOT?>products/details/<?=$item->product_id?>" title="<?=$item->name?>">
            <?=$item->name?>
            <?php if(!empty($item->option)):?>
            <span> (<?=$item->option?>)</span>
            <?php endif;?>
          </a>
          <p>by <?=$item->brand?></p>
        </div>

        <div class="shopping-cart-item-qty">
          <label>Qty</label>
          <?php if($item->qty > 1): ?>
            <a href="<?=PROOT?>cart/changeQty/down/<?=$item->id?>"><i class="fas fa-chevron-down"></i></a>
          <?php endif;?>
          <input class="form-control form-control-sm" readonly value="<?=$item->qty?>"/>
          <?php
            //if($item->qty < $item->qtyAvailable()):
            if($item->qty < $available):
          ?>
            <a href="<?=PROOT?>cart/changeQty/up/<?=$item->id?>"><i class="fas fa-chevron-up"></i></a>
          <?php endif;?>
        </div>

        <div class="shopping-cart-item-price">
          <div><?=$currencyCode . number_format(($item->price*$currencyExRate*(SITE_CHARGES+1)),2)?></div>
          <div class="shipping"><?=$shipping?></div>
          <div class="remove-item" onclick="confirmRemoveItem('<?=PROOT?>cart/removeItem/<?=$item->id?>')">
            <i class="fas fa-trash-alt"></i> Remove
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>

  <aside class="col col-md-4 ">
    <div class="shopping-cart-summary">
      <div class="cart-line-item">
        <div>Item<?=($this->itemCount == 1)?"" : "s"?> (<?=$this->itemCount?>)</div>
        <div><?=$currencyCode . number_format((($this->subTotal)*$currencyExRate),2)?></div>
      </div>
      <div class="cart-line-item">
        <div>Shipping</div>
        <div><?=$currencyCode . number_format((($this->shippingTotal)*$currencyExRate),2)?></div>
      </div>
      <hr />
      <div class="cart-line-item grand-total">
        <div>Total:</div>
        <div><?=$currencyCode . number_format((($this->grandTotal)*$currencyExRate),2)?></div>
      </div>
      <form class="" action="<?=PROOT?>cart/checkout/<?=$this->cartId?>" method="post">
        <p class="lead text-muted">Please choose your preferred method of payment.</p>
          <div class="text-center">
            <label class="radio-inline">
              <input type="radio" name="radiogroup" id="radiogroup1" class="radiogroup" value="Proceed With Checkout" data-url="<?=PROOT?>cart/checkout/<?=$this->cartId?>" checked />
              Mpesa, Airtel, Mastercard & Visa
            </label>
          </div>
          <!--
          <div class="text-center">
            <label class="radio-inline">
              <input type="radio" name="radiogroup" id="radiogroup2" class="radiogroup" value="Proceed With Checkout" data-url="<?=PROOT?>cart/checkout/<?=$this->cartId?>/mobile" /> MPESA
            </label>
          </div>
        -->
            <a id="url" href="<?=PROOT?>cart/checkout/<?=$this->cartId?>" class="btn btn-lg btn-primary btn-block">Proceed With Checkout</a>
      </form>
    </div>
  </aside>
<?php endif; ?>
</div>

<script type="text/javascript">
const a = document.getElementById("url");
const inputs = document.querySelectorAll('.radiogroup');

// A simple function to handle the click event for each input.
const clickHandler = i => {
a.href = i.getAttribute("data-url");
a.textContent = i.getAttribute("value");
};

// Possibly even less code again.
inputs.forEach(i => i.onclick = () => clickHandler(i));
</script>

<script>
  function confirmRemoveItem(href){
    if(confirm("Are you sure?")){
      window.location.href = href;
    }
    return false;
  }
</script>
<?php $this->end()?>
