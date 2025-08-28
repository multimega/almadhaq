<?php

 
 return array(
     
'client_id'=>'AZmK-3fvY7eQC4aReQS1tCqQjjSR2gJwtQhjmwEfvTxVhfgyljdlcKq9gWZ47P__8ywnWElckaemp85C',
'secret' => 'EAsoWJCqK8sZ0xl0MiJqNYXAP9r5AJywsLrvwYFkTbFHtyxiAZ0M2uLEfadXcmKGXSD_-NqOIf1uiA2Y',
/**
* SDK configuration 
*/
'settings' => array(
	/**
	* Available option 'sandbox' or 'live'
	*/
	'mode' => 'live',
	/**
	* Specify the max request time in seconds
	*/
	'http.ConnectionTimeOut' => 1000,
	/**
	* Whether want to log to a file
	*/
	'log.LogEnabled' => true,
	/**
	* Specify the file that want to write on
	*/
	'log.FileName' => storage_path() . '/logs/paypal.log',
	/**
	* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
	*
	* Logging is most verbose in the 'FINE' level and decreases as you
	* proceed towards ERROR
	*/
	'log.LogLevel' => 'FINE'
	),

);