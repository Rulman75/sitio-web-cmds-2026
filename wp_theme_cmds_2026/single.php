<?php
/**
 * Plantilla Oficial de Lectura de Noticia Individual CMDS 2026
 */
if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) :
    the_post();
    $cats = get_the_category();
    $cat_name = !empty($cats) ? $cats[0]->name : 'Actualidad CMDS';
    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

  <section class="cmds-interior-hero area-corporacion">
    <div class="cmds-container">
      <nav class="cmds-breadcrumb" aria-label="Ruta de navegación">
        <a href="<?php echo esc_url(home_url('/')); ?>">🏠 Inicio</a>
        <span>›</span>
        <a href="<?php echo esc_url(home_url('/noticias-2/')); ?>">Noticias CMDS</a>
        <span>›</span>
        <span><?php echo esc_html($cat_name); ?></span>
      </nav>
      <span class="cmds-interior-badge">📅 <?php echo esc_html(get_the_date('j \d\e F, Y')); ?> · <?php echo esc_html($cat_name); ?></span>
      <h1 class="cmds-interior-title" style="max-width:980px;"><?php the_title(); ?></h1>
    </div>
  </section>

  <main class="cmds-interior-main">
    <div class="cmds-container">
      <article class="cmds-content-card" style="max-width:980px;margin:0 auto;">
        <?php if ($thumb) : ?>
          <div style="margin-bottom:28px;border-radius:16px;overflow:hidden;box-shadow:var(--shadow-sm);">
            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;max-height:520px;object-fit:cover;" />
          </div>
        <?php endif; ?>

        <div class="cmds-article-body">
          <?php the_content(); ?>
        </div>

        <div style="margin-top:36px;padding-top:20px;border-top:1px solid var(--border-color);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
          <a href="<?php echo esc_url(home_url('/noticias-2/')); ?>" class="btn-pillar outline">← Volver a Noticias CMDS</a>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-pillar">Ir al Inicio</a>
        </div>
      </article>
    </div>
  </main>

<?php
endwhile;
get_footer();
