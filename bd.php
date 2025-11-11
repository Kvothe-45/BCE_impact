<?php
	function getBD(){
		$bdd = new PDO('mysql:host=localhost;dbname=bce_impact;charset=utf8','root', 'root');
		return $bdd;
	}
?>