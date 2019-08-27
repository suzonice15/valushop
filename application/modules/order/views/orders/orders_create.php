
<div class="col-md-offset-0 col-md-12">
<div class="box box-success ">
	<div class="box-header with-border">
		<h3 class="box-title"><?php if (isset($title)) echo $title ?></h3>
	</div>
	<?php echo validation_errors(); ?>
        <div class="box-body">
			<form method="POST" id="checkout" action="<?=base_url()?>order-create" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-4">
						<div class="box box-danger">
							<div class="box-header">
								<h3 class="box-title">Customer Informations</h3>
							</div>
							<div class="box-body">
								<div class="form-group ">
									<label for="billing_name">Name<span class="required">*</span></label>
									<input name="billing_name"  type="text" class="form-control"  id="billing_name" value="" />

								</div>
								<div class="form-group ">
									<label for="billing_email">Email</label>
									<input name="billing_email"  type="email" class="form-control"  id="billing_email" value="" />

								</div>
								<div class="form-group ">
									<label for="billing_phone">Phone<span class="required">*</span></label>
									<input name="billing_phone"  type="text" class="form-control"  id="billing_phone" value="" />

								</div>
								<div class="form-group shipping-address-group ">
									<label for="shipping_address1">Delivery Address<span class="required">*</span></label>
									<textarea class="form-control" rows="5" name="shipping_address1" id="shipping_address1"></textarea>
								</div>

<!--								--><?//=form_hidden('billing_address2', set_value('billing_address2'))?>
<!--								--><?//=form_hidden('billing_postcode', set_value('billing_postcode'))?>
<!--								--><?//=form_hidden('billing_city', set_value('billing_city'))?>
<!--								--><?//=form_hidden('billing_state', set_value('billing_state'))?>
<!--								--><?//=form_hidden('billing_country', 'Bangladesh')?>

								<div class="checkbox">
									<label>
										<input type="checkbox" name="ship_to_billing" id="ship_to_billing" value="1">
										<b class="fgreen">Same as Delivery Address</b>
									</label>
								</div>
								<div class="form-group ">
									<label for="billing_address1">Customer Address<span class="required">*</span></label>
									<textarea class="form-control " rows="5" name="billing_address1" id="billing_address1"> </textarea>
								</div>
<!---->
<!--								--><?//=form_hidden('shipping_name', set_value('shipping_name'))?>
<!--								--><?//=form_hidden('shipping_address2', set_value('shipping_address2'))?>
<!--								--><?//=form_hidden('shipping_postcode', set_value('shipping_postcode'))?>
<!--								--><?//=form_hidden('shipping_city', set_value('shipping_city'))?>
<!--								--><?//=form_hidden('shipping_state', set_value('shipping_state'))?>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Order Info</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<select name="product_ids" id="product_ids" class="form-control select2" multiple="multiple" data-placeholder="Type... product name here..." style="width:100%;">
										<?php if($orders): foreach ($orders as $order):?>
										<option value="<?php echo $order->product_id;?>"><?php echo $order->product_title;?></option>
										<?php endforeach;endif;?>
									</select>
								</div>
								<span id="product_html"></span>
							</div>
						</div>
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title">Actions</h3>
							</div>
							<div class="box-body">
								<div class="form-group" id="order_area">
									<label>
										<input type="radio" name="order_area" value="inside_dhaka" id="inside_dhaka" checked > Inside Dhaka
									</label>
									<br/>
									<label>
										<input type="radio" name="order_area" id="outside_dhaka" value="outside_dhaka"> Outside Dhaka
									</label>
								</div>
								<div class="form-group">
									<label>Courier Service</label>
									<select name="courier_service" id="courier_service" class="form-control">
										<?php if(isset($couriers)): foreach ($couriers as $courier) :?>
											<option value="<?php echo $courier->courier_name?>"><?php echo $courier->courier_name?></option>
										<?php endforeach;endif; ?>
									</select>
								</div>
								<div class="form-group ">
									<label for="courier_phone">Courier Phone<span class="required">*</span></label>
									<?=form_input(array('name'=>'courier_phone', 'class'=>'form-control', 'id'=>'courier_phone', 'value'=>set_value('courier_phone')))?>
								</div>
								<div class="form-group ">
									<label for="courier_email">Courier Email</label>
									<?=form_input(array('name'=>'courier_email', 'class'=>'form-control', 'id'=>'courier_email', 'value'=>set_value('courier_email')))?>
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
								<div class="form-group <?=form_error('shipment_time') ? 'has-error' : ''?>">
									<label>Shipping Date</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" name="shipment_time" class="form-control pull-right" id="datepicker" value="<?=date('m/d/Y')?>">
									</div>
								</div>
							</div>
							<div class="box-footer">
								<?=form_hidden('shipping_charge_in_dhaka', get_option('shipping_charge_in_dhaka'))?>
								<?=form_hidden('shipping_charge_out_of_dhaka', get_option('shipping_charge_out_of_dhaka'))?>
								<?=form_hidden('submission_level', '1')?>
								<?=form_hidden('created_by', 'office-staff')?>
								<?=form_hidden('staff_id', $user_id)?>
								<button type="submit" class="btn btn-success pull-right">Save</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
        </div>
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

