<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AMS</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/editbox.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery1.js"></script>
<script type="text/javascript" src="js/jquery2.js"></script>
<script type="text/javascript" src="js/facebox.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/validator.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
//Clear

function specialChar(e)
{
var k="<?php echo $param_fetch['specialchar']?>";
document.all ? k = e.keyCode : k = e.which;
return ((k != 48)&&(k != 49)&&(k != 50)&&(k != 51)&&(k != 52)&&(k != 53)&&(k != 54)&&(k != 55)&&(k != 56)&&(k != 57));
}
</script>
 <link rel="stylesheet" href="style/superfish.css" media="screen">
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
   <script type = "text/javascript" >

function disableBackButton()
{
window.history.forward();
}
setTimeout("disableBackButton()", 0);

</script> 
<style>
#closebutton {
    background: url("images/close_pop.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    color: rgba(0, 0, 0, 0);
    position: relative;
    right: -220px;
    top: -35px;
}
#closebutton1 {
    background: url("images/close_pop.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    color: rgba(0, 0, 0, 0);
    position: relative;
    right: -200px;
    top: -35px;
}
</style>
<script>

$(function () {
	$('#closebutton').button({
		icons: {
			primary : "images/close_pop.png",
		},
		text:false
	});	
	$('#closebutton').click(function(event) {
		//alert('232');
		$('#errormsgbuild').hide();
		return false;
	});		
});
</script>
<script>

$(function () {
	$('#closebutton1').button({
		icons: {
			primary : "images/close_pop.png",
		},
		text:false
	});	
	$('#closebutton1').click(function(event) {
		//alert('232');
		$('#errormsg').hide();
		return false;
	});		
});
</script>
<script>
function validateForm() 
	{
		var username=document.getElementById("username").value;
		if(username=="")
		{
			$('.myalignbuild').html('ERR 0009 : Enter Username');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			document.getElementById("username").focus();
			return false;
		}
	}
function forgot_clear()
{

document.getElementById("username").value="";
document.getElementById("username").focus();
}
</script>
</head>
 <?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['save']))
{
   if($fgmembersite->Login())
   {
     if ($fgmembersite->usertype() == 1)
	 {
	  $fgmembersite->RedirectToURL("admin_temp.php");
	 }
	 else
	 {
	 $fgmembersite->RedirectToURL("user_temp.php");
	 }
  
       
   }
}

?>
<?php
function abc(&$raja)
{
echo $raja;
}
?>

<?php
function forgotmail(&$useremail,&$username,&$userpassword)
	{
	
	$mail = new PHPMailer();

$mail->IsSMTP();                                      // set mailer to use SMTP
$mail->Host = "mail.wwcvl.com";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "noreply@wwcvl.com";  // SMTP username
$mail->Password = "2pQm_lNU_}K1"; // SMTP password
$mail->From = "raja.nuvento@gmail.com";
$mail->FromName = "Admin";
$mail->AddAddress($useremail);
//$mail->AddAddress("rajacs34@gmail.com");                  // name is optional
//$mail->AddReplyTo("rajacs34@gmail.com", "Information");

$mail->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML
$server_host=$_SERVER['index.php'];
$mail->Subject = "Login Details";
$mail->Body    = "Dear $username,<br/> <br/>
Login Details Are as Follows <br/><br/>
User Name :$username<br/><br/>
Password  :$userpassword<br/><br/>
Server Name:$server_host<br/><br/>
Thanks,<br/><br/>
Admin
";
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}
return true;
}
?>

<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();
if(isset($_POST['save']))
{
$username=$_POST['username'];
$query = "SELECT * FROM users where username = '$username'"; 
$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$useremail=$row['email'];
		$username_user=$row['username'];
		$userpassword=$row['plainpassword'];
	}
		if (mysql_num_rows($result) == 0)
		{
			$fgmembersite->RedirectToURL("forgot_password.php?success=notexists");
		}
		else
		{	
			forgotmail($useremail,$username_user,$userpassword);
			$fgmembersite->RedirectToURL("forgot_password.php?success=sent");
		}
}

?>


   
<body onLoad="display_ct();">
<div id="wrapper">
 <!------------------------------- Header Start ---------------------------------------->
 <div id="header">
    <div id="logo">
 <div class="left"><img src="images/logo_fmcl.png" width=60 height="70"/></div>
      <div class="left">
      <h1 align="center">ADMINISTRATIVE SYSTEM</h1>
     </div> <div class="left"><img src="images/logo_tts.png" width="60" height="70" style="padding-left:300px;"/></div> 
      </div>
 </div>
<!------------------------------- Form -------------------------------------------------->

<div id="mainarea">
<div class="clearfix"></div>
<div align="center" class="headings">Forgot Password</div>
<div class="mytableFP" align="center">

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="validation"  onsubmit="return validateForm();">
<input type='hidden' name='submitted' id='submitted' value='1'/>
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" style="clear:both;">
      <tr height="50px">
        <td width="29%" class="align" >User Name*</td>
        <td width="32%">&nbsp;&nbsp;&nbsp;<input type="text" name="username" id="username"  class="required" size="20" autocomplete="off"  maxlength="20" onkeypress="return specialChar(event)"/></td>
      </tr>
   
		<tr  height="30px;" align="center">
		<td width="29%"> &nbsp;</td>
<td width="50%" align="left" style="padding-left:5px;">
<input type="submit" class="buttons" id="submit" value="Send" name="save">&nbsp;&nbsp;&nbsp;<input type="button" onclick="return forgot_clear();" class="buttons" id="clear" value="Clear" name="clear">&nbsp;&nbsp;&nbsp;<input type="button" onclick="window.location='index.php'" class="buttons" value="Cancel" name="cancel">
</td>
		</tr>
    </table>
  </form>
</div>
<div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
  <?php 
if($_GET['success']=="notexists") { ?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "ERR 0009 :User Name Not Exists"; ?> </h3><button id="closebutton1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php }
if($_GET['success']=="sent") { ?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0001 : Password Sent To Your Mail"; ?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php }
?>
<!--Error Message -->  

  <div class="clearfix"></div>   


</div>
<!------------------------------- Footer ------------------------------------------------->
<div id="footer">
<div class="left"><a href="#">...a solution from KCS</a></div>
<div class="right"><a href="#">
<?php 
/*$time_now=mktime(date('g')+4,date('i')-30,date('s')); 
$time = date('d-M-Y / h:i A',$time_now); 
echo $time;
 */?>
 <span id='ct' ></span></a></div>
</div>
<!------------------------------- Wrapper End ---------------------------------------->
</div>


</body>
</html>