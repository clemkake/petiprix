
jQuery(document).ready(function($)
	{

		//$(".wcps-items .add_to_cart_button").wrap("<div class='cart-area' ></div>");




		//$('.wcps-items-cart p').prepend('<input value="1" class="quantity" type="number"> ');





        $(document).on('change', '.wcps-items-cart .quantity', function(){

            quantity = $(this).val();

            console.log(quantity);
            $(this).next().attr('data-quantity', quantity);

        })







		$(document).on('click', '.wcps-zoom-colse', function()
			{
				
				$(this).parent().fadeOut();
				
				})


		$(document).on('click', '.wcps-zoom', function()
			{	
				
				var slider_id = $(this).attr('slider-id');				
				var product_id = $(this).attr('product-id');
				
				//alert(product_id);
				
				jQuery.ajax(
					{
					type: 'POST',
					context:this,
					url: wcps_ajax.wcps_ajaxurl,
					data: {"action": "wcps_get_item_thumb_url","product_id":product_id},
					success: function(data)
							{	
								//alert(data);
								jQuery('.wcps-zoom-thumb-'+slider_id).fadeIn();								
								jQuery('.wcps-zoom-thumb-'+slider_id+' img').attr('src',data);

							}
					});
				
				
				
				
				
			})






	});	







