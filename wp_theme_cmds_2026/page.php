<?php
/**
 * Plantilla Oficial de Páginas Interiores CMDS Antofagasta 2026
 * (Somos, Directorio, Presidencia, Secretaría Ejecutiva, Direcciones, CESFAM, Educación, Noticias, Contacto, etc.)
 */
if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) :
    the_post();
    $slug = get_post_field('post_name', get_the_ID());
    $sec  = cmds_2026_get_page_section_info($slug);
?>

  <!-- HERO INSTITUCIONAL DE PÁGINA INTERIOR 2026 -->
  <section class="cmds-interior-hero <?php echo esc_attr($sec['area_class']); ?>">
    <div class="cmds-container">
      <nav class="cmds-breadcrumb" aria-label="Ruta de navegación">
        <a href="<?php echo esc_url(home_url('/')); ?>">🏠 Inicio</a>
        <span>›</span>
        <span><?php echo esc_html($sec['area_name']); ?></span>
        <span>›</span>
        <strong style="color:#fff;"><?php echo esc_html(get_the_title()); ?></strong>
      </nav>
      <span class="cmds-interior-badge"><?php echo esc_html($sec['area_name']); ?></span>
      <h1 class="cmds-interior-title"><?php echo esc_html(get_the_title()); ?></h1>
    </div>
  </section>

  <!-- BARRA DE NAVEGACIÓN CONTEXTUAL ENTRE PÁGINAS DE LA MISMA ÁREA -->
  <?php if (!empty($sec['siblings'])) : ?>
  <div class="cmds-section-subnav">
    <div class="cmds-container">
      <div class="cmds-subnav-list">
        <?php foreach ($sec['siblings'] as $sib_slug => $sib_label) : ?>
          <a href="<?php echo esc_url(home_url('/' . $sib_slug . '/')); ?>"
             class="cmds-subnav-pill <?php echo ($sib_slug === $slug) ? 'active' : ''; ?>">
            <?php echo esc_html($sib_label); ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- CONTENIDO PRINCIPAL DE LA PÁGINA INTERIOR -->
  <main class="cmds-interior-main">
    <div class="cmds-container">

      <?php if ($slug === 'noticias-2' || $slug === 'noticias') : ?>
        <!-- PORTAL DE NOTICIAS PAGINADO Y OPTIMIZADO 2026 -->
        <?php
        $paged = max(1, get_query_var('paged'), get_query_var('page'), isset($_GET['pg']) ? intval($_GET['pg']) : 1);
        $news_q = new WP_Query([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 12,
            'paged'          => $paged,
        ]);
        ?>
        <div class="news-grid">
          <?php
          while ($news_q->have_posts()) :
              $news_q->the_post();
              $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
              if (!$thumb) {
                  $thumb = 'https://www.cmds.cl/wp-content/uploads/2026/10/acredutacion-web-scaled.jpg';
              }
              $cats = get_the_category();
              $cat_name = !empty($cats) ? $cats[0]->name : 'Noticias CMDS';
          ?>
            <article class="news-card">
              <a href="<?php the_permalink(); ?>" class="news-thumb-wrap">
                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
                <span class="news-cat-pill"><?php echo esc_html($cat_name); ?></span>
              </a>
              <div class="news-body">
                <div>
                  <div class="news-meta">📅 <?php echo esc_html(get_the_date('j \d\e F, Y')); ?></div>
                  <a href="<?php the_permalink(); ?>">
                    <h3 class="news-title"><?php the_title(); ?></h3>
                  </a>
                </div>
                <a href="<?php the_permalink(); ?>" class="news-readmore">Leer nota completa →</a>
              </div>
            </article>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="cmds-pagination">
          <?php
          echo paginate_links([
              'base'      => add_query_arg('pg', '%#%'),
              'format'    => '',
              'current'   => $paged,
              'total'     => $news_q->max_num_pages,
              'prev_text' => '‹ Anterior',
              'next_text' => 'Siguiente ›',
          ]);
          ?>
        </div>

      <?php else : ?>
        <!-- CONTENEDOR INSTITUCIONAL 2026 PARA ELEMENTOR / UNYSON / CONTENIDO -->
        <div class="cmds-content-card">
          <?php
          ob_start();
          the_content();
          $rendered_content = trim(ob_get_clean());
          if (!empty($rendered_content)) {
              echo $rendered_content;
          } elseif (function_exists('fw_ext_page_builder_get_post_content')) {
              echo do_shortcode(fw_ext_page_builder_get_post_content(get_post()));
          }
          ?>
        </div>
      <?php endif; ?>

    </div>
  </main>

<?php
endwhile;
get_footer();
