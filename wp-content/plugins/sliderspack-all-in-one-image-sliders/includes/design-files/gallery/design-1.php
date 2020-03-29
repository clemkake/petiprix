<?php if($slider_type == 'bxslider') {
	if(!$fancy_box) { ?>
		<div class="bx-slide">
			<?php if (!empty($image_link)) { ?>	
				<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
					<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
				</a>
			<?php } else { ?>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
			<?php }  ?>	
		</div>
	<?php } else { ?>
		<div class="bx-slide">
			<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-bx-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
			</a>
		</div>
	<?php }	
} if($slider_type == 'flexslider') { ?>
	<div class="flex-slide center-img">
		<?php if(!$fancy_box) { ?>
			<?php if (!empty($image_link)) { ?>
				<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
					<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo $image_alt_text; ?>" title="<?php echo esc_attr($image_captions); ?>" />
				</a>
			<?php } else { ?>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />
			<?php }  ?>
		<?php } else { ?>
			<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-flex-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
			</a>
		<?php } if(!empty($image_captions) && $caption == 'true') {	?>
			<div class="flex-caption"><?php echo esc_html($image_captions); ?></div>
		<?php } ?>
	</div>
<?php } if($slider_type == 'owl-slider') { ?>
	<div class="wp-spaios-owl-slide">
		<?php if(!$fancy_box) { ?>
			<?php if (!empty($image_link)) { ?>	
				<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
					<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
				</a>
			<?php } else { ?>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />
			<?php }  ?>
		<?php } else { ?>
			<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-owl-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
			</a>
		<?php } if(!empty($image_captions) && $caption == 'true') {	?>
			<div class="flex-caption"><?php echo esc_html($image_captions); ?></div>
		<?php } ?>
	</div>
<?php } if($slider_type == 'slidesjs') { ?>
	<div class="responsive-slide">
		<?php if(!$fancy_box) { ?>
			<?php if (!empty($image_link)) { ?>	
				<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
					<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
				</a>
			<?php } else { ?>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />
			<?php }  ?>	
		<?php } else { ?>
			<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-slidesjs-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />
			</a>
		<?php } if(!empty($image_captions) && $caption == 'true') {	?>
			<div class="slidejs-caption"><?php echo esc_html($image_captions); ?></div>
		<?php } ?>
	</div>
<?php } if($slider_type == 'nivo-slider') {
	if(!empty($image_captions) && $caption == 'true') { 
		$data_title = $image_captions;
	}else{
		$data_title = '';
	} ?>
	<?php if(!$fancy_box) { ?>
		<?php if (!empty($image_link)) { ?>	
			<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>"  title="<?php echo esc_attr($image_captions); ?>" data-title="<?php echo esc_attr($data_title); ?>" />
			</a>
		<?php } else { ?>
			<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" data-title="<?php echo esc_attr($data_title); ?>" />
		<?php }  ?>	
	<?php } else { ?>
		<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-nivo-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>
			<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>"  title="<?php echo esc_attr($image_captions); ?>" data-title="<?php echo esc_attr($data_title); ?>" />
		</a>
	<?php }
} if($slider_type == '3dslider') { ?>
	<div class="swiper-slide">
		<?php if(!$fancy_box) { ?>
			<?php if (!empty($image_link)) { ?>	
				<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
					<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
				</a>
			<?php } else { ?>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />
			<?php }  ?>
		<?php } else { ?>
			<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-3d-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
			</a>
		<?php } if(!empty($image_captions) && $caption == 'true') {	?>
			<div class="flex-caption swiper-caption"><?php echo esc_html($image_captions); ?></div>
		<?php } ?>
	</div>
<?php } if($slider_type == 'swiperslider') { ?>
	<div class="swiper-slide">	
		<?php if(!$fancy_box) { ?>
			<?php if (!empty($image_link)) { ?>
				<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
					<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
				</a>
			<?php } else { ?>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />	
			<?php } ?>
		<?php } else { ?>
			<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-swiper-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>
				<img src="<?php echo esc_url($image_lsider[0]); ?>"  alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
			</a>
		<?php } if(!empty($image_captions) && $caption == 'true') {	?>
			<div class="flex-caption"><?php echo esc_html($image_captions); ?></div>
		<?php } ?>
	</div>	
<?php } if($slider_type == 'polaroids-gallery') { ?>
	<figure>
		<?php if(!$fancy_box) { ?>
			<?php if (!empty($image_link)) { ?>	
				<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
					<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />
				</a>
			<?php } else { ?>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />
			<?php }  ?>	
		<?php } else { ?>
			<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-polaroids-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />
			</a>
		<?php } ?>
		<?php if(!empty($image_captions) && $caption == 'true') {	?>
			<figcaption>
				<h2 class="photostack-title"><?php echo esc_html($image_captions); ?></h2>							
			</figcaption>
		<?php } ?>	
	</figure>	
<?php } if($slider_type == 'wallop-slider') { ?>
	<div class="Wallop-item">
		<?php if(!$fancy_box) { ?>
			<?php if (!empty($image_link)) { ?>	
				<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
					<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
				</a>
			<?php } else { ?>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />
			<?php }  ?>	
		<?php } else { ?>
			<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-wallop-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
			</a>
		<?php } if(!empty($image_captions) && $caption == 'true') {	?>
			<div class="flex-caption"><?php echo esc_html($image_captions); ?></div>
		<?php } ?>	
	</div>
<?php } if($slider_type == 'un-slider') { ?>
	<li>
		<?php if(!$fancy_box) { ?>
			<?php if (!empty($image_link)) { ?>	
				<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
					<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
				</a>
			<?php } else { ?>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_title); ?>" />
			<?php }  ?>
		<?php } else { ?>
			<a href="<?php echo esc_url($image_lsider[0]); ?>" data-fancybox="gallery-unslider-<?php echo $unique; ?>" data-options='{"loop" : "true", "transitionEffect" : "slide"}'>
				<img src="<?php echo esc_url($image_lsider[0]); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" title="<?php echo esc_attr($image_captions); ?>" />
			</a>
		<?php } if(!empty($image_captions) && $caption == 'true') {	?>
			<div class="flex-caption"><?php echo esc_html($image_captions); ?></div>
		<?php } ?>	
	</li>
<?php }