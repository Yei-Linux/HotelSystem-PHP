<?php 

	class Conexion{
		
		public function Conectar(){

			$link=new PDO("mysql:host=localhost;dbname=basehotel","root","");

			$link->exec("set names utf8");

			return $link;
		}
	}

?>