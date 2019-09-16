<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<?php echo get_option('footer'); ?>
</body>
</html>
<script src="<?php echo base_url() ?>assets/fontend/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/fontend/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/fontend/js/custom.js"></script>
<script src="<?php echo base_url() ?>assets/fontend/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/fontend/js/owl.carousel.js"></script>

<!---->
<!--<script type="text/javascript">-->
<!--	var xhr = new XMLHttpRequest();-->
<!--	xhr.open("GET", '--><?php //echo base_url()?>///ajax/home_cat_content');
//	xhr.send();
//	xhr.onreadystatechange = function()
//	{
//		$('.home_cat_content').html(xhr.responseText);
//	}
//</script>



<script>
	$(document).ready(function ($) {
		var owl = $('.owl-carousel');

		owl.owlCarousel({
			loop: true,
			nav: false,
			autoplay: true,
			autoplayHoverPause: true,
			dots: false,
			margin: 5,
			video: true,
			responsive: {
				0: {
					items: 2
				},
				600: {
					items: 4
				},
				960: {
					items: 5,
				},
				1200: {
					items: 6
				}
			}
		});
	});
</script>
<script>

	$('.megaDropMenu').hover(function () {
		$(this).addClass('open');
	}, function () {
		$(this).removeClass('open');
	});

</script>
<script>
	$('body').on('click', '.add_to_cart', function () {
		var product_id = $(this).attr('data-product_id');
		var product_price = $(this).attr('data-product_price');
		var product_size = $('#product_size').val();
		var product_title = $(this).attr('data-product_title');
		var data_product = $(this).attr('data-product');


		var product_qty = 1;
		if ($("input#quantity").length > 0) {
			product_qty = $("input#quantity").val();
		}


		$.ajax({
			type: 'POST',
			data: {
				"product_id": product_id,
				"product_qty": product_qty,
				"product_price": product_price,
				"product_title": product_title

			},
			url: '<?php echo base_url()?>ajax/add_to_cart',
			success: function (result) {

				var total_result = JSON.parse(result);

				$('.shoping_bag_class #shoping_bag .itemno').text(total_result);


			}

		});

		return false;
	});

</script>


<script>
	/*

	$('body').on('click', '.quantity-action>div', function () {

		var this_link = $(this);
		var action_type = $(this).attr('data-action_type');
		var rowid = $(this).parent().attr('data-rowid');

		//var ajax_url = base_url + 'ajax/update_to_cart';

		$.ajax({
			type: 'POST',
			data: {
				"rowid": rowid,
				"action_type": action_type
			},
			url: ajax_url,
			success: function (result) {
				var response = JSON.parse(result);

				$('aside#minicart').addClass('active');
				$('aside#minicart .innerbox').html(response.html);

				$('header .cartbtn .items .itemcount').removeClass('item_0');
				$('header .cartbtn .items .itemcount').addClass('item_' + response.current_cart_item);
				$('header .cartbtn .items .itemcount span.itemno').text(response.current_cart_item);
				//$('header .cartbtn .total span.price').text(response.current_cart_total);
			}
		});

		return false;
	});
	*/



	jQuery('body').on('click', '.buy_now', function () {
		var this_link = jQuery(this);
		var product_id = jQuery(this).attr('data-product_id');
		var product_price = jQuery(this).attr('data-product_price');
		var product_title = jQuery(this).attr('data-product_title');
		var base_url = '<?php echo base_url()?>';

		var product_qty = 1;
		if ($("input#quantity").length > 0) {
			product_qty = $("input#quantity").val();
		}

		jQuery.ajax({
			type: 'POST',
			data: {
				"product_id": product_id,
				"product_qty": product_qty,
				"product_price": product_price,
				"product_title": product_title
			},
			url: '<?php echo base_url()?>ajax/add_to_cart',
			success: function (result) {

				var total_result = JSON.parse(result);

				$('#shoping_bag .itemno').text(total_result);
				location.replace(base_url + 'chechout');
			}
		});

		return false;
	});
</script>

<script>
	$('.search-area').hide();

	function SearchProduct_byUser(Obj) {
		var search_query = Obj;


		if (search_query.length >= 1) {
			$('.search-area').show();
			$.ajax({
				type: "POST",
				dataType: "json",
				url: '<?php echo base_url(); ?>Home/ajax_search_items',
				data: {
					search_query: search_query
				},

				success: function (response) {
					//alert(response)
					//console.log(response);
					if (response.status == "success") {
						$("header .search-area ul.dropdgown-menu").html(response.return_value);
					}
				}
			})
		} else {
			$("header .search-area ul.dropdgown-menu").html('');
			$('.search-area').hide();


		}
	}

</script>

<!--************************************   scroll product show ****************************-->
