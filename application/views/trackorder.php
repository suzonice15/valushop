<section id="content" class="aboutpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="adsbox">
					<?php
					$adds = get_adds();
					if(count($adds)>0)
					{
						$side_html='<ul>';
						
						foreach($adds as $add)
						{
							$side_html.='<li>
								<a href="'.$add->adds_link.'">
									<img src="'.get_media_path($add->media_id).'">
								</a>
							</li>';
						}
						
						$side_html.='</ul>';
						
						echo $side_html;
					}
					?>
				</div>
			</div>
			<div class="col-sm-9">
				<div class="subheader">
					<ul class="breadcrumb">
						<li><a href="<?=base_url()?>">Home</a></li>
						<li class="active"><?=$page_title?></li>
					</ul>
					
					<div class="page-title">
						<h1><?=$page_title?></h1>
					</div>
				</div>
				<article class="txt">
					<?php
					$form_html='<hr class="break break30">
					<form method="post">
						<div class="row row5">
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" class="form-control" name="track_id" placeholder="Booking Code/ Order Number"/>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">';

									$option['pod_number'] = 'Order Number';
									$option['booking_code'] = 'Booking Code';
									
									$selected_option = set_value('track_type') ? set_value('track_type') : NULL;
									
									$form_html.=form_dropdown('track_type', $option, $selected_option, array('class'=>'form-control', 'id'=>'track_type'));

								$form_html.='</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<button type="submit" class="btn btn-primary form-control">Send</button>
								</div>
							</div>
						</div>
					</form>';
					
					echo $post->post_content.$form_html;

					if(isset($_POST['track_id']) && isset($_POST['track_type']))
					{
						$track_id = $_POST['track_id'];
						$track_type = $_POST['track_type'];
						if(!empty($track_id))
						{
							if($track_type=='booking_code')
							{
								$orders = get_result("SELECT * FROM `order` WHERE `courier_code`='$track_id'");
							}
							elseif($track_type=='pod_number')
							{
								$orders = get_result("SELECT * FROM `order` WHERE `order_id`=$track_id");
							}

							if(isset($orders) && sizeof($orders)>0)
							{
								foreach($orders as $order);
								//echo '<pre>'; print_r($order); echo '</pre>';

								$order_day = convert_number(date('d', strtotime($order->created_time)));
								$order_month = strtolower(date('F', strtotime($order->created_time)));
								$order_year = convert_number(date('Y', strtotime($order->created_time)));

								$shipment_day = convert_number(date('d', strtotime($order->shipment_time)));
								$shipment_month = strtolower(date('F', strtotime($order->shipment_time)));
								$shipment_year = convert_number(date('Y', strtotime($order->shipment_time)));

								$order_status = $order->order_status;

								$order_area = get_order_meta($order->order_id, 'order_area');
								$courier_phone = get_order_meta($order->order_id, 'courier_phone');
								$courier_email = get_order_meta($order->order_id, 'courier_email');

								$delivery_man = get_order_meta($order->order_id, 'delivery_man');
								$delivery_man_phone = get_order_meta($order->order_id, 'delivery_man_phone');

								$track_html='<table class="table table-striped table-bordered">
									<tr>
										<th colspan="2"><center>Current Status</center></th>
									</tr>
									<tr>
										<td width="50%">Order Date</td>
										<td>'.$order_day.' '.$order_month.', '.$order_year.'</td>
									</tr>
									<tr>
										<td width="50%">Courier Service</td>
										<td>'.$order->courier_service.'</td>
									</tr>
									<tr>
										<td width="50%">Courier Phone</td>
										<td>'.$courier_phone.'</td>
									</tr>
									<tr>
										<td width="50%">Courier Email</td>
										<td>'.$courier_email.'</td>
									</tr>
									<tr>
										<td width="50%">Booking Code</td>
										<td>'.$order->courier_code.'</td>
									</tr>';

									if($order_area=='inside_dhaka')
									{
										$track_html.='<tr>
											<td width="50%">Delivery Man</td>
											<td>'.$delivery_man.'</td>
										</tr>';
										$track_html.='<tr>
											<td width="50%">Delivery Man</td>
											<td>'.$delivery_man_phone.'</td>
										</tr>';
									}

									$track_html.='<tr>
										<td width="50%">Order Status</td>
										<td>'.$order_status.'</td>
									</tr>
									<tr>
										<td width="50%">Shipment Time</td>';

										if(strtotime($order->shipment_time) < strtotime(date('d-m-Y')) && $order->order_status=='new')
										{
											$track_html.='<td></td>';
										}
										else
										{
											$track_html.='<td>'.$shipment_day.' '.$shipment_month.', '.$shipment_year.'</td>';
										}

									$track_html.='</tr>
								</table>';

								echo $track_html;
							}
						}
						else
						{
							echo '<p style="color:#d00;">Empty Order Number/ Booking Code</p>';
						}
					}
					?>
				</article>
			</div>
		</div>
	</div>
</section>