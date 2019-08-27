<?php
$product_link = base_url($prod_row->product_name);
$featured_image = get_product_thumb($prod_row->product_id);
$product_video = $prod_row->product_video ;
$sku = $prod_row->sku;


/*# product category #*/
$product_cat=null;
$product_cats=get_result("SELECT term_id FROM term_relation WHERE product_id=$prod_row->product_id");
if(count($product_cats)>0)
{
	foreach($product_cats as $pcat)
	{
		$product_cat[]=$pcat->term_id;
	}
	$product_cats=implode(",", $product_cat);
}


/*# product stock availability #*/
$stock_qty = $prod_row->product_stock;
$product_availability = 'In Stock';
$product_availability_index = 'in-stock';
if(!$stock_qty)
{
	$product_availability = 'Out of Stock';
	$product_availability_index = 'out-of-stock';
}


/*# product price and discount #*/
$discount = false;

$product_price = $sell_price = $prod_row->product_price;

$product_discount =$prod_row->discount_price;
$discount_type = $prod_row->discount_type;

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


///*# review rating #*/
//$total_rating = $total_review = $avg_rating = null;
//$reviews = get_review($prod_row->product_id);
//if(count($reviews)>0)
//{
//	foreach($reviews as $review){ $rating[] = $review->rating; }
//	$total_rating = array_sum($rating);
//	$total_review = count($reviews);
//	$avg_rating = number_format((($total_rating) / ($total_review)),2);
//}
//
//$five_star = count(get_review($prod_row->product_id, 5));
//$four_star = count(get_review($prod_row->product_id, 4));
//$three_star = count(get_review($prod_row->product_id, 3));
//$two_star = count(get_review($prod_row->product_id, 2));
//$one_star = count(get_review($prod_row->product_id, 1));
?>


<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<br/>
<br/>

<!--content area start-->

<section  class="best_seller_product"  style="background-color: #fff;padding-bottom: 10px" id="main_content_area">
	<style>
		#ListStyle1 li{
			list-style-type: initial !important;
		}
		#ListStyle2 li{
			list-style-type: initial !important;
		}
		#ListStyle1 p{
			list-style:disc outside none;
			display:list-item;
		}
		#ListStyle2 p{
			list-style:disc outside none;
			display:list-item;
		}

	</style>
	<div class="container" style="padding-right:0px">
		<div class="row" >

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mobile-padding-left-15px" >
				<div class="panel panel-info ">
					<div class="panel-heading">

						<h4 class="modal-title" id="gridSystemModalLabel" style="font-size: 22px;font-weight: bold;color: #525252"><?php if(isset($page_title)) { echo $page_title;} ?>                  </h4>

					</div>
					<div class="panel-body mobile-padding-zero" style="padding-left: 30px;padding-right: 30px">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-lg-12 col-md-12  col-sm-12 col-xs-12 details_whole"  style="padding-left: 0px">

									<ul id="etalage"  class="etalage area-mobile-off" >
										<li>
											<a href="#">
												<img  class="etalage_thumb_image" src="<?=$featured_image?>" />
												<img class="etalage_source_image" src="<?=$featured_image?>"  title="" />

											</a>
										</li>
										<?php
										$gallery_image_meta = get_product_meta($prod_row->product_id, 'gallery_image');
										$gallery_image_metaa=explode(",",$gallery_image_meta);
										//var_dump($gallery_image_meta);exit();
										$gallery_image=explode(",", $gallery_image_meta);
										if(count($gallery_image)>0)
										{
											foreach($gallery_image as $gallery_id)
											{
												$gallery=get_media_path($gallery_id);

												?>
												<li>

													<img class="etalage_source_image" src="<?=$gallery?>" title="<?php if(isset($page_title)) { echo $page_title;} ?>" />
												</li>
												<?php
											}
										}
										?>





									</ul>

									<div class=" col-lg-5 col-md-5 col-sm-5 col-xs-12  area-mobile-on">

										<img  class="img-responsive" src="<?=$featured_image?>" />

									</div>

									<div class="mobile-margin-left-zero mobile-margin-bottom-45 col-lg-7 col-md-7 col-sm-7 col-xs-12  right" style="border: 1px solid #4b134f;margin-left: 40px;min-height: 300px">
										<div class="col-sm-12" id="P_UserOrderForm1203" style="padding:0">

											<div class="col-xs-12 col-sm-6 col-md-6 " style="padding: 0px;">

												<p style="margin: 20px 0;color: #525252;font-size: 25px">মূল্য  : <?php
													if($discount==true)
													{
														?><del class="bn"><?=formatted_price($product_price)?></del><?php
													}
													?>
													<strong> <?=formatted_price($sell_price)?> </strong>


												</p>

												<p style="margin: 5px 0 15px 0;">প্রোডাক্ট কোড: <?php if(isset($sku)) { echo $sku;} ?>   </p>
													<form action="http://www.egbazar.com/payment-type" method="post">

												<input type="hidden" name="QtnLimitPerUserHiddenField" id="QtnLimitPerUserHiddenField" value="15" />

												<div class="col-xs-12 col-sm-12 col-md-12 deal-quantity" style="padding-left: 0px;margin-top: 10px">
													<div id="Quantity">
														<span  style="float: left;margin-top: 5px">পরিমান  : </span>

														<div style="float: left; border: solid 1px #24b193; width: 150px; height: 36px;margin-left:5px">
															<div style="color:orangered;font-size: 25px;text-align: center; width: 50px; float: left; cursor: pointer;font-weight: bold;"
																 onclick="DecrementFunction('quantity-value1203');">
																-
															</div>

															<span  style="font-size: 25px;text-align: center;color: gray; width: 50px; float: left; cursor: pointer;border-right: 1px solid #24b193;border-left: 1px solid #24b193;font-weight: bold;" id="quantity-value1203">1</span>

															<div onclick="IncrementFunction('quantity-value1203')" style="font-weight: bold;color:orangered;font-size: 25px;text-align: center; width: 40px; float: left;
                                                         cursor: pointer;">
																+
															</div>

														</div>

													</div>
												</div>



											</div>

											<div class="col-xs-12 col-sm-6 col-md-6 " style="padding: 0px;margin-top: 30px;    margin-bottom: 30px;">

												<div class="btn col-xs-12 col-sm-12 col-md-12" style="font-size: 21px;margin-bottom: 20px;background:#f16e52 ;color:#fff">

														<input type="hidden" value="<?php  echo $sell_price; ?>" name="product_price">
														<input type="hidden" value="<?php echo $prod_row->product_id ?>" name="product_id">
														<input type="hidden" value="<?php echo $page_title ?>" name="product_title">
														<input id="product_buy_item_quantity-value1203"  type="hidden" name="product_buy_item" value="1">
														<input type="submit" value="অর্ডার করুন" style="background: transparent;border: none;margin: 0;padding: 0">
													
												</div>

												<div class=" btn col-xs-12 col-sm-12 col-md-12   " onclick="add_to_cart()" style="background:#1A4314;color:#fff;font-size: 21px;">
													কার্ট-এ যোগ করুন
												</div>
											</div>
											</form>

											<div class="col-sm-12 col-xs-12" style="padding:0">

												<?=get_option('phone_order')?>


												<div class="col-sm-6 col-xs-12" style="padding:0">
													<a href="tel:<?php echo get_option('phone');?>">
														<img class="img-responsive" style="width: 200px; padding-top: 8px;cursor: pointer" src="http://www.egbazar.com/front_asset/Button_call.gif" >
													</a>
												</div>
											</div>

											<div class="col-xs-12 col-sm-12 col-md-12 "><br></div>


										</div>

									</div>


								</div>
							</div>


						</div>
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading"><strong style="font-size: 22px;font-weight: bold;color: #525252"><i class="fa fa-bar-chart" style="color: #000"> </i> পন্যের বিবরণ </strong></div>
					<div class="panel-body" style="padding-left: 30px;padding-right: 30px">
						<div class="row">
							<div class=" col-lg-12 col-sm-12 brand text-center" style="background-color: #fff;padding: 0">

								<div id="my-tab-content" class="tab-content" style="padding-left: 0px;padding-right: 0px;">
									<!-- top category tab -->
									<div class="tab-pane active" id="course-detail1203">

										<div class="tab-content panel-body" style="padding: 0">



											<div class="tab-content panel-body" style="padding: 0">

												<div  id="ListStyle2"  class="col-sm-12 text-left product-dynamic-details" style="padding: 0px;padding-left:25px" >
													<p><span id="fbPhotoSnowliftCaption" class="fbPhotosPhotoCaption" tabindex="0" data-ft="{&quot;tn&quot;:&quot;K&quot;}"><span class="hasCaption"><span class="text_exposed_show">						<?=($prod_row->product_description)?>
</span></span></span></p>
												</div>


											</div>


										</div>
									</div>



								</div>
							</div>
							<div class="col-sm-12 col-md-12" style="margin-top:20px;background: #F5F5F5;padding: 0">
								<div class="col-sm-6 col-md-6  col-xs-12" style="padding: 0">
									<img style="width: 60px;padding: 10px" class="img-responsive pull-left mobile-icon" src="http://www.egbazar.com//front_asset/d.png" alt="Call egbazar" title="Call egbazar"><h3 class="font-size-title-mobile" style="font-weight: bold;font-size: 18px;text-align:left"> ঢাকা সিটির ভীতরে ডেলিভারি চার্জ													<?=get_option('shipping_charge_in_dhaka')?>
										টাকা</h3>
								</div>
								<div class="col-sm-6 col-md-6 col-xs-12" style="padding:0">
									<img style="width: 60px;padding: 10px" class="img-responsive pull-left  mobile-icon" src="http://www.egbazar.com//front_asset/od.png" alt="Call egbazar" title="Call egbazar"><h3 class="font-size-title-mobile" style="font-weight: bold;font-size: 18px;text-align:left">   ঢাকা সিটির বাহীরে হলে অগ্রিম ডেলিভারি চার্জ
										<?=get_option('shipping_charge_out_of_dhaka')?>

										টাকা</h3>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-info ">
					<div class="panel-heading"><strong style="font-size: 22px;font-weight: bold;color: #525252"><i class="fa fa-bus" style="color: #000"> </i> ডেলিভারি এন্ড পেমেন্ট </strong></div>
					<div class="panel-body mobile-padding-zero" style="padding-left: 30px;padding-right: 30px">
						<div class="col-sm-6">
							<h3  class="font-size-title-mobile">
								<i class="fa fa-check"> </i>
								আপনি ঢাকা সিটির ভীতরে হলেঃ-
							</h3>

							<div class="col-sm-12">
								<p>
									<i class="fa  fa-arrow-circle-right "> </i>
									ক্যাশ অন ডেলিভারি/হ্যান্ড টু হ্যান্ড ডেলিভারি।
								</p>
								<p>
									<i class="fa  fa-arrow-circle-right "> </i>
									ডেলিভারি চার্জ ৫০ টাকা।
								</p>
								<p>
									<i class="fa  fa-arrow-circle-right "> </i>
									পণ্যের টাকা ডেলিভারি ম্যানের কাছে প্রদান করবেন।
								</p>
								<p>
									<i class="fa  fa-arrow-circle-right "> </i>
									অর্ডার কনফার্ম করার ৪৮ ঘণ্টার ভিতর ডেলিভারি পাবেন।
								</p>
								<p>
									<i class="fa  fa-arrow-circle-right "> </i>
									বিঃদ্রঃ- ছবি এবং বর্ণনার সাথে পণ্যের মিল থাকা সত্যেও আপনি পণ্য গ্রহন করতে না চাইলে  ডেলিভারি চার্জ ৫০ টাকা ডেলিভারি ম্যানকে প্রদান করতে বাধ্য থাকিবেন।
								</p>
							</div>
						</div>
						<div class="col-sm-6">
							<h3 class="font-size-title-mobile">
								<i class="fa fa-check"> </i>
								আপনি ঢাকা সিটির বাহীরে হলেঃ-
							</h3>

							<div class="col-sm-12">
								<p>
									<i class="fa  fa-arrow-circle-right "> </i>
									কন্ডিশন বুকিং অন কুরিয়ার সার্ভিস (জননী কুরিয়ার অথবা এস এ পরিবহন কুরিয়ার সার্ভিস) এ নিতে হবে।
								</p>
								<p>
									<i class="fa  fa-arrow-circle-right "> </i>
									কুরিয়ার সার্ভিস চার্জ ১০০ টাকা বিকাশে অগ্রিম প্রদান করতে হবে।
								</p>

								<p>
									<i class="fa  fa-arrow-circle-right "> </i>
									কুরিয়ার চার্জ ১০০ টাকা বিকাশ করার পর ৪৮ ঘন্টার ভিতর কুরিয়ার হতে পণ্য গ্রহন করতে  হবে এবং পণ্যের টাকা কুরিয়ার অফিসে প্রদান করতে হবে।
								</p>
								<p>
									<i class="fa  fa-arrow-circle-right "> </i>
									বিঃদ্রঃ- ছবি এবং বর্ণনার সাথে পণ্যের মিল থাকা সত্যেও আপনি পণ্য গ্রহন করতে না চাইলে  কুরিয়ার চার্জ ১০০ টাকা কুরিয়ার অফিসে প্রদান করে পণ্য আমাদের ঠিকানায় রিটার্ন করবেন। আমরা প্রয়োজনীয় ব্যবস্থা নিব।
								</p>
							</div>
						</div>
					</div>
				</div>
				<!--Similar Product-->
				<div class="panel panel-info ">
					<div class="panel-heading">

						<h4 class="modal-title" id="gridSystemModalLabel" style="font-size: 22px;font-weight: bold;color: #525252">
							<i class="fa fa-link" style="color: #000"> </i>
							রিলেটেড প্রোডাক্ট
						</h4>

					</div>	<div class="panel-body mobile-padding-zero">
						<div class="col-lg-12 col-md-12 col-sm-12 " style="background: #fff;padding: 0px;margin-bottom: 20px; ;border: 3px solid #ECECEC;border-right:0;border-bottom:0">

							<?php
						//	$related_products = get_related_products($prod_row->product_id, $product_cats);
							$sql = "SELECT product_name,product.product_id,product_title,product_price,discount_price,sku,product_stock,discount_type FROM `product`  JOIN `term_relation` on product.product_id = term_relation.product_id AND term_relation.term_id IN($product_cats)  limit 1";
							$related_products = get_result($sql);

							foreach($related_products as $rel_prod)
							{
								/*# product price and discount #*/
								$rel_prod_discount = false;

								$rel_product_price = $rel_sell_price = $rel_prod->product_price;

								$product_discount = $rel_prod->discount_price;
								$discount_type = $rel_prod->discount_type;

								if($product_discount != 0)
								{
									$rel_prod_discount = true;

									$product_discount = $save_money = floatval($product_discount);

									if($discount_type == 'fixed')
									{
										$rel_sell_price = ($rel_product_price - $product_discount);
									}
									elseif($discount_type == 'percent')
									{
										$save_money = ($product_discount / 100) * $rel_product_price;
										$rel_sell_price = floatval($rel_product_price - $save_money);
									}
								}
								$_product_title = strip_tags($rel_prod->product_title);

								?>
								<div class="col-sm-2 col-xs-6  product-hover-area" style="padding: 0">
									<div class="col-sm-12 col-xs-12 padding-zero " style="background-color: #fff;padding: 0px;border-bottom: 3px solid #ECECEC;border-right: 3px solid #ECECEC;">

										<a  style="padding: 0px;height: 180px;overflow: hidden;" class="img-hover col-sm-12 padding-zero" href="<?=base_url($rel_prod->product_name)?>"  id="1205" >
											<img class="img-responsive zoomEffect" style="margin: 0 auto;padding:5px" src="<?=get_product_thumb($rel_prod->product_id, 'thumb')?>" alt="<?=$rel_prod->product_title; ?>">
										</a>


										<span id="productPrice1205" class="col-sm-12  col-xs-12 text-center" style="background: #fff;padding: 0;display: block;line-height:18px;color: #D2691E;font-size: 14px;font-weight: bold;height: 38px">

                                           <del style="color:#b8b8b8;font-size:14px"><?php
											   if($rel_prod_discount==true)
											   {
												   ?><del class="bn"><?=formatted_price($rel_product_price)?></del><?php
											   }
											   ?></del> <br> <label style="color:green;font-size: 20px;"> 											<?=formatted_price($rel_sell_price)?>
</label>

                                    </span>

										<span id="productName1205" class="col-sm-12 text-center" style="background: #fff;padding: 2px;overflow: hidden;height: 38px;font-size: 12px;display: block;color:#525252;font-weight: bold;
                                          "><?=$_product_title?> </span>


									</div>

								</div>

							<?php }  ?>



						</div>
					</div>
				</div>
				<!--Similar Product End-->





			</div>
		</div>
	</div>


	<script>
		function IncrementFunction(Obj) {
//        alert(Obj);
			var x = document.getElementById(Obj).innerHTML;

			var quantity;
			var limit = document.getElementById("QtnLimitPerUserHiddenField").value;



			if (x > 0 && x < 100) {

				quantity = Number(x) + 1;
//            document.getElementById("QuantityHiddenField").value = quantity;
				document.getElementById('product_buy_item_' + Obj).value = quantity;
				document.getElementById(Obj).innerHTML = quantity;
			}
			else {
//            document.getElementById("QuantityHiddenField").value = x;
				document.getElementById('product_buy_item_' + Obj).value = x;
				document.getElementById(Obj).innerHTML = x;
			}
//        return false;
		}
		function DecrementFunction(Obj) {
//          alert(Obj);
			var x = document.getElementById(Obj).innerHTML;
			var quantity;
//        alert(quantity);
			if (x > 1) {
				quantity = Number(x) - 1;
//            alert(quantity);
//         document.getElementById("QuantityHiddenField").value = quantity;
				document.getElementById('product_buy_item_' + Obj).value = quantity;
				document.getElementById(Obj).innerHTML = quantity;


			}
			else {
//            document.getElementById("QuantityHiddenField").value = x;
				document.getElementById('product_buy_item_' + Obj).value = x;
				document.getElementById(Obj).innerHTML = x;
			}
//        return false;
		}

	</script>        </section>

<!--content area end-->



</body>

</html>
<style>
	.alert-box-arrow{
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

	function ProductAddTwoCart(Obj)
	{

		serverPage = 'http://www.egbazar.com/cart/ajax_addcart/' + Obj;
		xmlhttp.open("GET", serverPage);
		xmlhttp.onreadystatechange = function ()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{

				var obj = JSON.parse(xmlhttp.responseText);
				document.getElementById("totalCartItems2").innerHTML = obj.total_items + ' Items';
				document.getElementById("CartDetailsTotal").innerHTML = obj.total_amount + ' Tk.';
				document.getElementById("MtotalCartItems").innerHTML = obj.total_items;

			}
		}
		xmlhttp.send(null);

	}

</script>
<script>

	$('.zoomEffect').hover(function() {
		$(this).addClass('transition');
	}, function() {
		$(this).removeClass('transition');
	});

</script>
<script>

	$('.megaDropMenu').hover(function() {
		$(this).addClass('open');
	}, function() {
		$(this).removeClass('open');
	});

</script>

