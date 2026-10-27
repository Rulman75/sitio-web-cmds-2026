<?php
/**
 * Plantilla de respaldo (Archivos, Categorías y Búsqueda) CMDS 2026
 */
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

  <section class="cmds-interior-hero area-corporacion">
    <div class="cmds-container">
      <nav class="cmds-breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">🏠 Inicio</a>
        <span>›</span>
        <span>Archivo Institucional</span>
      </nav>
      <span class="cmds-interior-badge">Comunicaciones CMDS</span>
      <h1 class="cmds-interior-title">
        <?php
        if (is_category() || is_tag() || is_archive()) {
            echo wp_kses_post(get_the_archive_title());
        } elseif (is_search()) {
            printf('Resultados de búsqueda para: %s', esc_html(get_search_query()));
        } else {
            echo 'Noticias y Publicaciones CMDS';
        }
        ?>
      </h1>
    </div>
  </section>

  <main class="cmds-interior-main">
    <div class="cmds-container">
      <div class="news-grid">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                if (!$thumb) {
                    $thumb = 'https://www.cmds.cl/wp-content/uploads/2026/10/acredutacion-web-scaled.jpg';
                }
        ?>
          <article class="news-card">
            <a href="<?php the_permalink(); ?>" class="news-thumb-wrap">
              <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
              <span class="news-cat-pill">CMDS</span>
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
        <?php
            endwhile;
        endif;
        ?>
      </div>
      <div class="cmds-pagination">
        <?php the_posts_pagination(['prev_text' => '‹ Anterior', 'next_text' => 'Siguiente ›']); ?>
      </div>
    </div>
  </main>

<?php
get_footer();
