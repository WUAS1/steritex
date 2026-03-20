<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alerta de Cantidad Excedida</title>
</head>
<body>
    <h2>Alerta de Cantidad Excedida</h2>
    
    <p>Se ha registrado una falla con una cantidad superior a 50 unidades.</p>
    
    <p><strong>Detalles de la falla:</strong></p>
    <ul>
        <li><strong>Fecha:</strong> {{ $data['fecha'] }}</li>
        <li><strong>Turno:</strong> {{ $data['turno'] }}</li>
        <li><strong>Operario:</strong> {{ $data['operario'] }}</li>
        <li><strong>Área:</strong> {{ $data['area'] }}</li>
        <li><strong>Proceso:</strong> {{ $data['proceso'] }}</li>
        <li><strong>Producto:</strong> {{ $data['producto'] }}</li>
        <li><strong>Cantidad:</strong> {{ $data['cantidad'] }}</li>
        <li><strong>Defecto:</strong> {{ $data['defecto'] }}</li>
        <li><strong>Observaciones:</strong> {{ $data['observaciones'] }}</li>
    </ul>
    
    <p>Por favor, revise esta situación de inmediato.</p>
</body>
</html>