
<div class="col-md-offset-0 col-md-12">
	<div class="box box-success ">
		<div class="box-header with-border">
			<h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>
		</div>
		<div class="box-body">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">

				<?php
				$billing_name 		= $order->customer_name;
				$billing_phone 		= $order->customer_phone;
				$billing_email 		= $order->customer_email;
				$billing_address1 	= $order->customer_address;

				$delivery_cost 		= $order->shipping_charge;
				$discount 			= $order->order_id;
				$service_cost 		= $order->order_id;
				?>

				<form method="POST" id="order_update" action="<?=base_url()?>order-update" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-8">
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Customer Info</h3>
									<a href="javascript:void(0)" class="pull-right change_order_data">Change</a>
								</div>
								<div class="box-body">
									<table class="table table-striped table-bordered table-hover">
										<tbody>
										<tr>
											<td>
												<p><b>Name:</b> <?=$billing_name?></p>
												<p><b>Phone:</b> <?=$billing_phone?></p>
												<p><b>Email:</b> <?=$billing_email?></p>
												<p><b>Customer Address:</b><br/><?=$billing_address1?></p>
											</td>
										</tr>
										</tbody>
									</table>

									<span class="order_data" hidden>
										<hr class="break break10">
										<?php
										$billing_name = set_value('billing_name') ? set_value('billing_name') : $billing_name;
										?>
										<div class="form-group ">
											<label for="billing_name">Name<span class="required">*</span></label>
											<?php echo form_input(array('name'=>'billing_name', 'class'=>'form-control', 'id'=>'billing_name', 'value'=>$billing_name)); ?>
										</div>

										<?php
										$billing_email = set_value('billing_email') ? set_value('billing_email') : $billing_email;
										?>
										<div class="form-group ">
											<label for="billing_email">Email</label>
											<?php echo form_input(array('name'=>'billing_email', 'class'=>'form-control', 'id'=>'billing_email', 'value'=>$billing_email)); ?>
										</div>

										<?php
										$billing_phone = set_value('billing_phone') ? set_value('billing_phone') : $billing_phone;
										?>
										<div class="form-group ">
											<label for="billing_phone">Phone<span class="required">*</span></label>
											<?=form_input(array('name'=>'billing_phone', 'class'=>'form-control', 'id'=>'billing_phone', 'value'=>$billing_phone))?>
										</div>

										<?php
										$billing_address1 = set_value('billing_address1') ? set_value('billing_address1') : $billing_address1;
										?>
										<div class="form-group ">
											<label for="billing_address1">Customer Address<span class="required">*</span></label>
											<textarea class="form-control <?php echo form_error('billing_address1') ? 'validation-error' : null; ?>" rows="2" name="billing_address1" id="billing_address1"><?=$billing_address1?></textarea>
										</div>
									</span>
								</div>
							</div>



							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Order Info</h3>
								</div>
								<div class="box-body">
									<span id="product_html">
										<table class="table table-striped table-bordered">
											<tr>
											<th class="name" width="5%">Product</th>
					<th class="image text-center" width="5%">Image</th>
						<th class="image text-center" width="10%">Size</th>
							<th class="image text-center" width="20%">Color</th>
					<th class="quantity text-center" width="10%">Qty</th>
					<th class="price text-center" width="10%">Price</th>
					<th class="total text-right" width="10%">Sub-Total</th>
											</tr>
											<?php
											$product_ids = array();
											$proSizeList=0;
											$product_items = unserialize($order->products);
											$product_items['items'];


$html=null;
											if(is_array($product_items['items']))
											{
												foreach($product_items['items'] as $product_id=>$item)
												{
													$featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

													$product_ids[] = $product_id;





													$html.='<tr>
														<td>'.(isset($item['name']) ? $item['name'] : null).'</td>	
													
														<td class="image text-center">
															<img src="'.$featured_image.'" height="30" width="30">
														</td>
														
														<td>
								';

				$html .= '</td>';

				$html.='</td><td class="text-center">
															<input type="number" name="products[items]['.$product_id.'][qty]" class="form-control item_qty" value="'.(isset($item['qty']) ? $item['qty'] : null).'" data-item-id="'.$product_id.'" style="width:60px;">
														</td>
														<td class="text-center">TK '.(isset($item['price']) ? $item['price'] : null).'</td>
														<td class="text-right">TK '.(isset($item['subtotal']) ? $item['subtotal'] : null).'</td>
													</tr>';

													$html.=form_hidden('products[items]['.$product_id.'][featured_image]', $featured_image);
													$html.=form_hidden('products[items]['.$product_id.'][price]', isset($item['price']) ? $item['price'] : null);
													$html.=form_hidden('products[items]['.$product_id.'][Size]', isset($item['Size']) ? $item['Size'] : null);
													$html.=form_hidden('products[items]['.$product_id.'][Color]', isset($item['Color']) ? $item['Color'] : null);
													$html.=form_hidden('products[items]['.$product_id.'][name]', isset($item['name']) ? $item['name'] : null);
													$html.=form_hidden('products[items]['.$product_id.'][subtotal]', isset($item['subtotal']) ? $item['subtotal'] : null);


												}
											}

											echo $html;
											?>
										</table>
										<table class="table table-striped table-bordered">
											<tbody>
												<tr>
													<td>
														<span class="extra bold">Delivery Cost</span>
													</td>
													<td class="text-right">
														<span class="bold">TK <span id="delivery_cost"><?=$delivery_cost?></span></span>
														<?=form_hidden('shipping_charge', $delivery_cost)?>
													</td>
												</tr>

												<?php
												if($service_cost)
												{
													?><tr>
													<td>
															<span class="extra bold service_cost" data-service_cost="<?=$service_cost?>">Service Cost</span>
														</td>
														<td class="text-right">
															TK <?=$service_cost?>
															<?=form_hidden('service_cost', $service_cost)?>
														</td>
													</tr><?php
												}
												?>

												<?php
												$delivery_cost_Out_Side_Dhaka = get_option('shipping_charge_out_of_dhaka');
												if($discount)
												{
													?><tr>
													<td>
															<span class="extra bold discount" data-discount="<?=$service_cost?>">Discount</span>
														</td>
														<td class="text-right">
															TK <?=$discount?>
															<?=form_hidden('shipping_charge', $discount)?>
															<?=form_hidden('shipping_charge_Out', $discount)?>
														</td>
													</tr><?php
												}
												?>

												<tr>
													<td>
														<span class="extra bold totalamout">Total</span>
													</td>
													<td class="text-right">
														<span class="bold totalamout">TK <span id="total_cost"><?=$order->order_total?></span></span>
														<?=form_hidden('order_total', $order->order_total)?>
														<?=form_hidden('checkout_type', 'cash_on_delivery')?>
													</td>
												</tr>


											</tbody>
										</table>
									</span>

									<div class="form-group">
										<select name="product_ids" id="product_ids" class="form-control select2" multiple="multiple" data-placeholder="Type... product name here..." style="width:100%;">
											<?=get_option_based_product(true, $product_ids)?>
										</select>
									</div>

									<div class="form-group">
										Service Cost: <input type="text" id="service_cost" class="form-control" value="<?=$service_cost?>">
									</div>

									<div class="form-group">
										Discount: <input type="text" id="discount" class="form-control" value="<?=$discount?>">
									</div>

									<a href="javascript:void(0)" class="btn btn-primary apply_cost">Apply Cost</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="box box-danger">
								<div class="box-header">
									<h3 class="box-title">Actions</h3>
								</div>
								<div class="box-body">
									<?php
									$order_area =$order->order_area;
									if(!$order_area)
									{
										$order_area = 'inside_dhaka';
									}
									?>
									<div class="form-group" id="order_area">
										<label>
			<input type="radio" name="order_area" value="inside_dhaka" id="inside_dhaka" <?=$order_area=='inside_dhaka' ? 'checked' : NULL?>> Inside Dhaka
										</label>
										<br/>
										<label>
											<input type="radio" id="outside_dhaka" name="order_area" value="outside_dhaka" <?=$order_area=='outside_dhaka' ? 'checked' : NULL?>> Outside Dhaka
										</label>
									</div>


									<div class="form-group">
<!--										--><?php
//										$couriers = unserialize(get_option('courier'));
//										//echo '<pre>'; print_r($couriers); echo '</pre>';
//
//										if($couriers)
//										{
//											$courier_option=NULL;
//
//											foreach($couriers as $index=>$courier)
//											{
//												if($courier['type']==$order_area)
//												{
//													$courier_option[$courier['courier']] = $courier['courier'];
//												}
//											}
//
//											$selected_courier = set_value('courier_service') ? set_value('courier_service') : $order->courier_service;
//
//											echo '<div class="courier_service_option_area">'.form_dropdown('courier_service', $courier_option, $selected_courier, array('class'=>'form-control', 'id'=>'courier_service')).'</div>';
//										}
//										?>
										<div class="form-group">
											<label>Courier Service</label>
											<select name="courier_service" id="courier_service" class="form-control">
												<?php if(isset($couriers)): foreach ($couriers as $courier) :?>
													<option value="<?php echo $courier->courier_name?>"><?php echo $courier->courier_name?></option>
												<?php endforeach;endif; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label>Shipping Date</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<?php
											$shipment_time = date('m/d/Y', strtotime($order->shipment_time));
											if(strtotime($order->shipment_time) < strtotime(date('d-m-Y')))
											{
												$shipment_time = date('m/d/Y');
											}
											?>
											<input type="text" name="shipment_time" class="form-control pull-right" id="datepicker" value="<?=$shipment_time?>">
										</div>
									</div>
									<div class="form-group">
										<label>Order Status</label>
										<select name="order_status" id="order_status" class="form-control">
											<option value="new">New</option>
											<option value="pending">Pending</option>
											<option value="pending_payment">Pending Payment</option>
											<option value="processing">Processing</option>
											<option value="on_courier">On Courier Service</option>
											<option value="ready_to_deliver">Ready To Deliver</option>
											<option value="delivered">Delivered</option>
											<option value="cancled">Cancled</option>
										</select>
									</div>
								</div>
								<div class="box-footer">
									<input type="hidden" name="row_id" value="<?=$order->order_id?>">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
		<!--
		<script>

		$(document).on('change',"#outside_dhaka",function () {
		var courier_id= 2;
		$.ajax({
		type: "POST",
		data: {courier_id: courier_id},
		url: "<?php echo base_url();?>order/OrderController/CourierSelection",
		success: function (data) {
		$('#courier_service').html(data);
		}
		});
		});

		$(document).on('change',"#inside_dhaka",function () {
		var courier_id= 1;
		$.ajax({
		type: "POST",
		data: {courier_id: courier_id},
		url: "<?php echo base_url();?>order/OrderController/CourierSelection",
		success: function (data) {
		$('#courier_service').html(data);
		}
		});
		});


		$(document).on('click',".change_order_data",function () {
			$('.order_data').toggle();
		});
		$(document).on('click',".change_order_data",function () {
			$('.order_data').toggle();
		});
		</script>
		<script>
			$(document).ready(function () {
				$(document).on('change','#product_ids',function () {
					var product_ids = [];
					$.each($("form#checkout #product_ids option:selected, form#order_update #product_ids option:selected"), function()
					{
						product_ids.push($(this).val());
					});

					product_ids = product_ids.join(",");
					$.ajax({
						type: "POST",
						data: {product_id: product_ids,product_quantity : 1},
						url:"<?php echo base_url();?>order/OrderController/productSelection",
						success:function (result) {

							var response = JSON.parse(result);


							jQuery('form#checkout #product_html, form#order_update #product_html').html(response.html);
						},
						errors: function (result) {

						}

					});

				});

				$(document).on('change',"#outside_dhaka",function () {
					var courier_id= 2;
					$.ajax({
						type: "POST",
						data: {courier_id: courier_id},
						url: "<?php echo base_url();?>order/OrderController/CourierSelection",
						success: function (data) {
							$('#courier_service').html(data);
						}
					});
				});
				$(document).on('change',"#inside_dhaka",function () {
					var courier_id= 1;
					$.ajax({
						type: "POST",
						data: {courier_id: courier_id},
						url: "<?php echo base_url();?>order/OrderController/CourierSelection",
						success: function (data) {
							$('#courier_service').html(data);
						}
					});
				});

				$("#ship_to_billing,#billing_address1").change(function() {
					if($(this).prop('checked')) {
						var deleveryAdress= $("#shipping_address1").val();
						$("#billing_address1").val(deleveryAdress);
					} else {
						$("#billing_address1").val("");
					}
				});

			});
		</script>
		-->
		<script>
			$(document).ready(function () {
				$(document).on('change','#product_ids',function () {
					var product_ids = [];
					$.each($("form#checkout #product_ids option:selected, form#order_update #product_ids option:selected"), function()
					{
						product_ids.push($(this).val());
					});

					product_ids = product_ids.join(",");
					$.ajax({
						type: "POST",
						data: {product_id: product_ids,product_quantity : 1},
						url:"<?php echo base_url();?>order/OrderController/productSelection",
						success:function (result) {

							var response = JSON.parse(result);


							$('form#checkout #product_html, form#order_update #product_html').html(response.html);
						},
						errors: function (result) {

						}

					});

				});

				$(document).on('change',"form#checkout #outside_dhaka, form#order_update #outside_dhaka",function () {
					var courier_id= 2;
					var inside_dhaka =  jQuery("input[name='shipping_charge']").val();
					var outside_dhaka =  jQuery("input[name='shipping_charge_Out']").val();
					var total =  jQuery('.bold #total_cost').text();

					var total_price=parseFloat(total)+parseFloat(outside_dhaka)-parseFloat(inside_dhaka);
					jQuery('.bold #delivery_cost').text(outside_dhaka);

					jQuery("input[name='order_total']").val(total_price);
					jQuery('.bold #total_cost').text(total_price);
					$.ajax({
						type: "POST",
						data: {courier_id: courier_id},
						url: "<?php echo base_url();?>order/OrderController/CourierSelection",
						success: function (data) {
							$('#courier_service').html(data);
						}
					});
				});
				$(document).on('change',"form#checkout #inside_dhaka, form#order_update #inside_dhaka",function () {
					var courier_id= 1;
					var inside_dhaka =  jQuery("input[name='shipping_charge']").val();
					var outside_dhaka =  jQuery("input[name='shipping_charge_Out']").val();
					alert(outside_dhaka)
					var total =  jQuery('.bold #total_cost').text();

					var total_price=parseFloat(total)-parseFloat(outside_dhaka)+parseFloat(inside_dhaka);
					jQuery('.bold #delivery_cost').text(inside_dhaka);

					jQuery("input[name='order_total']").val(total_price);
					jQuery('.bold #total_cost').text(total_price);
					$.ajax({
						type: "POST",
						data: {courier_id: courier_id},
						url: "<?php echo base_url();?>order/OrderController/CourierSelection",
						success: function (data) {
							$('#courier_service').html(data);
						}
					});
				});

				$("#ship_to_billing,#billing_address1").change(function() {
					if($(this).prop('checked')) {
						var deleveryAdress= $("#shipping_address1").val();
						$("#billing_address1").val(deleveryAdress);
					} else {
						$("#billing_address1").val("");
					}
				});



				$('body').on('click', 'form#checkout .update_items, form#order_update .update_items', function()
				{
					var product_ids = [];
					var product_qtys = [];

					$.each($("form#checkout .item_qty, form#order_update .item_qty"), function()
					{
						product_ids.push($(this).attr('data-item-id'));
						product_qtys.push($(this).val());
					});

					product_ids = product_ids.join(",");
					product_qtys = product_qtys.join(",");

					$.ajax({
						type: 'POST',
						data: {
							"product_ids" : product_ids,
							"product_qtys" : product_qtys
						},
						url:"<?php echo base_url();?>order/OrderController/productSelectionUpdate",
						success: function(result)
						{
							//alert('success');
							var response = JSON.parse(result);
							$('form#checkout #product_html, form#order_update #product_html').html(response.html);
						}
					});
				});




			});
		</script>



