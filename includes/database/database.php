<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

	/** ARCHIVO PARA MANEJO DE BASE DE DATOS **/
	/**
	 * 
	 * CONECTA A LA BASE DE DATOS ...
	 * @param Directorio Base
	 * @return Recurso de conexión en caso de éxito, falso en caso de fallo.
	 */
	function conectar() {
        $host = $_ENV['HOST'];
        $user = $_ENV['DDBB_USER'];
        $password = $_ENV['DDBB_PASSWORD'];
        $db_host = $_ENV['DDBB_HOST'];
		$conn=@pg_connect("dbname=".$db_host." host=".$host." port=5432 user=".$user." password=".$password."");
		return $conn;	
	}
	/**
	 * EJCUTA UNA SENTENCIA SQL
	 * @param SQL a ejecutar.
	 * @param Directorio Base
	 * @return Recurso del resultado en caso de éxito, falso en caso de fallo.
	 */
	function ejecutar_sql($sql) {
		if ($sql!='') {
			$conn=conectar();
			if (!$conn) {
				echo "no se pudo conectar";
			} else {
				$rs=pg_query ($conn, $sql);
				if (!$rs) echo $sql;
				return $rs;
			}
		}
	}
?>