<?php
/**
 * The template for displaying the Footer.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>

    </div>
  </div>
</div>
<!-- /#main -->

<footer role="contentinfo" id="footer">
  <div class="container">
    <div class="row">
      <?php if (is_active_sidebar('footer_widgets')) : ?>
        <?php dynamic_sidebar('footer_widgets'); ?>
      <?php endif; ?>
    </div>
  </div>
</footer>
<!-- /#footer -->

<div id="fancybox-ajaxcontainer">
    <div id="fancybox-ajaxcontent">
        <div id="fancybox-ajaxinner">
            <!-- ajax load -->
        </div>
    </div>
</div>

<div class="modal hide fade do-not-print modal-gallery" id="modal-gallery" tabindex="-1" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"></h4>
  </div>
  <div class="modal-body">
    <div class="modal-image"></div>
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary modal-prev"><i class="icon-arrow-left icon-white"></i> <?php _e("Précédent","stormbringer"); ?></a>
    <a class="btn btn-primary modal-next"><?php _e("Suivant","stormbringer"); ?> <i class="icon-arrow-right icon-white"></i></a>
    <a class="btn btn-inverse modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> <?php _e("Diaporama","stormbringer"); ?></a>
    <!--<a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>-->
  </div>
</div>
<!-- /#modal-gallery -->

<div class="modal hide fade do-not-print" id="modal-default" tabindex="-1" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"></h4>
  </div>
  <div class="modal-body in-frame">
    <iframe id="modal-frame" width="100%" height="98%" src="about:blank"></iframe>
  </div>
</div>
<!-- /#modal-default -->

<?php //get_template_part('modal', 'login'); ?>

<?php wp_footer(); ?>

<script type="text/javascript">
var template_url = '<?php bloginfo("template_url"); ?>';
</script>
</body>
</html>