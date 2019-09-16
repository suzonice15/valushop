<?php
$product_link = base_url($prod_row->product_name);
$featured_image = get_product_thumb($prod_row->product_id);
$product_video = $prod_row->product_video;
$sku = $prod_row->sku;


/*# product category #*/
$product_cat = null;
$product_cats = get_result("SELECT term_id FROM term_relation WHERE product_id=$prod_row->product_id");
if (count($product_cats) > 0) {
	foreach ($product_cats as $pcat) {
		$product_cat[] = $pcat->term_id;
	}
	$product_cats = implode(",", $product_cat);
}


/*# product stock availability #*/
$stock_qty = $prod_row->product_stock;
$product_availability = '<span class="text-success">ইন স্টক</span>';
$product_availability_index = 'in-stock';
if (!$stock_qty) {
	$product_availability = '<span class="text-danger">স্টক শেষ</span>';
	$product_availability_index = 'out-of-stock';
}


/*# product price and discount #*/
$discount = false;

$product_price = $sell_price = $prod_row->product_price;

$product_discount = $prod_row->discount_price;
$discount_type = $prod_row->discount_type;

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


?>
<style>
	.large_picture{
		width:300px;
		height:300px;
	}
	.picbig{
		position: absolute;
		width:0px;
		-webkit-transition:width 0.3s linear 0s;
		transition:width 0.3s linear 0s;
		z-index:10;
	}
	.large_picture:hover + .picbig{
		width:500px;
		height:350px;
	}
</style>

<nav class="bg-dark">
	<ol class="breadcrumb">
		<li class="breadcrumb-item text-decoration-none"><a href="<?php echo base_url() ?>">Home</a></li>
		<li class="breadcrumb-item active"><a href="<?php echo base_url()?><?=$breadcumb_category_link?>">			<?=$breadcumb_category?>
			</a></li>
		<li class="breadcrumb-item active"><?= $prod_row->product_title ?></li>
	</ol>
</nav>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-12">

			<img    id="ordinal_galary_image" class="img-fluid  large_picture col-12  " src="<?= $featured_image ?>"/>
			<img class="picbig " src="<?= $featured_image ?>" alt="heart">


			<ul class="gelary_image_list mt-2" >
				<li><img  class="ordinal_galary_image" width="50"  height="50" src="<?=$featured_image?>"/></li>
<?php
				$gallery_image_meta = get_product_meta($prod_row->product_id, 'gallery_image');
$gallery_image=explode(",",$gallery_image_meta);
$gallery_image=explode(",", $gallery_image_meta);

				if(count($gallery_image)>0)
				{
				foreach($gallery_image as $gallery_id)
				{
				$gallery=get_media_path($gallery_id);

				?>
				<li><img  class="ordinal_galary_image" width="50"  height="50" src="<?=$gallery?>"/></li>

					<?php
				}
				}
?>


			</ul>
		</div>
		<div class="col-md-5 col-12">

			<h4><?php if (isset($page_title)) {
					echo $page_title;
				} ?></h4>
			<h5>মূল্য : <?php
				if ($discount == true) {
					?>
					<del class="text-danger"><?= formatted_price($product_price) ?></del><?php
				}
				?>
				<strong class="text-success"> <?= formatted_price($sell_price) ?> </strong>


			</h5>
			<p class="btn btn-info">প্রোডাক্ট কোড: <?php if (isset($sku)) {
					echo $sku;
				} ?> </p>
			<p>স্টক: <?= $product_availability ?></p>
			<div class="col-md-8">
				<div class="input-group">
				<span class="input-group-btn">

											পরিমান:
                                        <button type="button"  style="height: 39px;" class="quantity-left-minus btn btn-danger btn-number"
												data-type="minus" data-field="">
                                         <i class="fa fa-fw fa-minus"></i>
                                        </button>
                                    </span>
					<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1"
						   min="1" max="100">
					<span class="input-group-btn">
                                        <button type="button" style="height: 39px;"  class="quantity-right-plus btn btn-success btn-number"
												data-type="plus" data-field="">
                                          <i class="fa fa-fw fa-plus"></i>
                                        </button>
                                    </span>
				</div>

			</div>

			<div class="col-md-8 mt-2 col-12">
				<a href="javascript:void(0)" class="btn btn-primary  btn-block add_to_cart"
				   data-product_id="<?= $prod_row->product_id ?>" data-product_price="<?= $sell_price ?>"
				   data-product_title="<?= $prod_row->product_title ?>">
					<span class="glyphicon glyphicon-shopping-cart"></span>
					কার্ট -এ যোগ করুন </a>
			</div>

			<div class="col-md-8 mt-2 col-12">
				<a href="javascript:void(0)" class="btn btn-success btn-block buy_now"
				   data-product_id="<?= $prod_row->product_id ?>" data-product_price="<?= $sell_price ?>"
				   data-product_title="<?= $prod_row->product_title ?>">
					অর্ডার করুন </a>
			</div>

			<div class=" col-md-12 col-sm-12 col-xs-12" style="padding:0">

				<h4 style="font-weight:bold;color:red"> ফোনে অর্ডারের জন্য ডায়াল করুন</h4>
				<div class="col-sm-6 col-xs-12" style="padding:0">
					<h4 style="font-size:20px;margin: 15px 0 15px 0;text-align:center;color:red;font-weight:900;text-align: left">
						<?= get_option('phone_order') ?>

					</h4>
				</div>

				<div class="col-sm-6 col-md-11 col-11" style="padding:0">

					<a href="#" style="margin-top:10px" class="btn btn-primary  float-left" data-sshare="facebook"
					   data-url="https://www.jqueryscript.net"><i class="fa fa-facebook"></i> Share on Facebook</a>

					<a href="tel:<?php echo get_option('phone'); ?>">
						<img class="float-right" style="width: 200px;cursor: pointer"
							 src="http://www.egbazar.com/front_asset/Button_call.gif">
					</a>
				</div>

				<table class="table table-bordered">
					<tbody>
					<tr>
						<td>
							ঢাকা সিটির ভীতরে ডেলিভারি চার্জ

						</td>
						<td>
							<b>    <?= get_option('shipping_charge_in_dhaka') ?> টাকা</b>
						</td>
					</tr>
					<tr>
						<td>
							ঢাকা সিটির বাহীরে হলে অগ্রিম ডেলিভারি চার্জ
						</td>
						<td>
							<b>                                        <?= get_option('shipping_charge_out_of_dhaka') ?>
								টাকা
							</b>
						</td>
					</tr>
					<tr>
						<td>
							বিকাশ মার্চেন্ট নাম্বার
						</td>
						<td>
							<b><?php echo get_option('phone'); ?></b>
						</td>
					</tr>
					</tbody>
				</table>

			</div>

		</div>
		<div class="col-md-3 col-12">

			<div style="border: 2px solid green;" class="">

				<ul class="nav flex-column">
					<li class="nav-item" style="padding: 10px;font-size: 20px;"><i class="fa fa-thumbs-up"></i> 100%
						original products
					</li>
					<li style="padding: 10px;font-size: 20px;" class="nav-item"><i class="fa fa-money"></i> Pay cash on
						delivery
					</li>
					<li style="padding: 10px;font-size: 20px;" class="nav-item"><i class="fa fa-shopping-cart"></i>
						Delivery within: 2-3 business days
					</li>
				</ul>
			</div>

			<div class="mt-3">
				<div class="featured-products">

					<?php
					$featured_products = get_featured_products('DESC', 3);
					if ($featured_products) {
						echo '<div class="title">Recent Products</div>';
						echo '<ul>';

						foreach ($featured_products as $recent_prod) {
							$recent_prod_product_link = base_url($recent_prod->product_name);
							$link=base_url().'product/'.$recent_prod->product_name;


							echo '<li class="featured-item">
											<a href="' . $link . '">
												<div class="image"><img src="' . get_product_thumb($recent_prod->product_id, 'thumb') . '"></div>
												<div class="name">' . $recent_prod->product_title . '</div>
											</a>
										</li>';
						}

						echo '</ul>';
					}
					?>
				</div>

			</div>


		</div>
	</div>
</div>
<div class="container">
	<br>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#home"> পন্যের বিবরণ </a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#menu1"> শর্তাবলী </a>
		</li>
<!--		<li class="nav-item">-->
<!--			<a class="nav-link" data-toggle="tab" href="#menu2">প্রোডাক্ট রিভিউ</a>-->
<!--		</li>-->
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div id="home" class="container tab-pane active"><br>
			<div class="tabbox-container">
				<?= ($prod_row->product_description) ?>
			</div>
		</div>
		<div id="menu1" class="container tab-pane fade"><br>
			<div class="tabbox-container">

				<?php

				if ($prod_row->product_terms) {
					echo $prod_row->product_terms;

				} else {
					echo get_option('default_product_terms');
				}

				?>
			</div>
		</div>
		<div id="menu2" class="container tab-pane fade"><br>
			<h2 class="tab-title">4 reviews for ম্যাজিক সিলিকন ডিশ ওয়াশিং গ্লাভস </h2>
			<div class="row reviews">
				<div class="col-sm-3 review-left">
					<h3 class="heading3">Write a Review</h3>
					<form class="form-vertical reviewform">
						<fieldset class="field field-rating srating">
							<input type="radio" id="star5" name="rating" value="5">
							<label class="full" for="star5" title="5 stars"></label>
							<input type="radio" id="star4" name="rating" value="4">
							<label class="full" for="star4" title="4 stars"></label>
							<input type="radio" id="star3" name="rating" value="3">
							<label class="full" for="star3" title="3 stars"></label>
							<input type="radio" id="star2" name="rating" value="2">
							<label class="full" for="star2" title="2 stars"></label>
							<input type="radio" id="star1" name="rating" value="1">
							<label class="full" for="star1" title="1 star"></label>
						</fieldset>
						<div class="form-group">
							<input type="text" name="name" class="form-control field field-name" placeholder="Name">
						</div>
						<div class="form-group">
							<input type="text" name="email" class="form-control field field-email" placeholder="Email">
						</div>
						<div class="form-group">
							<textarea rows="3" name="comment" class="form-control field field-comment"
									  placeholder="Comments"></textarea>
						</div>

						<input type="hidden" name="product_id" value="794">
						<button type="button" id="reviewbtn" class="btn btn-new form-control">continue</button>
					</form>
				</div>
				<div class="col-sm-9 review-right">
					<div class="rating-overall-desc">
						<div class="rating"><span style="width:40%"></span></div>
						<p>4 Customer Reviews</p></div>
					<ul class="commentlist">
						<li class="comment even thread-even depth-1">
							<div class="review-user review-header">
								<div class="rating">
									<span style="width:20%"></span>
								</div>
								<h5 itemprop="author">Kowshick San</h5>
								<em class="verified">verified</em>
								<small>15 Jul 2019</small>
							</div>
							<div class="review-body">
								<div class="review-text" itemprop="description">
									<p>ম্যাজিক সিলিকন ডিশ ওয়াশিং গ্লাভস কালেরহাটের ওয়েবসাইটে দেখে যতোটা ভালো লেগেছিল,
										হাতে পাওয়ার পর সবকিছু উবে যায়। আমি দুইটি অর্ডারে (অর্ডার নম্বর ১৪৮৭৪ এবং ১৪৮৭৭)
										মোট তিন জোড়া গ্লাভস অর্ডার করেছিলাম এর মাঝে তিন জোড়াতেই লিকেজ পাওয়া গেছে। হাতের
										কাজ করতে গিয়ে যাতে হাতে পানি না লাগে এজন্যই আপনাদের ওয়েবসাইট থেকে নেওয়া আর এখন
										দেখছি এই গ্লাভস হাতে দেওয়ার সাথে সাথেই পানিতে ভরে যায় হাত। এরকম সার্ভিস দিলে আর
										মার্কেটে টিকে থাকতে হবে না, কিছুদিন পর লালবাতি জ্বলবে......।। </p>
								</div>
							</div>
						</li>
						<li class="comment even thread-even depth-1">
							<div class="review-user review-header">
								<div class="rating">
									<span style="width:20%"></span>
								</div>
								<h5 itemprop="author">Mohin khan</h5>
								<em class="verified">verified</em>
								<small>10 Jul 2019</small>
							</div>
							<div class="review-body">
								<div class="review-text" itemprop="description">
									<p>kalerhat একটি প্রতারক সপ,এদের কাজ হচ্ছে গ্রহক ঠকানো।পন্যের বিস্তারিত মিথ্যে লিখে
										এবং দাম অত্যাধিক বেশি।এবং সঠিক/সত্য কমেন্টস/রিভিউ করলে সেটা ডিলিট করে দেয়। </p>
								</div>
							</div>
						</li>
						<li class="comment even thread-even depth-1">
							<div class="review-user review-header">
								<div class="rating">
									<span style="width:100%"></span>
								</div>
								<h5 itemprop="author">Rayhan</h5>
								<em class="verified">verified</em>
								<small>10 Jul 2019</small>
							</div>
							<div class="review-body">
								<div class="review-text" itemprop="description">
									<p>Price ta r aktu kom hoile valo hoito</p>
								</div>
							</div>
						</li>
						<li class="comment even thread-even depth-1">
							<div class="review-user review-header">
								<div class="rating">
									<span style="width:20%"></span>
								</div>
								<h5 itemprop="author">soniya2k19</h5>
								<em class="verified">verified</em>
								<small>01 Jul 2019</small>
							</div>
							<div class="review-body">
								<div class="review-text" itemprop="description">
									<p>Never buy</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<br>

<input type="hidden" name="related_category" value="<?php echo $product_cats;?>">
<div class="container">
	<h4 style="background-color: #ddd;padding: 7px;margin: 1px -16px;"> রিলেটেড প্রোডাক্ট </h4>


	<div id="load_data"></div>
	<div id="load_data_message"></div>

</div>

<style>
	.vertical-menu {
		width: 200px;
	}

	.vertical-menu a {
		background-color: #eee;
		color: black;
		display: block;
		padding: 12px;
		text-decoration: none;
	}

	.vertical-menu a:hover {
		background-color: #ccc;
	}

	.vertical-menu a.active {
		background-color: #4CAF50;
		color: white;
	}
</style>

<script>
	$(document).ready(function () {

		var quantitiy = 0;
		$('.quantity-right-plus').click(function (e) {

			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());

			// If is not undefined

			$('#quantity').val(quantity + 1);


			// Increment

		});

		$('.quantity-left-minus').click(function (e) {
			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());

			// If is not undefined

			// Increment
			if (quantity > 0) {
				$('#quantity').val(quantity - 1);
			}
		});

	});
</script>
<style>
	.alert-box-arrow {
		width: 0;
		height: 0;
		border-left: 12px solid transparent;
		border-right: 12px solid transparent;
		border-bottom: 15px solid #F6F6F6;
		margin-top: -15px;
		position: absolute;
	}
</style>

<script>
	$('body').on('click','.ordinal_galary_image',function () {
 var galary_image=$(this).attr('src');

		$('#ordinal_galary_image').attr('src',galary_image);
		$('.picbig').attr('src',galary_image);

	});
</script>

<script>
	$(document).ready(function () {

		var limit = 6;
		var start = 0;
		var action = 'inactive';
		var related_category = $('input[name=related_category]').val();

		function load_data(limit, start) {


			$.ajax({
				url: "<?php echo base_url(); ?>Ajax/scroll_related_product",
				method: "POST",
				data: {limit: limit, start: start, category_id: related_category},
				cache: false,
				success: function (data) {
					if (data == '') {
						$('#load_data_message').html('<h3>No More Result Found</h3>');
						action = 'active';
					} else {
						$('#load_data').append(data);
						$('#load_data_message').html("");
						action = 'inactive';
					}
				}
			})
		}

		if (action == 'inactive') {
			action = 'active';
			load_data(limit, start);
		}

		$(window).scroll(function () {
			if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {

				action = 'active';
				start = start + limit;
				setTimeout(function () {
					load_data(limit, start);
				}, 1000);
			}
		});

	});
</script>
