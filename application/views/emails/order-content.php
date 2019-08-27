            	<table border="0" cellpadding="0" cellspacing="0" width="600" style="background:#ffffff;">
                	<tr>
                        <td valign="top" style="padding:20px 20px 0;">
							<p style="margin:0 0 10px;font-family:Tahoma,Arial,sans-serif;font-size:14px;font-weight:bold;">Dear <?=$customer_name?>,</p>

							<p style="margin:0;font-family:Tahoma,Arial,sans-serif;font-size:14px;">Thank you so much to choose online DhakaBaazar.com</p>
							
                        	<?php
                        	if($order_status=='processing')
                        	{
                        		?><p style="margin:0;font-family:Tahoma,Arial,sans-serif;font-size:14px;">Your order is on processing. You can get last status by login to our site DhakaBaazar.com. You can inform to us anything without any hesitation.</p><?php
                        	}
                        	elseif($order_status=='pending')
                        	{
                        		?><p style="margin:0;font-family:Tahoma,Arial,sans-serif;font-size:14px;">Your order is on waiting. You can get last status by login to our site DhakaBaazar.com. You can inform to us anything without any hesitation.</p><?php
                        	}
                        	elseif($order_status=='delivered')
                        	{
                        		?><p style="margin:0;font-family:Tahoma,Arial,sans-serif;font-size:14px;">We informed that you already received your product.</p><?php
                        	}
                        	?>
						</td>
					</tr>
                	<tr>
                        <td align="center" valign="top" style="padding:20px;">
                        	<a href="<?=base_url('trackorder/?track_id=&track_type=')?>" style="display:inline-block;background:#074488;padding:7px 15px;border-radius:4px;color:#ffffff;font-family:Tahoma,Arial,sans-serif;font-size:14px;">Track Order
						</td>
					</tr>
					<tr>
                        <td valign="top" style="padding:0 20px 20px;">
							<table cellpadding="0" cellspacing="0" style="width:100%;">
								<tr>
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Order Status
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<?=$order_status?>
									</td>
								</tr>
							</table>
							
							<br>

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
									$featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;
									
									?><tr>
										<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
											<img src="<?=$featured_image?>" height="50" width="50" style="float:left;margin-right:10px;"/>
											<div class="item-name-and-price">
												<div class="item-name">'<?=$item['name']?></div>
												<div>
													<span style="font-family:'Open Sans', sans-serif;">TK <?=$item['price']?></span> x <span style="font-family:'Open Sans', sans-serif;"><?=$item['qty']?></span>
												</div>
											</div>
										</td>
										<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;">
											<span style="font-family:'Open Sans', sans-serif;">TK <?=$item['subtotal']?></span>
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
										<span style="font-family:'Open Sans', sans-serif;">TK <?=$shipping_charge?></span>
									</td>
								</tr>
								<tr style="background:#f9f9f9;">
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Total
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<span style="font-family:'Open Sans', sans-serif;">TK <?=$order_total?></span>
									</td>
								</tr>
								<tr>
									<td style="width:50%;padding:8px;border:1px solid #ddd;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										Order Number
									</td>
									<td style="width:50%;padding:8px;border:1px solid #ddd;text-align:right;font-family:Tahoma,Arial,sans-serif;font-size:14px;">
										<span style="font-family:'Open Sans', sans-serif;"><?=$order_number?></span>
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
					
                	<?php
                	if($order_status=='delivered')
                	{
                		?><tr>
	                        <td valign="top" style="padding:20px 20px 0;">
								<p style="margin:0 0 10px;font-family:Tahoma,Arial,sans-serif;font-size:14px;font-weight:bold;">Your satisfaction is our business. Your openion played an important role to our product improvement. Give a review to us according to your experience to imporve our service.</p>
								<p style="margin:0 0 10px;font-family:Tahoma,Arial,sans-serif;font-size:14px;font-weight:bold;">Give us your review.</p>
							</td>
						</tr>
						<tr>
	                        <td valign="top" style="padding:20px 20px 0;">
								<p style="margin:0 0 10px;font-family:Tahoma,Arial,sans-serif;font-size:14px;font-weight:bold;">Thank you to buy from <a href="www.dhakabaazar.com">www.dhakabaazar.com</a></p>
							</td>
						</tr>
						<tr>
	                        <td valign="top" style="padding:20px 20px 0;">
								<p style="margin:0 0 10px;font-family:Tahoma,Arial,sans-serif;font-size:14px;font-weight:bold;">Thanks,<br>DhakaBaazar.com<br>Large online shop</p>
							</td>
						</tr><?php
                	}
                	else
                	{
                		?><tr>
	                        <td valign="top" style="padding:20px 20px 0;">
								<p style="margin:0 0 10px;font-family:Tahoma,Arial,sans-serif;font-size:14px;font-weight:bold;">Visit <a href="www.dhakabaazar.com">www.dhakabaazar.com</a> to get more products.</p>
							</td>
						</tr>
						<tr>
	                        <td valign="top" style="padding:20px 20px 0;">
								<p style="margin:0 0 10px;font-family:Tahoma,Arial,sans-serif;font-size:14px;font-weight:bold;">Thanks,<br>Stay with us</p>
							</td>
						</tr><?php
                	}
                	?>
				</table>