<?php use Core\{FH,H, Router};?>
<?php $this->start('body')?>
<div class="text-center">

<?php
  include_once('OAuth.php');
  $pesapalMerchantReference = $this->merchantRef;
  //echo '<br/>';
  $pesapalTrackingId = $this->trackinId;
  $consumer = new OAuthConsumer(PESAPAL_CONSUMER_KEY, PESAPAL_CONSUMER_SECRET);

    function curlRequest($request_status){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $request_status);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      if(defined('CURL_PROXY_REQUIRED')) if (CURL_PROXY_REQUIRED == 'True'){
        $proxy_tunnel_flag = (
            defined('CURL_PROXY_TUNNEL_FLAG')
            && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE'
          ) ? false : true;
        curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
        curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
      }

      $response 					= curl_exec($ch);
      $header_size 				= curl_getinfo($ch, CURLINFO_HEADER_SIZE);
      $raw_header  				= substr($response, 0, $header_size - 4);
      $headerArray 				= explode("\r\n\r\n", $raw_header);
      $header 					= $headerArray[count($headerArray) - 1];

      //transaction status
      $elements = preg_split("/=/",substr($response, $header_size));
      $pesapal_response_data = $elements[1];

      return $pesapal_response_data;
    }

    function getTransactionDetails($consumer,$pesapalMerchantReference,$pesapalTrackingId){
      $token = $params = NULL;
      $statusrequestAPI = 'https://www.pesapal.com/api/querypaymentdetails';
      $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
      $request_status = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $statusrequestAPI, $params);
      $request_status->set_parameter("pesapal_merchant_reference", $pesapalMerchantReference);
      $request_status->set_parameter("pesapal_transaction_tracking_id",$pesapalTrackingId);
      $request_status->sign_request($signature_method, $consumer, $token);

      $responseData = curlRequest($request_status);

      $pesapalResponse = explode(",", $responseData);
      $pesapalResponseArray=array('pesapal_transaction_tracking_id'=>$pesapalResponse[0],
             'payment_method'=>$pesapalResponse[1],
             'status'=>$pesapalResponse[2],
             'pesapal_merchant_reference'=>$pesapalResponse[3]);

      return $pesapalResponseArray;
    }

    $pesapalResponseArray = getTransactionDetails($consumer,$pesapalMerchantReference,$pesapalTrackingId);
    $value	= array("COMPLETED"=>"Paid","PENDING"=>"Pending","INVALID"=>"Cancelled","FAILED"=>"Cancelled");
    $status	= $value[$pesapalResponseArray['status']];
    $paymethod	= $pesapalResponseArray['payment_method'];

    if($status == 'Paid'){
      //echo 'The cart id = ' .$pesapalMerchantReference. ' is paid';
      Router::redirect('cart/thankYou/'.$pesapalMerchantReference.'/'.$pesapalTrackingId.'/'.$paymethod);
    } elseif ($status == 'Pending') {
      echo 'Your payment is being processed, Kindly wait until it is completed.<br/>';
      echo 'Current status '.$status;
      header("Refresh:5");
    } else {
      $page = 'http://www.ivyarticstudio.com/cart';
      echo 'Your payment has failled, Kindly retry again. <br/>';
      echo 'We will redirect you to your cart in a short while, thank you. <br/>';
      header("Refresh:5; $page");
    }
    ?>
</div>
<?php $this->end() ?>
