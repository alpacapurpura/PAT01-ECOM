#!/bin/bash

echo "Configurando WordPress Docker Environment..."

# Crear directorios necesarios
mkdir -p wordpress/{themes,plugins,uploads}
mkdir -p mysql/init
mkdir -p secrets
mkdir -p backups

# Copiar archivo de entorno si no existe
if [ ! -f ".env" ]; then
    cp ".env.example" ".env"
    echo "Archivo .env creado. Por favor, configura las variables necesarias."
fi

# Generar secretos si no existen
if [ ! -f "secrets/mysql_root_password.txt" ]; then
    openssl rand -base64 32 > secrets/mysql_root_password.txt
    echo "Contraseña root de MySQL generada."
fi

if [ ! -f "secrets/mysql_password.txt" ]; then
    openssl rand -base64 32 > secrets/mysql_password.txt
    echo "Contraseña de usuario MySQL generada."
fi

# Configurar permisos de archivos
chmod 600 secrets/*.txt
chmod +x setup.sh

echo ""
echo "Configuración completada!"
echo ""
echo "Próximos pasos:"
echo "1. Edita el archivo .env con tus configuraciones"
echo "2. Ejecuta: docker-compose up -d"
echo "3. Accede a WordPress en http://localhost:8080"
echo ""