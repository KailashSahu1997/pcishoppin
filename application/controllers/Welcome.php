<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('cart');
		$this->load->library('session');
	}
	public function index()
	{

		$this->load->view('index');
	}

	public function shop()
	{
		$this->load->view('shop');
	}
	public function product($id)
	{

		$this->load->view('product',['id'=>$id]);
	}

	public function cart()
	{
		 $data['cartItems'] = $this->cart->contents();
		$this->load->view('cart',$data);
	} 
	public function fetchproduct()
	 	{
	 		$data=$this->Main_model->select_where('products',15);
	 		foreach($data as $list){
	 			echo '<div class="col-sm-6 col-xs-6 col-xs-6 col-md-4 col-lg-3">
                  <div class="box">
                     <div class="img-box">
                     		<input type="hidden" id="product_id" value="'.$list->id.'">
                         <a href="'.base_url('product').'">
                        <img src="'.$list->image.'" alt="">
                        </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                           '.$list->title.'
                        </h5>
                     </div>
                      <button data-toggle="modal" data-target="#exampleModalCenter'.$list->id.'" class="btn btn-block btn-primary">Add to cart</button>
                  </div>
               </div>
               <div class="modal fade" id="exampleModalCenter'.$list->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add to cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="input-group mb-3">
		<div class="input-group-prepend">
		<span class="input-group-text" id="basic-addon1">
    <i class="fa fa-phone" aria-hidden="true"></i>  
    </span>
		</div>
		<input type="hidden" name="productid" value="'.$list->id.'">
		<input type="hidden" name="image" value="'.$list->image.'">
		<input type="hidden" name="name" value="'.$list->title.'">
		<input type="text" name="number" class="form-control text-left" placeholder="number" aria-label="Username" aria-describedby="basic-addon1">
		</div>
      </div>
      <div class="modal-footer">
        <a href="'.base_url().'addcard/'.$list->id.'" class="btn btn-primary">Add to cart</a>
      </div>
    </div>
  </div>
</div>';
	 		}
	 	} 

	 	public function addcard()
	 		{
        $data = array(
        'id'      => $_POST['productid'],
        'qty'     => $_POST['qnt'],
        'price'   => $_POST['price'],
        'name'    => $_POST['name'],
        'image'=> $_POST['image'],
				);
        $datas=$this->cart->insert($data);
        if($datas)
        {
        	echo 1;
        }
        else
        {
        	echo 0;
        }
	 		}	
	 		public function totalitem()
	 		{
	 			echo $this->cart->total_items();
	 		}


	 		public function update_cart()
	 		{
	 			 $id=$_POST['id'];
	 			 $qnt=$_POST['qnt'];
	 			 $data=$this->cart->update(array(
	 				'rowid'=>$id,
	 				'qty'=>$qnt
	 			));

	 			$city=$this->cart->update($data);  
	 			echo 1;
	 		}
	 		public function checkout()
	 		{
	 			$data['cartItems'] = $this->cart->contents();
		    $this->load->view('checkout',$data);
	 		}
	 		public function place_order()
	 		{
	 				$data['name']=$_POST['name'];
	 			$data['email']=$_POST['email'];
	 			$data['mobile']=$_POST['mobile'];
	 			$data['address']=$_POST['address'];
	 			$data['cartItems'] = $this->cart->contents();
	 			$this->load->view('invoice',$data);

	 			$html = $this->output->get_output();
        
        // Load pdf library
        $this->load->library('pdf');
        
        // Load HTML content
        $this->dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'landscape');
        
        // Render the HTML as PDF
        $this->dompdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        //$this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
	 		
	     $file_name = md5(rand()) . '.pdf';
       $file = $this->dompdf->output();
       file_put_contents($file_name, $file);


        $config = Array(
         'protocol'  => 'smtp',
         'smtp_host' => 'smtp.gmail.com',
         'smtp_port' => 587,
         'smtp_user' => 'humconsultancynoreply@gmail.com', 
         'smtp_pass' => 'zzgsjsygfewjbqge', 
         'mailtype'  => 'html',
         'charset'  => 'iso-8859-1',
         'wordwrap'  => TRUE
      );
    $subject="ORDER INVOICE";
    $message="ORDER PLACE Successfull";
    $to=$_POST['email'];
    $from='info@pcianalytics.in';
      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
      $this->email->from($from);
      $this->email->to($to);
      $this->email->subject($subject);
         $this->email->message($message);
         $this->email->attach($file_name);
         if($this->email->send())
         {

         	unlink($file_name);
         	$this->cart->destroy();
         	redirect(base_url('order_success'));
         }
	 		}

    function order_success()
    {
       $this->load->view('order_success'); 
    }
}
