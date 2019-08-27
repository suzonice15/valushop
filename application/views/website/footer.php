



<!--<footer class="navbar-fixed-bottom " style="width: 100%;background: none;" id="SidebarCardMenu">-->
<?php
$cart_items=$cart_total=0;
/*echo '<pre>'; print_r($this->cart->contents()); echo '</pre>';*/

foreach($this->cart->contents() as $key=>$val)
{
	if(!is_array($val) OR !isset($val['price']) OR ! isset($val['qty'])){ continue; }

	$cart_items += $val['qty'];
	$cart_total += $val['subtotal'];
}
?>

<footer class="navbar-fixed-bottom area-mobile-off" style="width: 100%;background: none;">
	<a href="http://www.egbazar.com/resistration-information">
		<!--Apps button start-->
		<div
			style="height: auto;width: 80px;background: #fff ;position: absolute;z-index: 9999;bottom: 450px;right: 0;border-radius: 5px 0 0 5px;border: 1px solid #1D70BA;"
			class="cart_anchor">



                 <span id="CartDetailsTotal"
					   style="padding: 8px 0;width:100%;display: inline-block;color:#000;font-size:14px;font-weight:bold;text-align:center">
                        <?=$cart_total ?>  Tk.
                    </span>

			<span
				style="width:100%;display: inline-block; background: green; color: #fff;font-weight:bold;padding:2px;text-align:center;border-radius: 0 0 0 5px;">
                        <i class="fa fa-shopping-cart " title="My Cart" style="    font-size: 30px;"> </i>
                        <span id="totalCartItems2">
							<span id="total_items"> <?=$cart_items?> </span>Items
                        </span>
                    </span>


		</div>
	</a>

	<!--Apps button end-->
</footer>

<footer class="navbar-default" style="background: #081621">
	<div class="container-fluid ">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<p class="text-center" style="padding-top:5px"></p>
			<p class="text-center" style="color:#fff;font-weight:bold;padding-top:8px;padding-bottom: 8px;">Copyright ©
				2019 | EgBazar.com </p>
		</div>
		<?php
		echo CI_VERSION;
		?>

	</div>
</footer>


<script>

	function MoreManufacturer() {
		serverPage = 'http://www.egbazar.com/ovation/MoreManufacturer';
		// alert(serverPage);
		xmlhttp.open("GET", serverPage);
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				//alert(xmlhttp.responseText);
				document.getElementById("MoreBrand").innerHTML = xmlhttp.responseText;


			}

			var scroll = document.getElementById('MoreBrandS');
			scroll.scrollTop = scroll.scrollHeight;
			scroll.animate({scrollTop: scroll.scrollHeight}, "slow");
		};
		xmlhttp.send(null);


	}

</script>

<script>
	$(window).scroll(function () {
		var wScroll = $(this).scrollTop();
		if (wScroll > 88) {
			$('#SidebarCardMenu').css({
				'display': 'block'
			});
		}
		if (wScroll < 88) {
			$('#SidebarCardMenu').css({
				'display': 'none'
			});
		}
	});
	function add_to_cart() {
		var product_price=$('input[name=product_price]').val();
		var product_id=$('input[name=product_id]').val();
		var product_title=$('input[name=product_title]').val();
		var product_qty=$('input[name=product_buy_item]').val();

		$.ajax({
			type: 'POST',
			data: {
				"product_id" : product_id,
				"product_qty" : product_qty,
				"product_price" : product_price,
				"product_title" : product_title

			},
			url: '<?php echo base_url()?>ajax/add_to_cart',
			success: function(result)
			{
				document.getElementById("totalCartItems2").innerHTML = product_qty + ' Items';
				document.getElementById("CartDetailsTotal").innerHTML = product_price + ' Tk.';
				document.getElementById("MtotalCartItems").innerHTML = product_price;


			}

		});

	}
</script>

<script>

	function SearchProduct_byUser(Obj) {
		var search_query = Obj;

		if (search_query.length >= 1) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: '<?php echo base_url(); ?>Home/ajax_search_items',
				data: {
					search_query: search_query
				},

				success: function(response) {
					//alert(response)
					console.log(response);
					if (response.status == "success") {
						$("header .seagrch-area ul.dropdgown-menu").html(response.return_value);
					}
				}
			})
		} else{
			$("header .seagrch-area ul.dropdgown-menu").html('');

		}
	}

</script>
<script src="<?php echo base_url() ?>assets/fontend/js/jquery-1.11.3.min.js"></script>

<script src="<?php echo base_url() ?>assets/fontend/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/fontend/js/owl.carousel.js"></script>


</body>

</html>
<style>
	.alert-box-arrow {
		width: 0;
		height: 0;
		border-left: 12px solid transparent;
		border-right: 12px solid transparent;
		border-bottom: 15px solid #F6F6F6;
		margin-top: -15px;
		position: absolute;
	}
</style>


<script>

	function ProductAddTwoCart(Obj) {

		serverPage = 'http://www.egbazar.com/cart/ajax_addcart/' + Obj;
		xmlhttp.open("GET", serverPage);
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

				var obj = JSON.parse(xmlhttp.responseText);
				document.getElementById("totalCartItems2").innerHTML = obj.total_items + ' Items';
				document.getElementById("CartDetailsTotal").innerHTML = obj.total_amount + ' Tk.';
				document.getElementById("MtotalCartItems").innerHTML = obj.total_items;

			}
		}
		xmlhttp.send(null);

	}

</script>
<script>

	$('.zoomEffect').hover(function () {
		$(this).addClass('transition');
	}, function () {
		$(this).removeClass('transition');
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
	$(window).scroll(function () {
		var wScroll = $(this).scrollTop();
		if (wScroll > 88) {
			$('#SidebarCardMenu').css({
				'display': 'block'
			});
		}
		if (wScroll < 88) {
			$('#SidebarCardMenu').css({
				'display': 'none'
			});
		}
	});
</script>
<script>
	jQuery(document).ready(function($) {
		var owl = $('.owl-carousel');

		owl.owlCarousel({
			loop: true,
			nav: false,
			autoplay:true,
			autoplayHoverPause:true,
			dots:false,
			margin: 0,
			video: true,
			responsive: {
				0: {
					items:2
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

	$(document).ready(function () {
		//owl carousel

		if ($('.product-category').hasClass('owl-carousel')) {

			$('.owl-carousel').owlCarousel({
				items: 6,
				margin: 15,
				nav: false,
				dots: false,
				autoplay: true,
				slideBy: 6,
				autoplayHoverPause: true,
				rewind: true,
				responsive: {
					0: {
						items: 3
					},
					760: {
						items: 3
					},
					960: {
						items: 4
					},
					1170: {
						items: 6
					}
				}
			})
		}

	});
</script>
