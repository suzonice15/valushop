
<br>
<div class="container">
	<div class="row">
		<div id="demo" class="carousel slide" data-ride="carousel">

			<!-- Indicators -->
			<ul class="carousel-indicators">
				<?php
				$sliders = get_homeslider();

				if(isset($sliders)) :
				$i=0;
				foreach ($sliders as $slider):?>
				<li data-target="#demo" data-slide-to="<?php echo $i;?>" class="<?php if($i==0){ echo 'active'; }else { echo '';}  ?>"></li>

				<?php $i++;
						endforeach;endif;?>

			</ul>

			<!-- The slideshow -->
			<div class="carousel-inner">
				<?php if(isset($sliders)) :
					$i=0;
					foreach ($sliders as $slider):?>
						<div class="carousel-item <?php if($i==0){ echo 'active'; }else { echo '';}  ?>">

							<img  src='<?php echo base_url();echo $slider->homeslider_banner;?>'  />

						</div>

						<?php $i++;
					endforeach;endif;?>
			</div>

			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>

		</div>

	</div>
</div>
<br/>
<div class="container" style="background-color: white;">
	<div class="row" style="margin-top: 21px;">
		<div class="col-md-2 col-sm-3 col">
			<img src="<?php echo base_url() ?>assets/fontend/watch.jpg">
			<h6>সকল পন্য</h6>
		</div>
		<div class="col-md-2 col-sm-3 col">
			<img src="<?php echo base_url() ?>assets/fontend/watch.jpg">
			<h6>সকল পন্য</h6>
		</div>
		<div class="col-md-2 col-sm-3 col">
			<img src="<?php echo base_url() ?>assets/fontend/watch.jpg">
			<h6>সকল পন্য</h6>
		</div>
		<div class="col-md-2 col-sm-3 col">
			<img src="<?php echo base_url() ?>assets/fontend/watch.jpg">
			<h6>সকল পন্য</h6>
		</div>
		<div class="col-md-2 col-sm-3 col">
			<img src="<?php echo base_url() ?>assets/fontend/watch.jpg">
			<h6>সকল পন্য</h6>
		</div>
		<div class="col-md-2 col-sm-3 col">
			<img src="<?php echo base_url() ?>assets/fontend/watch.jpg">
			<h6>সকল পন্য</h6>
		</div>


	</div>
</div>


<?php

if(isset($home_cat_section)) {
	foreach ($home_cat_section as $home_cat) {
		$catproducts = get_category_products($home_cat, 6);

		$category_info = get_category_info($home_cat);
		$category_title = $category_info->category_title;
		$category_name = $category_info->category_name;


		?>
		<div class="container" style="margin-top: 23px;margin-bottom: -70px;">
			<div class="row"
				 style="border-bottom: 3px solid green;margin-bottom: 2px;margin-left: 1px;margin-right: 1px;">
				<div class="col-md-6">
					<a target="_blank" style="padding: 5px 45px;" class="bg-success  float-left"
					   href="<?php echo $category_name ?>"><?php echo $category_title ?> </a>
				</div>
				<div class="col-md-6">
					<a target="_blank" style="padding: 5px 45px;" class="bg-success float-right "
					   href="<?php echo $category_name ?>">more </a>
				</div>
			</div>
			<div id="demos">

				<?php

				if (isset($catproducts)) {
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
							$featured_image = get_product_meta($product->product_id, 'featured_image');
							$featured_image = get_media_path($featured_image, 'thumb');


							?>
							<!---single product start----->


							<div style="border:3px solid #ddd" class="item">
								<a href="<?php echo base_url();
								echo $product->product_name ?>" id="1148">
									<img class="img-responsive " style="margin: 0 auto;padding:5px"
										 src="<?= $featured_image ?>" title=""
										 alt="">
								</a>


								<div class="pro-desc">
									<div class="text-center">
										<?php
										$_product_title = strip_tags($product->product_title);
										?>

										<a target="_blank" href="<?= $product_link ?>"><?= $_product_title ?></a>
									</div>
									<div class="pro-name">


										<p class="text-center"> Product Code:<?php if (isset($sku)) {
												echo $sku;
											} ?></p>
									</div>
									<div class="clearfix">
										<div class="text-left">
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
							</div>


						<?php }

						}
						?>


						<!---single product end----->

					</div>
				</div>
			</div>
		</div>

		<?php

	}


}

?>


