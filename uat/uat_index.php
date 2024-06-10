<?php 


?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> UAT </title>
		<link rel="stylesheet" type="text/css" href="xxx.css"/>
		
	</head>
	
	<style>
		*{
			margin: 0px;
			padding: 0px;
		}
		.SuggustionBox {
			display: absolute;
			background: #ffff;
			width: 350px;
			display: none;
			margin: ;
			padding: 10px 15px;
		}
		
		.SuggustionBox li {
			padding: 10px;
			border-bottom: 1px solid #eee;
		}
		
		li {
			display: block;
			list-style: none;
			cursor: pointer;
		}
		
		
		
		
	</style>


<body>
<div class="Dynamic-Area">

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
			  <button type="button" class="Dynamic-Option-Btn"> <a href="scm_home.php"> SCM Home </a> </button>
                 <center> <h1> UAT Test </h1> </center>
              </div>
              <div class="Form-box">
                  <!-- Form Start -->
                  <form  action="#" method ="POST" autocomplete="off"> <br>
                     					  
					  <div class="form-group">
                          <label>Autocomplete / Suggustion list </label> <br>
                          <input type="text" name="ItemName" id="term" class="form-control" placeholder="Enter Item Name" required />
						  <div class="SuggustionBox" > 
						  
						  <ul id="ItemData"> </ul>
						  
						</div>
                      </div>
     
                      <input type="submit"  name="save" class="btn-primary" value="Save" required /> <br><br>
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
   
</div>  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
 
<script> 

$("#term").keyup(function()
{
	$term = $("#term").val();
	
	$.ajax({
		url:'uat_data.php',
		method:'POST',
		data:{'term':$term},
		success:function(response)
		{
			$("#ItemData").html(response);
		}
	})
	
	
	
	if($("#term").val()!='')
	{
	$(".SuggustionBox").show();
	}
	else
	{
		$(".SuggustionBox").hide();
	}
})

function putdata (data)
{
	$("#term").val(data);
	$(".SuggustionBox").hide();
}

</script>
 
</body>
</html>