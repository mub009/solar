<?php

class Base_Model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

        // $data="dbdriver://elagansysdbadmin:Elagan123!@#@tcp:elegansysserver.database.windows.net,1433/vr1_Anakkara_cloud?char_set=utf8&dbcollat=utf8_general_ci&cache_on=true&cachedir=/path/to/cache";
       
        // $multi = $this->load->database($data); // the TRUE paramater tells CI that you'd like to return the database object.

        // print_r($multi);
        // die();
    
    }

    public function insert($table_name, $data, $key = null, $key_colum_name = null, $id = 'Id')
    {

        $this->db->trans_begin();

        $this->db->insert($table_name, $data);

        $insert_id = $this->db->insert_id();

        if (!empty($key)) {

            $key .= $insert_id;

            if ($this->update($table_name, array($id => $insert_id), array($key_colum_name => $key))) {

                $this->db->trans_commit();

                return $key;
            } else {

                $this->db->trans_rollback();

                return false;
            }

        } else {

            $this->db->trans_commit();

            return $insert_id;

        }

    }

    public function select($table, $data = '*', $where = null, $order_desc = null, $order_asc = null, $limit = null, $start = null, $return = 'row_array')
    {

        $this->db->select($data);

        if (!empty($where)) {

            $this->db->where($where);

        }

        if (!empty($order_desc)) {

            $this->db->order_by($order_desc, "desc");

        }

        $this->db->limit($start, $limit);

        if (!empty($order_asc)) {

            $this->db->order_by($order_asc, "asc");

        }

        $query = $this->db->get($table);

        if ($return == 'num_rows') {

            return $query->num_rows();
        } elseif ($return == 'num_fields') {

            return $query->num_fields();
        } elseif ($return == 'result') {

            return $query->result();
        } elseif ($return == 'row_array') {

            return $query->row_array();
        } elseif ($return == 'result_array') {

            return $query->result_array();
        }

    }

   public function file_delete($path)
     {
        
        unlink($path);
     }

    public function delete($table_name, $where = null, $path = null)
    {

        if (!empty($path)) {

            unlink($path);

        }

        $this->db->where($where);

        if ($this->db->delete($table_name)) {
            return true;
        } else {
            return false;
        }

    }

    public function update($table_name, $where, $data)
    {

         $this->db->where($where);

        if ($this->db->update($table_name, $data)) {
            return true;
        } else {
            return false;
        }

    }

    public function count($where, $table)
    {

        if (!empty($where)) {
            $this->db->where($where);
        }

        return $this->db->count_all_results($table);

    }

    public function query($query, $return = null)
    {

        $query = $this->db->query($query);

        if ($return == 'num_rows') {

            return $query->num_rows();
        } elseif ($return == 'num_fields') {

            return $query->num_fields();
        } elseif ($return == 'result') {

            return $query->result();
        } elseif ($return == 'row_array') {

            return $query->row_array();
        } elseif ($return == null) {

            return $query->result_array();
        } elseif ($return == 'query') {

            return $query;
        }

    }

    public function CURL($url)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);

        curl_close($ch);

        return json_decode($result);

    }

    public function data_checking($value, $field_name)
    {

        $explodedata = explode('.', $field_name);

        if ($this->Base_Model->query("SELECT * FROM $explodedata[0] WHERE $explodedata[1]='" . $value . "'")) {

            return true;

        } else {
            $this->form_validation->set_message('data_checking', $value . ' Not exists');
            return false;
        }

    }

    public function OTP($digit)
    {

    }

    public function SMS($number, $message)
    {

    }

   public function readdata(){
	$query=$this->db->select('Id,CustomerName,CustomerMob,TotalAmount,OrderStatusId,OrderDateTime')
		              ->get('tbl_order');
		        return $query->result();
}

  

}
