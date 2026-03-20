# Instrucciones de Configuración - Steritex Laravel

## 1. Configuración del archivo .env

Debes configurar tu archivo `.env` con los siguientes valores:

```env
APP_NAME=Steritex
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Configuración de Base de Datos (ajusta según tu configuración)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=steritex
DB_USERNAME=root
DB_PASSWORD=

# Configuración de Correo (para las alertas de Scrap)
# Ejemplo con Mailtrap:
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=tu_usuario_mailtrap
MAIL_PASSWORD=tu_contraseña_mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=alertas@steritex.com
MAIL_FROM_NAME="${APP_NAME}"

# Email del administrador para alertas
EMAIL_ADMIN=admin@steritex.com
```

## 2. Ejecución de Migraciones

Ejecuta las siguientes commandes en tu terminal:

```bash
# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# (Opcional) Poblar la base de datos con usuarios de prueba
php artisan db:seed --class=UserSeeder
```

## 3. Credenciales de Acceso

Después de ejecutar el seeder, you'll have access to:

| Rol | Email | Contraseña |
|-----|-------|-------------|
| Administrador | admin@steritex.com | admin123 |
| Operador | operador@steritex.com | operador123 |

## 4. Configuración de Mailtrap para Pruebas

1. Regístrate en https://mailtrap.io
2. Crea un nuevo proyecto
3. Copia las credenciales SMTP y pégalas en tu .env

## 5. Notas Importantes

- El sistema está configurado para enviar alertas cuando un registro de Scrap supere las 10 unidades
- El correo de alertas se envía al email configurado en `config/app.php` ('email_admin')
- Para desarrollo, puedes usar Mailtrap o configurar un servidor SMTP real

