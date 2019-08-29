<br>
<div class="container-fluid">

	<div class="row">

		<div class="col-md-5 col">
			<div class="card">
				<div class="card-header">কাস্টমার ইনফরমেশন</div>
				<div class="card-body">
					<div class="checkoutstep" style="display: block;">
						<div class="form-group">
							<label for="billing_name">Name<span class="text-danger">*</span></label>
							<input type="text" name="billing_name" value="" class="form-control " id="billing_name"
								   placeholder="Name">
						</div>
						<div class="form-group">
							<label for="billing_name">Phone<span class="text-danger">*</span></label>

							<input type="text" name="billing_phone" value="" class="form-control "
								   id="billing_phone" placeholder="Phone">
						</div>
						<div class="form-group">
							<label for="billing_name">Email</label>

							<input type="text" name="billing_email" value="" class="form-control "
								   id="billing_email" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="billing_name">Delivery to Where ?<span class="text-danger">*</span></label>

							<select name="order_area" class="form-control" id="order_area">
								<option value="inside_dhaka">Inside Dhaka</option>
								<option value="outside_dhaka">Out of Dhaka</option>
							</select>
						</div>
						<div class="form-group shipping-address-group">
							<label for="billing_name">Delivery Address</label>

							<textarea class="form-control " rows="2" name="shipping_address1" id="shipping_address1"
									  placeholder="Delivery Address"></textarea>
						</div>
					</div>

					<div class="checkout-box order-confirmation">
						<div class="submit-btns">
							<button type="button" class="btn btn-success confirm_order">অর্ডার কনফার্ম করুন</button>

							<a href="http://www.kalerhaat.com/" class="btn btn-info">আরো শপিং করুন</a>
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


					<form name="checkout" id="checkout" method="post">
					<span class="checkout-fields">


							<div class="checkoutstep">
								<div class="cart-info">
									<table class="table table-striped table-bordered">
										<tbody>
										<tr>
											<th class="name">প্রোডাক্ট</th>
											<th class="name">পরিমান</th>
											<th class="name">মূল্য</th>
											<th class="name">মোট</th>
											<th class="total text-right">মুছে ফেলুন</th>
										</tr>

											<?php
											foreach ($this->cart->contents() as $items) {
											$featured_image = get_product_meta($items['id'], 'featured_image');
											$featured_image = get_media_path($featured_image, 'thumb');

											?>
										<tr>
											<td>
												<img src="<?=$featured_image ?>" width="50">
												<p><?=get_product_title($items['id'])?></p>
											</td>

											<td>
												<div class="quantity-action" data-rowid="<?=$items['rowid']?>">
									<div class="qtyplus btn btn-danger  btn-sm" data-action_type="plus">+</div>
													<input type="text" class=" col-5" id="quantity_value" value="<?=$items['qty']?>">
									<div class="qtyminus btn btn-success  btn-sm " data-action_type="minus">-</div>
								</div>
											</td>

												<td>
												 <?=$this->cart->format_number($items['price'])?> টাকা
											</td>
											<td>
												 <?=$this->cart->format_number($items['subtotal'])?> টাকা
											</td>
											<td>
                                        <a href="javascript:void(0)" onclick="CartDataRemove('68a83eeb494a308fe5295da69428a507')" style="color:#1D70BA ;font-weight: bold;background: #ddd;padding: 2px 5px;">
                                            <i class="fa fa-remove" title="Remove"></i>
                                        </a>
                                    </td>




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
											<tr>
												<td>
													<span class="extra bold">Sub-Total</span>
												</td>
												<td class="text-right">
													<span class="bold">৳
														<span id="subtotal_cost">
														<?=$this->cart->format_number($this->cart->total())?>													</span>
													</span>
												</td>
											</tr>
											<tr>
												<td>
													<span class="extra bold">Delivery Cost</span>
												</td>
												<td class="text-right">
													<span class="bold">৳ <span id="delivery_cost"><?=$delivery_cost?></span></span>


<input type="hidden" name="shipping_charge" value="50">
												</td>
											</tr>
											<tr>
												<td>
													<span class="extra bold totalamout">Total</span>
												</td>
												<td class="text-right">
													<span class="bold totalamout">৳ <span
															id="total_cost"><?=$this->cart->format_number($order_total)?></span></span>


<input type="hidden" name="order_total" value="<?=$order_total?>">


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
	</div>

</div>
