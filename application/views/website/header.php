<?php
$uri_string = uri_string();
$site_title = get_option('site_title');
$page_title = isset($page_title) ? $page_title : $site_title;
$og_image = $logo = get_option('logo');
$favicon = get_option('icon');


if(isset($seo_title) && !empty($seo_title))
{
	$title=$seo_title;
}
else
{
	$title=$page_title.(!empty($uri_string) ? ' | '.$site_title : NULL);
}


if(isset($prod_row))
{
	$og_image=get_product_meta($prod_row->product_id, 'featured_image');
	$og_image=get_media_path($og_image);
}


$cart_items = 0;
foreach ($this->cart->contents() as $key=>$val)
{
	if(!is_array($val) OR !isset($val['price']) OR ! isset($val['qty'])){ continue; }
	$cart_items += $val['qty'];
}
?>
<style>


	.product-hover-effect:hover {
		border: 1px solid green !important;
		transition: all .1s;
	}

	.buy-now:hover {
		color: green;
		transition: all .1s;
	}

	li {
		list-style-type: none;
	}

	img.zoomEffect {
		/*   width: 5000px;
            height: 500px;*/
		-webkit-transition: all 1s ease-in-out;
		-moz-transition: all 1s ease-in-out;
		-o-transition: all 1s ease-in-out;
		-ms-transition: all 1s ease-in-out;
	}

	.transition {
		-webkit-transform: scale(1.2);
		-moz-transform: scale(1.2);
		-o-transform: scale(1.2);
		transform: scale(1.2);
	}
</style>



	<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?=$title?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<meta charset="utf-8">

	<link rel="shortcut icon" href="<?=$favicon?>">

	<meta name="description" content="<?=isset($seo_content) ? $seo_content : $page_title?>"/>
	<meta name="keywords" content="<?=isset($seo_keywords) ? $seo_keywords : $page_title?>"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">

	<meta name="robots" content="noodp"/>
	<link rel="canonical" href="<?=base_url()?>"/>
	<meta property="og:locale" content="EN" />
	<meta property="og:url" content="<?=current_url()?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="<?=$page_title?>"/>
	<meta property="og:description" content="<?=$page_title?>"/>
	<meta property="og:image" content="<?=$og_image?>"/>
	<meta property="og:site_name" content="<?=$site_title?>"/>

	<link rel="image_src" href="<?=$og_image?>"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/bootstrap.min.css">
	<script src="<?php echo base_url() ?>assets/fontend/js/jquery.min.js"></script>


</head>
<body>
<header>

	<nav  style="background-color: #BDD439" class="navbar navbar-expand-md   navbar-dark">
		<div class="col-md-6 col-3">
			<a class="navbar-brand" href="#"> Welcome to Kalerhaat.</a>
		</div>
		<div class="col-md-6 col-3">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar_top">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar_top">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a  class="nav-link" style="color:white" href="#home"><i class="fa fa-home"></i>Home</a>
					</li>
					<li class="nav-item">
						<a  class="nav-link" style="color:white" href="#news"><i class="fa fa-envelope"></i>Contact</a>

					</li>

					<li class="nav-item">
						<a  class="nav-link" style="color:white" href="#contact"><i class="fa fa-search"></i>Track Order</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" style="color:white" href="#about"><i class="fa fa-shopping-cart"></i>Checkout</a>

					</li>
				</ul>
			</div>
		</div>
	</nav>

<div class="container-fluid" style="padding: 26px 47px;background-color: #fff;">

	<div class="row">
		<div class="col-md-3">
			<a href="<?php echo base_url();?>"><img
					src="<?php echo get_option('logo');?>"
					alt="dhaka" title="dhaka"></a>
		</div>
		<div class="col-md-5 col-12">
			<div class="input-group">
				<input class="form-control py-2" oninput="SearchProduct_byUser(this.value)" type="search" pla="search" id="example-search-input">
				<span class="input-group-append">
        <button class="btn btn-outline-secondary" type="button">
            <i class="fa fa-search"></i>
        </button>
      </span>
			</div>
<!-- search item -->
			<div class="search-area">

				<ul class="dropdgown-menu">

				</ul>

			</div>

		</div>

		<!-- end item -->





		<div  id="mobile_menu_customization" class="col-md-4 ">
			<div class="float-right shoping_bag_class" >

				<img src="<?php echo base_url() ?>images/bag.png">
				<a href="<?php echo base_url()?>chechout"   id="shoping_bag" class="text-danger font-weight-bold mr-5">

					<?php
					$cart_items=$cart_total=0;
					/*echo '<pre>'; print_r($this->cart->contents()); echo '</pre>';*/

					foreach($this->cart->contents() as $key=>$val)
					{
						if(!is_array($val) OR !isset($val['price']) OR ! isset($val['qty'])){ continue; }

						$cart_items += $val['qty'];
						$cart_total += $val['subtotal'];

					?>

						<div class="itemcount item_1">
						<span class="itemno">
<?php   if($cart_items >0 )  { echo  $cart_items; } ?>
							</span>
						</div>

					<?php

					}
					?>



				</a>
			</div>
			<div class=" float-right btn btn-success">
				<i class="fa fa-phone"></i>
				<span> <?php echo get_option('phone');?></span>


			</div>


		</div>


	</div>
</div>

<nav  style="position:relative;background-color: #F86F3F" class="navbar navbar-expand-sm   navbar-dark sticky-top">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="navbar-toggler-icon"></span>
	</button>
	<nav class="collapse navbar-collapse" id="collapsibleNavbar">

		<div class="navbar-nav" >

			<?php
			$html = null;
			$result = get_result("SELECT * FROM `category` ORDER BY rank_order DESC");
			if (isset($result)) {
				foreach ($result as $row) {
					$category[$row->parent_id][] = $row;
				}

				foreach ($result as $row) {
					if ($row->parent_id == 0) {

						?>


				<li class="nav-item">
			<a style="color:white" class="nav-link" href="<?php echo base_url() ?>category/<?php echo $row->category_name?> ">

				<?php echo  $row->category_title ?>
			</a>


		</li>

						<?php
					}
				}
				?>
				</ul>
			<?php
			}
			?>


		</div>
	</nav>
		</header>
