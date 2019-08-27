<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MediaController extends MX_Controller
{

	public function __construct()
	{
		$this->load->model('MainModel');


	}

	public function index()
	{

		$data['main'] = "Media";
		$data['active'] = "View Midia";

		$this->config->load('pagination');
		$this->load->library("pagination");
		$config = array();
		$media_title = $this->input->post('media_title');
		$config["base_url"] = base_url() . "media/MediaController/index";

		if ($media_title) {
			$config["total_rows"] = $this->MainModel->countByLikeCondition("media_title", $media_title, "media");
		} else {
			$config["total_rows"] = $this->MainModel->countAll('media');
		}


		$config['per_page'] = 20;
		$counter = $this->input->post('counter');
		if (isset($counter)) {
			if ($counter == 1) {
				$config['per_page'] = $this->MainModel->countAll('media');
			} else {
				$config['per_page'] = $counter;
			}

		}
		$config['uri_segment'] = 4;
		$config['num_links'] = 2;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		if ($media_title) {
			$data["media"] = $this->MainModel->select_all_data_by_name($config["per_page"], $page, 'media_title', $media_title, 'media', 'media_id desc');

		} else {
			$data["media"] = $this->MainModel->select_all_data_by_limit($config["per_page"], $page, 'media', 'media_id desc');
		}
		$data["links"] = $this->pagination->create_links();
		if ($this->input->is_ajax_request()) {

			$this->load->view('media/media/media_ajax', $data);

		} else {
			$data['pageContent'] = $this->load->view('media/media/media_index', $data, true);
			$this->load->view('layouts/main', $data);
		}


	}

	public function create()
	{

		$data['title'] = "Media registration form ";
		$data['main'] = "Media";
		$data['active'] = "Add Media";
		$data['categories'] = $this->MainModel->getAllData('', 'category', '*', 'parent_id ASC');
		$data['pageContent'] = $this->load->view('media/media/media_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{
		$row_data['media_title'] = $this->input->post('media_title');
		$this->form_validation->set_rules('media_title', 'Category Title', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			redirect('media-create');
			$this->session->set_flashdata('error', 'Fill Up all the field !!!!!!!!!!!!!!!!!!!');
		} else {
			if (isset($_FILES["featured_image"]) && $_FILES["featured_image"]["size"] > 50) {
				$uploaded_image_path = "uploads/" . date('d-m-Y-') . $_FILES["featured_image"]["name"];
				$uploaded_file_path = "uploads/" . $_FILES["featured_image"]["name"];

				if (!file_exists($uploaded_file_path)) {
					move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);

					$media_data = array();
					$row_data['media_path'] = $uploaded_image_path;
					$row_data['created_time'] = date("Y-m-d H:i:s");
				} else {
					move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);
					$media_id = get_media_id($uploaded_file_path);
				}

				$row_data['media_id'] = $media_id;
			}


			if ($this->MainModel->insertData('media', $row_data)) {

				$this->session->set_flashdata('message', 'Media  added successfully   !!!!!!');
				redirect('media-list');

			} else {

				$this->session->set_flashdata('error', 'Media does not add successfully  !!!!!!');
				redirect('media-create');

			}
		}
	}


	public function show($id)
	{

	}

	public function edit($id)
	{

	}

	public function picture_delete()
	{
		$picture=$this->input->post('picture');

		if(isset($picture)){

			$picture_path=$picture;
			//print_r($picture_path);
			if (file_exists($picture_path)) {
				unlink($picture_path);
				$this->session->set_flashdata('message', 'Picture  delete successfully   !!!!!!');
				redirect('picture-delete');
			}
			else {
				$this->session->set_flashdata('error', 'Picture  not found  failed to delete    !!!!!!');
				redirect('picture-delete');

			}
		} else {
			$data['title'] = "Media Picture delete  form ";
			$data['main'] = "Media";
			$data['active'] = "delete Picture";
			$data['pageContent'] = $this->load->view('media/media/media_picture_delete', $data, true);
			$this->load->view('layouts/main', $data);


		}



	}


	public function multipleDelete()
	{
		$media = $this->input->post('media_id');
		for ($i = 0; $i < sizeof($media); $i++) {
			$result = $this->MainModel->deleteData('media_id', $media[$i], 'media');
		}

		if ($result) {

			echo('Multiple Media deleted succefully');
		} else {
			echo('Multiple Media does not  deleted succefully');

		}

	}

	public function destroy($id)
	{
//		$data['category'] = $this->MainModel->getSingleData('category_id', $id, 'category', '*');
//		$category_id = $data['category']->category_id;
//		if (isset($category_id)) {
//			$result = $this->MainModel->deleteData('category_id', $id, 'category');
//			if ($result) {
//				$this->session->set_flashdata('message', "Category deleted successfully !!!!");
//				redirect('category-list');
//			}
//		} else {
//			$this->session->set_flashdata('message', "The element you are trying to delete does not exist.");
//			redirect('category-list');
//		}
	}

}
