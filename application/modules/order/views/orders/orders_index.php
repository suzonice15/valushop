<div class="col-md-offset-0 col-md-12">
	<div class="box  box-success">
		<div class="box-header with-border  ">


			<form action="<?php echo base_url()?>order-list-report"  name="order" method="post">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="email">Order status</label>
							<select class="form-control select2" id="order_status" name="order_status">
								<option value="">--select--</option>
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
					<div class="col-md-3">
						<div class="form-group">
							<label for="email">Order By</label>

							<select class="form-control select2" id="order_by" name="order_by">
								<option value="">--select--</option>
								<?php
								$office_staffs = users_by_role('office-staff');

								if(isset($office_staffs)):
								foreach ($office_staffs as $office_staff):
								?>
								<option value="<?php echo $office_staff->user_id;?>"><?php echo $office_staff->user_name;?></option>
								<?php
endforeach;								endif;?>


							</select>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label>Date From</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" id="date_from"  name="date_from" class="form-control pull-right <?php if(isset($date_to)) {echo 'withoutFixedDate';} else { echo 'datepicker';} ?> " value="<?php if(isset($date_from)) {echo $date_from;}?>" >
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label>Date To</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" id="date_to" name="date_to" class="form-control pull-right <?php if(isset($date_to)) {echo 'withoutFixedDate';} else { echo 'datepicker';} ?> " value="<?php if(isset($date_to)) {echo $date_to;}?>">
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<br>
						<div class="form-group">
							<button type="submit"   class="btn btn-success">Filter</button>
						</div>
					</div>


				</div>
			</form>


		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
						<th>Sl</th>
						<th>Customer</th>
						<th>Total</th>
						<th>Created By</th>
						<th>Date</th>
						<th class="text-left">&nbsp;</th>
					</tr>
					</thead>
					<tbody>
					<?php

					if (isset($orders)) {
						$html = NULL;
						$i=0;
						//echo '<pre>'; print_r($orders); echo '</pre>';
						foreach ($orders as $row) {
							$html .= '<tr>
											<td>'.++$i.'</td>
												<td>'.$row->customer_name.'</td>
												<td>TK ' . $row->order_total . '</td>';

							if ($row->created_by == 'customer') {
								$html .= '<td>' . ucwords(str_replace('-', ' ', $row->created_by)) . '</td>';
							} else {
								$html .= '<td>' . get_user_name($row->staff_id) . '</td>';
							}

							$html .= '<td>' . date('h:i:s a d-M-Y', strtotime($row->created_time)) . '</td>
												<td class="action text-center">';
							if ($row->order_status == 'new') {
								$html .= '<a class="fa fa-check make_order_done" href="javascript:void(0);" data-row_id="' . $row->order_id . '">&nbsp;</a>';
							}

							$html .= '<a class="fa fa-eye" href="' . base_url() . 'order-view/' . $row->order_id . '">&nbsp;</a>
													<a class="fa fa-trash"  id="deleteOrder" href="'. base_url().'order-delete/'.$row->order_id.'"  >&nbsp;</a>
												</td>
											</tr>';
						}
						echo $html;
					}
					?>
					</tbody>
				</table>

			</div>
			<p id="data"></p>

		</div>

	</div>
</div>

<script>
	$(document).ready(function(){
	$('#example1 #deleteOrder').click(function () {
		var con=confirm('Are you want to delete ');
		if(con==true){
			return true;
		}else{
			return false;

		}
	});

});
</script>
<script>

	document.forms['order'].elements['order_status'].value="<?php if(isset($option)) { echo $option;}?>";
	document.forms['order'].elements['order_by'].value="<?php if(isset($order_by)) { echo $order_by;}?>";
</script>
