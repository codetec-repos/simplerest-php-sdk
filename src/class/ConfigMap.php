<?php 

namespace Codetec\SimplerestPhpSdk\Classes;

require_once __DIR__ . "/../cache/index.php";

class ConfigMap 
{

    public static $SANDBOX_ENVIRONMENT = 0;
    public static $PRD_ENVIRONMENT = 1;

    protected $environment = null;
    protected $secretToken = null;

    public function __construct () 
    {
        $this->environment = \getCache('environment');
        $this->secretToken = \getCache('secretToken');
    }

    public function getSecretToken () 
    {
        return $this->secretToken;
    }

    public function setSecretToken ($secretToken) 
    {
        \setCache('secretToken', $secretToken);
        return $this->secretToken = $secretToken;
    }

    public function setEnvironment ($environment) 
    {
        \setCache('environment', $environment);
        return $this->environment = $environment;
    }

    public function getEnvironment () 
    {
        return $this->environment;
    }

    public function getApiURL () 
    {
        return !$this->environment 
            ? 'https://api.sandbox.simplerest.com.br' 
            : 'https://api.simplerest.com.br';
    }
}