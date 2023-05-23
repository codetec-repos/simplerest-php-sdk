<?php

function getCache (String $key) 
{
    return $GLOBALS[$key] ?? null;
}

function setCache (String $key, $value) 
{
    return $GLOBALS[$key] = $value;
}