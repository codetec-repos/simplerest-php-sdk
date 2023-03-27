<?php

if(!session_status()) session_start();

function getCache (String $key) 
{
    return $_SESSION[$key] ?? null;
}

function setCache (String $key, $value) 
{
    return $_SESSION[$key] = $value;
}