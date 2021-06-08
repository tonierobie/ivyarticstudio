<?php
  namespace App\Models;
  use Core\{Model, DB, H};
  use Core\Validators\{RequiredValidator};

  class Transactions extends Model{
    protected static $_table = 'transactions';
    protected static $_softDelete = true;

    public $id, $created_at, $updated_at, $cart_id, $gateway, $type, $amount, $success = 0;
    public $charge_id, $reason, $card_brand, $last4, $name, $shipping_address1, $shipping_address2, $email, $phone;
    public $shipping_city, $shipping_state, $shipping_zip, $shipping_country, $deleted = 0;

    public function beforeSave(){
      $this->timestamps();
    }

    public function validateShipping(){
      $this->runValidation(new RequiredValidator($this,['field'=>'name','msg'=>'Name is required.']));
      $this->runValidation(new RequiredValidator($this,['field'=>'shipping_address1','msg'=>'Address is required.']));
      $this->runValidation(new RequiredValidator($this,['field'=>'email','msg'=>'Email address is required.']));
      $this->runValidation(new RequiredValidator($this,['field'=>'phone','msg'=>'Phone number is required.']));
      $this->runValidation(new RequiredValidator($this,['field'=>'shipping_city','msg'=>'City is required.']));
      $this->runValidation(new RequiredValidator($this,['field'=>'shipping_state','msg'=>'State is required.']));
      $this->runValidation(new RequiredValidator($this,['field'=>'shipping_zip','msg'=>'Zip Code is required.']));
    }

    public static function getDailySales($range='last-28'){
      $today = date("Y-m-d");
      $range = str_replace("last-","",$range);
      $fromDate = date("Y-m-d",strtotime("-".$range." days"));
      $db = DB::getInstance();
      $sql = "SELECT DATE(created_at) as created_at, SUM(amount) as amount
        FROM `transactions`
        WHERE success = 1 AND created_at BETWEEN ? AND ?
        GROUP BY DATE(created_at)";
      return $db->query($sql,[$fromDate,$today." 23:59:59"])->results();
    }
    public static function updateTransaction($cart_id,$trackid,$paytype,$total){
      $total = ceil($total*KENYA_SHILLING_EXCHANGE_RATE);
      //H::dnd($total);
      $tx = self::findFirst([
        'conditions' => "cart_id = ?",
        'bind' => [$cart_id]
      ]);
      $tx->gateway = 'PesaPal';
      $tx->type = $paytype;
      $tx->amount = $total;
      $tx->success =  1;
      $tx->charge_id = $trackid;
      $tx->reason = 'paid';
      $tx->card_brand = $paytype;
      $tx->save();
      return $tx;
    }

    public static function findCartID($cart_id){
        $conditions = [
          'conditions' => "cart_id = ?",
          'bind' => [(int)$cart_id]
        ];
      return self::findFirst($conditions);
    }

  }
