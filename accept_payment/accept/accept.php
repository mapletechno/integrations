<?php
//authentication
///error_reporting(E_ALL);
//ini_set('display_errors', 1);

//print_r($_GET);
//success
$success = $_GET['success'];

//check if the user has completed the payment
if($success != "")
{
switch ($success) {
  case 'true':
    echo "<b style='color:green;font-size:17px;'>You have successfully placed your order and made the payment!</b>";
    break;
  
  default:
  echo "<b style='color:red;font-size:17px;'>Your payment was not processed unfortunately!</b>";
      break;
}
exit;
}


//exchange tokens
$host = "https://accept.paymobsolutions.com/api/auth/tokens";
$token = 'ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SnVZVzFsSWpvaWFXNXBkR2xoYkNJc0ltTnNZWE56SWpvaVRXVnlZMmhoYm5RaUxDSndjbTltYVd4bFgzQnJJam96TWpRM2ZRLlhwYUV2T05jWTNXOGl0T2tkMzVyb09XbzJwdllGVHJSdkVqOGxVa29pdkczaFU4eUJwSWs2dGVXaThDLWNvLUNCN0xFb0RzY0hoQm43am5oblctcl9n';


$json = '{
  "api_key": "ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SnVZVzFsSWpvaWFXNXBkR2xoYkNJc0ltTnNZWE56SWpvaVRXVnlZMmhoYm5RaUxDSndjbTltYVd4bFgzQnJJam96TWpRM2ZRLlhwYUV2T05jWTNXOGl0T2tkMzVyb09XbzJwdllGVHJSdkVqOGxVa29pdkczaFU4eUJwSWs2dGVXaThDLWNvLUNCN0xFb0RzY0hoQm43am5oblctcl9n"
}';


//$payloadName = array("client_id"=>$client, "client_secret"=>$secret,"code"=>$code);
$additionalHeaders = array(
//	"Host: tip-of-the-day.myshopify.com",
  //  "X-Shopify-Access-Token: b0bb404533ebd7f54167c59f8c8ca666",
    "Content-Type: application/json"
  );

//make the curl request
$chm = curl_init($host);

curl_setopt($chm, CURLOPT_HTTPHEADER, $additionalHeaders);
//curl_setopt($chm, CURLOPT_HEADER, 1);
//curl_setopt($ch, CURLOPT_USERPWD, "ahmad:123456");
curl_setopt($chm, CURLOPT_TIMEOUT, 30);
curl_setopt($chm, CURLOPT_POST, 1);
curl_setopt($chm, CURLOPT_POSTFIELDS, $json);
curl_setopt($chm, CURLOPT_RETURNTRANSFER, TRUE);
$return1 = curl_exec($chm);
curl_close($chm);
//print_r($return1);
$return1 = json_decode($return1);
$tokenx = $return1->token;
//echo($tokenx);
echo "<br /><br />";
//print_r($return1);
//exit;
//merchant id 2087
unset($chm);
unset($return1);
$time = time();


//create an order
$host2 = "https://accept.paymobsolutions.com/api/ecommerce/orders?token=$tokenx";
$json2 = '{
  "access_token": "'.$tokenx.'",
  "delivery_needed": "true",
  "merchant_id": "3247",
  "amount_cents": "200",
  "currency": "EGP",
  "merchant_order_id": '.$time.',
  "shipping_data": {
    "apartment": "803", 
    "email": "ahmed@mapletechno.com", 
    "floor": "42", 
    "first_name": "Ahmed", 
    "street": "eshreen",
    "building": "5", 
    "phone_number": "+201120650544", 
    "postal_code": "11434", 
    "city": "Giza", 
    "country": "EG", 
    "last_name": "Abubakr", 
    "state": ""
  }
}';
//echo "hi";
$chm = curl_init($host2);

curl_setopt($chm, CURLOPT_HTTPHEADER, $additionalHeaders);
//curl_setopt($chm, CURLOPT_HEADER, 1);
//curl_setopt($ch, CURLOPT_USERPWD, "ahmad:123456");
curl_setopt($chm, CURLOPT_TIMEOUT, 30);
curl_setopt($chm, CURLOPT_POST, 1);
curl_setopt($chm, CURLOPT_POSTFIELDS, $json2);
curl_setopt($chm, CURLOPT_RETURNTRANSFER, TRUE);
$return1 = curl_exec($chm);
curl_close($chm);
//print_r($return1);
$return1 = json_decode($return1);
//print_r($return1);
echo "<br /><Br />";
$orderid = $return1->shipping_data->order_id;
echo $orderid;
unset($return1);
unset($chm);
//exit;
//request payment link - 3rd step
$json = '{
  "auth_token": "'.$tokenx.'",
  "amount_cents": "200",
  "expiration": 3600,
  "order_id": "'.$orderid.'",
  "billing_data": {
    "apartment": "1",
    "email": "ahmed@mapletechno.com",
    "floor": "42",
    "first_name": "Ahmed",
    "street": "eshreen",
    "building": "5",
    "phone_number": "+201120650544",
    "shipping_method": "UNK",
    "postal_code": "11434",
    "city": "cairo",
    "country": "EG",
    "last_name": "Aboubakr",
    "state": "Cairo"
  }, 
  "currency": "EGP",
  "integration_id": 4971,
  "lock_order_when_paid": "false"
}';
$host = "https://accept.paymobsolutions.com/api/acceptance/payment_keys?token='.$tokenx.'";
//$host = "https://accept.paymobsolutions.com/api/acceptance/payment_keys";
echo "<br /><br />";

//$json = json_decode($json);
//print_r($json);
//exit;
$chm = curl_init($host);

curl_setopt($chm, CURLOPT_HTTPHEADER, $additionalHeaders);
//curl_setopt($chm, CURLOPT_HEADER, 1);
//curl_setopt($ch, CURLOPT_USERPWD, "ahmad:123456");
curl_setopt($chm, CURLOPT_TIMEOUT, 30);
curl_setopt($chm, CURLOPT_POST, 1);
curl_setopt($chm, CURLOPT_POSTFIELDS, $json);
curl_setopt($chm, CURLOPT_RETURNTRANSFER, TRUE);
$return1 = curl_exec($chm);
curl_close($chm);
//print_r($return1);
$return1 = json_decode($return1);
//print_r($return1);
$paytoken =  $return1->token;
//echo "$paytoken";
$iframe = 5642;
//echo 'hi';

//generate the iframe/payment link
echo '<iframe src="https://accept.paymobsolutions.com/api/acceptance/iframes/8065?payment_token='.$paytoken.'" height="810" width=720></iframe>';
//print_r($return1->token);

//iframe id 5642
?>
