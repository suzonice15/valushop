            	<table border="0" cellpadding="0" cellspacing="0" width="600" style="background:#ffffff;">
                	<tr>
                        <td valign="top" style="padding:20px 20px 0;">
							<p style="margin:0 0 10px;font-family:Tahoma,Arial,sans-serif;font-size:14px;font-weight:bold;">Dear <?=$customer_name?>,</p>

							<p style="margin:0;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
								Your order has beed completed successfully.
							</p>
						</td>
					</tr>
					<tr>
                        <td valign="top" style="padding:0 20px 20px;">
							<table cellpadding="0" cellspacing="0" style="width:100%;">
								<tr style="background:#f9f9f9;">
									<th style="width:50%;padding:8px;border:1px solid #ddd;text-align:left;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Product
									</th>
									<th style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Price
									</th>
								</tr>
								
								<?php
								foreach($product_items['items'] as $product_id=>$item)
								{
									$stock_qty = intval(get_product_meta($product_id, 'stock_qty'));
									update_product_meta($product_id, 'stock_qty', ($stock_qty - $item['qty']));

									$featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;
									
									?><tr>
										<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
											<img src="<?=$featured_image?>" height="50" width="50" style="float:left;margin-right:10px;"/>
											<div class="item-name-and-price">
												<div class="item-name">'<?=$item['name']?></div>
												<div>
													<span style="font-family:'SiyamRupaliANSI';">TK <?=$item['price']?></span> x <span style="font-family:'SiyamRupaliANSI';"><?=$item['qty']?></span>
												</div>
											</div>
										</td>
										<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;">
											<span style="font-family:'SiyamRupaliANSI';">TK <?=$item['subtotal']?></span>
										</td>
									</tr><?php
								}
								?>
							</table>

							<br>

							<table cellpadding="0" cellspacing="0" style="width:100%;">
								<tr style="background:#f9f9f9;">
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Delivery Cost
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<span style="font-family:'SiyamRupaliANSI';">TK <?=$shipping_charge?></span>
									</td>
								</tr>
								<tr style="background:#f9f9f9;">
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Total
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<span style="font-family:'SiyamRupaliANSI';">TK <?=$order_total?></span>
									</td>
								</tr>
								<tr>
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Order Number
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<span style="font-family:'SiyamRupaliANSI';"><?=$order_number?></span>
									</td>
								</tr>
								<tr style="background:#f9f9f9;">
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Payment Method
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<?=$payment_method?>
									</td>
								</tr>
							</table>

							<br>

							<table cellpadding="0" cellspacing="0" style="width:100%;">
								<tr style="background:#f9f9f9;">
									<th style="width:50%;padding:8px;border:1px solid #ddd;text-align:left;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Delivery Address
									</th>
									<th style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Address
									</th>
								</tr>
								<tr>
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<?=$delivery_address?>
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<?=$customer_address?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>