	<?php 
		$footer_widgets_disabled = of_get_option( 'md_footer_widgets_disabled');
		$footer_widgets_columns = of_get_option( 'md_footer_widgets_columns');
		
		if($footer_widgets_columns==4) { 
			$columnclass = "four columns";
		}elseif($footer_widgets_columns==3) {
			$columnclass = "one-third column";
		}elseif($footer_widgets_columns==2) {
			$columnclass = "eight columns";
		}elseif($footer_widgets_columns==1) {
			$columnclass = "sixteen columns";
		}
	?>
        <!-- <br class="clear" />
        <footer>	
                <div class="sixteen columns" style="display:none;">
                    <hr class="footer border-color" />
                    <span class="footertext">
					<?php echo $ftext = of_get_option('md_footer_text'); if($ftext!="") { echo '<br />'; }?> 
                    </span>
                    <hr class="resshow border-color" />
                    <span class="social"><?php showSharing(); ?></span>
                    
                    <hr class="footer border-color" />
                    <?php 
						if($footer_widgets_disabled!=1) {	
					?>
                    	<?php 
                        	for($i=1;$i <= $footer_widgets_columns; $i++) {
                        ?>
                            <div class="<?php echo $columnclass; if($i==1) echo ' alpha'; if($i==$footer_widgets_columns) echo ' omega'; ?>">
								<?php if(is_active_sidebar( 'bottom-' . $i)) { ?>
                                    <?php dynamic_sidebar( 'bottom-'.$i ); ?>
                                <?php } ?>
                            </div>
                    	<?php } ?>
                        
					<?php } ?>
                </div>
                   <?php 
						if($footer_widgets_disabled!=1) {
					?>
                <br class="clear" />
                <div class="sixteen columns" style="display:none;">
                    <hr class="border-color" />
                </div>
                	<?php } ?>   
        </footer> -->


        <footer class="footer">
            <div class="footer-col">
                <h4 class="page-title--secondary">Ramony Lim</h4>
                <p>Creative Director Freelance</p>
                <p>Paris</p>
            </div>

            <div class="footer-col">
                <h4 class="page-title--secondary">Stay in touch!</h4>
                <p><a href="mailto:hello@ramonylim.com">hello@ramonylim.com</a></p>
                <p>+33 6 76 85 50 04</p>
            </div>

            <div class="footer-col">
                <h4 class="page-title--secondary">Follow me!</h4>
                <p><i class="fa-brands fa-instagram"></i><a href="http://instagram.com/ramony_lim/" target="_blank">@ramony_lim</a></p>
                <p><i class="fa-brands fa-linkedin"></i><a href="https://www.linkedin.com/in/ramony-lim-891b2396/" target="_blank">Ramony Lim</a></p>
            </div>
            <div class="footer-bottom">
                <p>©2022 Ramony Lim - <a href="/mentions-legales">Mentions Légales</a></p>
            </div>
        </footer>
        
    </div> 
    <div class="mobilemenu-wrapper">
        <div class="mobilemenu">
                <i class="mobilemenu-close fa-solid fa-xmark"></i>

                <?php if(!of_get_option('md_header_disable_search')) : ?>
                <form>
                    <input type="text" class="medium" value=""><button type="submit"><i class='icon-search'></i></button>
                </form>
                <?php endif; ?>

                <?php 
                    if(of_get_option('md_header_logo')) { 
                        echo '<a class="mobilemenu-logo" href="'.home_url().'" title="'.get_bloginfo( 'name' ).'"><img src="'.of_get_option('md_header_logo').'" class="" alt="'.get_bloginfo( 'name' ).'"></a>';
                    }elseif(of_get_option('md_header_logo_text')) {
                        echo '<a class="mobilemenu-logo" href="'.home_url().'" class="main-logo" title="drone">'.of_get_option('md_header_logo_text').'</a>';	
                    }else{
                        echo '<a class="mobilemenu-logo" href="'.home_url().'" class="main-logo" title="drone">'.get_bloginfo('name').'</a>';
                    }
                ?>
                
                <?php wp_nav_menu(array(
                            'theme_location' => 'main_menu',
                            'container' => '',
                            'menu_class' => 'mob-nav',
                            'before' => '',
                            'fallback_cb' => ''
                        ));
                ?>  
        </div>
        <div class="mobilemenu-overlay"></div>
    </div>
    
    <a href="#" class="backtotop"></a>
	<div class="ajaxloader"><img src="<?php echo get_template_directory_uri();?>/images/loader.gif" /></div>
<?php 
// ADD ANALYTICS CODE
echo of_get_option('md_footer_googleanalytics');

// ADD SHARING SCRIPTS
echo showshareingpost('','','',1);
?>


<?php
  get_template_part( 'admin', 'custom' );
  wp_footer();
?>

<script src="https://kit.fontawesome.com/e8e51aa74a.js" crossorigin="anonymous"></script>

</body>
</html>

