<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<?php
if ($fgmembersite->usertype() == 1)
{
$header_file='./layout/admin_header_bms.php';
}
else
{
$header_file='./layout/user_header.php';
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
<script>
function clearvalue()
{
document.getElementById("currentpassword").value="";
document.getElementById("password").value="";
document.getElementById("currentpassword").focus();
}
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
		var currentpassword=document.getElementById("currentpassword").value;
		if(currentpassword=="")
		{
			$('.myalignbuild').html('ERR 0009 : Enter Current Password');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			document.getElementById("currentpassword").focus();
			return false;
		}
		var password=document.getElementById("password").value;
		if(password=="")
		{
			$('.myalignbuild').html('ERR 0009 : Enter New Password');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			document.getElementById("password").focus();
			return false;
		}
		
	}
</script>
<?php
if(isset($_POST['save']))
{
$fgmembersite->DBLogin();
$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];
$changepassword=$_POST['password'];
$currentpassword=$_POST['currentpassword'];
$query = "SELECT * FROM users where user_id='$user_id' and username='$username'"; 
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
	$plainpassword=$row['plainpassword'];
	
}
if($currentpassword==$plainpassword)
{
if(!mysql_query("UPDATE users SET password=md5('$changepassword'),plainpassword='$changepassword' WHERE user_id='$user_id' and username='$username'"))
{
die('Error: ' . mysql_error());
}
//echo '<div class="success_message">Your password changed successfully</div>';

$fgmembersite->RedirectToURL("change-pwd.php?success=update");
//echo"Your Password Updated successfully";
}
else
{
$fgmembersite->RedirectToURL("change-pwd.php?success=notmatch");
//echo '<div class="error_message">Your password does not match</div>';

}
}
?>
<div id="mainarea">
<div class="mcf"></div>
<div align="center" class="headings">Change Password</div>
<div id="mytable" align="center">
<form id='confirm' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' onsubmit="return validateForm();">

<table >
  <tr>
    <td >
<input type='hidden' name='submitted' id='submitted' value='1'/>
             <!-- The inner table below is a container for form -->
                <table>
<tr>
<td colspan="2">
&nbsp;&nbsp;&nbsp;
</td>
</tr>
                    <tr>
                       <td  width="150px" >Current password*</td>
                        <td><input type='password' name='currentpassword' id='currentpassword'   maxlength="50" autocomplete="off"/></td>
                    </tr>
					<tr>
                       <td  width="150px"  >New password*</td>
                        <td><input type='password' name='password' id='password' class="textbox" maxlength="50" autocomplete="off" /></td>
                    </tr>
					

<tr>
<td colspan="2">
&nbsp;&nbsp;&nbsp;
</td>
</tr>

               

<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="center">
             <input type='submit'   name='save' value='save' class="buttons"/>
			   &nbsp;&nbsp;&nbsp;&nbsp;
       <input type="reset" name="reset" class="buttons" value="Clear" id="clear" onclick="return clearvalue();"/>&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=2'"/>
        

            </td>
        </tr>
		
		
                </table>
                </form>            </td>

        </tr>
    </table>

</form>
</div>

<div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
  <?php 
if($_GET['success']=="notmatch") { ?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalign"><?php echo "ERR 0009 :Passsword Do Not Match"; ?> </h3><button id="closebutton1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-text">Close</span></button></div>
<?php }
if($_GET['success']=="update") { ?>
<div id="errormsg" class="mydiv"><h3 align="center" class="myalignmsg"><?php echo "MSG 0001 : Password Updated Successfully"; ?> </h3><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button id="closebutton_blue" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" aria-disabled="false" title="Close"><span class="ui-button-icon-primary ui-icon ../images/close_pop.png"></span><span class="ui-button-text">Close</span></button></a></div>
<?php }
?>

</div>
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