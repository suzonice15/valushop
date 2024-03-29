<br>
<div class="container">
	<div class="row">
		<div id="demo" class="carousel slide" data-ride="carousel">

			<!-- Indicators -->
			<ul class="carousel-indicators">
				<?php
				$sliders = get_homeslider();

				if (isset($sliders)) :
					$i = 0;
					foreach ($sliders as $slider):?>
						<li data-target="#demo" data-slide-to="<?php echo $i; ?>" class="<?php if ($i == 0) {
							echo 'active';
						} else {
							echo '';
						} ?>"></li>

						<?php $i++;
					endforeach;endif; ?>

			</ul>

			<!-- The slideshow -->
			<div class="carousel-inner">
				<?php if (isset($sliders)) :
					$i = 0;
					foreach ($sliders as $slider):?>
						<div class="carousel-item <?php if ($i == 0) {
							echo 'active';
						} else {
							echo '';
						} ?>">

							<img src='<?php echo base_url();
							echo $slider->homeslider_banner; ?>'/>

						</div>

						<?php $i++;
					endforeach;endif; ?>
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
	<h2 class="text-center"> প্রোডাক্ট ক্যাটাগরি </h2>
	<div class="row" style="margin-top: 21px;">
		<?php
		if (isset($products_category)) {

			foreach ($products_category as $product) {
				if ($product->media_path) {
					?>

					<div class="col-md-2 col-sm-3 col">
						<a href="<?php echo base_url();
						echo $product->category_name; ?>">

							<img class="img-fluid" src="<?php echo base_url();
							echo $product->media_path; ?>">
						</a>
						<a href="<?php echo base_url();
						echo $product->category_name; ?>">
							<h6 class="btn btn-outline-info col"><?= $product->category_title; ?></h6>
						</a>

					</div>
				<?php } else { ?>
					<div class="col-md-2 col-sm-3 col">
						<a href="<?php echo base_url();
						echo $product->category_name; ?>">
							<img class="img-fluid" src="<?php echo base_url() ?>assets/fontend/watch.jpg">
						</a>
						<a href="<?php echo base_url();
						echo $product->category_name; ?>">
							<h6 class="btn btn-outline-info   col"><?= $product->category_title ?></h6>
						</a>
					</div>

					<?php
				}
			}

		}
		?>


	</div>
</div>


<?php

if (isset($home_cat_section)) {
	foreach ($home_cat_section as $home_cat) {
		$catproducts = get_category_products($home_cat, 8);

		$category_info = get_category_info($home_cat);
		if (isset($category_info->category_title)) {
			$category_title = $category_info->category_title;

		}
		if (isset($category_info->category_name)) {
			$category_name = $category_info->category_name;


		}


		?>
		<div class="container" style="margin-top: 23px;margin-bottom: -19px;">
			<div class="row"
				 style="border-bottom: 3px solid green;margin-bottom: 2px;margin-left: 1px;margin-right: 1px;">
				<div class="col-md-6">
					<a target="_blank" style="padding: 5px 49px;
margin-left: -15px;" class="bg-success text-decoration-none float-left text-light"
					   href="<?php echo $category_name; ?>"><?php echo $category_title; ?> </a>
				</div>

				<div class="col-md-6">
					<a target="_blank" style="padding: 5px 17px;
margin-right: -15px;" class="bg-success float-right text-decoration-none  text-light "
					   href="<?php echo $category_name ?>">More </a>
				</div>

			</div>
			<div id="demos">

				<?php

				if (isset($catproducts)) {
				?>
				<div class="large-12 columns">
					<div class="owl-carousel owl-theme">

						<?php
						$i = 0;

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


							<div style="border:3px solid #ddd;height:277px" class="item mh-100">
								<a href="<?php echo base_url();
								echo $product->product_name ?>" id="1148">
									<img class="img-responsive " style="margin: 0 auto;padding:5px"
										 src="<?= $featured_image ?>" title=""
										 alt="">
								</a>
								<div class="text-center text-danger font-weight-bold">
									<?php
									if ($discount == true) {
										?>
										<del>
										<?= formatted_price($product_price) ?>
										</del><?php
									}
									?>
								</div>

								<div class="text-center font-weight-bold text-success ">

									<?= formatted_price($sell_price) ?>
								</div>

								<div class="text-center">
									<?php
									$_product_title = strip_tags($product->product_title);
									?>

									<a target="_blank" class="text-decoration-none"
									   href="<?= $product_link ?>"><?= $_product_title ?></a>
								</div>
							</div>

							<?php						}
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

<span class="home_cat_content"></span>

