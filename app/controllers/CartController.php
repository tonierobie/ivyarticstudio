<?php
  namespace App\Controllers;
  use Core\{Controller,Cookie,H, Session, Router, Mail, PesaPal};
  use App\Models\{Products,CartItems, Carts, Transactions, ProductOptionRefs};
  use App\Lib\Gateways\Gateway;

  class CartController extends Controller {

    public function indexAction() {
      $cart_id = (Cookie::exists(CART_COOKIE_NAME))? Cookie::get(CART_COOKIE_NAME): false;
      //H::dnd(qtyAvailable());
      $itemCount = 0;
      $subTotal = 0.00;
      $shippingTotal = 0.00;
      $items = Carts::findAllItemsByCartId((int)$cart_id);
      //H::dnd($items);
      foreach($items as $item){
        $itemCount += $item->qty;
        $shippingTotal += ($item->qty * $item->shipping);
        $subTotal += ($item->qty * $item->price * (SITE_CHARGES+1));
      }
      $this->view->subTotal = $subTotal;
      $this->view->shippingTotal = $shippingTotal;
      $this->view->grandTotal = $subTotal + $shippingTotal;
      $this->view->itemCount = $itemCount;
      $this->view->items = $items;
      $this->view->cartId = $cart_id;
      $this->view->render('cart/index');
    }

    public function checkoutAction($cart_id){
      $reference = null;
      $pesapal_tracking_id = null;
      $gw = Gateway::build();
      $gw->populateItems((int)$cart_id);
      $tx = new Transactions();

      if($this->request->isPost()){
        $whiteList = ['name','shipping_address1','shipping_address2','shipping_city','shipping_state','email','phone','shipping_zip'];
        $this->request->csrfCheck();
        $tx->assign($this->request->get(),$whiteList,false);
        //H::dnd($tx->assign($this->request->get(),$whiteList,false));
        $tx->validateShipping();
      }
      $this->view->formErrors = $tx->getErrorMessages();
      $this->view->tx = $tx;
      $this->view->checkout = CHECKOUT;
      $this->view->grandTotal = $gw->grandTotal;
      $this->view->items = $gw->items;
      $this->view->cartId = $cart_id;
      if(!$this->request->isPost() || !$tx->validationPassed()){
        $this->view->render('cart/shipping_address_form');
      }elseif($tx->validationPassed()){
        $trans =  Transactions::findCartID((int)$cart_id);
        if($trans){
          $trans->cart_id = $cart_id;
          $trans->name = $tx->assign($this->request->get(),$whiteList,false)->name;
          $trans->shipping_address1 = $tx->assign($this->request->get(),$whiteList,false)->shipping_address1;
          $trans->shipping_address2 = $tx->assign($this->request->get(),$whiteList,false)->shipping_address2;
          $trans->shipping_city = $tx->assign($this->request->get(),$whiteList,false)->shipping_city;
          $trans->shipping_state = $tx->assign($this->request->get(),$whiteList,false)->shipping_state;
          $trans->shipping_zip = $tx->assign($this->request->get(),$whiteList,false)->shipping_zip;
          $trans->shipping_country = $tx->assign($this->request->get(),$whiteList,false)->shipping_country;
          $trans->save();
        } else {
          $tx->cart_id = $cart_id;
          $tx->name = $tx->assign($this->request->get(),$whiteList,false)->name;
          $tx->shipping_address1 = $tx->assign($this->request->get(),$whiteList,false)->shipping_address1;
          $tx->shipping_address2 = $tx->assign($this->request->get(),$whiteList,false)->shipping_address2;
          $tx->shipping_city = $tx->assign($this->request->get(),$whiteList,false)->shipping_city;
          $tx->shipping_state = $tx->assign($this->request->get(),$whiteList,false)->shipping_state;
          $tx->shipping_zip = $tx->assign($this->request->get(),$whiteList,false)->shipping_zip;
          $tx->shipping_country = $tx->assign($this->request->get(),$whiteList,false)->shipping_country;
          $tx->save();
        }

        $this->view->render('cart/lipa');
      }

    }

    public function addToCartAction($product_id){
      if($this->request->isPost()){
        $this->request->csrfCheck();
        $cart = Carts::findCurrentCartOrCreateNew();
        //H::dnd($cart);
        $item = CartItems::addProductToCart($cart->id,(int)$product_id,(int)$this->request->get('option_id'));
        $errors = $item->getErrorMessages();
        if(empty($errors)){
          $item->qty = $item->qty + 1;
          $item->save();
        } else {
          Session::addMsg('danger',$errors['option_id']);
          Router::redirect('products/details/'.$product_id);
        }
        $this->view->render('cart/addToCart');
      }
    }

    public function changeQtyAction($direction,$item_id){
      $item = CartItems::findById((int)$item_id);
      if($direction == 'down'){
        $item->qty -= 1;
      } else {
        $item->qty += 1;
      }

      if($item->qty > 0){
        $item->save();
      }
      Session::addMsg('info',"Cart Updated");
      Router::redirect('cart');
    }

    public function removeItemAction($item_id){
      $item = CartItems::findById((int)$item_id);
      $item->delete();
      Session::addMsg('info',"Cart Updated");
      Router::redirect('cart');
    }

    public function thankYouAction($cart_id,$trackid,$paytype){
      $itemCount = 0;
      $subTotal = 0.00;
      $shippingTotal = 0.00;
      $items = Carts::findAllItemsByCartId((int)$cart_id);
      //H::dnd($items);
      foreach($items as $item){
        $itemCount += $item->qty;
        $shippingTotal += ($item->qty * $item->shipping);
        $subTotal += ($item->qty * $item->price * (SITE_CHARGES+1));
      }
      $this->view->subTotal = $subTotal;
      $this->view->shippingTotal = $shippingTotal;
      $grandTotal = $subTotal + $shippingTotal;
      $this->view->grandTotal = $grandTotal;
      $this->view->itemCount = $itemCount;
      $transaction = Transactions:: updateTransaction($cart_id,$trackid,$paytype,$total=$grandTotal);
      //H::dnd($transaction);
      $cart = carts::purchaseCart($cart_id);
      $this->view->name = $transaction->name;
      $this->view->shipping_address1 = $transaction->shipping_address1;
      $this->view->shipping_address2 = $transaction->shipping_address2;
      $this->view->email = $transaction->email;
      $this->view->phone = $transaction->phone;
      $this->view->shipping_city = $transaction->shipping_city;
      $this->view->shipping_state = $transaction->shipping_state;
      $this->view->shipping_zip = $transaction->shipping_zip;
      $this->view->shipping_country = $transaction->shipping_country;
      Mail::sendemail($transaction->email, $transaction->name, 'Your Order ' . $cart_id .' successful', 'Thank You for your order <p>Currently, your payment is Being Verified. After verification, the supplier will begin to process your order. During this time, you are unable to do any operation on your order.</p><p>Thank you</p> <p>Sincerely, IvyArtic Studio</p>', 'Thank You for your order. Currently, your payment is Being Verified. After verification, the supplier will begin to process your order. During this time, you are unable to do any operation on your order. Thank you. Sincerely, IvyArtic Studio');
      $this->view->render('cart/thankYou');
    }

    public function paymentstatusAction(){
      if(isset($_GET['pesapal_merchant_reference']))
        $pesapalMerchantReference = $_GET['pesapal_merchant_reference'];

      if(isset($_GET['pesapal_transaction_tracking_id']))
        $pesapalTrackingId = $_GET['pesapal_transaction_tracking_id'];

      if(isset($_GET['pesapal_notification_type']))
        $this->view->notification = $_GET['pesapal_notification_type'];

      $this->view->merchantRef = $pesapalMerchantReference;
      $this->view->trackinId = $pesapalTrackingId;
      //$this->view->notification = $pesapalNotification;
      $this->view->render('cart/lipastatus');
    }


  }
