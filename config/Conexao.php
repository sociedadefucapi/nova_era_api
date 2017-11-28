<?php
/**
* Simples connection class using Singleton pattern
*/
class Conexao {

	private $db;

	private function __construct(){
		$db = new mysqli("localhost","root","","novaera");

		//$db = new mysqli("mysql01-farm51.kinghost.net","lhrti19","herman1905","lhrti19");
		$db->query("SET NAMES 'utf8'");
		$db->query('SET character_set_connection=utf8');
		$db->query('SET character_set_client=utf8');
		$db->query('SET character_set_results=utf8');

		$this->db = $db;
	}

	public static function getInstance(){

		static $instancia = null;
		if($instancia === null){
			$instancia = new Conexao();
		}
		return $instancia;
	}

	public function getDb(){
		return $this->db;
	}
}
