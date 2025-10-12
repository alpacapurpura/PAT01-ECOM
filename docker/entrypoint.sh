#!/bin/sh

# Salir inmediatamente si un comando falla.
set -e

echo "🚀 Iniciando script de entrada..."

# 1. Cambiar el propietario de todo wp-content
echo "✨ Cambiando propietario de wp-content..."
chown -R www-data:www-data /var/www/html/wp-content

# 2. Establecer permisos para los temas (themes)
echo "📂 Estableciendo permisos para los temas..."
find /var/www/html/wp-content/themes -type d -exec chmod 755 {} \;
find /var/www/html/wp-content/themes -type f -exec chmod 644 {} \;

# 3. Establecer permisos para los plugins
echo "🔌 Estableciendo permisos para los plugins..."
find /var/www/html/wp-content/plugins -type d -exec chmod 755 {} \;
find /var/www/html/wp-content/plugins -type f -exec chmod 644 {} \;

echo "✅ Permisos establecidos correctamente."
echo "🔥 Iniciando servidor Apache..."

# 4. Iniciar Apache (reemplazando este script)
exec apache2-foreground