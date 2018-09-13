<?php

/**
 * HesabfaBaseStore short summary.
 *
 * HesabfaBaseStore description.
 *
 * @version 1.0
 * @author Keyvan
 */
class HesabfaBaseStore
{
    const BaseUrl = 'https://api.hesabfa.com/v1/';
    
    /**
     * Summary of CreateUrl
     * @param string $url 
     * @return string
     */
    protected function CreateUrl($url){
        return self::BaseUrl . $url;
    }
}