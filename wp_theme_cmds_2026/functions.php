<?php
/**
 * Funciones del Tema Institucional CMDS Antofagasta 2026
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Encolar fuentes y hoja de estilos principal 2026 con alta prioridad
 */
function cmds_2026_enqueue_assets() {
    wp_enqueue_style(
        'cmds-2026-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:ital,wght@0,600;0,700;0,800;1,600;1,700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'cmds-2026-main-style',
        get_stylesheet_directory_uri() . '/style.css',
        ['cmds-2026-google-fonts'],
        '2026.1.3'
    );
}
add_action('wp_enqueue_scripts', 'cmds_2026_enqueue_assets', 999);

/**
 * Agregar clase institucional al body
 */
function cmds_2026_body_classes($classes) {
    $classes[] = 'cmds-2026-body';
    return $classes;
}
add_filter('body_class', 'cmds_2026_body_classes');

/**
 * En el entorno de Staging (/portal2026), reescribir enlaces internos absolutos
 * en el contenido de páginas/posts (pero NO imágenes de wp-content/uploads)
 * para que la navegación se mantenga dentro de /portal2026/
 */
function cmds_2026_rewrite_staging_content_links($content) {
    $home = rtrim(home_url(), '/');
    if (strpos($home, '/portal2026') !== false) {
        $content = preg_replace_callback(
            '/href=(["\'])https?:\/\/(www\.)?cmds\.cl\/([^"\']*)\1/i',
            function ($m) use ($home) {
                $path = $m[3];
                if (strpos($path, 'wp-content/uploads/') === 0) {
                    return $m[0];
                }
                return 'href=' . $m[1] . $home . '/' . ltrim($path, '/') . $m[1];
            },
            $content
        );
    }
    return $content;
}
add_filter('the_content', 'cmds_2026_rewrite_staging_content_links', 99);

/**
 * Clasificación automática de páginas interiores por Área Institucional 2026
 */
function cmds_2026_get_page_section_info($post_name) {
    $corporacion = [
        'somos'                => 'Somos CMDS',
        'directorio'           => 'Directorio',
        'presidencia-2'        => 'Presidencia',
        'secretaria-ejecutiva' => 'Secretaría Ejecutiva',
        'direccion-de-obras-2' => 'Adm. y Finanzas',
        'direccion-de-salud'   => 'Dirección de Salud',
        'direccion-de-educacion' => 'Dirección de Educación',
        'direccion-de-obras'   => 'Obras y Planificación',
        'direccion-rrhh'       => 'Dirección RRHH',
        'memoria'              => 'Memoria Anual',
        'reglamento-interno'   => 'Reglamento Interno',
    ];

    $salud = [
        'direccion-de-salud'          => 'Dirección de Salud',
        'cesfam-centro-sur'           => 'CESFAM Centro Sur',
        'cesfam-maria-cristina-rojas' => 'CESFAM M. Cristina Rojas',
        'cesfam-corvallis'            => 'CESFAM Corvallis',
        'cesfam-central-oriente'      => 'CESFAM Central Oriente',
        'cesfam-norte'                => 'CESFAM Norte',
        'cesfam-rendic'               => 'CESFAM Dr. A. Rendic',
        'cesfam-juan-pablo-ii'        => 'CESFAM Juan Pablo II',
        'cesfam-valdivieso'           => 'CESFAM Valdivieso',
        'cecosf-la-chimba'            => 'CECOSF La Chimba',
        'cecosf-coviefi'              => 'CECOSF Coviefi',
        'sar-coviefi'                 => 'SAR Coviefi',
        'central-de-servicios'        => 'Lab. Sarita Núñez',
        'plan-comunal'                => 'Plan Comunal de Salud',
    ];

    $educacion = [
        'direccion-de-educacion'          => 'Dirección de Educación',
        'educacion-parvularia'            => 'Educación Parvularia',
        'educacion-basica'                => 'Educación Básica',
        'educacion-media'                 => 'Educación Media',
        'programa-de-integracion-escolar' => 'Programa PIE',
        'departamento-psicosocial'        => 'Depto. Psicosocial',
        'departamento-extraescolar'       => 'Depto. Extraescolar',
        'plan-comunal-2'                  => 'PADEM',
        'cmds-educa-lcd'                  => 'CMDS Educa LCD',
        'postulacion-educacion-parvularia-cmds-2027' => 'Admisión Parvularia 2027',
    ];

    $transparencia = [
        'trabaja-con-nosotros'          => 'Trabaja con Nosotros',
        'propuestas-publicas-salud'     => 'Licitaciones Salud',
        'propuestas-publicas-educacion' => 'Licitaciones Educación',
        'transparencia-activa-cmds'     => 'Transparencia Activa',
        'plataforma-lobby'              => 'Ley del Lobby',
        'directorio-telefonico'         => 'Directorio Telefónico',
        'contacto'                      => 'Contacto Oficial',
    ];

    if (isset($salud[$post_name]) && $post_name !== 'direccion-de-salud') {
        return [
            'area_class' => 'area-salud',
            'area_name'  => 'Atención Primaria de Salud · APS',
            'siblings'   => $salud,
        ];
    }
    if (isset($educacion[$post_name]) && $post_name !== 'direccion-de-educacion') {
        return [
            'area_class' => 'area-educacion',
            'area_name'  => 'Educación Pública Municipal',
            'siblings'   => $educacion,
        ];
    }
    if (isset($corporacion[$post_name])) {
        return [
            'area_class' => 'area-corporacion',
            'area_name'  => 'Institucional · Corporación CMDS',
            'siblings'   => $corporacion,
        ];
    }
    if (isset($transparencia[$post_name]) || strpos($post_name, 'transparencia') !== false) {
        return [
            'area_class' => 'area-transparencia',
            'area_name'  => 'Transparencia, Concursos y Atención Ciudadana',
            'siblings'   => $transparencia,
        ];
    }

    return [
        'area_class' => 'area-corporacion',
        'area_name'  => 'Corporación Municipal de Desarrollo Social',
        'siblings'   => $corporacion,
    ];
}
