<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main_model extends CI_Model 
{
	public function login_user($email,$pass)
	{
		$query= $this->db->query("SELECT * FROM admin WHERE email= '" . $email . "' AND password = '" .$pass. "'");
		return $query;
	}

  public function login_employee($email)
  {
    $query= $this->db->query("SELECT * FROM registration WHERE email_id= '" . $email . "' ");
    return $query->row();
  }
  public function loginm_employee($email)
  {
    $query= $this->db->query("SELECT * FROM registration WHERE mobile_no= '" . $email . "'");
    return $query->row();
  }
  
	public function insertdata($table,$data)
	{
		$a = $this->db->insert($table,$data);
		return $a;
  	}

  	public function email($str,$table)
    {
      $this->db->where('email', $str);
      $this->db->from($table);
      $query = $this->db->get();
      if ($query->num_rows() > 0) 
      {
        return true;
      }
      return false; 
    }

    public function fetchall($table,$where='')
    {
    	$this->db->select("*");
    	$this->db->from($table);
    	if($where){
    	  $this->db->where($where);
    	}
    	$query=$this->db->get();
    	return $query->result();
    }

    public function fetchallactive($table)
    {
      $this->db->select("*");
      $this->db->where('status','1');
      $this->db->from($table);
      $query=$this->db->get();
      return $query->result();
    }

    public function fetchdata($table, $id)
    {
        $this->db->select("*");
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
	   }
	public function updatedata($table,$data,$where)
	{
		$this->db->where($where);
    return $this->db->update($table,$data);		
	}
	public function deletedata($table,$where)
	{
		$this->db->where($where);
		return $this->db->delete($table);
	}
public function deletedataattr($table,$id)
  {
    $this->db->where('product_id', $id);
    return $this->db->delete($table);
  }
	public function standard($str,$table)
    {
      $this->db->where('standard', $str);
      $this->db->from($table);
      $query = $this->db->get();
      if ($query->num_rows() > 0) 
      {
        return true;
      }
      return false; 
    }
    public function countdata($table)
    {
      $this->db->select('*');
      $this->db->from($table);
      return $this->db->count_all_results();
    }

    public function forgotepassword($table,$email)
    {
      $query= $this->db->query("SELECT * FROM ".$table." WHERE email= '" . $email . "' ");
    return $query;
    }
    
     public function fetchcompany($table,$emp_id)
    {
      $this->db->select("*");
      $this->db->from($table);
      $this->db->where('categoryId',$emp_id);
      $query=$this->db->get();
      return $query->result();
    }
    public function select_where($table,$limit)
    {
       
      $this->db->select("*");
      $this->db->from($table);
      $this->db->limit($limit);
      $query=$this->db->get();
      return $query->result();
    }
      public function fetchdata_where($table,$where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->row_array();
     }

    public function fetchallleaves()
    {
      $query=$this->db->select('t2.*,t3.name,t3.refer_by')
     ->from('payment_details as t2')
     ->join('registration as t3', 't2.userId = t3.id', 'LEFT')
     ->where('t2.userId !=', '')
     ->get();
    return $query->result();
    }
    public function fetchsubcategory()
    {
      $query=$this->db->select('t2.*,t3.categoryName')
     ->from('subcategory as t2')
     ->join('category as t3', 't2.categoryId = t3.categoryId', 'LEFT')
     ->where('t3.deleted_at',1)
     ->get();
    return $query->result();
    }
    public function fetchposter()
    {
      $query=$this->db->select('t2.*,t3.language,t4.companyName,t5.categoryName')
     ->from('posters as t2')
     ->join('languages as t3', 't2.languageId = t3.language_id', 'LEFT')
     ->join('companies as t4', 't2.companyId = t4.company_id', 'LEFT')
     ->join('category as t5', 't2.categoryId = t5.categoryId', 'LEFT')
     ->where('t3.language_id !=', '')
     ->get();
    return $query->result();
    }
    public function freeposter($value='')
    {
      $query=$this->db->select('t2.*,t3.categoryName')
     ->from('freeposter as t2')
     ->join('category as t3', 't2.categoryId = t3.categoryId', 'LEFT')
     ->where('t2.categoryId !=', '')
     ->get();
    return $query->result();
    }

     public function countdata_where($table,$where)
    {
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($where);
      return $this->db->count_all_results();
    }
    
      public function fetchdata_where_result($table,$where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->result();
     }
     
     
     public function insertdatafile($data) {
$res = $this->db->insert_batch('products',$data);
if($res){
return TRUE;
}else{
return FALSE;
}
}

  public function fetchdata_where_gruopby($table,$where='',$group='')
    {
        $this->db->select("*");
        if($where){
        $this->db->where($where);
        }
        $this->db->group_by($group);
        $this->db->order_by('orderid','desc');
        $query = $this->db->get($table);
        return $query->result();
     }

    
}