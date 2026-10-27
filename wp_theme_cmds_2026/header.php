<?php
/**
 * Cabecera Oficial CMDS Antofagasta 2026
 */
if (!defined('ABSPATH')) {
    exit;
}
$assets_uri = get_stylesheet_directory_uri() . '/assets';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="<?php echo esc_url($assets_uri . '/favicon-isotipo.png'); ?>" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if (function_exists('wp_body_open')) { wp_body_open(); } ?>

  <!-- FRANJA MULTICOLOR OFICIAL 2026 (#006098 | #44babe | #f7a516 | #eb567e) -->
  <div class="brand-ribbon" role="presentation">
    <div class="seg-blue"></div>
    <div class="seg-teal"></div>
    <div class="seg-amber"></div>
    <div class="seg-pink"></div>
  </div>

  <!-- BARRA SUPERIOR INSTITUCIONAL (TOPBAR) -->
  <div class="cmds-topbar">
    <div class="cmds-container cmds-topbar-inner">
      <div class="cmds-topbar-left">
        <span class="slogan-pill">
          <span class="dots">
            <span style="background:#44babe"></span>
            <span style="background:#f7a516"></span>
            <span style="background:#eb567e"></span>
          </span>
          “Educación que transforma, salud que protege”
        </span>
        <div class="topbar-contact">
          <span>📍 Avda. Argentina 1595, 2° Piso, Antofagasta</span>
          <span>📞 +56 55 255 3700 / 55 2 553707</span>
        </div>
      </div>

      <div class="cmds-topbar-right">
        <div class="gov-links">
          <a href="https://www.portaltransparencia.cl/PortalPdT/pdtta?codOrganismo=CM002" target="_blank" rel="noopener" class="gov-link">
            🔍 Transparencia Activa
          </a>
          <a href="https://www.leylobby.gob.cl/instituciones/CM002" target="_blank" rel="noopener" class="gov-link">
            🏛️ Ley del Lobby
          </a>
          <a href="https://www.mercadopublico.cl/Home" target="_blank" rel="noopener" class="gov-link">
            🛒 Mercado Público
          </a>
          <a href="https://outlook.office.com/" target="_blank" rel="noopener" class="gov-link highlight-mail">
            ✉️ Mail Corporativo
          </a>
          <a href="https://totem.cmds.cl/totem-admin/public/login" target="_blank" rel="noopener" class="gov-link">
            👤 Portal Trabajador
          </a>
        </div>
        <div class="a11y-controls" aria-label="Tamaño de texto">
          <button type="button" class="a11y-btn" onclick="cmdsSetFontScale(0.92)" title="Disminuir letra">A-</button>
          <button type="button" class="a11y-btn" onclick="cmdsSetFontScale(1)" title="Letra normal">A</button>
          <button type="button" class="a11y-btn" onclick="cmdsSetFontScale(1.1)" title="Aumentar letra">A+</button>
        </div>
      </div>
    </div>
  </div>

  <!-- CABECERA PRINCIPAL CON MENÚS DINÁMICOS AL ENTORNO ACTUAL -->
  <header class="cmds-site-header">
    <div class="cmds-container cmds-header-inner">
      <div class="brand-group">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo" title="CMDS Antofagasta - Inicio">
          <img src="<?php echo esc_url($assets_uri . '/logo-cmds-color.png'); ?>" alt="CMDS Antofagasta" class="logo-light-bg" />
          <img src="<?php echo esc_url($assets_uri . '/logo-cmds-oscuro.png'); ?>" alt="CMDS Antofagasta" class="logo-dark-bg" />
        </a>
        <div class="brand-divider"></div>
        <a href="https://www.municipalidadantofagasta.cl" target="_blank" rel="noopener" class="muni-badge" title="Ilustre Municipalidad de Antofagasta">
          <img src="<?php echo esc_url($assets_uri . '/logo-muni-antofagasta.png'); ?>" alt="Ilustre Municipalidad de Antofagasta" />
        </a>
      </div>

      <nav class="cmds-main-nav" aria-label="Menú Principal CMDS">
        <div class="cmds-nav-item">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="cmds-nav-link <?php echo is_front_page() ? 'active' : ''; ?>">Inicio</a>
        </div>

        <!-- Menú Corporación -->
        <div class="cmds-nav-item">
          <span class="cmds-nav-link">
            Corporación
            <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
          </span>
          <div class="cmds-dropdown-menu">
            <div class="dropdown-group-title">Institucional CMDS</div>
            <a href="<?php echo esc_url(home_url('/somos/')); ?>" class="cmds-dropdown-link">Somos (Misión y Visión)</a>
            <a href="<?php echo esc_url(home_url('/directorio/')); ?>" class="cmds-dropdown-link">Directorio</a>
            <a href="<?php echo esc_url(home_url('/presidencia-2/')); ?>" class="cmds-dropdown-link">Presidencia</a>
            <a href="<?php echo esc_url(home_url('/secretaria-ejecutiva/')); ?>" class="cmds-dropdown-link">Secretaría Ejecutiva</a>
            <a href="<?php echo esc_url(home_url('/direccion-de-obras-2/')); ?>" class="cmds-dropdown-link">Dirección de Adm. y Finanzas</a>
            <a href="<?php echo esc_url(home_url('/direccion-de-salud/')); ?>" class="cmds-dropdown-link">Dirección de Salud</a>
            <a href="<?php echo esc_url(home_url('/direccion-de-educacion/')); ?>" class="cmds-dropdown-link">Dirección de Educación</a>
            <a href="<?php echo esc_url(home_url('/direccion-de-obras/')); ?>" class="cmds-dropdown-link">Dirección de Obras y Planificación</a>
            <a href="<?php echo esc_url(home_url('/direccion-rrhh/')); ?>" class="cmds-dropdown-link">Dirección RRHH</a>
            <a href="<?php echo esc_url(home_url('/memoria/')); ?>" class="cmds-dropdown-link">Memoria Anual</a>
            <a href="<?php echo esc_url(home_url('/reglamento-interno/')); ?>" class="cmds-dropdown-link">Reglamento Interno</a>
          </div>
        </div>

        <!-- Menú Educación -->
        <div class="cmds-nav-item">
          <span class="cmds-nav-link">
            Educación
            <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
          </span>
          <div class="cmds-dropdown-menu mega-educacion">
            <div>
              <div class="dropdown-group-title amber">Niveles Educativos</div>
              <a href="<?php echo esc_url(home_url('/educacion-parvularia/')); ?>" class="cmds-dropdown-link">Educación Parvularia</a>
              <a href="<?php echo esc_url(home_url('/educacion-basica/')); ?>" class="cmds-dropdown-link">Educación Básica</a>
              <a href="<?php echo esc_url(home_url('/educacion-media/')); ?>" class="cmds-dropdown-link">Educación Media</a>
              <a href="<?php echo esc_url(home_url('/plan-comunal-2/')); ?>" class="cmds-dropdown-link">PADEM (Plan Anual)</a>
              <a href="<?php echo esc_url(home_url('/postulacion-educacion-parvularia-cmds-2027/')); ?>" class="cmds-dropdown-link">Postulación Parvularia 2027</a>
            </div>
            <div>
              <div class="dropdown-group-title">Apoyo Formación Integral</div>
              <a href="<?php echo esc_url(home_url('/programa-de-integracion-escolar/')); ?>" class="cmds-dropdown-link">Programa Integración Escolar (PIE)</a>
              <a href="<?php echo esc_url(home_url('/departamento-psicosocial/')); ?>" class="cmds-dropdown-link">Departamento Psicosocial</a>
              <a href="<?php echo esc_url(home_url('/departamento-extraescolar/')); ?>" class="cmds-dropdown-link">Departamento Extraescolar</a>
              <a href="https://cmds-portaleduca.pad.cl:2443/login_ctrl/" target="_blank" rel="noopener" class="cmds-dropdown-link">Portal Alumnos y Apoderados ↗</a>
              <a href="<?php echo esc_url(home_url('/cmds-educa-lcd/')); ?>" class="cmds-dropdown-link">CMDS Educa / Videos</a>
            </div>
          </div>
        </div>

        <!-- Menú Salud -->
        <div class="cmds-nav-item">
          <span class="cmds-nav-link">
            Salud (APS)
            <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
          </span>
          <div class="cmds-dropdown-menu mega-salud">
            <div>
              <div class="dropdown-group-title teal">Red de Centros CESFAM</div>
              <a href="<?php echo esc_url(home_url('/cesfam-centro-sur/')); ?>" class="cmds-dropdown-link">CESFAM Centro Sur</a>
              <a href="<?php echo esc_url(home_url('/cesfam-maria-cristina-rojas/')); ?>" class="cmds-dropdown-link">CESFAM María Cristina Rojas</a>
              <a href="<?php echo esc_url(home_url('/cesfam-corvallis/')); ?>" class="cmds-dropdown-link">CESFAM Corvallis</a>
              <a href="<?php echo esc_url(home_url('/cesfam-central-oriente/')); ?>" class="cmds-dropdown-link">CESFAM Central Oriente</a>
              <a href="<?php echo esc_url(home_url('/cesfam-norte/')); ?>" class="cmds-dropdown-link">CESFAM Norte</a>
              <a href="<?php echo esc_url(home_url('/cesfam-rendic/')); ?>" class="cmds-dropdown-link">CESFAM Dr. Antonio Rendic</a>
              <a href="<?php echo esc_url(home_url('/cesfam-juan-pablo-ii/')); ?>" class="cmds-dropdown-link">CESFAM Juan Pablo II</a>
              <a href="<?php echo esc_url(home_url('/cesfam-valdivieso/')); ?>" class="cmds-dropdown-link">CESFAM Valdivieso</a>
            </div>
            <div>
              <div class="dropdown-group-title">CECOSF, Urgencia y Apoyo</div>
              <a href="<?php echo esc_url(home_url('/cecosf-la-chimba/')); ?>" class="cmds-dropdown-link">CECOSF La Chimba</a>
              <a href="<?php echo esc_url(home_url('/cecosf-coviefi/')); ?>" class="cmds-dropdown-link">CECOSF Coviefi</a>
              <a href="<?php echo esc_url(home_url('/sar-coviefi/')); ?>" class="cmds-dropdown-link">SAR Coviefi (Urgencia)</a>
              <a href="<?php echo esc_url(home_url('/central-de-servicios/')); ?>" class="cmds-dropdown-link">Laboratorio Clínico Sarita Núñez</a>
              <a href="<?php echo esc_url(home_url('/plan-comunal/')); ?>" class="cmds-dropdown-link">Plan Comunal de Salud</a>
              <a href="https://horasalud.cl/web/portal/" target="_blank" rel="noopener" class="cmds-dropdown-link" style="font-weight:700;color:var(--cmds-pink-dark) !important;">🩺 Reserva de Hora Salud ↗</a>
            </div>
          </div>
        </div>

        <div class="cmds-nav-item">
          <a href="<?php echo esc_url(home_url('/noticias-2/')); ?>" class="cmds-nav-link">Noticias</a>
        </div>

        <div class="cmds-nav-item">
          <a href="<?php echo esc_url(home_url('/trabaja-con-nosotros/')); ?>" class="cmds-nav-link">Trabaja con Nosotros</a>
        </div>

        <div class="cmds-nav-item">
          <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="cmds-nav-link">Contacto</a>
        </div>
      </nav>

      <div class="header-actions">
        <a href="https://horasalud.cl/web/portal/" target="_blank" rel="noopener" class="btn-hora-salud">
          🩺 Hora Salud en Línea
        </a>
      </div>
    </div>
  </header>
