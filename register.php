<?PHP
require_once("./include/membersite_config.php");
require_once ("./include/ajax_pagination.php");
$fgmembersite->DBLogin();
EXTRACT($_REQUEST);
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<?php
if ($fgmembersite->usertype() == 1)
{
$header_file='./layout/admin_header_ams.php';
}
if(file_exists($header_file))
{
include_once($header_file);
}
else
{
$fgmembersite->RedirectToURL("index.php");
exit;
}
?> 

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
    right: -190px;
    top: -35px;
}
</style>
   <script>
   $(function () {		

	$('#closebutton1').click(function(event) {
		//alert('232');
		$('#errormsg').hide();
		return false;
	});		
	$('#closebutton').click(function(event) {
		//alert('232');
		$('#errormsgbuild').hide();
		return false;
	});
});
function register()
{
var firstname=document.getElementById("select_name").value;
	if(firstname==0)
	{
		
		$('.myalignbuild').html('ERR 0009 : Select Name');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("select_name").focus();
		return false;
	}
	
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
	var email=document.getElementById("email");
	if(email.value=="")
	{
	$('.myalignbuild').html('ERR 0009 : Enter Email');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
	document.getElementById("email").focus();
	return false;
	}
	else
		{
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			var email_to_lower = document.getElementById("email").value;
			var address=email_to_lower.toLowerCase();
			   if(reg.test(address) == false) 
			{
			      $('.myalignbuild').html('ERR 0009 : Invalid Email Address');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
				document.getElementById("email").focus();
			      return false;
	   					
			}
		 	 
		}
	
		var password=document.getElementById("password").value;
	if(password=="")
	{
	$('.myalignbuild').html('ERR 0009 : Enter password');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("password").focus();
		return false;
	}
	var usertype=document.getElementById("usertype").value;
	if(usertype==0)
	{
		$('.myalignbuild').html('ERR 0009 : Select usertype');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		document.getElementById("usertype").focus();
		return false;
	}
}
</script> 
 <?PHP


if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("register.php?nsuccess=true");
   }
}

?>
  
  <!-- Form Code Start -->
  
  <?php
$fgmembersite->DBLogin();
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
?>


<script type="text/javascript" language="javascript">
   $(document).ready(function() {
	$("#select_name").change(function(event){
	var selvalue=document.getElementById("select_name").value;
	if (selvalue != 0)
	{
		  $.ajax({
				url				:	"getuserdata.php",
				type				:	"post",
				dataType			:	"text",
				cache				:	false,
				data				:	{ "selvalue" : selvalue },
				success				:	function(ajaxval) {
					//alert(ajaxval);
					var splitval	=	ajaxval.split("~");
					$("#email").val(splitval[0]);
					$("#username").val(splitval[1]);
				}
			});
				
	}
	else
	{
	document.getElementById("email").value = "";
	document.getElementById("username").value = "";
	
	}
      });		
   });
   </script>
   <?php
	if(isset($_GET['nsuccess']))
	{
		 if($_GET['nsuccess'] == 'true')
		{
        	 echo "<div style='float:right;width:580px;color:green;font-size:18px;'>User created successfully</div>";
    	}
		else
		{
         	echo '<div class="error">SORRY, PROBLEM SUBMITTING YOUR DATA</div>';
		}
	}
?>
<div id="mainarea"><!--- mainarea  div start-->
<div class="mcf"></div>
<div align="center" class="headingsgr">REGISTRATION</div>
<div id="mytableformreceipt1" align="center">
<div id='fg_membersite'>
<fieldset class="alignment" align="left">
  <legend><strong>Registration</strong></legend>

<!---login--->
<form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8' onsubmit="return register();">
<input type='hidden' name='submitted' id='submitted' value='1'/>
<table width="50%" align="left">
<tr height="30">
<td width="148">Name*</td>
<td>
<?php
$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
echo '<select name="select_name" id="select_name" tabindex="1" style="width:300px;">';
echo '<option value="0">--Employee--</option>';
while($row=mysql_fetch_array($result_emp_id))
{
echo '<option value="'.$row['emp_code'].'">'.$row['first_name'].'</option>';
}
echo '</select>';
?>
</td>
</tr>
<tr height="30">
<td width="148">Email</td>
<td>
<input type='text' name='email' id='email'  value="" size="46" tabindex="3" autocomplete="off"/>
</td>
</tr>
</table>
<table width="50%" align="left">
<tr height="30">
<td width="148">Username</td>
<td>
<input type='text' name='username' id='username'  value=""  size="20" tabindex="2" autocomplete="off"/>
</td>
</tr>
<tr height="30">
<td width="148">Password*</td>
<td>
<input type='password' name='password' id='password' value="" size="20" tabindex="4" autocomplete="off"/>
</td>
</tr>
</table>
<table width="50%" align="left">
<tr height="30">
<td width="120">Usertype*</td>
<td>
<select name="usertype" id="usertype">
<option value="0">--Select--</option>
<option value="1">Admin</option>
<option value="2">Users</option>
</select>
</select>
</td>
</tr>

</table>


</div>

</fieldset>
<br/><br/>
</div>
  <div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
<?php
$error_message=$fgmembersite->GetErrorMessage();
?>
<?php if($error_message!="") {?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo $fgmembersite->GetErrorMessage(); ?></h3><button id="closebutton1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php }?>
<table width="100%" style="clear:both">
  <tbody><tr height="50px;" align="center">
	<td>
		<input type="submit" value="Save" class="buttons" id="save" name="save">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="reset" id="clear" value="Clear" class="buttons" name="reset">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='ams_temp.php?id=1'" class="buttons" value="Cancel" name="cancel">&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="button" onclick="window.location='view_user.php'" class="buttons" value="View" name="View">
	</td>
  </tr>
  </table>
</div>


<!--
Form Code End (see html-form-guide.com for more info.)
-->


<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile))
{
include_once($footerfile);
}
else
{
echo _FILENOTFOUNT.$footerfile;
}
?>

