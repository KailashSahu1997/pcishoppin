<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import extends CI_Controller {
// construct
public function __construct() {
parent::__construct();
// load model
$this->load->model('Main_model', 'import');
$this->load->helper(array('url','html','form'));
error_reporting(0);
}    
public function index() {
        $data['title'] = 'Dashboard';
		$this->load->view('head',$data);
		$this->load->view('header');
        $this->load->view('import');
        $this->load->view('footer');
}
public function importFile(){
$path = 'uploads/';
require_once APPPATH . "/third_party/PHPExcel.php";
$config['upload_path'] = $path;
$config['allowed_types'] = 'xlsx|xls|csv';
$config['remove_spaces'] = TRUE;
$this->load->library('upload', $config);
$this->upload->initialize($config);            
if (!$this->upload->do_upload('uploadFile')) {
$error = array('error' => $this->upload->display_errors());
} else {
$data = array('upload_data' => $this->upload->data());
}
if(empty($error)){
if (!empty($data['upload_data']['file_name'])) {
$import_xls_file = $data['upload_data']['file_name'];
} else {
$import_xls_file = 0;
}
$inputFileName = $path . $import_xls_file;
try {
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFileName);
$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
$flag = true;
$i=0;
// echo "<pre>";
// print_r($allDataInSheet);die;
foreach ($allDataInSheet as $value) {
if($flag){
$flag =false;
continue;
}
$res=$this->db->select('*')->from('category')->where('categoryName', $value['A'])->get()->row();
if($res){
    $categoryId=$res->categoryId;
}
else{
     $data=array('categoryName'=>$value['A']);
    $this->db->insert('category',$data);
    $categoryId=$this->db->insert_id();
}

$res1=$this->db->select('*')->from('subcategory')->where('subcategoryName', $value['C'])->get()->row();
if($res1){
   $subcategoryid=$res1->subcategory_id;
}else{
    $data=array('categoryId'=>$categoryId,'subcategoryName'=>$value['C']);
    $this->db->insert('subcategory',$data);
    $subcategoryid=$this->db->insert_id();
}

$product=$this->db->select('*')->from('products')->where('product_name', $value['B'])->get()->row();
if($product){
    
}else{
$dicount=$value['D']*$value['E']/100;
$selling_price=$value['D']-$dicount;
$inserdata['category_id'] = $categoryId;
$inserdata['product_name'] = $value['B'];
$inserdata['subcategory_id'] = $subcategoryid;
$inserdata['product_price'] = $value['D'];
$inserdata['product_offer'] = $value['E'];
$inserdata['product_quantity'] = $value['F'];

$inserdata['product_description'] = $value['G'];
$inserdata['product_usage_details'] = $value['H'];
$g1=explode(',',$value['I']);
$gallery1=$g1[0];
$inserdata['product_images'] = '/uploads/products/'.$gallery1;
$inserdata['selling_price'] = $selling_price;
$result = $this->db->insert('products',$inserdata);
$product_id=$this->db->insert_id();
foreach($g1 as $list){
   $proimag=array('product_id'=>$product_id,
    'images'=>'/uploads/products/'.$list,
        );
    $result = $this->db->insert('productimage',$proimag);
}

// $this->db->insert_batch('productimage',$proimag);
}

$i++;
}
if($result){
$this->session->set_flashdata('success','Product Added Successfully !.');
redirect(base_url().'product_upload');

}else{
$this->session->set_flashdata('error','Product Already existed');
redirect(base_url().'product_upload');
}             
} catch (Exception $e) {
die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
. '": ' .$e->getMessage());
}
}else{
echo $error['error'];
}

}

public function importimages(){

       if(move_uploaded_file($_FILES["file"]["tmp_name"],  FCPATH."/uploads/products/".$_FILES["file"]["name"]))
    {
        // echo "move";
       $zip = new ZipArchive();
    //   $rar = new RarArchive();
       
        $file = $zip->open(FCPATH."/uploads/products/".$_FILES["file"]["name"]);
         //$filerar = $rar->open(FCPATH."/uploads/products/".$_FILES["file"]["name"]);
        if ($file === TRUE) {
            // echo "open";
            $zip->extractTo(FCPATH."/uploads/products/");
            $zip->close();
            // echo "unzip";
            unlink(FCPATH."/uploads/products/".$_FILES["file"]["name"]);
            $this->session->set_flashdata('success','Bulk Image Upload Successfully !.');
       redirect(base_url().'product_upload');
        }
    }else{
        $this->session->set_flashdata('success','Some Thing is wrong !.');
        redirect(base_url().'product_upload');
    }

     }

}
?>