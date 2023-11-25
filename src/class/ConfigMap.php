<?php 

namespace Codetec\SimplerestPhpSdk\Classes;

require_once __DIR__ . "/../cache/index.php";

class ConfigMap 
{

    protected $secretToken = null;

    public function __construct () 
    {
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

    public function getApiURL () 
    {
        return $_ENV['API_URL'] ?? '';
    }
}