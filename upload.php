<?php

$storeFolder = 'imagens';  


$ds  = DIRECTORY_SEPARATOR; 
 
$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 



if(!empty($_POST['apagar']))
{

    $targetFile =  $targetPath. $_POST['apagar']; 

	if(is_file($targetFile)) 
	{
		unlink($targetFile);
	}
}	


if(!empty($_POST['deleta']))
{

    $targetFile =  $targetPath. $_POST['deleta']; 

    echo $targetFile;

	if(is_file($targetFile)) 
	{
		unlink($targetFile);
	}
}



if (!empty($_FILES)) 
{
     
    $tempFile = $_FILES['file']['tmp_name'];            
      
    $targetFile =  $targetPath. $_FILES['file']['name']; 
 
    move_uploaded_file($tempFile,$targetFile); 


     
}
?> 
