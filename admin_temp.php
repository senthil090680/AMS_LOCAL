<?php
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
$header_file='./layout/admin_header_main.php';
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
$(function () {
	setTimeout(function() {
			$('#mydiv1').hide();		
		},1000);
		
	setTimeout( function(){ 
    // Do something after 1 second 
	$('#display_div').show();
  }
 , 1000 );
});
</script>
<div id="mainarea">
<div  style="padding-top:20%;" id="mydiv1">
<h3 align="center" class="sucmsg" >
Welcome <?php echo $_SESSION['username'];?>
</div>
<div  style="padding-top:20%; padding-left:150px; display:none" class="mydivf" id="display_div" >
<br/>
<a href="ams_temp.php?id=1"><img border="0" src="images/fms.png" alt="Admin Support"></img></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="ams_temp.php?id=2"><img border="0" src="images/bms.png" alt="Building Management"></img></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="ams_temp.php?id=3"><img border="0" src="images/ams.png" alt="Fleet Management"></img></a>
</div>

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