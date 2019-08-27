<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('cart');
		$this->load->model('OrderModel', 'order');
		$this->load->model('MainModel');
	}

	public function index()
	{


		$data['main'] = "Orders ";
		$data['active'] = "View Order ";



			$data['orders'] = $this->MainModel->getAllData("order_status='new'", 'order', '*', 'order_id desc');
			$data['pageContent'] = $this->load->view('order/orders/orders_index', $data, true);
			$this->load->view('layouts/main', $data);

	}
	function create()
	{
		date_default_timezone_set("Asia/Dhaka");

		$data['main'] = "Orders ";
		$data['active'] = "Add Order ";
		$data['title'] = " Order  registration form";
		$productQuery="select product.product_id,product.product_title from product 
join productmeta on productmeta.product_id =product.product_id
where productmeta.meta_key='stock_qty' and productmeta.meta_value>0";
		$data['orders'] = $this->MainModel->AllQueryDalta($productQuery);
		$data['user_id']=2;
		$data['couriers'] = $this->MainModel->getAllData("courier_status=1",'courier','*','courier_id desc');
		if($this->input->post())
				{

					$checkout_type = 'cash_on_delivery';
					$order_total = $this->input->post('order_total');
					$products = $this->input->post('products');

					$row_data						=	array();
					$row_data['order_total']		=	$order_total;
					$row_data['products']			=	serialize($products);
					$customerName=$this->input->post('billing_name').'('.$this->input->post('billing_phone').')';
					$row_data['custormer_name']=$customerName;
					$billing_name					=	$this->input->post('billing_name');
					$billing_phone					=	$this->input->post('billing_phone');
					$billing_email					=	$this->input->post('billing_email');
					$billing_address1				=	$this->input->post('billing_address1');
					$billing_address2				=	$this->input->post('billing_address2');
					$shipping_address1				=	$this->input->post('shipping_address1');

					$shipping_charge				=	$this->input->post('shipping_charge');
					$order_area						=	$this->input->post('order_area');
					$courier_phone					=	$this->input->post('courier_phone');
					$courier_email					=	$this->input->post('courier_email');

					$row_data['payment_type']		=	$checkout_type;

					$row_data['created_by']			=	$this->input->post('created_by');
					$row_data['staff_id']			=	$this->input->post('staff_id');

					$row_data['courier_service']	=	$this->input->post('courier_service');
					$row_data['order_status']		=	$this->input->post('order_status');
					$row_data['shipment_time']		=	date("Y-m-d H:i:s", strtotime($this->input->post('shipment_time')));

					$row_data['created_time']		=	date("Y-m-d H:i:s");
					$row_data['modified_time']		=	date("Y-m-d H:i:s");

					$this->form_validation->set_rules('billing_name', 'name', 'trim|required');
					$this->form_validation->set_rules('billing_phone', 'phone', 'trim|required|regex_match[/^[+.0-9().-]+$/]');
					$this->form_validation->set_rules('shipping_address1', 'delivery address', 'trim|required');
					$this->form_validation->set_rules('billing_address1', 'customer address', 'trim|required');
					$this->form_validation->set_rules('shipment_time', 'shipping date', 'trim|required');
					$this->form_validation->set_rules('courier_phone', 'courier phone', 'trim|regex_match[/^[+.0-9().-]+$/]');
					//$this->form_validation->set_rules('courier_email', 'courier email', 'trim|valid_email');

					if ($this->form_validation->run()==FALSE)
					{

						$this->session->set_flashdata('error', 'Fill Up all the Required field    !');
						redirect('order-create');
					}
					else
					{
						$order_id = $this->MainModel->returnInsertId('order',$row_data);
						if($order_id)
						{
							update_order_meta($order_id, 'billing_name', $billing_name);
							update_order_meta($order_id, 'billing_phone', $billing_phone);
							update_order_meta($order_id, 'billing_email', $billing_email);
							update_order_meta($order_id, 'billing_address1', $billing_address1);
							update_order_meta($order_id, 'billing_address2', $billing_address2);
							update_order_meta($order_id, 'shipping_address1', $shipping_address1);

							update_order_meta($order_id, 'shipping_charge', $shipping_charge);
							update_order_meta($order_id, 'order_area', $order_area);
							update_order_meta($order_id, 'courier_phone', $courier_phone);
							update_order_meta($order_id, 'courier_email', $courier_email);

							// send order confirmation email to customer
							$customer_email = $billing_email;
							$site_title = get_option('site_title');
							$site_email = get_option('email');

							$config['protocol'] = 'sendmail';
							$config['charset'] = 'utf-8';
							$config['wordwrap'] = TRUE;
							$config['mailtype'] = 'html';
							$this->email->initialize($config);

							$this->email->from($site_email, $site_title);
							$this->email->to($customer_email);
							$this->email->subject('Order Confirmation');

							$order_status = 'new';
							$product_items = $products;
							$payment_method = ucwords(str_replace('_', ' ', $checkout_type));
							$order_number = $order_id;
							//$shipping_charge;
							//$order_total;
							$customer_name = $billing_name;
							$customer_address = $billing_address1;
							$delivery_address = $shipping_address1;

							ob_start();
							include('applications/views/emails/email-header.php');
							include('applications/views/emails/new-order.php');
							include('applications/views/emails/email-footer.php');
							$email_body = ob_get_clean();

							//echo $email_body;
							$this->email->message($email_body);
							$this->email->send();

							$this->session->set_flashdata('message', 'Order has been completed');
							redirect('order-create');
						}
						else
						{
							$this->session->set_flashdata('error', 'Order does not completed try again');
							redirect('order-create');
						}
					}
				}
				else
				{
					$data['pageContent'] = $this->load->view('order/orders/orders_create', $data, true);
					$this->load->view('layouts/main', $data);
				}

	}
public  function  update(){



		$data['row_id']			=	$this->input->post('row_id');
		$data['page_title']		=	'Order('.$data['row_id'].')';


			$order_number 				= $data['row_id'];
			$order_status 				= $this->input->post('order_status');
			$order 						=$this->MainModel->getSingleData('order_id', $order_number, 'order', '*');

			$row_data					= array();
			$row_data['modified_time']	= date("Y-m-d H:i:s");

			if(!isset($_GET['shipment']) && !isset($_GET['courier']) && !isset($_GET['ready_to_deliver']))
			{
				$order_total 			= $this->input->post('order_total');
				$products 				= $this->input->post('products');

				$billing_name 			= $this->input->post('billing_name');
				$billing_phone 			= $this->input->post('billing_phone');
				$billing_email 			= $this->input->post('billing_email');
				$billing_address1 		= $this->input->post('billing_address1');
				$shipping_address1 		= $this->input->post('shipping_address1');

				$service_cost 			= $this->input->post('service_cost');
				$discount 				= $this->input->post('discount');

				$row_data['order_total']= $order_total;
				$row_data['products']	= serialize($products);
			}
			else
			{
				$order_total 			= $order->order_total;
				$billing_email 			= get_order_meta($order->order_id, 'billing_email');
				$products 				= unserialize($order->products);
				$billing_name 			= get_order_meta($order->order_id, 'billing_name');
				$billing_address1 		= get_order_meta($order->order_id, 'billing_address1');
				$shipping_address1 		= get_order_meta($order->order_id, 'shipping_address1');
			}

			// send order status email to customer
			$customer_email 			= $billing_email;
			$site_title 				= get_option('site_title');
			$site_email					= get_option('email');

			$product_items 				= $products;
			$payment_method 			= ucwords(str_replace('_', ' ', $order->payment_type));
			$shipping_charge 			= get_order_meta($order->order_id, 'shipping_charge');
			//$order_total 				= $order_total;
			$customer_name 				= $billing_name;
			$customer_address 			= $billing_address1;
			$delivery_address 			= $shipping_address1;

			$courier_code 				= $this->input->post('courier_code');
			$courier_phone				= $this->input->post('courier_phone');
			$courier_email				= $this->input->post('courier_email');

			$delivery_man				= ($this->input->post('delivery_man')) ? $this->input->post('delivery_man') : null;
			$delivery_man_phone			= ($this->input->post('delivery_man_phone')) ? $this->input->post('delivery_man_phone') : null;
			$delivery_time				= ($this->input->post('delivery_time')) ? date('Y-m-d', strtotime($this->input->post('delivery_time'))) : null;

			$config['protocol'] = 'sendmail';
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($site_email, $site_title);
			$this->email->to($customer_email);
			$this->email->subject('Order Status');

			if($order_status=='cancled')
			{
				ob_start();
				include('applications/views/emails/email-header.php');
				include('applications/views/emails/cancle-order.php');
				include('applications/views/emails/email-footer.php');
				$email_body = ob_get_clean();
			}
			elseif($order_status=='completed')
			{
				ob_start();
				include('applications/views/emails/email-header.php');
				include('applications/views/emails/complete-order.php');
				include('applications/views/emails/email-footer.php');
				$email_body = ob_get_clean();
			}
			else
			{
				ob_start();
				include('applications/views/emails/email-header.php');
				include('applications/views/emails/order-content.php');
				include('applications/views/emails/email-footer.php');
				$email_body = ob_get_clean();
			}

			if(isset($_GET['shipment']) && $_GET['shipment']=='process')
			{
				$row_data['courier_code'] 	= $courier_code;
				$row_data['order_status'] 	= $order_status;

				if($this->order->update_order($row_data, $order_number))
				{
					update_order_meta($order_number, 'courier_phone', $courier_phone);
					update_order_meta($order_number, 'courier_email', $courier_email);

					$this->email->message($email_body);
					$this->email->send();

					redirect('order-list/'.$order_number.'?message=success&purpose=update', 'refresh');
				}
				else
				{
					redirect('admin/order/print-view/'.$order_number.'?message=false&msg=failed+to+update', 'refresh');
				}
			}
			elseif(isset($_GET['courier']) && $_GET['courier']=='process')
			{
				$row_data['courier_code'] 	= $courier_code;
				$row_data['order_status'] 	= $order_status;

				if($this->order->update_order($row_data, $order_number))
				{
					update_order_meta($order_number, 'courier_phone', $courier_phone);
					update_order_meta($order_number, 'courier_email', $courier_email);
					update_order_meta($order_number, 'delivery_man', $delivery_man);
					update_order_meta($order_number, 'delivery_man_phone', $delivery_man_phone);
					update_order_meta($order_number, 'delivery_time', $delivery_time);

					$this->email->message($email_body);
					$this->email->send();

					redirect('admin/order/courier-view/'.$order_number.'?message=success&purpose=update', 'refresh');
				}
				else
				{
					redirect('admin/order/courier-view/'.$order_number.'?message=false&msg=failed+to+update', 'refresh');
				}
			}
			elseif(isset($_GET['ready_to_deliver']) && $_GET['ready_to_deliver']=='process')
			{
				$row_data['courier_code'] 	= $courier_code;
				$row_data['order_status'] 	= $order_status;

				if($this->order->update_order($row_data, $order_number))
				{
					update_order_meta($order_number, 'courier_phone', $courier_phone);
					update_order_meta($order_number, 'courier_email', $courier_email);
					update_order_meta($order_number, 'delivery_man', $delivery_man);
					update_order_meta($order_number, 'delivery_man_phone', $delivery_man_phone);
					update_order_meta($order_number, 'delivery_time', $delivery_time);

					$this->email->message($email_body);
					$this->email->send();

					redirect('admin/order/ready-to-deliver-view/'.$order_number.'?message=success&purpose=update', 'refresh');
				}
				else
				{
					redirect('admin/order/ready-to-deliver-view/'.$order_number.'?message=false&msg=failed+to+update', 'refresh');
				}
			}
			else
			{
				$order_area						= $this->input->post('order_area');

				$row_data['courier_service']	= $this->input->post('courier_service');
				$row_data['shipment_time']		= date("Y-m-d H:i:s", strtotime($this->input->post('shipment_time')));
				$row_data['order_status'] 		= $order_status;

				if($this->order->update_order($row_data, $order_number))
				{
					update_order_meta($order_number, 'billing_name', $billing_name);
					update_order_meta($order_number, 'billing_phone', $billing_phone);
					update_order_meta($order_number, 'billing_email', $billing_email);
					update_order_meta($order_number, 'billing_address1', $billing_address1);
					update_order_meta($order_number, 'shipping_address1', $shipping_address1);

					update_order_meta($order_number, 'service_cost', $service_cost);
					update_order_meta($order_number, 'discount', $discount);

					update_order_meta($order_number, 'order_area', $order_area);
					update_order_meta($order_number, 'courier_phone', $courier_phone);
					update_order_meta($order_number, 'courier_email', $courier_email);
					update_order_meta($order_number, 'delivery_man', $delivery_man);
					update_order_meta($order_number, 'delivery_man_phone', $delivery_man_phone);

					$this->email->message($email_body);
					$this->email->send();

					redirect('admin/order/view/'.$order_number.'?message=success&purpose=update', 'refresh');
				}
				else
				{
					redirect('admin/order/view/'.$order_number.'?message=false&msg=failed+to+update', 'refresh');
				}
			}



}

	public function completed_order()
	{
		if($this->session->userdata('loggedin'))
		{
			$userdata = $this->session->userdata('loggedin');
			$data['user_id']		=	$userdata['user_id'];
			$data['user_name']		=	$userdata['user_name'];
			$data['user_phone']		=	$userdata['user_phone'];
			$data['user_type']		=	$userdata['user_type'];
			$data['user_email']		=	$userdata['user_email'];
			$data['page_title']		=	'Orders';
			$data['form_title']		=	'Save';
			$data['order_status']	=	'completed';

			if($data['user_type']=='admin' || $data['user_type']=='super-admin' || $data['user_type']=='office-staff')
			{
				$data['user_sidebar'] =	$this->load->view('admin/sidebar', $data, true);
				$data['order_row'] = $this->order->get_orders('new');
				$this->load->view('header', $data);
				$this->load->view('order', $data);
				$this->load->view('footer', $data);
			}
			else
			{
				redirect('admin', 'refresh');
			}
		}
		else
		{
			redirect('admin', 'refresh');
		}
	}

	public function pending_order()
	{
		if($this->session->userdata('loggedin'))
		{
			$userdata = $this->session->userdata('loggedin');
			$data['user_id']		=	$userdata['user_id'];
			$data['user_name']		=	$userdata['user_name'];
			$data['user_phone']		=	$userdata['user_phone'];
			$data['user_type']		=	$userdata['user_type'];
			$data['user_email']		=	$userdata['user_email'];
			$data['page_title']		=	'Orders';
			$data['form_title']		=	'Save';
			$data['order_status']	=	'pending';

			if($data['user_type']=='admin' || $data['user_type']=='super-admin' || $data['user_type']=='office-staff')
			{
				$data['user_sidebar'] =	$this->load->view('admin/sidebar', $data, true);
				$data['order_row'] = $this->order->get_orders('new');
				$this->load->view('header', $data);
				$this->load->view('order', $data);
				$this->load->view('footer', $data);
			}
			else
			{
				redirect('admin', 'refresh');
			}
		}
		else
		{
			redirect('admin', 'refresh');
		}
	}

	public function order_view($order_id)
	{
		$data['main']   = "Orders ";
		$data['active'] = "View Single Order ";
		$data['order'] 	= 	$this->MainModel->getSingleData('order_id',$order_id,'order','*');
		$data['pageContent']= $this->load->view('order/orders/orders_view', $data, true);
		$this->load->view('layouts/main', $data);

	}

public  function OptionName($option_name){
	$curiar=$this->MainModel->getSingleData('option_name',$option_name,'options','option_value');
	$data=unserialize($curiar);
	var_dump($data);


}


	function update_order()
	{
		date_default_timezone_set("Asia/Dhaka");

		if($this->session->userdata('loggedin'))
		{
			$userdata = $this->session->userdata('loggedin');
			$data['user_id']		=	$userdata['user_id'];
			$data['user_name']		=	$userdata['user_name'];
			$data['user_phone']		=	$userdata['user_phone'];
			$data['user_type']		=	$userdata['user_type'];
			$data['user_email']		=	$userdata['user_email'];
			$data['row_id']			=	$this->input->post('row_id');
			$data['page_title']		=	'Order('.$data['row_id'].')';
			$data['form_title']		=	'Update';
			$data['user_sidebar']	=	$this->load->view('admin/sidebar', $data, true);

			if($data['user_type']=='admin' || $data['user_type']=='super-admin' || $data['user_type']=='office-staff' || $data['user_type']=='delivery-man')
			{
				$order_number 				= $data['row_id'];
				$order_status 				= $this->input->post('order_status');
				$order 						= $this->order->order_view($order_number);

				$row_data					= array();
				$row_data['modified_time']	= date("Y-m-d H:i:s");

				if(!isset($_GET['shipment']) && !isset($_GET['courier']) && !isset($_GET['ready_to_deliver']))
				{
					$order_total 			= $this->input->post('order_total');
					$products 				= $this->input->post('products');

					$billing_name 			= $this->input->post('billing_name');
					$billing_phone 			= $this->input->post('billing_phone');
					$billing_email 			= $this->input->post('billing_email');
					$billing_address1 		= $this->input->post('billing_address1');
					$shipping_address1 		= $this->input->post('shipping_address1');

					$service_cost 			= $this->input->post('service_cost');
					$discount 				= $this->input->post('discount');

					$row_data['order_total']= $order_total;
					$row_data['products']	= serialize($products);
				}
				else
				{
					$order_total 			= $order->order_total;
					$billing_email 			= get_order_meta($order->order_id, 'billing_email');
					$products 				= unserialize($order->products);
					$billing_name 			= get_order_meta($order->order_id, 'billing_name');
					$billing_address1 		= get_order_meta($order->order_id, 'billing_address1');
					$shipping_address1 		= get_order_meta($order->order_id, 'shipping_address1');
				}

				// send order status email to customer
				$customer_email 			= $billing_email;
				$site_title 				= get_option('site_title');
				$site_email					= get_option('email');

				$product_items 				= $products;
				$payment_method 			= ucwords(str_replace('_', ' ', $order->payment_type));
				$shipping_charge 			= get_order_meta($order->order_id, 'shipping_charge');
				//$order_total 				= $order_total;
				$customer_name 				= $billing_name;
				$customer_address 			= $billing_address1;
				$delivery_address 			= $shipping_address1;

				$courier_code 				= $this->input->post('courier_code');
				$courier_phone				= $this->input->post('courier_phone');
				$courier_email				= $this->input->post('courier_email');

				$delivery_man				= ($this->input->post('delivery_man')) ? $this->input->post('delivery_man') : null;
				$delivery_man_phone			= ($this->input->post('delivery_man_phone')) ? $this->input->post('delivery_man_phone') : null;
				$delivery_time				= ($this->input->post('delivery_time')) ? date('Y-m-d', strtotime($this->input->post('delivery_time'))) : null;

				$config['protocol'] = 'sendmail';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);

				$this->email->from($site_email, $site_title);
				$this->email->to($customer_email);
				$this->email->subject('Order Status');

				if($order_status=='cancled')
				{
					ob_start();
					include('applications/views/emails/email-header.php');
					include('applications/views/emails/cancle-order.php');
					include('applications/views/emails/email-footer.php');
					$email_body = ob_get_clean();
				}
				elseif($order_status=='completed')
				{
					ob_start();
					include('applications/views/emails/email-header.php');
					include('applications/views/emails/complete-order.php');
					include('applications/views/emails/email-footer.php');
					$email_body = ob_get_clean();
				}
				else
				{
					ob_start();
					include('applications/views/emails/email-header.php');
					include('applications/views/emails/order-content.php');
					include('applications/views/emails/email-footer.php');
					$email_body = ob_get_clean();
				}

				if(isset($_GET['shipment']) && $_GET['shipment']=='process')
				{
					$row_data['courier_code'] 	= $courier_code;
					$row_data['order_status'] 	= $order_status;

					if($this->order->update_order($row_data, $order_number))
					{
						update_order_meta($order_number, 'courier_phone', $courier_phone);
						update_order_meta($order_number, 'courier_email', $courier_email);

						$this->email->message($email_body);
						$this->email->send();

						redirect('admin/order/print-view/'.$order_number.'?message=success&purpose=update', 'refresh');
					}
					else
					{
						redirect('admin/order/print-view/'.$order_number.'?message=false&msg=failed+to+update', 'refresh');
					}
				}
				elseif(isset($_GET['courier']) && $_GET['courier']=='process')
				{
					$row_data['courier_code'] 	= $courier_code;
					$row_data['order_status'] 	= $order_status;

					if($this->order->update_order($row_data, $order_number))
					{
						update_order_meta($order_number, 'courier_phone', $courier_phone);
						update_order_meta($order_number, 'courier_email', $courier_email);
						update_order_meta($order_number, 'delivery_man', $delivery_man);
						update_order_meta($order_number, 'delivery_man_phone', $delivery_man_phone);
						update_order_meta($order_number, 'delivery_time', $delivery_time);

						$this->email->message($email_body);
						$this->email->send();

						redirect('admin/order/courier-view/'.$order_number.'?message=success&purpose=update', 'refresh');
					}
					else
					{
						redirect('admin/order/courier-view/'.$order_number.'?message=false&msg=failed+to+update', 'refresh');
					}
				}
				elseif(isset($_GET['ready_to_deliver']) && $_GET['ready_to_deliver']=='process')
				{
					$row_data['courier_code'] 	= $courier_code;
					$row_data['order_status'] 	= $order_status;

					if($this->order->update_order($row_data, $order_number))
					{
						update_order_meta($order_number, 'courier_phone', $courier_phone);
						update_order_meta($order_number, 'courier_email', $courier_email);
						update_order_meta($order_number, 'delivery_man', $delivery_man);
						update_order_meta($order_number, 'delivery_man_phone', $delivery_man_phone);
						update_order_meta($order_number, 'delivery_time', $delivery_time);

						$this->email->message($email_body);
						$this->email->send();

						redirect('admin/order/ready-to-deliver-view/'.$order_number.'?message=success&purpose=update', 'refresh');
					}
					else
					{
						redirect('admin/order/ready-to-deliver-view/'.$order_number.'?message=false&msg=failed+to+update', 'refresh');
					}
				}
				else
				{
					$order_area						= $this->input->post('order_area');

					$row_data['courier_service']	= $this->input->post('courier_service');
					$row_data['shipment_time']		= date("Y-m-d H:i:s", strtotime($this->input->post('shipment_time')));
					$row_data['order_status'] 		= $order_status;

					if($this->order->update_order($row_data, $order_number))
					{
						update_order_meta($order_number, 'billing_name', $billing_name);
						update_order_meta($order_number, 'billing_phone', $billing_phone);
						update_order_meta($order_number, 'billing_email', $billing_email);
						update_order_meta($order_number, 'billing_address1', $billing_address1);
						update_order_meta($order_number, 'shipping_address1', $shipping_address1);

						update_order_meta($order_number, 'service_cost', $service_cost);
						update_order_meta($order_number, 'discount', $discount);

						update_order_meta($order_number, 'order_area', $order_area);
						update_order_meta($order_number, 'courier_phone', $courier_phone);
						update_order_meta($order_number, 'courier_email', $courier_email);
						update_order_meta($order_number, 'delivery_man', $delivery_man);
						update_order_meta($order_number, 'delivery_man_phone', $delivery_man_phone);

						$this->email->message($email_body);
						$this->email->send();

						redirect('admin/order/view/'.$order_number.'?message=success&purpose=update', 'refresh');
					}
					else
					{
						redirect('admin/order/view/'.$order_number.'?message=false&msg=failed+to+update', 'refresh');
					}
				}
			}
			else
			{
				redirect('authentication-failure', 'refresh');
			}
		}
		else
		{
			redirect('admin', 'refresh');
		}
	}


	function report()
	{

			$data['main']   = "Order Reports ";
			$data['active'] = "View Order report ";
			$data['user_type'] = "admin";

		$data['page_title']		=	'Order Report';
		$data['form_title']		=	'Update';
		$data['pageContent']= $this->load->view('order/orders/orders_report', $data, true);
		$this->load->view('layouts/main', $data);

	}


	function courier_report()
	{
		if($this->session->userdata('loggedin'))
		{
			$userdata = $this->session->userdata('loggedin');
			$data['user_id']		=	$userdata['user_id'];
			$data['user_name']		=	$userdata['user_name'];
			$data['user_phone']		=	$userdata['user_phone'];
			$data['user_type']		=	$userdata['user_type'];
			$data['user_email']		=	$userdata['user_email'];
			$data['row_id']			=	$this->input->post('row_id');
			$data['page_title']		=	'Courier Report';
			$data['form_title']		=	'Update';
			$data['user_sidebar']	=	$this->load->view('admin/sidebar', $data, true);

			if($data['user_type']=='admin' || $data['user_type']=='super-admin')
			{
				$this->load->view('header', $data);
				$this->load->view('courier_report', $data);
				$this->load->view('footer', $data);
			}
			else
			{
				redirect('authentication-failure', 'refresh');
			}
		}
		else
		{
			redirect('admin', 'refresh');
		}
	}


	function ready_for_shipment()
	{
		if($this->session->userdata('loggedin'))
		{
			$userdata = $this->session->userdata('loggedin');
			$data['user_id']		=	$userdata['user_id'];
			$data['user_name']		=	$userdata['user_name'];
			$data['user_phone']		=	$userdata['user_phone'];
			$data['user_type']		=	$userdata['user_type'];
			$data['user_email']		=	$userdata['user_email'];
			$data['row_id']			=	$this->input->post('row_id');
			$data['page_title']		=	'Order Ready For Shipment';
			$data['form_title']		=	'Update';
			$data['user_sidebar']	=	$this->load->view('admin/sidebar', $data, true);

			if($data['user_type']=='admin' || $data['user_type']=='super-admin' || $data['user_type']=='delivery-man')
			{
				$this->load->view('header', $data);
				$this->load->view('order_ready_for_shipment', $data);
				$this->load->view('footer', $data);
			}
			else
			{
				redirect('authentication-failure', 'refresh');
			}
		}
		else
		{
			redirect('admin', 'refresh');
		}
	}


	function ready_to_deliver()
	{
		if($this->session->userdata('loggedin'))
		{
			$userdata = $this->session->userdata('loggedin');
			$data['user_id']		=	$userdata['user_id'];
			$data['user_name']		=	$userdata['user_name'];
			$data['user_phone']		=	$userdata['user_phone'];
			$data['user_type']		=	$userdata['user_type'];
			$data['user_email']		=	$userdata['user_email'];
			$data['row_id']			=	$this->input->post('row_id');
			$data['page_title']		=	'Order Ready to Deliver';
			$data['form_title']		=	'Update';
			$data['user_sidebar']	=	$this->load->view('admin/sidebar', $data, true);

			if($data['user_type']=='admin' || $data['user_type']=='super-admin' || $data['user_type']=='delivery-man')
			{
				$this->load->view('header', $data);
				$this->load->view('order_ready_to_deliver', $data);
				$this->load->view('footer', $data);
			}
			else
			{
				redirect('authentication-failure', 'refresh');
			}
		}
		else
		{
			redirect('admin', 'refresh');
		}
	}




	function on_courier()
	{
		if($this->session->userdata('loggedin'))
		{
			$userdata = $this->session->userdata('loggedin');
			$data['user_id']		=	$userdata['user_id'];
			$data['user_name']		=	$userdata['user_name'];
			$data['user_phone']		=	$userdata['user_phone'];
			$data['user_type']		=	$userdata['user_type'];
			$data['user_email']		=	$userdata['user_email'];
			$data['row_id']			=	$this->input->post('row_id');
			$data['page_title']		=	'Order On Courier';
			$data['form_title']		=	'Update';
			$data['user_sidebar']	=	$this->load->view('admin/sidebar', $data, true);

			if($data['user_type']=='admin' || $data['user_type']=='super-admin' || $data['user_type']=='delivery-man')
			{
				$this->load->view('header', $data);
				$this->load->view('order_on_courier', $data);
				$this->load->view('footer', $data);
			}
			else
			{
				redirect('authentication-failure', 'refresh');
			}
		}
		else
		{
			redirect('admin', 'refresh');
		}
	}

	public function courier_view($order_id)
	{
		if($this->session->userdata('loggedin'))
		{
			$userdata = $this->session->userdata('loggedin');
			$data['user_id']		=	$userdata['user_id'];
			$data['user_name']		=	$userdata['user_name'];
			$data['user_phone']		=	$userdata['user_phone'];
			$data['user_type']		=	$userdata['user_type'];
			$data['user_email']		=	$userdata['user_email'];
			$data['page_title']		=	'Order ('.$order_id.') Courier View';
			$data['form_title']		=	'Update';
			$data['user_sidebar'] 	=	$this->load->view('admin/sidebar', $data, true);
			$data['order'] 			= 	$this->order->order_view($order_id);

			if($data['user_type']=='admin' || $data['user_type']=='super-admin' || $data['user_type']=='office-staff' || $data['user_type']=='delivery-man')
			{
				$this->load->view('header', $data);
				$this->load->view('order_courier_view', $data);
				$this->load->view('footer', $data);
			}
			else
			{
				redirect('admin', 'refresh');
			}
		}
		else
		{
			redirect('admin', 'refresh');
		}
	}

	public function ready_to_deliver_view($order_id)
	{
		if($this->session->userdata('loggedin'))
		{
			$userdata = $this->session->userdata('loggedin');
			$data['user_id']		=	$userdata['user_id'];
			$data['user_name']		=	$userdata['user_name'];
			$data['user_phone']		=	$userdata['user_phone'];
			$data['user_type']		=	$userdata['user_type'];
			$data['user_email']		=	$userdata['user_email'];
			$data['page_title']		=	'Order ('.$order_id.') Ready to Deliver';
			$data['form_title']		=	'Update';
			$data['user_sidebar'] 	=	$this->load->view('admin/sidebar', $data, true);
			$data['order'] 			= 	$this->order->order_view($order_id);

			if($data['user_type']=='admin' || $data['user_type']=='super-admin' || $data['user_type']=='office-staff' || $data['user_type']=='delivery-man')
			{
				$this->load->view('header', $data);
				$this->load->view('order_ready_to_deliver_view', $data);
				$this->load->view('footer', $data);
			}
			else
			{
				redirect('admin', 'refresh');
			}
		}
		else
		{
			redirect('admin', 'refresh');
		}
	}
	public  function productSelection()
	{

		$product_ids = explode(",", $this->input->post('product_id'));
		$qty = $this->input->post('product_quantity');

		$this->db->select('*');
		$this->db->from('product');
		$this->db->where_in('product_id', $product_ids);
		$query = $this->db->get();
		$products = $query->result();
		$html = 'No Products Info. Found!';

		if (count($products) > 0) {
			$html = '<table class="table table-striped table-bordered">
				<tr>
					<th class="name" width="5%">Product</th>
					<th class="image text-center" width="5%">Image</th>
						<th class="image text-center" width="10%">Size</th>
							<th class="image text-center" width="20%">Color</th>
					<th class="quantity text-center" width="10%">Qty</th>
					<th class="price text-center" width="10%">Price</th>
					<th class="total text-right" width="10%">Sub-Total</th>
				</tr>';

			foreach ($products as $prod) {
				$sell_price = floatval(get_product_meta($prod->product_id, 'sell_price'));
				$this->db->select('product_of_size');
				$this->db->where('product_id', $prod->product_id);
				$productSize = $this->db->get('product')->result();
				foreach ($productSize as $product) {

					$proSizeList = $product->product_of_size;
				}
				$productSize_OF = explode(',', $proSizeList);

				$this->db->select('product_color');
				$this->db->where('product_id', $prod->product_id);
				$productColor = $this->db->get('product')->result();
				foreach ($productColor as $product_co) {

					$proColorlist = $product_co->product_color;
				}
				$productColor = explode(',', $proColorlist);

				$subtotal = ($sell_price * $qty);
				$totalamout[] = $subtotal;
				$featured_image = get_product_thumb($prod->product_id, 'thumb');

				$html .='<tr>
						<td>' . $prod->product_title . '</td>
						<td class="image text-center">
							<img src="' . $featured_image . '" height="30" width="30">
						</td>
						
								<td>
								<select name="products[items][' . $prod->product_id . '][Size]"  id="productSize" class="form-control item_Size" >';
				foreach ($productSize_OF as $key => $product_size_id_of):
					$html .= '<option value="' . $product_size_id_of . '">' . $product_size_id_of . '</option>';

				endforeach;

				$html .= '</select> 	</td>';
				$html .= '<td>
								<select name="products[items][' . $prod->product_id . '][Color]"  id="productSize" class="form-control item_color" >';
				foreach ($productColor as $key => $productCol):
					$html .= '<option value="' . $productCol . '">' . $productCol . '</option>';
				endforeach;
				$html .= '</select></td>
						<td class="text-center">
							<input type="number" name="products[items][' . $prod->product_id . '][qty]" class="form-control item_qty" value="' . $qty . '" data-item-id="' . $prod->product_id . '" style="width:60px;">
						</td>
						<td class="text-center">TK ' . $sell_price . '</td>
						<td class="text-right">TK ' . $subtotal . '</td>
					</tr>';

				$html .= form_hidden('products[items][' . $prod->product_id . '][featured_image]', $featured_image);
				$html .= form_hidden('products[items][' . $prod->product_id . '][price]', $sell_price);
				$html .= form_hidden('products[items][' . $prod->product_id . '][name]', $prod->product_title);
				$html .= form_hidden('products[items][' . $prod->product_id . '][subtotal]', $subtotal);
			}

			$html .= '</table>';

			$html .= '<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';

			$order_total = array_sum($totalamout);

			$delivery_cost = get_option('shipping_charge_in_dhaka');
			$delivery_cost_Out_Side_Dhaka = get_option('shipping_charge_out_of_dhaka');
			$order_total = $order_total + $delivery_cost;

			$html .= '<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">TK 
								<span id="subtotal_cost">
									' . array_sum($totalamout) . '
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold">Delivery Cost</span>
						</td>
						<td class="text-right">
							<span class="bold">TK <span id="delivery_cost">' . $delivery_cost . '</span></span>
							' . form_hidden('shipping_charge', $delivery_cost) . '
							' . form_hidden('shipping_charge_Out', $delivery_cost_Out_Side_Dhaka) . '
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">TK <span id="total_cost">' . $order_total . '</span></span>
							' . form_hidden('order_total', $order_total) . '
							' . form_hidden('checkout_type', 'cash_on_delivery') . '
						</td>
					</tr>';

			$html .= '</tbody>
			</table>';
		}


echo json_encode(array("html"=>$html));
die();
	}


	function productSelectionUpdate()
	{
		$product_ids = explode(",", $this->input->get_post('product_ids'));
		$product_qtys = explode(",", $this->input->get_post('product_qtys'));
		$size = $this->input->get_post('size');

		$pqty = array_combine($product_ids, $product_qtys);

		$this->db->select('*');
		$this->db->from('product');
		$this->db->where_in('product_id', $product_ids);
		$query = $this->db->get();
		$products = $query->result();

		$html='No Products Info. Found!';

		if(count($products)>0)
		{
			$html='<table class="table table-striped table-bordered">
				<tr>
					<th class="name" width="5%">Product</th>
					<th class="image text-center" width="5%">Image</th>
						<th class="image text-center" width="10%">Size</th>
							<th class="image text-center" width="20%">Color</th>
					<th class="quantity text-center" width="10%">Qty</th>
					<th class="price text-center" width="10%">Price</th>
					<th class="total text-right" width="10%">Sub-Total</th>
				</tr>';

			foreach($products as $prod)
			{
				$qty = $pqty[$prod->product_id];
				$this->db->select('product_of_size');
				$this->db->where('product_id',$prod->product_id);
				$productSize=$this->db->get('product')->result();
				foreach($productSize as $product){

					$proSizeList=  $product->product_of_size;
				}
				$productSize_OF=explode(',',$proSizeList);

				$this->db->select('product_color');
				$this->db->where('product_id',$prod->product_id);
				$productColor=$this->db->get('product')->result();
				foreach($productColor as $product_co){

					$proColorlist=  $product_co->product_color;
				}
				$productColor=explode(',',$proColorlist);

				$sell_price = floatval(get_product_meta($prod->product_id, 'sell_price'));
				$subtotal = ($sell_price * $qty);
				$totalamout[] = $subtotal;

				$featured_image = get_product_thumb($prod->product_id, 'thumb');

				$html.='<tr>
						<td>'.$prod->product_title.'</td>
						<td class="image text-center">
							<img src="'.$featured_image.'" height="30" width="30">
						</td>
							<td>
								<select name="products[items]['.$prod->product_id.'][Size]"  id="productSize" class="form-control item_Size" >';
				foreach($productSize_OF as $key=>$product_size_id_of):
					$html.='<option value="'.$product_size_id_of.'">'.$product_size_id_of.'</option>';

				endforeach;

				$html.='</select> 	</td>';

				$html.='<td>
								<select name="products[items]['.$prod->product_id.'][Color]"  id="productSize" class="form-control item_color" >';
				foreach($productColor as $key=>$productCol):
					$html.='<option value="'.$productCol.'">'.$productCol.'</option>';
				endforeach;
				$html.='</select></td>
						<td class="text-center">
							<input type="number" name="products[items]['.$prod->product_id.'][qty]" class="form-control item_qty" value="'.$qty.'" data-item-id="'.$prod->product_id.'" style="width:60px;">
						</td>
						<td class="text-center">TK '.$sell_price.'</td>
						<td class="text-right">TK '.$subtotal.'</td>
					</tr>';

				$html.=form_hidden('products[items]['.$prod->product_id.'][featured_image]', $featured_image);
				//$html.=form_hidden('products[items]['.$prod->product_id.'][qty]', $qty);
				$html.=form_hidden('products[items]['.$prod->product_id.'][price]', $sell_price);
				$html.=form_hidden('products[items]['.$prod->product_id.'][name]', $prod->product_title);
				$html.=form_hidden('products[items]['.$prod->product_id.'][subtotal]', $subtotal);
			}

			$html.='</table>';

			$html.='<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';

			$order_total = array_sum($totalamout);

			$delivery_cost = get_option('shipping_charge_in_dhaka');
			$delivery_cost_Out_Side_Dhaka = get_option('shipping_charge_out_of_dhaka');
			$order_total = $order_total + $delivery_cost;

			$html.='<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">TK 
								<span id="subtotal_cost">
									'.array_sum($totalamout).'
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold">Delivery Cost</span>
						</td>
						<td class="text-right">
							<span class="bold">TK <span id="delivery_cost">'.$delivery_cost.'</span></span>
							'.form_hidden('shipping_charge', $delivery_cost).'
							' . form_hidden('shipping_charge_Out', $delivery_cost_Out_Side_Dhaka) . '
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">TK <span id="total_cost">'.$order_total.'</span></span>
							'.form_hidden('order_total', $order_total).'
							'.form_hidden('checkout_type', 'cash_on_delivery').'
						</td>
					</tr>
				</tbody>
			</table>';
		}

		echo json_encode(array("html"=>$html));
		die();
	}

	public  function CourierSelection(){
		$courier_id=$this->input->post('courier_id');
		 $data['couriers'] = $this->MainModel->getAllData("courier_status=$courier_id",'courier','*','courier_id desc');
		 $html='<select name="courier_service" id="courier_service" class="form-control">';
		 foreach($data['couriers'] as $courier):
$html .='<option value="'.$courier->courier_name.'">'.$courier->courier_name.'</option>';
		 endforeach;
		 $html .='<select>';
		 echo $html;

	}
	public  function delete($orderId){

		if (isset($orderId)) {
			$result = $this->MainModel->deleteData('order_id', $orderId, 'order');
			if ($result) {

				$this->session->set_flashdata('message', ' Order deleted    successfully!');
				redirect('order-list');

			}else {
				$this->session->set_flashdata('error', ' Order Does not deleted    successfully!');
				redirect('order-list');


			}
		}

	}
	public function totalOrderReport(){
		$data['option']=$this->input->post('order_status');
		$option=$this->input->post('order_status');
		$data['order_by']=$this->input->post('order_by');
		$optionBy=$data['order_by'];
		$data['date_to']=date('Y-m-d',strtotime($this->input->post('date_to')));
		$date_to=date('Y-m-d',strtotime($this->input->post('date_to')));
		$data['date_from']=date('Y-m-d',strtotime($this->input->post('date_from')));
		$date_from=date('Y-m-d',strtotime($this->input->post('date_from')));
		if(strlen($optionBy)>0){
$query="SELECT * FROM `order`  
WHERE `staff_id`=$optionBy and `order_status`='$option' and `created_time` BETWEEN '$date_from' and '$date_to'
order by `order_id` DESC";
		}else {
			$query="SELECT * FROM `order`  
WHERE  `order_status`='$option' and `created_time` BETWEEN '$date_from' and '$date_to'
order by `order_id` DESC";
		}

			$data['orders'] = $this->MainModel->AllQueryDalta($query);


		$data['main'] = "Orders ";
		$data['active'] = "View Order ";

		$data['pageContent'] = $this->load->view('order/orders/orders_index', $data, true);
		$this->load->view('layouts/main', $data);


	}


	public  function multipleDelete(){
		$order=$this->input->post('order_id');
		for($i=0;$i<sizeof($order);$i++){
			$result = $this->MainModel->deleteData('order_id', $order[$i], 'order');
		}

		if ($result) {

			echo ('Multiple order deleted succefully');
		}
		else {
			echo ('Multiple order does not  deleted succefully');

		}

	}
}
