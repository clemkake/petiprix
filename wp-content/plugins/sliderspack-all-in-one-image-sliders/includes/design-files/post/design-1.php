<?php if($slider_type == 'bxslider') { ?>
	<?php if(!$fancy_box) { ?>
	<div class="bx-slide">
		<?php if (!empty($image_link)) { 
			if($image_lsider) { ?>
				<div class="wp-spaios-img-wrap">
					<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>"><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" /></a>
				</div>
			<?php } 
		} else { ?>
			<?php if($image_lsider) { ?>
				<div class="wp-spaios-img-wrap">
					<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" />
				</div>
			<?php }
		}  ?>
		
	<?php } else { ?>
	<div class="bx-slide">
		<?php if($image_lsider) { ?>
			<div class="wp-spaios-img-wrap">
				<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-bx-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" /></a>
			</div>
		<?php } 
	} ?>
	<?php if ($slide_ptype_cat_name == "true" || $slide_ptype_title == "true" || $slide_ptype_content == "true") { ?>
		<div class="wp-spaios-content-wrp">
			<div class="wp-spaios-content-inner">
				<?php if($slide_ptype_cat_name == "true") { ?>
					<div class="wp-spaios-category">
						<?php echo $cate_name; ?>
					</div>
				<?php } if($slide_ptype_title == "true") { ?>
					<h3 class="wp-spaios-title">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-post-title"><?php echo esc_attr($image_title); ?></a>
					</h3>
				<?php } if($slide_ptype_content == "true" ) { ?>
					<div class="wp-spaios-content">
						<div class="wp-spaios-short-content"><?php echo wp_spaios_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
						<?php if($slide_ptype_readmorebtn == "true") { ?>
							<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-readmorebtn"><?php echo esc_html($read_more_text); ?><i class="fa fa-angle-right"></i></a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	</div>
<?php } if($slider_type == 'flexslider') { 
	if(!$fancy_box) { 
		if (!empty($image_link)) { 
			if($image_lsider) { ?>
				<div class="wp-spaios-img-wrap">
					<a href="<?php echo esc_url($image_link); ?>"  target="<?php echo esc_attr($link_target); ?>"><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
					
				</div>
			<?php } 
		} else { 
		if($image_lsider) { ?>
			<div class="wp-spaios-img-wrap">
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" />
				
			</div>
		<?php } 
		}
	} else {
		if($image_lsider) { ?>
			<div class="wp-spaios-img-wrap">
				<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-flex-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
				
			</div>
		<?php } 
	} ?>
	<?php if ($slide_ptype_cat_name == "true" || $slide_ptype_title == "true" || $slide_ptype_content == "true") { ?>
		<div class="wp-spaios-content-wrp">
			<div class="wp-spaios-content-inner">
				<?php if($slide_ptype_cat_name == "true") { ?>
					<div class="wp-spaios-category">
						<?php echo $cate_name; ?>
					</div>
				<?php } if($slide_ptype_title == "true") { ?>
					<h3 class="wp-spaios-title">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-post-title"><?php echo esc_attr($image_title); ?></a>
					</h3>
				<?php } if($slide_ptype_content == "true" ) { ?>
					<div class="wp-spaios-content">
						<div class="wp-spaios-short-content"><?php echo wp_spaios_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
						<?php if($slide_ptype_readmorebtn == "true") { ?>
							<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-readmorebtn"><?php echo esc_html($read_more_text); ?><i class="fa fa-angle-right"></i></a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
<?php } if($slider_type == 'owl-slider') { ?>
	<div class="wp-spaios-owl-slide">
		<?php if(!$fancy_box) {
			if (!empty($image_link)) {
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>"><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
					</div>
				<?php }
			} else { 
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" />
					</div>
				<?php } 
			} 
		} else { ?>
			<?php if($image_lsider) { ?>
				<div class="wp-spaios-img-wrap">
					<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-owl-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
				</div>
			<?php }
		} ?>
		<?php if ($slide_ptype_cat_name == "true" || $slide_ptype_title == "true" || $slide_ptype_content == "true") { ?>
			<div class="wp-spaios-content-wrp">
			<?php if($slide_ptype_cat_name == "true") { ?>
				<div class="wp-spaios-category">
					<?php echo $cate_name; ?>
				</div>
			<?php } if($slide_ptype_title == "true") { ?>
				<h3 class="wp-spaios-title">
					<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-post-title"><?php echo esc_attr($image_title); ?></a>
				</h3>
			<?php } if($slide_ptype_content == "true" ) { ?>
				<div class="wp-spaios-content">
					<div class="wp-spaios-short-content"><?php echo wp_spaios_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
					<?php if($slide_ptype_readmorebtn == "true") { ?>
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-readmorebtn"><?php echo esc_html($read_more_text); ?></a>
					<?php } ?>
				</div>
			<?php } ?>
			</div>
		<?php } ?>
	</div>
<?php } if($slider_type == 'slidesjs') { ?>
	<div class="responsive-slide">
		<?php if(!$fancy_box) { ?>
			<?php if (!empty($image_link)) {
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>"><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
					</div>
				<?php }
			} else { ?>
				<?php if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" />
					</div>
				<?php }
			}
		} else { 
			if($image_lsider) { ?>
				<div class="wp-spaios-img-wrap">
					<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-slidesjs-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo $image_title; ?>" title="<?php echo $image_title; ?>" /></a>
				</div>
			<?php }
		} ?>
		<?php if ($slide_ptype_cat_name == "true" || $slide_ptype_title == "true" || $slide_ptype_content == "true") { ?>
			<div class="wp-spaios-content-wrp slidejs-caption">
				<?php if($slide_ptype_cat_name == "true") { ?>
					<div class="wp-spaios-category">
						<?php echo $cate_name; ?>
					</div>
				<?php } if($slide_ptype_title == "true") { ?>
					<h3 class="wp-spaios-title">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-post-title"><?php echo esc_attr($image_title); ?></a>
					</h3>
				<?php } if($slide_ptype_content == "true" ) { ?>
					<div class="wp-spaios-content">
						<div class="wp-spaios-short-content"><?php echo wp_spaios_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
						<?php if($slide_ptype_readmorebtn == "true") { ?>
							<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-readmorebtn"><?php echo esc_html($read_more_text); ?></a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
<?php } if($slider_type == 'nivo-slider') {
	if( (!empty($image_excerpt_cont) && $slide_ptype_content == 'true') || ($slide_ptype_cat_name == 'true') || ($slide_ptype_title == 'true') || ($slide_ptype_readmorebtn == 'true') ) {
		$data_title 	= '';
		
		if($slide_ptype_cat_name == "true"){
			$data_title .= "<div class='wp-spaios-category'>". $cate_name ."</div>";
		} if($slide_ptype_title == "true"){
			$data_title .= "<h3 class='wp-spaios-title'><a href=". esc_url($image_link) ." target=" . esc_attr($link_target) ." class='wp-spaios-post-title'>" . esc_attr($image_title) . "</a></h3>";
		} if($slide_ptype_content == "true" ) { 
			$data_title .= "<div class='wp-spaios-content'>";
			$data_title .= "<div class='wp-spaios-short-content'>" . $image_excerpt_cont . "</div>";
			if($slide_ptype_readmorebtn == "true") {
				$data_title .= "<a href=" . esc_url($image_link) ." target=" . esc_attr($link_target) . " class='wp-spaios-readmorebtn'>" . esc_html($read_more_text) ."</a>";
			}
		}
	} else {
		$data_title = '';
	} ?>
	<?php if(!$fancy_box) { ?>
		<?php if (!empty($image_link)) { ?>	
			<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>"><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>"  title="<?php echo esc_attr($image_title); ?>" data-title="<?php echo esc_attr($data_title); ?>" /></a>
		<?php } else { ?>
			<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" data-title="<?php echo esc_attr($data_title); ?>" />
		<?php }  ?>	
	<?php } else { ?>
		<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-nivo-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>"  title="<?php echo esc_attr($image_title); ?>" data-title="<?php echo esc_attr($data_title); ?>" /></a>
	<?php }
} if($slider_type == '3dslider') { ?>
	<div class="swiper-slide">
		<?php if(!$fancy_box) { 
			if (!empty($image_link)) {
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>"><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
					</div>
				<?php } 
			} else {
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" />
					</div>
				<?php }
			}
		} else { 
			if($image_lsider) { ?>
				<div class="wp-spaios-img-wrap">
				<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-3d-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>	<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
				</div>
			<?php } 
		} ?>
		<?php if ($slide_ptype_cat_name == "true" || $slide_ptype_title == "true" || $slide_ptype_content == "true") { ?>
			<div class="wp-spaios-content-wrp">
				<?php if($slide_ptype_cat_name == "true") { ?>
					<div class="wp-spaios-category">
						<?php echo $cate_name; ?>
					</div>
				<?php } if($slide_ptype_title == "true") { ?>
					<h3 class="wp-spaios-title">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-post-title"><?php echo esc_attr($image_title); ?></a>
					</h3>
				<?php } if($slide_ptype_content == "true" ) { ?>
					<div class="wp-spaios-content">
						<div class="wp-spaios-short-content"><?php echo wp_spaios_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
						<?php if($slide_ptype_readmorebtn == "true") { ?>
							<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-readmorebtn"><?php echo esc_html($read_more_text); ?></a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
<?php } if($slider_type == 'swiperslider') { ?>
	<div class="swiper-slide">
		<?php if(!$fancy_box) { 
			if (!empty($image_link)) { 
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>"><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
					</div>
				<?php } 
			} else { 
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="slider image" />
					</div>
				<?php } 
			} ?>
			<?php if ($slide_ptype_cat_name == "true" || $slide_ptype_title == "true" || $slide_ptype_content == "true") { ?>
				<div class="wp-spaios-content-wrp">
					<?php if($slide_ptype_cat_name == "true") { ?>
						<div class="wp-spaios-category">
							<?php echo $cate_name; ?>
						</div>
					<?php } if($slide_ptype_title == "true") { ?>
						<h3 class="wp-spaios-title">
							<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-post-title"><?php echo esc_attr($image_title); ?></a>
						</h3>
					<?php } if($slide_ptype_content == "true" ) { ?>
						<div class="wp-spaios-content">
							<div class="wp-spaios-short-content"><?php echo wp_spaios_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
							<?php if($slide_ptype_readmorebtn == "true") { ?>
								<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-readmorebtn"><?php echo esc_html($read_more_text); ?></a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		<?php } else { 
			if($image_lsider) { ?>
				<div class="wp-spaios-img-wrap">
					<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-swiper-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="slider image"/></a>
				</div>
			<?php } ?>	
			<?php if ($slide_ptype_cat_name == "true" || $slide_ptype_title == "true" || $slide_ptype_content == "true") { ?>
				<div class="wp-spaios-content-wrp">
					<?php if($slide_ptype_cat_name == "true") { ?>
						<div class="wp-spaios-category">
							<?php echo $cate_name; ?>
						</div>
					<?php } if($slide_ptype_title == "true") { ?>
						<h3 class="wp-spaios-title">
							<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-post-title"><?php echo esc_attr($image_title); ?></a>
						</h3>
					<?php } if($slide_ptype_content == "true" ) { ?>
						<div class="wp-spaios-content">
							<div class="wp-spaios-short-content"><?php echo wp_spaios_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
							<?php if($slide_ptype_readmorebtn == "true") { ?>
								<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-readmorebtn"><?php echo esc_html($read_more_text); ?></a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
<?php } if($slider_type == 'polaroids-gallery') { ?>
	<figure>
		<?php if(!$fancy_box) {
			if (!empty($image_link)) {
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>"><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
					</div>
				<?php }
			} else {
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" />
					</div>
				<?php } 
			}
		} else { ?>
			<?php if($image_lsider) { ?>
				<div class="wp-spaios-img-wrap">
					<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-polaroids-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
				</div>
			<?php } 
		} ?>
		<?php if ( $slide_ptype_cat_name == "true" || $slide_ptype_title == "true" ) { ?>
			<div class="wp-spaios-content-wrp">
				<?php if($slide_ptype_cat_name == "true") { ?>
					<div class="wp-spaios-category">
						<?php echo $cate_name; ?>
					</div>
				<?php } if($slide_ptype_title == "true") { ?>
					<h3 class="wp-spaios-title">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-post-title"><?php echo esc_attr($image_title); ?></a>
					</h3>
				<?php } ?>
			</div>
		<?php } ?>
	</figure>
<?php } if($slider_type == 'wallop-slider') { ?>
	<div class="Wallop-item">
		<?php if(!$fancy_box) { 
			if (!empty($image_link)) { 
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>"><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
					</div>
				<?php } 
			} else { 
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" />
					</div>
				<?php }
			}
		} else { 
			if($image_lsider) { ?>
				<div class="wp-spaios-img-wrap">
					<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-wallop-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>	<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
				</div>
			<?php } 
		} ?>
		<?php if ($slide_ptype_cat_name == "true" || $slide_ptype_title == "true" || $slide_ptype_content == "true") { ?>
			<div class="wp-spaios-content-wrp">
				<?php if($slide_ptype_cat_name == "true") { ?>
					<div class="wp-spaios-category">
						<?php echo $cate_name; ?>
					</div>
				<?php } if($slide_ptype_title == "true") { ?>
					<h3 class="wp-spaios-title">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-post-title"><?php echo esc_attr($image_title); ?></a>
					</h3>
				<?php } if($slide_ptype_content == "true" ) { ?>
					<div class="wp-spaios-content">
						<div class="wp-spaios-short-content"><?php echo wp_spaios_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
						<?php if($slide_ptype_readmorebtn == "true") { ?>
							<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-readmorebtn"><?php echo esc_html($read_more_text); ?></a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>	
<?php } if($slider_type == 'un-slider') { ?>
	<li>
		<?php if(!$fancy_box) { 
			if (!empty($image_link)) { 
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>"><img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
					</div>
				<?php }
			} else { 
				if($image_lsider) { ?>
					<div class="wp-spaios-img-wrap">
						<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" />
					</div>
				<?php }
			} 
		} else { ?>
			<?php if($image_lsider) { ?>
				<div class="wp-spaios-img-wrap">
					<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-unslider-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>	<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" title="<?php echo esc_attr($image_title); ?>" /></a>
				</div>
			<?php } 
		} ?>
		<?php if ($slide_ptype_cat_name == "true" || $slide_ptype_title == "true" || $slide_ptype_content == "true") { ?>
			<div class="wp-spaios-content-wrp">
				<?php if($slide_ptype_cat_name == "true") { ?>
					<div class="wp-spaios-category">
						<?php echo $cate_name; ?>
					</div>
				<?php } if($slide_ptype_title == "true") { ?>
					<h3 class="wp-spaios-title">
						<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-post-title"><?php echo esc_attr($image_title); ?></a>
					</h3>
				<?php } if($slide_ptype_content == "true" ) { ?>
					<div class="wp-spaios-content">
						<div class="wp-spaios-short-content"><?php echo wp_spaios_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
						<?php if($slide_ptype_readmorebtn == "true") { ?>
							<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>" class="wp-spaios-readmorebtn"><?php echo esc_html($read_more_text); ?></a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>	
		<?php } ?>
	</li>
<?php }