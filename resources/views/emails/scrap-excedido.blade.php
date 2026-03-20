<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerta de Scrap Excedido</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        .email-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .email-header .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .email-body {
            padding: 30px;
        }
        .alert-box {
            background-color: #fef3f2;
            border-left: 4px solid #e74c3c;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .alert-box h3 {
            color: #e74c3c;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .info-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        .info-table th {
            background-color: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }
        .info-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
            color: #212529;
        }
        .info-table tr:last-child td {
            border-bottom: none;
        }
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        .badge-danger {
            background-color: #fde8e7;
            color: #e74c3c;
        }
        .badge-warning {
            background-color: #fef3cd;
            color: #856404;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: 600;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 13px;
        }
        .warning-icon {
            color: #e74c3c;
            font-size: 20px;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="icon">⚠️</div>
            <h1>ALERTA DE SCRAP EXCEDIDO</h1>
            <p>Sistema de Monitoreo - Steritex</p>
        </div>
        
        <!-- Body -->
        <div class="email-body">
            <p>Se ha detectado un registro de <strong>Scrap</strong> que supera el límite establecido de 10 unidades.</p>
            
            <div class="alert-box">
                <h3>
                    <span class="warning-icon">⚠️</span>
                    Cantidad Excedida
                </h3>
                <p style="font-size: 24px; font-weight: bold; color: #e74c3c;">
                    {{ $registro->cantidad }} unidades
                </p>
                <p style="color: #6c757d; margin-top: 5px;">
                    (Límite: 10 unidades)
                </p>
            </div>
            
            <table class="info-table">
                <tr>
                    <th>Campo</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td><strong>ID del Registro</strong></td>
                    <td>#{{ $registro->id }}</td>
                </tr>
                <tr>
                    <td><strong>Tipo</strong></td>
                    <td><span class="badge badge-danger">Scrap</span></td>
                </tr>
                <tr>
                    <td><strong>Cantidad</strong></td>
                    <td style="color: #e74c3c; font-weight: bold;">{{ $registro->cantidad }} unidades</td>
                </tr>
                <tr>
                    <td><strong>Motivo</strong></td>
                    <td>{{ $registro->motivo }}</td>
                </tr>
                <tr>
                    <td><strong>Fecha de Registro</strong></td>
                    <td>{{ $registro->fecha->format('d/m/Y H:i:s') }}</td>
                </tr>
            </table>
            
            <p style="margin-top: 20px;">
                Por favor, tome las medidas necesarias para investigar y resolver esta situación.
            </p>
            
            <center>
                <a href="{{ route('fallas.index') }}" class="cta-button">
                    Ver Registros en el Sistema
                </a>
            </center>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <p><strong>Sistema de Registro de Fallas - Steritex</strong></p>
            <p>Este es un correo automático generado por el sistema.</p>
            <p style="margin-top: 10px; font-size: 11px;">
                © {{ date('Y') }} Steritex. Todos los derechos reservados.
            </p>
        </div>
    </div>
</body>
</html>

