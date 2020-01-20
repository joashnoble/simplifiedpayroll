<?php

class CompanyManagement_model extends CORE_Model {
    protected  $table="company_management";
    protected  $pk_id="company_id";

    function __construct() {
        parent::__construct();
    }

    function authenticate_company($ccode,$pword){
        $this->db->select('*');
        $this->db->from('company_management');
        $this->db->where('is_archive', '1');
        $this->db->where('is_deleted', '0');
        $this->db->where('company_code', $ccode);
        $this->db->where('company_password', $pword);
        return $this->db->get();
    }

    function get_company_list($company_id=null) {
	    $query = $this->db->query("SELECT 
	    				*,
					    company_code,
					    company_name,
					    no_of_employee,
					    (CASE
					    	WHEN date_enrolled = '' THEN 'N/A'
					    	ELSE DATE_FORMAT(date_enrolled,'%m/%d/%Y')
					    END) AS date_enrolled,
					    (CASE
					        WHEN is_archive = 0 THEN 'Pending'
					        WHEN is_archive = 1 THEN 'Active'
					        ELSE 'Inactive'
					    END) AS status
					FROM
					    company_management

                        WHERE company_management.is_deleted = FALSE
					    ".($company_id==null?"":" AND company_id='".$company_id."'")."
					    ORDER BY company_id DESC
					   	");
		return $query->result();                      
    }

  function send_mail($email,$message,$subject,$company_email,$email_password,$company_name)
  {     
    $emailConfig = array('protocol' => 'smtp', 
    'smtp_host' => 'ssl://smtp.googlemail.com', 
    'smtp_port' => 465, 
    'smtp_user' => $company_email, 
    'smtp_pass' => $email_password, 
    'mailtype' => 'html', 
    'charset' => 'iso-8859-1');

    $this->load->library('email', $emailConfig);
    $this->email->set_newline("\r\n");
    $this->email->from($company_email, $company_name);
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    $this->email->set_mailtype("html");
    $this->email->send();
  }
}
?>
