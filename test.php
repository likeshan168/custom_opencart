<?php
//echo phpinfo();
require 'vendor/autoload.php';
function call_api($method, $url, $data = false){
	$curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
	//curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array( /*ษ่ึรว๋ว๓อท*/
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data))
    );

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;

}
//$data= array("Username"=>"admin", "Password"=>"123");
//echo call_api("POST","http://localhost:5000/Account/Login",$data);


//use Httpful\Request;
//$url="http://localhost:5000/Account/Login";
//$response = Request::post($url)
//    ->sendsJson()
//    ->body('{"Username":"admin","Password":"123"}')
//    ->send();
//var_dump($response);

use GuzzleHttp\Client;
use Guzzle\Http\Exception\RequestException;

try
{
	$client = new Client();
	$client->setDefaultOption('headers', array(
'Accept-Encoding' => 'gzip,deflate',
'Content-Type' => 'application/json'
	));
	$response = $client->post('http://localhost:5000/api/account/login',[
		 'json'=>['UserName'=>'admin','Password'=>'123']
		]);
	$body = $response->json();
	echo $body["Code"], $body["Message"], $body["IsSuccess"] ;
}
catch (RequestException $exception)
{
	echo $exception;
}
catch(Exception $e)
{
	echo $e;
}

?>