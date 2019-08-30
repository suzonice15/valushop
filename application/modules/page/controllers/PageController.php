<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends MX_Controller {

	public function __construct()
	{
		$this->load->model('MainModel');


	}

	public function index()
	{

		$data['main'] = "Page";
		$data['active'] = "Page" ;

		$data['pageContent'] = $this->load->view('page/pages/page_index', $data, true);
		$this->load->view('layouts/main', $data);
	}

	public function create()
	{

		$data['title'] = "Page registration form ";
		$data['main'] = "Page";
		$data['active'] = "Add Page";
		$data['categories'] = $this->MainModel->getAllData('', 'category', '*', 'parent_id ASC');
		$data['pageContent'] = $this->load->view('page/pages/page_create', $data, true);
		$this->load->view('layouts/main', $data);
	}


	public function store()
	{
		$row_data['category_title']		=	$this->input->post('category_title');
		$row_data['category_name']		=	$this->input->post('category_name');
		$row_data['parent_id']			=	$this->input->post('parent_id');
		$row_data['top_menu']			=	$this->input->post('top_menu');
		$row_data['rank_order']			=	$this->input->post('rank_order');

		$row_data['target_url1']		=	$this->input->post('target_url1');
		$row_data['target_url2']		=	$this->input->post('target_url2');
		$row_data['target_url3']		=	$this->input->post('target_url3');

		$row_data['seo_title']			=	$this->input->post('seo_title');
		$row_data['seo_meta_title']		=	$this->input->post('seo_meta_title');
		$row_data['seo_keywords']		=	$this->input->post('seo_keywords');
		$row_data['seo_content']		=	$this->input->post('seo_content');
		$row_data['seo_meta_content']	=	$this->input->post('seo_meta_content');

		$this->form_validation->set_rules('category_title', 'Page Title', 'trim|required');
		$this->form_validation->set_rules('category_name', 'Page Name', 'trim|required');

		if ($this->form_validation->run()==FALSE)
		{
			redirect('category-create');
			$this->session->set_flashdata('error','Fill Up all the field !!!!!!!!!!!!!!!!!!!');
		}
		else
		{
			if(isset($_FILES["featured_image"]) && $_FILES["featured_image"]["size"]>50)
			{
				$uploaded_image_path = "./uploads/".$_FILES["featured_image"]["name"];
				$uploaded_file_path = "uploads/".$_FILES["featured_image"]["name"];

				if(!file_exists($uploaded_file_path))
				{
					move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);

					$media_data 					= array();
					$media_data['media_title'] 		= $row_data['category_title'];
					$media_data['media_path'] 		= $uploaded_file_path;
					$media_data['created_time']		= date("Y-m-d H:i:s");
					$media_data['modified_time']	= date("Y-m-d H:i:s");
					$media_id = $this->MainModel->returnInsertId('media',$media_data);
				}
				else
				{
					move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);
					$media_id = get_media_id($uploaded_file_path);
				}

				$row_data['media_id'] = $media_id;
			}

			if(isset($_FILES["medium_banner"]) && $_FILES["medium_banner"]["size"]>50)
			{
				$uploaded_image_path = "./uploads/".$_FILES["medium_banner"]["name"];
				$uploaded_file_path = "uploads/".$_FILES["medium_banner"]["name"];

				if(!file_exists($uploaded_file_path))
				{
					move_uploaded_file($_FILES["medium_banner"]["tmp_name"], $uploaded_image_path);

					$media_data 					= array();
					$media_data['media_title'] 		= $row_data['category_title'];
					$media_data['media_path'] 		= $uploaded_file_path;
					$media_data['created_time']		= date("Y-m-d H:i:s");
					$media_data['modified_time']	= date("Y-m-d H:i:s");
					$medium_banner = $this->MainModel->returnInsertId('media',$media_data);
				}
				else
				{
					move_uploaded_file($_FILES["medium_banner"]["tmp_name"], $uploaded_image_path);
					$medium_banner = get_media_id($uploaded_file_path);
				}

				$row_data['medium_banner'] = $medium_banner;
			}

			if(isset($_FILES["category_gallery1"]) && $_FILES["category_gallery1"]["size"] > 1000)
			{
				$uploaded_image_path = "./uploads/".$_FILES["category_gallery1"]["name"];
				$uploaded_file_path = "uploads/".$_FILES["category_gallery1"]["name"];
				move_uploaded_file($_FILES["category_gallery1"]["tmp_name"], $uploaded_image_path);
				$category_gallery1 = get_media_id($uploaded_file_path);

				if(!$category_gallery1)
				{
					$media_data 					= array();
					$media_data['media_title'] 		= $row_data['category_title'].' Gallery1';
					$media_data['media_path'] 		= $uploaded_file_path;
					$media_data['created_time']		= date("Y-m-d H:i:s");
					$media_data['modified_time']	= date("Y-m-d H:i:s");

					if($this->MainModel->returnInsertId('media',$media_data))
					{
						$category_gallery1 = get_media_id($uploaded_file_path);
					}
				}

				$row_data['category_gallery1'] = $category_gallery1;
			}

			if(isset($_FILES["category_gallery2"]) && $_FILES["category_gallery2"]["size"] > 1000)
			{
				$uploaded_image_path = "./uploads/".$_FILES["category_gallery2"]["name"];
				$uploaded_file_path = "uploads/".$_FILES["category_gallery2"]["name"];
				move_uploaded_file($_FILES["category_gallery2"]["tmp_name"], $uploaded_image_path);
				$category_gallery2 = get_media_id($uploaded_file_path);

				if(!$category_gallery2)
				{
					$media_data 					= array();
					$media_data['media_title'] 		= $row_data['category_title'].' Gallery1';
					$media_data['media_path'] 		= $uploaded_file_path;
					$media_data['created_time']		= date("Y-m-d H:i:s");
					$media_data['modified_time']	= date("Y-m-d H:i:s");

					if($this->MainModel->returnInsertId('media',$media_data))
					{
						$category_gallery2 = get_media_id($uploaded_file_path);
					}
				}

				$row_data['category_gallery2'] = $category_gallery2;
			}

			if(isset($_FILES["category_gallery3"]) && $_FILES["category_gallery3"]["size"] > 1000)
			{
				$uploaded_image_path = "./uploads/".$_FILES["category_gallery3"]["name"];
				$uploaded_file_path = "uploads/".$_FILES["category_gallery3"]["name"];
				move_uploaded_file($_FILES["category_gallery3"]["tmp_name"], $uploaded_image_path);
				$category_gallery3 = get_media_id($uploaded_file_path);

				if(!$category_gallery3)
				{
					$media_data 					= array();
					$media_data['media_title'] 		= $row_data['category_title'].' Gallery1';
					$media_data['media_path'] 		= $uploaded_file_path;
					$media_data['created_time']		= date("Y-m-d H:i:s");
					$media_data['modified_time']	= date("Y-m-d H:i:s");

					if($this->MainModel->returnInsertId('media',$media_data))
					{
						$category_gallery3 = get_media_id($uploaded_file_path);
					}
				}

				$row_data['category_gallery3'] = $category_gallery3;
			}

			if($this->MainModel->insertData('category',$row_data))
			{
				
$this->session->set_flashdata('message','Page  added successfully!!!!!!!!!!!!!!!!!!!');
	redirect('category-create');			
	
	}
			else
			{
				
$this->session->set_flashdata('error','Page does not add successfully!!!!!!!!!!!!!!!!!!!');
	redirect('category-create');

			}
		}
	}


	public function show($id)
	{

	}

	public function edit($id)
	{
		$data['category'] = $this->MainModel->getSingleData('category_id', $id, 'category', '*');
        $data['categories'] = $this->MainModel->getAllData('', 'category', '*', 'parent_id ASC');
		$category_id = $data['category']->category_id;
		if (isset($category_id)) {
			$data['title'] = "Page update page ";
			$data['main'] = "Page";
			$data['active'] = "Update Page";
			$data['pageContent'] = $this->load->view('page/pages/page_edit', $data, true);
			$this->load->view('layouts/main', $data);
		} else {
			$this->session->set_flashdata('message', "The element you are trying to edit does not exist.");
			redirect('category-list');
		}

	}

	public function update()
	{
		$data['title'] = "Page update page ";
		$data['main'] = "Page";
		$data['active'] = "Update Page";
		$catId=$this->input->post('category_id');

			$row_data['category_title']		=	$this->input->post('category_title');
			$row_data['category_name']		=	$this->input->post('category_name');
			$row_data['parent_id']			=	$this->input->post('parent_id');
			$row_data['top_menu']			=	$this->input->post('top_menu');
			$row_data['rank_order']			=	$this->input->post('rank_order');

			$row_data['target_url1']		=	$this->input->post('target_url1');
			$row_data['target_url2']		=	$this->input->post('target_url2');
			$row_data['target_url3']		=	$this->input->post('target_url3');

			$row_data['seo_title']			=	$this->input->post('seo_title');
			$row_data['seo_meta_title']		=	$this->input->post('seo_meta_title');
			$row_data['seo_keywords']		=	$this->input->post('seo_keywords');
			$row_data['seo_content']		=	$this->input->post('seo_content');
			$row_data['seo_meta_content']	=	$this->input->post('seo_meta_content');

			$this->form_validation->set_rules('category_title', 'Page Title', 'required');
			$this->form_validation->set_rules('category_name', 'Page Name', 'required');

			if ($this->form_validation->run()==FALSE)
			{
				$data['pageContent'] = $this->load->view('page/pages/page_edit', $data, true);
				$this->load->view('layouts/main', $data);
			}
			else
			{
				if(isset($_FILES["featured_image"]) && $_FILES["featured_image"]["size"]>50)
				{
					$uploaded_image_path = "./uploads/".$_FILES["featured_image"]["name"];
					$uploaded_file_path = "uploads/".$_FILES["featured_image"]["name"];

					if(!file_exists($uploaded_file_path))
					{
						move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);

						$media_data 					= array();
						$media_data['media_title'] 		= $row_data['category_title'];
						$media_data['media_path'] 		= $uploaded_file_path;
						$media_data['created_time']		= date("Y-m-d H:i:s");
						$media_data['modified_time']	= date("Y-m-d H:i:s");
						$media_id = $this->MainModel->returnInsertId('media',$media_data);
					}
					else
					{
						move_uploaded_file($_FILES["featured_image"]["tmp_name"], $uploaded_image_path);
						$media_id = get_media_id($uploaded_file_path);
					}

					$row_data['media_id'] = $media_id;
				}

				if(isset($_FILES["medium_banner"]) && $_FILES["medium_banner"]["size"]>50)
				{
					$uploaded_image_path = "./uploads/".$_FILES["medium_banner"]["name"];
					$uploaded_file_path = "uploads/".$_FILES["medium_banner"]["name"];

					if(!file_exists($uploaded_file_path))
					{
						move_uploaded_file($_FILES["medium_banner"]["tmp_name"], $uploaded_image_path);

						$media_data 					= array();
						$media_data['media_title'] 		= $row_data['category_title'];
						$media_data['media_path'] 		= $uploaded_file_path;
						$media_data['created_time']		= date("Y-m-d H:i:s");
						$media_data['modified_time']	= date("Y-m-d H:i:s");
						$medium_banner = $this->MainModel->returnInsertId('media',$media_data);
					}
					else
					{
						move_uploaded_file($_FILES["medium_banner"]["tmp_name"], $uploaded_image_path);
						$medium_banner = get_media_id($uploaded_file_path);
					}

					$row_data['medium_banner'] = $medium_banner;
				}

				if(isset($_FILES["category_gallery1"]) && $_FILES["category_gallery1"]["size"] > 1000)
				{
					$uploaded_image_path = "./uploads/".$_FILES["category_gallery1"]["name"];
					$uploaded_file_path = "uploads/".$_FILES["category_gallery1"]["name"];
					move_uploaded_file($_FILES["category_gallery1"]["tmp_name"], $uploaded_image_path);
					$category_gallery1 = get_media_id($uploaded_file_path);

					if(!$category_gallery1)
					{
						$media_data 					= array();
						$media_data['media_title'] 		= $row_data['category_title'].' Gallery1';
						$media_data['media_path'] 		= $uploaded_file_path;
						$media_data['created_time']		= date("Y-m-d H:i:s");
						$media_data['modified_time']	= date("Y-m-d H:i:s");

						if($this->MainModel->returnInsertId('media',$media_data))
						{
							$category_gallery1 = get_media_id($uploaded_file_path);
						}
					}

					$row_data['category_gallery1'] = $category_gallery1;
				}

				if(isset($_FILES["category_gallery2"]) && $_FILES["category_gallery2"]["size"] > 1000)
				{
					$uploaded_image_path = "./uploads/".$_FILES["category_gallery2"]["name"];
					$uploaded_file_path = "uploads/".$_FILES["category_gallery2"]["name"];
					move_uploaded_file($_FILES["category_gallery2"]["tmp_name"], $uploaded_image_path);
					$category_gallery2 = get_media_id($uploaded_file_path);

					if(!$category_gallery2)
					{
						$media_data 					= array();
						$media_data['media_title'] 		= $row_data['category_title'].' Gallery1';
						$media_data['media_path'] 		= $uploaded_file_path;
						$media_data['created_time']		= date("Y-m-d H:i:s");
						$media_data['modified_time']	= date("Y-m-d H:i:s");

						if($this->MainModel->returnInsertId('media',$media_data))
						{
							$category_gallery2 = get_media_id($uploaded_file_path);
						}
					}

					$row_data['category_gallery2'] = $category_gallery2;
				}

				if(isset($_FILES["category_gallery3"]) && $_FILES["category_gallery3"]["size"] > 1000)
				{
					$uploaded_image_path = "./uploads/".$_FILES["category_gallery3"]["name"];
					$uploaded_file_path = "uploads/".$_FILES["category_gallery3"]["name"];
					move_uploaded_file($_FILES["category_gallery3"]["tmp_name"], $uploaded_image_path);
					$category_gallery3 = get_media_id($uploaded_file_path);

					if(!$category_gallery3)
					{
						$media_data 					= array();
						$media_data['media_title'] 		= $row_data['category_title'].' Gallery1';
						$media_data['media_path'] 		= $uploaded_file_path;
						$media_data['created_time']		= date("Y-m-d H:i:s");
						$media_data['modified_time']	= date("Y-m-d H:i:s");

						if($this->MainModel->returnInsertId('media',$media_data))
						{
							$category_gallery3 = get_media_id($uploaded_file_path);
						}
					}

					$row_data['category_gallery3'] = $category_gallery3;
				}

				if($this->MainModel->updateData('category_id',$catId,'category',$row_data))

				{

					$this->session->set_flashdata('message','Page  Updated successfully!!!!!!!!!!!!!!!!!!!');
					redirect('category-list');

				}
				else
				{

					$this->session->set_flashdata('error','Page does not Updated successfully!!!!!!!!!!!!!!!!!!!');
					redirect('category-edit');

				}
			}


	}




public  function multipleDelete(){
	$category=$this->input->post('category_id');
	for($i=0;$i<sizeof($category);$i++){
		$result = $this->MainModel->deleteData('category_id', $category[$i], 'category');
	}

	if ($result) {

		echo ('Multiple category deleted succefully');
	}
	else {
		echo ('Multiple category does not  deleted succefully');

	}

}

	public function destroy($id)
	{
		$data['category'] = $this->MainModel->getSingleData('category_id', $id, 'category', '*');
		$category_id = $data['category']->category_id;
		if (isset($category_id)) {
			$result = $this->MainModel->deleteData('category_id', $id, 'category');
			if ($result) {
				$this->session->set_flashdata('message', "Page deleted successfully !!!!");
				redirect('category-list');
			}
		} else {
			$this->session->set_flashdata('message', "The element you are trying to delete does not exist.");
			redirect('category-list');
		}
	}
	
}
