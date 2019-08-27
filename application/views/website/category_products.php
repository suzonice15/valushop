<br/>
<br/>
<br/>







<br>
<div class="panel panel-default">
	<div class="panel-heading">
		<a href="http://www.egbazar.com/">
			<i style="color:#3B5998;font-size: 24px" class="fa fa-cart-arrow-down"></i>
		</a> ছেলেদের শপিং

	</div>
</div>

<section class="best_seller_product"  style="background-color: #fff;padding-bottom: 10px" >
	<div class="container" style="padding-right:0px">
		<div class="row" >
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="padding-left: 5px">

				<div class="row"   id="newCollectionProduct">



					<div class="col-lg-12 col-md-12 col-sm-12  col-xs-12" style="background: #fff;padding: 0px;margin-bottom: 20px; ;border: 3px solid #ECECEC;border-right:0;border-bottom:0">
					<!--         SINGLE PRODUCT ---------->

					<?php
					if(count($products)>0){
					$i = 1; foreach($products as $prod)
					{

					$product_link = base_url($prod->product_name);

					$product_availability = NULL;
					$stock_qty = intval(get_product_meta($prod->product_id, 'stock_qty'));
					if(!$stock_qty)
					{
						$product_availability = '<div class="availability">Out of Stock</div>';
					}

					$discount = false;

					$product_price = $sell_price = floatval(get_product_meta($prod->product_id, 'sell_price'));

					$product_discount = get_product_meta($prod->product_id, 'discount_price');

					$discount_type = get_product_meta($prod->product_id, 'discount_type');

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

					$featured_image=get_product_meta($prod->product_id, 'featured_image');
					$featured_image=get_media_path($featured_image, 'thumb');

					?>

						<div class="col-sm-2 col-xs-6  product-hover-area" style="padding: 0">
							<div class="col-sm-12 col-xs-12 padding-zero " style="background-color: #fff;padding: 0px;border-bottom: 3px solid #ECECEC;border-right: 3px solid #ECECEC;">
								<?=$product_availability?>
								<a  style="padding: 0px;height: 180px;overflow: hidden;" class="img-hover col-sm-12 padding-zero" href="<?=$product_link?>"   >
									<img class="img-responsive zoomEffect" style="margin: 0 auto;padding:5px" src="<?=$featured_image?>" alt="<?=$prod->product_title; ?>"/>
								</a>


								<span id="productPrice1211" class="col-sm-12  col-xs-12 text-center" style="background: #fff;padding: 0;display: block;line-height:18px;color: #D2691E;font-size: 14px;font-weight: bold;height: 38px">

                                           <del style="color:#b8b8b8;font-size:14px">										<?=formatted_price($product_price)?>
</del> <br> <label style="color:green;font-size: 20px;">     <?=formatted_price($sell_price)?></label>

                                    </span>

								<span id="productName1211" class="col-sm-12 text-center" style="background: #fff;padding: 2px;overflow: hidden;height: 38px;font-size: 12px;display: block;color:#525252;font-weight: bold;
                                          "><?=$prod->product_title?>      </span>
								<div class="">
									<?php
									if($stock_qty)
									{
										?><a href="javascript:void(0)" class="btn btn-success col-sm-6" data-product_id="<?=$prod->product_id?>" data-product_price="<?=$sell_price?>" data-product_title="<?=$prod->product_title?>">
											<span>Add to </span>Cart
										</a>
									<a href="javascript:void(0)" class="btn btn-success col-sm-6" data-product_id="<?=$prod->product_id?>" data-product_price="<?=$sell_price?>" data-product_title="<?=$prod->product_title?>">
											Order<span> Now</span>
										</a><?php
									}
									else
									{
										?><a  class="btn btn-success col-sm-6" href="<?=$product_link?>">
											<span>Add to </span>Cart
										</a>
									<a  class="btn btn-success col-sm-6" href="<?=$product_link?>">
											Order<span> Now</span>
										</a><?php
									}
									?>
								</div>


							</div>

						</div>



					<?php }


					}
					?>







					</div>


		<!--		SINGLLE PRODECUT END	-->
				</div>



			</div>



		</div>
	</div>


</section>

<section class="best_seller_product"  style="background-color: #fff;padding-bottom: 10px" >

</section>
<div class="container">
	<br />
	<div id="load_data"></div>
	<div id="load_data_message"></div>
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
</div>
<input type="text" class="form-control" id="category_id" name="category_id" value="<?php echo $category_id;?>"/>
<script>
	$(document).ready(function(){

		var limit = 2;
		var start = 0;
		var action = 'inactive';
		var category_id=$('#category_id').val();
		alert(category_id);


		function load_data(limit, start)
		{

			$.ajax({
				url:"<?php echo base_url(); ?>Ajax/scroll_pagination_product",
				method:"POST",
				data:{limit:limit, start:start,category_id:category_id},
				cache: false,
				success:function(data)
				{
					if(data == '')
					{
						$('#load_data_message').html('<h3>No More Result Found</h3>');
						action = 'active';
					}
					else
					{
						$('#load_data').append(data);
						$('#load_data_message').html("");
						action = 'inactive';
					}
				}
			})
		}

		if(action == 'inactive')
		{
			action = 'active';
			load_data(limit, start);
		}

		$(window).scroll(function(){
			if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
			{

				action = 'active';
				start = start + limit;
				setTimeout(function(){
					load_data(limit, start);
				}, 1000);
			}
		});

	});
</script>
