<?php

use Noodlehaus\Config;

class Setting
{
	public static function getConfig($key){
		$conf = Config::load(__DIR__ .'/config/config.json');
		return $conf[$key];
	}

	public static function baseUrl(){
		return self::getConfig('base_url');
	}
}

?>