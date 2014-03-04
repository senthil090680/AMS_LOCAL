<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

ini_set("display_errors",true);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);

extract($_REQUEST);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

echo "<pre>";
print_r($_FILES);
echo "</pre>";*/
//exit;

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
if ($fgmembersite->usertype() == 1)	{
	$header_file='./layout/admin_header_fms.php';
}
if(file_exists($header_file))	{
	include_once($header_file);
}
else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
$query_edit				=	"SELECT id,vehicle_regno,vehichle_reg_date,vehicle_comp_id,vehicle_company_name,insurance_number,insurance_company,insurance_date,currency,insurance_amount,insurance_duedate,tax_number,tax_authority,tax_date,tax_currency,tax_amount,tax_renewal_date,fitness_certificate_no,fit_date,next_inspection_date,certification_currency,fitness_certification_cost,pollution_certificate_no,pollution_certificate_date,pollution_inspection_date,pollution_currency,pollution_certificate_cost,make,model,year,model_currency,model_cost,maintain_currency,total_maintain_cost,cost_month,total_fuel_cost,cost_month_fuel,car_reg_attach,insurance_attach,tax_attach,pollution_attach,fitness_attach FROM vehicle WHERE id = '$id'";			
$res_edit				=	mysql_query($query_edit) or die(mysql_error());
$rowcnt_edit			=	mysql_num_rows($res_edit);
$row					=	mysql_fetch_array($res_edit);

if($rowcnt_edit > 0 ) {
$row_edit['edit_id']=$row['id'];
$vehicle_regno=$row['vehicle_regno'];
$vehichle_reg_date=$row['vehichle_reg_date'];
$vehicle_comp_id=$row['vehicle_comp_id'];
$vehicle_company_name=$row['vehicle_company_name'];
$insurance_number=$row['insurance_number'];
$insurance_company=$row['insurance_company'];
$insurance_date=$row['insurance_date'];
$currency=$row['currency'];
$insurance_amount=$row['insurance_amount'];
$insurance_duedate=$row['insurance_duedate'];
$tax_number=$row['tax_number'];
$tax_authority=$row['tax_authority'];
$tax_date=$row['tax_date'];
$tax_currency=$row['tax_currency'];
$tax_amount=$row['tax_amount'];
$tax_renewal_date=$row['tax_renewal_date'];
$fitness_certificate_no=$row['fitness_certificate_no'];
$fit_date=$row['fit_date'];
$next_inspection_date=$row['next_inspection_date'];
$certification_currency=$row['certification_currency'];
$fitness_certification_cost=$row['fitness_certification_cost'];
$pollution_certificate_no=$row['pollution_certificate_no'];
$pollution_certificate_date=$row['pollution_certificate_date'];
$pollution_inspection_date=$row['pollution_inspection_date'];
$pollution_currency=$row['pollution_currency'];
$pollution_certificate_cost=$row['pollution_certificate_cost'];
$make=$row['make'];
$model=$row['model'];
$year=$row['year'];
$model_currency=$row['model_currency'];
$model_cost=$row['model_cost'];
$maintain_currency=$row['maintain_currency'];
$total_maintain_cost=$row['total_maintain_cost'];
$cost_month=$row['cost_month'];
$total_fuel_cost=$row['total_fuel_cost'];
$cost_month_fuel=$row['cost_month_fuel'];
$car_reg_attach=$row['car_reg_attach'];
$insurance_attach=$row['insurance_attach'];
$tax_attach=$row['tax_attach'];
$pollution_attach=$row['pollution_attach'];
$fitness_attach=$row['fitness_attach'];
}
//echo $fgmembersite->pre($row_edit);
?>
<script type="text/javascript">
$(document).ready(function(){
    $('#car_reg_attach').change(function() {
	
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('car_reg_attach').files[0];
        if(file[index]) {
            fileUrl[index] = 'fms_uploads/' + file[index].name;
            checkFile[index] = new XMLHttpRequest();
            checkFile[index].onreadystatechange = function() {
                if (checkFile[index].readyState == 4) {
                    if (checkFile[index].status == 200) {
                        existing[index] = true; 
                        counter += 1;
                    }
                    else {
                        existing[index] = false;
                        counter += 1;
                    }
                    if (counter == fileUrl.length) { 
                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
                        if (existing.indexOf(true) == -1) {
                            //none of the files to be uploaded are already on server
							var filenamee=document.getElementById("car_reg_attach").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
								return true;
							}
							else
							{
								/*alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
								document.getElementById("saleagreement").value="";
								return false;*/
								$('.myalignbuild').html('ERR : Invalid File Extension, Only (pdf, gif, jpg, png) Are Allowed');
								$('#errormsgbuild').css('display','block');
								setTimeout(function() {
									//$('#errormsgbuild').hide();
								},5000);
								$("#car_reg_attach").focus();
								$("#car_reg_attach").val('');
							}
							//return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							/*alert("The file name already exits");
							document.getElementById("saleagreement").value="";
                            return false;*/
							$('.myalignbuild').html('ERR : This Filename Already Exits');
							$('#errormsgbuild').css('display','block');
							setTimeout(function() {
								$('#errormsgbuild').hide();
							},5000);
							$("#car_reg_attach").focus();
							$("#car_reg_attach").val('');
                        }
                    }
                }
            }
            checkFile[index].open('HEAD', fileUrl[index], true);
            checkFile[index].send();
        }
    })(i);
}
      return false;
   });
 }); 

$(document).ready(function(){
    $('#insurance_attach').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('insurance_attach').files[0];
        if(file[index]) {
            fileUrl[index] = 'fms_uploads/' + file[index].name;
            checkFile[index] = new XMLHttpRequest();
            checkFile[index].onreadystatechange = function() {
                if (checkFile[index].readyState == 4) {
                    if (checkFile[index].status == 200) {
                        existing[index] = true; 
                        counter += 1;
                    }
                    else {
                        existing[index] = false;
                        counter += 1;
                    }
                    if (counter == fileUrl.length) { 
                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
                        if (existing.indexOf(true) == -1) {
                            //none of the files to be uploaded are already on server
							var filenamee=document.getElementById("insurance_attach").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
								/*alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
								document.getElementById("leasedeed").value="";
								return false;*/

								$('.myalignbuild').html('ERR : Invalid File Extension, Only (pdf, gif, jpg, png) Are Allowed');
								$('#errormsgbuild').css('display','block');
								setTimeout(function() {
									//$('#errormsgbuild').hide();
								},5000);
								$("#insurance_attach").focus();
								$("#insurance_attach").val('');
							}
							//return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							/*alert("The file name already exits");
							document.getElementById("leasedeed").value="";
                            return false;*/

							$('.myalignbuild').html('ERR : This Filename Already Exits');
							$('#errormsgbuild').css('display','block');
							setTimeout(function() {
								$('#errormsgbuild').hide();
							},5000);
							$("#insurance_attach").focus();
							$("#insurance_attach").val('');
                        }
                    }
                }
            }
            checkFile[index].open('HEAD', fileUrl[index], true);
            checkFile[index].send();
        }
    })(i);
  }
      return false;
   });
 });

$(document).ready(function(){
$('#tax_attach').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('tax_attach').files[0];
        if(file[index]) {
            fileUrl[index] = 'fms_uploads/' + file[index].name;
            checkFile[index] = new XMLHttpRequest();
            checkFile[index].onreadystatechange = function() {
                if (checkFile[index].readyState == 4) {
                    if (checkFile[index].status == 200) {
                        existing[index] = true; 
                        counter += 1;
                    }
                    else {
                        existing[index] = false;
                        counter += 1;
                    }
                    if (counter == fileUrl.length) { 
                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
                        if (existing.indexOf(true) == -1) {
                            //none of the files to be uploaded are already on server
							var filenamee=document.getElementById("tax_attach").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
								/*alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
								document.getElementById("insuranceagreement").value="";
								return false;*/
								$('.myalignbuild').html('ERR : Invalid File Extension, Only (pdf, gif, jpg, png) Are Allowed');
								$('#errormsgbuild').css('display','block');
								setTimeout(function() {
									//$('#errormsgbuild').hide();
								},5000);
								$("#tax_attach").focus();
								$("#tax_attach").val('');
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							/*alert("The file name already exits");
							document.getElementById("insuranceagreement").value="";
                            return false;*/
							$('.myalignbuild').html('ERR : This Filename Already Exits');
							$('#errormsgbuild').css('display','block');
							setTimeout(function() {
								//$('#errormsgbuild').hide();
							},5000);
							$("#tax_attach").focus();
							$("#tax_attach").val('');
                        }
                    }
                }
            }
            checkFile[index].open('HEAD', fileUrl[index], true);
            checkFile[index].send();
        }
    })(i);
}
      return false;
   });
 }); 

$(document).ready(function(){
	$('#pollution_attach').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('pollution_attach').files[0];
        if(file[index]) {
            fileUrl[index] = 'fms_uploads/' + file[index].name;
            checkFile[index] = new XMLHttpRequest();
            checkFile[index].onreadystatechange = function() {
                if (checkFile[index].readyState == 4) {
                    if (checkFile[index].status == 200) {
                        existing[index] = true; 
                        counter += 1;
                    }
                    else {
                        existing[index] = false;
                        counter += 1;
                    }
                    if (counter == fileUrl.length) { 
                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
                        if (existing.indexOf(true) == -1) {
                            //none of the files to be uploaded are already on server
							var filenamee=document.getElementById("pollution_attach").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
								/*alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
								document.getElementById("attach4").value="";
								return false;*/
								$('.myalignbuild').html('ERR : Invalid File Extension, Only (pdf, gif, jpg, png) Are Allowed');
								$('#errormsgbuild').css('display','block');
								setTimeout(function() {
									$('#errormsgbuild').hide();
								},5000);
								$("#pollution_attach").focus();
								$("#pollution_attach").val('');
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							/*alert("The file name already exits");
							document.getElementById("attach4").value="";
                            return false;*/
							$('.myalignbuild').html('ERR : This Filename Already Exits');
							$('#errormsgbuild').css('display','block');
							setTimeout(function() {
								$('#errormsgbuild').hide();
							},5000);
							$("#pollution_attach").focus();
							$("#pollution_attach").val('');
                        }
                    }
                }
            }
            checkFile[index].open('HEAD', fileUrl[index], true);
            checkFile[index].send();
        }
    })(i);
}
      return false;
   });
 }); 

$(document).ready(function(){
    $('#fitness_attach').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('fitness_attach').files[0];
        if(file[index]) {
            fileUrl[index] = 'fms_uploads/' + file[index].name;
            checkFile[index] = new XMLHttpRequest();
            checkFile[index].onreadystatechange = function() {
                if (checkFile[index].readyState == 4) {
                    if (checkFile[index].status == 200) {
                        existing[index] = true; 
                        counter += 1;
                    }
                    else {
                        existing[index] = false;
                        counter += 1;
                    }
                    if (counter == fileUrl.length) { 
                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
                        if (existing.indexOf(true) == -1) {
                            //none of the files to be uploaded are already on server
							var filenamee=document.getElementById("fitness_attach").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
								/*alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
								document.getElementById("attach5").value="";
								return false;*/
								$('.myalignbuild').html('ERR : Invalid File Extension, Only (pdf, gif, jpg, png) Are Allowed');
								$('#errormsgbuild').css('display','block');
								setTimeout(function() {
									$('#errormsgbuild').hide();
								},5000);
								$("#fitness_attach").focus();
								$("#fitness_attach").val('');
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							/*alert("The file name already exits");
							document.getElementById("attach5").value="";
                            return false;*/
							$('.myalignbuild').html('ERR : This Filename Already Exits');
							$('#errormsgbuild').css('display','block');
							setTimeout(function() {
								$('#errormsgbuild').hide();
							},5000);
							$("#fitness_attach").focus();
							$("#fitness_attach").val('');
                        }
                    }
                }
            }
            checkFile[index].open('HEAD', fileUrl[index], true);
            checkFile[index].send();
        }
    })(i);
}
      return false;
   });
 }); 

function myFunction() {
	document.getElementById("city").value="";
	document.getElementById("city").focus();
	return false;
}
$(document).ready(function() {
	$("#city").change(function(event) {
			var selvalue=document.getElementById("city").value;
			if (selvalue != 0) {
				$('#display_state').load('ajax_building.php?selvalue='+selvalue);
			}
			else {
				document.getElementById("state").value = "";			
			}
		});		
	$("#city_landlord").change(function(event) {
			var selvalue_landlord=document.getElementById("city_landlord").value;
			if (selvalue_landlord != 0) {
				  $('#display_state_landlord').load('ajax_building.php?selvalue_landlord='+selvalue_landlord);
			}
			else {
				document.getElementById("state_landlord").value = "";		
			}
		});		
	$("#emp_code").change(function(event){
		var selvalue_empcode=document.getElementById("emp_code").value;
		if (selvalue_empcode != 0) {
			  $('#display_empname').load('ajax_building.php?selvalue_empcode='+selvalue_empcode);
		}
		else {
			document.getElementById("empname").value = "";	
		}
    });		
	$("#incharge_empcode").change(function(event) {
		var selvalue_incharge_empcode=document.getElementById("incharge_empcode").value;
		if (selvalue_incharge_empcode != 0)
		{
			$('#display_inchargename').load('ajax_building.php?selvalue_incharge_empcode='+selvalue_incharge_empcode);
		}
		else
		{
			document.getElementById("leadername").value = "";
		}
    });		
});
</script>
<?php
if(isset($_POST['formsaveval']) && $_POST['formsaveval'] == 'Edit') {
	
	echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";
	//echo "ere";
	//exit;
if(isset($_FILES["car_reg_attach"]["name"])) {
	$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
	$temp = explode(".", $_FILES["car_reg_attach"]["name"]);
	$extension = end($temp);
	if (in_array($extension, $allowedExts)) {
		if ($_FILES["car_reg_attach"]["error"] > 0) {
			echo "Return Code: " . $_FILES["car_reg_attach"]["error"] . "<br>";
		} else {
			if (file_exists("fms_uploads/" . $_FILES["car_reg_attach"]["name"])) {
				//echo $_FILES["saleagreement"]["name"] . " already exists. ";
				$car_reg_attach=$car_doc_attach;
			} else {
				$car_reg_attach=$_FILES["car_reg_attach"]["name"];
				move_uploaded_file($_FILES["car_reg_attach"]["tmp_name"],"fms_uploads/" . $_FILES["car_reg_attach"]["name"]);
				//echo "Stored in: " . "uploads/" . $_FILES["saleagreement"]["name"];
			}
		}
	}	else {
			$car_reg_attach=$car_doc_attach;
		}
	}
//
	if(isset($_FILES["insurance_attach"]["name"])) {
		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["insurance_attach"]["name"]);
		$extension = end($temp);
		if(in_array($extension, $allowedExts))
		{
			if ($_FILES["insurance_attach"]["error"] > 0) {
				echo "Return Code: " . $_FILES["insurance_attach"]["error"] . "<br>";
			}
			else {
				if (file_exists("fms_uploads/" . $_FILES["insurance_attach"]["name"])) {
				  //echo $_FILES["leasedeed"]["name"] . " already exists. ";
				  $insurance_attach=$ins_doc_attach;
				}
				else {
				  $insurance_attach=$_FILES["insurance_attach"]["name"];
				  move_uploaded_file($_FILES["insurance_attach"]["tmp_name"],
				  "fms_uploads/" . $_FILES["insurance_attach"]["name"]);
				 // echo "Stored in: " . "uploads/" . $_FILES["leasedeed"]["name"];
				  }
			}
		} else {
			$insurance_attach=$ins_doc_attach;
		}
	}

	if(isset($_FILES["tax_attach"]["name"])) {

		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["tax_attach"]["name"]);
		$extension = end($temp);
		if (in_array($extension, $allowedExts)) {
			if($_FILES["tax_attach"]["error"] > 0) {
				echo "Return Code: " . $_FILES["tax_attach"]["error"] . "<br>";
			} else {
				if(file_exists("fms_uploads/" . $_FILES["tax_attach"]["name"])) {
					//echo $_FILES["attach4"]["name"] . " already exists. ";
					$tax_attach=$tax_doc_attach;
				} else {
					$tax_attach=$_FILES["tax_attach"]["name"];
					move_uploaded_file($_FILES["tax_attach"]["tmp_name"],"fms_uploads/" . $_FILES["tax_attach"]["name"]);
					//echo "Stored in: " . "uploads/" . $_FILES["attach4"]["name"];
				}
			}
		} else {
			$tax_attach=$tax_doc_attach;
		}
	}
	//
	//
	if(isset($_FILES["pollution_attach"]["name"])) {
		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["pollution_attach"]["name"]);
		$extension = end($temp);
		if (in_array($extension, $allowedExts)) {
			if ($_FILES["pollution_attach"]["error"] > 0) {
				echo "Return Code: " . $_FILES["pollution_attach"]["error"] . "<br>";
			} else {
				if (file_exists("fms_uploads/" . $_FILES["pollution_attach"]["name"])) {
					//echo $_FILES["attach5"]["name"] . " already exists. ";
					$pollution_attach=$pol_doc_attach;
				} else {
					$pollution_attach=$_FILES["pollution_attach"]["name"];
					move_uploaded_file($_FILES["pollution_attach"]["tmp_name"],"fms_uploads/" . $_FILES["pollution_attach"]["name"]);
					//echo "Stored in: " . "uploads/" . $_FILES["attach5"]["name"];
				}
			}
		} else {
				$pollution_attach=$pol_doc_attach;
		}
	}
	//
	//
	if(isset($_FILES["fitness_attach"]["name"]))
	{
	$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
	$temp = explode(".", $_FILES["fitness_attach"]["name"]);
	$extension = end($temp);
	if (in_array($extension, $allowedExts))
	  {
	  if ($_FILES["fitness_attach"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["fitness_attach"]["error"] . "<br>";
		}
	  else
		{
		if (file_exists("fms_uploads/" . $_FILES["fitness_attach"]["name"]))
		  {
		  //echo $_FILES["attach6"]["name"] . " already exists. ";
		  $fitness_attach=$fit_doc_attach;
		  }
		else
		  {
		  $fitness_attach=$_FILES["fitness_attach"]["name"];
		  move_uploaded_file($_FILES["fitness_attach"]["tmp_name"],"fms_uploads/" . $_FILES["fitness_attach"]["name"]);
		 // echo "Stored in: " . "uploads/" . $_FILES["attach6"]["name"];
		  }
		}
	  }
		else
		{
		 $fitness_attach=$fit_doc_attach;
		}
	}
	//
	$user_id							=	$_SESSION['user_id'];
	$vregno								=	$_POST['vregno'];
	$vdate								=	$_POST['vdate'];
	$comp_id							=	$_POST['comp_id'];
	
	$fgmembersite->DBLogin();
	$bd 	=	mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
	mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
	$result_emp_id=mysql_query("select * from master_companies where comp_id=$comp_id",$bd);
	while($row=mysql_fetch_array($result_emp_id)) {
		$comp_name=$row['comp_name'];
	}
	$fgmembersite->DBLogin();
	$company_name						=	$comp_name;
	$insurance_number					=	$_POST['insurance_number'];
	$insurance_company					=	$_POST['insurance_company'];
	$insurance_date						=	$_POST['insurance_date'];
	$currency							=	$fgmembersite->getdbval($_POST['currency'],'id','name','currency');
	$insurance_amount					=	$_POST['insurance_amount'];
	$insurance_duedate					=	$_POST['insurance_duedate'];
	$tax_number							=	$_POST['tax_number'];
	$tax_authority						=	$_POST['tax_authority'];
	$tax_date							=	$_POST['tax_date'];
	$tax_currency						=	$fgmembersite->getdbval($_POST['tax_currency'],'id','name','currency');
	$tax_amount							=	$_POST['tax_amount'];
	$tax_renewal_date					=	$_POST['tax_renewal_date'];
	$fit_certificate_no					=	$_POST['fit_certificate_no'];
	$next_inspection_date				=	$_POST['next_inspection_date'];
	$certification_currency				=	$fgmembersite->getdbval($_POST['certification_currency'],'id','name','currency');
	$certification_cost					=	$_POST['certification_cost'];
	$pollution_certificate_no			=	$_POST['pollution_certificate_no'];
	$pollution_certificate_date			=	$_POST['pollution_certificate_date'];
	$pollution_inspection_date			=	$_POST['pollution_inspection_date'];
	$pollution_currency					=	$fgmembersite->getdbval($_POST['pollution_currency'],'id','name','currency');
	$pollution_certificate_cost			=	$_POST['pollution_certificate_cost'];
	$make								=	$_POST['make'];
	$model								=	$_POST['model'];
	$year								=	$_POST['year'];
	$model_currency						=	$fgmembersite->getdbval($_POST['model_currency'],'id','name','currency');
	$model_cost							=	$_POST['model_cost'];
	$maintain_currency					=	'';
	$total_maintain_cost				=	'';
	$cost_month							=	'';
	$total_fuel_cost					=	'';
	$cost_month_fuel					=	'';
	$car_reg_attach						=	$car_reg_attach;
	$insurance_attach					=	$insurance_attach;
	$tax_attach							=	$tax_attach;
	$pollution_attach					=	$pollution_attach;
	$fitness_attach						=	$fitness_attach;

	$sql=('UPDATE vehicle SET vehicle_regno="'.$vregno.'",vehichle_reg_date="'.$vdate.'",vehicle_comp_id="'.$comp_id.'",vehicle_company_name="'.$company_name.'",insurance_number="'.$insurance_number.'",insurance_company="'.$insurance_company.'",insurance_date="'.$insurance_date.'",currency="'.$currency.'",insurance_amount="'.$insurance_amount.'",insurance_duedate="'.$insurance_duedate.'",tax_number="'.$tax_number.'",tax_authority="'.$tax_authority.'",tax_date="'.$tax_date.'",tax_currency="'.$tax_currency.'",tax_amount="'.$tax_amount.'",tax_renewal_date="'.$tax_renewal_date.'",fitness_certificate_no="'.$fit_certificate_no.'",fit_date="'.$fit_date.'",next_inspection_date="'.$next_inspection_date.'",certification_currency="'.$certification_currency.'",fitness_certification_cost="'.$certification_cost.'",pollution_certificate_no="'.$pollution_certificate_no.'",pollution_certificate_date="'.$pollution_certificate_date.'",pollution_inspection_date="'.$pollution_inspection_date.'",pollution_currency="'.$pollution_currency.'",pollution_certificate_cost="'.$pollution_certificate_cost.'",make="'.$make.'",model="'.$model.'",year="'.$year.'",model_currency="'.$model_currency.'",model_cost="'.$model_cost.'",maintain_currency="'.$maintain_currency.'",total_maintain_cost="'.$total_maintain_cost.'",cost_month="'.$cost_month.'",total_fuel_cost="'.$total_fuel_cost.'",cost_month_fuel="'.$cost_month_fuel.'",car_reg_attach="'.$car_reg_attach.'",insurance_attach="'.$insurance_attach.'",tax_attach="'.$tax_attach.'",pollution_attach="'.$pollution_attach.'",fitness_attach="'.$fitness_attach.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" ');

	//echo $sql;
	//exit;
			
	if($edit_id_val == '') {
		if(!mysql_query('UPDATE vehicle SET vehicle_regno="'.$vregno.'",vehichle_reg_date="'.$vdate.'",vehicle_comp_id="'.$comp_id.'",vehicle_company_name="'.$company_name.'",insurance_number="'.$insurance_number.'",insurance_company="'.$insurance_company.'",insurance_date="'.$insurance_date.'",currency="'.$currency.'",insurance_amount="'.$insurance_amount.'",insurance_duedate="'.$insurance_duedate.'",tax_number="'.$tax_number.'",tax_authority="'.$tax_authority.'",tax_date="'.$tax_date.'",tax_currency="'.$tax_currency.'",tax_amount="'.$tax_amount.'",tax_renewal_date="'.$tax_renewal_date.'",fitness_certificate_no="'.$fit_certificate_no.'",fit_date="'.$fit_date.'",next_inspection_date="'.$next_inspection_date.'",certification_currency="'.$certification_currency.'",fitness_certification_cost="'.$certification_cost.'",pollution_certificate_no="'.$pollution_certificate_no.'",pollution_certificate_date="'.$pollution_certificate_date.'",pollution_inspection_date="'.$pollution_inspection_date.'",pollution_currency="'.$pollution_currency.'",pollution_certificate_cost="'.$pollution_certificate_cost.'",make="'.$make.'",model="'.$model.'",year="'.$year.'",model_currency="'.$model_currency.'",model_cost="'.$model_cost.'",maintain_currency="'.$maintain_currency.'",total_maintain_cost="'.$total_maintain_cost.'",cost_month="'.$cost_month.'",total_fuel_cost="'.$total_fuel_cost.'",cost_month_fuel="'.$cost_month_fuel.'",car_reg_attach="'.$car_reg_attach.'",insurance_attach="'.$insurance_attach.'",tax_attach="'.$tax_attach.'",pollution_attach="'.$pollution_attach.'",fitness_attach="'.$fitness_attach.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" ')) {
			die('Error: ' . mysql_error());
		}
		$fgmembersite->RedirectToURL("view_vehicle_sample.php?success=update");
		echo "&nbsp;";
	} elseif($edit_id_val != '') {
		if(!mysql_query('UPDATE vehicle SET vehicle_regno="'.$vregno.'",vehichle_reg_date="'.$vdate.'",vehicle_comp_id="'.$comp_id.'",vehicle_company_name="'.$company_name.'",insurance_number="'.$insurance_number.'",insurance_company="'.$insurance_company.'",insurance_date="'.$insurance_date.'",currency="'.$currency.'",insurance_amount="'.$insurance_amount.'",insurance_duedate="'.$insurance_duedate.'",tax_number="'.$tax_number.'",tax_authority="'.$tax_authority.'",tax_date="'.$tax_date.'",tax_currency="'.$tax_currency.'",tax_amount="'.$tax_amount.'",tax_renewal_date="'.$tax_renewal_date.'",fitness_certificate_no="'.$fit_certificate_no.'",fit_date="'.$fit_date.'",next_inspection_date="'.$next_inspection_date.'",certification_currency="'.$certification_currency.'",fitness_certification_cost="'.$certification_cost.'",pollution_certificate_no="'.$pollution_certificate_no.'",pollution_certificate_date="'.$pollution_certificate_date.'",pollution_inspection_date="'.$pollution_inspection_date.'",pollution_currency="'.$pollution_currency.'",pollution_certificate_cost="'.$pollution_certificate_cost.'",make="'.$make.'",model="'.$model.'",year="'.$year.'",model_currency="'.$model_currency.'",model_cost="'.$model_cost.'",maintain_currency="'.$maintain_currency.'",total_maintain_cost="'.$total_maintain_cost.'",cost_month="'.$cost_month.'",total_fuel_cost="'.$total_fuel_cost.'",cost_month_fuel="'.$cost_month_fuel.'",car_reg_attach="'.$car_reg_attach.'",insurance_attach="'.$insurance_attach.'",tax_attach="'.$tax_attach.'",pollution_attach="'.$pollution_attach.'",fitness_attach="'.$fitness_attach.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" ')) {
			die('Error: ' . mysql_error());
		}
		?>
		<script type="text/javascript">
			alert("Data Saved Successfully");
		</script>
		<?php
		$fgmembersite->RedirectToURL("edit_vehicle_sample.php?id=$edit_id&secpage=1");
		echo "&nbsp;";
	}
}
?>
<style type="text/css">
.confirmMAp {
	margin:0 auto;
	display:none;
	background:#EEEEEE;
	color:#fff;
	width:622px;
	height:350px;
	position:fixed;
	left:250px;
	top:100px;
	border:1px solid #EEEEEE;
	z-index:2;
	border-radius:5px 5px 5px 5px;
}
.ShowMap{
	display:none;
	z-index:2;
	position:fixed;
	_position:absolute; /* hack for internet explorer */
	width:620px;
	height:320px;
	color:#FFF;
	border-radius:5px;
	background-color:#FFF;
	border:1px solid #cecece;
}

#mainareabuild {
	width:100%;
	height:550px;
	background:#ebebeb;
	/* overflow-y:auto; */
}
.myalignbuild {
	padding-top:8px;
	margin:0 auto;
	color:#FF0000;
}
#mytableformbuild {
    background: none repeat scroll 0 0 #FFFFFF;
    height: auto;
    margin-left: auto;
    margin-right: auto;
    width: 95%;
}
#errormsgbuild{
	width:45%;
	height:30px;
	background:#c1c1c1;
	margin-left:auto;
	margin-right:auto;
	border-radius:10px;
	padding-top:0px;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	-ms-border-radius:10px;
	-o-border-radius:10px;
	text-align:center;
}
#closebutton {
  position:relative;
  top:-35px;
  right:-219px;
  border:none;
  background:url(images/close_pop.png) no-repeat;
  color:transparent;
}
.scroll_box {
	height:440px;
	overflow:auto;
}
.alignment2 {
    font-size: 16px;
    margin-left: 10px;
    padding-left: 20px;
    width: 95%;
}
.alignment3 {
	font-size: 16px;
    margin-left: 10px;
    padding-left: 2px;
    width: 90%;
}
</style>
<?php if($secpage == 1) { ?>
<script type="text/javascript">
$(document).ready(function() {
	$(window).load(function() {
		$("#firstdiv").css('display','none');
		$("#secdiv").css('display','block');
		$("#secdiv").css('display','block');
		$("#thirddiv").css('display','none');
		$("#fourdiv").css('display','none');

		$("#prev_span").css('display','inline');
		$("#sec_span").css('display','inline');
		$("#first_span").css('display','none');
		$("#part_span").css('display','none');
		$("#third_span").css('display','none');
		$("#four_span").css('display','none');
		$("#five_span").css('display','none');
		$("#six_span").css('display','none');
	});
});
</script>
<?php
} else { ?>
<script type="text/javascript">
	$(document).ready(function() {
		$(window).load(function() {
			$("#firstdiv").css('display','block');
			$("#secdiv").css('display','none');
			$("#thirddiv").css('display','none');
			$("#fourdiv").css('display','none');

			$("#prev_span").css('display','none');
			$("#sec_span").css('display','none');
			$("#third_span").css('display','none');
			$("#four_span").css('display','none');
			$("#five_span").css('display','none');
			$("#six_span").css('display','none');
		});
	});
</script>
<?php } ?>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$(function () {
		/*$('#closebutton').button({
			icons: {
				primary : "../images/close_pop.png",
			},
			text:false
		});*/
		
		$('#closebutton').click(function(event) {
			//alert('232');
			$('#errormsgbuild').hide();
			return false;
		});		
	});	
	
	$("#insurance_number").on('blur',function() {

		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression))
		{
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x = $(this).val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	});
	$("#model_cost").on('blur',function() {

		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression))
		{
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x = $(this).val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});
	$("#insurance_amount").on('blur',function() {
		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression)) {
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x		=	$(this).val();
		var x		=	(x.toString().replace(/,/g,""));
		var x		=	(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});
	$("#tax_number").on('blur',function() {
		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression)) {
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x		=	$(this).val();
		var x		=	(x.toString().replace(/,/g,""));
		var x		=	(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});

	$("#tax_amount").on('blur',function() {
		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression)) {
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x		=	$(this).val();
		var x		=	(x.toString().replace(/,/g,""));
		var x		=	(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});

	$("#fit_certificate_no").on('blur',function() {
		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression)) {
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x		=	$(this).val();
		var x		=	(x.toString().replace(/,/g,""));
		var x		=	(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});

	$("#certification_cost").on('blur',function() {
		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression)) {
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x		=	$(this).val();
		var x		=	(x.toString().replace(/,/g,""));
		var x		=	(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});

	$("#pollution_certificate_no").on('blur',function() {
		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression)) {
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x		=	$(this).val();
		var x		=	(x.toString().replace(/,/g,""));
		var x		=	(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});

	$("#pollution_certificate_cost").on('blur',function() {
		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression)) {
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x		=	$(this).val();
		var x		=	(x.toString().replace(/,/g,""));
		var x		=	(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});

	$("#prevfirsta").on("click",function() {
		$("#firstdiv").css('display','block');
		$("#secdiv").css('display','none');
		$("#thirddiv").css('display','none');
		$("#fourdiv").css('display','none');

		$("#first_span").css('display','inline');
		$("#part_span").css('display','inline');

		$("#prev_span").css('display','none');
		$("#sec_span").css('display','none');
		$("#third_span").css('display','none');
		$("#four_span").css('display','none');
		$("#five_span").css('display','none');
		$("#six_span").css('display','none');
	});

	$("#thirda").on("click",function() {

		$("#firstdiv").css('display','none');
		$("#secdiv").css('display','block');
		$("#thirddiv").css('display','none');
		$("#fourdiv").css('display','none');

		$("#prev_span").css('display','inline');
		$("#sec_span").css('display','inline');
		$("#first_span").css('display','none');
		$("#third_span").css('display','none');
		$("#four_span").css('display','none');
		$("#five_span").css('display','none');
		$("#six_span").css('display','none');
	});
	
	$("#firsta").on("click", function() {
		//alert("232");
		var vregno						=	$("#vregno").val();
		var vdate						=	$("#vdate").val();
		var comp_id						=	$("#comp_id").val();
		var insurance_number			=	$("#insurance_number").val();
		var insurance_company			=	$("#insurance_company").val();
		var insurance_date				=	$("#insurance_date").val();
		var currency					=	$("#currency").val();
		var insurance_amount			=	$("#insurance_amount").val();
		var insurance_duedate			=	$("#insurance_duedate").val();
		var tax_number					=	$("#tax_number").val();
		var tax_authority				=	$("#tax_authority").val();
		var tax_date					=	$("#tax_date").val();
		var tax_currency				=	$("#tax_currency").val();
		var tax_amount					=	$("#tax_amount").val();
		var tax_renewal_date			=	$("#tax_renewal_date").val();
		var make						=	$("#make").val();
		var model						=	$("#model").val();
		var year						=	$("#year").val();		
		var model_currency				=	$("#model_currency").val();
		var model_cost					=	$("#model_cost").val();											

		var	currentdate					=	new Date();

		/*alert(currentdate.getFullYear());
		alert(currentdate.getMonth());
		alert(currentdate.getDate());*/
		var currentdateval							=	currentdate.getDate()+"-"+(parseInt(currentdate.getMonth())+1)+"-"+currentdate.getFullYear();
		//alert(currentdateval);		
		
		if(vregno == '') {
			$('.myalignbuild').html('ERR : Enter Registration No.');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#vregno").focus();
			return false;
		} else if(vdate == '') {
			$('.myalignbuild').html('ERR : Select Regn. Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#vdate").focus();
			return false;
		} else if (vdate > currentdateval){
			$('.myalignbuild').html('ERR : Date Greater Than Today!');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#vdate").focus();
			return false;
		}	else if(comp_id == '0') {
			$('.myalignbuild').html('ERR : Select Regd. Company');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#comp_id").focus();
			return false;
		}  else if(year == '0') {
			$('.myalignbuild').html('ERR : Select Year');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#year").focus();
			return false;
		} else if(make == '') {
			$('.myalignbuild').html('ERR : Enter Make');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#make").focus();
			return false;
		} else if(model == '') {
			$('.myalignbuild').html('ERR : Enter Model');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#model").focus();
			return false;
		} else if (model_currency == ''){
			$('.myalignbuild').html('ERR : Enter Currency');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#model_currency").focus();
			return false;
		} else if(model_cost == '') {
			$('.myalignbuild').html('ERR : Enter Cost');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#model_cost").focus();
			return false;
		} else if (insurance_number == ''){
			$('.myalignbuild').html('ERR : Enter Insurance No.');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_number").focus();
			return false;
		} else if (insurance_company	== ''){
			$('.myalignbuild').html('ERR : Enter Insurance Company');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_company").focus();
			return false;
		} else if (insurance_amount == ''){
			$('.myalignbuild').html('ERR : Enter Insurance Amount');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_amount").focus();
			return false;
		} if (insurance_date == ''){
			$('.myalignbuild').html('ERR : Enter Insurance Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_date").focus();
			return false;
		} 
		if (insurance_date > currentdateval){
			$('.myalignbuild').html('ERR : Insurance Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_date").focus();
			return false;
		}		
		if (insurance_duedate < currentdateval && insurance_duedate != currentdateval){
			alert('edssdfsd');
			$('.myalignbuild').html('ERR : Ins. Renewal Date Less Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_duedate").focus();
			return false;
		}

		if (tax_date > currentdateval){
			$('.myalignbuild').html('ERR : Tax Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#tax_date").focus();
			return false;
		}
		if (tax_renewal_date < currentdateval && tax_renewal_date != currentdateval){
			$('.myalignbuild').html('ERR : Tax Renewal Date Less Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#tax_renewal_date").focus();
			return false;
		}
				
		$("#firstdiv").css('display','none');
		$("#secdiv").css('display','block');
		$("#thirddiv").css('display','none');
		$("#fourdiv").css('display','none');
		$("#fivediv").css('display','none');
		$("#sixdiv").css('display','none');

		$("#prev_span").css('display','inline');
		$("#sec_span").css('display','inline');
		$("#first_span").css('display','none');

		$("#part_span").css('display','none');

		$("#third_span").css('display','none');
		$("#four_span").css('display','none');
		$("#five_span").css('display','none');
		$("#six_span").css('display','none');
	});	

	$("#part_save").on("click", function() {
		//alert("232");
		var vregno						=	$("#vregno").val();
		var vdate						=	$("#vdate").val();
		var comp_id						=	$("#comp_id").val();
		var insurance_number			=	$("#insurance_number").val();
		var insurance_company			=	$("#insurance_company").val();
		var insurance_date				=	$("#insurance_date").val();
		var currency					=	$("#currency").val();
		var insurance_amount			=	$("#insurance_amount").val();
		var insurance_duedate			=	$("#insurance_duedate").val();
		var tax_number					=	$("#tax_number").val();
		var tax_authority				=	$("#tax_authority").val();
		var tax_date					=	$("#tax_date").val();
		var tax_currency				=	$("#tax_currency").val();
		var tax_amount					=	$("#tax_amount").val();
		var tax_renewal_date			=	$("#tax_renewal_date").val();
		var make						=	$("#make").val();
		var model						=	$("#model").val();
		var year						=	$("#year").val();		
		var model_currency				=	$("#model_currency").val();
		var model_cost					=	$("#model_cost").val();											

		var	currentdate					=	new Date();

		/*alert(currentdate.getFullYear());
		alert(currentdate.getMonth());
		alert(currentdate.getDate());*/
		var currentdateval							=	currentdate.getDate()+"-"+(parseInt(currentdate.getMonth())+1)+"-"+currentdate.getFullYear();
		//alert(currentdateval);		
		
		if(vregno == '') {
			$('.myalignbuild').html('ERR : Enter Registration No.');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#vregno").focus();
			return false;
		} else if(vdate == '') {
			$('.myalignbuild').html('ERR : Select Regn. Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#vdate").focus();
			return false;
		} else if (vdate > currentdateval){
			$('.myalignbuild').html('ERR : Date Greater Than Today!');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#vdate").focus();
			return false;
		}	else if(comp_id == '0') {
			$('.myalignbuild').html('ERR : Select Regd. Company');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#comp_id").focus();
			return false;
		}  else if(year == '0') {
			$('.myalignbuild').html('ERR : Select Year');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#year").focus();
			return false;
		} else if(make == '') {
			$('.myalignbuild').html('ERR : Enter Make');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#make").focus();
			return false;
		} else if(model == '') {
			$('.myalignbuild').html('ERR : Enter Model');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#model").focus();
			return false;
		} else if (model_currency == ''){
			$('.myalignbuild').html('ERR : Enter Currency');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#model_currency").focus();
			return false;
		} else if(model_cost == '') {
			$('.myalignbuild').html('ERR : Enter Cost');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#model_cost").focus();
			return false;
		} else if (insurance_number == ''){
			$('.myalignbuild').html('ERR : Enter Insurance No.');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_number").focus();
			return false;
		} else if (insurance_company	== ''){
			$('.myalignbuild').html('ERR : Enter Insurance Company');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_company").focus();
			return false;
		} else if (insurance_amount == ''){
			$('.myalignbuild').html('ERR : Enter Insurance Amount');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_amount").focus();
			return false;
		} if (insurance_date == ''){
			$('.myalignbuild').html('ERR : Enter Insurance Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_date").focus();
			return false;
		} 
		if (insurance_date > currentdateval){
			$('.myalignbuild').html('ERR : Insurance Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_date").focus();
			return false;
		}		
		if (insurance_duedate < currentdateval && insurance_duedate != currentdateval){
			alert('edssdfsd');
			$('.myalignbuild').html('ERR : Ins. Renewal Date Less Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#insurance_duedate").focus();
			return false;
		}

		if (tax_date > currentdateval){
			$('.myalignbuild').html('ERR : Tax Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#tax_date").focus();
			return false;
		}
		if (tax_renewal_date < currentdateval && tax_renewal_date != currentdateval){
			$('.myalignbuild').html('ERR : Tax Renewal Date Less Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#tax_renewal_date").focus();
			return false;
		}
				
		$("#edit_id_val").val('123');
		$("#formsaveval").val('Edit');
		$("#building_save").submit();
		//return false;
	});

	$("#seca").on("click", function() {
		//alert("232");
		var fit_date					=	$("#fit_date").val();
		var next_inspection_date		=	$("#next_inspection_date").val();	
		var pollution_certificate_date	=	$("#pollution_certificate_date").val();
		var pollution_inspection_date	=	$("#pollution_inspection_date").val();
		var fit_certificate_no			=	$("#fit_certificate_no").val();				
		var certification_currency		=	$("#certification_currency").val();
		var certification_cost			=	$("#certification_cost").val();							
		var pollution_certificate_no	=	$("#pollution_certificate_no").val();		
		var pollution_currency			=	$("#pollution_currency").val();
		var pollution_certificate_cost	=	$("#pollution_certificate_cost").val();

		var	currentdate					=	new Date();

		/*alert(currentdate.getFullYear());
		alert(currentdate.getMonth());
		alert(currentdate.getDate());*/
		var currentdateval							=	currentdate.getDate()+"-"+(parseInt(currentdate.getMonth())+1)+"-"+currentdate.getFullYear();
		//alert(currentdateval);
		
		if (fit_date > currentdateval){
			$('.myalignbuild').html('ERR : Fitness Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#fit_date").focus();
			return false;
		}
		if (next_inspection_date < currentdateval && next_inspection_date != currentdateval){
			$('.myalignbuild').html('ERR : Fitness Date Less Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#next_inspection_date").focus();
			return false;
		}

		if (pollution_certificate_date > currentdateval){
			$('.myalignbuild').html('ERR : Pollution Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#pollution_certificate_date").focus();
			return false;
		}
		if (pollution_inspection_date < currentdateval && pollution_inspection_date != currentdateval){
			$('.myalignbuild').html('ERR : Pollution Date Less Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#pollution_inspection_date").focus();
			return false;
		}
						
		$("#formsaveval").val('Edit');
		$("#building_save").submit();
	});
});
</script>
<div id="mainareabuild">
<div class="mcf"></div>
<div align="center" class="headingsgr">BUILDING</div>
<div id="mytableformbuild" align="center">

<!-- <div class="header_bold">BUILDING</div>
<div class="scroll">
 -->
<!-- onSubmit="return submitBuildForm();"  -->
<form id='building_save' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' enctype="multipart/form-data">


<div class="scroll_box">
<div id="firstdiv">

<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Vehicle Registration Details</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Number*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='vregno' id='vregno' value="<?php echo $vehicle_regno;?>" size="20" autocomplete="off" tabindex="1" class="textbox"/></td>
    </tr>
    
	<tr height="30">
     <td width="120">Regd. in Comp.*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("select * from master_companies  order by comp_name",$bd);
		echo '<select name="comp_id" id="comp_id" class="selectbox" tabindex="3">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_emp_id)) {
			if($row['comp_id'] == $vehicle_comp_id){
				  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
			 } else {
				  $isSelected = ''; // else we remove any tag
			 }
				
				echo "<option value='".$row['comp_id']."'".$isSelected.">".$row['comp_name']."</option>";
		}
		echo '</select>';
		?>&nbsp;
	  </td>
	</tr>
	
	 <tr height="30">
    <td width="120">Make*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='make' id='make' value="<?php echo $make; ?>" size="20" autocomplete="off" tabindex="5" class="textbox"/></td>
    </tr>
    
    <tr height="30">
		<td width="120" >Currency </td>
		<td><img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<!-- <td><img width="15px" height="15px" src="images/currency.gif"></td> -->
		<td><input type='text' name='model_currency' id='model_currency' value="<?php $fgmembersite->DBLogin(); echo $fgmembersite->getdbval($model_currency,'name','id','currency'); ?>"  readonly class="textbox"/></td>
	</tr>
    

   </table>
   </td>
 </tr>
</table>

<!----------------------------------------------- Left Table End -------------------------------------->

<table width="50%" align="left">
 <tr>
  <td>
   <table>
	<tr height="30">
		 <td width="120" nowrap="nowrap">Date*</td>
		 <td><input type='text' name='vdate' id='vdate' tabindex="2" value="<?php echo $vehichle_reg_date;?>" class="datepicker textbox"/></td>
	</tr>
     
	<tr height="30">
     <td width="120">Year*</td>
	 <td><select id="year" name="year" autocomplete="off" tabindex="4"  >
     	<option value="0">--Select--</option>
     	<?php 
     		for ($i = 1920; $i <=date('Y'); $i++) { 
     			if($i == $year){
				  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
			 } else {
				  $isSelected = ''; // else we remove any tag
			 }
				
				echo "<option value='".$i."'".$isSelected.">".$i."</option>";     			     		
     	 }	?>
     </select>
     </td>
	</tr>
	
	<tr height="30">
     <td width="120" nowrap="nowrap">Model*</td>
     <td><input type='text' name='model' id='model' value="<?php echo $model;?>" size="20" autocomplete="off" tabindex="6" class="textbox"/></td>
	</tr>
     
	<tr height="30">
    <td width="120">Cost*</td>
    <td><input type='text' name='model_cost' id='model_cost' value="<?php echo $model_cost;?>" tabindex="7" style="text-align:right;" size="20" autocomplete="off" class="textbox"/></td>
    </tr>   
	
   </table>
  </td>
 </tr>
</table>

<!----------------------------------------------- Right Table End -------------------------------------->

</fieldset>
  </td>
</tr>
</table>



<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend><strong>Insurance</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Number*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='insurance_number' id='insurance_number' value="<?php echo $insurance_number;?>" tabindex="8" style="text-align:right;" size="20" autocomplete="off" class="textbox" /></td>
    </tr>
    
	<tr height="30">
     <?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT * FROM currency");
			$row=mysql_fetch_array($result_state);
		?>
		<td width="120" >Currency </td>
		<td><img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<!-- <td><img width="15px" height="15px" src="images/currency.gif"></td> -->
		<td><input type='text' name='currency' id='currency' value="<?php echo $fgmembersite->getdbval($currency,'name','id','currency'); ?>" readonly class="textbox"/></td>
	</tr>

	<tr height="30">
     <td width="120">Date</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="insurance_date" name="insurance_date" tabindex="11" value="<?php echo $insurance_date;?>" size="20" autocomplete="off" class="datepicker areatext" /></td>
	</tr>
   </table>
   </td>
 </tr>
</table>

<!----------------------------------------------- Left Table End -------------------------------------->

<table width="50%" align="left">
 <tr>
  <td>
  <table>
	<tr height="30">
     <td width="120" nowrap="nowrap">Company*</td>
     <td><input type='text' name='insurance_company' id='insurance_company' value="<?php echo $insurance_company;?>" tabindex="9" size="46" autocomplete="off" class="textbox" /></td>
	</tr>
     
	<tr height="30">
    <td width="120">Premium Amt*</td>
    <td><input type='text' name='insurance_amount' id='insurance_amount' value="<?php echo $insurance_amount;?>" tabindex="10" style="text-align:right;" size="20" autocomplete="off" class="textbox"/></td>
    </tr>    	
    <tr height="30">
    <td width="120">Renewal Date</td>
    <td><input type='text' name='insurance_duedate' id='insurance_duedate' tabindex="12" value="<?php echo $insurance_duedate;?>" size="20" autocomplete="off" class="datepicker textbox"/></td>
    </tr>
      </table>
       </td>
     </tr>
</table>
</fieldset>
</td>
</tr>
</table>





<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend><strong>Tax</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Number</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='tax_number' id='tax_number' value="<?php echo $tax_number;?>" style="text-align:right;" size="20" autocomplete="off" tabindex="13" class="textbox"/></td>
    </tr>
    
	<tr height="30">
     <?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT * FROM currency");
			$row=mysql_fetch_array($result_state);
		?>
		<td width="120" >Currency </td>
		<td><img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<!-- <td><img width="15px" height="15px" src="images/currency.gif"></td> -->
		<td><input type='text' name='tax_currency' id='tax_currency' value="<?php echo $fgmembersite->getdbval($tax_currency,'name','id','currency'); ?>" readonly class="textbox"/></td>
	</tr>

	<tr height="30">
     <td width="120">Date</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="tax_date" name="tax_date" value="<?php echo $tax_date;?>" size="20" autocomplete="off" tabindex="16" class="datepicker areatext" /></td>
	</tr>
   </table>
   </td>
 </tr>
</table>

<!----------------------------------------------- Left Table End -------------------------------------->

<table width="50%" align="left">
 <tr>
  <td>
  <table>
	<tr height="30">
     <td width="120" nowrap="nowrap">Authority</td>
     <td><input type='text' name='tax_authority' id='tax_authority' value="<?php echo $tax_authority;?>" size="20" autocomplete="off" tabindex="14" class="textbox"/></td>
	</tr>
     
	<tr height="30">
    <td width="120">Amount</td>
    <td><input type='text' name='tax_amount' id='tax_amount' value="<?php echo $tax_amount;?>" style="text-align:right;" size="20" autocomplete="off" tabindex="15" class="textbox"/></td>
    </tr>    	
    <tr height="30">
    <td width="120">Renewal Date</td>
    <td><input type='text' name='tax_renewal_date' id='tax_renewal_date' value="<?php echo $tax_renewal_date;?>" size="20" autocomplete="off" tabindex="17" class="datepicker textbox"/></td>
    </tr>
      </table>
       </td>
     </tr>
</table>
</fieldset>
</td>
</tr>
</table>

</div>


<div id="secdiv">


<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend><strong>Fitness Certification</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Number</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='fit_certificate_no' id='fit_certificate_no' value="<?php echo $fitness_certificate_no; ?>" style="text-align:right;" size="20" autocomplete="off" tabindex="1" class="textbox"/></td>
    </tr>
    
	<tr height="30">     
		<td width="120" >Currency </td>
		<td><img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<!-- <td><img width="15px" height="15px" src="images/currency.gif"></td> -->
		<td><input type='text' name='certification_currency' id='certification_currency' value="<?php echo $fgmembersite->getdbval($certification_currency,'name','id','currency'); ?>" readonly class="textbox"/></td>
	</tr>

	<tr height="30">
     <td width="120">Next Inspection Date</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="next_inspection_date" name="next_inspection_date" value="<?php echo $next_inspection_date;?>" size="20" autocomplete="off" tabindex="4" class="datepicker areatext" /></td>
	</tr>
   </table>
   </td>
 </tr>
</table>

<!----------------------------------------------- Left Table End -------------------------------------->

<table width="50%" align="left">
 <tr>
  <td>
  <table>
	<tr height="30">
     <td width="120" nowrap="nowrap">Date</td>
     <td><input type='text' name='fit_date' id='fit_date' value="<?php echo $fit_date; ?>" size="20" autocomplete="off" tabindex="2" class="datepicker textbox"/></td>
	</tr>
     
	<tr height="30">
    <td width="120">Cost</td>
    <td><input type='text' name='certification_cost' id='certification_cost' value="<?php echo $fitness_certification_cost;?>" style="text-align:right;" size="20" autocomplete="off" tabindex="3" class="textbox"/></td>
    </tr>    	    
      </table>
       </td>
     </tr>
</table>
</fieldset>
</td>
</tr>
</table>




<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend><strong>Pollution Certification</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Number</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='pollution_certificate_no' id='pollution_certificate_no' value="<?php echo $pollution_certificate_no;?>" style="text-align:right;" size="20" autocomplete="off" tabindex="5" class="textbox"/></td>
    </tr>
    
	<tr height="30">
     	<td width="120" >Currency </td>
		<td><img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<!-- <td><img width="15px" height="15px" src="images/currency.gif"></td> -->
		<td><input type='text' name='pollution_currency' id='pollution_currency' value="<?php echo $fgmembersite->getdbval($pollution_currency,'name','id','currency'); ?>" readonly class="textbox"/></td>
	</tr>

	<tr height="30">
     <td width="120">Next Inspection Date</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="pollution_inspection_date" name="pollution_inspection_date" value="<?php echo $pollution_inspection_date;?>" size="20" autocomplete="off" tabindex="8" class="datepicker areatext" /></td>
	</tr>
   </table>
   </td>
 </tr>
</table>

<!----------------------------------------------- Left Table End -------------------------------------->

<table width="50%" align="left">
 <tr>
  <td>
  <table>
	<tr height="30">
     <td width="120" nowrap="nowrap">Date</td>
     <td><input type='text' name='pollution_certificate_date' id='pollution_certificate_date' value="<?php echo $pollution_certificate_date;?>" size="20" autocomplete="off" tabindex="6" class="datepicker textbox"/></td>
	</tr>
     
	<tr height="30">
    <td width="120">Cost</td>
    <td><input type='text' name='pollution_certificate_cost' id='pollution_certificate_cost' value="<?php echo $pollution_certificate_cost;?>" style="text-align:right;" size="20" autocomplete="off" tabindex="7" class="textbox"/></td>
    </tr>    	    
      </table>
       </td>
     </tr>
</table>
</fieldset>
</td>
</tr>
</table>






<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend><strong>Attachment</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Registration</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>	
    <td><?php echo $car_reg_attach; ?>
    <input type='hidden' name='car_doc_attach' id='car_doc_attach' value="<?php echo $car_reg_attach; ?>" />
    <input type='file' name='car_reg_attach' id='car_reg_attach' tabindex="9" class="textbox"/></td>
    </tr>
    
	<tr height="30">
     	<td width="120" >Tax</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<!-- <td><img width="15px" height="15px" src="images/currency.gif"></td> -->
		<td>
		<?php echo $tax_attach; ?>
   	 <input type='hidden' name='tax_doc_attach' id='tax_doc_attach' value="<?php echo $tax_attach; ?>" />
    	<input type='file' name='tax_attach' id='tax_attach' tabindex="11" class="textbox"/></td>
	</tr>

	<tr height="30">
     <td width="120">Fitness</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php echo $fitness_attach; ?>
   	 <input type='hidden' name='fit_doc_attach' id='fit_doc_attach' value="<?php echo $fitness_attach; ?>" />
     <input type='file' name='fitness_attach' id='fitness_attach' tabindex="13" class="textbox"/></td>
	</tr>
   </table>
   </td>
 </tr>
</table>

<!----------------------------------------------- Left Table End -------------------------------------->

<table width="50%" align="left">
 <tr>
  <td>
  <table>
	<tr height="30">
     <td width="120" nowrap="nowrap">Insurance</td>
     <td>
     <?php echo $insurance_attach; ?>
   	 <input type='hidden' name='ins_doc_attach' id='ins_doc_attach' value="<?php echo $insurance_attach; ?>" />
     <input type='file' name='insurance_attach' id='insurance_attach' tabindex="10" class="textbox"/></td>
	</tr>
     
	<tr height="30">
    <td width="120">Pollution</td>
    <td><?php echo $pollution_attach; ?>
   	 <input type='hidden' name='pol_doc_attach' id='pol_doc_attach' value="<?php echo $pollution_attach; ?>" />
    <input type='file' name='pollution_attach' id='pollution_attach' tabindex="12" class="textbox"/></td>
    </tr>    	    
      </table>
       </td>
     </tr>
</table>
</fieldset>
</td>
</tr>
</table>

</div>


</div>
</div>
 <table width="100%" style="clear:both">
      <tr align="center" height="35px;">
      <td nowrap="nowrap">
	  
	  <div id="prev_span"  style="display:inline;"><a href="#" id="prevfirsta" style="width:80px;" class="buttons" >Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
	  <div id="first_span" style="display:inline;"><a href="#" id="firsta"	style="width:120px;" class="buttons" >Next</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

	  <div id="part_span"  style="display:inline;">
	  
	  <input type="button" type="button" name="part_save" id="part_save" style="width:95px;" class="buttons" value="Save & Continue" />

	  <!-- <a href="#" id="sixa"      style="width:80px;" class="buttons" >Save</a> -->
	  
	  &nbsp;&nbsp;&nbsp;&nbsp;</div>

	  <div id="sec_span"   style="display:inline;"><a href="#" id="seca"	style="width:80px;" class="buttons" >Save    </a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

	  <div id="third_span" style="display:inline;"><a href="#" id="thirda"     style="width:80px;" class="buttons" >Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
	  <div id="four_span"  style="display:inline;"><a href="#" id="foura"      style="width:80px;" class="buttons" >Next</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

	  <div id="five_span"  style="display:inline;"><a href="#" id="fivea"      style="width:80px;" class="buttons" >Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
	  <div id="six_span"  style="display:inline;">
	  
	  <input type="submit" name="sixa" id="sixa" class="buttons" value="Edit" />

	  <!-- <a href="#" id="sixa"      style="width:80px;" class="buttons" >Save</a> -->
	  
	  &nbsp;&nbsp;&nbsp;&nbsp;</div>
	 <input type="hidden" name="formsaveval" id="formsaveval" value="Edit" /> <!-- This will give the value when form is submitted, otherwise it will empty -->	 
	 <input type="hidden" name="edit_id_val" id="edit_id_val" /> <!-- This is the partial saved value for the building to edit again when partial save button is clicked -->
	 <input type='hidden' value="<?php echo $row_edit['edit_id']; ?>" name='edit_id' />
     <input type="reset" name="reset" class="buttons" value="Clear" id="clear" />&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=3'"/>&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_vehicle.php'"/></td>
	 </td>
     </tr>
  </table>
	<div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
</form>
<!-- </div> -->
</div>

<div id="backgroundChatPopup"></div>
<!-- <div id="map-canvas" style="width: 500px; height: 300px"></div> -->
<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile)) {
	include_once($footerfile);
} else {
	echo _FILENOTFOUNT.$footerfile;
}
?>