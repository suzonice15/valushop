<div class="col-md-offset-0 col-md-12">

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">

		


		<form action="<?php echo base_url()?>product-update"  name="proudctUpdate" method="post" enctype="multipart/form-data" >
			<div class="box-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="box box-primary" style="border: 2px solid #ddd;" >
							<div class="box-header" style="background-color: #ddd;" >
								<h3 class="box-title">General Info.</h3>
							</div>
							<div class="box-body">
								<div class="form-group  ">
									<label for="product_title">Title<span class="required">*</span></label>
									<input type="text" class="form-control the_title" name="product_title" id="product_title" value="<?php if(isset($product)) : echo  $product->product_title;endif ; ?>">
									<input type="hidden" class="form-control the_title" name="product_id" id="product_title" value="<?php if(isset($product)) : echo  $product->product_id;endif ; ?>">
								</div>

								<div class="form-group ">
									<label for="product_name">URL Path<span class="required">*</span></label>
									<input type="text" class="form-control the_name" name="product_name" id="product_name" value="<?php if(isset($product)) : echo  $product->product_name;endif ; ?>">
									<p id="produtctError"></p>
								</div>

								<div class="form-group">
									<label for="sku">Product Code</label>
									<input type="text" class="form-control" name="sku" id="sku" value="<?php if(isset($product)){ echo $product->sku;} ?>">
								</div>

								<div class="form-group ">
									<label for="purchase_price">Purchase Price<span class="required">*</span></label>
									<input type="text" class="form-control" name="purchase_price" id="purchase_price" value="<?php if(isset($product)) { echo $product->purchase_price;} ?>">
								</div>

								<div class="form-group ">
									<label for="sell_price">Sell Price<span class="required">*</span></label>
									<input type="text" class="form-control" name="sell_price" id="sell_price" value="<?php if(isset($product)){ echo $product->product_price;} ?>">
								</div>

								<div hidden class="form-group <?=form_error('stock_qty') ? 'has-error' : ''?>">
									<label for="stock_qty">Stock Qty.</label>
									<input type="text" class="form-control" name="stock_qty" id="stock_qty" value="<?php if(isset($product)) { echo $product->product_stock;}?>">
								</div>
								<div class="form-group "><label for="product_availability">Product
										Availability</label> <select name="product_availability"
																	 class="form-control">
										<option value="In stock">In stock</option>
										<option value="Out of stock">Out of stock</option>
										<option value="Upcoming">Upcoming</option>
									</select></div>
								<div class="form-group "><label for="product_availability">Product
										Status</label> <select name="status"
															   class="form-control">
										<option value="1">Published</option>
										<option value="0">Unpublished</option>
									</select></div>


								<div class="form-group">
									<label for="product_type">Product Type</label>
									<select name="product_type" class="form-control">
										<option value="general">General</option>
										<option value="bestsell">Best Sell</option>
										<option value="home">Home</option>

									</select>

								</div>

								<div class="form-group">
									<label for="product_video">Youtube Video Link</label>
									<input type="text" class="form-control" name="product_video" id="product_video" value="<?php if(isset($product)){ echo $product->product_video;} ?>">
								</div>



							</div>
						</div>


					</div>
					<div class="col-md-6">
						<div class="box box-primary" style="border: 2px solid #ddd;" >
							<div class="box-header" style="background-color: #ddd;" >
								<h3 class="box-title">Categories</h3>
							</div>
							<div class="box-body" style="height: 300px;overflow: scroll">
								<div class="form-group categories checkbox">
									<?php
									$category = array('categories' => array(),'parent_cats' => array());

									$result = get_result("SELECT * FROM `category`");

									if(isset($result))
									{
										foreach($result as $row)
										{
											$category['categories'][$row->category_id] = $row;

											$category['parent_cats'][$row->parent_id][] = $row->category_id;
										}

										echo nested_category_checkbox_list(0, $category, $product_terms);
									}
									?>
								</div>
							</div>
						</div>

					</div>



					<div class="col-sm-6" >
						<div class="box box-primary" style="border: 2px solid #ddd;" >
							<div class="box-header" style="background-color: #ddd;" >
								<h3 class="box-title">Image and Gallary</h3>
							</div>
							<div class="box-body" style="overflow: scroll;height: 400">

								<?php
								$featured_image = get_product_meta($product->product_id, 'featured_image');
								$featured_image = get_media_path($featured_image);

								$gallery_image = explode(",", get_product_meta($product->product_id, 'gallery_image'));
								if(count($gallery_image)>0)
								{
									foreach($gallery_image as $gallery_id)
									{
										$gallery[] = get_media_path($gallery_id);
										$galleryId[] = $gallery_id;
									}

								}
								?>

								<div class="form-group featured-image">
									<label>Featured Image<span class="required">*</span></label>
									<div class="row">
										<div class="col-sm-1">
											<img src="<?=$featured_image?>" width="33" height="33">
										</div>
										<div class="col-sm-11">
											<input type="file" class="form-control" name="featured_image">
										</div>
									</div>
								</div>

								<div class="form-group">
									<label>Product Gallary</label>
									<div class="row">
										<?php if(isset($gallery[0])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[0]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[0]?>" data-gallery_img="0">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image1">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image1">
											</div>
										<?php } ?>
									</div>
									<br>
									<div class="row">
										<?php if(isset($gallery[1])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[1]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[1]?>" data-gallery_img="1">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image2">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image2">
											</div>
										<?php } ?>
									</div>
									<br>
									<div class="row">
										<?php if(isset($gallery[2])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[2]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[2]?>" data-gallery_img="2">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image3">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image3">
											</div>
										<?php } ?>
									</div>

									<div class="row">
										<?php if(isset($gallery[3])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[3]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[3]?>" data-gallery_img="3">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image4">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image4">
											</div>
										<?php } ?>
									</div>


									<div class="row">
										<?php if(isset($gallery[4])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[4]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[4]?>" data-gallery_img="4">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image5">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image5">
											</div>
										<?php } ?>
									</div>

									<div class="row">
										<?php if(isset($gallery[5])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[5]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[5]?>" data-gallery_img="5">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image6">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image6">
											</div>
										<?php } ?>
									</div>

									<div class="row">
										<?php if(isset($gallery[6])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[6]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[6]?>" data-gallery_img="6">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image7">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image7">
											</div>
										<?php } ?>
									</div>

									<div class="row">
										<?php if(isset($gallery[7])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[7]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[7]?>" data-gallery_img="7">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image8">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image8">
											</div>
										<?php } ?>
									</div>

									<div class="row">
										<?php if(isset($gallery[8])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[8]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[8]?>" data-gallery_img="8">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image9">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image9">
											</div>
										<?php } ?>
									</div>

									<div class="row">
										<?php if(isset($gallery[9])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[9]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[9]?>" data-gallery_img="9">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image10">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image10">
											</div>
										<?php } ?>
									</div>

									<div class="row">
										<?php if(isset($gallery[10])){ ?>
											<div class="col-sm-1">
												<img src="<?=$gallery[10]?>" width="33" height="33">
												<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[10]?>" data-gallery_img="10">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image11">
											</div>
										<?php }else{ ?>
											<div class="col-sm-12">
												<input type="file" class="form-control" name="product_image11">
											</div>
										<?php } ?>
									</div>



								</div>

							</div>
						</div>
					</div>
				</div>



			</div>

			<div class="" >

				<div class="box-body">

					<div  class="row">
						<div hidden class="col-md-3">
							<div class="box box-primary" style="border: 2px solid #ddd;" >
								<div class="box-header" style="background-color: #ddd;" >
									<h3 class="box-title">product size</h3>
								</div>
								<div class="box-body" style="height: 300px;overflow: scroll">
									<div class="form-group categories checkbox">

										<ul>
											<?php
											$result = $this->db->query("SELECT * FROM  product_size")->result();



											if(isset($result))
											{
												foreach($result as $row)
												{
													?>
													<li>
														<label><input
																<?php $size=$product->product_of_size;
																$arraySize=explode(',',$size); foreach ($arraySize as $key=>$productSize) {
																	if ($productSize == $row->name) {
																		echo 'checked';
																	} else {
																		echo '';
																	}
																}
																?>

																type="checkbox" name="product_size[]" value="<?php echo $row->name;?>" ><?php echo $row->name;?></label>


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




						<div hidden class="col-md-3">



							<div class="box box-primary" style="border: 2px solid #ddd;" >
								<div class="box-header" style="background-color: #ddd;" >
									<h3 class="box-title">Product Color</h3>
								</div>
								<div class="box-body" style="height: 300px;overflow: scroll">
									<div class="form-group categories checkbox">

										<ul>
											<?php
											$result = $this->db->query("SELECT * FROM  product_color")->result();

											if(isset($result))
											{
												foreach($result as $row)
												{
													?>
													<li>
														<label><input
																<?php $color=$product->product_color;
																$arrayColor=explode(',',$color);
																foreach ($arrayColor as $key=>$productSize) {
																	if ($productSize == $row->product_color_name) {
																		echo 'checked';
																	} else {
																		echo '';
																	}
																}
																?>

																type="checkbox" name="product_color[]" value="<?php echo $row->product_color_name;?>" ><?php echo $row->product_color_name;?></label>

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

				</div>
			</div>
			<div class="box box-primary" style="border: 2px solid #ddd;" >
				<div class="box-header" style="background-color: #ddd;" >
					<h3 class="box-title">Discount</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label for="discount_price">Discount Amount</label>
										<input type="text" class="form-control" name="discount_price" id="discount_price" value="<?php if(isset($product)) { echo $product->discount_price ; } ?>">
									</div>
									<div class="col-sm-6">
										<label for="discount_type">Discount Type</label>

										<select id="discount_type"  name="discount_type" class="form-control">
											<option value="fixed">Fixed</option>
											<option value="percent">Percent</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group <?=form_error('discount_from') ? 'has-error' : ''?>">
										<label for="discount_from">Discount From</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<?php echo form_input(array('name'=>'discount_from', 'class'=>'form-control pull-right datepicker', 'id'=>'discount_from', 'value'=>set_value('discount_from'))); ?>
										</div>
									</div>
								</div>
								<div class="col-sm-6 ">
									<div class="form-group <?=form_error('discount_to') ? 'has-error' : ''?>">
										<label for="discount_to">Discount To</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<?php echo form_input(array('name'=>'discount_to', 'class'=>'form-control pull-right datepicker', 'id'=>'discount_to', 'value'=>set_value('discount_to'))); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="box box-primary" style="border: 2px solid #ddd;" >
				<div class="box-header" style="background-color: #ddd;" >
					<h3 class="box-title">Description</h3>
				</div>
				<div class="box-body">
					<div class="form-group ">
						<textarea class="form-control" rows="15" name="product_description" id="product_description"><?php if(isset($product)) : echo  $product->product_description;endif ; ?></textarea>
					</div>
				</div>
			</div>

			<div class="box box-primary" style="border: 2px solid #ddd;" >
				<div class="box-header" style="background-color: #ddd;" >
					<h3 class="box-title">Summary</h3>
				</div>
				<div class="box-body">
					<div class="form-group ">
						<textarea class="form-control" rows="10" name="product_summary" id="product_summary"><?php if(isset($product)) : echo  $product->product_summary;endif ; ?> </textarea>
					</div>
				</div>
			</div>

			<div class="box box-primary" style="border: 2px solid #ddd;" >
				<div class="box-header" style="background-color: #ddd;" >
					<h3 class="box-title">Terms &amp; Conditions</h3>
				</div>
				<div class="box-body">
					<div class="form-group ">
						<textarea class="form-control" rows="5" name="product_terms" id="product_terms"><?php if(isset($product)) : echo  $product->product_terms;endif ; ?></textarea>
					</div>
				</div>
			</div>


			<div class="box box-primary" style="border: 2px solid #ddd;" >
				<div class="box-body">
					<div class="form-group ">
						<label for="seo_title">SEO Title</label>
						<input type="text" class="form-control" name="seo_title" id="seo_title" value="<?php if(isset($product)) { echo $product->seo_title  ; } ?>">
					</div>

					<div class="form-group  ">
						<label for="seo_keywords">SEO Keywords</label>
						<input type="text"  rows="1" class="form-control" name="seo_keywords" id="seo_keywords" value="<?php if(isset($product)) { echo $product->seo_keywords ; } ?>">
					</div>

					<div class="form-group  ">
						<label for="seo_content">SEO Content</label>
						<textarea class="form-control" rows="5" name="seo_content" id="seo_content"><?php if(isset($product)){ echo $product->seo_content ;} ?></textarea>
					</div>
				</div>
			</div>
	</div>


	<div class="box-footer">
		<input type="submit" class="btn btn-success pull-right" value="Update"/>
		<a class="btn btn-danger pull-left " href="<?php echo base_url();?>product-list">Cancel</a>

	</div>
	</form>

</div>
</div>
<script>
		document.forms['proudctUpdate'].elements['product_type'].value="<?php echo $product->product_type;?>";
		document.forms['proudctUpdate'].elements['status'].value="<?php echo $product->status;?>";
		document.forms['proudctUpdate'].elements['discount_type'].value="<?php echo $product->discount_type;?>";
		document.forms['proudctUpdate'].elements['product_availability'].value="<?php echo $product->product_availability;?>";

		document.forms['proudctUpdate'].elements['discount_from'].value="<?php  echo get_product_meta($product->product_id, 'discount_from');?>";
		document.forms['proudctUpdate'].elements['discount_to'].value="<?php  echo get_product_meta($product->product_id, 'discount_to');?>";
		$('.remove_gallery_img').on('click',function () {
			var media_id=this.id;
			var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
			//alert(url)
			$.ajax({
				type :'post',
				url:'<?php echo base_url()?>product/ProductController/geleryImageDelete',
				data:{media_id:media_id},
				success: function (data) {
					alert(data);
					window.location=url;
				}
			});
		});

</script>




<script>
	$(document).ready(function () {
		$("#product_title").on( 'input click', function () {
			var text=$("#product_title").val();
			var word= text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
			$("#product_name").val(word);
			$.ajax({
				data:{url:word},
				type:"POST",
				url:'<?php echo base_url()?>product/ProductController/urlCheck',
				success:function (result) {
					$('#produtctError').html(result);
					var str2="es";
					var word=$("#product_name").val(word);
					if(result){
						var text=$("#product_title").val();
						var word= text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
						var word = word.concat(str2);
						$("#product_name").val(word);

					} else {
						var text=$("#product_title").val();
						var word= text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
						$("#product_name").val(word);
					}
				}
			});
		});
	});
</script>



















