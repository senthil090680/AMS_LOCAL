<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

ini_set("display_errors",true);
error_reporting(E_ALL & ~E_NOTICE);

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
	//$header_file='./layout/admin_header_bms.php';
	$header_file='./layout/admin_header_ams.php';
}

$query_edit				=	"SELECT id,req_number,request_type, emp_request_id,guest_request_id,req_date,request_jobtype,req_desc,request_through,request_takenby,additional_det,expected_date,estimated_date,est_cost,actual_cost,completion_date,attach1,attach2,attach3 FROM request WHERE id = '$id'";			
$res_edit				=	mysql_query($query_edit) or die(mysql_error());
$row_edit				=	mysql_fetch_array($res_edit);

if(file_exists($header_file))	{
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
if(isset($_POST['formsaveval']) && $_POST[formsaveval] == 800) {
	
	if(isset($_FILES["attach1"]["name"])) {
		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["attach1"]["name"]);
		$extension = end($temp);
		if (in_array($extension, $allowedExts)) {
			if ($_FILES["attach1"]["error"] > 0) {
				echo "Return Code: " . $_FILES["attach1"]["error"] . "<br>";
			} else {
				
				if($attach1_old == '') {
					$current_timestamp		=	time();				
					$cur_file_name			=	$current_timestamp."_".$temp[0].".".$temp[1];
				} else {					
					$cur_file_name			=	$attach1_old;
				}
				
				$attach1=$cur_file_name;
				move_uploaded_file($_FILES["attach1"]["tmp_name"],"request/" . $cur_file_name);
				//echo "Stored in: " . "uploads/" . $_FILES["saleagreement"]["name"];
			}
		} else {
			$attach1=$attach1_old;
		}
	}
	
	if(isset($_FILES["attach2"]["name"])) {
		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["attach2"]["name"]);
		$extension = end($temp);
		if (in_array($extension, $allowedExts)) {
			if ($_FILES["attach2"]["error"] > 0) {
				echo "Return Code: " . $_FILES["attach2"]["error"] . "<br>";
			} else {
				
				if($attach2_old == '') {
					$current_timestamp		=	time();				
					$cur_file_name			=	$current_timestamp."_".$temp[0].".".$temp[1];
				} else {					
					$cur_file_name			=	$attach2_old;
				}
				
				$attach2=$cur_file_name;
				move_uploaded_file($_FILES["attach2"]["tmp_name"],"request/" . $cur_file_name);
				//echo "Stored in: " . "uploads/" . $_FILES["saleagreement"]["name"];
			}
		} else {
			$attach2=$attach2_old;
		}
	}
	
	if(isset($_FILES["attach3"]["name"])) {
		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["attach3"]["name"]);
		$extension = end($temp);
		if (in_array($extension, $allowedExts)) {
			if ($_FILES["attach3"]["error"] > 0) {
				echo "Return Code: " . $_FILES["attach3"]["error"] . "<br>";
			} else {
				
				if($attach3_old == '') {
					$current_timestamp		=	time();				
					$cur_file_name			=	$current_timestamp."_".$temp[0].".".$temp[1];
				} else {					
					$cur_file_name			=	$attach3_old;
				}
				
				$attach3=$cur_file_name;
				move_uploaded_file($_FILES["attach3"]["tmp_name"],"request/" . $cur_file_name);
				//echo "Stored in: " . "uploads/" . $_FILES["saleagreement"]["name"];
			}
		} else {
			$attach3=$attach3_old;
		}
	}

	$fgmembersite->DBLogin();
	$req_number				=	$_POST['req_number'];
	$request_type			=	$_POST['request_type'];
		
	if($request_type == 1) {		
		$emp_request_id		=	$_POST[emp_request_id];
		$guest_request_id	=	'';
	} else if($request_type == 2) {		
		$emp_request_id		=	'';
		$guest_request_id	=	$_POST[guest_request_id];
	} 
	$req_date				=	$_POST['req_date'];
	$request_jobtype		=	$_POST['request_jobtype'];
	$req_desc				=	$_POST['req_desc'];
	$request_through		=	$_POST['request_through'];
	$request_takenby		=	$_POST['request_takenby'];
	$additional_det			=	$_POST['additional_det'];
	$expected_date			=	$_POST['expected_date'];
	$estimated_date			=	$_POST['estimated_date'];
	$est_cost				=	$_POST['est_cost'];
	$actual_cost			=	$_POST['actual_cost'];
	$completion_date		=	$_POST['completion_date'];
	$attach1				=	$attach1;
	$attach2				=	$attach2;
	$attach3				=	$attach3;
		
		//echo 'UPDATE INTO request SET req_number="'.$req_number.'",request_type="'.$request_type.'",emp_request_id="'.$emp_request_id.'",guest_request_id="'.$guest_request_id.'",req_date="'.$req_date.'",request_jobtype="'.$request_jobtype.'",req_desc="'.$req_desc.'",request_through="'.$request_through.'",request_takenby="'.$request_takenby.'",additional_det="'.$additional_det.'",expected_date="'.$expected_date.'",estimated_date="'.$estimated_date.'",est_cost="'.$est_cost.'",actual_cost="'.$actual_cost.'",completion_date="'.$completion_date.'",attach1="'.$attach1.'",attach2="'.$attach2.'",attach3="'.$attach3.'",updated_by="'.$user_id.'",updated_at=NOW() WHERE id = "'.$edit_id.'"';
	
	//echo $sql;
	//exit;
	
	$user_id		=	$_SESSION['user_id'];
		
	if(!mysql_query('UPDATE request SET req_number="'.$req_number.'",request_type="'.$request_type.'",emp_request_id="'.$emp_request_id.'",guest_request_id="'.$guest_request_id.'",req_date="'.$req_date.'",request_jobtype="'.$request_jobtype.'",req_desc="'.$req_desc.'",request_through="'.$request_through.'",request_takenby="'.$request_takenby.'",additional_det="'.$additional_det.'",expected_date="'.$expected_date.'",estimated_date="'.$estimated_date.'",est_cost="'.$est_cost.'",actual_cost="'.$actual_cost.'",completion_date="'.$completion_date.'",attach1="'.$attach1.'",attach2="'.$attach2.'",attach3="'.$attach3.'",updated_by="'.$user_id.'",updated_at=NOW() WHERE id = "'.$edit_id.'"')) {
			die('Error: ' . mysql_error());
		}
		$fgmembersite->RedirectToURL("view_request.php?success=update");
		echo "&nbsp;";
}
?>
<link href="css/popup.css" rel="stylesheet" type="text/css" />
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
	height:530px;
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
	height:420px;
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
<script type="text/javascript" language="javascript">

$(document).ready(function() {

$('#attach1').change(function() {
		
		var existing = new Array();
		var checkFile = new Array();
		var file = new Array();
		var fileUrl = new Array();
		var counter = 0;
		for (var i = 0; i < 1; i++) {
		    (function(index){
		        file[index] = document.getElementById('attach1').files[0];
		        if(file[index]) {
		            fileUrl[index] = 'request/' + file[index].name;
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
									var filenamee=document.getElementById("attach1").value;
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
										$("#attach1").focus();
										$("#attach1").val('');
									}
									//return true; 
		                        }
		                        else {
		                            //list filenames and/or upload field numbers of the files that already exist on server
		                            //   ->> inform user... 
									/*alert("The file name already exits");
									document.getElementById("saleagreement").value="";
		                            return false;*/

									/*$('.myalignbuild').html('ERR : This Filename Already Exits');
									$('#errormsgbuild').css('display','block');
									setTimeout(function() {
										$('#errormsgbuild').hide();
									},5000);
									$("#req_picture").focus();
									$("#req_picture").val('');*/
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


$('#attach2').change(function() {
		
		var existing = new Array();
		var checkFile = new Array();
		var file = new Array();
		var fileUrl = new Array();
		var counter = 0;
		for (var i = 0; i < 1; i++) {
		    (function(index){
		        file[index] = document.getElementById('attach2').files[0];
		        if(file[index]) {
		            fileUrl[index] = 'request/' + file[index].name;
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
									var filenamee=document.getElementById("attach2").value;
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
										$("#attach2").focus();
										$("#attach2").val('');
									}
									//return true; 
		                        }
		                        else {
		                            //list filenames and/or upload field numbers of the files that already exist on server
		                            //   ->> inform user... 
									/*alert("The file name already exits");
									document.getElementById("saleagreement").value="";
		                            return false;*/

									/*$('.myalignbuild').html('ERR : This Filename Already Exits');
									$('#errormsgbuild').css('display','block');
									setTimeout(function() {
										$('#errormsgbuild').hide();
									},5000);
									$("#req_picture").focus();
									$("#req_picture").val('');*/
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


$('#attach3').change(function() {
	
	var existing = new Array();
	var checkFile = new Array();
	var file = new Array();
	var fileUrl = new Array();
	var counter = 0;
	for (var i = 0; i < 1; i++) {
	    (function(index){
	        file[index] = document.getElementById('attach3').files[0];
	        if(file[index]) {
	            fileUrl[index] = 'request/' + file[index].name;
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
								var filenamee=document.getElementById("attach3").value;
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
									$("#attach3").focus();
									$("#attach3").val('');
								}
								//return true; 
	                        }
	                        else {
	                            //list filenames and/or upload field numbers of the files that already exist on server
	                            //   ->> inform user... 
								/*alert("The file name already exits");
								document.getElementById("saleagreement").value="";
	                            return false;*/

								/*$('.myalignbuild').html('ERR : This Filename Already Exits');
								$('#errormsgbuild').css('display','block');
								setTimeout(function() {
									$('#errormsgbuild').hide();
								},5000);
								$("#req_picture").focus();
								$("#req_picture").val('');*/
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
	   
	//alert(12121);
	$("#request_type").focus();
	//alert(8989);

	$("#est_cost").on('blur',function() {
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

	$("#actual_cost").on('blur',function() {
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
	
	
	$("#request_type").live('change',function(event){
		var selvalue_request_type=$(this).val();
		if (selvalue_request_type != 0) {
	          $('#display_request_type').load('ajax_request.php?selvalue_request_type='+selvalue_request_type);
		}
	});		
	$("#guest_request_id").live('change',function(event){
		var selvalue_bought_by=document.getElementById("guest_request_id").value;
		if (selvalue_bought_by != 0) {
	          $('#display_request_id').load('ajax_request.php?guest_request_id='+selvalue_bought_by);
		}
	});
	$("#emp_request_id").live('change',function(event){
		var selvalue_bought_by=document.getElementById("emp_request_id").value;
		if (selvalue_bought_by != 0) {
	          $('#display_request_id').load('ajax_request.php?emp_request_id='+selvalue_bought_by);
		}
	});
	$("#request_takenby").live('change',function(event){
		var selvalue_takenby=document.getElementById("request_takenby").value;
		if (selvalue_takenby != 0) {
	          $('#display_empname').load('ajax_request.php?request_takenby='+selvalue_takenby);
		}
	});
	
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
	
	$("#part_save").on("click", function() {
		//alert("232");
		var request_type		=	$("#request_type").val();
		var req_date			=	$("#req_date").val();
		var request_jobtype		=	$("#request_jobtype").val();
		var req_desc			=	$("#req_desc").val();
		var request_through		=	$("#request_through").val();
		var request_takenby		=	$("#request_takenby").val();
		var additional_det		=	$("#additional_det").val();
		var expected_date		=	$("#expected_date").val();
		var estimated_date		=	$("#estimated_date").val();
		var est_cost			=	$("#est_cost").val();
		var actual_cost			=	$("#actual_cost").val();
		var completion_date		=	$("#completion_date").val();

		var	currentdate					=	new Date();

		var req_dateval 				=	new Date(req_date.substring(6,10)+"/"+req_date.substring(3,5)+"/"+req_date.substring(0,2)).getTime();

		var expected_dateval			=	new Date(expected_date.substring(6,10)+"/"+expected_date.substring(3,5)+"/"+expected_date.substring(0,2)).getTime();

		var estimated_dateval			=	new Date(estimated_date.substring(6,10)+"/"+estimated_date.substring(3,5)+"/"+estimated_date.substring(0,2)).getTime();

		var completion_dateval			=	new Date(completion_date.substring(6,10)+"/"+completion_date.substring(3,5)+"/"+completion_date.substring(0,2)).getTime();
		
		var currentdatevalue			=	new Date(currentdate.getFullYear()+"/"+(parseInt(currentdate.getMonth())+1)+"/"+currentdate.getDate()).getTime();

		if(request_type == '0') {
			$('.myalignbuild').html('ERR : Select Requestor Type');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#request_type").focus();
			return false;
		} 
		if(request_type == '1') {
			if($('#emp_request_id').val() == '0') {
				$('.myalignbuild').html('ERR : Select Requestor Name');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#emp_request_id").focus();
				return false;
			}
		} if(request_type == '2') {
			if($('#guest_request_id').val() == '0') {
				$('.myalignbuild').html('ERR : Select Requestor Name');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#guest_request_id").focus();
				return false;
			}
		} 

		if (req_dateval == ''){
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#req_date").focus();
			return false;
		} 
		if (req_dateval > currentdatevalue){
			$('.myalignbuild').html('ERR : Date Greater Than Today!');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#req_date").focus();
			return false;
		} 
		
		if(request_jobtype == '0') {
			$('.myalignbuild').html('ERR : Select Job Type');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#request_jobtype").focus();
			return false;
		} else if(request_through == '0') {
			$('.myalignbuild').html('ERR : Select Request Through');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#request_through").focus();
			return false;
		} else if(request_takenby == '0') {
			$('.myalignbuild').html('ERR : Select Request Taken By');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#request_takenby").focus();
			return false;
		} 

		if (expected_dateval == ''){
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#expected_date").focus();
			return false;
		} 
		if (expected_dateval < currentdatevalue){
			$('.myalignbuild').html('ERR : Date Less Than Today!');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#expected_date").focus();
			return false;
		} 

		if (estimated_dateval == ''){
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#estimated_date").focus();
			return false;
		} 
		if (estimated_dateval < currentdatevalue){
			$('.myalignbuild').html('ERR : Date Less Than Today!');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#estimated_date").focus();
			return false;
		} if (completion_dateval == ''){
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#completion_date").focus();
			return false;
		} 
		if (completion_dateval < currentdatevalue){
			$('.myalignbuild').html('ERR : Date Less Than Today!');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#completion_date").focus();
			return false;
		} 
		
		$("#formsaveval").val('800');
		$("#diesel_save").submit();
	});
}); 
</script>
<div id="mainareabuild">
<div class="mcf"></div>
<div align="center" class="headingsgr">REQUEST</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box">
<div id="firstdiv">

<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Request</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
  
  <tr height="30">
     <td width="120" style="white-space:nowrap;">Request Number</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td>
   <input type='text' name='req_number' id='req_number' tabindex="1" size="10" class="textbox" value="<?php echo $row_edit[req_number];?>" readonly="true"/></td>
  </tr>
	
    <tr height="30">
     <td width="120">Requestor Name*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='hidden' name='edit_id' id='edit_id' value="<?php echo $row_edit['id']; ?>" />
     <?php $selvalue=$row_edit["request_type"]; ?>
     	<select name='request_type' id='request_type' tabindex="1" >
			<option value="0">--Select--</option>
			<option value="1" <?php if($selvalue == 1) { echo "selected"; } ?> >Employee</option>
			<option value="2" <?php if($selvalue == 2) { echo "selected"; } ?> >Guest</option>
		</select>
	 </td>
	</tr>
	
	<tr height="30">
     <td width="120">Date</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input name='req_date' id='req_date' tabindex="4" size="10" value="<?php echo $row_edit[req_date]; ?>" class="datepicker"></td>
	</tr>
	
	 <tr height="30">
     <td width="120">Request Desc.</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input name='req_desc' id='req_desc' tabindex="6" size="41" value="<?php echo $row_edit[req_desc]; ?>" class="textbox"></td>
	</tr>
	
	<tr height="30">
     <td width="120" style="white-space:nowrap;">Req. Taken By*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("SELECT * FROM pim_emp_info  ORDER BY first_name",$bd);
		echo '<select name="request_takenby" id="request_takenby" class="selectbox" tabindex="8" style="width:268px;">';
		echo '<option value="0">--Employee--</option>';
		while($row=mysql_fetch_array($result_emp_id)) {
			if($row['emp_code'] == $row_edit['request_takenby']){
				$isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag	
				$request_takenbycode	=	$row['emp_code'];
			 } else {
				  $isSelected = ''; // else we remove any tag
			 }
				echo "<option value='".$row['emp_code']."'".$isSelected.">".$fgmembersite->upperstate($row['first_name'])."</option>";
		}
		echo '</select>';
		?>&nbsp;
	 </td>
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
		 <td width="120" nowrap="nowrap"></td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td></td>
	</tr>
	
   <tr height="30">
		 <td width="120" nowrap="nowrap">Requestor Code*</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><div id="display_request_type">
		 	<?php
			if($selvalue==1) {
				$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info order by emp_id",$bd);
				echo '<select name="emp_request_id" id="emp_request_id" style="width:206px;" tabindex="14" class="selectbox">';
				echo '<option value="0">--Select--</option>';
				while($row=mysql_fetch_array($result_emp_id)) {
					if($row['emp_code'] == $row_edit['emp_request_id']){
						  $isSelected 	= 	' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						  $first_name	=	$row["emp_code"];
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }							
					echo "<option value='".$row['emp_code']."'".$isSelected.">".$fgmembersite->upperstate($row['first_name'])."</option>";
				}
				echo '</select>&nbsp;<span id="display_request_id"><input type="text" name="emp_codeval" id="emp_codeval" size="6" class="textbox" value="'.$first_name.'" readonly="true" /></span>';
			}
			if($selvalue==2) {
				$fgmembersite->DBLogin();
				$result_state=mysql_query("select id,name,guest_code from guest");
				echo '<select name="guest_request_id" id="guest_request_id" tabindex="14" style="width:206px;" class="selectbox">';
				echo '<option value="0">--Select--</option>';
				while($row=mysql_fetch_array($result_state))
				{	
					if($row['id'] == $row_edit['guest_request_id']){
						$isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag		
						$driver_name	=	$row["guest_code"]; 
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }							
					echo "<option value='".$row['id']."'".$isSelected.">".$fgmembersite->upperstate($row['name'])."</option>";
					//echo '<option value="'.$row['id'].'">'.$row['driver_code'].'</option>';
				}
				echo '</select>&nbsp;<span id="display_request_id"><input type="text" name="guest_codeval" id="guest_codeval" size="6" class="textbox" value="'.$driver_name.'" readonly="true"/></span>';
			}
			?>			
			</div>
		 </td>
	</tr>
	
	<tr height="30">
     <td width="120">Job Type*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
    	$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT id,name FROM jobtype");
		echo '<select name="request_jobtype" id="request_jobtype" tabindex="5">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state)) {
			if($row['id'] == $row_edit['request_jobtype']){
				$isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag		
			 } else {
				  $isSelected = ''; // else we remove any tag
			 }
			echo "<option value='".$row['id']."'".$isSelected.">".$fgmembersite->upperstate($row['name'])."</option>";
		}
		echo '</select>';
	?>
	</td>
	</tr>
	
	 <tr height="30">
     <td width="120">Request Through*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><select name='request_through' id='request_through' tabindex="7" >
			<option value="0">--Select--</option>
			<option value="1" <?php if($row_edit[request_through] == 1) { echo "selected"; } ?> >System</option>
		  	<option value="2" <?php if($row_edit[request_through] == 2) { echo "selected"; } ?> >E-mail</option>
		  	<option value="3" <?php if($row_edit[request_through] == 3) { echo "selected"; } ?> >Call</option>
		  	<option value="4" <?php if($row_edit[request_through] == 4) { echo "selected"; } ?> >Verbal</option>
		</select>
	 </td>
	</tr>
	
	<tr height="30">
		 <td width="120" style="white-space:nowrap;">Req. Taken By Code</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td>
		 	<div id="display_empname"><input type='text' name='emp_codetakenby' id='emp_codetakenby' size="6" value="<?php echo $request_takenbycode; ?>" tabindex="9" readonly class="textbox"/></div>
		 </td>
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
  <legend ><strong>Duration & Cost Details</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120">Additional Details</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="additional_det" name="additional_det" value="<?php echo $row_edit[additional_det]; ?>" tabindex="10" size="41" /></td>
	</tr>
    
    <tr height="30">
    <td width="120" nowrap="nowrap">Exp. Compl. Date*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input name='expected_date' id='expected_date' tabindex="11" size="10" value="<?php echo $row_edit[expected_date]; ?>" class="datepicker" /></td>
    </tr>
    
	<tr height="30">
     <td width="120">Estimated Cost</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='est_cost' id='est_cost' value="<?php echo $row_edit[est_cost]; ?>" tabindex="13" style="text-align:right;" value="" class="textbox"/></td>
	</tr>

	<tr height="30">
		<td width="120" nowrap="nowrap">Revised Compl. Date</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input name='completion_date' id='completion_date' tabindex="15" size="10" value="<?php echo $row_edit[completion_date]; ?>" class="datepicker"></td>
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
		 <td width="120" nowrap="nowrap"></td>
		 <td></td>
	</tr>
	
   <tr height="30">
     <td width="120" nowrap="nowrap">Esti. Compl. Date*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input name='estimated_date' id='estimated_date' value="<?php echo $row_edit[estimated_date]; ?>" tabindex="12" size="10" class="datepicker" /></td>
	</tr>
   
   
	<tr height="30">
		 <td width="120" nowrap="nowrap">Actual Cost</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type='text' name='actual_cost' id='actual_cost' value="<?php echo $row_edit[actual_cost]; ?>" style="text-align:right;" tabindex="14" value="" class="textbox"/></td>
	</tr>
     
	<tr height="30">
		<td width="120"></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td></td>
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
  <legend ><strong>Attached Documents</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120">Attachment 1</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php echo $row_edit['attach1']; ?>
     <input type='file' name='attach1' id='attach1' tabindex="16" autocomplete="off" class="textbox" />
     <input type='hidden' value="<?php echo $row_edit['attach1']; ?>" name='attach1_old' id='attach1_old' />
     </td>
	</tr>
    
    <tr height="30">
    <td width="120" nowrap="nowrap">Attachment 3</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php echo $row_edit['attach3']; ?>
    <input type='file' name='attach3' id='attach3' tabindex="18" autocomplete="off" class="textbox" />
    <input type='hidden' value="<?php echo $row_edit['attach3']; ?>" name='attach3_old' id='attach3_old' />
    </td>
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
		 <td width="120" nowrap="nowrap">Attachment 2</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td>
		 <?php echo $row_edit['attach2']; ?>
		 <input type='file' name='attach2' id='attach2' tabindex="17" autocomplete="off" class="textbox" />
		  <input type='hidden' value="<?php echo $row_edit['attach2']; ?>" name='attach2_old' id='attach2_old' />
		 </td>
	</tr>
	
   <tr height="30">
     <td width="120"></td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td></td>
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


</div>


</div>
</div>
 <table width="100%" style="clear:both">
      <tr align="center" height="35px;">
      <td nowrap="nowrap">	  
	  <input type="submit" name="part_save" id="part_save" class="buttons" value="Save" />&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="hidden" name="formsaveval" id="formsaveval" /> <!-- This will give the value when form is submitted, otherwise it will empty -->
     <input type="reset" name="reset" class="buttons" value="Clear" id="clear" />&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=2'"/>&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_request.php'"/></td>
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