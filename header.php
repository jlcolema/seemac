<?php  
	global $doctype; 
	global $class; 
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--[if lt IE 7 ]> <html class="ie6" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( $doctype ) ?> > <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( $doctype ) ?> > <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( $doctype ) ?> > <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( $doctype ) ?> > <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( $doctype ) ?> > <!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<title>
	<?php 
		$prefix = false;
		
		 if (function_exists('is_tag') && is_tag()) {
			single_tag_title('Tag Archive for &quot;'); 
			echo '&quot; - '; 
			
			$prefix = true;
		 } elseif (is_archive()) {
			
			wp_title(''); echo ' '.__('Archive',EWF_SETUP_THEME_DOMAIN).' - '; 
			$prefix = true;
			
		 } elseif (is_search()) {
			
			echo __('Search for', EWF_SETUP_THEME_DOMAIN).' &quot;'.wp_specialchars($s).'&quot; - '; 
			$prefix = true;
			
		 } elseif (!(is_404()) && (is_single()) || (is_page())) {
				wp_title(''); 
				echo ' - ';
		 } elseif (is_404()) {
			echo __('Not Found', EWF_SETUP_THEME_DOMAIN).' - ';
		 }
		 
		 if (is_home()) {
			bloginfo('name'); echo ' - '; bloginfo('description');
		 } else {
		  bloginfo('name');
		 }
		 
		 if ($paged > 1) {
			echo ' - page '. $paged; 
		 }
	?>
	</title>
	
	<!-- //////// Favicon ////////  -->
	<link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
	<script type="text/javascript">
		var themePath = '<?php echo get_template_directory_uri(); ?>';
		var themeCufon = '<?php echo get_option( EWF_SETUP_THNAME.'_cufon', 'true'); ?>';
		var themeSliderTimeout = <?php echo get_option( EWF_SETUP_THNAME.'_slider_timeout', '5000'); ?>;
		
		var msg_newsletter_error = '<?php echo __('please enter a valid email...', EWF_SETUP_THEME_DOMAIN); ?>';
		var msg_newsletter_label = '<?php echo __('subscribe to newsletter...', EWF_SETUP_THEME_DOMAIN); ?>';
		
	</script>
	
	<?php wp_head(); ?>
</head>
<body <?php body_class($class); ?>> 
	<div id="wrap">
	
		<noscript>
			<link href="<?php echo get_template_directory_uri(); ?>/style-nojs.css" rel="stylesheet" type="text/css" /> 
			<div class="nojs-warning"><strong><?php _e('JavaScript seems to be Disabled!', EWF_SETUP_THEME_DOMAIN); ?></strong> <?php  _e('Some of the website features are unavailable unless JavaScript is enabled.', EWF_SETUP_THEME_DOMAIN); ?></div>
		</noscript>
		
		<div id="header">
		<!-- ///   HEADER   /////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		
			<div class="row dropdown-container fixed">
			
				<div class="col-220">
				
					<?php 
						if (get_option(EWF_SETUP_THNAME."_logo_text",'true') == 'true'){
							$logo_title = get_option(EWF_SETUP_THNAME."_logo_title", 'Solid');
							
							echo '<h3 class="logo"><a href="'.get_bloginfo('url').'" title="'.__('Back Home', EWF_SETUP_THEME_DOMAIN).'" id="logo" >'.$logo_title.'</a></h3>';
						}else{
							if (get_option(EWF_SETUP_THNAME."_logo_url",null) != null){
								$logo_url = get_option(EWF_SETUP_THNAME."_logo_url");
							}else{
								$logo_url = get_template_directory_uri().'/_layout/images/logo.png';
							}
							
							echo '<a href="'.get_bloginfo('url').'" title="'.__('Back Home', EWF_SETUP_THEME_DOMAIN).'" id="logo"><img src="'.$logo_url.'" alt="" /></a>';
						}
					?>
				
				</div><!-- end .col-220 -->	
				<div class="col-700 last">

					<div class="text-right header-widget">
						<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('header-right') );  ?>
					</div>
					<?php
						$walker = new My_Walker;
						
						wp_nav_menu( array( 
						'theme_location' => 'top-menu',
						'menu_id' => 'dropdown-menu',
						'walker' => $walker			)); 
					?>
				</div><!-- end .col-700 -->	
				
			</div><!-- end .row -->
			
			<div class="hr"></div>

		<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		
		</div><!-- end #header -->
	
