
<div class="container-fluid">
	<div class="row no-padding">
		<div class="slider">

			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php
					$sliders = get_homeslider();


					if(isset($sliders)) :
						$i=0;
						foreach ($sliders as $slider):?>
							<li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" class="<?php if($i==0){ echo 'active'; }else { echo '';}  ?>"></li>

							<?php $i++;
						endforeach;endif;?>


				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php if(isset($sliders)) :
						$i=0;
						foreach ($sliders as $slider):?>
							<div class="item <?php if($i==0){ echo 'active'; }else { echo '';}  ?>">

								<img  src='<?php echo base_url();echo $slider->homeslider_banner;?>' width="100%" height="10px" />

							</div>

							<?php $i++;
						endforeach;endif;?>

					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

			</div>
		</div>

	</div>
</div>

<!--content area start-->

<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12  col-xs-12 mobile-border-of"
			 style="background: #fff;padding: 5px;">
			<h4 class="cat-title" style="margin-bottom: 5px !important;">প্রোডাক্ট ক্যাটেগরীজ</h4>



			<?php
			$html = null;
			$result = get_result("SELECT * FROM `category` where  parent_id=0 ORDER BY rank_order DESC");
			if (isset($result)) {


				foreach ($result as $row) {

					?>
						<a class="btn btn-success"  style="margin: 2px;background: green; font-size: 12px;" href="<?php echo base_url($row->category_name) ?>">
                                   <?php echo $row->category_title;?>

						</a>


				<?php } } ?>





		</div>
	</div>
</div>
<!--content area start-->

<style>
	.freepeoduct   {
		background-image: url(https://static.ajkerdeal.com/images/flash-deal-percentage.png);
		background-repeat: no-repeat;
		width: 43px!important;
		height: 43px!important;
		overflow: hidden!important;
		text-align: center!important;
		float: right!important;
		padding: 5px!important;
		border-radius: 50px!important;
		color: white!important;
		font-size: 10px!important;
		z-index: 99999999;
		position: absolute;
		right: 0;
		top: 0px;
	}

</style>

<style>
	@media screen and (max-width: 767px) {
		.owl-nav{
			display: none;
		}
		.price-text {

			font-weight: 600;
			display: inline-block;
			font-size: 10px !important;
			color: #fff;
			position: absolute;
			bottom: 2px!important;
			float: left;
			background-color: #0089cf;
			height: 16px !important;
			border-top-left-radius: 60px;
			border-bottom-left-radius: 60px;
			width: 73px !important;
			text-align: center;
			right: 0;
		}
		.percentage-span-new {
			background-image: url(./image/flash-deal-percentage.png);
			background-repeat: no-repeat;
			width: 35px !important;
			height: 35px !important;
			position: absolute !important;
			bottom: 0 !important;
			left: 1px !important;
			background-size: 34px 34px !important;
			text-align: center !important;
			color: #fff !important;
			font-weight: 500 !important;
			font-size: 10px !important;
			z-index: 2;
		}
		.percentage-amount-new {
			font-size: 11px !important;;
			font-weight: 500;
			padding-left: 8px !important;;
			padding-top: 9px !important;;
			line-height: 1;
			display: inline;
		}
		.percentage-sign-new {
			font-size: 9px !important;;
			padding-top: 8px !important;;
		}
		.percentage-discount-amount-new {
			display: inline;
			width: 100%;
			font-size: 8px !important;;
			padding: 0 !important;
			margin: 0 !important;
			line-height: 5px ;
		}
	}
	.owl-next{
		outline: none;
	}

	.product {

	}
	.owl-nav {
		position: absolute;
		top: 39%;
		height: 0;
		font-size: 29px;
		width: 100%;
	}
	.owl-prev{
		display: none;
	}
	.owl-next{
		position: absolute;
		right: -30px
	}
	.percentage-span-new {
		background-image: url(./image/flash-deal-percentage.png);
		background-repeat: no-repeat;
		width: 45px;
		height: 45px;
		position: absolute;
		bottom: 0;
		left: 5px;
		background-size: 44px 44px;
		text-align: center;
		color: #fff;
		font-weight: 700;
		font-size: 12px;
		z-index: 2;
	}
	.percentage-amount-new, .percentage-discount-amount-new, .percentage-sign-new {
		font-family: SolaimanLipi,Helvetica,Verdana,'Noto Sans Bengali';
		color: #fff;
		float: left;
	}

	.percentage-amount-new {
		font-size: 15px;
		font-weight: 700;
		padding-left: 11px;
		padding-top: 9px;
		line-height: 1;
		display: inline;
	}
	.percentage-sign-new {
		font-size: 11px;
		padding-top: 10px;
	}
	.percentage-discount-amount-new {
		display: inline;
		width: 100%;
		font-size: 10px;
		padding: 0 !important;
		margin: 0 !important;
		line-height: 7px;
	}

	.price-text {
		font-weight: 600;
		display: inline-block;
		font-size: 16px;
		color: #fff;
		position: absolute;
		bottom: 10px;
		float: left;
		background-color: #0089cf;
		height: 23px;
		border-top-left-radius: 60px;
		border-bottom-left-radius: 60px;
		width: 89px;
		text-align: center;
		right: 0;
	}
</style>

<div class="container-fluid" >



	<div class="row" style="margin-top:20px">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  mobile-border-of" style="background: rgb(255, 239, 207);padding: 5px;">
			<a href="#"><img style="width: 100px;margin-left:6px" src="https://static.ajkerdeal.com/images/deals/flash/hot-deal-logo.gif" title="kalerhaat.com" ></a>
			<a href="<?php echo base_url()?>/hotdeals" class="pull-right"><img src="https://static.ajkerdeal.com/images/bangla.svg" style="margin-top: 6px;
margin-right: 6px;" width="120" align="middle"></a>

			<div class="col-lg-12 col-md-12 col-sm-12  col-xs-12" style="background: rgb(255, 239, 207);padding: 0px;margin-bottom: 20px;padding-top: 15px  " >
				<div class="slider">
					<ul class="product-category owl-carousel nav">

						<?php


						if($products_two)
						{
							foreach($products_two as $prod)
							{
								$product_link = base_url($prod->product_name);

								$product_availability = NULL;
								$stock_qty =$prod->product_stock;

								if(!$stock_qty)
								{
									$product_availability = '<div class="availability">Out of Stock</div>';
								}
								elseif($stock_qty<=3)
								{
									$product_availability = '<div class="availability">Limited Stock</div>';
								}


								$discount = false;

								$product_price = $sell_price = $prod->product_price;

								$product_discount = $prod->discount_price;
								$discount_type = $prod->discount_type;

								if($product_discount != 0)
								{
									$discount = true;

									$product_discount = $save_money = floatval($product_discount);

									if($discount_type == 'fixed')
									{
										$sell_price = ($product_price - $product_discount);
									}
									elseif($discount_type == 'percent')
									{
										$save_money = ($product_discount / 100) * $product_price;
										$sell_price = floatval($product_price - $save_money);
									}
								}

								$_product_title = strip_tags($prod->product_title);
								$featured_image=get_product_meta($prod->product_id, 'featured_image');
								$featured_image=get_media_path($featured_image, 'thumb');


								?>

								<li  style=" border: 1px solid #e80a0a;" class="product">
									<a href="<?=$product_link?>">
										<?php
										if($product_discount != 0)
										{
											$discount = true;

											$product_discount = $save_money = floatval($product_discount);

											if($discount_type == 'fixed')
											{
												$sell_price = ($product_price - $product_discount);

												?>
												<div  class="freepeoduct">৳ <?=ceil($product_discount)?> ???</div>
												<?php
											}
											elseif($discount_type == 'percent')
											{
												$save_money = ($product_discount / 100) * $product_price;
												$sell_price = floatval($product_price - $save_money);


												?>
												<div class="freepeoduct" > <?=ceil($save_money)?> ছাড়</div>
												<?php

											}
										}
										?>
										<span class="price-text">										<?=formatted_price($sell_price)?>
</span>
										<img src="<?=$featured_image?>" title="<?=$_product_title?>" alt="<?=$_product_title?>"/>
									</a>
								</li>

								<?php
							}
						}
						?>



					</ul>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12  col-xs-12" style="background: rgb(255, 239, 207);padding: 0px;margin-bottom: 20px;padding-top: 15px  " >
				<div class="slider">
					<ul class="product-category owl-carousel nav">

						<?php



						if($products_one)
						{
							foreach($products_one as $prod)
							{
								$product_link = base_url($prod->product_name);

								$product_availability = NULL;
								$stock_qty =$prod->product_stock;

								if(!$stock_qty)
								{
									$product_availability = '<div class="availability">Out of Stock</div>';
								}
								elseif($stock_qty<=3)
								{
									$product_availability = '<div class="availability">Limited Stock</div>';
								}


								$discount = false;

								$product_price = $sell_price = $prod->product_price;

								$product_discount = $prod->discount_price;
								$discount_type = $prod->discount_type;

								if($product_discount != 0)
								{
									$discount = true;

									$product_discount = $save_money = floatval($product_discount);

									if($discount_type == 'fixed')
									{
										$sell_price = ($product_price - $product_discount);
									}
									elseif($discount_type == 'percent')
									{
										$save_money = ($product_discount / 100) * $product_price;
										$sell_price = floatval($product_price - $save_money);
									}
								}

								$_product_title = strip_tags($prod->product_title);
								$featured_image=get_product_meta($prod->product_id, 'featured_image');
								$featured_image=get_media_path($featured_image, 'thumb');

								?>

								<li style=" border: 1px solid #e80a0a;" class="product">
									<a href="<?=$product_link?>">
										<?php
										if($product_discount != 0)
										{
											$discount = true;

											$product_discount = $save_money = floatval($product_discount);

											if($discount_type == 'fixed')
											{
												$sell_price = ($product_price - $product_discount);

												?>
												<div  class="freepeoduct">৳ <?=ceil($product_discount)?> ছাড়</div>
												<?php
											}
											elseif($discount_type == 'percent')
											{
												$save_money = ($product_discount / 100) * $product_price;
												$sell_price = floatval($product_price - $save_money);


												?>
												<div class="freepeoduct" >? <?=ceil($save_money)?> ছাড়</div>
												<?php

											}
										}
										?>
										<span class="price-text">										<?=formatted_price($sell_price)?>
</span>
										<img src="<?=$featured_image?>" title="<?=$_product_title?>" alt="<?=$_product_title?>" />
									</a>
								</li>

								<?php
							}
						}
						?>



					</ul>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
foreach ($home_cat_section as $home_cat){
	$catproducts = get_category_products($home_cat, 6);

	$category_info = get_category_info($home_cat);
	$category_title = $category_info->category_title;
	$category_name = $category_info->category_name;


	?>
	<div class="container-fluid" style="margin-top: 23px;margin-bottom: -70px;" >
		<div class="category-tabs"> <a target="_blank" class="parent" href="<?php echo $category_name ?>"><?php echo $category_title ?> </a> <a target="_blank" class="view-more-product pull-right" href="<?php echo $category_name ?>">More <span></span></a> </div>
		<div id="demos" class="row">
<?php

					if(isset($catproducts)) {
						?>
			<div class="large-12 columns">
				<div class="owl-carousel owl-theme">
					<?php


						foreach ($catproducts as $product) {

							$product_link = base_url($product->product_name);

							$product_availability = NULL;
							$stock_qty = $product->product_stock;
							if (!$stock_qty) {
								$product_availability = '<div class="availability">Out of Stock</div>';
							} elseif ($stock_qty <= 3) {
								$product_availability = '<div class="availability">Limited Stock</div>';
							}

							// product price and discount
							$discount = false;

							$product_price = $sell_price = $product->product_price;

							$sku = $product->sku;
							$product_discount = $product->discount_price;
							$discount_type = $product->discount_type;

							if ($product_discount != 0) {
								$discount = true;

								$product_discount = $save_money = floatval($product_discount);

								if ($discount_type == 'fixed') {
									$sell_price = ($product_price - $product_discount);
								} elseif ($discount_type == 'percent') {
									$save_money = ($product_discount / 100) * $product_price;
									$sell_price = floatval($product_price - $save_money);
								}
							}
							$featured_image=get_product_meta($prod->product_id, 'featured_image');
							$featured_image=get_media_path($featured_image, 'thumb');



							?>
							<div class="item">
								<a href="<?php echo base_url();
								echo $product->product_name ?>" id="1148">
									<img class="img-responsive " style="margin: 0 auto;padding:5px"
										 src="<?=$featured_image ?>" title="<?php echo $product->product_title ?>"
										 alt="<?php echo $product->product_title ?>">
								</a>


								<div class="pro-desc">
									<div class="pro-name">
										<?php
										$_product_title = strip_tags($product->product_title);
										//if(strlen($_product_title) >= 25){ $_product_title = substr($_product_title, 0, 22).'...'; }
										?>

										<a target="_blank" href="<?= $product_link ?>"><?= $_product_title ?></a>
									</div>
									<div class="pro-name">
										<?php
										//if(strlen($_product_title) >= 25){ $_product_title = substr($_product_title, 0, 22).'...'; }
										?>

										<p> Product Code:<?php if (isset($sku)) {
												echo $sku;
											} ?></p>
									</div>
									<div class="clearfix">
										<div class="price bn">
											<?php
											if ($discount == true) {
												?>
												<del>
												<?= formatted_price($product_price) ?>
												</del><?php
											}
											?>

											<?= formatted_price($sell_price) ?>
										</div>
									</div>
								</div>


								<div class="add-btn-box">
									<?php
									if ($stock_qty) {
										?><a href="javascript:void(0)" class="add_to_cart"
											 data-product_id="<?= $product->product_id ?>"
											 data-product_price="<?= $sell_price ?>"
											 data-product_title="<?= $product->product_title ?>">
											<span class="btn btn-success ">Add to Cart</span>
										</a>
									<a href="javascript:void(0)" class="buy_now"
									   data-product_id="<?= $product->product_id ?>"
									   data-product_price="<?= $sell_price ?>"
									   data-product_title="<?= $product->product_title ?>">
											<span class="btn btn-success "> Order Now</span>
										</a><?php
									} else {
										?><a href="<?= $product_link ?>">
											<span class="btn btn-success ">Add to Cart</span>
										</a>
									<a href="<?= $product_link ?>">
											<span class="btn btn-success "> Order Now</span>
										</a><?php
									}
									?>
								</div>

							</div>

						<?php }

					}
					?>


				</div>
			</div>
		</div>
	</div>

	<br/>
	<br/>
	<br/>

	<?php

} ?>


