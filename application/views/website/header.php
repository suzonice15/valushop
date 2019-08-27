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
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/responsive.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/normalize.css">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/etalage.css">


	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/mega_menu.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/custom_search.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/customshop_style.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontend/css/etalage.css" type="text/css" media="all"/>
	<script src="<?php echo base_url() ?>assets/fontend/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/fontend/js/jquery.etalage.min.js"></script>
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/fontend/css/icon.png"/>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

	<script>
		jQuery(document).ready(function ($) {

			$('.etalage').etalage({
				thumb_image_width: 400,
				thumb_image_height: 400,
				source_image_width: 500,
				source_image_height: 500,
				show_hint: true,
				click_callback: function (image_anchor, instance_id) {
					// alert('Callback example:\nYou clicked on an image with the anchor: "' + image_anchor + '"\n(in Etalage instance: "' + instance_id + '")');
				}
			});

		});
	</script>
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
			/*    width: 350px;
                height: 200px;*/
			-webkit-transition: all 1.5s ease-in-out;
			-moz-transition: all 1.5s ease-in-out;
			-o-transition: all 1.5s ease-in-out;
			-ms-transition: all 1.5s ease-in-out;
		}

		.transition {
			-webkit-transform: scale(1.4);
			-moz-transform: scale(1.4);
			-o-transform: scale(1.4);
			transform: scale(1.4);
		}
	</style>
	<style>
		.main-category:hover {
			background-color: #ededed;
		}

		.sub-category-name:hover {
			background-color: #ededed;
		}


		.footer-panel > li > a {
			font-weight: bolder
		}

		.footer-panel > li > a:hover {
			background: none;
			cursor: pointer;
			color: orange !important;
		}

		.footer-panel > li > a:focus {
			background: none;
		}

		input[type="button"], input[type="reset"], input[type="submit"] {
			-webkit-appearance: button;
			cursor: pointer;
			outline: none;
		}

		input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}


	</style>
	<!-- Facebook Pixel Code -->
	<script>
		!function (f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function () {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '524572581615742');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
				   src="https://www.facebook.com/tr?id=524572581615742&ev=PageView&noscript=1"
		/></noscript>
	<!-- End Facebook Pixel Code -->


	<noscript>
		<meta http-equiv="refresh" content="0; url=http://www.egbazar.com/alertview"/>
	</noscript>


</head>

<body style="background-color:#fff" ondragstart="return false;" ondrop="return false;">

<!--	=======================header top section=========================-->


<section class="navbar-fixed-top area-mobile-off" >
	<section style="background-color:#F3F3F3">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-zero">
					<ul class="navbar-nav pull-right">
						<li class="top-menu-padding"><a href="javascript:void(0)"
														title="Mobile: 01760 442 442, 01841 305 335,01405 955 855"
														class="font-color1 ">Mobile: 01760 442 442, 01841 305 335,01405
								955 855</a></li>

						<li class="top-menu-padding"><a href="javascript:void(0)"
														title="Marchant Bkash Number : 01309-806797"
														class="font-color1">Marchant Bkash Number : 01309-806797 </a>
						</li>


					</ul>
				</div>


			</div>
		</div>
	</section>
<header>
	<section style="background-color:#fff">
		<div class="container">
			<div class="row">

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 padding-zero">
					<div style="float: left">
						<a href="<?php echo base_url();?>"><img
								src="<?php echo get_option('logo');?>" style="float: right"
								alt="dhaka" title="dhaka"></a>
					</div>
				</div>

				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" style="">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
						 style="border-radius: 20px 20px 0 0;padding-top: 8px;">
						<form action="#" method="post" class="form" role="search">
							<div class="form-group">
								<div class="input-group"
									 style="border: 2px solid darkgreen!important; border-radius: 4px;">
									<input type="search" oninput="SearchProduct_byUser(this.value)" class="form-control"
										   placeholder="Search for products..."
										   style="border:0  !important;box-shadow: none !important;padding: 2px 10px;">

									<span style="background: darkgreen;
                                              color: #fff;border: 0;border-radius: 0;font-size: 20px;"
										  class="input-group-addon"> &nbsp;<i class="fa fa-search"></i></span>
								</div>

							</div>
						</form>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
						 style="border-radius: 20px 20px 0 0;padding-top: 8px;">
					<div class="seagrch-area">

						<ul class="dropdgown-menu">

						</ul>

					</div>
					</div>

				</div>

				<div style="padding-right:0" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 form-group">
					<ul class="navbar-nav  ">

						<li data-toggle="modal" data-target="#mySms" class="top-menu-padding"
							style="padding-top: 20px;padding-left: 0"><a
								style="background:darkgreen;color: #fff;font-weight: bold;padding-left: 10px;padding-right: 10px;border-radius: 6px;"
								href="#" title="Track Your Order" class="font-color1">
								Order Tracking
							</a></li>

						<li class="top-menu-padding" style="padding-top: 20px;">
							<a style="background:darkgreen;color: #fff;font-weight: bold;padding-left: 10px;padding-right: 10px;border-radius: 6px;"
							   href="tel:01760442442" title="Call" class="font-color1">
								<i class="fa fa-phone-square"> </i> <?php echo get_option('phone');?>
							</a>
						</li>
					</ul>

				</div>
			</div>
		</div>
	</section>
	</header>


	<nav class="navbar navbar-inverse">
		<div class="container-fluid">

			<ul style="position: relative;" class="nav navbar-nav">
				<?php
				$html = null;
				$result = get_result("SELECT * FROM `category` ORDER BY rank_order DESC");
				if (isset($result)) {
					foreach ($result as $row) {
						$category[$row->parent_id][] = $row;
					}

					foreach ($result as $row) {
						if ($row->parent_id == 0) {
							$html .= '<li class="' . $row->category_name . '">
					<a href="' . base_url($row->category_name) . '">
					
						' . $row->category_title . '
					</a>

					
				</li>';
						}
					}

					$html .= '<li class="hotdeal">
					<a href="' . base_url('hotdeals') . '">
						
						Hotdeals
					</a>
				</li>';
				}

				$html .= '</ul>

		</div>';

				echo $html;
				?>

			</ul>
		</div>
	</nav>

</section>
<div class="modal fade" id="mySms" role="dialog">
	<div class="modal-dialog">
		<form action="http://www.egbazar.com/ovation/find_order_history" method="post">
			<!-- Modal content-->
			<div class="modal-content" style="border: 3px solid green;">
				<div class="modal-header" style="border-bottom: 1px solid #35A3D3;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><strong>Track Order Record</strong></h4>
				</div>
				<div class="modal-body">


					<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 form-group">
						<input style="width:100% !important;padding: 20px;" required type="number" class="form-control"
							   name="mobile_number" placeholder="Please Type Your Mobile Number">
					</div>

				</div>
				<div class="modal-footer" style="border:0;padding: 50px 30px 30px 30px;">
					<input style="color:#fff;font-weight:bold;padding: 5px;width:100% !important;background:limegreen"
						   type="submit" class="btn  pull-right" value="Search">
				</div>
			</div>
		</form>

	</div>
</div>
<!--=========================header bottom section==================-->


<nav id="menuBar" class="navbar navbar-default lightHeader navbar-fixed-top" role="navigation"
	 style="height: auto;top:0;background: #081621;">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">

			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"
					style="padding-right: 0;float: left;margin-left: 20px;margin-top: 5px;background-color: transparent; border: 0;box-shadow: none;">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="#" data-toggle="modal" data-target="#mySms" style="float: left;">
				<i class="fa fa-question-circle"
				   style="color: #fff; font-size: 24px; font-weight: bold; padding-top: 11px;"></i>
			</a>



			<a href="http://www.egbazar.com/" style="float: left;padding-left: 30px;padding-top: 3px;">


				<img width="100" height="60"
					src="<?php echo get_option('logo');?>" style="float: right"
					alt="dhaka" title="dhaka">


			</a>
			<a href="http://www.egbazar.com/resistration-information" style="float: right;padding-right: 30px;">
				<span class="badge" style="position: absolute;background: red;color: #fff;top: 10px;right: 13px;"
					  id="MtotalCartItems">0</span><img class="img-responsive"
														src="http://www.egbazar.com/image/manufacturer_logo/cart-icon.png"
														alt="EG Bazar" style=" padding-top: 8px;width: 38px;;">

			</a>
			<div class="col-xs-12" style="padding-right: 0;padding-left: 28px !important;padding-right: 15px;">
				<form action="#" method="post" class="form" role="search">
					<div class="form-group">
						<div class="input-group">
							<input type="search" oninput="SearchProduct_byUser(this.value)" class="form-control"
								   placeholder="Search Product"
								   style="border-radius: 4px 0 0 4px !important;border-color: limegreen;margin-left: 8px;padding-left: 10px">

							<span style="color: #fff; background:green; border: 1px;"
								  class="input-group-addon"> &nbsp;<i class="fa fa-search"></i></span>
						</div>

					</div>

				</form>
			</div>
			<div class="col-xs-12">
				<div class="seagrch-area">

					<ul class="dropdgown-menu">
gggg
					</ul>

				</div>
			</div>


		</div>

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-left">


				<?php
				$html = null;
				$result = get_result("SELECT * FROM `category` where  parent_id=0 ORDER BY rank_order DESC");
				if (isset($result)) {


				foreach ($result as $row) {

				?>
				<li style="padding-left: 10px;" class="dropdown megaDropMenu color-2">
					<a href="<?php echo base_url($row->category_name) ?>">
                                    <span style="font-weight: normal;color: #000"><?php echo $row->category_title;?>
                                    </span>
					</a>
				</li>

				<?php } } ?>




			</ul>
		</div>

	</div>
</nav>
<br/>


