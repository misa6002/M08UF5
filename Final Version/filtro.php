<?php
if (isset($_POST['from_datetime']) && isset($_POST['to_datetime'])) {
	$from_datetime = $_POST['from_datetime'];
	$to_datetime = $_POST['to_datetime'];

	$query = "SELECT * FROM imagenes WHERE fecha BETWEEN '$from_datetime' AND '$to_datetime'";

	echo "Consulta realizada: " . $query;
} else {
	echo "Por favor selecciona un rango de fechas y horas.";
}
?>

