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
        '2026.3.0'
    );
}
add_action('wp_enqueue_scripts', 'cmds_2026_enqueue_assets', 999);

/**
 * Ocultar la barra de herramientas superior de WordPress en la vista pública del portal
 * para que al estar conectado como administrador no desplace ni ensucie la cabecera 2026.
 */
add_filter('show_admin_bar', '__return_false');

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
        '/wp-includes/css/dist/block-library/',
    ];

    $protected_styles = [
        'cmds-2026-main-style',
        'cmds-2026-google-fonts',
        'admin-bar',
        'dashicons',
    ];

    if (isset($wp_styles->registered) && is_array($wp_styles->registered)) {
        foreach ($wp_styles->registered as $handle => $style_obj) {
            if (in_array($handle, $protected_styles, true)) {
                continue;
            }
            $src = isset($style_obj->src) ? (string) $style_obj->src : '';
            foreach ($always_remove_css_patterns as $pat) {
                if (strpos($src, $pat) !== false) {
                    wp_dequeue_style($handle);
                    continue 2;
                }
            }
            if (is_front_page()) {
                foreach ($frontpage_remove_css_patterns as $pat) {
                    if (strpos($src, $pat) !== false) {
                        wp_dequeue_style($handle);
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
        '/wp-includes/js/dist/',
        '/wp-includes/js/imagesloaded',
        '/wp-includes/js/masonry',
    ];

    $protected_scripts = [
        'admin-bar',
        'jquery',
        'jquery-core',
        'jquery-migrate',
    ];

    if (isset($wp_scripts->registered) && is_array($wp_scripts->registered)) {
        foreach ($wp_scripts->registered as $handle => $script_obj) {
            if (in_array($handle, $protected_scripts, true)) {
                continue;
            }
            $src = isset($script_obj->src) ? (string) $script_obj->src : '';
            foreach ($always_remove_js_patterns as $pat) {
                if (strpos($src, $pat) !== false) {
                    wp_dequeue_script($handle);
                    continue 2;
                }
            }
            if (is_front_page()) {
                foreach ($frontpage_remove_js_patterns as $pat) {
                    if (strpos($src, $pat) !== false) {
                        wp_dequeue_script($handle);
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
 * Configuración de CMDS TV (YouTube): Canal Recientes vs Lista de Reproducción (Playlist)
 */
function cmds_2026_get_tv_settings() {
    $defaults = [
        'source_type' => 'channel', // 'channel' | 'playlist'
        'channel_id'  => 'UC75MqC6uZAX6X5Gqe_d6mgw',
        'playlist_id' => '',
        'max_videos'  => 8,
        'play_mode'   => 'recent', // 'recent' | 'random'
    ];
    $saved = get_option('cmds_2026_tv_settings', []);
    if (!is_array($saved)) {
        $saved = [];
    }
    return array_merge($defaults, $saved);
}

/**
 * Extraer ID limpio de una Lista de Reproducción de YouTube desde URL o texto
 */
function cmds_2026_parse_playlist_id($input) {
    $input = trim((string) $input);
    if (empty($input)) {
        return '';
    }
    if (preg_match('/[?&]list=([a-zA-Z0-9_-]+)/', $input, $m)) {
        return $m[1];
    }
    return preg_replace('/[^a-zA-Z0-9_-]/', '', $input);
}

/**
 * Limpiar caché rápida de páginas del portal 2026 al actualizar contenidos o ajustes
 */
function cmds_2026_flush_page_cache() {
    $dirs = [
        ABSPATH . 'wp-content/cache/cmds-2026',
        ABSPATH . 'wp-content/uploads/cmds-cache-2026',
    ];
    foreach ($dirs as $cache_dir) {
        if (is_dir($cache_dir)) {
            foreach ((array) glob($cache_dir . '/*.html') as $f) {
                if (is_file($f)) {
                    @unlink($f);
                }
            }
        }
    }
}
add_action('save_post', 'cmds_2026_flush_page_cache');
add_action('deleted_post', 'cmds_2026_flush_page_cache');
add_action('switch_theme', 'cmds_2026_flush_page_cache');

/**
 * Obtener catálogo actualizado de videos de CMDS TV (Canal Oficial o Playlist Predefinida)
 * Canal Oficial: @cmdsantofagasta3334 (ID: UC75MqC6uZAX6X5Gqe_d6mgw)
 */
function cmds_2026_get_youtube_channel_videos() {
    $settings      = cmds_2026_get_tv_settings();
    $source_type   = $settings['source_type'];
    $channel_id    = !empty($settings['channel_id']) ? $settings['channel_id'] : 'UC75MqC6uZAX6X5Gqe_d6mgw';
    $playlist_id   = cmds_2026_parse_playlist_id($settings['playlist_id']);
    $max_videos    = max(1, min(15, (int) $settings['max_videos']));

    $transient_key = 'cmds_2026_yt_v2_' . md5($source_type . '|' . $channel_id . '|' . $playlist_id . '|' . $max_videos);
    $cached        = get_transient($transient_key);
    if (is_array($cached) && !empty($cached)) {
        return $cached;
    }

    if ($source_type === 'playlist' && !empty($playlist_id)) {
        $feed_url = 'https://www.youtube.com/feeds/videos.xml?playlist_id=' . urlencode($playlist_id);
    } else {
        $feed_url = 'https://www.youtube.com/feeds/videos.xml?channel_id=' . urlencode($channel_id);
    }

    $videos   = [];
    $response = wp_remote_get($feed_url, [
        'timeout'   => 4,
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
            ['id' => '0oco1PTMEOA', 'title' => 'Iniciamos el Mes de los Niños junto a Perlita', 'date' => 'Reciente · CMDS'],
            ['id' => 'qnF-tEHd1ZA', 'title' => 'Segunda Jornada Triatlón Antofagasta 2026', 'date' => 'Reciente · CMDS'],
            ['id' => 'q7G9rsuz5XU', 'title' => 'Segunda Jornada Triatlón Antofagasta 2026 · Parte 2', 'date' => 'Reciente · CMDS'],
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

    $videos = array_slice($videos, 0, $max_videos);
    set_transient($transient_key, $videos, 2 * HOUR_IN_SECONDS);
    return $videos;
}

/**
 * Panel de Administración en WordPress: "CMDS TV (YouTube)"
 */
function cmds_2026_register_tv_admin_menu() {
    add_menu_page(
        'CMDS TV · Canal YouTube',
        'CMDS TV (YouTube)',
        'manage_options',
        'cmds-tv-youtube',
        'cmds_2026_render_tv_admin_page',
        'dashicons-video-alt3',
        25
    );
}
add_action('admin_menu', 'cmds_2026_register_tv_admin_menu');

function cmds_2026_render_tv_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $notice = '';
    if (isset($_POST['cmds_tv_save_nonce']) && wp_verify_nonce($_POST['cmds_tv_save_nonce'], 'cmds_tv_save_action')) {
        $new_settings = [
            'source_type' => (isset($_POST['source_type']) && $_POST['source_type'] === 'playlist') ? 'playlist' : 'channel',
            'channel_id'  => sanitize_text_field($_POST['channel_id'] ?? 'UC75MqC6uZAX6X5Gqe_d6mgw'),
            'playlist_id' => cmds_2026_parse_playlist_id($_POST['playlist_id'] ?? ''),
            'max_videos'  => max(1, min(15, (int) ($_POST['max_videos'] ?? 8))),
            'play_mode'   => (isset($_POST['play_mode']) && $_POST['play_mode'] === 'random') ? 'random' : 'recent',
        ];
        update_option('cmds_2026_tv_settings', $new_settings);
        cmds_2026_flush_page_cache();
        $notice = 'Ajustes guardados y caché de portada actualizada correctamente.';
    }

    $s      = cmds_2026_get_tv_settings();
    $videos = cmds_2026_get_youtube_channel_videos();
    ?>
    <div class="wrap" style="max-width:920px;">
      <h1 style="display:flex;align-items:center;gap:10px;color:#006098;font-weight:800;">
        <span class="dashicons dashicons-video-alt3" style="font-size:28px;width:28px;height:28px;color:#eb567e;"></span>
        CMDS TV · Configuración del Canal de YouTube en Portada
      </h1>
      <p style="font-size:14px;color:#475569;">
        Desde este panel puedes elegir si el reproductor del portal muestra los <strong>videos más recientes subidos al canal oficial de CMDS</strong> o una <strong>Lista de Reproducción (Playlist) específica</strong> creada en YouTube, así como el orden inicial de reproducción.
      </p>

      <?php if ($notice) : ?>
        <div class="notice notice-success is-dismissible"><p><strong><?php echo esc_html($notice); ?></strong></p></div>
      <?php endif; ?>

      <form method="post" style="background:#fff;padding:24px 28px;border-radius:12px;border:1px solid #cbd5e1;box-shadow:0 4px 14px rgba(0,0,0,0.05);margin-top:16px;">
        <?php wp_nonce_field('cmds_tv_save_action', 'cmds_tv_save_nonce'); ?>

        <table class="form-table" role="presentation">
          <tr>
            <th scope="row"><label>1. Origen de los Videos</label></th>
            <td>
              <label style="display:block;margin-bottom:10px;font-weight:600;">
                <input type="radio" name="source_type" value="channel" <?php checked($s['source_type'], 'channel'); ?> />
                🕒 <strong>Videos más recientes del Canal Oficial CMDS</strong> (Automático al subir un video al canal)
              </label>
              <label style="display:block;font-weight:600;">
                <input type="radio" name="source_type" value="playlist" <?php checked($s['source_type'], 'playlist'); ?> />
                📋 <strong>Lista de Reproducción predefinida (Playlist de YouTube)</strong> (Solo reproduce los videos de esa lista)
              </label>
            </td>
          </tr>

          <tr>
            <th scope="row"><label for="playlist_id">2. URL o ID de Lista de Reproducción (Playlist)</label></th>
            <td>
              <input type="text" id="playlist_id" name="playlist_id" value="<?php echo esc_attr($s['playlist_id']); ?>" class="regular-text" style="width:100%;max-width:520px;" placeholder="Ej: https://www.youtube.com/playlist?list=PLxxxxxxxx o PLxxxxxxxx" />
              <p class="description">Si seleccionaste "Lista de Reproducción predefinida", pega aquí el enlace o código <code>PL...</code> de la lista creada en YouTube.</p>
            </td>
          </tr>

          <tr>
            <th scope="row"><label for="max_videos">3. Cantidad de Videos Recientes a Incluir</label></th>
            <td>
              <select id="max_videos" name="max_videos">
                <?php foreach ([3, 5, 6, 8, 10, 12, 15] as $num) : ?>
                  <option value="<?php echo (int) $num; ?>" <?php selected((int) $s['max_videos'], $num); ?>>
                    Últimos <?php echo (int) $num; ?> videos más recientes
                  </option>
                <?php endforeach; ?>
              </select>
              <p class="description">Limita la rotación únicamente a los videos más nuevos para mantener siempre contenido vigente en la portada.</p>
            </td>
          </tr>

          <tr>
            <th scope="row"><label>4. Modo de Reproducción al Iniciar</label></th>
            <td>
              <label style="display:block;margin-bottom:10px;font-weight:600;">
                <input type="radio" name="play_mode" value="recent" <?php checked($s['play_mode'], 'recent'); ?> />
                🕒 <strong>Más recientes primero (Recomendado):</strong> Inicia siempre con el último video publicado y avanza en orden de estreno (el visitante también puede cambiar a modo aleatorio con un clic).
              </label>
              <label style="display:block;font-weight:600;">
                <input type="radio" name="play_mode" value="random" <?php checked($s['play_mode'], 'random'); ?> />
                🔀 <strong>Aleatorio (Shuffle):</strong> Mezcla al azar el lote de videos seleccionados en cada visita.
              </label>
            </td>
          </tr>

          <tr>
            <th scope="row"><label for="channel_id">ID del Canal Oficial YouTube</label></th>
            <td>
              <input type="text" id="channel_id" name="channel_id" value="<?php echo esc_attr($s['channel_id']); ?>" class="regular-text" />
              <p class="description">Por defecto: <code>UC75MqC6uZAX6X5Gqe_d6mgw</code> (Canal <strong>@cmdsantofagasta3334</strong>).</p>
            </td>
          </tr>
        </table>

        <p class="submit" style="margin-bottom:0;">
          <button type="submit" class="button button-primary button-hero" style="background:#006098;border-color:#004670;">
            💾 Guardar Configuración y Actualizar Portada
          </button>
        </p>
      </form>

      <div style="background:#f8fafc;padding:20px 24px;border-radius:12px;border:1px solid #e2e8f0;margin-top:20px;">
        <h3 style="margin-top:0;color:#0f172a;">📺 Vista previa de la cola activa (<?php echo count($videos); ?> videos detectados)</h3>
        <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(240px, 1fr));gap:12px;">
          <?php foreach ($videos as $idx => $v) : ?>
            <div style="background:#fff;border:1px solid #cbd5e1;border-radius:8px;padding:10px;display:flex;gap:10px;align-items:center;">
              <img src="<?php echo esc_url($v['thumb']); ?>" alt="" style="width:78px;height:46px;object-fit:cover;border-radius:6px;flex-shrink:0;" />
              <div style="min-width:0;">
                <div style="font-size:11px;font-weight:700;color:#006098;">#<?php echo (int) ($idx + 1); ?> · <?php echo esc_html($v['date']); ?></div>
                <div style="font-size:12px;font-weight:600;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="<?php echo esc_attr($v['title']); ?>">
                  <?php echo esc_html($v['title']); ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php
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

    // Marcar secciones internas de títulos con flechas antiguas (fa-angle-double-right)
    // para ocultar la columna de la flecha >> superpuesta y expandir el título al 100%
    if (strpos($content, 'fa-angle-double-right') !== false) {
        $content = preg_replace_callback(
            '/<section\b([^>]*\belementor-inner-section\b[^>]*)>(.*?)<\/section>/is',
            function ($m) {
                if (strpos($m[2], 'fa-angle-double-right') !== false) {
                    $attrs = preg_replace('/class=(["\'])/i', 'class=$1cmds-clean-heading-section ', $m[1], 1);
                    return '<section' . $attrs . '>' . $m[2] . '</section>';
                }
                return $m[0];
            },
            $content
        );
    }

    // Normalizar nombres y cargos en las tarjetas del Directorio para presentación uniforme
    if (strpos($content, 'eael-team-member') !== false) {
        $replacements = [
            'Sra. patricia lorca' => 'Sra. Patricia Lorca',
            'SrA. PAMELA PÉREZ'   => 'Sra. Pamela Pérez',
            'Sr. JOSÉ ANTONIO GONZÁLEZ' => 'Sr. José Antonio González',
            'Sr. JOSÉ ANTONIO DÍAZ'     => 'Sr. José Antonio Díaz',
            'PRESIDENTE DEL DIRECTORIO Y Alcalde de Antofagasta' => 'Presidente del Directorio y Alcalde',
        ];
        $content = strtr($content, $replacements);
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
