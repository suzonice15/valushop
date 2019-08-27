<?php

$prod_stock_summary = get_result("SELECT SUM(pm1.meta_value * pm2.meta_value) as stock_value, 
								SUM(pm3.meta_value * pm2.meta_value) as purchase_value, 
								SUM(pm2.meta_value) as stock_items 
								FROM product as p 
								JOIN productmeta as pm1 ON p.product_id = pm1.product_id 
								JOIN productmeta as pm2 ON p.product_id = pm2.product_id 
								JOIN productmeta as pm3 ON p.product_id = pm3.product_id 
								WHERE pm1.meta_key = 'sell_price' 
								AND pm2.meta_key = 'stock_qty' 
								AND pm3.meta_key = 'purchase_price'");

//echo "<pre>"; print_r($prod_stock_summary);  echo "</pre>"; die();

foreach($prod_stock_summary as $prod_stock_info);

?>
<div id="ajaxdata" class="table-responsive">
	<table id="dat4aTable" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th><input type="checkbox" id="checkAll"></th>
			<th>SKU</th>
			<th>Product</th>
			<th hidden>Product Name</th>

			<?php
			//											if($user_type=='admin' || $user_type=='super-admin')
			//											{
			?><th>Purchase Price</th><?php
			//}
			?>

			<th>Sell Price</th>
			<th>Qty.</th>

			<?php
			//											if($user_type=='admin' || $user_type=='super-admin')
			//											{
			?><th>Total<br>Purchase Price</th><?php
			//	}
			?>

			<th>Total<br>Sell Price</th>
			<th class="text-right">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php
		//										if(isset($page_type) && $page_type=='general')
		//										{

		?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td hidden>&nbsp;</td>

			<?php
			//											if($user_type=='admin' || $user_type=='super-admin')
			//											{
			?><td>&nbsp;</td><?php
			//}
			?>

			<td>&nbsp;</td>
			<td><b>Total<br>Product<br>Qty.</b><br><?=$prod_stock_info->stock_items?></td>

			<?php
			//											if($user_type=='admin' || $user_type=='super-admin')
			//											{
			?><td><b>Grand<br>Purchase<br>Price:</b><br><?=$prod_stock_info->purchase_value?></td><?php
			//			}
			?>

			<td><b>Grand<br>Sell<br>Price:</b><br><?=$prod_stock_info->stock_value?></td>
			<td>&nbsp;</td>
		</tr>
		<?php
		//}
		?>

		<?php
		if(isset($products))
		{
			$html=NULL;

			foreach($products as $prod)
			{
				$stock_qty = get_product_meta($prod->product_id, 'stock_qty');

				//var_dump($stock_qty);exit();
				$purchase_price = get_product_meta($prod->product_id, 'purchase_price');
				$sell_price = get_product_meta($prod->product_id, 'sell_price');

				$featured_image = get_product_meta($prod->product_id, 'featured_image');
				$featured_image = get_media_path($featured_image);
				if(empty($stock_qty)){
					$stock_qty=0;

				}
				if( empty($purchase_price) ){

					$purchase_price=0;

				}
				if( empty($sell_price)){

					$sell_price=0;
				}

				$html.='<tr>
												<td>
													<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkAll" value="'.$prod->product_id.'" />
												</td>
												<td>'.get_product_meta($prod->product_id, 'sku').'</td>
												<td>
													<img src="'.$featured_image.'" width="30" height="30"> &nbsp; '.$prod->product_title.'
												</td>
												<td hidden>'.$prod->product_name.'</td>';

//												if($user_type=='admin' || $user_type=='super-admin')
//												{
				$html.='<td>'.$purchase_price.'</td>';
				//	}

				$html.='<td>'.$sell_price.'</td>
												<td>'.$stock_qty.'</td>';

//												if($user_type=='admin' || $user_type=='super-admin')
//												{
				$html.='<td>'.$stock_qty * $purchase_price.'</td>';
				//	}

				$html.='<td>'.$stock_qty * $sell_price.'</td>
												<td class="action text-right">
													<a class="lnr lnr-eye" href="'.base_url().'admin/product/update/'.$prod->product_id.'">&nbsp;</a>';

//												if($user_type=='admin' || $user_type=='super-admin')
//												{
				$html.='<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$prod->product_id.'" data-table="product">&nbsp;</a>';
				//	}

				$html.='</td>
											</tr>';
			}

			echo $html;
		}
		?>
		</tbody>
	</table>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
</div>

<script>
	$(document).ready(function () {
		$("#ajax_pagingsearc a").attr('onclick', 'return main_page_pagination($(this));');
	});
</script>


<script>

	$('#checkAll').change(function(){

		if($(this).is(":checked")){

			$('.checkAll').prop('checked',true);

		}

		else if($(this).is(":not(:checked)")){

			$('.checkAll').prop('checked',false);

		}

	});
	$('#deleteAll').click(function (e) {
		e.preventDefault();
		var categoryId = new Array();

		var allId = $('.checkAll').val();
		$('.checkAll').each(function () {
			if ($(this).is(":checked")) {
				categoryId.push(this.id);
			}
		});
		if (categoryId.length > 0) {
			$.ajax({

				url: '<?php echo base_url()?>category/categoryController/multipleDelete',
				data: {category_id: categoryId},
				type: 'post',
				success: function (data) {
					alert(data)
					window.location = '<?php echo base_url()?>category-list';
				}
			});
		} else {
			alert("Select at least one product checkbox");

		}


	});

</script>

