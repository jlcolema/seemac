<?php get_header(); ?>

	<div id="content">

		<?php
			global $wp_query, $more;
			
			$page_title = null;
			$date = null;
			
			if ($wp_query->is_category == 1 && $wp_query->is_archive == 1) {
				$page_title = __('Category', EWF_SETUP_THEME_DOMAIN).' - '.ucfirst(get_query_var('category_name'));
			}
			
			if ($wp_query->is_category == null && $wp_query->is_archive == 1 && $wp_query->is_month = 1) {
				
				if (get_query_var('monthnum').get_query_var('year') != null ){
					$tmp_date = '1'.'-'.get_query_var('monthnum').'-'.get_query_var('year');
					$date = date('F Y' ,strtotime($tmp_date));					
				}
				
				if (get_query_var('m') != null ){
					$tmp_year = substr(get_query_var('m'), 0, 4);
					$tmp_month = substr(get_query_var('m'), 5, 7);
					
					$tmp_date = '1'.'-'.$tmp_month.'-'.$tmp_year;
					$date = date('F Y' ,strtotime($tmp_date));					
				}
				
				$page_title = __('Archive', EWF_SETUP_THEME_DOMAIN).' - '.$date;
			}
		?>

		<div class="row fixed">
			<?php
			
				$blog_page_id = 0;
				$blog_page = get_option(EWF_SETUP_THNAME."_page_blog", null);
				
				if ($blog_page != null){
					$blog_page = get_page_by_title($blog_page);
					
					if (is_object($blog_page)){
						$blog_page_id = $blog_page->ID;
						}
				}
				
				if ($blog_page_id) {
					$blog_page = get_post($blog_page_id);  
					
					$ewf_header_image_id = ewf_getHeaderImageID($blog_page_id);
					$ewf_header_image = null;
					
					if ($ewf_header_image_id){
						$ewf_header_image = wp_get_attachment_image_src($ewf_header_image_id,'page-header');  
					}
					
					if ($ewf_header_image){
						echo '
						<div class="inner-page-title-container">
							<img src="'.$ewf_header_image[0].'" width="940" height="220" alt="" />
							<div class="inner-page-title fixed">
								<h2>'.$page_title.'</h2>
							</div>
						</div>';
					}else{
						echo '
						<div class="inner-page-title-container">
							<div class="inner-page-title fixed">
								<h2>'.$page_title.'</h2>
							</div>
						</div>';
					}
				}
			
			?>
		</div>
		
		<div class="hr"></div>
		
		<div class="row fixed">
			<div class="col-220">
				<?php
					ewf_setSection('zone-sidebar');
					if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-page') );
				?>
			</div>
			
			<div class="col-700 last">
					<div class="blog-post">
						<?php
						
						$src = null;
						$count = 0;
						
						if ( have_posts() ) while ( have_posts() ) : the_post(); 										
							$count++;
							
							$src .= '<div class="blog-post '.$position[$pair].' fixed '.$post_class_fin.'">';
								
									$image_id = get_post_thumbnail_id($post->ID);  
									if ($image_id>0){
										$src .= '<div class="col-220">';
											$thumb_details = wp_get_attachment_image_src( $image_id ,'column-220-auto');
											$src .= '<img src="'.$thumb_details[0].'" alt="'.get_the_title().'"/>';
										$src .= '</div>';
										
										$src .= '<div class="col-460 last">';
									}
								
									$src .= '<h3><a href="' . get_permalink() . '" rel="bookmark">'.get_the_title($post->ID).'</a></h3>' ;
									
									if ($info == "true"){
										$src .= '<p>'.__('Posted by', EWF_SETUP_THEME_DOMAIN).': <strong>'.get_the_author().'</strong> | '.__('Posted on',EWF_SETUP_THEME_DOMAIN).': <strong>'.get_the_time('F jS, Y').'</strong> | <a href="'.get_comments_link().'">'.get_comments_number().' '.__('Comments', EWF_SETUP_THEME_DOMAIN).'</a></p>';
										}
									
									$more = false;
									$src .= ewf_get_the_content_with_formatting(__('Read More', EWF_SETUP_THEME_DOMAIN));  
									$more = true;
									
									if ($image_id>0){
										$src .= '</div>';
										}
										
							$src .= '</div>';
							
							if ($wp_query->post_count > $count){
								$src .= '<div class="hr"></div>';
							}
					
						endwhile; 
						
						if ($wp_query->found_posts > $wp_query->query_vars['posts_per_page']){
							$src .= ewf_sc_blog_navigation($wp_query->query_vars['posts_per_page'], $wp_query);
							}
							
						echo $src;
						
						?>
					</div>
			</div>
		</div>
		 
	</div>
	
<?php get_footer(); ?>
