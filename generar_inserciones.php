<?php

function generarNombreAleatorio() {
    $nombres = ['Juan', 'Pedro', 'Luis', 'Carlos', 'Ana', 'Maria', 'Laura', 'Sofia', 'Carmen', 'Julia'];
    $apellidos = ['Perez', 'Gonzalez', 'Rodriguez', 'Martinez', 'Garcia', 'Lopez', 'Sanchez', 'Ramirez', 'Torres', 'Flores'];
    return $nombres[array_rand($nombres)] . ' ' . $apellidos[array_rand($apellidos)] . ' ' . $apellidos[array_rand($apellidos)];
}

function generarFechaNacimiento() {
    $inicio = strtotime("1950-01-01");
    $fin = strtotime("2000-12-31");
    $fecha = mt_rand($inicio, $fin);
    return date("Y-m-d", $fecha);
}

function generarDireccionAleatoria() {
    $calles = ['Avenida Revolución', 'Calle Insurgentes', 'Avenida Juárez', 'Calle Hidalgo', 'Calle Morelos'];
    $numero = mt_rand(1, 200);
    $ciudad = 'Ciudad de México';
    return $calles[array_rand($calles)] . ' ' . $numero . ', ' . $ciudad;
}

function generarIdentificacionUnica($id) {
    return str_pad($id, 6, '0', STR_PAD_LEFT);
}

function generarEmailAleatorio($nombre) {
    $dominios = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com'];
    return strtolower(str_replace(' ', '.', $nombre)) . '@' . $dominios[array_rand($dominios)];
}

function generarFechaApertura() {
    $inicio = strtotime("2020-01-01");
    $fin = strtotime("2023-01-01");
    $fecha = mt_rand($inicio, $fin);
    return date("Y-m-d", $fecha);
}

function generarAbonos($identificacion, $fecha_apertura) {
    $abonos = [];
    $fecha = strtotime($fecha_apertura);
    while ($fecha < strtotime(date('Y-m-d'))) {
        $fecha = strtotime("+1 month", $fecha);
        $abonos[] = [
            'identificacion' => $identificacion,
            'movimiento' => true,
            'fecha_movimiento' => date('Y-m-d', $fecha),
            'cantidad' => 500.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }
    return $abonos;
}

function generarRetiros($identificacion, $fecha_apertura) {
    $retiros = [];
    $fecha = strtotime($fecha_apertura);
    while ($fecha < strtotime(date('Y-m-d'))) {
        $fecha = strtotime("+" . mt_rand(1, 3) . " month", $fecha);
        if ($fecha < strtotime(date('Y-m-d'))) {
            $retiros[] = [
                'identificacion' => $identificacion,
                'movimiento' => false,
                'fecha_movimiento' => date('Y-m-d', $fecha),
                'cantidad' => mt_rand(100, 200),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
    }
    return $retiros;
}

$clientes = [];
for ($i = 1; $i <= 20; $i++) {
    $nombre = generarNombreAleatorio();
    $identificacion = generarIdentificacionUnica($i);
    $clientes[] = [
        'id' => $i,
        'nombre' => $nombre,
        'fecha_nacimiento' => generarFechaNacimiento(),
        'direccion' => generarDireccionAleatoria(),
        'identificacion' => $identificacion,
        'telefono' => '555' . mt_rand(1000000, 9999999),
        'email' => generarEmailAleatorio($nombre),
        'numero_cuenta' => str_pad(mt_rand(1, 9999999999999999), 16, '0', STR_PAD_LEFT),
        'saldo' => 1000.00,
        'fecha_apertura' => generarFechaApertura(),
        'empleador' => 'Empresa XYZ',
        'ingresos' => mt_rand(30000, 60000),
        'autorizacion_datos' => 1,
        'consentimiento_comunicaciones' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
}

// Generar las inserciones SQL para los clientes
foreach ($clientes as $cliente) {
    echo "INSERT INTO formulario_clientes (id, nombre, fecha_nacimiento, direccion, identificacion, telefono, email, numero_cuenta, saldo, fecha_apertura, empleador, ingresos, autorizacion_datos, consentimiento_comunicaciones, created_at, updated_at) VALUES ";
    echo "({$cliente['id']}, '{$cliente['nombre']}', '{$cliente['fecha_nacimiento']}', '{$cliente['direccion']}', '{$cliente['identificacion']}', '{$cliente['telefono']}', '{$cliente['email']}', '{$cliente['numero_cuenta']}', {$cliente['saldo']}, '{$cliente['fecha_apertura']}', '{$cliente['empleador']}', {$cliente['ingresos']}, {$cliente['autorizacion_datos']}, {$cliente['consentimiento_comunicaciones']}, '{$cliente['created_at']}', '{$cliente['updated_at']}');\n";

    // Generar abonos y retiros para cada cliente
    $abonos = generarAbonos($cliente['identificacion'], $cliente['fecha_apertura']);
    $retiros = generarRetiros($cliente['identificacion'], $cliente['fecha_apertura']);

    foreach ($abonos as $abono) {
        echo "INSERT INTO historial_abonos (identificacion, movimiento, fecha_movimiento, cantidad, created_at, updated_at) VALUES ";
        echo "('{$abono['identificacion']}', {$abono['movimiento']}, '{$abono['fecha_movimiento']}', {$abono['cantidad']}, '{$abono['created_at']}', '{$abono['updated_at']}');\n";
    }

    foreach ($retiros as $retiro) {
        echo "INSERT INTO historial_abonos (identificacion, movimiento, fecha_movimiento, cantidad, created_at, updated_at) VALUES ";
        echo "('{$retiro['identificacion']}', {$retiro['movimiento']}, '{$retiro['fecha_movimiento']}', {$retiro['cantidad']}, '{$retiro['created_at']}', '{$retiro['updated_at']}');\n";
    }
}

?>
