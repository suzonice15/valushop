<nav class="bg-dark">
	<ol class="breadcrumb">
		<li class="breadcrumb-item text-decoration-none"><a href="<?php echo base_url() ?>">Home</a></li>
		<li class="breadcrumb-item active"><a href="<?=$breadcumb_category_link?>">			<?=$breadcumb_category?>
			</a>
	</ol>
</nav>

<section>
<div class="container">
	<div class="row">
		<div class="col-md-3">

				<div class="card card-primary ">
					<div class="card-header">
						All Products
					</div>
					<div class="card-body">
						<ul class="accordion">



							<?php
							$html = null;
							$result = get_result("SELECT * FROM `category` ORDER BY rank_order DESC");
							if (isset($result)) {
								foreach ($result as $row) {
									$category[$row->parent_id][] = $row;
								}

								foreach ($result as $row) {
									if ($row->parent_id == 0) {


										$html .= '<li class="accordion-group">
			<a class="nav-link" href="' . base_url($row->category_name) . '">

				' . $row->category_title . '
			</a>


		</li>';
									}
								}
								$html .= '</ul>

		</nav>';

								echo $html;
							}
							?>

					</div>
				</div>
			<br>
				<div class="card card-primary ">
					<div class="card-header">
						Price
					</div>
					<div class="card-body">
						<form id="formPriceRange" class="filter-cnt clearfix">
							<div class="row row5">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="has-preffix">
											<input type="text" name="price_from" id="price_from" class="form-control" placeholder="Min Price">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="has-preffix">
											<input type="text" name="price_to" id="price_to" class="form-control" placeholder="Max Price">
										</div>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-success float-right">Filter</button>
						</form>
					</div>
				</div>


		</div>
		<div class="col-md-9">



<div class="row">

	<?php
	if(count($products)>0){
	$i = 1; foreach($products as $product)
	{

	$product_link = base_url($product->product_name);

	$product_availability = NULL;
	$stock_qty = intval(get_product_meta($product->product_id, 'stock_qty'));
	if(!$stock_qty)
	{
		$product_availability = '<div class="availability">Out of Stock</div>';
	}

	$discount = false;


		$product_price = $sell_price = $product->product_price;

		$sku = $product->sku;
		$product_discount = $product->discount_price;
		$discount_type = $product->discount_type;


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

	$featured_image=get_product_meta($product->product_id, 'featured_image');
	$featured_image=get_media_path($featured_image, 'thumb');

	?>


			<div class="col-md-2 border col-4">
				<a  style="padding: 0px;height: 180px;overflow: hidden;" class="img-hover col-sm-12 padding-zero" href="<?=$product_link?>"   >
					<img class="img-fluid pt-3 zoomEffect" style="margin: 0 auto;padding:5px" src="<?=$featured_image?>" alt="<?=$product->product_title; ?>"/>
				</a>
				<div class="text-danger text-center  font-weight-bold">
					<del><?=formatted_price($product_price)?></del>
				</div>
				<div class="text-success  font-weight-bold text-center"><span><?=formatted_price($sell_price)?>
				</span>
				</div>
				<div class="text-center">
					<a class="text-decoration-none	" href="<?= base_url($product->product_name) ?>">
						<?=$product->product_title?>
					</a>
				</div>
			</div>







	<?php }


	}
	?>





</div>
		</div>
	</div>
</div>

	</section>
<script>
	$(document).ready(function () {

		var limit = 2;
		var start = 0;
		var action = 'inactive';
		var category_id = $('#category_id').val();
		alert(category_id);


		function load_data(limit, start) {

			$.ajax({
				url: "<?php echo base_url(); ?>Ajax/scroll_pagination_product",
				method: "POST",
				data: {limit: limit, start: start, category_id: category_id},
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
