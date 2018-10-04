<?php
if(isset($_POST['username'],$_POST['password'])){
	$uname = $_POST['username'];
	$pwd = $_POST['password'];
	if($uname == 'admin' && $pwd == '1234'){
		echo 'Successfully logged in';
		session_start();
		$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
		$session_id = session_id();
		setcookie('sessionCookie',$session_id,time()+60*60*24*365,'/');
		setcookie('csrfCookie',$_SESSION['token'],time()+60*60*24*365,'/');
		
	}
	else{
		echo 'Invalid Credentials';
		exit();
	}
	
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Double Submit Cookies Pattern</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	 <script src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/token_request.js"></script>
	<script>
	
	$(document).ready(function(){
	
/*	
   //Request the token 
   function tokenRequest(cookie) {
  //get cookies
  var cookieSet = document.cookie;
  //***alert(cookieSet);
  var EditedcookieSet = cookieSet.replace(/ /g,"");
  var arr = EditedcookieSet.split(";");
  var arrSize = arr.length;
  var csrfToken = "";
  var csrfCookie = "";
  var i = 0;
  //search for csrf token among other cookies
  while(i <= arrSize){
    var element = arr[i];
    var result = element.match(cookie+"=");
    if(result != null){
      var arr2 = arr[i].split("=");
      csrfToken = arr2[1];
      csrfCookie = arr2[0];
      break;
    }
    i++;
  }
  document.getElementById("MyToken").setAttribute("value", csrfToken);
  document.getElementById("CSRFcookie").setAttribute("value", csrfCookie);
}
	*/
	
	var name = "csrfCookie" + "=";
	var cookie_value = "";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            cookie_value = c.substring(name.length, c.length);
            document.getElementById("token_to_be_added").setAttribute('value', cookie_value) ;
        }
    }
	
	
	});
	
	
   
	
	
</script>
	</head>
	<body>
		<form action="main.php" method="post">
			<div id="div1">
							Post: <input type="text" name="updatepost">
			</div>
			<input type="Submit" value="Update Post" >
					
			<div id="div2">
			<input type="hidden" name="token" value="" id="token_to_be_added"/>
			</div>
			</div>
		</form>
	</body> 
</html>	