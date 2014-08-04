
<link rel="stylesheet" href="./bootstrap-3.1.1/css/dropzone.css">
<link rel="stylesheet" href="./bootstrap-3.1.1/css/basic.css">

<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>	

	




<form action="upload.php" class="dropzone anim" id="mydropzone">
	<div class="b">					
	  <div class="up ion-arrow-up-a"></div>
		  <h1>ENVIAR IMAGEM</h1>
		  arraste ou click para enviar o arquivo.
	 </div>

</form>


<script src="./bootstrap-3.1.1/js/dropzone.js"></script>

<script type="text/javascript">
	var myDropzone = new Dropzone("#mydropzone", { 
	url: "enviar.php",
	addRemoveLinks : true,
	maxFilesize: 0.5,
	acceptedFiles: 'image/jpeg,image/png,image/gif',
	removedfile: function(file) 
	{
  		var apgar = { apagar : file.name }
	  	$.ajax({ 
		    type: 'post',
		    url: 'enviar.php',  
			data: apgar, 
	        async: false
		});				  	
		var _ref;
        if ((_ref = file.previewElement) != null) {
          _ref.parentNode.removeChild(file.previewElement);
        }
        return this._updateMaxFilesReachedClass();
	 },
	dictResponseError: 'Error uploading file!'
});


 myDropzone.on("addedfile", function(file) {
    //alert(file.name)
  });

 myDropzone.on("complete", function(file) {
	  //alert(file.name);
	  //myDropzone.removeFile(file);
 });

</script>

