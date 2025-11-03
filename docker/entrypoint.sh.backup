#!/bin/sh

# Salir inmediatamente si un comando falla.
set -e

echo "🚀 Iniciando script de entrada..."

# 1. Verificar si WordPress está instalado (primera ejecución)
if [ ! -f "/var/www/html/index.php" ]; then
    echo "📦 Primera ejecución detectada - Copiando WordPress core..."
    
    # Copiar todos los archivos de WordPress desde la imagen oficial
    if [ -d "/usr/src/wordpress" ]; then
        echo "📂 Copiando archivos desde /usr/src/wordpress..."
        cp -r /usr/src/wordpress/. /var/www/html/
        echo "✅ WordPress core copiado exitosamente"
    else
        echo "❌ Error: No se encontró /usr/src/wordpress"
        exit 1
    fi
    
    # Establecer propietario inicial para todos los archivos
    echo "👤 Estableciendo propietario inicial..."
    chown -R www-data:www-data /var/www/html
else
    echo "✅ WordPress ya está instalado, continuando..."
fi

# 2. Cambiar el propietario de todo wp-content
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