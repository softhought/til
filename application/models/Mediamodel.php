<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mediamodel extends CI_Model{

	public function getVideoAllList(){
		$data = array();
		$this->db->select("*")
				->from('fuel_videos')
                ->order_by('precedence','ASC');
		$query = $this->db->get();
		//echo "<br>".$this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;   

        }
		else
		{
             return $data;

         }
	}/** end */
    public function getEventHappiningAllList(){
		$data = array();
		$this->db->select("*")
				->from('happenings')
                ->order_by('precedence','ASC');
		$query = $this->db->get();
		//echo "<br>".$this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;   

        }
		else
		{
             return $data;

         }
	}/** end */

	
	public function fileUpload($data, $dir_path)
{ 
    $config = array(
        'upload_path' => $dir_path,
        'allowed_types' => 'pdf|jpg|jpeg|png',
        'max_size' => '5120', 
        'max_filename' => '255',
        'encrypt_name' => TRUE,
    );

    $this->load->library('upload', $config);
    $uploaded_files = array();

    for ($i = 0; $i < sizeof($data['docFile']['fileName']['name']); $i++)
    {
        $_FILES['image']['name'] = $data['docFile']['fileName']['name'][$i];
        $_FILES['image']['type'] = $data['docFile']['fileName']['type'][$i];
        $_FILES['image']['tmp_name'] = $data['docFile']['fileName']['tmp_name'][$i];
        $_FILES['image']['error'] = $data['docFile']['fileName']['error'][$i];
        $_FILES['image']['size'] = $data['docFile']['fileName']['size'][$i];

        $this->upload->initialize($config);
        if ($this->upload->do_upload('image'))
        { 
            $file_detail = $this->upload->data();
            $uploaded_files[] = 'gallery_image_'.$file_detail['file_name']; 
        } 
        else
        {
            $errors[] = $this->upload->display_errors();
        }
    }

    return $uploaded_files;
}

}/**end */
