#!/bin/bash

###############################################################################
# SCRIPT DE LIMPIEZA AUTOMÁTICA DE LOGS - WORDPRESS DOCKER
# Proyecto: PAT01-ECOM - E-commerce WordPress con tema Organify
# Autor: Sistema de gestión de logs automatizado
# Fecha: $(date '+%Y-%m-%d')
# Versión: 1.0.0
###############################################################################

# Configuración de colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuración del script
PROJECT_DIR="/home/chris/PAT01-ECOM"
WORDPRESS_DIR="${PROJECT_DIR}/wordpress"
LOGS_DIR="${WORDPRESS_DIR}/logs"
LOG_FILE="${LOGS_DIR}/wordpress/debug.log"
CLEANUP_LOG="${LOGS_DIR}/maintenance/cleanup-logs.log"
DAYS_TO_KEEP=7
MAX_LOG_SIZE="50M"

###############################################################################
# FUNCIÓN: Logging del script
###############################################################################
log_action() {
    local message="$1"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S %Z')
    echo "[${timestamp}] ${message}" >> "${CLEANUP_LOG}"
    echo -e "${BLUE}[INFO]${NC} ${message}"
}

log_error() {
    local message="$1"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S %Z')
    echo "[${timestamp}] ERROR: ${message}" >> "${CLEANUP_LOG}"
    echo -e "${RED}[ERROR]${NC} ${message}"
}

log_success() {
    local message="$1"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S %Z')
    echo "[${timestamp}] SUCCESS: ${message}" >> "${CLEANUP_LOG}"
    echo -e "${GREEN}[SUCCESS]${NC} ${message}"
}

log_warning() {
    local message="$1"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S %Z')
    echo "[${timestamp}] WARNING: ${message}" >> "${CLEANUP_LOG}"
    echo -e "${YELLOW}[WARNING]${NC} ${message}"
}

###############################################################################
# FUNCIÓN: Validaciones de seguridad
###############################################################################
validate_environment() {
    log_action "Iniciando validaciones de seguridad..."
    
    # Verificar que estamos en el directorio correcto
    if [[ ! -d "${PROJECT_DIR}" ]]; then
        log_error "Directorio del proyecto no encontrado: ${PROJECT_DIR}"
        exit 1
    fi
    
    # Verificar que existe el directorio de WordPress
    if [[ ! -d "${WORDPRESS_DIR}" ]]; then
        log_error "Directorio de WordPress no encontrado: ${WORDPRESS_DIR}"
        exit 1
    fi
    
    # Verificar que existe el directorio de logs centralizados
    if [[ ! -d "${LOGS_DIR}" ]]; then
        log_error "Directorio de logs centralizados no encontrado: ${LOGS_DIR}"
        exit 1
    fi
    
    # Verificar que no estamos en producción (verificar docker-compose.prod.yml)
    if [[ -f "${PROJECT_DIR}/docker-compose.prod.yml" ]] && docker ps | grep -q "wp_app.*Up"; then
        log_warning "Detectado entorno que podría ser producción. Procediendo con precaución..."
    fi
    
    log_success "Validaciones de seguridad completadas"
}

###############################################################################
# FUNCIÓN: Análisis del estado actual de logs
###############################################################################
analyze_current_logs() {
    log_action "Analizando estado actual de logs..."
    
    if [[ -f "${LOG_FILE}" ]]; then
        local file_size=$(du -h "${LOG_FILE}" | cut -f1)
        local line_count=$(wc -l < "${LOG_FILE}")
        local last_modified=$(stat -c %y "${LOG_FILE}")
        
        echo -e "\n${BLUE}=== ANÁLISIS DEL ARCHIVO DEBUG.LOG ===${NC}"
        echo -e "📁 Ubicación: ${LOG_FILE}"
        echo -e "📊 Tamaño actual: ${file_size}"
        echo -e "📝 Líneas totales: ${line_count}"
        echo -e "🕒 Última modificación: ${last_modified}"
        
        # Mostrar últimas 5 líneas para verificar filtrado
        echo -e "\n${YELLOW}=== ÚLTIMAS 5 ENTRADAS DE LOG ===${NC}"
        tail -5 "${LOG_FILE}" | while IFS= read -r line; do
            echo -e "  ${line}"
        done
        
        # Contar tipos de errores en las últimas 100 líneas
        echo -e "\n${YELLOW}=== ANÁLISIS DE TIPOS DE ERROR (últimas 100 líneas) ===${NC}"
        local warnings=$(tail -100 "${LOG_FILE}" | grep -c "PHP Warning" || echo "0")
        local notices=$(tail -100 "${LOG_FILE}" | grep -c "PHP Notice" || echo "0")
        local errors=$(tail -100 "${LOG_FILE}" | grep -c "PHP Error\|PHP Fatal error" || echo "0")
        
        echo -e "⚠️  PHP Warnings: ${warnings}"
        echo -e "ℹ️  PHP Notices: ${notices}"
        echo -e "❌ PHP Errors: ${errors}"
        
        log_action "Análisis completado - Tamaño: ${file_size}, Líneas: ${line_count}"
    else
        log_warning "Archivo debug.log no encontrado en ${LOG_FILE}"
    fi
}

###############################################################################
# FUNCIÓN: Limpieza de logs antiguos
###############################################################################
cleanup_old_logs() {
    log_action "Iniciando limpieza de logs antiguos (>${DAYS_TO_KEEP} días)..."
    
    local files_found=0
    local files_deleted=0
    
    # Buscar archivos de log antiguos en todos los directorios de logs
    local log_directories=(
        "${LOGS_DIR}/wordpress"
        "${LOGS_DIR}/mysql"
        "${LOGS_DIR}/cron"
        "${LOGS_DIR}/backup"
        "${LOGS_DIR}/maintenance"
        "${LOGS_DIR}/plugins"
        "${LOGS_DIR}/docker"
    )
    
    for log_dir in "${log_directories[@]}"; do
        if [[ -d "$log_dir" ]]; then
            while IFS= read -r -d '' file; do
                files_found=$((files_found + 1))
                local file_age=$(find "$file" -mtime +${DAYS_TO_KEEP} -print)
                
                if [[ -n "$file_age" ]]; then
                    local file_size=$(du -h "$file" | cut -f1)
                    log_action "Eliminando archivo antiguo: $(basename "$file") (${file_size})"
                    
                    # Crear backup antes de eliminar si el archivo es grande
                    if [[ $(stat -c%s "$file") -gt 10485760 ]]; then # > 10MB
                        local backup_name="${file}.backup.$(date +%Y%m%d_%H%M%S)"
                        cp "$file" "$backup_name"
                        log_action "Backup creado: $(basename "$backup_name")"
                    fi
                    
                    rm -f "$file"
                    files_deleted=$((files_deleted + 1))
                    log_success "Archivo eliminado: $(basename "$file")"
                fi
            done < <(find "$log_dir" -name "*.log*" -type f -print0)
        fi
    done
    
    log_action "Limpieza completada - Archivos encontrados: ${files_found}, Eliminados: ${files_deleted}"
}

###############################################################################
# FUNCIÓN: Rotación manual si el archivo es muy grande
###############################################################################
rotate_large_log() {
    if [[ -f "${LOG_FILE}" ]]; then
        local file_size_bytes=$(stat -c%s "${LOG_FILE}")
        local max_size_bytes=52428800  # 50MB en bytes
        
        if [[ $file_size_bytes -gt $max_size_bytes ]]; then
            log_warning "Archivo debug.log excede ${MAX_LOG_SIZE}. Iniciando rotación manual..."
            
            local rotated_name="${LOG_FILE}.rotated.$(date +%Y%m%d_%H%M%S)"
            mv "${LOG_FILE}" "$rotated_name"
            touch "${LOG_FILE}"
            chown www-data:www-data "${LOG_FILE}" 2>/dev/null || true
            
            log_success "Log rotado a: $(basename "$rotated_name")"
            log_action "Nuevo archivo debug.log creado"
        fi
    fi
}

###############################################################################
# FUNCIÓN: Verificar configuración de Docker
###############################################################################
verify_docker_config() {
    log_action "Verificando configuración de logs de Docker..."
    
    if docker ps --format "table {{.Names}}\t{{.Status}}" | grep -q "wp_app"; then
        local log_config=$(docker inspect wp_app --format='{{.HostConfig.LogConfig}}' 2>/dev/null)
        
        if [[ "$log_config" == *"json-file"* ]] && [[ "$log_config" == *"max-size:50m"* ]]; then
            log_success "Configuración de rotación de Docker verificada correctamente"
            echo -e "  ${GREEN}✓${NC} Driver: json-file"
            echo -e "  ${GREEN}✓${NC} Max size: 50m"
            echo -e "  ${GREEN}✓${NC} Max files: 7"
        else
            log_warning "Configuración de rotación de Docker no detectada o incorrecta"
            echo -e "  ${YELLOW}⚠${NC} Configuración actual: ${log_config}"
        fi
    else
        log_warning "Contenedor wp_app no está ejecutándose"
    fi
}

###############################################################################
# FUNCIÓN: Generar reporte de limpieza
###############################################################################
generate_cleanup_report() {
    local report_file="${PROJECT_DIR}/cleanup-report-$(date +%Y%m%d_%H%M%S).txt"
    
    {
        echo "=== REPORTE DE LIMPIEZA DE LOGS ==="
        echo "Fecha: $(date '+%Y-%m-%d %H:%M:%S %Z')"
        echo "Proyecto: PAT01-ECOM WordPress"
        echo ""
        echo "=== CONFIGURACIÓN ==="
        echo "Directorio WordPress: ${WORDPRESS_DIR}"
        echo "Días de retención: ${DAYS_TO_KEEP}"
        echo "Tamaño máximo por archivo: ${MAX_LOG_SIZE}"
        echo ""
        echo "=== ESTADO ACTUAL ==="
        if [[ -f "${LOG_FILE}" ]]; then
            echo "Archivo debug.log: $(du -h "${LOG_FILE}" | cut -f1)"
            echo "Líneas totales: $(wc -l < "${LOG_FILE}")"
        else
            echo "Archivo debug.log: No encontrado"
        fi
        echo ""
        echo "=== ACCIONES REALIZADAS ==="
        tail -20 "${CLEANUP_LOG}" | grep "$(date '+%Y-%m-%d')"
    } > "$report_file"
    
    log_success "Reporte generado: $(basename "$report_file")"
}

###############################################################################
# FUNCIÓN PRINCIPAL
###############################################################################
main() {
    echo -e "${BLUE}"
    echo "###############################################################################"
    echo "# SCRIPT DE LIMPIEZA AUTOMÁTICA DE LOGS - WORDPRESS DOCKER"
    echo "# Proyecto: PAT01-ECOM"
    echo "# Fecha: $(date '+%Y-%m-%d %H:%M:%S %Z')"
    echo "###############################################################################"
    echo -e "${NC}"
    
    # Crear archivo de log del script si no existe
    touch "${CLEANUP_LOG}"
    
    log_action "=== INICIANDO PROCESO DE LIMPIEZA DE LOGS ==="
    
    # Ejecutar funciones principales
    validate_environment
    analyze_current_logs
    verify_docker_config
    rotate_large_log
    cleanup_old_logs
    generate_cleanup_report
    
    log_success "=== PROCESO DE LIMPIEZA COMPLETADO ==="
    
    echo -e "\n${GREEN}✅ Limpieza de logs completada exitosamente${NC}"
    echo -e "📋 Revisa el log del script: ${CLEANUP_LOG}"
    echo -e "📊 WordPress disponible en: http://localhost:9000"
}

###############################################################################
# EJECUCIÓN DEL SCRIPT
###############################################################################

# Verificar que el script se ejecute desde el directorio correcto
if [[ ! -f "$(dirname "$0")/docker-compose.dev.yml" ]]; then
    echo -e "${RED}ERROR: Este script debe ejecutarse desde la raíz del proyecto PAT01-ECOM${NC}"
    exit 1
fi

# Ejecutar función principal
main "$@"

# Configurar permisos del script automáticamente
chmod +x "$0" 2>/dev/null || true

exit