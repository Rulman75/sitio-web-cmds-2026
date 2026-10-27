<?php
/**
 * Portada Oficial CMDS Antofagasta 2026 (Dinámica con WP_Query optimizado)
 */
if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Consultar las 9 noticias más recientes (3 para Hero Slider + 6 para Grilla de Actualidad)
$recent_query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 9,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
]);

$hero_posts = [];
$grid_posts = [];
if ($recent_query->have_posts()) {
    $idx = 0;
    while ($recent_query->have_posts()) {
        $recent_query->the_post();
        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (!$thumb) {
            $thumb = 'https://www.cmds.cl/wp-content/uploads/2026/10/acredutacion-web-scaled.jpg';
        }
        // En staging, asegurar que las miniaturas antiguas carguen desde el dominio principal si están en uploads
        $cats = get_the_category();
        $cat_name = !empty($cats) ? $cats[0]->name : 'Actualidad CMDS';
        $badge_class = 'salud';
        if (stripos($cat_name, 'educa') !== false || stripos(get_the_title(), 'escuela') !== false || stripos(get_the_title(), 'liceo') !== false) {
            $badge_class = 'educacion';
        } elseif (stripos($cat_name, 'comun') !== false || stripos(get_the_title(), 'profesor') !== false) {
            $badge_class = 'comunidad';
        }
        $item = [
            'id'          => get_the_ID(),
            'title'       => get_the_title(),
            'permalink'   => get_permalink(),
            'date'        => get_the_date('j \d\e F, Y'),
            'excerpt'     => wp_trim_words(wp_strip_all_tags(get_the_content()), 24, '...'),
            'thumb'       => $thumb,
            'cat_name'    => $cat_name,
            'badge_class' => $badge_class,
        ];
        if ($idx < 3) {
            $hero_posts[] = $item;
        } else {
            $grid_posts[] = $item;
        }
        $idx++;
    }
    wp_reset_postdata();
}
?>

  <!-- SECCIÓN HERO: CARRUSEL DE HITOS + ACCESOS PRIORITARIOS -->
  <section class="hero-section">
    <div class="cmds-container hero-grid">

      <!-- Carrusel Principal Dinámico -->
      <div class="hero-slider-card" id="heroSlider">
        <?php foreach ($hero_posts as $s_idx => $slide) : ?>
        <article class="hero-slide <?php echo $s_idx === 0 ? 'active' : ''; ?>">
          <img src="<?php echo esc_url($slide['thumb']); ?>" alt="<?php echo esc_attr($slide['title']); ?>" class="hero-slide-img" />
          <div class="hero-slide-overlay"></div>
          <div class="hero-slide-content">
            <div class="slide-badges">
              <span class="badge-area <?php echo esc_attr($slide['badge_class']); ?>"><?php echo esc_html($slide['cat_name']); ?></span>
              <span class="slide-date">📅 <?php echo esc_html($slide['date']); ?></span>
            </div>
            <h2 class="hero-slide-title"><?php echo esc_html($slide['title']); ?></h2>
            <p class="hero-slide-desc"><?php echo esc_html($slide['excerpt']); ?></p>
            <div class="hero-slide-actions">
              <a href="<?php echo esc_url($slide['permalink']); ?>" class="btn-slide-read">Leer noticia completa →</a>
              <div class="slider-controls">
                <button type="button" class="slider-arrow" onclick="cmdsChangeSlide(-1)" aria-label="Anterior">‹</button>
                <?php foreach ($hero_posts as $d_idx => $_s) : ?>
                  <button type="button" class="slider-dot <?php echo $d_idx === $s_idx ? 'active' : ''; ?>" onclick="cmdsGoToSlide(<?php echo (int) $d_idx; ?>)"></button>
                <?php endforeach; ?>
                <button type="button" class="slider-arrow" onclick="cmdsChangeSlide(1)" aria-label="Siguiente">›</button>
              </div>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      </div>

      <!-- Accesos Directos Prioritarios -->
      <div class="hero-priority-col">
        <div class="priority-header">
          <h2>⚡ Accesos Destacados Comunidad</h2>
        </div>

        <a href="<?php echo esc_url(home_url('/postulacion-educacion-parvularia-cmds-2027/')); ?>" class="priority-card card-amber">
          <div class="priority-icon">🎒</div>
          <div class="priority-info">
            <span class="priority-tag">Proceso Admisión 2027</span>
            <div class="priority-title">Postulación Educación Parvularia CMDS</div>
            <div class="priority-sub">Inscripción abierta para las 4 escuelas de párvulos</div>
          </div>
          <div class="priority-arrow">→</div>
        </a>

        <a href="https://horasalud.cl/web/portal/" target="_blank" rel="noopener" class="priority-card card-teal">
          <div class="priority-icon">🩺</div>
          <div class="priority-info">
            <span class="priority-tag">Atención Primaria APS</span>
            <div class="priority-title">Reserva tu Hora de Salud en Línea</div>
            <div class="priority-sub">Portal HoraSalud para CESFAM de Antofagasta</div>
          </div>
          <div class="priority-arrow">→</div>
        </a>

        <a href="https://cmds-portaleduca.pad.cl:2443/login_ctrl/" target="_blank" rel="noopener" class="priority-card card-blue">
          <div class="priority-icon">🎓</div>
          <div class="priority-info">
            <span class="priority-tag">Comunidad Escolar</span>
            <div class="priority-title">Portal de Alumnos y Apoderados</div>
            <div class="priority-sub">Certificados, notas y seguimiento académico en línea</div>
          </div>
          <div class="priority-arrow">→</div>
        </a>

        <a href="https://www.cmds.cl/wp-content/uploads/2025/03/PROTOCOLO_DE_LA_PREVENCION_INVESTIGACION_YSANCION_DEL_ACOSO_LABORAL_SEXUAL_Y_VIOLENCIA_EN_EL_TRABAJO.pdf" target="_blank" rel="noopener" class="priority-card card-pink">
          <div class="priority-icon">🛡️</div>
          <div class="priority-info">
            <span class="priority-tag">Espacios Seguros · Normativa</span>
            <div class="priority-title">Protocolo Prevención Acoso Laboral y Violencia</div>
            <div class="priority-sub">Descarga directa del protocolo institucional vigente (PDF)</div>
          </div>
          <div class="priority-arrow">↓</div>
        </a>
      </div>

    </div>
  </section>

  <!-- HUB INTERACTIVO DE PORTALES Y SERVICIOS -->
  <section class="services-section" id="portales">
    <div class="cmds-container">
      <div class="section-header">
        <div>
          <span class="section-eyebrow">Plataformas y Trámites en Línea</span>
          <h2 class="section-title">Centro de Servicios Digitales CMDS</h2>
          <p class="section-subtitle">Todos los portales de educación, salud, funcionarios y transparencia unificados bajo la nueva identidad institucional 2026.</p>
        </div>

        <div class="service-tabs" role="tablist">
          <button type="button" class="service-tab active" onclick="cmdsFilterServices('all', this)">Todos (20)</button>
          <button type="button" class="service-tab" onclick="cmdsFilterServices('comunidad', this)">
            <span class="tab-dot" style="background:var(--cmds-teal)"></span> Comunidad y Salud
          </button>
          <button type="button" class="service-tab" onclick="cmdsFilterServices('educacion', this)">
            <span class="tab-dot" style="background:var(--cmds-amber)"></span> Educación
          </button>
          <button type="button" class="service-tab" onclick="cmdsFilterServices('funcionarios', this)">
            <span class="tab-dot" style="background:var(--cmds-blue)"></span> Funcionarios y Soporte
          </button>
          <button type="button" class="service-tab" onclick="cmdsFilterServices('transparencia', this)">
            <span class="tab-dot" style="background:var(--cmds-pink)"></span> Transparencia y Empleo
          </button>
        </div>
      </div>

      <div class="services-grid" id="servicesGrid">
        <a href="https://cmds-portaleduca.pad.cl:2443/login_ctrl/" target="_blank" rel="noopener" class="service-card" data-cat="educacion">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">👨‍👩‍👧‍👦</div>
              <span class="service-badge">Educación</span>
            </div>
            <h3>Portal Alumnos y Apoderados</h3>
            <p>Acceso a información escolar, asistencia y documentos para familias de establecimientos CMDS.</p>
          </div>
          <div class="service-card-footer"><span>Ingresar al portal</span><span>→</span></div>
        </a>

        <a href="https://cmds-portaleduca.pad.cl:2443/verificar_certificado/" target="_blank" rel="noopener" class="service-card" data-cat="educacion">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">📄</div>
              <span class="service-badge">Educación</span>
            </div>
            <h3>Verificación de Certificados</h3>
            <p>Valida en línea la autenticidad de certificados emitidos por el área de Educación CMDS.</p>
          </div>
          <div class="service-card-footer"><span>Verificar folio</span><span>→</span></div>
        </a>

        <a href="https://cmds.pad.cl:2443/login/" target="_blank" rel="noopener" class="service-card" data-cat="educacion">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">💻</div>
              <span class="service-badge">Educación</span>
            </div>
            <h3>Plataforma CMDS Educa</h3>
            <p>Sistema de gestión educativa y recursos pedagógicos para docentes y unidades educativas.</p>
          </div>
          <div class="service-card-footer"><span>Acceder a plataforma</span><span>→</span></div>
        </a>

        <a href="<?php echo esc_url(home_url('/cmds-educa-lcd/')); ?>" class="service-card" data-cat="educacion">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">🎬</div>
              <span class="service-badge">Educación</span>
            </div>
            <h3>CMDS Educa LCD / Videos</h3>
            <p>Cápsulas audiovisuales, Libro de Clases Digital y material pedagógico comunal.</p>
          </div>
          <div class="service-card-footer"><span>Ver contenidos</span><span>→</span></div>
        </a>

        <a href="https://horasalud.cl/web/portal/" target="_blank" rel="noopener" class="service-card" data-cat="comunidad">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">🩺</div>
              <span class="service-badge">Salud APS</span>
            </div>
            <h3>Reserva de Hora Salud</h3>
            <p>Agenda horas médicas y controles en los Centros de Salud Familiar (CESFAM) de la red.</p>
          </div>
          <div class="service-card-footer"><span>Ir a HoraSalud.cl</span><span>→</span></div>
        </a>

        <a href="http://salud.cmds.cl/" target="_blank" rel="noopener" class="service-card" data-cat="comunidad">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">🏥</div>
              <span class="service-badge">Salud APS</span>
            </div>
            <h3>Intranet Salud CMDS</h3>
            <p>Plataforma interna de gestión clínica y administrativa de la Dirección de Salud.</p>
          </div>
          <div class="service-card-footer"><span>Acceso funcionarios APS</span><span>→</span></div>
        </a>

        <a href="<?php echo esc_url(home_url('/newsletter-cmds/')); ?>" class="service-card" data-cat="comunidad">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">📰</div>
              <span class="service-badge">Comunidad</span>
            </div>
            <h3>Newsletter Institucional</h3>
            <p>Boletín informativo periódico con las principales novedades de educación y salud primaria.</p>
          </div>
          <div class="service-card-footer"><span>Revisar boletines</span><span>→</span></div>
        </a>

        <a href="<?php echo esc_url(home_url('/directorio-telefonico/')); ?>" class="service-card" data-cat="comunidad">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">☎️</div>
              <span class="service-badge">Contacto</span>
            </div>
            <h3>Directorio Telefónico</h3>
            <p>Anexos y teléfonos de contacto de direcciones centrales, CESFAM, escuelas y liceos.</p>
          </div>
          <div class="service-card-footer"><span>Consultar directorio</span><span>→</span></div>
        </a>

        <a href="https://totem.cmds.cl/totem-admin/public/login" target="_blank" rel="noopener" class="service-card" data-cat="funcionarios">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">🪪</div>
              <span class="service-badge">Funcionarios</span>
            </div>
            <h3>Portal del Trabajador</h3>
            <p>Autoatención de recursos humanos, liquidaciones y certificados para colaboradores CMDS.</p>
          </div>
          <div class="service-card-footer"><span>Ingresar a Tótem</span><span>→</span></div>
        </a>

        <a href="https://outlook.office.com/" target="_blank" rel="noopener" class="service-card" data-cat="funcionarios">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">✉️</div>
              <span class="service-badge">Funcionarios</span>
            </div>
            <h3>Mail Corporativo & Office</h3>
            <p>Correo institucional Outlook y acceso directo a Word, Excel y PowerPoint Web.</p>
          </div>
          <div class="service-card-footer"><span>Abrir correo</span><span>→</span></div>
        </a>

        <a href="<?php echo esc_url(home_url('/plataformacmds/')); ?>" class="service-card" data-cat="funcionarios">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">🗂️</div>
              <span class="service-badge">Funcionarios</span>
            </div>
            <h3>Plataforma CMDS & Intranet</h3>
            <p>Acceso unificado a sistemas administrativos internos, Intranet Escolar y documentos.</p>
          </div>
          <div class="service-card-footer"><span>Ingresar</span><span>→</span></div>
        </a>

        <a href="https://cmds.pad.cl:3443/cmds_evidencia_prod/login/" target="_blank" rel="noopener" class="service-card" data-cat="funcionarios">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">✅</div>
              <span class="service-badge">Funcionarios</span>
            </div>
            <h3>Verificadores de Honorarios</h3>
            <p>Plataforma de carga de evidencias y respaldo de actividades para prestadores a honorarios.</p>
          </div>
          <div class="service-card-footer"><span>Subir evidencias</span><span>→</span></div>
        </a>

        <a href="http://www.soporte.cmds.cl/" target="_blank" rel="noopener" class="service-card" data-cat="funcionarios">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">🛠️</div>
              <span class="service-badge">Soporte TI</span>
            </div>
            <h3>Ticket Informático</h3>
            <p>Mesa de ayuda tecnológica para reportar incidencias de equipos, redes y sistemas.</p>
          </div>
          <div class="service-card-footer"><span>Generar ticket</span><span>→</span></div>
        </a>

        <a href="https://get.teamviewer.com/8rf3snz" target="_blank" rel="noopener" class="service-card" data-cat="funcionarios">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">🖥️</div>
              <span class="service-badge">Soporte Remoto</span>
            </div>
            <h3>Soporte en Línea Remoto</h3>
            <p>Asistencia remota inmediata vía TeamViewer y soporte de impresión Dimacofi.</p>
          </div>
          <div class="service-card-footer"><span>Conectar asistencia</span><span>→</span></div>
        </a>

        <a href="http://sos.cmds.cl/" target="_blank" rel="noopener" class="service-card" data-cat="funcionarios">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">🏗️</div>
              <span class="service-badge">Infraestructura</span>
            </div>
            <h3>Soporte Obras (SOS CMDS)</h3>
            <p>Requerimientos de mantención e infraestructura para establecimientos y centros de salud.</p>
          </div>
          <div class="service-card-footer"><span>Ingresar solicitud</span><span>→</span></div>
        </a>

        <a href="https://www.cmds.cl/wp-content/uploads/2023/01/Requisitos_-Bono_Post_Laboral_2023.pdf" target="_blank" rel="noopener" class="service-card" data-cat="funcionarios">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">📋</div>
              <span class="service-badge">RRHH</span>
            </div>
            <h3>Requisitos Bono Post-Laboral</h3>
            <p>Información y documentación requerida para la tramitación del beneficio post-laboral.</p>
          </div>
          <div class="service-card-footer"><span>Descargar PDF</span><span>↓</span></div>
        </a>

        <a href="https://www.portaltransparencia.cl/PortalPdT/pdtta?codOrganismo=CM002" target="_blank" rel="noopener" class="service-card" data-cat="transparencia">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">🔍</div>
              <span class="service-badge">Transparencia</span>
            </div>
            <h3>Transparencia Activa (CM002)</h3>
            <p>Acceso público a remuneraciones, compras, actos administrativos, presupuesto y auditorías.</p>
          </div>
          <div class="service-card-footer"><span>Abrir Portal Transparencia</span><span>→</span></div>
        </a>

        <a href="<?php echo esc_url(home_url('/propuestas-publicas-salud/')); ?>" class="service-card" data-cat="transparencia">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">📑</div>
              <span class="service-badge">Adquisiciones</span>
            </div>
            <h3>Propuestas Públicas y Licitaciones</h3>
            <p>Bases y llamados a licitación de las áreas de Salud, Educación y Mercado Público.</p>
          </div>
          <div class="service-card-footer"><span>Ver licitaciones</span><span>→</span></div>
        </a>

        <a href="<?php echo esc_url(home_url('/trabaja-con-nosotros/')); ?>" class="service-card" data-cat="transparencia">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">💼</div>
              <span class="service-badge">Empleo</span>
            </div>
            <h3>Trabaja con Nosotros</h3>
            <p>Convocatorias vigentes para profesionales, técnicos, docentes y asistentes en CMDS.</p>
          </div>
          <div class="service-card-footer"><span>Ver ofertas laborales</span><span>→</span></div>
        </a>

        <a href="https://www.directoresparachile.cl/pub/convocatorias/convocatorias.aspx?s=1&convocatorias-abiertas&r=3" target="_blank" rel="noopener" class="service-card" data-cat="transparencia">
          <div>
            <div class="service-card-top">
              <div class="service-icon-box">🏛️</div>
              <span class="service-badge">Concursos Públicos</span>
            </div>
            <h3>Alta Dirección Pública</h3>
            <p>Concursos abiertos para directores/as de establecimientos a través de Directores para Chile.</p>
          </div>
          <div class="service-card-footer"><span>Ver convocatorias</span><span>→</span></div>
        </a>
      </div>
    </div>
  </section>

  <!-- RED COMUNAL DE SALUD Y EDUCACIÓN -->
  <section class="pillars-section">
    <div class="cmds-container">
      <div class="pillars-grid">

        <div class="pillar-panel">
          <div class="pillar-banner salud-banner">
            <span class="pillar-kicker">Dirección de Salud · APS</span>
            <h3>Red de Atención Primaria de Salud</h3>
            <p>Cuidado integral, preventivo y oportuno para las familias de Antofagasta a través de nuestra red de centros de salud.</p>
            <div class="pillar-stats">
              <div class="pillar-stat"><strong>8</strong><span>CESFAM en la comuna</span></div>
              <div class="pillar-stat"><strong>2</strong><span>Centros CECOSF</span></div>
              <div class="pillar-stat"><strong>SAR + Lab</strong><span>Urgencia y Diagnóstico</span></div>
            </div>
          </div>
          <div class="pillar-body">
            <div>
              <p style="font-size:0.84rem;font-weight:700;color:var(--text-secondary);margin-bottom:10px;">Selecciona un centro para ver su ficha institucional, horarios y dirección:</p>
              <div class="network-chips">
                <a href="<?php echo esc_url(home_url('/cesfam-centro-sur/')); ?>" class="network-chip">🏥 CESFAM Centro Sur</a>
                <a href="<?php echo esc_url(home_url('/cesfam-maria-cristina-rojas/')); ?>" class="network-chip">🏥 CESFAM M. Cristina Rojas</a>
                <a href="<?php echo esc_url(home_url('/cesfam-corvallis/')); ?>" class="network-chip">🏥 CESFAM Corvallis</a>
                <a href="<?php echo esc_url(home_url('/cesfam-central-oriente/')); ?>" class="network-chip">🏥 CESFAM Central Oriente</a>
                <a href="<?php echo esc_url(home_url('/cesfam-norte/')); ?>" class="network-chip">🏥 CESFAM Norte</a>
                <a href="<?php echo esc_url(home_url('/cesfam-rendic/')); ?>" class="network-chip">🏥 CESFAM Dr. A. Rendic</a>
                <a href="<?php echo esc_url(home_url('/cesfam-juan-pablo-ii/')); ?>" class="network-chip">🏥 CESFAM Juan Pablo II</a>
                <a href="<?php echo esc_url(home_url('/cesfam-valdivieso/')); ?>" class="network-chip">🏥 CESFAM Valdivieso</a>
                <a href="<?php echo esc_url(home_url('/cecosf-la-chimba/')); ?>" class="network-chip">➕ CECOSF La Chimba</a>
                <a href="<?php echo esc_url(home_url('/cecosf-coviefi/')); ?>" class="network-chip">➕ CECOSF Coviefi</a>
                <a href="<?php echo esc_url(home_url('/sar-coviefi/')); ?>" class="network-chip">🚑 SAR Coviefi</a>
                <a href="<?php echo esc_url(home_url('/central-de-servicios/')); ?>" class="network-chip">🔬 Lab. Sarita Núñez</a>
              </div>
            </div>
            <div class="pillar-footer-links">
              <a href="<?php echo esc_url(home_url('/direccion-de-salud/')); ?>" class="btn-pillar">Conocer Dirección de Salud →</a>
              <a href="<?php echo esc_url(home_url('/plan-comunal/')); ?>" class="btn-pillar outline">📄 Plan Comunal de Salud</a>
            </div>
          </div>
        </div>

        <div class="pillar-panel">
          <div class="pillar-banner educacion-banner">
            <span class="pillar-kicker">Dirección de Educación</span>
            <h3>Red de Educación Pública CMDS</h3>
            <p>Formación inclusiva, de excelencia y con sello valórico desde la primera infancia hasta la educación media y técnico-profesional.</p>
            <div class="pillar-stats">
              <div class="pillar-stat"><strong>Parvularia</strong><span>Jardines y Escuelas de Párvulos</span></div>
              <div class="pillar-stat"><strong>Básica y Media</strong><span>Escuelas y Liceos HC / TP</span></div>
              <div class="pillar-stat"><strong>Inclusión</strong><span>PIE, Psicosocial y Extraescolar</span></div>
            </div>
          </div>
          <div class="pillar-body">
            <div>
              <p style="font-size:0.84rem;font-weight:700;color:var(--text-secondary);margin-bottom:10px;">Explora nuestros niveles educativos y programas de apoyo al estudiante:</p>
              <div class="network-chips">
                <a href="<?php echo esc_url(home_url('/educacion-parvularia/')); ?>" class="network-chip">🧸 Educación Parvularia</a>
                <a href="<?php echo esc_url(home_url('/educacion-basica/')); ?>" class="network-chip">📘 Educación Básica</a>
                <a href="<?php echo esc_url(home_url('/educacion-media/')); ?>" class="network-chip">🎓 Educación Media</a>
                <a href="<?php echo esc_url(home_url('/programa-de-integracion-escolar/')); ?>" class="network-chip">🤝 Programa Integración (PIE)</a>
                <a href="<?php echo esc_url(home_url('/departamento-psicosocial/')); ?>" class="network-chip">💬 Depto. Psicosocial</a>
                <a href="<?php echo esc_url(home_url('/departamento-extraescolar/')); ?>" class="network-chip">🏆 Depto. Extraescolar</a>
                <a href="<?php echo esc_url(home_url('/postulacion-educacion-parvularia-cmds-2027/')); ?>" class="network-chip">📝 Admisión Parvularia 2027</a>
                <a href="<?php echo esc_url(home_url('/propuestas-publicas-educacion/')); ?>" class="network-chip">📑 Licitaciones Educación</a>
              </div>
            </div>
            <div class="pillar-footer-links">
              <a href="<?php echo esc_url(home_url('/direccion-de-educacion/')); ?>" class="btn-pillar">Conocer Dirección de Educación →</a>
              <a href="<?php echo esc_url(home_url('/plan-comunal-2/')); ?>" class="btn-pillar outline">📄 PADEM Vigente</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECCIÓN NOTICIAS Y ACTUALIDAD CMDS (DINÁMICA DESDE BASE DE DATOS) -->
  <section class="news-section">
    <div class="cmds-container">
      <div class="section-header">
        <div>
          <span class="section-eyebrow">Comunicaciones CMDS</span>
          <h2 class="section-title">Actualidad en Salud y Educación</h2>
          <p class="section-subtitle">Últimos hitos, actividades en terreno y noticias de nuestros establecimientos educacionales y centros de salud.</p>
        </div>
        <a href="<?php echo esc_url(home_url('/noticias-2/')); ?>" class="btn-pillar">Ver archivo completo de noticias →</a>
      </div>

      <div class="news-grid">
        <?php foreach ($grid_posts as $post_item) : ?>
        <article class="news-card">
          <a href="<?php echo esc_url($post_item['permalink']); ?>" class="news-thumb-wrap">
            <img src="<?php echo esc_url($post_item['thumb']); ?>" alt="<?php echo esc_attr($post_item['title']); ?>" loading="lazy" />
            <span class="news-cat-pill <?php echo esc_attr($post_item['badge_class']); ?>"><?php echo esc_html($post_item['cat_name']); ?></span>
          </a>
          <div class="news-body">
            <div>
              <div class="news-meta">📅 <?php echo esc_html($post_item['date']); ?></div>
              <a href="<?php echo esc_url($post_item['permalink']); ?>">
                <h3 class="news-title"><?php echo esc_html($post_item['title']); ?></h3>
              </a>
            </div>
            <a href="<?php echo esc_url($post_item['permalink']); ?>" class="news-readmore">Leer nota completa →</a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <script>
    var cmdsCurrentSlide = 0;
    var cmdsSlides = document.querySelectorAll('.hero-slide');
    function cmdsShowSlide(idx) {
      if (!cmdsSlides.length) return;
      cmdsSlides.forEach(function(s, i) {
        s.classList.toggle('active', i === idx);
        s.querySelectorAll('.slider-dot').forEach(function(d, di) {
          d.classList.toggle('active', di === idx);
        });
      });
      cmdsCurrentSlide = idx;
    }
    function cmdsChangeSlide(dir) {
      if (!cmdsSlides.length) return;
      cmdsShowSlide((cmdsCurrentSlide + dir + cmdsSlides.length) % cmdsSlides.length);
    }
    function cmdsGoToSlide(idx) {
      cmdsShowSlide(idx);
    }
    setInterval(function() { cmdsChangeSlide(1); }, 7500);

    function cmdsFilterServices(cat, btn) {
      document.querySelectorAll('.service-tab').forEach(function(t) { t.classList.remove('active'); });
      btn.classList.add('active');
      document.querySelectorAll('.service-card').forEach(function(card) {
        if (cat === 'all' || card.getAttribute('data-cat') === cat) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });
    }
  </script>

<?php
get_footer();
