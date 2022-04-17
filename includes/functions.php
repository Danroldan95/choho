<?php
/*Incluye el archivo que realiza la conexión a la base de datos*/
include 'database/database.php';
$dias_fecha = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
$meses_fecha = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
/*Función para convertir un arreglo en formato PostgreSQL a PHP*/
function ar_sql_ar_php($a_sql)
{
	$a_sql = str_replace(array('{"', '"}', '",', ',"'), array('{', '}', ',', ','), $a_sql);
	$a_sql = substr($a_sql, strpos($a_sql, '{') + 1);
	$a_sql = str_replace('}', '', $a_sql);

	if (strlen($a_sql) > 0) {
		$a_php = explode(',', $a_sql);
	}
	for ($i = 0; $i < count($a_php); $i++) {
		if (substr($a_php[$i], 0, 1) == '"') $a_php[$i] = substr($a_php[$i], 1);
		if (substr($a_php[$i], strlen($a_php[$i]) - 1, 1) == '"') $a_php[$i] = substr($a_php[$i], 0, strlen($a_php[$i]) - 1);
	}
	return $a_php;
}
/*Función para convertir un arreglo en formato PHP a PostgreSQL*/
function ar_php_ar_sql($a_php)
{
	if (count($a_php) > 0) $a_sql = "[0:" . (count($a_php) - 1) . "]={" . implode(',', $a_php) . "}";
	return $a_sql;
}
/*Función para contar las filas de una tabla en especifico*/
function contar($tabla, $condiciones)
{
	$sql = "select count(*) as filas from " . $tabla . " where 1=1 " . $condiciones;
	return ejecutar_sql($sql);
}

@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');

/* Listado de Archivos con las funciones a realizar */

include 'functions/clientes.php';

/*Realiza el llamado a alguna función cuando está viene a través de un formulario con el método POST*/
if (isset($_POST['funcion'])) {
	$funcion = $_POST['funcion'];
	$accion = $_POST['accion'];
	$condiciones = $_POST['condiciones'];
	if (isset($_POST['orden'])) {
		$orden = $_POST['orden'];
	} else {
		$orden = '';
	}
	echo $funcion($accion, $condiciones, $orden);
}
