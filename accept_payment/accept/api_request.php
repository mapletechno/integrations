<?php
$intid = 4971;
$token = 'ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SnVZVzFsSWpvaWFXNXBkR2xoYkNJc0ltTnNZWE56SWpvaVRXVnlZMmhoYm5RaUxDSndjbTltYVd4bFgzQnJJam96TWpRM2ZRLlhwYUV2T05jWTNXOGl0T2tkMzVyb09XbzJwdllGVHJSdkVqOGxVa29pdkczaFU4eUJwSWs2dGVXaThDLWNvLUNCN0xFb0RzY0hoQm43am5oblctcl9n';
$host = "https://accept.paymobsolutions.com/api/auth/tokens";
$additionalHeaders = array(
//	"Host: tip-of-the-day.myshopify.com",
  //  "X-Shopify-Access-Token: b0bb404533ebd7f54167c59f8c8ca666",
    "Content-Type: application/json",
    "Authorization: Bearer $token"
  );
$json = '{
  "api_key": "ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SnVZVzFsSWpvaWFXNXBkR2xoYkNJc0ltTnNZWE56SWpvaVRXVnlZMmhoYm5RaUxDSndjbTltYVd4bFgzQnJJam96TWpRM2ZRLlhwYUV2T05jWTNXOGl0T2tkMzVyb09XbzJwdllGVHJSdkVqOGxVa29pdkczaFU4eUJwSWs2dGVXaThDLWNvLUNCN0xFb0RzY0hoQm43am5oblctcl9n"
}';

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
$token = $return1->token;


echo "$token is here";
//exit;
$url = "https://accept.paymobsolutions.com/api/acceptance/iframes/8065";
$additionalHeaders = array(
//	"Host: tip-of-the-day.myshopify.com",
  //  "X-Shopify-Access-Token: b0bb404533ebd7f54167c59f8c8ca666",
    "Content-Type: application/json",
    "Authorization: Bearer $token"
  );

//print_r($additionalHeaders);

$chm = curl_init($url);

curl_setopt($chm, CURLOPT_HTTPHEADER, $additionalHeaders);
//curl_setopt($chm, CURLOPT_HEADER, 1);
//curl_setopt($ch, CURLOPT_USERPWD, "ahmad:123456");
curl_setopt($chm, CURLOPT_TIMEOUT, 30);
//curl_setopt($chm, CURLOPT_POST, 1);
//curl_setopt($chm, CURLOPT_POSTFIELDS, $json);
curl_setopt($chm, CURLOPT_RETURNTRANSFER, TRUE);
$return1 = curl_exec($chm);
curl_close($chm);
//print_r($return1);
echo "hi";


     function HttpGet($url_path)
    {
    	global $token;
        $ch  = curl_init();
        $target = "https://accept.paymobsolutions.com/api/".$url_path;
        $options = [
            CURLOPT_URL => $target,
            CURLOPT_HTTPHEADER => ["Content-Type: application/json", "Authorization: Bearer $token"],
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
        ];

        curl_setopt_array($ch, $options);
        $response_raw_data  = curl_exec($ch);
        $response = $response_raw_data;
        $response_json_data = json_decode($response);
        $response_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        if ( !in_array($response_status_code, [200, 201]) )
        {
            $error = json_decode($response, true);
        }

        curl_close($ch);
        if($response_json_data){
            return $response_json_data;
        }

        return false;
    }
$x = HttpGet("ecommerce/integrations/$intid");
print_r($x);
?>