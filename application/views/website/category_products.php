<nav class="bg-dark">
	<ol class="breadcrumb">
		<li class="breadcrumb-item text-decoration-none"><a href="<?php echo base_url() ?>">Home</a></li>
		<li class="breadcrumb-item active"><a href="<?=$breadcumb_category_link?>">			<?=$breadcumb_category?>
			</a>
	</ol>
</nav>

<section>
<div class="container">
	<div class="row">



	<div id="load_data"></div>
	<div id="load_data_message"></div>


</div>

	</section>


<input type="hidden" class="form-control" id="category_id" name="category_id" value="<?php echo $category_id;?>"/>


<script>
	$(document).ready(function () {

		var limit = 8;
		var start = 0;
		var action = 'inactive';
		var category_id = $('#category_id').val();


		function load_data(limit, start) {


			$.ajax({
				url: "<?php echo base_url(); ?>Ajax/scroll_pagination_product",
				method: "POST",
				data: {limit: limit, start: start, category_id: category_id},
				cache: false,
				success: function (data) {
					if (data == '') {
						//$('#load_data_message').html('<h3>No More Result Found</h3>');
						action = 'active';
					} else {
						$('#load_data').append(data);
						$('#load_data_message').html("");
						action = 'inactive';
					}
				}
			})
		}

		if (action == 'inactive') {
			action = 'active';
			load_data(limit, start);
		}

		$(window).scroll(function () {
			if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {

				action = 'active';
				start = start + limit;
				setTimeout(function () {
					load_data(limit, start);
				}, 1000);
			}
		});

	});
</script>
<style>
	.vertical-menu {
		width: 200px;
	}

	.vertical-menu a {
		background-color: #eee;
		color: black;
		display: block;
		padding: 12px;
		text-decoration: none;
	}

	.vertical-menu a:hover {
		background-color: #ccc;
	}

	.vertical-menu a.active {
		background-color: #4CAF50;
		color: white;
	}
</style>
