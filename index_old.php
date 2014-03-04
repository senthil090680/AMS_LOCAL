<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="shortcut icon" href="../images/favicon.ico" />
  <title>AMS</title>
  <meta name="description" content=""/>
  <meta name="keywords" content=""/>

  <meta http-equiv="Content-Type"
 content="text/html; charset=iso-8859-1"/>
 <link rel="stylesheet" href="style/superfish.css" media="screen">
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
   <script type = "text/javascript" >

function disableBackButton()
{
window.history.forward();
}
setTimeout("disableBackButton()", 0);

</script> 
  <style type="" >
    body a {color:#ffffff;}
.bottom a{color:#ffffff; text-decoration: none;}
.htmlForm td{
    font-family: Arial;
    font-size:14px;
    color:#3b3b3b;

}
.htmlForm input[type="text"],input[type="password"],select{
    border:1px #00BFFF solid;
    font-family:Arial;
    font-size:14px;
    padding:2px;
     background-color:#F2F5F7;
}




</style>     
</head>
<body>
   
<div class="page">
<div class="top">
<div class="header">
<div class="header-top">
<table width="100%"><tbody><tr><td width="10%"><a href="#"><img alt="fmcl" src="images/logo_fmcl.png" border="0" width="70" height="70"></a></td><td width="78%" align="center"> <em style="color:#0092b3;font-style: normal; font-weight: bold;font-size: 30px;"> Admin Maintenance And Support System</em>
</td><td width="10%" align="right"><a href="#"><img alt="fmcl" src="images/kcs.png" border="0" width="70" height="70"/></a></td></tr></tbody></table>
</div>

<!--<div class="header-img">-->

</div>
</div>
</div>
</div>
 <div class="bodycontent">
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
      <br/>
      <br/>
      <br/>
      <br/>
      
<div class="content">
 
<table align="center" width="30%" cellpadding="3" cellspacing="0"  style="border: 1px solid #00BFFF;border-top:0px;font-family: Arial;font-size: 12px;" >
  <tr>
    <th style="background: url('images/th.png'); height: 29px;color:#ffffff;text-align: left;font-size: 14px;text-align:center">
Login
    </th>
  </tr>
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">
  
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>               <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">

                    <tr>
                       <td  width="150px"><label style="margin-left:60px;">Username<em style="font-style:normal;color:red;">*</em></label></td>
                        <td><input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='login_username_errorloc' class='error'></span></td>
                    </tr>


              <br/>
                    <tr>
                        <td  width="150px"><label style="margin-left:60px;">Password<em style="font-style:normal;color:red;">*</em></label></td>
                        <td  ><input type='password' name='password' id='password' maxlength="50" /><br/>
    <span id='login_password_errorloc' class='error'></span></td>
                    </tr>

<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="right">
                <input class="flatbutton" name="commit"  size="20" type="submit" value="Login" />
              <style>

              </style>
<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide your username");
    
    frmvalidator.addValidation("password","req","Please provide the password");

// ]]>
</script>

            </td>
        </tr>
		<tr >
            <td  width="150px">&nbsp;</td>
            <td align="right">
                <!--<input class="flatbutton" name="signup" onclick="return validate_form()" size="20" type="button" value="Signup" />-->
				<a style="color:blue;"href="register.php">Signup</a>
          


            </td>
        </tr>
		<tr >
            <td  width="150px">&nbsp;</td>
            <td align="right">
             
				<a style="color:blue;"href="#">Forgot Password</a>
          


            </td>
        </tr>
                </table>
                </form>            </td>

        </tr>




    </table>








</div>


 <br></br><br></br>


</div>
<div class="footer"><div class="headedsfdsfr-top">
<table width="98%"><tbody><tr><td width="20%"><a style="color:#0092b3;font-style: normal; font-weight: bold;font-size: 18px;text-decoration:none;" href="#">Powered by kcs</a></td><td width="78%" align="center"> <em style="color:#0092b3;font-style: normal; font-weight: bold;font-size: 18px;">&#169; Copyright 2013 KCS. All rights reserved.</em>
</td><td width="10%"></td></tr></tbody></table>
</div></div>
 
</body>
</html>

