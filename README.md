# Portal Web Institucional — CMDS Antofagasta 2026

Repositorio oficial de rediseño y modernización del portal web de la **Corporación Municipal de Desarrollo Social de Antofagasta (`www.cmds.cl`)**, desarrollado bajo los lineamientos del **Manual de Normas Gráficas CMDS 2026** y optimizado para **WordPress + Elementor**.

---

## 📁 Estructura del Repositorio

```text
sitio-web-cmds-2026/
├── wp_theme_cmds_2026/        # Tema oficial de WordPress (cmds-2026)
│   ├── assets/                # Logotipos 2026, co-branding municipal, favicon y trama institucional
│   ├── style.css              # Sistema de diseño 2026, variables CSS y estilos para Elementor
│   ├── functions.php          # Encolado de fuentes/estilos y clasificación automática de áreas
│   ├── header.php             # Topbar institucional, franja multicolor y menú principal desplegable
│   ├── footer.php             # Pie de página oficial, campaña de convivencia y contactos
│   ├── front-page.php         # Portada 2026 optimizada con consulta dinámica WP_Query
│   ├── page.php               # Plantilla maestra para páginas interiores y archivo de noticias
│   ├── single.php             # Plantilla de lectura de noticias individuales
│   └── index.php              # Plantilla de respaldo para archivos y búsquedas
├── prototipo_2026/            # Maqueta interactiva estática (HTML5/CSS3/JS)
│   ├── assets/                # Recursos gráficos optimizados
│   └── index.html             # Vista interactiva de validación local
└── NORMAS GRAFICAS 2026/      # Manual de Normas Gráficas, aplicación de logo y plantillas 2026
```

---

## 🎨 Paleta de Colores Oficial 2026

| Color | Código HEX | Uso en el Portal |
| :--- | :--- | :--- |
| **Azul Corporativo** | `#006098` | Identidad institucional principal, cabeceras, títulos, tarjetas y pie de página |
| **Turquesa / Calipso** | `#44babe` | Área de **Atención Primaria de Salud (APS)**, CESFAM, CECOSF y acentos interactivos |
| **Amarillo / Ámbar** | `#f7a516` | Área de **Educación Pública Municipal**, niveles educativos, PIE y admisión |
| **Rosa / Magenta** | `#eb567e` | Llamados a la acción prioritarios (**Hora Salud en Línea**), lema oficial y **Transparencia** |

* **Lema Institucional:** *"Educación que transforma, salud que protege"*
* **Campaña Institucional:** *"Construyamos espacios seguros: cero violencia, 100% respeto"*

---

## 🚀 Mejoras Técnicas Implementadas

1. **Optimización de Rendimiento en Portada (-92,5% en tamaño HTML):**
   * Se reemplazó la consulta sin límite del tema anterior (que cargaba 6 años de noticias en la portada con un documento HTML de `1,55 MB`) por una consulta optimizada (`WP_Query` de 9 publicaciones recientes), reduciendo el HTML inicial a `~117 KB`.
2. **Centro de Servicios Digitales en HTML/CSS:**
   * Los antiguos botones en imagen (`.png`/`.jpg` de 2019–2025) fueron reemplazados por tarjetas vectoriales accesibles, responsivas y filtrables por área (*Comunidad y Salud*, *Educación*, *Funcionarios y Soporte*, *Transparencia y Empleo*).
3. **Páginas Interiores Unificadas (`page.php`):**
   * Cabecera interior dinámica codificada por color según el área institucional (*Corporación*, *Salud APS*, *Educación*, *Transparencia*) con barra de navegación rápida entre páginas hermanas y actualización cromática de bloques de Elementor.

---

## 🛠️ Instalación / Despliegue del Tema en WordPress

1. Copiar el contenido de la carpeta `wp_theme_cmds_2026/` dentro de `/wp-content/themes/cmds-2026/` en la instalación de WordPress.
2. En el panel de administración (`/wp-admin` → **Apariencia → Temas**), activar el tema **CMDS Antofagasta 2026 (Oficial)**.
