<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo "Usa el formulario de index.html";
  exit;
}

$num1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
$num2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
$op   = $_POST['operacion'] ?? null;

if ($num1 === null || $num1 === false || $num2 === null || $num2 === false || !$op) {
  echo "Error: datos incompletos o inválidos";
  exit;
}

switch ($op) {
  case 'multiplicacion': $resultado = $num1 * $num2; break;
  case 'division':
    if ($num2 == 0) { echo "Error: no se puede dividir entre 0"; exit; }
    $resultado = $num1 / $num2; break;
  default:
    echo "Error: operación no válida"; exit;
}

echo "Resultado: " . $resultado;
