<?php
class MY_Form_validation extends CI_Form_validation 
{  
	function unique($value, $params) 
	{  
		$CI =& get_instance();  
		$CI->load->database();  
		$CI->form_validation->set_message('unique', 'The %s is already being used.');  
		
		list($table, $field) = explode(".", $params, 2);  
  
		$query = $CI->db->select($field)->from($table)->where($field, $value)->limit(1)->get();  
  
		if ($query->row()) {  
			return false;  
		}
		else
		{  
			return true;  
		}
	}
}