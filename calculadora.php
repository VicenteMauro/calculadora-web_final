<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Usa el formulario correctamente"]);
    exit;
}

$num1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
$num2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
$op   = $_POST['operacion'] ?? null;

if ($num1 === null || $num1 === false || $num2 === null || $num2 === false || $op === null) {
    echo json_encode(["error" => "Error: datos incompletos o inválidos"]);
    exit;
}

switch ($op) {
    case 'suma':
        $resultado = $num1 + $num2;
        $simbolo = '+';
        break;
    case 'resta':
        $resultado = $num1 - $num2;
        $simbolo = '-';
        break;
    case 'multiplicacion':
        $resultado = $num1 * $num2;
        $simbolo = '×';
        break;
    case 'division':
        if ($num2 == 0) {
            echo json_encode(["error" => "Error: no se puede dividir entre 0"]);
            exit;
        }
        $resultado = $num1 / $num2;
        $simbolo = '÷';
        break;
    default:
        echo json_encode(["error" => "Error: operación no válida"]);
        exit;
}

echo json_encode([
    "resultado" => $resultado,
    "detalle" => "$num1 $simbolo $num2 = $resultado"
]);
?>