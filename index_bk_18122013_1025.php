<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Host System</title>
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
function loginClear()
{
	document.location.href='index.php';
}

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
</head>
 <?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
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
   
<body onLoad="document.getElementById('username').focus();">
<div id="wrapper">
 <!------------------------------- Header Start ---------------------------------------->
 <div id="header">
    <div id="logo">
 <div class="left"><img src="images/logo_fmcl.png" width=60 height="70"/></div>
      <div class="left">
      <h1 align="center">ADMIN MAINTENANCE AND SUPPORT SYSTEM</h1>
     </div> <div class="left"><img src="images/logo_tts.png" width="60" height="70" style="padding-left:260px;"/></div> 
      </div>
 </div>
<!------------------------------- Form -------------------------------------------------->

<div id="mainarea">
<div class="clearfix"></div>
<div align="center" class="headings">LOGIN</div>
<div class="mytablelogin" align="center">
  <form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" style="clear:both;">
      <tr height="50px">
        <td width="29%" class="align" >User Name*</td>
        <td width="32%"><input type="text" name="username" id="username"  class="required" size="20" autocomplete="off"  maxlength="20" onkeypress="return specialChar(event)"/>
		<td width="29%">&nbsp;</td>
		<td width="14%">&nbsp;</td>
      </tr>
      <tr height="50px">
        <td class="align">Password*</td>
        <td><input type="password" name="password"  size="20" autocomplete="off" maxlength="20" />
		<td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
		<tr  height="50px;" align="center">
		<td class="align" ><input type="submit" name="login" id="submit" class="buttons" value="Login" /></td>
		<td><input type="button" name="clear"  class="buttons" value="Clear" id="clear" onclick="return loginClear();"/></td>
		<td><input type="button" name="cancel" value="Forgot Password" class="buttonsfp" onclick="window.location='login/forgotPassword.php'"/></td>
		<td>&nbsp;</td>
		</tr>
		<tr  height="50px;" align="center">
		<td class="align" >&nbsp;</td>
		<!--<td><input type="button" name="submit" class="buttons" value="Sign In" onclick="window.location='login/register.php'"/></td>-->
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
    </table>
  </form>
</div>
<!--Error Message -->  
<div class="clearfix"></div>   


</div>
<!------------------------------- Footer ------------------------------------------------->
<div id="footer">
<div class="left"><a href="#">...a solution from KCS</a></div>
<div class="right"><a href="#"><?php $time_now=mktime(date('g')+4,date('i')-30,date('s')); 
$time = date('d-M-Y / h:i A',$time_now); 
echo $time;
 ?></a></div>
</div>
<!------------------------------- Wrapper End ---------------------------------------->
</div>


</body>
</html>
