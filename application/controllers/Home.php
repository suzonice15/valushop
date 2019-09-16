<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MainModel');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->helper('form');
		date_default_timezone_set('Asia/Dhaka');
		/*
			$visitor['visitor_ip']=$_SERVER['REMOTE_ADDR'];
            $visitor['visitor_date'] =date('Y-m-d');
            $result=$this->MainModel->visitorCount($visitor['visitor_ip'],$visitor['visitor_date']);
            if(empty($result)){
                $result = $this->MainModel->insertData('visitors', $visitor);

            }
		*/


	}

	public function index()
	{
		$data['page_name'] = 'home';
		$data['seo_title'] = get_option('home_seo_title');
		$data['seo_keywords'] = get_option('home_seo_keywords');
		$data['seo_content'] = get_option('home_seo_content');
		$sql="SELECT * FROM `product`
 WHERE  `product`.`product_type`=1";
		$products_one = get_result($sql);
		$data['products_one']=$products_one;
		$sql2="SELECT * FROM `product`
 WHERE  `product`.`product_type`=2";
		$products_two = get_result($sql2);

		$data['products_two']=$products_two;
		$sql3="SELECT media_path,category_id,category_title,category_name FROM `category` left JOIN media ON media.media_id=category.media_id";
		$products_category = get_result($sql3);
		
		$data['products_category']=$products_category;
		$data['home_cat_section'] = explode(",", get_option('home_cat_section'));
		$data['home'] = $this->load->view('website/home_content', $data, true);
		$this->load->view('website/home', $data);
	}
	public function ajax_search_items()
	{
		$search_query = $this->input->post('search_query');

		$result = get_result("SELECT * FROM product WHERE product_title LIKE '%$search_query%'  ORDER BY product_title DESC limit 0, 6");


		$html='';


		//	echo $result->num_rows();

		if($result)
		{
			$i=1; foreach($result as $prod)
		{
			$product_link = get_product_link($prod->product_id);

			// product price
			$discount = false;

			$product_price = $sell_price = floatval(get_product_meta($prod->product_id, 'sell_price'));

			$product_discount = get_product_meta($prod->product_id, 'discount_price');
			$discount_type = get_product_meta($prod->product_id, 'discount_type');

			if($product_discount != 0)
			{
				$discount = true;

				$product_discount = $save_money = floatval($product_discount);

				if($discount_type == 'fixed')
				{
					$sell_price = ($product_price - $product_discount);
				}
				elseif($discount_type == 'percent')
				{
					$save_money = ($product_discount / 100) * $product_price;
					$sell_price = floatval($product_price - $save_money);
				}
			}

			if($i<=6)
			{
				$html.='<li class="search-item" style="padding: 9px 7px;">
						<a href="'.$product_link.'" class="text-decoration-none">
							<div class="image">
								<img src="'.crop_image(get_product_thumb($prod->product_id), 50, 50).'">
							</div>
							<div class="name" style="margin-top: -47px;
    margin-left: 61px;">'.$prod->product_title.'</div>
							<div class="price" style="    margin-top: -6px;
    margin-left: 63px;">'.formatted_price($sell_price).'</div>
						</a>
					</li>';
			}

			$i++;
		}


			$resultx = get_result("SELECT * FROM product WHERE product_title LIKE '%$search_query%' ORDER BY product_title DESC");

			if(sizeof($resultx)>6)
			{
				$html.='<li class="search-item remainder-count"><a href="'.base_url().'search?q='.$search_query.'">'.(sizeof($resultx) - 6).' more results</a></li>';
			}
		}
		else
		{
			$html.='<li style="padding:10px;">No results found!</li>';
		}

		echo json_encode(array("status"=>"success", "return_value"=>$html));
		die();
	}

	public  function  checkout(){

		if($this->input->post()) {


			$row_data['order_total']		=	$this->input->post('order_total');
			$row_data['created_by']		=	'customer';
			$row_data['products']			=	serialize($this->input->post('products'));
			$row_data['payment_type']		=	$this->input->post('checkout_type');
			$row_data['order_area']		=	$this->input->post('order_area');
			$row_data['shipping_charge']		=	$this->input->post('shipping_charge');


			$row_data['customer_name']		=	$this->input->post('customer_name');
			$row_data['customer_phone']		=	$this->input->post('customer_phone');
			$row_data['customer_email']		=	$this->input->post('customer_email');
			$row_data['customer_address']		=	$this->input->post('customer_address');


			$row_data['shipment_time']		=	date("Y-m-d H:i:s");
			$row_data['created_time']		=	date("Y-m-d H:i:s");
			$row_data['modified_time']		=	date("Y-m-d H:i:s");
			$order_id=$this->MainModel->returnInsertId('order_data',$row_data);
			if($order_id) {
				redirect('checkout/thank-you/?order_id=' . $order_id, 'refresh');
			}

		} else {
			$data['page_name'] = 'home';
			$data['home'] = $this->load->view('website/checkout', $data, true);
			$this->load->view('website/home', $data);
		}

	}
	public  function thank_you(){
		$data['page_name'] = 'home';
		$order_id=$_GET['order_id'];
		$data['page_name'] = 'home';
		$data['order'] = $this->MainModel->getSingleData('order_id', $order_id, 'order_data', '*');


		$this->cart->destroy();


		$data['home'] = $this->load->view('website/thank_you', $data, true);
		$this->load->view('website/home', $data);

	}
	public  function category(){


		$uri_string = explode("/", uri_string());
		$category_name = end($uri_string);
		$category_data= $this->MainModel->getSingleData('category_name', $category_name, 'category', 'category_id,category_title,category_name,seo_title,seo_meta_title,seo_keywords,seo_content,seo_meta_content');


		$data['breadcumb_category']=$category_data->category_title;
		$data['breadcumb_category_link']=$category_data->category_name;
		$data['category_id']=$category_data->category_id;
		$category_name=$category_data->category_name;
		$data['seo_title']			=	$category_data->seo_title;
		$data['seo_keywords']		=	$category_data->seo_keywords;
		$data['seo_content']		=	$category_data->seo_content;
		$data['page_title']			=	ucwords(str_replace("-", " ", $category_name));

		$this->load->view('website/header', $data);
		$this->load->view('website/category_products', $data);
		$this->load->view('website/footer', $data);


	}

	public  function  product(){

		$uri_string = explode("/", uri_string());
		$product_name = end($uri_string);
		$post= $this->MainModel->getSingleData('product_name', $product_name, 'product', 'product_name,product_id,product_title,product_price,discount_price,product_description,sku,product_stock,discount_type,product_video,seo_title,seo_keywords,seo_content,product_terms');

		$data['prod_row'] = $post;
		$data['page_title']		=	$post->product_title;
		$data['seo_title']		=	$post->seo_title;
		$data['seo_keywords']	=	$post->seo_keywords;
		$data['seo_content']	=	$post->seo_content;
		$sql="SELECT category_title,category_name FROM `term_relation` join category on category.category_id=term_relation.term_id
WHERE product_id=$post->product_id limit 1";
		$category=get_result($sql);
		$data['breadcumb_category']=$category[0]->category_title;
		$data['breadcumb_category_link']='category/'.$category[0]->category_name;

		$this->load->view('website/header', $data);
		$this->load->view('website/product_font_view', $data);
		$this->load->view('website/footer', $data);



	}
}
