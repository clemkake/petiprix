	 <div class="row" style="background-color: white;">
		 <div class="col-lg-3"></div>
		 <div class="col-lg-6">
			 <marquee behavior="" direction="right">
				 Ouvert de 
				 <b>9h a 18h GMT</b>
					  -- 
				 <b style="color:orange" >Cocody / Yopougon / Plateau / Abobo</b> 
			</marquee>
		 </div>
		 <div class="col-lg-3"></div>
	 </div>
	<header class="menus-opt-sprite menus-locale-in menus-lang-en menus-ssl menus-unrec">
        <div id="menusbar" class="menus-sprite-v1 celwidget menus-bluebeacon menus-packard-glow">
            <div id="menus-belt">
			  <div href="javascript: void(0)" id="nav-hamburger-menu" style="display:none;">
				 <i class="nav-icon-a11y nav-sprite"></i>
			  </div>
                <div class="menus-left mobile-menu-l" style="width: 240px;">
                    <div id="menus-logo">
                        <a href="/" class="menus-logo-link">
							<img src="https://petiprix.com/wp-content/themes/petiprix/assets/img/logo-default.png" style="max-width: 140%;">       
						</a>
                    </div>
					<!-------mobile-sing-up-------->
					<div class="nav-right" style="display: none;">               
					  <a href="/mon-compte" id="nav-logobar-greeting" class="nav-a nav-show-sign-in">Se connecter</a>									  
					  <a href="#" aria-label="Cart" class="nav-a" id="nav-button-cart">
						<div class="nav-cart-empty">
						  <i class="nav-icon nav-sprite"></i>
						  <span class="nav-cart-count">0</span>
						</div>
					  </a>
					</div>
					<!-------mobile-sing-up-------->
					
                </div>
                <div class="menus-right">
                    <div id="menus-swmslot">
					  <div class="row">
					  		<div class="col-lg-10">
								<a href="/promo">
									<?php echo do_shortcode('[pj-news-ticker]');  ?>
								</a>
						    </div>
					  </div>

                    </div>
					
                </div>
                <div class="menus-fill">
                    <div id="menus-search" style="left: 0px; right: 0px;">
                        <div id="menus-bar-left"></div>
                        <form class="menus-searchbar woocommerce-product-search" method="GET" name="site-search" role="search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                            <div class="menus-left">
							   <div id="menus-search-dropdown-card">
								<div class="menus-search-scope menus-sprite">
								 <div class="menus-search-facade">
									 <span class="menus-search-label" style="width: auto;">Recherche</span>
									 <i class="menus-icon"></i>
								 </div>
								 <select class="menus-search-dropdown searchSelect" id="searchDropdownBox">					
											<?php

												$categories = get_categories( array(
												'parent'  => 0
												) );

												$terms = get_terms(['taxonomy' => 'product_cat','hide_empty' => false, 'parent' => 0]);

												foreach ( $terms as $category ) {
													if($category->name == "Uncategorized" || $category->name == "Non classé"){ ?>
														<option selected="selected">Toutes Categories</option>
														<?php  } else {?>
														<option value="<?php echo strtolower($category->name); ?>"><?php echo strtolower($category->name); ?></option>
														<?php }
												}
												?>
										</select>
								</div>
							 </div>
                            </div>
                            <div class="menus-right">
							   <div class="menus-search-submit menus-sprite">
								<span id="menus-search-submit-text" class="menus-search-submit-text menus-sprite">
									Go
								</span>
								<input type="submit" class="menus-input" value="Go">
							  </div>
							</div>
						   <div class="menus-fill">
							   <div class="menus-search-field ">
							 		<input type="search" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" id="twotabsearchtextbox" value="" placeholder="" class="menus-input">
							   </div>
                            </div>
							<input type="hidden" name="post_type" value="product" />
                        </form>
                    </div>
                </div>
            </div>

			<div id="menus-main" class="menus-sprite">
				<div class="menus-left">
					<div id="menus-global-location-slot">
						<span class="a-declarative">
							<a class="menus-a menus-a-2 a-popover-trigger a-declarative" data-toggle="modal" data-target="#zonesModal">
								<div class="menus-sprite" id="menus-packard-glow-loc-icon"></div>
								<div id="glow-ingress-block">
									<span class="menus-line-1" id="glow-ingress-line1">Livraison a</span>
									<span class="menus-line-2" id="glow-ingress-line2"><?php echo $_COOKIE['zones']; ?></span>
								</div>
							</a>
						</span>
					</div>
					<div id="menus-shop">
						<a href="#" class="menus-a menus-a-2" id="menus-link-shopall">
						  <span class="menus-line-1">Achat par</span>
						  <span class="menus-line-2">Categories<span class="menus-icon menus-arrow" style="visibility: visible;"></span>
						  </span>
						</a>
						<!-------mobile-catagory-------->
						<a href="#" class="menus-l" id="menus-li">
						  <span class="menus-line-1">Achat par</span>
						  <span class="menus-line-2">Categories<span class="menus-icon menus-arrow"></span>
						  </span>
						</a>
						<!-------mobile-catagory-------->
						
						<div id="menus-belt">
							<div id="menus-flyout-anchor">
								<div id="menus-flyout-shopAll" class="menus-catFlyout menus-flyout">
									<div class="menus-arrow" style="position: absolute; left: 74.6719px;">
										<div class="menus-arrow-inner"></div>
									</div>
									<div class="menus-template menus-flyout-content menus-tpl-itemList">
										<?php

												$categories = get_categories( array(
												'parent'  => 0
												) );

												$terms = get_terms(['taxonomy' => 'product_cat','hide_empty' => false, 'parent' => 0]);

												foreach ( $terms as $category ) {
													if($category->name == "Uncategorized" || $category->name == "Non classé"){ ?>

														<?php  } else {
															          $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
																	  $image = wp_get_attachment_url( $thumbnail_id );

															?>
															<span class="menus-hasPanel menus-item">
																<span class="menus-text"><?php echo strtolower($category->name); ?></span>
																<!-----------left-submenu------------>
																<div class="menus-template menus-subcat menus-tpl-itemList menus-colcount-2">
																	<img src="<?php echo $image; ?>" class="menus-promo" style="bottom: -14px; right: 0px; width: 100%; height: 432px;">
																	<div class="menus-column menus-column-first">
																		<span class="menus-title menus-item">
																			<span class="menus-text"><?php echo strtolower($category->name); ?></span>
																		</span>
																
																		<div class="menus-panel">
																			<?php  
																				$subid = $category->term_id;
																				$subtaxonomies = array( 
																					'category',
																				);
																				$subargs = array('child_of' => $subid);
																				$subcategories = get_terms( 'product_cat', $subargs);
																				foreach($subcategories as $sub) { ?>
																					<a href="<?php 	echo get_category_link( $sub->term_id ); ?>" class="menus-link menus-item">
																						<span class="menus-text"><?php echo $sub->name;  ?></span>
																						<span class="menus-subtext">(<?php echo $sub->count;  ?>) produits</span>
																					</a> 
																			<?php	}
																				?>

																		</div>
																	</div>
																	<div class="menus-column menus-column-notfirst menus-column-break">
																		<span class="menus-title menus-item"> 
																			<span class="menus-text"></span>
																		</span>
																		<div class="menus-panel">
																			
																		</div>
																	</div>
																</div>
																<!-----------left-submenu------------>
															</span>
															<div class="menus-divider"></div>
														<?php }
												}
										?>

										<a href="/boutique" class="menus-link menus-carat menus-item"> 
											<i class="menus-icon"></i> 
											<span class="menus-text">Toute la Boutique</span>
										</a>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				<div class="menus-right">
					<div id="menus-tools">
						<a href="/mon-compte" class="menus-a menus-a-2" id="menus-link-yourAccount">

							  <span class="menus-line-1">
									  <?php
									    global $current_user;
										wp_get_current_user();
										if ( is_user_logged_in() ) {
											echo 'Bienvenue  '. $current_user->user_login.'!';
										} else {
											echo 'Se connecter';
										}
									?>
								  
							  </span>
							  <span class="menus-line-2">Vos Commandes<span class="menus-icon menus-arrow" style="visibility: visible;"></span>
							  </span>
							  <span class="menus-line-3">Hello! Se connecter</span>
							  <span class="menus-line-4">Vos Commandes</span>
						</a>
						<a href="/panier" class="menus-a menus-a-2" id="menus-cart" in="" items="" tabindex="30">
							<span class="menus-line-1"> </span>
							<span class="menus-line-2">Panier<span class="menus-icon menus-arrow"></span>
							</span>
							<span class="menus-cart-icon menus-sprite"></span>
							<span id="menus-cart-count" class="menus-cart-count menus-cart-0"><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span>
						</a>
					</div>
				</div>
				<div class="menus-fill">
					<div id="menus-xshop-container" class="">
						<div id="menus-xshop">
							<!---<a id="menus-your-amazon" href="#" class="menus-a">Your Amazon.in</a>

							<a href="#" class="menus-a">Today's Deals</a>

							<a href="#" class="menus-a">Amazon Pay</a>

							<a href="#" class="menus-a">Sell</a>--->

							<!-- <a href="#" class="menus-a">Service Client</a> -->

							<h4 class="text-center blink_me text-warning" >
								 <i>PETIPRIX LES ROIS DU DESTOCKAGE</i>
							</h4>

						</div>
					</div>
				</div>
			</div>		
			
        </div>
    </header>
	
	<!-------mobile-menu-------->
		<div id="hmenu-container" class="celwidget nav-sprite-v3 hmenu-visible">
			<div id="hmenu-canvas-background" class="hmenu-dark-bkg-color hmenu-opaque">
			<div class="nav-sprite hmenu-close-icon"></div>
			</div>
		<div id="hmenu-canvas" class="nav-ignore-pinning hmenu-translateX">
			<a id="hmenu-customer-profile-link" href="/mon-compte">
				<div id="hmenu-customer-profile">
					<div id="hmenu-customer-profile-left" class="hmenu-avatar-icon">
						<div id="hmenu-customer-avatar-icon" class="nav-sprite"></div>
					</div>
					<div id="hmenu-customer-profile-right">
						<div id="hmenu-customer-name">Hello! Se connecter
						</div>
					</div>
				</div>
			</a>


			<div id="hmenu-top-section">
				<ul>
					<li><a href="/mon-compte">Compte</a></li>
					<li><a href="/commandes">Vos Commandes</a></li>
					<li><a href="/wishlist">Wishlist</a></li>
				</ul>
			</div>

			<div id="hmenu-content">

				<ul class="hmenu hmenu-visible" data-menu-id="1">

					<li>
						<a href="#" class="hmenu-item"><div>Acceuil</div></a>
					</li>

					<li>
						<a href="#" class="hmenu-item">
							<div>
								Achat par Categories
							</div>
						</a>
					</li>

					<li>
						<a href="#" class="hmenu-item">
							<div>
								Deals d'aujourdhui
							</div>
						</a>
					</li>
					<li class="hmenu-separator"></li>

					<li class="hmenu-separator"></li>

					<li>
						<a href="/mon-compte" class="hmenu-item">
							<div>
								Votre Compte
							</div>
						</a>
					</li>

					<li>
						<a id="hmenu-icp-language" href="#" class="hmenu-item">
							<div>
								<div class="hmenu-icon-container">
									<i class="icon-css-reset icp-nav-globe-img-2 icp-mobile-globe-2"></i>
								</div>
								English
							</div>
						</a>
					</li>

					<li>
						<a href="#" class="hmenu-item">
							<div>
								Service Client
							</div>
						</a>
					</li>

					<li>
						<a href="/mon-compte"	class="hmenu-item">
							<div>
								Se connecter
							</div>
						</a>
					</li>
					<li class="hmenu-separator"></li>
				</ul>

			</div>
		</div>
		</div>
		<!-------mobile-menu-------->
