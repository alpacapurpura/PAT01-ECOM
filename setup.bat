@echo off
echo Configurando WordPress Docker Environment...

:: Crear directorios necesarios
if not exist "wordpress\themes" mkdir wordpress\themes
if not exist "wordpress\plugins" mkdir wordpress\plugins
if not exist "wordpress\uploads" mkdir wordpress\uploads
if not exist "mysql\init" mkdir mysql\init
if not exist "secrets" mkdir secrets
if not exist "backups" mkdir backups

:: Copiar archivo de entorno si no existe
if not exist ".env" (
    copy ".env.example" ".env"
    echo Archivo .env creado. Por favor, configura las variables necesarias.
)

:: Generar secretos si no existen
if not exist "secrets\mysql_root_password.txt" (
    echo %RANDOM%%RANDOM%%RANDOM% > secrets\mysql_root_password.txt
    echo Contraseña root de MySQL generada.
)

if not exist "secrets\mysql_password.txt" (
    echo %RANDOM%%RANDOM%%RANDOM% > secrets\mysql_password.txt
    echo Contraseña de usuario MySQL generada.
)

:: Configurar permisos de archivos
attrib +R secrets\*.txt

echo.
echo Configuración completada!
echo.
echo Próximos pasos:
echo 1. Edita el archivo .env con tus configuraciones
echo 2. Ejecuta: docker-compose up -d
echo 3. Accede a WordPress en http://localhost:8080
echo.
pause