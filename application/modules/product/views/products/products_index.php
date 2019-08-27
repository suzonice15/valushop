<div class="col-md-12">
	<div class="box-body">
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-success">
						<div class="box-body">
							<form method="POST">
								<div class="btnarea">
									<div class="row">
										<div class="col-md-4 col-sm-6 col-xs-12">
											<a href="<?= base_url('product-create') ?>" class="btn btn-success">Add
												New</a>
											<input type="submit" name="delete" value="Delete" id="deleteAll"
												   onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')"
												   class="btn btn-danger" id="del_all" data-table="product"/>

										</div>
										<div class="col-md-2 col-sm-6 col-xs-12" style="text-align:left;">

										</div>
										<div class="col-md-3 col-sm-6 col-xs-12" style="text-align:left;">

											<select onchange="return totalProductCount();" class="form-control"
													id="counter">
												<option value="30">30</option>
												<option value="50">50</option>
												<option value="100">100</option>
												<option value="250">250</option>
												<option value="1">All</option>

											</select>
										</div>
										<div class="col-md-3 col-sm-6 col-xs-12" style="text-align:left;">

											<input type="text" name="product_title" id="product_title"
												   oninput="return search_content();" class="form-control"/>
										</div>
									</div>
								</div>


								<div id="ajaxdata" class="table-responsive">
									<table id="dat4aTable" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th>Sl</th>
											<th><input type="checkbox" id="checkAll"></th>
											<th>Product Code</th>
											<th>Product</th>
											<th>Category</th>
											<th>Purchase Price</th>
											<th>Sell Price</th>
											<th>Discount Price</th>
											<th>Qty.</th>
											<th>Cration date</th>
											<th class="text-right">Action</th>
										</tr>
										</thead>
										<tbody>


										<?php
										if (isset($products)) {
											$html = NULL;
											$i = 0;

											foreach ($products as $prod) {
												$stock_qty = get_product_meta($prod->product_id, 'stock_qty');
												$categoryName = get_result("SELECT * FROM  category
join term_relation on term_relation.term_id=category.category_id
WHERE product_id=$prod->product_id");
												foreach ($categoryName as $category) {
													$category_title[] = $category->category_title;


												}
												$category_name = implode(',', $category_title);
												unset($category_title);

												$featured_image = get_product_meta($prod->product_id, 'featured_image');
												$featured_image = get_media_path($featured_image);

												?>
												<tr>
													<td><?php echo ++$i; ?>
													</td>
													<td>
														<input type="checkbox" id="singleId" class="checkAll"
															   value="<?php echo $prod->product_id ?>"/>
													</td>
													<td>
														<?php echo $prod->sku; ?>
													</td>

													<td>
														<img src="<?php echo $featured_image ?>" width="30"
															 height="30"/>
														&nbsp; <?php echo $prod->product_title ?>
													</td>
													<td><?php echo $category_name ?> </td>


													<td><?php echo $prod->purchase_price; ?></td>

													<td><?php echo $prod->product_price; ?></td>
													<td><?php echo $prod->discount_price; ?></td>
													<td> <?php echo $prod->product_stock; ?></td>
													<td> <?php echo $prod->created_time; ?></td>


													<td class="action text-right">
														<a title="edit"
														   href="<?php echo base_url() ?>product-edit/<?php echo $prod->product_id ?>"
														<span class="glyphicon glyphicon-edit btn btn-success"></span>
														</a>


														<a title="delete"
														   id="deleteSingleAll"
														   onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
															<span
																class="glyphicon glyphicon-trash btn btn-danger"></span>
														</a>


													</td>
												</tr>
												<?php
											}


										}
										?>
										</tbody>
									</table>
								</div>
							</form>
						</div>
						<?php echo $links; ?>
					</div>
				</div>
			</div>
		</section>
	</div>

</div>

</div>
</div>

<script>
	$(document).ready(function () {
		$("#ajax_pagingsearc a").attr('onclick', 'return main_page_pagination($(this));');
	});
</script>

<script>
	function main_page_pagination($this) {
		var url = $this.attr("href");
		if (url != '') {
			$.ajax({
				type: "POST",
				url: url,
				success: function (msg) {
					$("#ajaxdata").html(msg);
				}
			});
		}
		return false;
	}
</script>

<script>
	function search_content() {
		var base_url = "<?php echo base_url()?>";

		var product_title = $('#product_title').val();
		var counter = $('#counter').val();


		if ($.trim(product_title) != "") {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url()?>product/ProductController/index',
				data: {product_title: product_title, counter: counter},
				success: function (data) {
					$("#ajaxdata").html(data);
				}
			});
		} else {
			$.post(base_url + "product/ProductController/index", function (data) {
				$("#ajaxdata").html(data);
			});
		}
	}
</script>
<script>
	function totalProductCount() {
		var base_url = "<?php echo base_url()?>";
		var counter = $('#counter').val();
		if ($.trim(counter) != "") {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url()?>product/ProductController/index',
				data: {counter: counter},
				success: function (data) {
					$("#ajaxdata").html(data);
				}
			});
		} else {
			$.post(base_url + "product-list", function (data) {
				$("#ajaxdata").html(data);
			});
		}
	}
</script>


<script>

	$('#checkAll').change(function () {

		if ($(this).is(":checked")) {

			$('.checkAll').prop('checked', true);

		} else if ($(this).is(":not(:checked)")) {

			$('.checkAll').prop('checked', false);

		}

	});
	$('#deleteAll').click(function (e) {
		e.preventDefault();
		var productId = new Array();

		//var allId=$('.checkAll').val();
		$('.checkAll').each(function () {
			if ($(this).is(":checked")) {
				productId.push(this.value);
			}
		});

		$.ajax({

			url: '<?php echo base_url()?>product/ProductController/multipleDelete',
			data: {product_id: productId},
			type: 'post',
			success: function (data) {
				alert(data)
				window.location = '<?php echo base_url()?>product-list';
			}
		});


	});
	$(document).on('click', '#deleteSingleAll', function (e) {
		e.preventDefault();
		var productId = $('#singleId').val();

		$.ajax({

			url: '<?php echo base_url()?>product/ProductController/destroy',
			data: {product_id: productId},
			type: 'post',
			success: function (data) {
				alert(data)
				window.location = '<?php echo base_url()?>product-list';
			}
		});


	});

</script>
