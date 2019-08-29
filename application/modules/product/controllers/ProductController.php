<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends MX_Controller
{

	public function __construct()
	{
		$this->load->model('ProductModel');
		$this->load->model('MainModel');
		$this->load->library('image_lib');


	}

	public function index()
	{

		$data['main'] = "Products";
		$data['active'] = "View Products";
		$this->config->load('pagination');
		$this->load->library("pagination");
		$config = array();
		$product_title = $this->input->post('product_title');
		$config["base_url"] = base_url() . "product/ProductController/index";

		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = base_url() . "product/ProductController/index";
		$config["uri_segment"] = 4;
		$config["use_page_numbers"] = TRUE;
		$config["full_tag_open"] = '<ul class="pagination">';
		$config["full_tag_close"] = '</ul>';
		$config["first_tag_open"] = '<li>';
		$config["first_tag_close"] = '</li>';
		$config["last_tag_open"] = '<li>';
		$config["last_tag_close"] = '</li>';
		$config['next_link'] = '&gt;';
		$config["next_tag_open"] = '<li>';
		$config["next_tag_close"] = '</li>';
		$config["prev_link"] = "&lt;";
		$config["prev_tag_open"] = "<li>";
		$config["prev_tag_close"] = "</li>";
		$config["cur_tag_open"] = "<li class='active'><a href='#'>";
		$config["cur_tag_close"] = "</a></li>";
		$config["num_tag_open"] = "<li>";
		$config["num_tag_close"] = "</li>";


		if ($product_title) {
			$config["total_rows"] = $this->MainModel->countByLikeCondition("product_title", $product_title, "product");
		} else {
			$config["total_rows"] = $this->MainModel->countAll('product');
		}


		$config['per_page'] = 10;
		$counter = $this->input->post('counter');
		if (!empty($counter)) {
			if ($counter == 1) {
				$config['per_page'] = $config["total_rows"];
			} else {
				$config['per_page'] = $counter;
			}

		}
		$config['uri_segment'] = 4;
		$config['num_links'] = 5;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$this->pagination->initialize($config);

		if ($product_title) {
			$data["products"] = $this->MainModel->select_all_data_by_name($config["per_page"], $page, 'product_title', $product_title, 'product', 'product_id desc');

		} else {
			$data["products"] = $this->MainModel->select_all_data_by_limit($config["per_page"], $page, 'product', 'product_id desc');
		}


		$data["links"] = $this->pagination->create_links();
		if ($this->input->is_ajax_request()) {

			$this->load->view('product/products/products_ajax', $data);

		} else {
			$data['pageContent'] = $this->load->view('product/products/products_index', $data, true);
			$this->load->view('layouts/main', $data);
		}


	}

	public function create()
	{

		$data['title'] = "Product registration form ";
		$data['main'] = "Product";
		$data['active'] = "Add Product";
		$data['categories'] = $this->MainModel->getAllData('', 'category', '*', 'parent_id ASC');
		$data['categories'] = $this->MainModel->getAllData('', 'category', '*', 'parent_id ASC');
		$data['pageContent'] = $this->load->view('product/products/products_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{
		date_default_timezone_set("Asia/Dhaka");

		$row_data = array();
		$row_data['product_title'] = $this->input->post('product_title');
		$row_data['product_name'] = $this->input->post('product_name');
		$row_data['product_type'] = $this->input->post('product_type');
		$row_data['product_summary'] = $this->input->post('product_summary');
		$row_data['product_description'] = $this->input->post('product_description');
		$row_data['product_terms'] = $this->input->post('product_terms');
		$row_data['product_video'] = $this->input->post('product_video');
		$row_data['seo_title'] = $this->input->post('seo_title');
		$row_data['seo_keywords'] = $this->input->post('seo_keywords');
		$row_data['seo_content'] = $this->input->post('seo_content');
		$row_data['sku'] = $this->input->post('sku');
		$row_data['discount_type'] = $this->input->post('discount_type');
		$row_data['discount_price'] = $this->input->post('discount_price');
		$discount_price = $this->input->post('discount_price');
		$discount_from = $this->input->post('discount_from');
		$discount_to = $this->input->post('discount_to');

		if ($discount_price) {
			$discount_from = date('Y-m-d', strtotime($discount_from));
			$discount_to = date('Y-m-d', strtotime($discount_to));
			$row_data['discount_date_from']=$discount_from;
			$row_data['discount_date_to']=$discount_to;
		}

		if (empty($discount_from)) {
			$discount_from = date('Y-m-d');
			$row_data['discount_date_from']=$discount_from;

		}


		/*********************             product size               *********************/
		if($this->input->post('product_size'))
		{
			$product_sizes					=	$this->input->post('product_size');
			$row_data['product_of_size']		=implode(",",$product_sizes);

		}
		/*********************             product color               *********************/
		if($this->input->post('product_color')){
			$product_colors					=	$this->input->post('product_color');
			$row_data['product_color']		=implode(",",$product_colors);

		}




		$purchase_price = $this->input->post('purchase_price');
		$row_data['purchase_price'] = $this->input->post('purchase_price');
		$row_data['product_price'] = $this->input->post('sell_price');
		$row_data['product_stock'] = $this->input->post('stock_qty');



//			$installment_charge				=	$this->input->post('installment_charge');
//			$installment_period				=	$this->input->post('installment_period');



		$row_data['created_time'] = date("s-i-h-d-m-Y-");
		$row_data['modified_time'] = date("s-i-h-d-m-Y-");

		$this->form_validation->set_rules('product_title', 'product title', 'trim|required');
		$this->form_validation->set_rules('product_name', 'product name', 'trim|required');
		$this->form_validation->set_rules('sell_price', 'sell price', 'trim|required|numeric');

		if (empty($discount_price)) {
			$discount_type = $discount_from = $discount_to = '';
		}

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Fill up all the required field  !');
			redirect('product-create');

		} else {
			if ((($_FILES["featured_image"]["type"] == "image/jpg") || ($_FILES["featured_image"]["type"] == "image/jpeg") || ($_FILES["featured_image"]["type"] == "image/png") || ($_FILES["featured_image"]["type"] == "image/gif"))) {
				if ($_FILES["featured_image"]["error"] > 0) {
					echo "Return Code: " . $_FILES["featured_image"]["error"] . "<br />";
				} else {
					$uploaded_image_path = "uploads/" . date('s-i-h-d-m-Y-') . $_FILES["featured_image"]["name"];
					$uploaded_file_path = "uploads/" . date('s-i-h-d-m-Y-') . $_FILES["featured_image"]["name"];

					if (!file_exists($uploaded_file_path)) {
						move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);

						$media_data = array();
						$media_data['media_title'] = $row_data['product_title'];
						$media_data['media_path'] = $uploaded_image_path;
						$media_data['created_time'] = date("Y-m-d-h-");
						$media_data['modified_time'] = date("s-i-h-d-m-Y-");
						$media_data['modified_time'] = date("s-i-h-d-m-Y-");
						$featured_image = $this->MainModel->returnInsertId('media', $media_data);
						// resize image
						$config['image_library'] = 'gd2';
						$config['source_image'] = $uploaded_image_path;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = false;
						$config['thumb_marker'] = '_thumb';
						$config['new_image'] = $uploaded_image_path;
						$config['width'] = 150;
						$config['height'] = 150;
						$config['quality'] = '50%';
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
					} else {
						move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);

						$featured_image = get_media_id($uploaded_file_path);
						if (!$featured_image) {
							$media_data = array();
							$media_data['media_title'] = $row_data['product_title'];
							$media_data['media_path'] = $uploaded_file_path;
							$media_data['created_time'] = date("s-i-h-d-m-Y-");
							$media_data['modified_time'] = date("s-i-h-d-m-Y-");
							$featured_image = $this->MainModel->returnInsertId('media', $media_data);


							// resize image
							$config['image_library'] = 'gd2';
							$config['source_image'] = $uploaded_file_path;
							$config['create_thumb'] = TRUE;
							$config['maintain_ratio'] = false;
							$config['thumb_marker'] = '_thumb';
							$config['new_image'] = $uploaded_file_path;
							$config['width'] = 150;
							$config['height'] = 150;
							$config['quality'] = '50%';
							$this->image_lib->clear();
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
						}
					}
				}
			}

			$i = 1;
			for ($i == 1; $i <= 10; $i++) {
				if (isset($_FILES["product_image" . $i]) && $_FILES["product_image" . $i]["error"] == 0) {
					if ((($_FILES["product_image" . $i]["type"] == "image/jpg") || ($_FILES["product_image" . $i]["type"] == "image/jpeg") || ($_FILES["product_image" . $i]["type"] == "image/png") || ($_FILES["product_image" . $i]["type"] == "image/gif"))) {
						$uploaded_image_path = "uploads/". date('s-i-h-d-m-Y-')  . $_FILES["product_image" . $i]["name"];
						$uploaded_file_path = "uploads/" .date('s-i-h-d-m-Y-').  $_FILES["product_image" . $i]["name"];

						if (!file_exists($uploaded_file_path)) {
							move_uploaded_file($_FILES["product_image" . $i]["tmp_name"], $uploaded_image_path);

							$media_data = array();
							$media_data['media_title'] = $row_data['product_title'];
							$media_data['media_path'] = $uploaded_image_path;
							$media_data['created_time'] = date("s-i-h-d-m-Y-");
							$media_data['modified_time'] = date("s-i-h-d-m-Y-");
							$gallery_image[] = $this->MainModel->returnInsertId('media', $media_data);

							// resize image
							$config['image_library'] = 'gd2';
							$config['source_image'] = $uploaded_image_path;
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = TRUE;
							$config['thumb_marker'] = '_thumb';
							$config['new_image'] = $uploaded_image_path;
							$config['width'] = 300;
							$config['height'] = 300;
							$config['quality'] = '50%';
							$this->image_lib->clear();
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
						} else {
							move_uploaded_file($_FILES["product_image" . $i]["tmp_name"], $uploaded_image_path);

							$gallery_image_id = get_media_id($uploaded_image_path);
							$gallery_image[] = $gallery_image_id;

							if (!$gallery_image_id) {
								$media_data = array();
								$media_data['media_title'] = $row_data['product_title'];
								$media_data['media_path'] = $uploaded_image_path;
								$media_data['created_time'] = date("s-i-h-d-m-Y-");
								$media_data['modified_time'] = date("s-i-h-d-m-Y-");
								$gallery_image[] = $this->MainModel->returnInsertId('media', $media_data);

								// resize image
								$config['image_library'] = 'gd2';
								$config['source_image'] = $uploaded_image_path;
								$config['create_thumb'] = false;
								$config['maintain_ratio'] = TRUE;
								$config['thumb_marker'] = '_thumb';
								$config['new_image'] = $uploaded_image_path;
								$config['width'] = 300;
								$config['height'] = 300;
								$this->image_lib->clear();
								$this->image_lib->initialize($config);
								$this->image_lib->resize();
							}
						}
					}
				}
			}

			if (isset($featured_image) && !empty($featured_image)) {
				if ($product_id = $this->MainModel->returnInsertId('product', $row_data)) {

					/*# term relation #*/
					$categories = $this->input->post('categories');

					$term_data['product_id'] = $product_id;

					foreach ($categories as $cat) {
						$term_data['term_id'] = $cat;
						$this->MainModel->insertData('term_relation', $term_data);

					}

					/*# media relation #*/
					update_product_meta($product_id, 'featured_image', $featured_image);

					if (isset($gallery_image) && count($gallery_image) > 0) {
						$gallery_image = array_values(array_filter($gallery_image));
						$gallery_image = implode(',', $gallery_image);
						update_product_meta($product_id, 'gallery_image', $gallery_image);
					}

					$this->session->set_flashdata('message', 'Product  added successfully!!!!!!');
					redirect('product-create');
				} else {
					$this->session->set_flashdata('error', 'Image upload problem  !');
					redirect('product-create');
				}
			} else {
				$this->session->set_flashdata('error', 'Upload featured image  !');
				redirect('product-create');
			}


		}
	}


	public function show($id)
	{

	}

	public function edit($id)

	{
		$data['product'] = $this->MainModel->getSingleData('product_id', $id, 'product', '*');
		$data['product_terms'] = $this->MainModel->getAllData("product_id=$id", 'term_relation', '*', 'product_id desc');
		$product_id = $data['product']->product_id;
		if (isset($product_id)) {
			$data['title'] = "Product update page ";
			$data['main'] = "Product";
			$data['active'] = "Update Product";
			$data['pageContent'] = $this->load->view('product/products/products_edit', $data, true);
			$this->load->view('layouts/main', $data);
		} else {
			$this->session->set_flashdata('message', "The element you are trying to edit does not exist.");
			redirect('product-list');
		}

	}

	public function update()
	{
		$product_id = $this->input->post('product_id');

		date_default_timezone_set("Asia/Dhaka");

		$row_data = array();
		$row_data['product_title'] = $this->input->post('product_title');
		$row_data['product_name'] = $this->input->post('product_name');
		$row_data['product_type'] = $this->input->post('product_type');
		$row_data['product_summary'] = $this->input->post('product_summary');
		$row_data['product_description'] = $this->input->post('product_description');
		$row_data['product_terms'] = $this->input->post('product_terms');
		$row_data['product_video'] = $this->input->post('product_video');
		$row_data['seo_title'] = $this->input->post('seo_title');
		$row_data['seo_keywords'] = $this->input->post('seo_keywords');
		$row_data['seo_content'] = $this->input->post('seo_content');
		$row_data['sku'] = $this->input->post('sku');
		$row_data['discount_type'] = $this->input->post('discount_type');
		$row_data['discount_price'] = $this->input->post('discount_price');



		$discount_price = $this->input->post('discount_price');
		$discount_from = $this->input->post('discount_from');
		$discount_to = $this->input->post('discount_to');

		if ($discount_price) {
			$discount_from = date('Y-m-d', strtotime($discount_from));
			$discount_to = date('Y-m-d', strtotime($discount_to));
			$row_data['discount_date_from']=$discount_from;
			$row_data['discount_date_to']=$discount_to;
		}

		if (empty($discount_from)) {
			$discount_from = date('Y-m-d');
			$row_data['discount_date_from']=$discount_from;

		}


		/*********************             product size               *********************/
		if($this->input->post('product_size'))
		{
			$product_sizes					=	$this->input->post('product_size');
			$row_data['product_of_size']		=implode(",",$product_sizes);

		}
		/*********************             product color               *********************/
		if($this->input->post('product_color')){
			$product_colors					=	$this->input->post('product_color');
			$row_data['product_color']		=implode(",",$product_colors);

		}




		$purchase_price = $this->input->post('purchase_price');
		$row_data['purchase_price'] = $this->input->post('purchase_price');
		$row_data['product_price'] = $this->input->post('sell_price');
		$row_data['product_stock'] = $this->input->post('stock_qty');



//			$installment_charge				=	$this->input->post('installment_charge');
//			$installment_period				=	$this->input->post('installment_period');



		$row_data['created_time'] = date("s-i-h-d-m-Y-");
		$row_data['modified_time'] = date("s-i-h-d-m-Y-");

		$this->form_validation->set_rules('product_title', 'product title', 'trim|required');
		$this->form_validation->set_rules('product_name', 'product name', 'trim|required');
		$this->form_validation->set_rules('sell_price', 'sell price', 'trim|required|numeric');

		if (empty($discount_price)) {
			$discount_type = $discount_from = $discount_to = '';
		} else {
			$this->form_validation->set_rules('discount_to', 'discount to', 'trim|required');
		}
		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('error', 'Fill up all the  Required field  !!!!!');
			$this->edit($product_id);
		} else {
			if ((($_FILES["featured_image"]["type"] == "image/jpg") || ($_FILES["featured_image"]["type"] == "image/jpeg") || ($_FILES["featured_image"]["type"] == "image/png") || ($_FILES["featured_image"]["type"] == "image/gif"))) {
				if ($_FILES["featured_image"]["error"] > 0) {
					echo "Return Code: " . $_FILES["featured_image"]["error"] . "<br />";
				} else {
					$uploaded_image_path = "uploads/" . date('s-i-h-d-m-Y-') . $_FILES["featured_image"]["name"];
					$uploaded_file_path = "uploads/" . date('s-i-h-d-m-Y-') . $_FILES["featured_image"]["name"];

					if (!file_exists($uploaded_file_path)) {
						move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);

						$media_data = array();
						$media_data['media_title'] = $row_data['product_title'];
						$media_data['media_path'] = $uploaded_image_path;
						$media_data['created_time'] = date("s-i-h-d-m-Y-");
						$media_data['modified_time'] = date("s-i-h-d-m-Y-");
						$featured_image = $this->MainModel->returnInsertId('media',$media_data);

						// resize image
						$config['image_library'] = 'gd2';
						$config['source_image'] = $uploaded_image_path;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['thumb_marker'] = '_thumb';
						$config['new_image'] = $uploaded_image_path;
						$config['width'] = 150;
						$config['height'] = 150;
						$config['quality'] = '50%';
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
					} else {
						move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);

						$featured_image = get_media_id($uploaded_image_path);
						if (!$featured_image) {
							$media_data = array();
							$media_data['media_title'] = $row_data['product_title'];
							$media_data['media_path'] = $uploaded_file_path;
							$media_data['created_time'] = date("s-i-h-d-m-Y-");
							$media_data['modified_time'] = date("s-i-h-d-m-Y-");
							$featured_image = $this->MainModel->returnInsertId('media',$media_data);

							// resize image
							$config['image_library'] = 'gd2';
							$config['source_image'] = $uploaded_image_path;
							$config['create_thumb'] = TRUE;
							$config['maintain_ratio'] = TRUE;
							$config['thumb_marker'] = '_thumb';
							$config['new_image'] = $uploaded_image_path;
							$config['width'] = 150;
							$config['height'] = 150;
							$config['quality'] = '50%';

							$this->image_lib->clear();
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
						}
					}
				}
			}

			$i = 1;
			for ($i == 1; $i <= 10; $i++) {
				if (isset($_FILES["product_image" . $i]) && $_FILES["product_image" . $i]["error"] == 0) {
					if ((($_FILES["product_image" . $i]["type"] == "image/jpg") || ($_FILES["product_image" . $i]["type"] == "image/jpeg") || ($_FILES["product_image" . $i]["type"] == "image/png") || ($_FILES["product_image" . $i]["type"] == "image/gif"))) {
						$uploaded_image_path = "uploads/" . date('s-i-h-d-m-Y-') . $_FILES["product_image" . $i]["name"];
						$uploaded_file_path = "uploads/" . date('s-i-h-d-m-Y-') .$_FILES["product_image" . $i]["name"];

						if (!file_exists($uploaded_file_path)) {
							move_uploaded_file($_FILES["product_image" . $i]["tmp_name"], $uploaded_image_path);

							$media_data = array();
							$media_data['media_title'] = $row_data['product_title'];
							$media_data['media_path'] = $uploaded_image_path;
							$media_data['created_time'] = date("s-i-h-d-m-Y-");
							$media_data['modified_time'] = date("s-i-h-d-m-Y-");
							$gallery_image[] =$this->MainModel->returnInsertId('media',$media_data);

							// resize image
							$config['image_library'] = 'gd2';
							$config['source_image'] = $uploaded_image_path;
							$config['create_thumb'] = false;
							$config['maintain_ratio'] = TRUE;
							$config['thumb_marker'] = '_thumb';
							$config['new_image'] = $uploaded_image_path;
							$config['width'] = 300;
							$config['height'] = 300;
							$this->image_lib->clear();
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
						} else {
							move_uploaded_file($_FILES["product_image" . $i]["tmp_name"], $uploaded_image_path);

							$gallery_image_id = get_media_id($uploaded_image_path);
							$gallery_image[] = $gallery_image_id;

							if (!$gallery_image_id) {
								$media_data = array();
								$media_data['media_title'] = $row_data['product_title'];
								$media_data['media_path'] = $uploaded_image_path;
								$media_data['created_time'] = date("s-i-h-d-m-Y-");
								$media_data['modified_time'] = date("s-i-h-d-m-Y-");
								$gallery_image[] =$this->MainModel->returnInsertId('media',$media_data);

								// resize image
								$config['image_library'] = 'gd2';
								$config['source_image'] = $uploaded_image_path;
								$config['create_thumb'] = false;
								$config['maintain_ratio'] = TRUE;
								$config['thumb_marker'] = '_thumb';
								$config['new_image'] = $uploaded_image_path;
								$config['width'] = 300;
								$config['height'] = 300;
								$this->image_lib->clear();
								$this->image_lib->initialize($config);
								$this->image_lib->resize();
							}
						}
					}
				}
			}

			if ($this->MainModel->updateData('product_id',$product_id,'product',$row_data)) {


				/*# term relation #*/
				 $this->MainModel->deleteData('product_id', $product_id, 'term_relation');


				$categories = $this->input->post('categories');

				$term_data['product_id'] = $product_id;

				foreach ($categories as $cat) {
					$term_data['term_id'] = $cat;

				//	$this->prod->add_new_term_relation($term_data);
					$this->MainModel->insertData('term_relation', $term_data);

				}

				/*# media relation #*/
				if (isset($featured_image) && !empty($featured_image)) {
					update_product_meta($product_id, 'featured_image', $featured_image);
				}

				if (isset($gallery_image) && count($gallery_image) > 0) {
					$old_gallery_image = explode(",", get_product_meta($product_id, 'gallery_image'));
					$gallery_image = array_unique(array_merge($old_gallery_image, $gallery_image));
					$gallery_image = array_values(array_filter($gallery_image));
					$gallery_image = implode(',', $gallery_image);
					update_product_meta($product_id, 'gallery_image', $gallery_image);
				}



				$this->session->set_flashdata('message', 'Product updated successfully !!!');
				redirect('product-list', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Failed to Update the data !!!');
				$this->edit($product_id);
			}
		}


	}

	public function limited()
	{

		$data['main'] = "Limited Stock Products";
		$data['active'] = "View Products";
		$data["products"] = $this->ProductModel->get_products(NULL, 'limited_stock');

		$data['pageContent'] = $this->load->view('product/products/products_limited', $data, true);
		$this->load->view('layouts/main', $data);



	}
	public  function  stock(){

		$data['active'] = "View Products";
if(isset($_GET['status'])){
	$status=$_GET['status'];
	if($status=='return_stock'){
		$data['main'] = "Return Stock Products";

	}
	else if ($status=='bad_stock') {

		$data['main'] = "Bad Stock Products";
	}
	else {

		$data['main'] = "Demurrage Stock Products";
	}
	$data['status']=$_GET['status'];


}
		$data["products"] = $this->MainModel->getAllData("stock_status='$status'",'stock_product', '*','stock_id desc');
		$data['pageContent'] = $this->load->view('product/products/products_stock', $data, true);
		$this->load->view('layouts/main', $data);


	}


	public function multipleDelete()
	{
		$products = $this->input->post('product_id');
		for ($i = 0; $i < sizeof($products); $i++) {
			$result = $this->MainModel->deleteData('product_id', $products[$i], 'product');
		}

		if ($result) {

			echo('Multiple Product deleted    succefully');
		} else {
			echo('Multiple Product deleted does not    succefully');

		}

	}

	public function deleteBadProduct()
	{
		$stock_id = $this->input->post('stock_id');
		for ($i = 0; $i < sizeof($stock_id); $i++) {
			$result = $this->MainModel->deleteData('stock_id', $stock_id[$i], 'stock_product');
		}

		if ($result) {

			echo(' Product deleted    succefully');
		} else {
			echo(' Product deleted does not    succefully');

		}

	}

	public function size()
	{
		$data['title'] = "Product size  registration form ";
		$data['main'] = "Product size";
		$data['active'] = "Add size";
		$data['pageContent'] = $this->load->view('product/products/products_size', $data, true);
		$this->load->view('layouts/main', $data);

	}

	public function color()
	{
		$data['title'] = "Product color  registration form ";
		$data['main'] = "Product color";
		$data['active'] = "Add color";
		$data['pageContent'] = $this->load->view('product/products/products_color', $data, true);
		$this->load->view('layouts/main', $data);

	}

	public function colorSave()
	{
		$row_data['product_color_name'] = $this->input->post('product_color_name');
		$this->form_validation->set_rules('product_color_name', 'Category Title', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			redirect('product-color');
			$this->session->set_flashdata('error', 'Fill Up all the field !!!!!!!!!!!!!!!!!!!');
		} else {
			$this->session->set_flashdata('message', 'Suceessfullly save !!!');

			$this->MainModel->insertData('product_color', $row_data);
			redirect('product-color');

		}


	}

	public function sizeSave()
	{
		$row_data['name'] = $this->input->post('product_size');
		$this->form_validation->set_rules('product_size', 'Category Title', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			redirect('product-size');
			$this->session->set_flashdata('error', 'Fill Up all the field !!!!!!!!!!!!!!!!!!!');
		} else {
			$this->session->set_flashdata('message', 'Suceessfullly save !!!');

			$this->MainModel->insertData('product_size', $row_data);
			redirect('product-size');

		}


	}

	public function sizeUpdate()
	{
		$product_size_id = $this->input->post('product_size_id');
		$row_data['name'] = $this->input->post('product_size');

		$this->form_validation->set_rules('product_size', 'Category Title', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			redirect('product-size');
			$this->session->set_flashdata('error', 'Fill Up all the field !!!!!!!!!!!!!!!!!!!');
		} else {
			$this->session->set_flashdata('message', 'Suceessfullly Update !!!');

			$this->MainModel->updateData('product_size_id', $product_size_id, 'product_size', $row_data);
			redirect('product-size');

		}


	}

	public function colorUpdate()
	{
		$product_size_id = $this->input->post('product_color_id');
		$row_data['product_color_name'] = $this->input->post('product_color_name');

		$this->form_validation->set_rules('product_color_name', 'Category Title', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			redirect('product-color');
			$this->session->set_flashdata('error', 'Fill Up all the field !!!!!!!!!!!!!!!!!!!');
		} else {
			$this->session->set_flashdata('message', 'Suceessfullly Update !!!');

			$this->MainModel->updateData('product_color_id', $product_size_id, 'product_color', $row_data);
			redirect('product-color');

		}


	}

	public function sizeEdit($id)
	{

		$data['size'] = $this->MainModel->getSingleData('product_size_id', $id, 'product_size', '*');
		$sizeId = $data['size']->product_size_id;

		if ($sizeId) {
			$data['title'] = "Product Update  form ";
			$data['main'] = "Product size ";
			$data['active'] = "Update size";

			$data['pageContent'] = $this->load->view('product/products/products_size_update', $data, true);
			$this->load->view('layouts/main', $data);


		} else {
			$this->session->set_flashdata('message', 'Unable to edite !!!');
			redirect('product-size');
		}


	}

	public function colorEdit($id)
	{

		$data['color'] = $this->MainModel->getSingleData('product_color_id', $id, 'product_color', '*');
		$sizeId = $data['color']->product_color_id;

		if ($sizeId) {
			$data['title'] = "Product Color Update  form ";
			$data['main'] = "Product Color ";
			$data['active'] = "Update Color";

			$data['pageContent'] = $this->load->view('product/products/products_color_update', $data, true);
			$this->load->view('layouts/main', $data);


		} else {
			$this->session->set_flashdata('message', 'Unable to edite !!!');
			redirect('product-size');
		}


	}


	public function destroy()

	{
		$products = $this->input->post('product_id');


		if (isset($products)) {
			$result = $this->MainModel->deleteData('product_id', $products, 'product');
			if ($result) {
				echo ' Product deleted    succefully';
			}
		} else {
			echo '  Product does not  delete    succefully';
		}
	}

	public function geleryImageDelete()
	{

		$media_id = $this->input->post('media_id');


		if (isset($media_id)) {
			$result = $this->MainModel->deleteData('media_id', $media_id, 'media');
			if ($result) {
				echo ' Media Romeve    succefully';
			}
		} else {
			echo '  Media Romeve does not      succefully';
		}

	}
	public  function urlCheck(){
		$url=$this->input->post('url');
		$result = $this->MainModel->getSingleData('product_name', $url, 'product', '*');
		if($result){
			echo '<span style="color:red">This Product url exits try with another</span>';
		}
		else {
			echo '';
		}

	}


}
