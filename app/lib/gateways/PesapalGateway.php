<?php
  namespace App\Lib\Gateways;
  use App\Lib\Gateways\{AbstractGateway};
  use App\Models\{Transactions,Carts};
  use Core\{H};

  class PesapalGateway extends AbstractGateway{

    public static $gateway = 'pesapal';

    public function getView(){
      return 'card_forms/pesapal';
    }

    public function processForm($post){
      $ch = $this->charge($post);
      $getform = $this->processpesapaliframe($cardid,$ch);
      H::dnd($getform);
    }

    public function charge($data){
      $names = $data['name'];
      $namearry = explode(" ", $names);
      $namelen = sizeof($namearry);
      if($namelen > 2 ) {
        $lastname = $namearry[1] . ' ' . $namearry[2];
      } elseif ($namelen == 2) {
        $lastname = $namearry[1];
      } else {
        $lastname = '';
      }
      $result = [
        'amount' => $this->grandTotal,
        'desc' => 'Ivy Studio Payment',
        'type' => 'MERCHANT',
        'reference' => $this->cart_id,
        'first_name' => $namearry[0],
        'last_name' => $lastname,
        'email' => $data['email'],
        'phonenumber' => $data['phone']
      ];
      return $result;
    }

    public function handleChargeResp($ch){
      $this->chargeSuccess = $ch->outcome->network_status == 'approved_by_network';
      $this->msgToUser = $ch->outcome->seller_message;
    }

    protected function parseShippingAddress($post){
      return [
        'line1' => $post['shipping_address1'],
        'line2' => $post['shipping_address2'],
        'city' => $post['shipping_city'],
        'state' => $post['shipping_state'],
        'postal_code' => $post['shipping_zip']
      ];
    }

    public function createTransaction($ch){
      $tx = new Transactions();
      $tx->cart_id = $this->cart_id;
      $tx->gateway = static::$gateway;
      $tx->type = $ch->payment_method_details->type;
      $tx->amount = $this->grandTotal;
      $tx->success = ($this->chargeSuccess)? 1 : 0;
      $tx->charge_id = $ch->id;
      $tx->reason = $ch->outcome->reason;
      $tx->card_brand = $ch->payment_method_details->card->brand;
      $tx->last4 = $ch->payment_method_details->card->last4;
      $tx->name = $ch->shipping->name;
      $tx->shipping_address1 = $ch->shipping->address->line1;
      $tx->shipping_address2 = $ch->shipping->address->line2;
      $tx->email = $ch->shipping->address->line2;
      $tx->phone = $ch->shipping->address->line2;
      $tx->shipping_city = $ch->shipping->address->city;
      $tx->shipping_state = $ch->shipping->address->state;
      $tx->shipping_zip = $ch->shipping->address->postal_code;
      $tx->shipping_country = $ch->shipping->address->country;
      $tx->save();
      return $tx;
    }

    public function getToken(){
      return $token = $params = NULL;
    }

    protected function processpesapaliframe($cardid,$ch){
      include_once('OAuth.php');
      $amount = $ch['amount'];
      $desc = $ch['desc'];
      $type = $ch['type'];
      $first_name = $ch['first_name'];
      $last_name = $ch['last_name'];
      $email = $ch['email'];
      $phonenumber = $ch['phonenumber'];
      $street1 = $ch['shipping_address1'];

      $callback_url = 'https://www.ivyarticstudio.com/checkout/'; //redirect url, the page that will handle the response from pesapal.
$post_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><PesapalDirectOrderInfo xmlns:xsi=\"http://www.w3.org/2001/XMLSchemainstance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" Amount=\"".$amount."\" Description=\"".$desc."\" Type=\"".$type."\" Reference=\"".$cardid."\" FirstName=\"".$first_name."\" LastName=\"".$last_name."\" Email=\"".$email."\" PhoneNumber=\"".$phonenumber."\" street1=\"".$street1."\" xmlns=\"http://www.pesapal.com\" />";
      $post_xml = htmlentities($post_xml);
$consumer_key = PESAPAL_CONSUMER_KEY;
$consumer_secret = PESAPAL_CONSUMER_SECRET;
//$consumer = new OAuthConsumer($consumer_key, $consumer_secret);
$token = $this->getToken();
$params = $this->getToken();
//post transaction to pesapal
$iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, "GET",
$iframelink, $params);
$iframe_src->set_parameter("oauth_callback", $callback_url);
$iframe_src->set_parameter("pesapal_request_data", $post_xml);
$iframe_src->sign_request($signature_method, $consumer, $token);
    }

  }
