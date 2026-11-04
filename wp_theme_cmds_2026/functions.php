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
        '2026.1.4'
    );
}
add_action('wp_enqueue_scripts', 'cmds_2026_enqueue_assets', 999);

/**
 * Optimización de Velocidad 2026:
 * Desencolar hojas de estilo y scripts pesados heredados del tema padre (Edugrade)
 * y de plugins antiguos que ralentizan la carga en el navegador.
 */
function cmds_2026_optimize_frontend_assets() {
    if (is_admin()) {
        return;
    }

    global $wp_styles, $wp_scripts;

    // Patrones de URLs de CSS heredados que siempre se deben remover en el frontend 2026
    $always_remove_css_patterns = [
        '/themes/edugrade/',
        '/plugins/gramotech-core/',
        '/plugins/revslider/',
        '/plugins/essential-grid/',
        '/plugins/modern-events-calendar-lite/',
        '/plugins/events-manager/',
        '/plugins/instagram-feed/',
        '/plugins/sassy-social-share/',
        'family=Montserrat',
        'family=Poppins',
        'family=Roboto',
    ];

    // En la portada 2026 tampoco se requieren estilos de Elementor, Unyson, WPDM ni CF7
    $frontpage_remove_css_patterns = [
        '/plugins/elementor/',
        '/uploads/elementor/',
        '/plugins/unyson/',
        '/plugins/download-manager/',
        '/plugins/wpdm-gutenberg-blocks/',
        '/plugins/contact-form-7/',
        '/plugins/responsive-accordion-and-collapse/',
        '/wp-includes/css/dashicons',
        '/wp-includes/css/dist/block-library/',
    ];

    if (isset($wp_styles->registered) && is_array($wp_styles->registered)) {
        foreach ($wp_styles->registered as $handle => $style_obj) {
            if ($handle === 'cmds-2026-main-style' || $handle === 'cmds-2026-google-fonts' || $handle === 'admin-bar') {
                continue;
            }
            $src = isset($style_obj->src) ? (string) $style_obj->src : '';
            foreach ($always_remove_css_patterns as $pat) {
                if (strpos($src, $pat) !== false) {
                    wp_dequeue_style($handle);
                    wp_deregister_style($handle);
                    continue 2;
                }
            }
            if (is_front_page()) {
                foreach ($frontpage_remove_css_patterns as $pat) {
                    if (strpos($src, $pat) !== false) {
                        wp_dequeue_style($handle);
                        wp_deregister_style($handle);
                        continue 2;
                    }
                }
            }
        }
    }

    // Patrones de JS heredados que no se usan en el diseño 2026
    $always_remove_js_patterns = [
        '/themes/edugrade/',
        '/plugins/revslider/',
        '/plugins/essential-grid/',
        '/plugins/modern-events-calendar-lite/',
        '/plugins/events-manager/',
        '/plugins/sassy-social-share/',
        'wp-embed.min.js',
    ];

    $frontpage_remove_js_patterns = [
        '/plugins/download-manager/',
        '/plugins/contact-form-7/',
        '/plugins/responsive-accordion-and-collapse/',
        '/plugins/elementor/',
        '/wp-includes/js/jquery/',
        '/wp-includes/js/dist/',
        '/wp-includes/js/imagesloaded',
        '/wp-includes/js/masonry',
    ];

    if (isset($wp_scripts->registered) && is_array($wp_scripts->registered)) {
        foreach ($wp_scripts->registered as $handle => $script_obj) {
            if ($handle === 'admin-bar') {
                continue;
            }
            $src = isset($script_obj->src) ? (string) $script_obj->src : '';
            foreach ($always_remove_js_patterns as $pat) {
                if (strpos($src, $pat) !== false) {
                    wp_dequeue_script($handle);
                    wp_deregister_script($handle);
                    continue 2;
                }
            }
            if (is_front_page()) {
                foreach ($frontpage_remove_js_patterns as $pat) {
                    if (strpos($src, $pat) !== false) {
                        wp_dequeue_script($handle);
                        wp_deregister_script($handle);
                        continue 2;
                    }
                }
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'cmds_2026_optimize_frontend_assets', 9999);
add_action('wp_print_styles', 'cmds_2026_optimize_frontend_assets', 9999);
add_action('wp_print_scripts', 'cmds_2026_optimize_frontend_assets', 9999);
add_action('wp_print_footer_scripts', 'cmds_2026_optimize_frontend_assets', 9);

/**
 * Limpiar scripts innecesarios del head de WordPress (Emojis, oEmbed, RSD, WLW)
 */
function cmds_2026_clean_wp_head() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'cmds_2026_clean_wp_head');

/**
 * Permitir caché rápida en páginas públicas para visitantes no autenticados
 */
function cmds_2026_enable_public_cache_headers() {
    if (!is_admin() && !is_user_logged_in() && $_SERVER['REQUEST_METHOD'] === 'GET') {
        header_remove('Pragma');
        header_remove('Expires');
        header('Cache-Control: public, max-age=300, s-maxage=1800');
        header('X-LiteSpeed-Cache-Control: public, max-age=1800');
    }
}
add_action('send_headers', 'cmds_2026_enable_public_cache_headers', 999);
add_action('template_redirect', 'cmds_2026_enable_public_cache_headers', 999);

/**
 * Obtener catálogo actualizado de videos del Canal Oficial de YouTube de CMDS Antofagasta
 * Canal: @cmdsantofagasta3334 (ID: UC75MqC6uZAX6X5Gqe_d6mgw)
 */
function cmds_2026_get_youtube_channel_videos() {
    $transient_key = 'cmds_2026_yt_videos_v1';
    $cached = get_transient($transient_key);
    if (is_array($cached) && !empty($cached)) {
        return $cached;
    }

    $channel_id = 'UC75MqC6uZAX6X5Gqe_d6mgw';
    $feed_url   = 'https://www.youtube.com/feeds/videos.xml?channel_id=' . $channel_id;
    $videos     = [];

    $response = wp_remote_get($feed_url, [
        'timeout'   => 3,
        'sslverify' => false,
    ]);

    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        $xml_body = wp_remote_retrieve_body($response);
        if (preg_match_all('/<entry>.*?<yt:videoId>([^<]+)<\/yt:videoId>.*?<title>([^<]+)<\/title>.*?<published>([^<]+)<\/published>.*?<\/entry>/s', $xml_body, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $m) {
                $vid_id = trim($m[1]);
                $title  = html_entity_decode(trim($m[2]), ENT_QUOTES, 'UTF-8');
                $date   = date_i18n('d M Y', strtotime($m[3]));
                $videos[] = [
                    'id'    => $vid_id,
                    'title' => $title,
                    'date'  => $date,
                    'thumb' => 'https://i.ytimg.com/vi/' . $vid_id . '/hqdefault.jpg',
                ];
            }
        }
    }

    // Catálogo de respaldo oficial del canal @cmdsantofagasta3334
    if (empty($videos)) {
        $fallback = [
            ['id' => '0oco1PTMEOA', 'title' => 'Iniciamos el Mes de los Niños junto a Perlita', 'date' => 'Canal CMDS'],
            ['id' => 'qnF-tEHd1ZA', 'title' => 'Segunda Jornada Triatlón Antofagasta 2026', 'date' => 'Canal CMDS'],
            ['id' => 'q7G9rsuz5XU', 'title' => 'Segunda Jornada Triatlón Antofagasta 2026 · Parte 2', 'date' => 'Canal CMDS'],
            ['id' => 'ZTqFREI6MnM', 'title' => 'Triatlón Antofagasta 2026 · Cobertura Especial', 'date' => 'Canal CMDS'],
            ['id' => 'eGF_L_g2Y2M', 'title' => 'Deporte y Comunidad · Triatlón Antofagasta 2026', 'date' => 'Canal CMDS'],
            ['id' => '_RnR5w5dhjE', 'title' => 'Jornada Deportiva Triatlón Antofagasta 2026', 'date' => 'Canal CMDS'],
            ['id' => 'DHJFx2ojeAM', 'title' => 'Himno Oficial de Antofagasta · CMDS', 'date' => 'Canal CMDS'],
            ['id' => 'ZaWaxug6fi8', 'title' => 'Himno Nacional de Chile · Antofagasta', 'date' => 'Canal CMDS'],
            ['id' => 'WIGWl7-6yBc', 'title' => 'Festival de Antofagasta 2026 · Jornada Viernes', 'date' => 'Canal CMDS'],
            ['id' => 'BL80j3_rJrE', 'title' => 'Festival de Antofagasta 2026 · Jornada Jueves', 'date' => 'Canal CMDS'],
            ['id' => 'JabMR7fux1Q', 'title' => 'Festival de Antofagasta 2026 · Jornada Inaugural', 'date' => 'Canal CMDS'],
            ['id' => 'q-mpO36KPjM', 'title' => 'Resumen de Gestión Institucional CMDS', 'date' => 'Canal CMDS'],
            ['id' => 'J1A8e8veuMM', 'title' => 'Campaña Educación Ambiental: Reciclar es Re Simple', 'date' => 'Canal CMDS'],
        ];
        foreach ($fallback as $item) {
            $item['thumb'] = 'https://i.ytimg.com/vi/' . $item['id'] . '/hqdefault.jpg';
            $videos[] = $item;
        }
    }

    set_transient($transient_key, $videos, 2 * HOUR_IN_SECONDS);
    return $videos;
}

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
