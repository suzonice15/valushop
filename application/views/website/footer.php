
<br/>
<br/>
<br/>

<footer style="background-color: black;color:white" class="p-5">
	<div class="container-fluid">
		<div class="row " style="color:white">


			<div class="col-md-2">
				<a href="http://kalerhaat.com/about" target="_blank"> আমাদের সম্পর্কে</a>

			</div>
			<div class="col-md-1">
				<a href="http://kalerhaat.com/contact" target="_blank"> যোগাযোগ</a>

			</div>

			<div class="col-md-2">
				<a href="http://kalerhaat.com/return_policy" target="_blank"> গোপনীয়তা নীতি</a>

			</div>
			<div class="col-md-2">

				<a href="http://kalerhaat.com/replacement" target="_blank">
					রিপ্লেসমেন্ট পলিসি
				</a>
			</div>
			<div class="col-md-1">

				<a href="http://kalerhaat.com/terms" target="_blank">শর্তাবলী</a>
			</div>
			<div class="col-md-1">
				<a href="http://kalerhaat.com/sitemap" target="_blank"> অবস্থান</a>

			</div>
			<div class="col-md-3">

				<a href="http://www.kalerhaat.com/trackorder" target="_blank">অর্ডার ট্র্যাক করুন</a>
			</div>


		</div>
	</div>
	<div class="container-fluid">
		<div class="copyright text-center">© Copyright- Kalerhaat <?=date('Y')?></div>
	</div>
</footer>

</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/fontend/js/owl.carousel.js"></script>


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

	$('.zoomEffect').hover(function() {
		$(this).addClass('transition');
	}, function() {
		$(this).removeClass('transition');
	});

</script>
<script>

	$('.megaDropMenu').hover(function() {
		$(this).addClass('open');
	}, function() {
		$(this).removeClass('open');
	});

</script>
<script>
$('body').on('click', '.add_to_cart', function()
{
var product_id=$(this).attr('data-product_id');
var product_price=$(this).attr('data-product_price');
var product_size=$('#product_size').val();
var product_title=$(this).attr('data-product_title');
var data_product=$(this).attr('data-product');



	var product_qty=1;
	if($("input#quantity").length > 0)
	{
		product_qty=$("input#quantity").val();
	}


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

var total_result=JSON.parse(result);

$('#shoping_bag').text(total_result);


}

});

return false;
});

</script>
<script>
	$('body').on('click', '.qtyplus', function()
	{
		alert('gg');
	});
</script>
<script>
	$('body').on('click', '.quantity-action>div', function()
	{
		$.cookie("active_mini_cart", 1, {expires:1});

		var this_link = $(this);
		var action_type=$(this).attr('data-action_type');
		var rowid=$(this).parent().attr('data-rowid');

		var ajax_url = base_url+'ajax/update_to_cart';

		$.ajax({
			type: 'POST',
			data: {
				"rowid" : rowid,
				"action_type" : action_type
			},
			url: ajax_url,
			success: function(result)
			{
				var response = JSON.parse(result);

				$('aside#minicart').addClass('active');
				$('aside#minicart .innerbox').html(response.html);

				$('header .cartbtn .items .itemcount').removeClass('item_0');
				$('header .cartbtn .items .itemcount').addClass('item_'+response.current_cart_item);
				$('header .cartbtn .items .itemcount span.itemno').text(response.current_cart_item);
				//$('header .cartbtn .total span.price').text(response.current_cart_total);
			}
		});

		return false;
	});
	


jQuery('body').on('click', '.buy_now', function()
{
var this_link = jQuery(this);
var product_id=jQuery(this).attr('data-product_id');
var product_price=jQuery(this).attr('data-product_price');
var product_title=jQuery(this).attr('data-product_title');
var base_url='<?php echo base_url()?>';

	var product_qty=1;
	if($("input#quantity").length > 0)
	{
		product_qty=$("input#quantity").val();
	}

jQuery.ajax({
type: 'POST',
data: {
"product_id" : product_id,
"product_qty" :product_qty,
"product_price" : product_price,
"product_title" : product_title
},
url: '<?php echo base_url()?>ajax/add_to_cart',
success: function(result)
{

	var total_result=JSON.parse(result);

	$('#shoping_bag').text(total_result);
location.replace(base_url+'chechout');
}
});

return false;
});
	</script>
