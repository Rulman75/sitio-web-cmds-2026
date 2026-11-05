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
        <div class="topbar-socials" aria-label="Redes Sociales Oficiales CMDS">
          <a href="https://www.instagram.com/cmds_antof/" target="_blank" rel="noopener" class="topbar-social-icon ig" title="Síguenos en Instagram (@cmds_antof)">
            <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="https://www.facebook.com/CMDS.ANTOF/" target="_blank" rel="noopener" class="topbar-social-icon fb" title="Síguenos en Facebook (CMDS.ANTOF)">
            <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
          </a>
          <a href="https://www.youtube.com/@cmdsantofagasta3334" target="_blank" rel="noopener" class="topbar-social-icon yt" title="Canal Oficial de YouTube (@cmdsantofagasta3334)">
            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
          <a href="<?php echo esc_url(home_url('/#cmds-tv')); ?>" class="topbar-tv-cta" title="Ver transmisión continua de CMDS TV (YouTube) más abajo">
            <span class="topbar-tv-pulse"></span>
            📺 <strong>CMDS TV:</strong> Ver Canal YouTube en Vivo ↓
          </a>
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
          <img src="<?php echo esc_url($assets_uri . '/logo-cmds-color.png?v=2026.2'); ?>" alt="CMDS Antofagasta" class="logo-light-bg" />
          <img src="<?php echo esc_url($assets_uri . '/logo-cmds-oscuro.png?v=2026.2'); ?>" alt="CMDS Antofagasta" class="logo-dark-bg" />
        </a>
        <div class="brand-divider"></div>
        <a href="https://www.municipalidadantofagasta.cl" target="_blank" rel="noopener" class="muni-badge" title="Ilustre Municipalidad de Antofagasta">
          <img src="<?php echo esc_url($assets_uri . '/logo-muni-antofagasta.png?v=2026.2'); ?>" alt="Ilustre Municipalidad de Antofagasta" />
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
          🩺 <span class="btn-hora-text">Hora Salud en Línea</span>
        </a>
        <button type="button" class="cmds-mobile-toggle" id="cmdsMobileToggle" onclick="cmdsToggleMobileMenu()" aria-label="Abrir menú principal" aria-expanded="false">
          <span class="hamburger-box">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
          </span>
          <span class="mobile-toggle-label">Menú</span>
        </button>
      </div>
    </div>
  </header>
