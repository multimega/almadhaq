<?php

use Session;
use DB;

if(!function_exists('getLang'))
{
    /*
     * global function to get language from session user if exists
     * return it else get defulat language from db 
     * @return string
     */
    
    function getLang()
    {
        $sessionLanguage = Session::get('language');
        $defualtLanguage  = DB::table('languages')->where('is_default',1)->first();
        if(!is_null($sessionLanguage))
            return ($sessionLanguage == 1) ? 'en' : 'ar';
        else
            return $defualtLanguage->sign;
    }
}