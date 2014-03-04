<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<link media="screen" rel="stylesheet" href="style/fixed_table_header/960.css">
        <link media="screen" rel="stylesheet" href="style/fixed_table_header/defaultTheme.css">
        <link media="screen" rel="stylesheet" href="style/fixed_table_header/myTheme.css">
        <script src="scripts/fixed_table_header/jquery.min.js"></script>
        <script src="scripts/fixed_table_header/jquery.fixedheadertable.min.js"></script>
        <script src="scripts/fixed_table_header/demo.js"></script>
		<script>
		function show_confirm()
{
var r=confirm("Are you sure want to delete");
if (r==true)
  {
  return true;
  }
else
  {
  return false;
  }
}
</script>
<?php
	$fgmembersite->DBLogin();
//PAGE NUMBER, RESULTS PER PAGE, AND OFFSET OF THE RESULTS
if($_GET["page"]){
    $pagenum = $_GET["page"];
} else {
    $pagenum = 1;
}

$rowsperpage = 7; //MAXIMUM RESULTS PER PAGE
$offset = ($pagenum - 1) * $rowsperpage; //WHERE THE RESULTS START FROM

//FOR RESULTS OF THE PAGE
if($_GET["searchvalue"]){
$search=$_GET["searchvalue"];
    $q = mysql_query("SELECT a.id, a.transaction_number,b.generator_name,b.generator_code,c.building_code,c.building_name FROM diesel a ,generator b ,building c where  a.generator_code=b.id and a.building_code=c.id and a.transaction_number like '%$search%' ORDER BY a.id LIMIT $offset, $rowsperpage");
} else {
    $q = mysql_query("SELECT a.id, a.transaction_number,b.generator_name,b.generator_code,c.building_code,c.building_name FROM diesel a ,generator b ,building c where  a.generator_code=b.id and a.building_code=c.id ORDER BY a.id LIMIT $offset, $rowsperpage");
}

$page_nums = mysql_num_rows($q); //NUMBER OF RESULTS FOR THE PAGE
if ($page_nums!=0)
{
if($_GET["searchvalue"]){
$search=$_GET["searchvalue"];
	 $total_q = mysql_query("SELECT a.id, a.transaction_number,b.generator_name,b.generator_code,c.building_code,c.building_name FROM diesel a ,generator b ,building c where  a.generator_code=b.id and a.building_code=c.id and a.transaction_number like '%$search%' "); //FOR THE ALL RESULTS
} else {
    $total_q = mysql_query("SELECT a.id, a.transaction_number,b.generator_name,b.generator_code,c.building_code,c.building_name FROM diesel a ,generator b ,building c where  a.generator_code=b.id and a.building_code=c.id"); //FOR THE ALL RESULTS
}

$total_nums = mysql_num_rows($total_q); //TOTAL NUMBER OF RESULTS
$total_pages = ceil($total_nums/$rowsperpage); //NUMBER OF PAGES
//<table class="myTable01">
//IF PAGE NUMBER IS WITHIN THE FIRST AND LAST PAGES
if($pagenum>=1&&$pagenum<=$total_pages)
{

echo '
<table class="owntable">
<thead>
<tr>
<th>Generator Name</th>
<th>Generator code</th>
<th>Buiding name</th>
<th>Building code</th>
<th>Transaction Number</th>
<th>Edit</th>
<th>Delete</th>

</tr>
</thead>
<tbody>';

    while($r=mysql_fetch_array($q))
    {
	
	
        $content = $r["generator_name"];
		$emp_id = $r["id"];
		$generator_code=$r["generator_code"];
		$buidingname=$r["building_name"];
		$buiding_code=$r["building_code"];
		$transaction_number=$r["transaction_number"];
        echo '<tr><td>'.$content.'</td><td>'.$generator_code.'</td><td>'.$buidingname.'</td><td>'.$buiding_code.'</td><td>'.$transaction_number.'</td><td><a href=edit_diesel.php?id='.$emp_id.'><img src="images/user_edit.png"/></a></td>
		<td><a href=view_diesel.php?delete_id='.$emp_id.'&delete=1><img src="images/delete.png" onclick="return show_confirm()"/></a></td></tr>';
	
    }
    echo '</tbody></table>';
    echo '<br>';
    
    //IF ANY RESULTS
    if($total_nums)
    {
        $range = 4; //NUMBER OF PAGES TO BE SHOWN BEFORE AND AFTER THE CURRENT PAGE NUMBER
        
        //FIRST, PREVIOUS, NEXT, AND LAST LINKS
        if($pagenum>1)
        {
            $page = $pagenum - 1;
            $first = '<a class="page" id="1" >First</a> ';
            $prev = '<a class="page" id="'.$page.'"><<</a> ';
        }
        if($pagenum<$total_pages)
        {
            $page = $pagenum + 1;
            $next = '<a class="page" id="'.$page.'">>></a> ';
            $last = '<a class="page" id="'.$total_pages.'">Last</a> ';
        }
        
        //PAGINATION
        for($page=($pagenum-$range); $page<=($pagenum+$range); $page++)
        {
            if($page>=1&&$page<=$total_pages)
            {
                if($page==$pagenum)
                {
                    $nav .= '<span class="pagenum">'.$page.'</span> ';
                }
                else
                {
                    $nav .= '<a class="page" id="'.$page.'">'.$page.'</a> ';
                }
            }
        }
    }
    
    //DISPAYS IN HTML
	if ($total_nums>$rowsperpage)
	{
	 echo $first . $prev . $nav . $next . $last;
	}
	
} 
else {
    //OTHERWISE...
    header("Location: ajax_view_diesel.php"); //WILL REDIRECT TO THE FIRST PAGE OF RESULTS
}
}
else
{
$q_initial = mysql_query("SELECT * FROM diesel");
$page_nums_initial = mysql_num_rows($q_initial);
if ($page_nums_initial !=0)
{
echo '
<table class="owntable">
<thead>
<tr>
<th>Generator Name</th>
<th>Generator code</th>
<th>Buiding name</th>
<th>Building code</th>
<th>Transaction Number</th>
<th>Edit</th>
<th>Delete</th>

</tr>
</thead>
<tbody>
<tr>
<td align="right" colspan="7">
<font style="font-size: 16px;color:red;padding-right:230px;">No Records Found</font>
</td>


</tr>
</tbody>
</table>
';
}
}
?>
