<?php
/**
 * Default Footer
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
?>
    <!-- <footer> -->
        <div class="footerbottom">
            <p style="text-align:center; font-size:13px;">[30019] 세종특별자치시 세종로 2511 고려대학교 세종캠퍼스 경영정보학과</p>
            <p style="text-align:center;">Copyright ⓒ <span>MAVEN</span> All Rights Reserved</p>

        </div>

        <a href="#section0" class="cd-top">Top</a>
    <!-- </footer>--> <!-- end footer -->
        <?php wp_footer(); ?>

        <!-- jQuery . footer  back to top 기능 -->
        <script type="text/javascript">
			jQuery(document).ready(function($){
				// browser window scroll (in pixels) after which the "back to top" link is shown
				var offset = 0,
					//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
					offset_opacity = 1200,
					//duration of the top scrolling animation (in ms)
					scroll_top_duration = 700,
					//grab the "back to top" link
					$back_to_top = $('.cd-top');

				//hide or show the "back to top" link
				$(window).scroll(function(){
					( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
					if( $(this).scrollTop() > offset_opacity ) {
						$back_to_top.addClass('cd-fade-out');
					}
				});

				//smooth scroll to top
				$back_to_top.on('click', function(event){
					event.preventDefault();
					$('body,html').animate({
						scrollTop: 0 ,
					 	}, scroll_top_duration
					);
				});

			});
        </script>
    </body>
</html>
