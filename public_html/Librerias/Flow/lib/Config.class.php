<?php
/**
 * Clase para Configurar el cliente
 * @Filename: Config.class.php
 * @version: 2.0
 * @Author: flow.cl
 * @Email: csepulveda@tuxpan.com
 * @Date: 28-04-2017 11:32
 * @Last Modified by: Carlos Sepulveda
 * @Last Modified time: 28-04-2017 11:32
 */
 
 $COMMERCE_CONFIG = array(
 	//"APIKEY" => "7256167F-2E27-4A93-9341-4145L8403BA0", // Registre aquí su apiKey
 	"APIKEY" => "311FBECE-91EF-44BF-9FBE-5FBCDL8AEE17", // Registre aquí su apiKey
 	//"SECRETKEY" => "04edad9c44840cf64370a9a0c1c7590780c39d8e", // Registre aquí su secretKey
 	"SECRETKEY" => "f6d06c89f68c311ebd54701110ef722e2eb8078c", // Registre aquí su secretKey
 	//"APIURL" => "https://www.flow.cl/api", // Producción EndPoint o Sandbox EndPoint
 	"APIURL" => "https://sandbox.flow.cl/api", // Producción EndPoint o Sandbox EndPoint
 	"BASEURL" => "https://www.agrofrezdelivery.cl/Librerias/Flow" //Registre aquí la URL base en su página donde instalará el cliente
 );
 
 class Config {
 	
	static function get($name) {
		global $COMMERCE_CONFIG;
		if(!isset($COMMERCE_CONFIG[$name])) {
			throw new Exception("The configuration element thas not exist", 1);
		}
		return $COMMERCE_CONFIG[$name];
	}
 }
