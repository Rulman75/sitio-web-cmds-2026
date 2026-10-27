<?php
/**
 * Pie de Página Oficial CMDS Antofagasta 2026
 */
if (!defined('ABSPATH')) {
    exit;
}
$assets_uri = get_stylesheet_directory_uri() . '/assets';
?>

  <!-- FRANJA CAMPAÑA INSTITUCIONAL (MANUAL DE NORMAS GRÁFICAS PÁG. 9) -->
  <section class="campaign-strip">
    <div class="cmds-container">
      <div class="campaign-box">
        <div class="campaign-text">
          <h3>“Construyamos espacios seguros: cero violencia, 100% respeto.”</h3>
          <p>Compromiso institucional de la Corporación Municipal de Desarrollo Social con la comunidad educativa, de salud y sus trabajadores.</p>
        </div>
        <div class="campaign-actions">
          <a href="<?php echo esc_url(home_url('/trabaja-con-nosotros/')); ?>" class="btn-campaign">💼 Ofertas Laborales</a>
          <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn-campaign" style="background:rgba(255,255,255,0.14);color:#fff !important;border:1px solid rgba(255,255,255,0.35);">✉️ Contáctanos</a>
        </div>
      </div>
    </div>
  </section>

  <!-- PIE DE PÁGINA OFICIAL -->
  <footer class="cmds-site-footer">
    <div class="cmds-container">
      <div class="footer-grid">
        <div>
          <div class="footer-brand-logos">
            <img src="<?php echo esc_url($assets_uri . '/logo-cmds-oscuro.png'); ?>" alt="CMDS Antofagasta" class="footer-logo-cmds" />
            <img src="<?php echo esc_url($assets_uri . '/logo-muni-antofagasta.png'); ?>" alt="Ilustre Municipalidad de Antofagasta" class="footer-logo-muni" />
          </div>
          <div class="footer-slogan">“Educación que transforma, salud que protege”</div>
          <p class="footer-desc">
            Corporación Municipal de Desarrollo Social de Antofagasta. Administración y gestión de los servicios de Educación Pública y Atención Primaria de Salud de la comuna.
          </p>
        </div>

        <div class="footer-col">
          <h4>Institucional</h4>
          <ul class="footer-links">
            <li><a href="<?php echo esc_url(home_url('/somos/')); ?>">Somos CMDS</a></li>
            <li><a href="<?php echo esc_url(home_url('/directorio/')); ?>">Directorio Institucional</a></li>
            <li><a href="<?php echo esc_url(home_url('/presidencia-2/')); ?>">Presidencia</a></li>
            <li><a href="<?php echo esc_url(home_url('/secretaria-ejecutiva/')); ?>">Secretaría Ejecutiva</a></li>
            <li><a href="<?php echo esc_url(home_url('/memoria/')); ?>">Memoria Institucional</a></li>
            <li><a href="<?php echo esc_url(home_url('/reglamento-interno/')); ?>">Reglamento Interno</a></li>
            <li><a href="https://www.portaltransparencia.cl/PortalPdT/pdtta?codOrganismo=CM002" target="_blank" rel="noopener">Transparencia Activa (CM002)</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Portales Frecuentes</h4>
          <ul class="footer-links">
            <li><a href="https://horasalud.cl/web/portal/" target="_blank" rel="noopener">Reserva de Hora Salud</a></li>
            <li><a href="https://cmds-portaleduca.pad.cl:2443/login_ctrl/" target="_blank" rel="noopener">Portal Alumnos y Apoderados</a></li>
            <li><a href="https://cmds-portaleduca.pad.cl:2443/verificar_certificado/" target="_blank" rel="noopener">Verificación de Certificados</a></li>
            <li><a href="https://cmds.pad.cl:2443/login/" target="_blank" rel="noopener">Plataforma CMDS Educa</a></li>
            <li><a href="https://totem.cmds.cl/totem-admin/public/login" target="_blank" rel="noopener">Portal del Trabajador</a></li>
            <li><a href="http://salud.cmds.cl/" target="_blank" rel="noopener">Intranet Salud</a></li>
            <li><a href="http://www.soporte.cmds.cl/" target="_blank" rel="noopener">Soporte y Ticket Informático</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Contacto Oficial</h4>
          <ul class="footer-contact-list">
            <li>
              <span class="footer-contact-icon">📍</span>
              <div>
                <strong>Casa Central CMDS</strong><br />
                Avenida Argentina 1595, segundo piso.<br />Antofagasta, Chile.
              </div>
            </li>
            <li>
              <span class="footer-contact-icon">📞</span>
              <div>
                <strong>Mesa Central:</strong><br />
                +56 55 255 3700 / 55 2 553707
              </div>
            </li>
            <li>
              <span class="footer-contact-icon">✉️</span>
              <div>
                <strong>Correos Institucionales:</strong><br />
                comunicaciones@cmds.cl<br />
                trabajaconnosotros.aps@cmds.cl
              </div>
            </li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <span>© <?php echo date('Y'); ?> Corporación Municipal de Desarrollo Social de Antofagasta (CMDS). Todos los derechos reservados.</span>
        <span>Identidad Corporativa según Manual de Normas Gráficas CMDS 2026</span>
      </div>
    </div>

    <!-- Franja Multicolor Oficial al cierre -->
    <div class="brand-ribbon" role="presentation">
      <div class="seg-blue"></div>
      <div class="seg-teal"></div>
      <div class="seg-amber"></div>
      <div class="seg-pink"></div>
    </div>
  </footer>

  <!-- BARRA FLOTANTE DE ENTORNO DE PRUEBAS (STAGING) -->
  <div class="prototype-toolbar" id="protoToolbar">
    <span class="proto-badge">Staging 2026</span>
    <span>Cabecera:</span>
    <button type="button" class="proto-btn active" id="btnHeaderLight" onclick="cmdsSetHeaderMode('light')">Fondo Claro</button>
    <button type="button" class="proto-btn" id="btnHeaderDark" onclick="cmdsSetHeaderMode('dark')">Fondo Azul (#006098)</button>
  </div>

  <script>
    function cmdsSetHeaderMode(mode) {
      document.body.classList.toggle('header-dark', mode === 'dark');
      localStorage.setItem('cmds_header_mode', mode);
      var bLight = document.getElementById('btnHeaderLight');
      var bDark = document.getElementById('btnHeaderDark');
      if (bLight && bDark) {
        bLight.classList.toggle('active', mode === 'light');
        bDark.classList.toggle('active', mode === 'dark');
      }
    }
    function cmdsSetFontScale(scale) {
      document.documentElement.style.setProperty('--font-scale', scale);
    }
    (function() {
      var saved = localStorage.getItem('cmds_header_mode');
      if (saved === 'dark') {
        cmdsSetHeaderMode('dark');
      }
    })();
  </script>
<?php wp_footer(); ?>
</body>
</html>
