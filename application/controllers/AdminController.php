<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {


function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model'); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		 if (!$this->session->userdata('userid'))
		 		redirect(base_url().'welcome');
	}
  public function index()
	{
		$table="registration";
		$data['countstudents']=$this->Main_model->countdata($table);

		$table="products";
		 $data['products']=$this->Main_model->countdata($table);

		 $table="orders";
		 $where=array('status'=>'Completed');
		 $data['Complete']=$this->Main_model->countdata_where($table,$where);

		 $where=array('status'=>'Cancel');
		 $data['Cencel']=$this->Main_model->countdata_where($table,$where);

		 $where=array('status'=>'Pending');
		 $data['pendding']=$this->Main_model->countdata_where($table,$where);
		 
		 
		 $table="doctor_notes";
		 $where=array('status'=>'Completed');
		 $data['dComplete']=$this->Main_model->countdata_where($table,$where);

		 $where=array('status'=>'Cancel');
		 $data['dCencel']=$this->Main_model->countdata_where($table,$where);

		 $where=array('status'=>'Pending');
		 $data['dpendding']=$this->Main_model->countdata_where($table,$where);
		 
		 $where=array('status'=>'Completed');
		 $data['totalsele']=$this->Main_model->fetchdata_where_result('orders',$where);
		 

		$data['title'] = 'Dashboard';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('dashboard');
		$this->load->view('footer');
	}

	public function logout()
	{
		$userid = $this->session->userdata('userid');
		$this->session->unset_userdata('userid');
		redirect(base_url().'welcome');
	}

	public function emp_leave_list()
	{
		$data['leaves'] = $this->Main_model->fetchallleaves();
		$data['title'] = 'Category List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('leave-list',$data);
		$this->load->view('footer');
	}




        public function leave_status()
        {
        	$table="emp_leaves";
        	 $status=$this->input->post('status');
        	 $id=$this->input->post('id');

    $data = array('status'=>$status);
      $cities=$this->Main_model->updatedata($table,$data,$id);
		if($cities>0)
		{
		    $msg="successfully";
		return $msg;	
		}
		else
		{
		     $msg="Some thing Went Wrong !..";
		return $msg;
		}
        }

public function emp_work_list()
{
	$data['leaves'] = $this->Main_model->fetchallwork();
		$data['title'] = 'Work List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('work-list',$data);
		$this->load->view('footer');
}
public function emp_login_list()
{
	$data['logins'] = $this->Main_model->fetchalllogins();
		$data['title'] = 'Work List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('logins-list',$data);
		$this->load->view('footer');
}
	public function category_list()
	{
		$table="category";
		$where=array('deleted_at'=>1);
		$data['notes'] = $this->Main_model->fetchall($table,$where);
		$data['title'] = 'Category List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('category_list');
		$this->load->view('footer');
	}

	public function add_category()
	{
		$data['title'] = 'Category';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add_category');
		$this->load->view('footer');
	}
	public function insert_notes()
	{
		$this->form_validation->set_rules('notes', 'category', 'required|is_unique[category.categoryName]',array('is_unique'=>'This categoryName already exists.'));
		if ($this->form_validation->run() == TRUE)
		{
		$table="category";
		$notes=$this->input->post('notes');
		$date=date('d-M-Y');
			$uploadfile=$_FILES["category_image"]["tmp_name"];
      $folder="./uploads/category/";
      move_uploaded_file($_FILES["category_image"]["tmp_name"], "$folder".$_FILES["category_image"]["name"]);
      $category_image = $_FILES["category_image"]["name"]; 
      $usls="/uploads/category/";
      $pr=$usls.$category_image;
    	$data = array('categoryName'=>$notes,'categoryImage'=>$pr);
		$cities=$this->Main_model->insertdata($table,$data);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Category Added Successfully !.');
		redirect(base_url().'category_list');	
		}
		else
		{
			$this->session->set_flashdata('error','Some thing error');
		    redirect(base_url().'category_list');
		}

		}else{
		$data['title'] = 'Category List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add_category');
		$this->load->view('footer');
		}
	}


	public function notes_status()
        {
        	$table="important_notes";
        	$id=$this->uri->segment(2);
        	$status=$this->uri->segment(3);
        	if($status==1){
        		$upstatus=0;
        	}else{
        		$upstatus=1;
        	}
    	$data = array('status'=>$upstatus);
      	$cities=$this->Main_model->updatedata($table,$data,$id);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Status Change Successfully !.');
		redirect(base_url().'important-notes');	
		}
		else
		{
			$this->session->set_flashdata('error','Some thing Went Wrong !..');
		    redirect(base_url().'important-notes');
		}
        }



        public function edit_category()
        {
        	$table="category";
        	$id=$this->uri->segment(2);
        	$condition=array('categoryId'=>$id);
        	$data['students']=$this->Main_model->fetchdata_where($table,$condition);
        	$data['title'] = 'category Edit';
        	$this->load->view('head',$data);
        	$this->load->view('header');
        	$this->load->view('edit_category',$data);
        	$this->load->view('footer');
        }


        public function update_notes()
        {
        	$table="category";
        	$id=$this->uri->segment(2);
			$notes=$this->input->post('notes');
			
	if($_FILES["category_image"]["name"]=="")
     {
      $this->db->select("*");
      $this->db->where('categoryId',$id);
      $query = $this->db->get($table);
      $result = $query->row();
      $pr=$result->category_image;  
    }
    else{
      $no = rand();
      $uploadfile=$_FILES["category_image"]["tmp_name"];
      $folder="./uploads/category/";
      move_uploaded_file($_FILES["category_image"]["tmp_name"], "$folder".$_FILES["category_image"]["name"]);
      $category_image = $_FILES["category_image"]["name"]; 
      $usls="/uploads/category/";
      $pr=$usls.$category_image;
    }
    
   			$data = array('categoryName'=>$notes,'categoryImage'=>$pr);
   			$condition=array('categoryId'=>$id);
      	$cities=$this->Main_model->updatedata($table,$data,$condition);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Category Updated Successfully !.');
		redirect(base_url().'category_list');	
		}
		else
		{
			$this->session->set_flashdata('error','Some thing is Wrong');
		    redirect(base_url().'category_list');
		}
        }


    public function delete_category()
    {
	$id=$this->uri->segment(2);
	$table="category";
	$where=array('categoryId'=>$id);
	$data=array('deleted_at'=>0);
    $data['delete']=$this->Main_model->updatedata($table,$data,$where);
		$this->session->set_flashdata('success', 'category Deleted Successfully'); 
	 redirect(base_url().'category_list');
    }

    public function customer_list()
    {
    $table="customer";
		$data['structures'] = $this->Main_model->fetchall($table);
		$data['title'] = 'Customer List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('customer-list',$data);
		$this->load->view('footer');
    }

    public function add_customer()
    {

    $data['title'] = 'Add Customers';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add-customers');
		$this->load->view('footer');
    }

public function addcustomer()
    {
    	$this->form_validation->set_rules('cust_nam', 'Company Name', 'required|is_unique[customer.cust_nam]');
		$this->form_validation->set_rules('cust_email', 'Customer Email', 'required');
		$this->form_validation->set_rules('cust_mobile', 'Mobile ', 'required|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('cust_location', 'Location', 'required');
		$this->form_validation->set_rules('cust_password', 'Password', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
		$table="customer";
		$cust_nam=$this->input->post('cust_nam');
		$cust_email=$this->input->post('cust_email');
		$cust_mobile=$this->input->post('cust_mobile');
		$cust_location=$this->input->post('cust_location');
		$cust_password=$this->input->post('cust_password');
		$gstin=$this->input->post('gstin');
		$date=date('d-M-Y');
            $data = array('cust_nam'=>$cust_nam,'cust_email'=>$cust_email,'cust_mobile'=>$cust_mobile,'cust_location'=>$cust_location,'cust_state'=>$cust_password,'gstin'=>$gstin);
		$cities=$this->Main_model->insertdata($table,$data);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Company Add Successfully !.');
		redirect(base_url().'customer-list');	
		}
		else
		{
			$this->session->set_flashdata('error','Some Error ..!!');
		    redirect(base_url().'customer-list');
		}

		}else{
	
    $data['title'] = 'Add Company';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add-customers');
		$this->load->view('footer');
		}
    }


  public function edit_customer()
  {
      $table="customer";
					$id=$this->uri->segment(2);
					$data['fee_structures']=$this->Main_model->fetchdata($table,$id);
					$data['title'] = 'Client Edit';

					//print_r($data['fee_structures']);die;
					$this->load->view('head',$data);
					$this->load->view('header');
					$this->load->view('edit-customer',$data);
					$this->load->view('footer');  	
  }

  public function update_customer()
  {
    $id=$this->input->post('id');
		$table="customer";
		$cust_nam=$this->input->post('cust_nam');
		$cust_email=$this->input->post('cust_email');
		$cust_mobile=$this->input->post('cust_mobile');
		$cust_location=$this->input->post('cust_location');
		$cust_password=$this->input->post('cust_password');
		$gstin=$this->input->post('gstin');
		
		$date=date('d-M-Y');
            $data = array('cust_nam'=>$cust_nam,'cust_email'=>$cust_email,'cust_mobile'=>$cust_mobile,'cust_location'=>$cust_location,'cust_state'=>$cust_password,'gstin'=>$gstin);
    $cities=$this->Main_model->updatedata($table,$data,$id);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Company Updated Successfully !.');
		redirect(base_url().'customer-list');	
		}
		else
		{
			$this->session->set_flashdata('error','Some  Update error...');
		    redirect(base_url().'customer-list');
		}
  }

  public function delete_customer()
  {
    $id=$this->uri->segment(2);
		$table="customer";
		$data['delete']=$this->Main_model->deletedata($table,$id);
		$this->session->set_flashdata('success', 'Company Deleted Successfully'); 
	 redirect(base_url().'customer-list');
  }

 
  
	public function add_users()
	{
		$data['title']="Add Users";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add-users',$data);
		$this->load->view('footer');  	
	}


	public function addusers()
    {
    	$this->form_validation->set_rules('username', 'Name', 'required');
       $this->form_validation->set_rules('email_id', 'email', 'required|valid_email|is_unique[registration.email_id]',array('is_unique'=>'This email id already exists.'));
       $this->form_validation->set_rules('mobile_no', 'Mobile number', 'required|min_length[10]|max_length[10]|is_unique[registration.  mobile_no]',array('is_unique'=>'This Mobile number already exists.'));
		
		
		if ($this->form_validation->run() == TRUE)
		{
		$table="registration";
	$username=$this->input->post('username');
    $email_id=$this->input->post('email_id');
    $mobile_no=$this->input->post('mobile_no');
		$date=date('d-M-Y');
         $data = array('username'=>$username,'email_id'=>$email_id,' mobile_no'=>$mobile_no,'created_at'=>$date);
		$cities=$this->Main_model->insertdata($table,$data);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Users Submitted Successfully !.');
		redirect(base_url().'users-list');	
		}
		else
		{
			$this->session->set_flashdata('error','Some Error ..!!');
		    redirect(base_url().'users-list');
		}

		}else{
	
            $this->add_users();
		}
    }


	public function edit_employee()
	{
		$table="registration";
					  $id=$this->uri->segment(2);
					  $where=array('user_id'=>$id);
					  $data['fee_structures']=$this->Main_model->fetchdata_where($table,$where);
					  $data['title'] = 'Employee Edit';
  
					  //print_r($data['fee_structures']);die;
					  $this->load->view('head',$data);
					  $this->load->view('header');
					  $this->load->view('edit-employee',$data);
					  $this->load->view('footer');  	
	}


public function update_employee()
	{
	  $id=$this->input->post('id');
		  $table="registration";
		  $username=$this->input->post('username');
		  $email_id=$this->input->post('email_id');
		  $mobile_no=$this->input->post('mobile_no');
		  
		  $date_of_birth=$this->input->post('date_of_birth');
		  $primary_physician=$this->input->post('primary_physician');


		  if($_FILES["profile_image"]["name"]==""){
	        $this->db->select("*");
          $this->db->where('user_id',$id);
          $query = $this->db->get($table);
          $result = $query->row();
	        $color_img=$result->profile_image; 	
			  }
			else{
				$uploadfile=$_FILES["profile_image"]["tmp_name"];
            $folder="./uploads/users/";
      move_uploaded_file($_FILES["profile_image"]["tmp_name"], "$folder".$_FILES["profile_image"]["name"]);
      $path="/uploads/users/";
			$color_img = $path.$_FILES["profile_image"]["name"];
            
				}
		 
		  $date=date('d-M-Y');
			  $data = array('email_id'=>$email_id,'date_of_birth'=>$date_of_birth,'username'=>$username,'mobile_no'=>$mobile_no,'primary_physician'=>$primary_physician,'profile_image'=>$color_img,'update_at'=>$date);
			  $where=array('user_id'=>$id);
	  $cities=$this->Main_model->updatedata($table,$data,$where);
		  if($cities>0)
		  {
		  $this->session->set_flashdata('success','User Updated Successfully !.');
		  redirect(base_url().'users-list');	
		  }
		  else
		  {
			  $this->session->set_flashdata('error','Some  Update error...');
			  redirect(base_url().'users-list');
		  }
	}

		

	public function delete_employee()
  {
        $id=$this->uri->segment(2);
		$table="registration";
		$where=array('user_id'=>$id);
	    $cities=$this->Main_model->deletedata($table,$where);
		$this->session->set_flashdata('success', 'User Deleted Successfully'); 
	 redirect(base_url().'users-list');
  }

  public function color_list()
  {
  	$table="colors";
		$data['colors'] = $this->Main_model->fetchall($table);
  	$data['title'] = 'Colors';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('color-list',$data);
		$this->load->view('footer');  	
  }

  public function add_color($value='')
  {
  	$data['title'] = 'Colors';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add-color',$data);
		$this->load->view('footer'); 
  }

  public function insert_color()
  {
  	$this->form_validation->set_rules('color_name', 'Color Name', 'required|is_unique[colors.color_name]');
		if ($this->form_validation->run() == TRUE)
		{
		$table="colors";
		$color_name=$this->input->post('color_name');
		$no = rand();
			$uploadfile=$_FILES["color_img"]["tmp_name"];
            $folder="./uploads/color/";
      move_uploaded_file($_FILES["color_img"]["tmp_name"], "$folder".$no.$_FILES["color_img"]["name"]);
			$color_img = $no.$_FILES["color_img"]["name"];
            $data = array('color_name'=>$color_name,'color_img	'=>$color_img);
		$cities=$this->Main_model->insertdata($table,$data);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Color Submitted Successfully !.');
		redirect(base_url().'color-list');	
		}
		else
		{
			$this->session->set_flashdata('error','Some Error ..!!');
		    redirect(base_url().'color-list');
		}

		}else{
	
    $data['title'] = 'Add Color';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add-color');
		$this->load->view('footer');
		}
  }

  public function edit_color()
  {
  	$table="colors";
					  $id=$this->uri->segment(2);
					  $data['colors']=$this->Main_model->fetchdata($table,$id);
					  $data['title'] = 'Colors Edit';
  
					  //print_r($data['fee_structures']);die;
					  $this->load->view('head',$data);
					  $this->load->view('header');
					  $this->load->view('edit-color',$data);
					  $this->load->view('footer');  	
  }

  public function update_color()
  {
  	$id=$this->input->post('id');
		  $table="colors";
		  $color_name=$this->input->post('color_name');
  	if($_FILES["color_img"]["name"]==""){
	        $this->db->select("*");
            $this->db->where('id',$id);
            $query = $this->db->get($table);
            $result = $query->row();
	        $color_img=$result->color_img; 	
			  }
			else{
				$uploadfile=$_FILES["color_img"]["tmp_name"];
            $folder="./uploads/color/";
      move_uploaded_file($_FILES["color_img"]["tmp_name"], "$folder".$no.$_FILES["color_img"]["name"]);
			$color_img = $no.$_FILES["color_img"]["name"];
            
				}
				$data = array('color_name'=>$color_name,'color_img	'=>$color_img);
				 $cities=$this->Main_model->updatedata($table,$data,$id);
		  if($cities>0)
		  {
		  $this->session->set_flashdata('success','Color Updated Successfully !.');
		  redirect(base_url().'color-list');	
		  }
		  else
		  {
			  $this->session->set_flashdata('error','Some  Update error...');
			  redirect(base_url().'color-list');
		  }
			
  }

public function delete_color()
  {
    $id=$this->uri->segment(2);
		$table="colors";
		$data['delete']=$this->Main_model->deletedata($table,$id);
		$this->session->set_flashdata('success', 'colors Deleted Successfully'); 
	 redirect(base_url().'color-list');
  }


public function variant_list()
  {
  	$table="variants";
		$data['colors'] = $this->Main_model->fetchall($table);
  	$data['title'] = 'variants';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('variant-list',$data);
		$this->load->view('footer');  	
  }

  public function add_variant($value='')
  {
  	$data['title'] = 'variants';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add-variant',$data);
		$this->load->view('footer'); 
  }


public function insert_variant()
	{
		$this->form_validation->set_rules('variant_name', 'variant Size', 'required|is_unique[variants.variant_name]');
		if ($this->form_validation->run() == TRUE)
		{
		$table="variants";
		$variant_name=$this->input->post('variant_name');

		$date=date('d-M-Y');
            $data = array('variant_name'=>$variant_name);
		$cities=$this->Main_model->insertdata($table,$data);
		if($cities>0)
		{
		$this->session->set_flashdata('success','variant Added Successfully !.');
		redirect(base_url().'variant-list');	
		}
		else
		{
			$this->session->set_flashdata('error','variant UnSuccessfully.');
		    redirect(base_url().'variant-list');
		}

		}else{
			$data['title'] = 'variant List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add-variant');
		$this->load->view('footer');
		}
	}


	public function edit_variant()
        {
        	$table="variants";
					$id=$this->uri->segment(2);
					$data['students']=$this->Main_model->fetchdata($table,$id);
					$data['title'] = 'variants Edit';
					$this->load->view('head',$data);
					$this->load->view('header');
					$this->load->view('edit-variant',$data);
					$this->load->view('footer');
        }


        public function update_variant()
        {
        	$table="variants";
        	$id=$this->input->post('id');
		$variant_name=$this->input->post('variant_name');
    $data = array('variant_name'=>$variant_name);
      $cities=$this->Main_model->updatedata($table,$data,$id);
		if($cities>0)
		{
		$this->session->set_flashdata('success','variant Updated Successfully !.');
		redirect(base_url().'variant-list');	
		}
		else
		{
			$this->session->set_flashdata('error','variant Update error...');
		    redirect(base_url().'variant-list');
		}
        }


    public function delete_variant()
    {
    $id=$this->uri->segment(2);
		$table="variants";
		$data['delete']=$this->Main_model->deletedata($table,$id);
		$this->session->set_flashdata('success', 'Category Deleted Successfully'); 
	 redirect(base_url().'variant-list');
    }



public function product_list()
  {		
        $data['title']="products";
  		$table="products";
		$data['products']=$this->Main_model->fetchall($table);
		$table="category";
		$data['category']=$this->Main_model->fetchall($table);
		$table="subcategory";
		$data['subcategory']=$this->Main_model->fetchall($table);
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('product-list',$data);
		$this->load->view('footer');  	
  }

  public function add_product()
  {
        $data['title']="products";
  		$table="products";
		$data['products']=$this->Main_model->fetchall($table);
		$table="category";
		$data['category']=$this->Main_model->fetchall($table);
		$table="subcategory";
		$data['subcategory']=$this->Main_model->fetchall($table);
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add-product',$data);
		$this->load->view('footer'); 
  }

  public function insert_product()
  {


  $this->form_validation->set_rules('product_name', 'Products Name', 'required|is_unique[products.product_name]');
	
	if ($this->form_validation->run() == TRUE)
		{

		$table="products";
		$product_name=$this->input->post('product_name');
		$Categary=$this->input->post('Categary');
		$product_price=$this->input->post('product_price');
		$product_offer=$this->input->post('product_offer');
		$dicount=$product_price*$product_offer/100;
		$selling_price=$product_price-$dicount;
		$product_quantity=$this->input->post('product_quantity');
		$product_description=$this->input->post('product_description');
		$product_usage_details=$this->input->post('product_usage_details');

        $subcategory_id = $this->input->post('subcategory');
// 		$uploadfile=$_FILES["product_images"]["tmp_name"];
// 		$folder="./uploads/products/";
// 		move_uploaded_file($_FILES["product_images"]["tmp_name"], "$folder".$_FILES["product_images"]["name"]);
// 		$product_images = '/uploads/products/'.$_FILES["product_images"]["name"];
		
		$data1 = array();
        $list=array('0','1','2','3');
        $i=0;
	foreach($_FILES["product_images"]["name"] as $attr_price)
	{


			$no = rand();
			$uploadfile=$_FILES["product_images"]["tmp_name"][$i];
            $folder="./uploads/products/";
            
            move_uploaded_file($_FILES["product_images"]["tmp_name"][$i], "$folder".$_FILES["product_images"]["name"][$i]);
            $url="/uploads/products/";
			$product_images[] = $url.$_FILES["product_images"]["name"][$i];

}

        $data = array(
        	
        	'category_id'=>$Categary,
        	'subcategory_id'=>$subcategory_id,
        	'product_name'=>$product_name,
        	'product_price'=>$product_price,
        	'product_offer'=>$product_offer,
        	'product_quantity'=>$product_quantity,
        	'product_description'=>$product_description,
        	'selling_price'=>$selling_price,
        	'product_usage_details'=>$product_usage_details,
        	'product_images'=>$product_images[0],
        );
        
		$cities=$this->Main_model->insertdata($table,$data);
		$listid=$this->db->insert_id();
		
		$i=0;
		foreach($_FILES["product_images"]["name"] as $attr_price)
	{

			$no = rand();
			$uploadfile=$_FILES["product_images"]["tmp_name"][$i];
            $folder="./uploads/products/";
            
            move_uploaded_file($_FILES["product_images"]["tmp_name"][$i], "$folder".$_FILES["product_images"]["name"][$i]);
            $url="/uploads/products/";
			$gallery_images = $url.$_FILES["product_images"]["name"][$i];
			
	$data1[$i] = array(
	   'product_id' => $listid,
	   'images' => $gallery_images
	   );
$cities=$this->Main_model->insertdata('productimage',$data1[$i]);
	$i++;

}
		

		if($cities>0)
		{
			$this->session->set_flashdata('success','product Added Successfully !.');
			redirect(base_url().'product-list');	
		}
		else
		{
			$this->session->set_flashdata('error','product UnSuccessfully.');
		    redirect(base_url().'product-list');
		}

	}else
	{
		$this->session->set_flashdata('error','product already exists.');
		redirect(base_url().'add-product');
	}
		
  }

  public function edit_product()
  {		
      $data['title']="products";
  		$table="products";
		$id=$this->uri->segment(2);
		$where =array('product_id'=>$id);
		$data['product']=$this->Main_model->fetchdata_where($table,$where);
		$table="category";
		$data['category']=$this->Main_model->fetchall($table);
		$table="subcategory";
		$data['subcategory']=$this->Main_model->fetchall($table);
		$data['title'] = 'Products Edit';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('edit-product',$data);
		$this->load->view('footer');
  }


 



    public function update_product()
    {
    	$table="products";
     	$id=$this->input->post('pid');
    	$product_name=$this->input->post('product_name');
		$Categary=$this->input->post('Categary');
		$product_price=$this->input->post('product_price');
		$product_offer=$this->input->post('product_offer');
		if($product_offer){
		$dicount=$product_price*$product_offer/100;
		$selling_price=$product_price-$dicount;
		}else{
		   	$selling_price=$product_price; 
		}
		
		$product_quantity=$this->input->post('product_quantity');
		$product_description=$this->input->post('product_description');
		$product_usage_details=$this->input->post('product_usage_details');
        $subcategory_id=$this->input->post('subcategory');
    		    
    			if($_FILES["product_images"]["name"][0]=="")
    			{
    				$this->db->select("*");
    				$this->db->where('product_id',$id);
    		        $query = $this->db->get($table);
    		        $result = $query->row();
    	    	    $product_images=$result->product_images; 		
    			}
    			else
    			{
    				$uploadfile=$_FILES["product_images"]["tmp_name"][0];
    				$folder="./uploads/products/";
    				move_uploaded_file($_FILES["product_images"]["tmp_name"][0], "$folder".$_FILES["product_images"]["name"][0]);
    				$product_images = '/uploads/products/'.$_FILES["product_images"]["name"][0];   
    			}
    			
    		//print_r($product_images);die;
    	$data = array(
    		'category_id'=>$Categary,
        	'product_name'=>$product_name,
        	'product_price'=>$product_price,
        	'product_offer'=>$product_offer,
        	'product_quantity'=>$product_quantity,
        	'product_description'=>$product_description,
        	'product_usage_details'=>$product_usage_details,
        	'selling_price'=>$selling_price,
        	'product_images'=>$product_images,
        	'subcategory_id'=>$subcategory_id,
    	);
    	$where = array('product_id'=>$id);
    	$this->Main_model->updatedata($table,$data,$where);
    	$i=0;
    	$imagid=$this->input->post('imagid');
    // 	print_r($imagid);die;
    	$list=array('0','1','2');
    	foreach($list as $attr_price)
    		{
    			if($_FILES["product_images"]["name"][$i]=="")
    			{
    			    if(!empty($imagid[$i]))
    			{   
    				$this->db->select("*");
    				$this->db->where('imagid',$imagid[$i]);
    				$query = $this->db->get('productimage');
    				$result = $query->row();
    				$attr_image=$result->images;
    			}
    			}
    			else
    			{
    				$uploadfile=$_FILES["product_images"]["tmp_name"][$i];
    				$folder="./uploads/products/";
    				move_uploaded_file($_FILES["product_images"]["tmp_name"][$i], "$folder".$_FILES["product_images"]["name"][$i]);
    				$attr_image = '/uploads/products/'.$_FILES["product_images"]["name"][$i];   
    			}
    			
    			$data1[$i] = array( 
    				'product_id'=> $id,
    				'images'=> $attr_image,
    			);

    			if(!empty($imagid[$i]))
    			{
    			    $where=array('imagid'=>$imagid[$i]);
    				$this->Main_model->updatedata('productimage',$data1[$i],$where);
    			}else
    			{

    			 if($_FILES["product_images"]["name"][$i]==""){
    			     
    			 }else{
    			$this->Main_model->insertdata('productimage',$data1[$i]);
    			 }
    			}
    			
    			$i++;
    		}
    	
    	
		$city=$this->session->set_flashdata('success','Product Updated Successfully !.');
		redirect(base_url().'product-list');	
    	
    }


public function delete_product()
  {
    	$id=$this->uri->segment(2);
		$table="products";
		$where = array('product_id'=>$id);
		$this->Main_model->deletedata($table,$where);
		$city=$this->session->set_flashdata('success', 'Product Deleted Successfully'); 
	 	redirect(base_url().'product-list');
  }

public function work_details()
{
        $id=$this->uri->segment(2);
        $table="employees";
		$data['employee']=$this->Main_model->fetchdata($table,$id);
		$data['leaves']=$this->Main_model->fetchdataattr($id);
		$data['title'] = 'Work Details';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('work-detail',$data);
		$this->load->view('footer');
    
}
public function login_details()
{
    $id=$this->uri->segment(2);
    $table="employees";
		$data['employee']=$this->Main_model->fetchdata($table,$id);
		$data['logins']=$this->Main_model->fetchlogindetails($id);
		$data['title'] = 'Login Details';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('login-detail',$data);
		$this->load->view('footer'); 
}

public function subcategory_list()
{
	$data['sallery'] = $this->Main_model->fetchsubcategory();
  	$data['title'] = 'Sub category';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('subcategory_list',$data);
		$this->load->view('footer'); 
}
public function add_subcategory()
{
		$data['title'] = 'Sub category';
		$table1="category";
		$where=array('deleted_at'=>1);
		$data['category']=$this->Main_model->fetchall($table1,$where);
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add_subcategory',$data);
		$this->load->view('footer'); 
}
public function addsallery()
{
		$this->form_validation->set_rules('subcategoryName', 'subcategoryName', 'required|is_unique[subcategory.subcategoryName]',array('is_unique'=>'This subcategory Name already exists.'));
		if ($this->form_validation->run() == TRUE)
		{
		 	$table1="subcategory";
			$subcategoryName=$this->input->post('subcategoryName');
			$categoryId=$this->input->post('categoryId');
			
			$uploadfile=$_FILES["subcategory_image"]["tmp_name"];
      $folder="./uploads/subcategory/";
      move_uploaded_file($_FILES["subcategory_image"]["tmp_name"], "$folder".$_FILES["subcategory_image"]["name"]);
      $subcategory_image = $_FILES["subcategory_image"]["name"]; 
      $usls="/uploads/subcategory/";
      $pr=$usls.$subcategory_image;

	    	$data = array('subcategoryName'=>$subcategoryName,'categoryId'=>$categoryId,'subcategoryImage'=>$pr);
			$cities=$this->Main_model->insertdata($table1,$data);
			if($cities>0)
			{
				$this->session->set_flashdata('success','subcategory Added Successfully !.');
				redirect(base_url().'subcategory-list');	
			}
			else
			{
				$this->session->set_flashdata('error','Some thing is Wrong');
			    redirect(base_url().'subcategory-list');
			}

		}else{
		$data['title'] = 'Subcategory List';
		$table1="category";
        $where=array('deleted_at'=>1);
		$data['category']=$this->Main_model->fetchall($table1,$where);
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add_subcategory',$data);
		$this->load->view('footer');
		}
}
	public function edit_subcategory()
	{
		$table1="category";
		$where=array('deleted_at'=>1);
		$data['category']=$this->Main_model->fetchall($table1,$where);
		$table="subcategory";
		$id=$this->uri->segment(2);
		$condition=array('subcategory_id'=>$id);
		$data['basissalery']=$this->Main_model->fetchdata_where($table,$condition);
		$data['title'] = 'Subcategory Edit';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('edit_subcategory',$data);
		$this->load->view('footer');  	
	}


        public function updatesubcategory()
        {
        	$table="subcategory";
        	$id=$this->uri->segment(2);
        	$subcategoryName=$this->input->post('subcategoryName');
		$categoryId=$this->input->post('categoryId');
		
		
		
	if($_FILES["subcategory_image"]["name"]=="")
     {
      $this->db->select("*");
      $this->db->where('subcategory_id',$id);
      $query = $this->db->get($table);
      $result = $query->row();
      $pr=$result->subcategoryImage;  
    }
    else{
      $no = rand();
      $uploadfile=$_FILES["subcategory_image"]["tmp_name"];
      $folder="./uploads/subcategory/";
      move_uploaded_file($_FILES["subcategory_image"]["tmp_name"], "$folder".$_FILES["subcategory_image"]["name"]);
      $subcategory_image = $_FILES["subcategory_image"]["name"]; 
      $usls="/uploads/subcategory/";
      $pr=$usls.$subcategory_image;
    }
		
    	$data = array('subcategoryName'=>$subcategoryName,'categoryId'=>$categoryId,'subcategoryImage'=>$pr);
    	$condition=array('subcategory_id'=>$id);
      $cities=$this->Main_model->updatedata($table,$data,$condition);
		if($cities>0)
		{
		$this->session->set_flashdata('success','subcategory Updated Successfully !.');
		redirect(base_url().'subcategory-list');	
		}
		else
		{
			$this->session->set_flashdata('error','Some thing is Wrong');
		    redirect(base_url().'subcategory-list');
		}
        }

     public function delete_subcategory()
    {
    	$id=$this->uri->segment(2);
		$table="subcategory";
		$where=array('subcategory_id'=>$id);
		$data=array('deleted_at'=>0);
        $data['delete']=$this->Main_model->updatedata($table,$data,$where);
		$this->session->set_flashdata('success', 'subcategory Deleted Successfully'); 
	 redirect(base_url().'subcategory-list');
    }
    public function offers_list($value='')
    {
    	$table="offers";
		$data['sallery'] = $this->Main_model->fetchall($table);

  		$data['title'] = 'offers';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('offers_list',$data);
		$this->load->view('footer');
    }
    public function add_offers()
    {
		$data['title'] = 'add_offers';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add_offers',$data);
		$this->load->view('footer');
    }

    public function insert_offers()
    {
    	$this->form_validation->set_rules('offer_title', 'offer_title', 'required|is_unique[offers.offer_title]',array('is_unique'=>'This offer_title already exists.'));
    	$this->form_validation->set_rules('offer_code', 'offer_code', 'required|is_unique[offers.offer_code]',array('is_unique'=>'This offer_code already exists.'));
    	$this->form_validation->set_rules('offer_validity', 'offer_validity', 'required');
    	$this->form_validation->set_rules('description', 'description', 'required');
    		
		if ($this->form_validation->run() == TRUE)
		{
	 	$table1="offers";
		$offer_title=$this->input->post('offer_title');
		$offer_validity=$this->input->post('offer_validity');
		$offer_code=$this->input->post('offer_code');
		$Min_Order_Amount=$this->input->post('Min_Order_Amount');
		$Coupon_Value=$this->input->post('Coupon_Value');
		$description=$this->input->post('description');
    	$data = array('offer_title'=>$offer_title,'offer_validity'=>$offer_validity,'description'=>$description,'offer_code'=>$offer_code,'Min_Order_Amount'=>$Min_Order_Amount,'Coupon_Value'=>$Coupon_Value);
		$cities=$this->Main_model->insertdata($table1,$data);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Offer Added Successfully !.');
		redirect(base_url().'offers-list');	
		}
		else
		{
			$this->session->set_flashdata('error','Offer  UnSuccessfully.');
		    redirect(base_url().'offers-list');
		}

		}else{
		$this->add_offers();
		}
    }
    public function edit_offers()
    {

		$table="offers";
        	$id=$this->uri->segment(2);
        	$condition=array('offer_id'=>$id);
        	$data['basissalery']=$this->Main_model->fetchdata_where($table,$condition);
					  $data['title'] = 'Offers Edit';

					  $this->load->view('head',$data);
					  $this->load->view('header');
					  $this->load->view('edit_offers',$data);
					  $this->load->view('footer');  
    }
    public function updateoffers()
    {
    	$table="offers";
        $id=$this->uri->segment(2);
		$condition=array('offer_id'=>$id);
    	$offer_title=$this->input->post('offer_title');
		$offer_validity=$this->input->post('offer_validity');
		$description=$this->input->post('description');
		$offer_code=$this->input->post('offer_code');
		$Min_Order_Amount=$this->input->post('Min_Order_Amount');
		$Coupon_Value=$this->input->post('Coupon_Value');
    	$data = array('offer_title'=>$offer_title,'offer_validity'=>$offer_validity,'description'=>$description,'offer_code'=>$offer_code,'Min_Order_Amount'=>$Min_Order_Amount,'Coupon_Value'=>$Coupon_Value);
      $cities=$this->Main_model->updatedata($table,$data,$condition);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Offer Updated Successfully !.');
		redirect(base_url().'offers-list');	
		}
		else
		{
			$this->session->set_flashdata('error','Some thing is Wrong');
		    redirect(base_url().'offers-list');
		}
    }

    public function delete_offers($value='')
    {
    	$table="offers";
        $id=$this->uri->segment(2);
		$condition=array('offer_id'=>$id);
		$data['delete']=$this->Main_model->deletedata($table,$condition);
		$this->session->set_flashdata('success', 'Offers Deleted Successfully'); 
	 redirect(base_url().'offers-list');
    }



    public function slips()
    {
    	$id=$this->uri->segment(2);
    	$table="employees";
    	$data['employee']=$this->Main_model->fetchdata($table,$id);
    	$data['slips']=$this->Main_model->fetchdataslip($id);
    	$data['title'] = 'Work Details';
    	$this->load->view('head',$data);
    	$this->load->view('header');
    	$this->load->view('slip-list',$data);
    	$this->load->view('footer');

    }

public function view()
    {
    	$id=$this->uri->segment(2);
    	$data['ids']=$id;
    	$data['slips']=$this->Main_model->fetchdataprint($id);
    	$data['title'] = 'Work Details';
    	$this->load->view('head',$data);
    	$this->load->view('header');
    	$this->load->view('viewslip',$data);
    	$this->load->view('footer');
    	
    }
    public function print()
    {
    	$id=$this->uri->segment(2);
    	$data['slips']=$this->Main_model->fetchdataprint($id);
    	$data['title'] = 'Work Details';
    	$this->load->view('printslip',$data);
    	
    }
    public function invoice()
    {
    	$table="posters";
    	$data['sallery'] = $this->Main_model->fetchposter($table);
    	$data['title'] = 'posters';
    	$this->load->view('head',$data);
    	$this->load->view('header');
    	$this->load->view('invoice-list',$data);
    	$this->load->view('footer');
    }
    public function add_invoice()
    {
    	$table="category";
    	$data['customer'] = $this->Main_model->fetchall($table);
    	$table="languages";
    	$data['languages'] = $this->Main_model->fetchall($table);
    	$data['title'] = 'Poster';
    	$this->load->view('head',$data);
    	$this->load->view('header');
    	$this->load->view('add-invoice',$data);
    	$this->load->view('footer');
    }
    public function company_detail()
    {
    	$id=$this->input->post('id');
    	$condition=array('categoryId'=>$id);
    	$table="companies";
        	$data=$this->Main_model->select_where($table,$condition);
        	foreach($data as $list){
    	echo '<option value="'.$list->company_id.'">'.$list->companyName.'</option>';
    }
    }
    public function addinvoive()
    {
    	$this->form_validation->set_rules('categoryId', 'Category Name', 'required');
    	if ($this->form_validation->run() == TRUE)
    	{
    		
    		$table1="posters";
    		$categoryId=$this->input->post('categoryId');
    		$companyId=$this->input->post('companyId');
    		$languageId=$this->input->post('language_id');

    		$usls="/uploads/users/";
    		$uploadfile=$_FILES["categoryPostedImages"]["tmp_name"];
        	$folder="./uploads/users/";
        	move_uploaded_file($_FILES["categoryPostedImages"]["tmp_name"], "$folder".$_FILES["categoryPostedImages"]["name"]);
        	$categoryPostedImages = $_FILES["categoryPostedImages"]["name"]; 
        	$pr=$usls.$categoryPostedImages;

    		$data = array('categoryPostedImages'=>$pr,'categoryId'=>$categoryId,'companyId'=>$companyId,'languageId'=>$languageId);
    		$cities=$this->Main_model->insertdata($table1,$data);
    		if($cities>0)
    		{
    			$this->session->set_flashdata('success','Poster Added Successfully !.');
    			redirect(base_url().'invoice');	
    		}
    		else
    		{
    			$this->session->set_flashdata('error','Some thing is Wrong');
    			redirect(base_url().'invoice');
    		} }else{

    			$table="category";
		    	$data['customer'] = $this->Main_model->fetchall($table);
		    	$table="languages";
		    	$data['languages'] = $this->Main_model->fetchall($table);
		    	$data['title'] = 'Poster';
    			$this->load->view('head',$data);
    			$this->load->view('header');
    			$this->load->view('add-invoice',$data);
    			$this->load->view('footer');
    		}

    	}

    	public function edit_invoice()
    	{
    		$id=$this->uri->segment(2);

    		$table="category";
    	$data['customer'] = $this->Main_model->fetchall($table);
    	$table="languages";
    	$data['languages'] = $this->Main_model->fetchall($table);
    	$table="companies";
    	$data['companies'] = $this->Main_model->fetchall($table);
    	$data['title'] = 'Poster';

    		$table="posters";
        	$id=$this->uri->segment(2);
        	$condition=array('poster_id'=>$id);
        	$data['invoice']=$this->Main_model->fetchdata_where($table,$condition);
    		$this->load->view('head',$data);
    		$this->load->view('header');
    		$this->load->view('edit-invoice',$data);
    		$this->load->view('footer');
    	}
    	public function delete_poster()
    	{
    		$table="posters";
        $id=$this->uri->segment(2);
		$condition=array('poster_id'=>$id);
		$data['delete']=$this->Main_model->deletedata($table,$condition);
		$this->session->set_flashdata('success', 'Poster Deleted Successfully');
    		redirect(base_url().'invoice');	
    	}


    	public function updateinvoive()
    	{
    		$id=$this->uri->segment(2);
    		$table="posters";
    		$categoryId=$this->input->post('categoryId');
    		$companyId=$this->input->post('companyId');
    		$languageId=$this->input->post('language_id');
    		

    		if($_FILES["categoryPostedImages"]["name"]=="")
      {
        $this->db->select("*");
        $this->db->where('poster_id',$id);
        $query = $this->db->get($table);
        $result = $query->row();
        $categoryPostedImages=$result->categoryPostedImages;  
      }
      else{
      	$usls="/uploads/users/";
        $uploadfile=$_FILES["categoryPostedImages"]["tmp_name"];
        $folder="./uploads/users/";
        move_uploaded_file($_FILES["categoryPostedImages"]["tmp_name"], "$folder".$_FILES["categoryPostedImages"]["name"]);
        $categoryPostedImages = $_FILES["categoryPostedImages"]["name"]; 
        $usls="/uploads/users/";
         $pr=$usls.$categoryPostedImages;
      }
    		$data = array('categoryPostedImages'=>$pr,'categoryId'=>$categoryId,'companyId'=>$companyId,'languageId'=>$languageId);
    		$condition=array('poster_id'=>$id);
    		$cities=$this->Main_model->updatedata($table,$data,$condition);


    		if($cities>0)
    		{
    			$this->session->set_flashdata('success','Poster Added Successfully !.');
    			redirect(base_url().'invoice');	
    		}
    		else
    		{
    			$this->session->set_flashdata('error','Some thing is Wrong');
    			redirect(base_url().'invoice');
    		} 

    	}

    	public function free_poster()
    	{
    	$table="category";
    	$data['customer'] = $this->Main_model->fetchall($table);
    	$table="freeposter";
    	$data['freeposter'] = $this->Main_model->freeposter($table);
    	$data['title'] = 'free poster';
    	$this->load->view('head',$data);
    	$this->load->view('header');
    	$this->load->view('freeposter',$data);
    	$this->load->view('footer');
    	}
    	public function addfreeposter()
    	{
		$table="category";
		$data['customer'] = $this->Main_model->fetchall($table);
		$data['title'] = 'free poster';
    	$this->load->view('head',$data);
    	$this->load->view('header');
    	$this->load->view('addfreeposter',$data);
    	$this->load->view('footer');
    	}
    	public function insertfreeposter()
    	{
    		$table1="freeposter";
    		$categoryId=$this->input->post('categoryId');
    		$usls="/uploads/users/";
    		$uploadfile=$_FILES["posters"]["tmp_name"];
        	$folder="./uploads/users/";
        	move_uploaded_file($_FILES["posters"]["tmp_name"], "$folder".$_FILES["posters"]["name"]);
        	$posters = $_FILES["posters"]["name"]; 
        	$pr=$usls.$posters;

    		$data = array('posters'=>$pr,'categoryId'=>$categoryId);
    		$cities=$this->Main_model->insertdata($table1,$data);
    		if($cities>0)
    		{
    			$this->session->set_flashdata('success','Free Poster Added Successfully !.');
    			redirect(base_url().'free-poster');	
    		}
    		else
    		{
    			$this->session->set_flashdata('error','Some thing is Wrong');
    			redirect(base_url().'free-poster');
    		} 

    	}

    	public function edit_freeposter()
    	{
    		$id=$this->uri->segment(2);
    		$data['title'] = 'freeposter';
    		$table="freeposter";
        	$id=$this->uri->segment(2);
        	$condition=array('id'=>$id);
        	$data['invoice']=$this->Main_model->fetchdata_where($table,$condition);
    		$this->load->view('head',$data);
    		$this->load->view('header');
    		$this->load->view('edit-freeposter',$data);
    		$this->load->view('footer');
    	}
    	public function updatefreeposter($value='')
    	{
    		$id=$this->uri->segment(2);
    		$table="freeposter";
    		$categoryId=$this->input->post('categoryId');
    		

    		if($_FILES["posters"]["name"]=="")
      {
        $this->db->select("*");
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        $result = $query->row();
        $posters=$result->posters;  
      }
      else{
      	$usls="/uploads/users/";
        $uploadfile=$_FILES["posters"]["tmp_name"];
        $folder="./uploads/users/";
        move_uploaded_file($_FILES["posters"]["tmp_name"], "$folder".$_FILES["posters"]["name"]);
        $posters = $_FILES["posters"]["name"]; 
        $usls="/uploads/users/";
         $pr=$usls.$posters;
      }
    		$data = array('posters'=>$pr,'categoryId'=>$categoryId);
    		$condition=array('id'=>$id);
    		$cities=$this->Main_model->updatedata($table,$data,$condition);


    		if($cities>0)
    		{
    			$this->session->set_flashdata('success','Free Poster Update Successfully !.');
    			redirect(base_url().'free-poster');	
    		}
    		else
    		{
    			$this->session->set_flashdata('error','Some thing is Wrong');
    			redirect(base_url().'free-poster');
    		} 

    	}
    	public function delete_freeposter()
    	{
    	$table="freeposter";
        $id=$this->uri->segment(2);
		$condition=array('id'=>$id);
		$data['delete']=$this->Main_model->deletedata($table,$condition);
		$this->session->set_flashdata('success', 'Poster Deleted Successfully');
    	redirect(base_url().'free-poster');	
    	}

    	public function slider_list()
	{
		$table="homeslider";
		$where=array('deleted_at'=>1);
		$data['notes'] = $this->Main_model->fetchall($table,$where);
		$data['title'] = 'Slider List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('slider_list');
		$this->load->view('footer');
	}

	public function add_slider()
	{
		$data['title'] = 'Slider';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('add_slider');
		$this->load->view('footer');
	}

	public function insert_slider()
	{
		
		$table="homeslider";
		$usls="/uploads/users/";
    		$uploadfile=$_FILES["sliderImage"]["tmp_name"];
        	$folder="./uploads/users/";
        	move_uploaded_file($_FILES["sliderImage"]["tmp_name"], "$folder".$_FILES["sliderImage"]["name"]);
        	$sliderImage = $_FILES["sliderImage"]["name"]; 
        	$pr=$usls.$sliderImage;

    		$data = array('sliderImage'=>$pr);
		$cities=$this->Main_model->insertdata($table,$data);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Home Slider Added Successfully !.');
		redirect(base_url().'slider_list');	
		}
		else
		{
			$this->session->set_flashdata('error','Some thing error');
		    redirect(base_url().'slider_list');
		}

	}


	 public function edit_slider()
        {
        	$table="homeslider";
        	$id=$this->uri->segment(2);
        	$condition=array('sliderId'=>$id);
        	$data['students']=$this->Main_model->fetchdata_where($table,$condition);
        	$data['title'] = 'Slider Edit';
        	$this->load->view('head',$data);
        	$this->load->view('header');
        	$this->load->view('edit_slider',$data);
        	$this->load->view('footer');
        }

            public function update_slider()
        {
        	$table="homeslider";
        	$id=$this->uri->segment(2);
			
   			if($_FILES["sliderImage"]["name"]=="")
      {
        $this->db->select("*");
        $this->db->where('sliderId',$id);
        $query = $this->db->get($table);
        $result = $query->row();
        $pr=$result->sliderImage;  
      }
      else{
      	$usls="/uploads/users/";
        $uploadfile=$_FILES["sliderImage"]["tmp_name"];
        $folder="./uploads/users/";
        move_uploaded_file($_FILES["sliderImage"]["tmp_name"], "$folder".$_FILES["sliderImage"]["name"]);
        $sliderImage = $_FILES["sliderImage"]["name"]; 
        $usls="/uploads/users/";
         $pr=$usls.$sliderImage;
      }
    		$data = array('sliderImage'=>$pr);
    		$condition=array('sliderId'=>$id);
    	
      	$cities=$this->Main_model->updatedata($table,$data,$condition);
		if($cities>0)
		{
		$this->session->set_flashdata('success','Slider Updated Successfully !.');
		redirect(base_url().'slider_list');	
		}
		else
		{
			$this->session->set_flashdata('error','Some thing is Wrong');
		    redirect(base_url().'slider_list');
		}
        }

        public function delete_slider()
        {
        	$id=$this->uri->segment(2);
        	$table="homeslider";
        	$where=array('sliderId'=>$id);
        	$data=array('deleted_at'=>0);
        	$data['delete']=$this->Main_model->updatedata($table,$data,$where);
        	$this->session->set_flashdata('success', 'Slider Deleted Successfully'); 
        	redirect(base_url().'slider_list');
        }

        public function prescription_orders()
        {
        	$table="doctor_notes";
        	$status=$this->uri->segment(2);
        	if($status){
  		$where=array('status'=>$status);
  		$data['notes'] =$this->Main_model->fetchdata_where_result($table,$where);
        	}else{
        		$data['notes'] = $this->Main_model->fetchall($table);
        	}
        	$data['title'] = 'prescription orders List';
        	$this->load->view('head',$data);
        	$this->load->view('header');
        	$this->load->view('doctorNote_list',$data);
        	$this->load->view('footer');
        }

         public function orders_list()
        {
        	$table="orders";
        	$status=$this->uri->segment(2);
        	$group='ordernumber';
        	if($status){
  		$where=array('status'=>$status);
  		$data['notes'] =$this->Main_model->fetchdata_where_gruopby($table,$where,$group);
        	}else{
        	    $where='';
        		$data['notes'] = $this->Main_model->fetchdata_where_gruopby($table,$where,$group);
        	}
        	//print_r($data['notes']);die;
        	$data['title'] = 'Orders List';
        	$this->load->view('head',$data);
        	$this->load->view('header');
        	$this->load->view('orders_list');
        	$this->load->view('footer');
        }
        public function orderstatus()
        {
        	$status=$_POST['status'];
        	$orderid=$_POST['orderid'];
        	$data = array('status'=>$status);
              $where=array('ordernumber'=>$orderid);
              $table='orders';
             $res=$this->Main_model->updatedata($table,$data,$where);
             //echo $this->db->last_query();die;

             if($res){
             	echo 1;
             }else{
             	echo 0;
             }
        }

 public function users_list()
  {
  	    $table="registration";
  	 //   $where=array('deleted_at'=>1);
		$data['students'] = $this->Main_model->fetchall($table);
  	    $data['title'] = 'Users List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('users-list',$data);
		$this->load->view('footer');  	
  }
  public function orderdetails()
  {
      $table="orders";
        $ordernumber=$this->uri->segment(2);
        $group='ordernumber';
  		$where=array('ordernumber'=>$ordernumber);
  		$data['userdetails'] =$this->Main_model->fetchdata_where($table,$where);
  		$data['notes'] =$this->Main_model->fetchdata_where_result('orders_item',$where);
  		$data['apply_coupan'] =$this->Main_model->fetchdata_where_result('apply_coupan',$where);
        $data['title']="order details";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('orderdetails',$data);
		$this->load->view('footer');
  }

    public function fetchsubcateggory()
  {
      $table='subcategory';
  		$where=array('categoryId'=>$_POST['Categary']);
  		$data =$this->Main_model->fetchdata_where_result($table,$where);
  		foreach($data as $list){
  		    echo '<option value="'.$list->subcategory_id.'">'.$list->subcategoryName.'</option>';
  		}
  }
  
  function term_conditions()
  {
      $table="term_and_condition";
		$data['notes'] = $this->Main_model->fetchall($table);
		$data['title'] = 'Term and Conditions List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('term_and_condition',$data);
		$this->load->view('footer');
  }
  
  public function insert_term()
	{
		$this->form_validation->set_rules('notes', 'category', 'required');
		if ($this->form_validation->run() == TRUE)
		{
		$table="term_and_condition";
		$notes=$this->input->post('notes');
		$id=$this->input->post('ids');
		$date=date('d-M-Y');
    	$data = array('descriptions'=>$notes);
    	if($id){
    	    $condition=array('id'=>$id);
    	    $cities=$this->Main_model->updatedata($table,$data,$condition);
    	}else{
		$cities=$this->Main_model->insertdata($table,$data);
    	}
		if($cities>0)
		{
		$this->session->set_flashdata('success','Term and Condition  Added Successfully !.');
		redirect(base_url().'term-conditions');	
		}
		else
		{
			$this->session->set_flashdata('error','Some thing error');
		    redirect(base_url().'term-conditions');
		}

		}else{
		$this->term_conditions();
		}
	}
	
	function cancel_policy()
  {
        $table="cancel_policy";
		$data['notes'] = $this->Main_model->fetchall($table);
		$data['title'] = 'Cancel Policy List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('cancel_policy',$data);
		$this->load->view('footer');
  }
  
  public function insert_policy()
	{
		$this->form_validation->set_rules('notes', 'Policy', 'required');
		if ($this->form_validation->run() == TRUE)
		{
		$table="cancel_policy";
		$notes=$this->input->post('notes');
		$id=$this->input->post('ids');
		$date=date('d-M-Y');
    	$data = array('description'=>$notes);
    	if($id){
    	    $condition=array('id'=>$id);
    	    $cities=$this->Main_model->updatedata($table,$data,$condition);
    	}else{
		$cities=$this->Main_model->insertdata($table,$data);
    	}
		if($cities>0)
		{
		$this->session->set_flashdata('success','Cancel Policy  Added Successfully !.');
		redirect(base_url().'cancel-policy');	
		}
		else
		{
			$this->session->set_flashdata('error','Some thing error');
		    redirect(base_url().'cancel-policy');
		}

		}else{
		$this->cancel_policy();
		}
	}

    function productstatus()
    {
        $data = array('status'=>$this->input->post('rowstatus'));
    	$where = array('product_id'=>$this->input->post('product_id'));
    	$res=$this->Main_model->updatedata('products',$data,$where);
    	if($res){
    	    echo json_encode(1);
    	}else{
    	    echo json_encode(0);
    	}

    }
    
    public function delete_doctor()
    {
	$id=$this->uri->segment(2);
	$table="doctor_notes";
	$where=array('notes_id'=>$id);
	$data['delete']=$this->Main_model->deletedata($table,$where);
		$this->session->set_flashdata('success', 'Prescription Orders Deleted Successfully'); 
	 redirect(base_url().'prescription_orders');
    }
    
    public function priscriptionstatus()
        {
        	$status=$_POST['status'];
        	$notes_id=$_POST['notes_id'];
        	$data = array('status'=>$status);
              $where=array('notes_id'=>$notes_id);
              $table='doctor_notes';
             $res=$this->Main_model->updatedata($table,$data,$where);

             if($res){
             	echo 1;
             }else{
             	echo 0;
             }
        }


function reports()
  {
    if($_GET){
       $start_date= $_GET['form_date'];
        $end_date=$_GET['to_date'];
        $where='created_at BETWEEN "'. date('d-m-Y', strtotime($start_date)). '" and "'. date('d-m-Y', strtotime($end_date)).'"';
    }else{
        $where='';
    }
        $table="orders";
		$data['orders'] = $this->Main_model->fetchall($table,$where);
		
	//echo $this->db->last_query();die;
		
		$table="registration";
		$data['cust'] = $this->Main_model->fetchall($table);
		$table="products";
		$data['products'] = $this->Main_model->fetchall($table);
		$data['title'] = 'Sell Reports';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('reports',$data);
	    //$this->load->view('footer');
  }
  
  function productreports()
  {
    if($_GET){
       $start_date= $_GET['form_date'];
        $end_date=$_GET['to_date'];
        $where='created_at BETWEEN "'. date('d-m-Y', strtotime($start_date)). '" and "'. date('d-m-Y', strtotime($end_date)).'"';
    }else{
        $where='';
    }
        $table="orders";
		$data['orders'] = $this->Main_model->fetchall($table,$where);
		
	//echo $this->db->last_query();die;
		
		$table="registration";
		$data['cust'] = $this->Main_model->fetchall($table);
		$table="products";
		$data['products'] = $this->Main_model->fetchall($table);
		$data['title'] = 'Products Reports';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('productreports',$data);
	    //$this->load->view('footer');
  }
  
  
   function customerreports()
  {
    if($_GET){
       $start_date= $_GET['form_date'];
        $end_date=$_GET['to_date'];
        $where='created_at BETWEEN "'. date('d-m-Y', strtotime($start_date)). '" and "'. date('d-m-Y', strtotime($end_date)).'"';
    }else{
        $where='';
    }
        $table="orders";
		$data['orders'] = $this->Main_model->fetchall($table,$where);
		
	//echo $this->db->last_query();die;
		
		$table="registration";
		$data['cust'] = $this->Main_model->fetchall($table);
		$table="products";
		$data['products'] = $this->Main_model->fetchall($table);
		$data['title'] = 'Customer Reports';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('customerreports',$data);
	    //$this->load->view('footer');
  }
  
  function imagegalery_remove()
  {
    $imagid=$_POST['ids']; 
    $table="productimage";
    $id=array('imagid'=>$imagid);
	$delete=$this->Main_model->deletedata($table,$id);
	if($delete){
	    echo 1;
	}else{
	    echo 0;
	}

  }
  
  public function feedback()
	{
		$table="feedbacks";
		$data['notes'] = $this->Main_model->fetchall($table);
		$data['title'] = 'Feedbacks List';
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('feedbacks_list');
		$this->load->view('footer');
	}
	
	
	public function delete_feedback()
    {
	$id=$this->uri->segment(2);
	$table="feedbacks";
	$where=array('feedbackId'=>$id);
	$data['delete']=$this->Main_model->deletedata($table,$where);
		$this->session->set_flashdata('success', 'Feedback Deleted Successfully'); 
	 redirect(base_url().'feedback');
    }



}