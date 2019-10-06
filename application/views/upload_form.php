<html>
 
   <head> 
      <title>Upload Form</title> 
   </head>
	
   <body> 
      <!-- <?php echo $error;?>  -->
      <?php echo form_open_multipart('Welcome/do_upload');?> 
		
      <form action = "" method = "">
         <input type = "file" name = "userfile" size = "200" /> 
         <br /><br /> 
         <input type = "submit" value = "upload" />
      </form> 
		
   </body>
	
</html>