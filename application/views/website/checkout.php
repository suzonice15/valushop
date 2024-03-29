<?php
$cart_items = 0;
foreach ($this->cart->contents() as $key => $val) {
	if (!is_array($val) OR !isset($val['price']) OR !isset($val['qty'])) {
		continue;
	}

	$cart_items += $val['qty'];
}
?>

<br>


<div class="container-fluid">

	<div class="row">
		<?php if (!empty($cart_items)) { ?>
			<div class="col-md-5 col">
				<div class="card">
					<div class="card-header">কাস্টমার ইনফরমেশন</div>
					<div class="card-body">
						<form action="<?php echo base_url() ?>chechout" id="checkout" method="post">

							<div class="checkoutstep" style="display: block;">
								<div class="form-group">
									<label for="billing_name">Name<span class="text-danger">*</span></label>
									<input type="text" name="customer_name" value="" class="form-control "
										   id="billing_name"
										   placeholder="Name">
								</div>
								<div class="form-group">
									<label for="billing_name">Phone<span class="text-danger">*</span></label>

									<input type="text" name="customer_phone" value="" class="form-control "
										   id="billing_phone" placeholder="Phone">
								</div>
								<div class="form-group">
									<label for="billing_name">Email</label>

									<input type="text" name="customer_email" value="" class="form-control "
										   id="billing_email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="billing_name">Delivery to Where ?<span
											class="text-danger">*</span></label>

									<select name="order_area" class="form-control" id="order_area">
										<option value="inside_dhaka">Inside Dhaka</option>
										<option value="outside_dhaka">Out of Dhaka</option>
									</select>
								</div>

								<div class="form-group shipping-address-group">
									<label for="shipping_address1">Delivery Address</label>

									<textarea class="form-control " rows="2" name="customer_address"
											  id="shipping_address1"
											  placeholder="Delivery Address"></textarea>
								</div>
							</div>

							<div class="checkout-box ">
								<div class="submit-btns">
									<input type="submit" class="btn btn-success " value="অর্ডার কনফার্ম করুন"></input>

									<a href="<?php echo base_url() ?>" class="btn btn-info">আরো শপিং করুন</a>
								</div>
							</div>
							<hr class="break break20">


					</div>
				</div>
			</div>

			<div class="col-md-7 col">
				<div class="card">
					<div class="card-header">অর্ডার ইনফরমেশন</div>
					<div class="card-body">


					<span class="checkout-fields">


							<div class="checkoutstep">
								<div class="cart-info">
									<table class="table table-striped table-bordered">
										<tbody>
										<tr>
											<th width="30%" class="name">প্রোডাক্ট</th>
											<th width="40%" class="name">পরিমান</th>
											<th width="10%" class="name">মূল্য</th>
											<th width="10%" class="name">মোট</th>
											<th width="1%" class="total text-right">মুছে ফেলুন</th>
										</tr>

											<?php
											foreach ($this->cart->contents() as $items) {
												$featured_image = get_product_meta($items['id'], 'featured_image');
												$featured_image = get_media_path($featured_image, 'thumb');

												?>
												<tr>
											<td>
												<img src="<?= $featured_image ?>" width="50">

												<p><?= get_product_title($items['id']) ?></p>
											</td>

											<td>
												<div class="quantity-action">
									<div class="qtyplus btn btn-danger  btn-sm col-md-2 col-12"
										 onclick="IncrementFunction('quantity_value_<?= $items['id'] ?>','<?= $items['rowid'] ?>')">+</div>


<div class="col-md-2">
													 <span style="float: left;
                                                font-size: 18px;
                                                text-align: center;
                                                color: gray;
                                                cursor: pointer;
                                                border: 1px solid #ddd;
                                                height: 36px;
                                                line-height: 30px;
                                                padding: 2px 4px;width: 50px;"
														   id="quantity_value_<?= $items['id'] ?>"><?= $items['qty'] ?></span>
</div>


									<div
										onclick="DecrementFunction('quantity_value_<?= $items['id'] ?>','<?= $items['rowid'] ?>')"
										class="qtyminus btn btn-success  btn-sm col-md-2 col-12"
										data-action_type="minus">-</div>
								</div>
											</td>

												<td>
													<span
														id="per_poduct_price"> <?= $this->cart->format_number($items['price']) ?></span> টাকা
											</td>
											<td>
												<span id="per_poduct_total_price_<?=$items['id']?>">
												 <?= $this->cart->format_number($items['subtotal']) ?>
													</span>
													টাকা


											</td>
											<td>
                                        <a href="javascript:void(0)"
										   onclick="CartDataRemove('68a83eeb494a308fe5295da69428a507')"
										   style="color:#1D70BA ;font-weight: bold;background: #ddd;padding: 2px 5px;">
                                            <i class="fa fa-remove" title="Remove"></i>
                                        </a>
                                    </td>


														<input type="text"
															   name="products[items][<?php echo $items['id'] ?>][featured_image]"
															   value="<?php echo $featured_image ?>">
					<input type="text" id="product_quantity" name="products[items][<?php echo $items['id'] ?>][qty]"
						   value="<?php echo $items['qty'] ?>">
					<input type="hidden" id="product_price" name="products[items][<?php echo $items['id'] ?>][price]"
						   value="<?php echo $this->cart->format_number($items['price']) ?>">
					<input type="text" id="total_product_price"
						   name="products[items][<?php echo $items['id'] ?>][subtotal]"
						   value="<?php echo $this->cart->format_number($items['subtotal']) ?>">


					<input type="hidden" name="products[items][<?php echo $items['id'] ?>][name]"
						   value="<?php echo get_product_title($items['id']) ?>">
					<input type="hidden" name="checkout_type" value="cash_on_delivery">
													<input type="hidden" id="shipping_charge_in_dhaka"
														   value="<?php echo get_option('shipping_charge_in_dhaka') ?>">
	<input type="hidden" id="shipping_charge_out_of_dhaka" value="<?php echo get_option('shipping_charge_out_of_dhaka') ?>
">


										</tr>


											<?php } ?>

									</tbody>
									</table>


									<table class="table table-striped table-bordered review_cost">
										<tbody>
										<?php
										$delivery_cost = get_option('shipping_charge_in_dhaka');
										$order_total = $this->cart->total() + $delivery_cost;
										?>
										<?= form_hidden('order_total', $this->cart->format_number($order_total)) ?>
															<input type="text" name="order_total"
																   value="<?php echo $this->cart->format_number($order_total) ?>">


											<tr>
												<td>
													<span class="extra bold">Sub-Total</span>
												</td>
												<td class="text-right">
													<span class="bold">৳
														<span id="subtotal_cost">
														<?= $this->cart->format_number($this->cart->total()) ?>													</span>
													</span>
												</td>
											</tr>
											<tr>
												<td>
													<span class="extra bold">Delivery Cost</span>
												</td>
												<td class="text-right">
													<span class="bold">৳ <span
															id="delivery_cost"><?= $delivery_cost ?></span></span>


<input type="text" id="shipping_charge" name="shipping_charge" value="<?= $delivery_cost ?>">
												</td>
											</tr>
											<tr>
												<td>
													<span class="extra bold totalamout">Total</span>
												</td>
												<td class="text-right">
													<span class="bold totalamout">৳ <span
															id="total_cost"><?= $this->cart->format_number($order_total) ?></span></span>


<input type="text" name="order_total" value="<?= $order_total ?>">


<input type="hidden" name="checkout_type" value="cash_on_delivery">
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
					</div>
					</span>
					</form>


				</div>

			</div>
		<?php } else { ?>
			<div class="col-md-12 text-center"><a href="<?php echo base_url() ?>"><img style="margin-bottom: -68px"
																					   src="<?php echo base_url() ?>images/stop.png"/></a>
			</div>
			<div class="col-md-12 mt-5 text-center">
				<h1 class="text-danger text-center">You have no product to checkout.
				</h1>
				<a class="text-center text-capitalize btn btn-info" href="<?php echo base_url() ?>"> back to home</a>
			</div>
		<?php } ?>

	</div>

</div>

<script>
	$('#order_area').change(function () {
		var order_area = $(this).children("option:selected").val();
		if(order_area=='outside_dhaka'){
		var charge=$('#shipping_charge_out_of_dhaka').val();

		var total_cost=$('#subtotal_cost').text();
		var total =parseFloat(charge)+parseFloat(total_cost);
			$('#total_cost').text(total.toFixed(2));
			$('input[name=order_total]').val(total);


			$('#shipping_charge').val(charge);

		} else {
			var charge=$('#shipping_charge_in_dhaka').val();
			$('#shipping_charge').val(charge);
			var total_cost=$('#subtotal_cost').text();
			var total =parseFloat(charge)+parseFloat(total_cost);
			$('input[name=order_total]').val(total);

			$('#total_cost').text(total.toFixed(2));



		}

	});

</script>

<script>


	function IncrementFunction(Obj, rowid) {
		var id_list = Obj.split("_");
		var id=id_list[2];
		alert(id)

		var quantity = document.getElementById(Obj).innerHTML;
		//var quantity = Number(x) + 1;
		if (quantity) {
			quantity++;
			quantity = document.getElementById(Obj).innerHTML = quantity;
		}

		var row_id = rowid;
		//var action_type=jQuery(this).attr('data-action_type');
		$.ajax({
			type: "POST",
			dataType: "json",
			url: '<?php echo base_url() ?>ajax/update_to_cart',
			data: {rowid: rowid, quantity: quantity},
			success: function (data) {
				var total = data.total_amount;

				$('input[name=order_total]').val(total);
				$('#subtotal_cost').text(data.total_amount.toFixed(2));
				$('#total_product_price').text(data.total_amount);
				var unit = $('#per_poduct_price').text();
				var total_product_price = parseFloat(unit * quantity);
				$('#per_poduct_total_price_'+id+'').text(total_product_price.toFixed(2));
				$('#total_product_price').val(total_product_price);
				$('#product_price').val(total_product_price.toFixed(2));
				$('#product_quantity').val(quantity);
			}


		});


	}

	function DecrementFunction(Obj, rowid) {
		var x = document.getElementById(Obj).innerHTML;
		var quantity = Number(x) - 1;
		var row_id = rowid;


		if (quantity >= 1) {
			document.getElementById(Obj).innerHTML = quantity;

			$.ajax({
				type: "POST",
				dataType: "json",
				url: '<?php echo base_url() ?>ajax/update_to_cart',
				data: {rowid: rowid, quantity: quantity},
				success: function (data) {
					$('#subtotal_cost').text(data.total_amount);
				}
			});


		}
	}
</script>
