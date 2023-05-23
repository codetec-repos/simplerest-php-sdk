<?php 

namespace Codetec\SimplerestPhpSdk\Classes;

use Codetec\SimplerestPhpSdk\Classes\ConfigMap;

class ReverseAuthentication extends ConfigMap 
{

    public function __construct () {
        parent::__construct();
    }

    public function login ($metaData, $expires, $token) 
    {
        try 
        {
            if((!$expires || !is_numeric($expires))) $expires = 900;

            $curl = curl_init();

            $headers = array(
                'Content-Type: application/json;charset=utf-8',
                "Authorization: Bearer {$this->getSecretToken()}"
            );

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $this->getApiURL() . '/v1/auth/reverse');
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt($curl, CURLOPT_TIMEOUT, 60);
            // curl_setopt($curl, CURLOPT_SSLVERSION, '1.00');
            // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
                'meta_data' => !$metaData ? [ 'roles' => [] ] : $metaData,
                'expires' => $expires,
                'token' => $token
            ]));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            
            $response = curl_exec($curl);
            
            $requestInfo = curl_getinfo($curl);
           
            curl_close($curl);

            if($requestInfo['http_code'] === 401) return (object)[ 'error' => 'The Secret Token is wrong' ];

            $responseData = json_decode($response);

            return $responseData->data ?? false;
        } 
        catch (\Exception $error) 
        {
            throw $error;
        }
    }

    public function logout ($token) 
    {
        try 
        {
            $curl = curl_init();

            $headers = array(
                'Content-Type: application/json;charset=utf-8',
                "Authorization: Bearer {$this->getSecretToken()}"
            );

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $this->getApiURL() . "/v1/auth/reverse?token={$token}");
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt($curl, CURLOPT_TIMEOUT, 60);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            
            $response = curl_exec($curl);
            
            $requestInfo = curl_getinfo($curl);
           
            curl_close($curl);

            if($requestInfo['http_code'] === 401) return (object)[ 'error' => 'The Secret Token is wrong' ];
            
            $responseData = json_decode($response);

            return $responseData->data ?? false;
        } 
        catch (\Exception $error) 
        {
            return $error;
        }
    }

}