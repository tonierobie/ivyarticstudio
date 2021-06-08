<?php
  namespace App\Lib\Gateways;
  use App\Lib\Gateways\{StripeGateway};

  class Gateway {
    public static function build(){
      // if($GATEWAY == 'mpesa'){
      //     return new MpesaGateway();
      // } else if($GATEWAY == 'braintree') {
      //     return new BraintreeGateway();
      // } else {
      //     return new StripeGateway();
      // }

      return new PesapalGateway();
  }
}
