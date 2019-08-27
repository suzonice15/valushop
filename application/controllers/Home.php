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
		/*	$visitor['visitor_ip']=$_SERVER['REMOTE_ADDR'];
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
				$html.='<li class="search-item">
						<a href="'.$product_link.'">
							<div class="image">
								<img src="'.crop_image(get_product_thumb($prod->product_id), 50, 50).'">
							</div>
							<div class="name">'.$prod->product_title.'</div>
							<div class="price">'.formatted_price($sell_price).'</div>
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

}
