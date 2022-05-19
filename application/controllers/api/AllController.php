<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;
class AllController extends RestController {
    /* ==========================================================================================================================
     * Function Name : 
     * __construct()
     * 
     * Function Description : 
     * > This function creates a constructor for webservices controller.
     * > Loads necessary helpers, libraries and models which will be available throughout the controller.
     * 
     * @params : 
     * none
     * ==========================================================================================================================
     */

    function __construct() {
      parent::__construct();
      $this->load->model( "Main_model", "Main_model" );
      $this->load->library('upload');
      $this->load->helper(array('form', 'url','notification'));
      $this->load->library('form_validation');
      date_default_timezone_set('Asia/Kolkata');
      error_reporting(0);

    } 

      public function login_post() 
      {
        $email = $this->input->post('email');
         $employee= $this->Main_model->login_employee($email);
         $employeem= $this->Main_model->loginm_employee($email);
         
         //print_r($employee);die;
         if($employee>0){
             
            $session_data = array(
            'userid' => $employee->user_id,
            'name' => $employee->username,
            'mobile_no'=>$employee->mobile_no,
        );
         }else{
             
             
            $session_data = array(
            'userid' => $employeem->user_id,
            'name' => $employeem->username,
            'mobile_no'=>$employeem->mobile_no,
        );
             
         }


        function generateNumericOTP($n) {
    $generator = "1357902468";
    $result = "";
    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
    return $result;
}
         $n = 4;
         $otp=generateNumericOTP($n);
         
         $this->session->set_userdata($session_data);
            if($employee) {
              //print_r($employee->email_id);die();
              $data = array('otp'=>$otp);
              //print_r($data);die();
              $where=array('user_id'=>$employee->user_id,'email_id'=>$employee->email_id);
              $table='registration';
             $res=$this->Main_model->updatedata($table,$data,$where);
             //echo $res;die();


        $subject = 'OTP';
        $body  = "<br/> Hello ".$employee->email_id.",<br/>";
        $body .= "<p>
        As per your request.<br />
        Your Otp is : " . $otp . "
        </p>";
        $body .= "<p>Thanks & Regards, <br/><b>Admin</b></p>";

        
        
            ///$subject = 'BizneX Login Credentials';
            $to =$employee->email_id;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: innovertechnology@gmail.com'. "\r\n";
//  $headers .= 'Cc: '.$rs[0]['pemail']. "\r\n";
//  $headers .= 'Cc:suresh.tripathi1981@gmail.com'. "\r\n";
    $headers .= 'Cc:innovertechnology@gmail.com'. "\r\n";
    $headers .= 'Bcc:innovertechnology@gmail.com'. "\r\n";
    mail($to, $subject, $body, $headers);
      sendMessage($employee->mobile_no,$otp,$employee->username);
              $this->Response['Message'] = 'OTP Send Successfully.';
              $this->Response['Success'] = true;
             // $this->Response['IsLoggedIn'] = true;
              $this->Response['UserDetails'] = $employee;
              $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (200) being 
              $this->set_response($this->Response, RestController::HTTP_OK); // CREATED (201) being the HTTP response code
              } elseif($employeem){
                $data = array('otp'=>$otp);
              $where=array('user_id'=>$employeem->user_id,'email_id'=>$employeem->email_id);
              $table='registration';
              $this->Main_model->updatedata($table,$data,$where);

              $subject = 'OTP';
        $body  = "<br/> Hello ".$employeem->username.",<br/>";
        $body .= "<p>
        As per your request.<br />
        Your Otp is : " . $otp . "
        </p>";
        $body .= "<p>Thanks & Regards, <br/><b>Admin</b></p>";
        
        $to=$employeem->email_id;
        $subject='OTP Varyfication';
            $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: innovertechnology@gmail.com'. "\r\n";
//  $headers .= 'Cc: '.$rs[0]['pemail']. "\r\n";
//  $headers .= 'Cc:suresh.tripathi1981@gmail.com'. "\r\n";
    $headers .= 'Cc:innovertechnology@gmail.com'. "\r\n";
    $headers .= 'Bcc:innovertechnology@gmail.com'. "\r\n";
    mail($to, $subject, $body, $headers);
    
    sendMessage($employeem->mobile_no,$otp,$employeem->username);
                  
                  $this->Response['Message'] = 'OTP Send Successfully.';
              $this->Response['Success'] = true;
             // $this->Response['IsLoggedIn'] = true;
            //   $this->Response['UserDetails'] = $employeem;
              $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (200) being 
              $this->set_response($this->Response, RestController::HTTP_OK); // CREATED (201) being the HTTP response code
              
              }else{
                // Set the response and exit
                $this->Response['Message'] = 'Invalid credentials.';
                $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
            } 
      } 

      public function registration_post()
      {
       $this->form_validation->set_rules('username', 'Name', 'required');
       $this->form_validation->set_rules('email_id', 'email', 'required|valid_email|is_unique[registration.email_id]',array('is_unique'=>'This email_id already exists.'));
       $this->form_validation->set_rules('mobile_no', 'Mobile number', 'required|min_length[10]|max_length[10]|is_unique[registration.  mobile_no]',array('is_unique'=>'This Mobile number already exists.'));
    if ($this->form_validation->run() == TRUE)
    {
    $table="registration";
    $username=$this->input->post('username');
    $email_id=$this->input->post('email_id');
    $mobile_no=$this->input->post('mobile_no');

    $token=$this->input->post('token');
    $date=date('d-m-Y H:i:s');

    
    $data = array('username'=>$username,'email_id'=>$email_id,' mobile_no'=>$mobile_no,'created_at'=>$date,'token'=>$token);
    $cities=$this->Main_model->insertdata($table,$data);
     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'isRegistered'=>true,
                'message' => 'Registration Successfull..'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'isRegistered'=>false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

public function Verify_otp_post() 
{

  $otp = $this->input->post('otp');
  $table="registration";
  $where=array('otp'=>$otp);
  $employeem=$this->Main_model->fetchdata_where($table,$where);
  if($employeem) {
  // Set the response and exit
    $this->Response['Message'] = 'You have logged in successfully.';
    $this->Response['Success'] = true;
   // $this->Response['IsLoggedIn'] = true;
    $this->Response['UserDetails'] = $employeem;
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (200) being 
    $this->set_response($this->Response, RestController::HTTP_OK); 
 }else{ // if( sizeof( $UserDetails ) < 1 )
  $this->Response['Message'] = "Entered OTP is incorrect. Please enter correct OTP";
  $this->Response['Success'] = false;
  $this->response($this->Response, RestController::HTTP_OK);
 }
} 


public function doctornotes_post()
  {
  

  $table1='doctor_notes';
  $i=0;
  $user_id=$this->input->post('user_id');
  $address_id=$this->input->post('address_id');

  $data1 = array();
  $date=date('d-m-Y H:i:s');
    $delivery_date1=date('M-d-Y', strtotime($date. ' + 7 days'));
    
    $delivery_date=date("D",strtotime($delivery_date1)).','. $delivery_date1;
  foreach($_FILES["prescription_path"]["name"] as $attr_price)
  {
      $uploadfile=$_FILES["prescription_path"]["tmp_name"][$i];
            $folder="./uploads/users/";
      move_uploaded_file($_FILES["prescription_path"]["tmp_name"][$i], "$folder".$_FILES["prescription_path"]["name"][$i]);
      $attr_image = $_FILES["prescription_path"]["name"][$i];
      $usls="/uploads/users/";
         $pr=$usls.$attr_image;
  $data1[$i] = array(
     'prescription_path' =>$pr,
     'user_id'=>$user_id,
     'address_id'=>$address_id,
     'order_date'=>$date,
     'delivery_date'=>$delivery_date,
     'created_at'=>$date,
     );
$cities=$this->Main_model->insertdata($table1,$data1[$i]);
//echo $this->db->last_query();die;
  $i++;
}
if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Submitted Successfull..'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
}

    public function logout_post() 
    {
      $userid = $this->session->userdata('userid');
      $this->session->unset_userdata('userid');
      $this->Response['Message'] = 'Logout successfully';
      $this->Response['Success'] = true;
      $this->Response['UserId'] = 0;
      $this->Response['UserDetails'] = (object)array();
      $this->Response['IsLoggedIn'] = false;
      $this->response($this->Response, RestController::HTTP_OK);

    }
    public function updateprofile_post()
    {
     
     $user_id=$this->input->post('user_id');
     $table="registration";
     $username=$this->input->post('username');
     $date_of_birth=$this->input->post('date_of_birth');
     $email_id=$this->input->post('email_id');
     $mobile_no=$this->input->post('mobile_no');
     $primary_physician=$this->input->post('primary_physician');
     if($_FILES["profile_image"]["name"]=="")
     {
      $this->db->select("*");
      $this->db->where('user_id',$user_id);
      $query = $this->db->get($table);
      $result = $query->row();
      $pr=$result->profile_image;  
    }
    else{
      $no = rand();
      $uploadfile=$_FILES["profile_image"]["tmp_name"];
      $folder="./uploads/users/";
      move_uploaded_file($_FILES["profile_image"]["tmp_name"], "$folder".$_FILES["profile_image"]["name"]);
      $profile_image = $_FILES["profile_image"]["name"]; 
      $usls="/uploads/users/";
      $pr=$usls.$profile_image;
    }

    
    $data = array('username'=>$username,'date_of_birth'=>$date_of_birth,'email_id'=>$email_id,'mobile_no'=>$mobile_no,'primary_physician'=>$primary_physician,'profile_image'=> $pr);
    $condition=array('user_id'=>$user_id);
    $cities=$this->Main_model->updatedata($table,$data,$condition);

    
    
    if($cities > 0)
    {
      $this->response([
        'status' => true,
        'message' => 'Submitted Successfull..'
      ], RestController::HTTP_OK); 
    }
    else
    {
      $this->response([
        'status' => false,
        'message' => 'Failed Submited..'
      ], RestController::HTTP_OK);
    }
    
  }

  
public function offer_get()
{
      $table="offers";
      $result=$this->Main_model->fetchall($table);
      if($result) 
      {
        $this->Response['Message'] = 'Offers';
        $this->Response['Success'] = true;
        $this->Response['offers'] = $result;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}

public function shop_by_category_post()
{
       $table="category";
       $id=$this->input->post('categoryId');
       $condition=array('categoryId'=>$id);
       if($id){
      $result=$this->Main_model->select_where('subcategory',$condition);
       }else{
      $result=$this->Main_model->fetchall($table);
       }
      if($result) 
      {
        $this->Response['Message'] = 'Category';
        $this->Response['Success'] = true;
        $this->Response['Category'] = $result;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
        $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}


public function homeslider_get()
{
      $table="homeslider";
      $slider=$this->Main_model->fetchall($table);
      
    $this->db->select('*');
    $this->db->from('products');
    $this->db->where('status','1');
    $query = $this->db->get();
    $result=$query->result_array();
      
      $row['product']=[];
    foreach($result as $order){
        $this->db->select('*');
    $this->db->from('productimage');
    $this->db->where('product_id',$order['product_id']);
    $query = $this->db->get();
    //echo $this->db->last_query();die;
     $result1=$query->result_array();
    //print_r($result1);die;
     $order['product1_image']=$result1;
     $row['product'][]=$order;
    }
      if($slider) 
      {
        $this->Response['Message'] = 'Slider';
        $this->Response['Success'] = true;
        $this->Response['Slider'] = $slider;
        $this->Response['popular_products'] = $row;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
        $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}

public function allcategory_get()
{
    $table="category";
    $cities=$this->Main_model->fetchall($table);
     if($cities)
        {
           $this->Response['Message'] = 'Category';
        $this->Response['Success'] = true;
        $this->Response['Category'] = $cities;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
        }
        else
        {
        $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
        $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST
        }
}

public function Prescription_history_post()
{
    //   $condition=array('user_id'=>$_POST['user_id']);
    //   $result=$this->Main_model->select_where('doctor_notes',$condition);
      
      $this->db->select('a.*,c.*');
    $this->db->from('doctor_notes a');
    $this->db->where('a.user_id',$_POST['user_id']);
    $this->db->join('address c', 'c.address_id = a.address_id', 'left');
    $query = $this->db->get();
    $result=$query->result_array();
      if($result) 
      {
        $this->Response['Message'] = 'Prescription_history';
        $this->Response['Success'] = true;
        $this->Response['Prescription_history'] = $result;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
    $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}


public function Product_list_post()
{
    //   $condition=array('category_id'=>$_POST['category_id']);
    //   $result=$this->Main_model->select_where('products',$condition);
      //print_r($result);die;
      
       $this->db->select('*');
    $this->db->from('products');
    $this->db->where('category_id',$_POST['category_id']);
    $this->db->where('status','1');
    $query = $this->db->get();
    $result=$query->result_array();
      
      $row['product']=[];
    foreach($result as $order){
        $this->db->select('*');
    $this->db->from('productimage');
    $this->db->where('product_id',$order['product_id']);
    $query = $this->db->get();
    //echo $this->db->last_query();die;
     $result1=$query->result_array();
    //print_r($result1);die;
     $order['product1_image']=$result1;
     $row['product'][]=$order;
    }
      if($row) 
      {
        $this->Response['Message'] = 'Product_list';
        $this->Response['Success'] = true;
        $this->Response['Product_list'] = $row;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
    $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}


  public function add_to_cart_post()
      {
       $this->form_validation->set_rules('userId', 'User id', 'required');
       $this->form_validation->set_rules('product_id', 'Product details', 'required');
    if ($this->form_validation->run() == TRUE)
    {
    $table="add_to_cart";
    $userId=$this->input->post('userId');
    $product_id=$this->input->post('product_id');
    $qnt=$this->input->post('qnt');
    $check_product=$this->db->select('*')->from('add_to_cart')->where('userId',$userId)->where('product_id',$product_id)->get()->row();
    if($check_product){
        $newqnt=$check_product->qnt+1;
        $data = array('qnt'=>$newqnt);
              
    $where=array('userId'=>$userId,'product_id'=>$product_id);
    $cities=$this->Main_model->updatedata($table,$data,$where);
        
    }else{
    $date=date('d-m-Y H:i:s');
    $data = array('userId'=>$userId,'product_id'=>$product_id,' qnt'=>$qnt,'created_at'=>$date);
    $cities=$this->Main_model->insertdata($table,$data);
    }
     if($cities > 0)
        {

            $this->response([
                'status' => true,
                'message' => 'Product added to cart successfully'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

public function cart_Product_post()
{
      
    $this->db->select('a.*,a.userId,b.product_name,b.product_price,b.selling_price,b.product_offer,b.product_images,b.product_description,b.product_usage_details');
    $this->db->from('add_to_cart a');
    $this->db->join('products b', 'b.product_id = a.product_id', 'left'); 
    $this->db->where('a.userId',$_POST['userId']);
    $this->db->where('a.status',1);
    $query = $this->db->get();
    $result=$query->result();
    
    foreach($result as $list){
        if($list->product_offer<0){
        $total+=floatval($list->qnt)*floatval($list->product_price);
        }else{
           $total+=floatval($list->qnt)*floatval($list->selling_price); 
        }
        
    }
    
      if($result) 
      {
        $this->Response['Message'] = 'Cart_Product_list';
        $this->Response['Success'] = true;
        $this->Response['Cart_Product_list'] = $result;
        $this->Response['total_amt_pay'] = number_format((float)$total,2,'.', '');
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
    $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}

  public function add_quantity_post()
      {
       $this->form_validation->set_rules('userId', 'User id', 'required');
       $this->form_validation->set_rules('product_id', 'Product details', 'required');
       $this->form_validation->set_rules('quantity', 'quantity', 'required');
       
    if ($this->form_validation->run() == TRUE)
    {
    $table="add_to_cart";
    $userId=$this->input->post('userId');
    $product_id=$this->input->post('product_id');
    $qnt=$this->input->post('quantity');
    $date=date('d-m-Y H:i:s');
     $data = array('qnt'=>$qnt);
              
    $where=array('userId'=>$userId,'product_id'=>$product_id);
    $cities=$this->Main_model->updatedata($table,$data,$where);
     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Quantity added successfully'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

    public function remove_quantity_post()
      {
       $this->form_validation->set_rules('userId', 'User id', 'required');
       $this->form_validation->set_rules('product_id', 'Product details', 'required');
       $this->form_validation->set_rules('quantity', 'quantity', 'required');
       
    if ($this->form_validation->run() == TRUE)
    {
    $table="add_to_cart";
    $userId=$this->input->post('userId');
    $product_id=$this->input->post('product_id');
    $qnt=$this->input->post('quantity');
    $date=date('d-m-Y H:i:s');
     $data = array('qnt'=>$qnt);
              
    $where=array('userId'=>$userId,'product_id'=>$product_id);
    $cities=$this->Main_model->updatedata($table,$data,$where);
     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Quantity removed successfully'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

 public function save_for_later_post()
      {
       $this->form_validation->set_rules('userId', 'User id', 'required');
       $this->form_validation->set_rules('product_id', 'Product details', 'required');
       
       
    if ($this->form_validation->run() == TRUE)
    {
    $table="add_to_cart";
    $userId=$this->input->post('userId');
    $product_id=$this->input->post('product_id');
    $date=date('d-m-Y H:i:s');
     $data = array('status'=>2);
              
    $where=array('userId'=>$userId,'product_id'=>$product_id);
    $cities=$this->Main_model->updatedata($table,$data,$where);
     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Product moved to saved for later successfully'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

public function save_for_later_delete_post()
      {
       $this->form_validation->set_rules('userId', 'User id', 'required');
       $this->form_validation->set_rules('product_id', 'Product details', 'required');
       
       
    if ($this->form_validation->run() == TRUE)
    {
    $table="add_to_cart";
    $userId=$this->input->post('userId');
    $product_id=$this->input->post('product_id');
    $date=date('d-m-Y H:i:s');
              
    $where=array('userId'=>$userId,'product_id'=>$product_id);
    
    $cities=$this->Main_model->deletedata($table,$where);
     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Product remove from saved successfully'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}


public function Product_search_post()
{
      $keyword=$_POST['product_name'];
      //$result=$this->db->select('*')->from('products')->where("product_name LIKE '%$keyword%'")->get()->result();
      
              $this->db->select('*');
    $this->db->from('products');
    $this->db->where("product_name LIKE '%$keyword%'");
    $this->db->where('status','1');
    $query = $this->db->get();
    $result=$query->result_array();
      
      $row['product']=[];
    foreach($result as $order){
        $this->db->select('*');
    $this->db->from('productimage');
    $this->db->where('product_id',$order['product_id']);
    $query = $this->db->get();
    //echo $this->db->last_query();die;
     $result1=$query->result_array();
    //print_r($result1);die;
     $order['product1_image']=$result1;
     $row['product'][]=$order;
    }
      if($row) 
      {
        $this->Response['Message'] = 'Product_list';
        $this->Response['Success'] = true;
        $this->Response['Product_list'] = $row;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
    $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}

 public function add_address_post()
      {
       $this->form_validation->set_rules('userId', 'User id', 'required');
       $this->form_validation->set_rules('pincode', 'Pincode', 'required');
       $this->form_validation->set_rules('state', 'state', 'required');
       $this->form_validation->set_rules('city', 'city', 'required');
       
    if ($this->form_validation->run() == TRUE)
    {
    $table1="address";
      
      $data1 = array(
       'pincode' =>$this->input->post('pincode'),
       'city' =>$this->input->post('city'),
       'state' =>$this->input->post('state'),
       'user_id'=>$this->input->post('userId'),
       'name'=>$this->input->post('name'),
       'houseno'=>$this->input->post('houseno'),
       'buildingname'=>$this->input->post('buildingname'),
       'streetname'=>$this->input->post('streetname'),
       'area'=>$this->input->post('area'),
       'is_defualt'=>$this->input->post('default_address'),
     );
      $cities=$this->Main_model->insertdata($table1,$data1);
    

     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Address added successfully...'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

public function getaddress_post() 
{

  $otp = $this->input->post('userId');
  $table="address";
  $where=array('user_id'=>$otp);
  $employeem=$this->Main_model->fetchdata_where_result($table,$where);
  if($employeem) {
  // Set the response and exit
    $this->Response['Message'] = 'Address List.';
    $this->Response['Success'] = true;
    $this->Response['Address_list'] = $employeem;
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (200) being 
    $this->set_response($this->Response, RestController::HTTP_OK); 
 }else{ // if( sizeof( $UserDetails ) < 1 )
  $this->Response['Message'] = "Not data found";
  $this->Response['Success'] = false;
  $this->response($this->Response, RestController::HTTP_OK);
 }
}


 public function move_to_cart_post()
      {
       $this->form_validation->set_rules('userId', 'User id', 'required');
       $this->form_validation->set_rules('product_id', 'Product details', 'required');
       
       
    if ($this->form_validation->run() == TRUE)
    {
    $table="add_to_cart";
    $userId=$this->input->post('userId');
    $product_id=$this->input->post('product_id');
    $date=date('d-m-Y H:i:s');
     $data = array('status'=>1);
              
    $where=array('userId'=>$userId,'product_id'=>$product_id);
    $cities=$this->Main_model->updatedata($table,$data,$where);
     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Product moved to cart successfully'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

public function remove_to_cart_post()
      {
       $this->form_validation->set_rules('userId', 'User id', 'required');
       $this->form_validation->set_rules('product_id', 'Product details', 'required');
       
       
    if ($this->form_validation->run() == TRUE)
    {
    $table="add_to_cart";
    $userId=$this->input->post('userId');
    $product_id=$this->input->post('product_id');
    $date=date('d-m-Y H:i:s');
              
    $where=array('userId'=>$userId,'product_id'=>$product_id);
    
    $cities=$this->Main_model->deletedata($table,$where);
     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Product remove from cart successfully'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}


public function save_for_later_Product_post()
{
      
      $this->db->select('a.*,a.userId,b.product_name,b.product_price,b.product_images,b.product_description,b.product_usage_details,b.selling_price');
    $this->db->from('add_to_cart a');
    $this->db->join('products b', 'b.product_id = a.product_id', 'left'); 
    $this->db->where('a.userId',$_POST['userId']);
     $this->db->where('a.status',2);
    $query = $this->db->get();
    $result=$query->result();
    foreach($result as $list){
        
        if($list->product_offer<0){
        $total+=floatval($list->qnt)*floatval($list->product_price);
        }else{
           $total+=floatval($list->qnt)*floatval($list->selling_price); 
        }
        
    }
    
      if($result) 
      {
        $this->Response['Message'] = 'Save_Product_list';
        $this->Response['Success'] = true;
        $this->Response['Save_Product_list'] = $result;
        $this->Response['total_amt_pay'] = number_format($total,2);
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
    $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}


public function category_Subcategory_Product_post()
{
    //   $condition=array('category_id'=>$_POST['category_id'],'subcategory_id'=>$_POST['subcategory_id']);
    //   $result=$this->Main_model->select_where('products',$condition);
          $this->db->select('*');
    $this->db->from('products');
    $this->db->where('category_id',$_POST['category_id']);
    $this->db->where('subcategory_id',$_POST['subcategory_id']);
    $this->db->where('status','1');
    $query = $this->db->get();
    $result=$query->result_array();
      
      $row['product']=[];
    foreach($result as $order){
        $this->db->select('*');
    $this->db->from('productimage');
    $this->db->where('product_id',$order['product_id']);
    $query = $this->db->get();
    //echo $this->db->last_query();die;
     $result1=$query->result_array();
    //print_r($result1);die;
     $order['product1_image']=$result1;
     $row['product'][]=$order;
    }
      if($row) 
      {
        $this->Response['Message'] = 'Product_list';
        $this->Response['Success'] = true;
        $this->Response['Product_list'] = $row;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
    $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}


 public function checkout_post()
      {
       $this->form_validation->set_rules('userId', 'User id', 'required');
       $this->form_validation->set_rules('product_id[]', 'Product details', 'required');
    if ($this->form_validation->run() == TRUE)
    {
    $table="orders_item";
    $ordeid=rand(1000,9999);
    $userId=$this->input->post('userId');
    $product_id=$this->input->post('product_id');
    $qnt=$this->input->post('qnt');
    $amount=$this->input->post('amount');
    $address_id=$this->input->post('address_id');
    
    $payment=$this->input->post('payment_type');
    $transaction_id=$this->input->post('transaction_id');
    $grant_total=$this->input->post('grant_total');

    $offer_id=$this->input->post('offer_id');
    $date=date('d-m-Y H:i:s');
    $delivery_date1=date('M-d-Y', strtotime($date. ' + 7 days'));
    
    $delivery_date=date("D",strtotime($delivery_date1)).','. $delivery_date1;
    $totalamount=0;
    $totalqnt=0;
    foreach($this->input->post('product_id') as $key => $list){
        $totalamount+=number_format($amount[$key],2);
        $totalqnt+=$qnt[$key];
    }
    if($payment=="COD"){
        
        $method="CASH ON DELIVERY";
        $transaction_method='';
    }
    if($payment=="Online" || $payment=="online")
    {
        $method="Online";
        $transaction_method=$transaction_id;
    }
     foreach($this->input->post('offer_id') as $key => $list){
    $disct=$this->db->select('*')->from('offers')->where('offer_id',$list)->get()->row();
    $totaldisc+=$disct->Coupon_Value;
    }
    $data1=array('userId'=>$userId,'ordernumber'=>$ordeid,'payment_type'=>$payment,'created_at'=>$date,'delivery_date'=>$delivery_date,'address_id'=>$address_id,'order_date'=>$date,'totalqnt'=>$totalqnt,'totalamount'=>$totalamount,'grand_total'=>$grant_total,'transaction_id'=>$transaction_id,'discount_total'=>$totaldisc);
    $cities1=$this->Main_model->insertdata('orders',$data1);
    
    foreach($this->input->post('product_id') as $key => $list){
        $data = array('userId'=>$userId,'ordernumber'=>$ordeid,'product_id'=>$product_id[$key],'qnt'=>$qnt[$key],'amount'=>$amount[$key]);
    $cities=$this->Main_model->insertdata($table,$data);
    
     $table1="add_to_cart";           
    $where=array('userId'=>$userId,'product_id'=>$product_id[$key],'qnt'=>$qnt[$key]);
    $cities=$this->Main_model->deletedata($table1,$where);
        
    }
    
    foreach($this->input->post('offer_id') as $key => $list){
        $datas = array('offer_id'=>$list,'ordernumber'=>$ordeid);
    $cities=$this->Main_model->insertdata('apply_coupan',$datas);
    }
   
    $price=$this->db->select('totalamount')->from('orders')->where('ordernumber',$ordeid)->get()->row(); 
    $users=$this->db->select('*')->from('registration')->where('user_id',$userId)->get()->row(); 
    $mobile=$users->mobile_no;
    $email=$users->email_id;
    $totalamount=$price->totalamount;
    
    
    
    
    sendorderplace($mobile,$ordeid,$totalamount);
    
     if($cities > 0)
        {

            $this->response([
                'status' => true,
                'message' => 'Order  Placed successfully....',
                'delivery_date'=>date("D",strtotime($delivery_date1)).','. $delivery_date1,
                'payment_method'=>$method,
                'ordernumber'=>$ordeid,
                'transaction_id'=>$transaction_method,
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

 public function ordercencle_post()
      {
       $this->form_validation->set_rules('userId', 'User id', 'required');
    //   $this->form_validation->set_rules('product_id', 'Product details', 'required');
       $this->form_validation->set_rules('reason', 'reason', 'required');
       
    if ($this->form_validation->run() == TRUE)
    {
    $table="orders";
    $userId=$this->input->post('userId');
    // $product_id=$this->input->post('product_id');
    $orderid=$this->input->post('orderid');
    $reason=$this->input->post('reason');
    $status='Cancel';
    $date=date('d-m-Y H:i:s');

    $where=array('orderid'=>$orderid,'userId'=>$userId);
    $data = array('status'=>$status,'reason'=>$reason,'created_at'=>$date);
    $cities=$this->Main_model->updatedata($table,$data,$where);;
     if($cities > 0)
        {

            $this->response([
                'status' => true,
                'message' => 'Order canceled Successfull'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

public function orderlist_post()
      {
    
   $this->db->select('a.*,c.*');
    $this->db->from('orders a');
    $this->db->where('a.userId',$_POST['userId']);
    $this->db->join('address c', 'c.address_id = a.address_id', 'left');
    // $this->db->join('offers f', 'f.offer_id = a.offer_id', 'left');
    // $this->db->group_by('a.ordernumber');
     $this->db->order_by('a.orderid','desc');
    $query = $this->db->get();
    $orders=$query->result_array();
   $row['orders']=[];
    foreach($orders as $order){
        $this->db->select('a.*,b.product_name,b.product_price,b.product_images,b.product_description,b.product_usage_details,b.product_offer,b.selling_price');
    $this->db->from('orders_item a');
    $this->db->join('products b', 'b.product_id = a.product_id', 'left');
    $this->db->where('a.userId',$_POST['userId']);
    $this->db->where('a.ordernumber',$order['ordernumber']);
    $query = $this->db->get();
     $result1=$query->result_array();
     
    $this->db->select('ap.*,o.*');
    $this->db->from('apply_coupan ap');
    $this->db->join('offers o', 'o.offer_id = ap.offer_id', 'left');
    $this->db->where('ap.ordernumber',$order['ordernumber']);
    $query2 = $this->db->get();
     $result2=$query2->result_array();
    $order['offer_item']=$result2;
     $order['items']=$result1;
     $row['orders'][]=$order;
    }
      if($row) 
      {
        $this->Response['Message'] = 'Order List';
        $this->Response['Success'] = true;
        $this->Response['OrderList'] = $row;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}


public function sort_by_price_post() 
{

  $range = $this->input->post('range');
  $category_id = $this->input->post('category_id');
  $subcategory_id = $this->input->post('subcategory_id');
  $this->db->select('*');
    $this->db->from('products');
    $this->db->where('status','1');
  if($subcategory_id!=0){
   $this->db->where('category_id',$category_id);
   $this->db->where('subcategory_id',$subcategory_id);
  }elseif($category_id){
    $this->db->where('category_id',$category_id);  
  }
  if($range=='low to high'){
      $this->db->order_by('product_price','asc');
  }else{
      $this->db->order_by('product_price','desc');
  }
    $query = $this->db->get();
    $result=$query->result_array();
      
      $row['product']=[];
    foreach($result as $order){
        $this->db->select('*');
    $this->db->from('productimage');
    $this->db->where('product_id',$order['product_id']);
    $query = $this->db->get();
    //echo $this->db->last_query();die;
     $result1=$query->result_array();
    //print_r($result1);die;
     $order['product1_image']=$result1;
     $row['product'][]=$order;
    }
    
    
  if($row) {
  // Set the response and exit
    $this->Response['Message'] = 'Product List.';
    $this->Response['Success'] = true;
    $this->Response['ProductList'] = $row;
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (200) being 
    $this->set_response($this->Response, RestController::HTTP_OK); 
 }else{ // if( sizeof( $UserDetails ) < 1 )
  $this->Response['Message'] = "Not data found";
  $this->Response['Success'] = false;
  $this->response($this->Response, RestController::HTTP_OK);
 }
}


 public function update_address_post()
      {
       //$this->form_validation->set_rules('userId', 'User id', 'required');
       $this->form_validation->set_rules('address_id', 'address_id', 'required');
       
    if ($this->form_validation->run() == TRUE)
    {
      
      $data = array(
       'pincode' =>$this->input->post('pincode'),
       'city' =>$this->input->post('city'),
       'state' =>$this->input->post('state'),
       //'user_id'=>$this->input->post('userId'),
       'name'=>$this->input->post('name'),
       'houseno'=>$this->input->post('houseno'),
       'buildingname'=>$this->input->post('buildingname'),
       'streetname'=>$this->input->post('streetname'),
       'area'=>$this->input->post('area'),
       'is_defualt'=>$this->input->post('default_address'),
     );
      
      $table='address';
      $where=array('address_id'=>$this->input->post('address_id'));
      $cities=$this->Main_model->updatedata($table,$data,$where);
    

     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Address updated successfully...'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

public function deleteaddress_post()
      {
       $this->form_validation->set_rules('address_id', 'address_id', 'required');
       
       
    if ($this->form_validation->run() == TRUE)
    {
    $table="address";
    $address_id=$this->input->post('address_id');
              
    $where=array('address_id'=>$address_id);
    
    $cities=$this->Main_model->deletedata($table,$where);
     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Address deleted successfully...'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

public function AllProduct_get($page)
{
    $per_page=5;
    $start = ($page - 1) * $per_page;   
    $this->db->select('*');
    $this->db->from('products');
    $this->db->where('status','1');
      $this->db->limit($per_page, $start);
    $query = $this->db->get();
    $result=$query->result_array();
      
      $row['product']=[];
    foreach($result as $order){
        $this->db->select('*');
    $this->db->from('productimage');
    $this->db->where('product_id',$order['product_id']);
    $query = $this->db->get();
    //echo $this->db->last_query();die;
     $result1=$query->result_array();
    //print_r($result1);die;
     $order['product1_image']=$result1;
     $row['product'][]=$order;
    }
      if($row) 
      {
        $this->Response['Message'] = 'Product_list';
        $this->Response['Success'] = true;
        $this->Response['Product_list'] = $row;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
    $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}


 public function addfeedback_post()
      {
       $this->form_validation->set_rules('userId', 'User Id', 'required');
       $this->form_validation->set_rules('issue', 'issue', 'required');
       $this->form_validation->set_rules('email', 'email', 'required');
       $this->form_validation->set_rules('mobileNo', 'Mobile number', 'required|min_length[10]|max_length[10]');
    if ($this->form_validation->run() == TRUE)
    {
    $table="feedbacks";
    $userId=$this->input->post('userId');
    $issue=$this->input->post('issue');
    $email=$this->input->post('email');

    $mobileNo=$this->input->post('mobileNo');
    $feedback_details=$this->input->post('feedback_details');
    $date=date('d-m-Y H:i:s');
    $data = array('userId'=>$userId,'issue'=>$issue,' email'=>$email,'mobileNo'=>$mobileNo,'feedback_details'=>$feedback_details);
    $cities=$this->Main_model->insertdata($table,$data);
     if($cities > 0)
        {
            $this->response([
                'status' => true,
                'isRegistered'=>true,
                'message' => 'Feedback Submitted Successfull..'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'isRegistered'=>false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}

public function profiledetail_post() 
{

  $userId = $this->input->post('userId');
  $table="registration";
  $where=array('user_id'=>$userId);
  $employeem=$this->Main_model->fetchdata_where($table,$where);
  if($employeem) {
  // Set the response and exit
    $this->Response['Message'] = 'Profile';
    $this->Response['Success'] = true;
   // $this->Response['IsLoggedIn'] = true;
    $this->Response['UserDetails'] = $employeem;
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (200) being 
    $this->set_response($this->Response, RestController::HTTP_OK); 
 }else{ // if( sizeof( $UserDetails ) < 1 )
  $this->Response['Message'] = "Your otp is not match please enter currect";
  $this->Response['Success'] = false;
  $this->response($this->Response, RestController::HTTP_OK);
 }
} 


public function CancelPolicy_get()
{
    
      $result=$this->Main_model->fetchall('cancel_policy');
       foreach ($result as $value) 
              {

            $data1 = array(
            'id' => $value->id, 
            'title'=>$value->title,
            'descriptions' => strip_tags($value->description),
          );
              }
      if($result) 
      {
        $this->Response['Message'] = 'cancel_policy';
        $this->Response['Success'] = true;
        $this->Response['cancel_policy'] = $data1;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
    $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}

public function termacondition_get()
{
    
      $result=$this->Main_model->fetchall('term_and_condition');
      foreach ($result as $value) 
              {

            $data1 = array(
            'id' => $value->id, 
            'title'=>$value->title,
            'descriptions' => strip_tags($value->descriptions),
          );
              }
      if($result) 
      {
        $this->Response['Message'] = 'term_and_condition';
        $this->Response['Success'] = true;
        $this->Response['term_and_condition'] = $data1;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
    $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}
public function notification_get()
{
    
       $date = new DateTime("now");
       $curr_date = $date->format('Y-m-d ');
      $offer=$this->db->select('offer_id as id,offer_title as title,description,created_at as date')->from('offers')->where('DATE(created_at)',$curr_date)->get();
      $res=$offer->result();
      $pro=$this->db->select('product_id as id,product_name as title,product_description as description,created_at as date')->from('products')->where('DATE(created_at)',$curr_date)->get();
      $respro=$pro->result();
      //print_r($res);die();
      if($res || $respro) 
      {
        $this->Response['Message'] = 'Notification';
        $this->Response['Success'] = true;
        $this->Response['offers'] = $res;
        $this->Response['product'] = $respro;
        $this->response($this->Response, RestController::HTTP_OK); 
        $this->set_response($this->Response, RestController::HTTP_OK);
      }
      else {
    // Set the response and exit
    $this->Response['Success'] = false;
        $this->Response['Message'] = 'Data Not Found';
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
  } 
}


public function apply_coupon_post() 
{

//   $offer_id = $this->input->post('offer_id');
  $offer_code= $this->input->post('offer_code');
  $total_amount = $this->input->post('total_amount');
  $table="offers";
  $where=array('offer_code'=>$offer_code);
  $employeem=$this->Main_model->fetchdata_where($table,$where);
  
  
  if($employeem->offer_validity>=date('Y-m-d')){
      if($total_amount<$employeem->Min_Order_Amount){
  $this->Response['Message'] = "Minimum order value should be ".$employeem->Min_Order_Amount." to avail this offer";
  $this->Response['Success'] = false;
  $this->Response['grand_total'] = number_format($total_amount,2);
  $this->response($this->Response, RestController::HTTP_OK);
      }else{
    $grant=$total_amount-$employeem->Coupon_Value;
    $this->Response['Message'] = 'Offer Applied Successfully';
    $this->Response['Success'] = true;
    $this->Response['grand_total'] = number_format($grant,2);
    $this->Response['Coupon_Value'] = $employeem->Coupon_Value;
    $this->Response['offer_id'] = $employeem->offer_id;
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (200) being 
    $this->set_response($this->Response, RestController::HTTP_OK);
      }
  }else{
  $this->Response['Message'] = "Applied Offer expired";
  $this->Response['Success'] = false;
  $this->Response['grand_total'] = number_format($total_amount,2);
  $this->response($this->Response, RestController::HTTP_OK);
  }
 
}


public function apply_offers_post() 
{

//   $offer_id = $this->input->post('offer_id');
  $offer_code= $this->input->post('offer_code');
   $total_amount = $this->input->post('total_amount');
  $table="offers";
  $where=array('offer_code'=>$offer_code);
  $employeem=$this->Main_model->fetchdata_where($table,$where);
  
  
  if($employeem->offer_validity>=date('Y-m-d')){
      if($total_amount<$employeem->Min_Order_Amount){
  $this->Response['Message'] = "Minimum order value should be ".$employeem->Min_Order_Amount." to avail this offer";
  $this->Response['Success'] = false;
  $this->response($this->Response, RestController::HTTP_OK);
      }else{
    // $grant=$total_amount-$employeem->Coupon_Value;
    $this->Response['Message'] = 'Offer Applied Successfully';
    $this->Response['Success'] = true;
    $this->Response['Offer_details'] = $employeem;
    $this->response($this->Response, RestController::HTTP_OK); // BAD_REQUEST (200) being 
    $this->set_response($this->Response, RestController::HTTP_OK);
      }
  }else{
  $this->Response['Message'] = "Applied Offer expired";
  $this->Response['Success'] = false;
  $this->response($this->Response, RestController::HTTP_OK);
  }
 
} 


 public function inquiry_post()
      {
       $this->form_validation->set_rules('customer_name', 'customer_name', 'required');
       $this->form_validation->set_rules('email', 'email', 'required|valid_email');
       $this->form_validation->set_rules('whatapp_no', 'whatapp_no', 'required|min_length[10]|max_length[10]');
    $this->form_validation->set_rules('address', 'address', 'required');
    $this->form_validation->set_rules('brand', 'brand', 'required');
    $this->form_validation->set_rules('ac_type', 'ac_type', 'required');
    $this->form_validation->set_rules('tone', 'tone', 'required');
    if ($this->form_validation->run() == TRUE)
    {
    $table="enquery";
    $customer_name=$this->input->post('customer_name');
    $email=$this->input->post('email');
    $whatapp_no=$this->input->post('whatapp_no');

    $address=$this->input->post('address');
    $brand=$this->input->post('brand');
    $ac_type=$this->input->post('ac_type');
    $tone=$this->input->post('tone');
    $for_site_visit=$this->input->post('for_site_visit');
    $for_quatation=$this->input->post('for_quatation');
    $reason=$this->input->post('reason');
    $date=date('d-m-Y H:i:s');
    $data = array('customer_name'=>$customer_name,'email'=>$email,' whatapp_no'=>$whatapp_no,'created_at'=>$date,'address'=>$address,'brand'=>$brand,'ac_type'=>$ac_type,'tone'=>$tone,'for_site_visit'=>$for_site_visit,'for_quatation'=>$for_quatation,'reason'=>$reason,);
    $cities=$this->Main_model->insertdata($table,$data);
     if($cities > 0)
        {
        

            $this->response([
                'status' => true,
                'message' => 'Submitted Successfull..'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'Failed Submited..'
            ], RestController::HTTP_OK);
        }
  }else{
        $this->response([
                'status' => false,
                'message' => strip_tags(validation_errors()),
            ], RestController::HTTP_OK);
  }
}



} 