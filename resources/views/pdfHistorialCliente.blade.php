<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Historial de Abonos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #a8a5a5;
        }
        .header {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="header">
    <h2>Historial de Movimientos</h2>
    <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
    <p><strong>Número de Identificación:</strong> {{ $cliente->identificacion }}</p>
    <p><strong>Fecha de Apertura de Cuenta:</strong> {{ $cliente->fecha_apertura }}</p>
</div>

<table>
    <thead>
    <tr>
        <th>Fecha Movimiento</th>
        <th>Abono</th>
        <th>Retiro</th>
        <th>Saldo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($movimientos as $movimiento)
        <tr>
            <td>{{ $movimiento->fecha_movimiento }}</td>
            <td>{{ $movimiento->abonos }}</td>
            <td>{{ $movimiento->retiros }}</td>
            <td>{{ $movimiento->saldo }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
