<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of AmazonS3
 *
 * @author mubashir
 */
 
 include("./vendor/autoload.php");
 
 use Aws\S3\S3Client;
 
 class Aws3{
	
	private $S3;
	public function __construct(){


		
		    // Get the CodeIgniter reference

			$this->_CI = &get_instance();



		$this->S3 = S3Client::factory([
			'version'           => '2006-03-01',
            'signature_version' => 'v4',
			'region' => 'ap-south-1',
			'credentials' => array('key' => $this->_CI->config->item('Amazon_key'),
			'secret' => $this->_CI->config->item('Amazon_secret'))
		]);
	}	
	
	public function addBucket(){
		$result = $this->S3->createBucket(array(
			'Bucket'=>$this->_CI->config->item('Amazon_S3_Bucket_name'),
			'LocationConstraint'=> 'ap-south-1'));
		return $result;	
	}
	
	public function ImageSend($image,$file_array){


		if(empty($image))
		{
	
				$result = $this->S3->putObject(array(
					'Bucket' => $this->_CI->config->item('Amazon_S3_Bucket_name'),
					'Key' => 'image/'.$file_array['file_name'],
					'SourceFile' => 'assets/upload/image/'.$file_array['file_name'],
					'ContentType' => 'image/png',
					'StorageClass' => 'STANDARD',
					'ACL' => 'public-read'
				));

				
				//unlink(FCPATH.'assets/upload/image/'.$image.'/'.$file_array['file_name']);


		}
		else
		{

			
			$result = $this->S3->putObject(array(
				'Bucket' => $this->_CI->config->item('Amazon_S3_Bucket_name'),
				'Key' => 'image/'.$image.'/'.$file_array['file_name'],
				'SourceFile' => 'assets/upload/image/'.$image.'/'.$file_array['file_name'],
				'ContentType' => 'image/png',
				'StorageClass' => 'STANDARD',
				'ACL' => 'public-read'
			));

			unlink(FCPATH.'assets/upload/image/'.$image.'/'.$file_array['file_name']);

		}

	
	

		return $result['ObjectURL']."\n";
	}
		
	 
 }