<section id="mpart">
	<section class="container">
		<div class="row">
			<div class="col-sm-12 maincnt mt20">
				<section id="thankyou">
					<?php
					if((isset($order)) )
					{
					
						
						?><h1  class="btn btn-success text-center  col-12 mt-2">Thank you.<?php echo $order->customer_name;?> Your order has been received.</h1>
						<div class="row">
							<div class="col-sm-12">
								<div class="card card-default">
									<div class="card-header">
										<h5 class="float-left">Order Details</h5><h5 ><a href="#" class="float-right" onclick="printFunction()">Download</a></h5>
									</div>
									<div class="card-body">
										<div class="cart-info">
											<table class="table table-striped table-bordered">
												<tr>
													<th class="name">Product</th>
													<th class="price text-right">Price</th>
												</tr>
												<?php
												$product_items = unserialize($order->products);
												//echo '<pre>'; print_r($product_items); echo '</pre>';
												
												foreach($product_items['items'] as $product_id=>$item)
												{
													$featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;
													?><tr>
														<td class="product-item" style="width:50%">
															<a>
																<img src="<?=$featured_image?>" height="30" width="30"/>
															</a>
															<div class="item-name-and-price">
																<div class="item-name">
																	<?=$item['name']?>
																</div>
																<div class="item-price">
																	TK <?=$item['price']?> x <?=$item['qty']?>
																</div>
															</div>
														</td>
														<td class="text-right" style="width:50%">
															TK <?=$item['subtotal']?>
														</td>
													</tr><?php
												}
												?>
											</table>
											<table class="table table-striped table-bordered">
												<tbody>
													<tr>
														<td style="50%">
															<span class="extra bold totalamout">Delivery Cost</span>
														</td>
														<td class="text-right" style="width:50%">
															<span class="bold totalamout">TK <?=$order->shipping_charge;?></span>
														</td>
													</tr>
													<tr>
														<td style="50%">
															<span class="extra bold totalamout">Total</span>
														</td>
														<td class="text-right" style="width:50%">
															<span class="bold totalamout">TK <?=$order->order_total?></span>
														</td>
													</tr>
													<tr>
														<td style="50%">
															<span class="extra bold">Order number</span>
														</td>
														<td class="text-right" style="width:50%">
															<span class="bold"><?=($order->order_id < 10 ? 0 : '').$order->order_id?></span>
														</td>
													</tr>
													<tr>
														<td style="50%">
															<span class="extra bold">Payment method</span>
														</td>
														<td class="text-right" style="width:50%">
															<span class="bold"><?=ucwords(str_replace("_", " ", $order->payment_type))?></span>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div><?php
					}

					else
					{
						?><h1 class="error">Invalid Order Request!</h1><?php
					}
					?>
				</section>
			</div>
		</div>
	</section>
</section>



<script>function printFunction(){ window.print(); }</script>
