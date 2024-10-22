<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "productos_prueba"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nom_producto = $_POST['nom_producto'] ?? '';
$descrip_producto = $_POST['descrip_producto'] ?? '';
$valor_producto = $_POST['valor_producto'] ?? 0; 
$estadofk = $_POST['estadofk'] ?? null; // Cambié a null para validar correctamente
$tipo_elemfk = $_POST['tipo_elemfk'] ?? null; // Asegúrate de que coincida

var_dump($_POST);

// Imprimir los valores recibidos para depuración
var_dump($nom_producto, $descrip_producto, $valor_producto, $estadofk, $tipo_elemfk);

// Validar campos
if (empty($nom_producto) || empty($descrip_producto) || !is_numeric($valor_producto) || $estadofk === null || $tipo_elemfk === null) {
    die("Error: Todos los campos son obligatorios y el valor debe ser un número válido.");
}

// Insertar datos
$sql = "INSERT INTO productos (nom_producto, descrip_producto, valor_producto, estadofk, tipo_elemfk) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación: " . $conn->error);
}

$stmt->bind_param("ssiii", $nom_producto, $descrip_producto, $valor_producto, $estadofk, $tipo_elemfk);

if ($stmt->execute()) {
    echo "Nuevo producto registrado exitosamente";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>
