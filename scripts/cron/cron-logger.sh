#!/bin/bash
# ----------------------------------------------------------------
# Script para redirigir logs de cron a ubicación centralizada
# ----------------------------------------------------------------

# Configuración
LOGS_DIR="/home/chris/PAT01-ECOM/wordpress/logs"
CRON_LOG_DIR="${LOGS_DIR}/cron"
CRON_LOG_FILE="${CRON_LOG_DIR}/cron.log"

# Crear directorio si no existe
mkdir -p "$CRON_LOG_DIR"

# Función para logging con timestamp
log_cron() {
    local message="$1"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
    echo "[$timestamp] $message" >> "$CRON_LOG_FILE"
}

# Función para ejecutar comando y loggear resultado
execute_and_log() {
    local command="$1"
    local description="$2"
    
    log_cron "INICIO: $description"
    
    if eval "$command" >> "$CRON_LOG_FILE" 2>&1; then
        log_cron "ÉXITO: $description completado"
    else
        log_cron "ERROR: $description falló"
    fi
    
    log_cron "FIN: $description"
    echo "---" >> "$CRON_LOG_FILE"
}

# Exportar funciones para uso en crontab
export -f log_cron
export -f execute_and_log
export LOGS_DIR
export CRON_LOG_DIR
export CRON_LOG_FILE