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
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
	if ($id ==1)
	{
	$header_file='./layout/admin_header_ams.php';
	}
	if($id ==2)
	{
	$header_file='./layout/admin_header_bms.php';
	}
	if($id ==3)
	{
	$header_file='./layout/admin_header_fms.php';
	}
}

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
.sucmsg1 {
    background: none repeat scroll 0 0 #C1C1C1;
    border-radius: 10px;
    color: #003366;
    height: 30px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 5px;
    padding: 7px 0 0;
    text-align: center;
    width: 22%;
}
</style>
<div id="mainarea">
<div style="padding-top:20%;display:none;" class="mydiv">
<h3 align="center" class="sucmsg1">
<?php 
$id=$_GET['id'];
if ($id ==1)
	{
	$value='Admin Support';
	}
	if($id ==2)
	{
	$value='Building Management';
	}
	if($id ==3)
	{
	$value='Fleet Management';
	}
echo "Welcome".  $value; ?>
</h3>
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