<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Util {

	public function __construct()
	{
		
	}
	
	public function floatParaInsercao(&$valor){
		$pattern = '/[^0-9.,]*/';
		$replacement = '';
		$valor = preg_replace($pattern, $replacement, $valor);
		$valor = str_replace(".", "", $valor);
		$valor = str_replace(",", ".", $valor);
		return $valor;
	}

	public function antiSql($str=null){
		if(!empty($str)){
			$sql = preg_replace('/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/','',$str);
			$sql = trim($str);
			$sql = strip_tags($str);
			$sql = addslashes($str);
		}
		
		return $str;
	}

	public function formatarMoeda($valor){

		return number_format($valor, 2,",",".");
	}

	public function geraString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function converteDataParaInsercao($data){
		$data = substr($data, 6,4)."-".substr($data, 3,2)."-".substr($data, 0,2);
		return $data;
	}



}

	?>