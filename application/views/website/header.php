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


	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>

<div class="container-fluid" style="background-color: #30532e52;color: #fff;">

	<div class="row">
		<div class="ml-5 col-md-4">
			 Welcome to Kalerhaat.
		</div>
		<div class="text-right col-md-6">

			<div class="pill-nav">
				<a style="color:white" href="#home"><i class="fa fa-home"></i>Home</a>
				<a style="color:white" href="#news"><i class="fa fa-envelope"></i>Contact</a>
				<a style="color:white" href="#contact"><i class="fa fa-search"></i>Track Order</a>
				<a style="color:white" href="#about"><i class="fa fa-shopping-cart"></i>Checkout</a>
			</div>
		</div>

	</div>
</div>


<div class="container-fluid" style="padding: 26px 47px;background-color: #7bd771;">

	<div class="row">
		<div class="col-md-3">
			<a href="<?php echo base_url();?>"><img
					src="<?php echo get_option('logo');?>"
					alt="dhaka" title="dhaka"></a>
		</div>
		<div class="col-md-4">
			<div class="input-group">
				<input class="form-control py-2" type="search" value="search" id="example-search-input">
				<span class="input-group-append">
        <button class="btn btn-outline-secondary" type="button">
            <i class="fa fa-search"></i>
        </button>
      </span>
			</div>
		</div>

		<div class="col-md-5">
			<div class="float-right shoping_bag_class" >
				<img src="<?php echo base_url() ?>assets/fontend/images.png">
				<a href="<?php echo base_url()?>chechout"   id="shoping_bag" class="text-danger font-weight-bold mr-5">
					<?php
					$cart_items=$cart_total=0;
					/*echo '<pre>'; print_r($this->cart->contents()); echo '</pre>';*/

					foreach($this->cart->contents() as $key=>$val)
					{
						if(!is_array($val) OR !isset($val['price']) OR ! isset($val['qty'])){ continue; }

						$cart_items += $val['qty'];
						$cart_total += $val['subtotal'];
					}
					echo $cart_items;
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

<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">

	<ul class="navbar-nav">
<?php
$html = null;
$result = get_result("SELECT * FROM `category` ORDER BY rank_order DESC");
if (isset($result)) {
	foreach ($result as $row) {
		$category[$row->parent_id][] = $row;
	}

	foreach ($result as $row) {
		if ($row->parent_id == 0) {


			$html .= '<li class="nav-item">
			<a class="nav-link" href="' . base_url($row->category_name) . '">

				' . $row->category_title . '
			</a>


		</li>';
		}
	}
	$html .= '</ul>

		</nav>';

	echo $html;
}
?>


