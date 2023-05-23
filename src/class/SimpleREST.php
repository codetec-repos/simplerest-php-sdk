<?php 

namespace Codetec\SimplerestPhpSdk\Classes;

use Codetec\SimplerestPhpSdk\Classes\ConfigMap;

class SimpleREST extends ConfigMap 
{

    public function __construct ($secretToken, $environment) 
    {
        $this->setEnvironment($environment);
        $this->setSecretToken($secretToken);
    }

    /*
        @metaData : Object
    */
    public function reverseAuthentication ($metaData, $token, $expires = 900) 
    {
        try {
            if(!$this->getSecretToken()) throw 'Secret Token must be not empty or null';
            if((!strlen($token) || !is_string($token))) throw 'Token must be string and not empty or null';

            $reverseAuthInstance = new ReverseAuthentication();

            return $reverseAuthInstance->login($metaData, $expires, $token);
        } catch (\Exception $error) {
            return $error;
        }
    }

    public function reverseAuthenticationLogout ($token) 
    {
        try {
            if(!$this->getSecretToken()) throw 'Secret Token must be not empty or null';
            if((!strlen($token) || !is_string($token))) throw 'Token must be string and not empty or null';

            $reverseAuthInstance = new ReverseAuthentication();

            return $reverseAuthInstance->logout($token);
        } catch (\Exception $error) {
            return $error;
        }
    }

}