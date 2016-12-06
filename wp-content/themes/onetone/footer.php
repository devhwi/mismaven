<?php
 $enable_footer_widget_area = esc_attr(onetone_option('enable_footer_widget_area'));
 $footer_columns            = onetone_option('footer_columns','4');
 $copyright_text            = onetone_option('copyright','');
 $display_copyright_bar     = onetone_option('display_copyright_bar','yes');

?>
<!--Footer-->
		<footer>
        <?php if( $enable_footer_widget_area == '1' ):?>
			<div class="footer-widget-area">
                <div class="container">
                    <div class="row">
                    <?php
					for( $i=1;$i<=$footer_columns; $i++ ){
					?>
                    <div class="col-md-<?php echo 12/$footer_columns; ?>">
                    <?php
							if(is_active_sidebar("footer_widget_".$i)){
	                           dynamic_sidebar("footer_widget_".$i);
                               }
							?>
                    </div>

                    <?php }?>
                    </div>
                </div>
            </div>
            <?php endif;?>
			<div class="footer-info-area">
				<div class="container">
					<div class="site-info pull-left">
					  <?php
                      if( is_home() || is_front_page()){
                        printf(__('Designed by <a href="%s">MageeWP Themes</a>. | Editted by <a style="color:#8f1822;font-weight:bold;" href="http://mismaven.kr">MAVEN</a>','onetone'),esc_url('http://www.mageewp.com/'));
                      }else{
						 printf(__('Designed by MageeWP Themes.  | Editted by <a style="color:#8f1822;font-weight:bold;" href="http://mismaven.kr">MAVEN</a>','onetone'));
						  }
                      ?>
					</div>
                     <div class="site-social pull-right">
                      <?php
							echo onetone_get_social( 'footer', '','top','_blank');
							?>
                       </div>
				</div>
			</div>
		</footer>
	</div>
    <?php wp_footer();?>
</body>
</html>
