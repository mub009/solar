<?php

/**
 * Image uploading:
 *
 * @category Form Validation
 * @author   Mubashir
 */
class image
{

    /**
     * CodeIgniter instance
     *
     * @var object
     */
    private $_CI;

    /**
     * DO NOT CALL THIS DIRECTLY
     */

    public function __construct()
    {

        // Get the CodeIgniter reference

        $this->_CI = &get_instance();

        $this->_CI->load->library('image_lib');
       

    }

    /**
     * @func uploading profile image
     * @return no param
     */

    public function profile()
    {

        $config['upload_path'] = 'assets/upload/image/profilepic/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['encrypt_name'] = true;

        $this->_CI->load->library('upload', $config);
    }
    
    /**
     * @func uploading profile image
     * @return no param
     */
    
    public function store_profile()
    {

        $config['upload_path'] = 'assets/upload/image/storeprofile';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['encrypt_name'] = true;

        $this->_CI->load->library('upload', $config);
    }


   /**
     * @func uploading config image
     * @return no param
     */
    function dealerandofferimage()
    {
        $config['upload_path'] = 'assets/upload/dealsandoffer/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 2000;
        $config['encrypt_name'] = true;
    
        $this->_CI->load->library('upload', $config);
    }


     /**
     * @func uploading config image
     * @return no param
     */
    function selfieimage()
    {
        $config['upload_path'] = 'assets/upload/selfiepoint/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 2000;
        $config['encrypt_name'] = true;
    
        $this->_CI->load->library('upload', $config);
    }



     
    /**
     * @func uploading config image
     * @return no param
     */
function ImageConfig()
{
    $config['upload_path']   ='assets/upload/image/'; 
    $config['allowed_types'] = 'gif|jpg|png'; 
    $config['file_name']     =  uniqid();
    $this->_CI->load->library('upload', $config);

}

  

public function image_cropping($uploadfile)
{
  
    $configMgr=$this->_CI->Base_Model->select('tbl_settings', $data = '*','');


    if($configMgr['is_FileManager'])
    {

            $this->_CI->aws3->ImageSend('',$uploadfile);	   
           
            $this->image_resize(array('width'=>20,'height'=>20,'image'=>'20x20'),$uploadfile);	
                    
            $this->_CI->aws3->ImageSend('20x20',$uploadfile);	    
                            
            $this->image_resize(array('width'=>50,'height'=>50,'image'=>'50x50'),$uploadfile);	
           
            $this->_CI->aws3->ImageSend('50x50',$uploadfile);	   
           
            $this->image_resize(array('width'=>100,'height'=>50,'image'=>'100x50'),$uploadfile);	    
           
            $this->_CI->aws3->ImageSend('100x50',$uploadfile);	    
           
            $this->image_resize(array('width'=>400,'height'=>200,'image'=>'400x200'),$uploadfile);	    
              
            $this->_CI->aws3->ImageSend('400x200',$uploadfile);	 
            
            $this->image_resize(array('width'=>800,'height'=>600,'image'=>'800x600'),$uploadfile);	    
             
            $this->_CI->aws3->ImageSend('800x600',$uploadfile);	 
             
            $this->image_resize(array('width'=>1200,'height'=>800,'image'=>'1200x800'),$uploadfile);	  
             
            $this->_CI->aws3->ImageSend('1200x800',$uploadfile);
             
    }
    else
    {

    $this->image_resize(array('width'=>20,'height'=>20,'image'=>'20x20'),$uploadfile);
    
        
    $this->image_resize(array('width'=>50,'height'=>50,'image'=>'50x50'),$uploadfile);


    $this->image_resize(array('width'=>100,'height'=>50,'image'=>'100x50'),$uploadfile);


    $this->image_resize(array('width'=>200,'height'=>200,'image'=>'400x200'),$uploadfile);
 
   
    $this->image_resize(array('width'=>800,'height'=>600,'image'=>'800x600'),$uploadfile);


    $this->image_resize(array('width'=>1200,'height'=>800,'image'=>'1200x800'),$uploadfile);
    
  }

    
 }



  public function image_resize($data,$file_array)
  {


      $config['image_library']   = 'gd2';
      $config['source_image']    ='assets/upload/image/'.$file_array['file_name'];
      $config['maintain_ratio'] = TRUE;
      $config['create_thumb']    = TRUE;
      $config['maintain_ratio']  = TRUE;
      $config['width']           = $data['width'];
      $config['height']          = $data['height'];
      $config['new_image']   = "assets/upload/image/".$data['image']."/".$file_array['file_name'];
      $config['thumb_marker'] = '';
  
      
      $this->_CI->image_lib->initialize($config);
      $result= $this->_CI->image_lib->resize();

      $this->_CI->image_lib->clear();
      return $this->_CI->image_lib->clear();
     
    }

	
    
   
    


    /**
     * @func 64 bit image uploading
     * @param upload_path where is image uploading
     * @param sixty_four_image 64 image data
     * @return image details
     */

    public function selfie_sixty_four_image($sixty_four_image)
    {

        $image_parts = explode(";base64,", $sixty_four_image);

        if (!empty($image_parts[0])) {

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $file = 'assets/upload/selfiepoint/' . uniqid() . '.png';

            file_put_contents($file, $image_base64);

            $image_details = getimagesize($file);

            if (in_array($image_details[2], array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
                return $file;
            } else {
                unlink($file);
                return false;

            }
        } else {
            return false;

        }

    }

    /**
     * @func 64 bit image uploading in deals and offer
     * @param upload_path where is image uploading
     * @param sixty_four_image 64 image data
     * @return image details
     */

    public function deals_and_offer_sixty_four_image($sixty_four_image)
    {

        $image_parts = explode(";base64,", $sixty_four_image);

        if (!empty($image_parts[0])) {

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $file = 'assets/upload/dealsandoffer/' . uniqid() . '.png';

            file_put_contents($file, $image_base64);

            $image_details = getimagesize($file);

            if (in_array($image_details[2], array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
                return $file;
            } else {
                unlink($file);
                return false;

            }
        } else {
            return false;

        }

    }

    /**
     * @func set profile by Customer
     * @param upload_path where is image uploading
     * @param sixty_four_image 64 image data
     * @return image details
     */

    public function Customer_sixty_four_image($sixty_four_image)
    {
        try {

        $image_parts = explode(";base64,", $sixty_four_image);

        if (!empty($image_parts[0])) {

            $image_type_aux = explode("image/", $image_parts[0]);

            
            $image_type = $image_type_aux[1];

            if (!in_array($image_type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                throw new \Exception('invalid image type');
            }
            else
            {

            $image_base64 = base64_decode($image_parts[1]);

            $file = 'assets/upload/customer/' . uniqid() .'.'.$image_type;

            file_put_contents($file, $image_base64);

            $image_details = getimagesize($file);

            if (in_array($image_details[2], array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
                return $file;
            } else {
                unlink($file);
                return false;

            }
        }
        } else {
            return false;

        }

    }

    catch (Exception $e) {
    
        return false;
    }

    }

    public function test()
    {
        echo 'ss';
    }
}
