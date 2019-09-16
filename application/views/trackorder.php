<section id="content" class="aboutpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-12">
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
									<img  class="img-fluid" src="'.get_media_path($add->media_id).'">
								</a>
							</li>';
						}
						
						$side_html.='</ul>';
						
						echo $side_html;
					}
					?>
				</div>
			</div>
			<div class="col-sm-9 col-12">
				<div class="subheader">
					<ul class="breadcrumb">
						<li><a href="<?=base_url()?>">Home</a>/</li>
						<li class="active"><?=$page_title?></li>
					</ul>
					
					<div class="page-title">
						<h1><?=$page_title?></h1>
					</div>
				</div>
				<article class="txt">
					<?php
					echo $page_content;
					?>

					<hr class="break break30">
					<form  action="" method="post">
						<div class="row row5">
							<div class="col-sm-6 col-md-6 col-12">
								<div class="form-group">
									<input type="text" class="form-control" name="track_id" placeholder="Mobile Number/ Order Number"/>
								</div>
							</div>
						
							
							<div class="col-sm-6 col-md-6 col-12">
								<div class="form-group">
									<button type="submit"  name="submit" class="btn btn-primary form-control">Send</button>
								</div>
							</div>
						</div>
					</form>
					<?php

					if(isset($_POST['submit']) && isset($_POST['track_id']))
					{
						$track_id = $_POST['track_id'];

						if(!empty($track_id))
						{

							$orders = get_result("SELECT * FROM `order_data` WHERE `order_id`='$track_id' or `customer_phone`='$track_id'");


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

//								$order_area = get_order_meta($order->order_id, 'order_area');
								$courier_name = $order->customer_name;
								$courier_phone = $order->customer_phone;
								$courier_email= $order->customer_email;
								$customer_addressl= $order->customer_address;

//								$courier_email = get_order_meta($order->order_id, 'courier_email');
//
//								$delivery_man = get_order_meta($order->order_id, 'delivery_man');
//								$delivery_man_phone = get_order_meta($order->order_id, 'delivery_man_phone');

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
										<td width="50%">Customer Name</td>
										<td>'.$courier_name.'</td>
									</tr>
									<tr>
										<td width="50%">Customer Phone</td>
										<td>'.$courier_phone.'</td>
									</tr>
									<tr>
										<td width="50%">Customer Email</td>
										<td>'.$courier_email.'</td>
									</tr>
									<tr>
										<td width="50%">Customer Address</td>
										<td>'.$customer_addressl.'</td>
									</tr>
								';


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
							echo '<p style="color:#d00;">Enter Mobile  Number/ Order ID </p>';
						}
					}
					?>
					


				</article>
			</div>
		</div>
	</div>
</section>
