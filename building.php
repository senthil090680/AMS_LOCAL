<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

ini_set("display_errors",true);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

extract($_REQUEST);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

echo "<pre>";
print_r($_FILES);
echo "</pre>";*/
//exit;
if(!$fgmembersite->CheckLogin()) {
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

if ($fgmembersite->usertype() == 1)	{
	//$header_file='./layout/admin_header_bms.php';
	$header_file='./layout/admin_header_bms.php';
}

if(file_exists($header_file))	{
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#saleagreement').change(function() {
	
var existing 	=	new Array();
var checkFile 	=	new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('saleagreement').files[0];
        if(file[index]) {
            fileUrl[index] = 'uploads/' + file[index].name;
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
							var filenamee=document.getElementById("saleagreement").value;
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
								$("#saleagreement").focus();
								$("#saleagreement").val('');
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
							$("#saleagreement").focus();
							$("#saleagreement").val('');
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
    $('#leasedeed').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('leasedeed').files[0];
        if(file[index]) {
            fileUrl[index] = 'uploads/' + file[index].name;
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
							var filenamee=document.getElementById("leasedeed").value;
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
								$("#leasedeed").focus();
								$("#leasedeed").val('');
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
							$("#leasedeed").focus();
							$("#leasedeed").val('');
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
$('#insuranceagreement').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('insuranceagreement').files[0];
        if(file[index]) {
            fileUrl[index] = 'uploads/' + file[index].name;
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
							var filenamee=document.getElementById("insuranceagreement").value;
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
								$("#insuranceagreement").focus();
								$("#insuranceagreement").val('');
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
							$("#insuranceagreement").focus();
							$("#insuranceagreement").val('');
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
	$('#attach4').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('attach4').files[0];
        if(file[index]) {
            fileUrl[index] = 'uploads/' + file[index].name;
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
							var filenamee=document.getElementById("attach4").value;
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
								$("#attach4").focus();
								$("#attach4").val('');
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
							$("#attach4").focus();
							$("#attach4").val('');
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
    $('#attach5').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('attach5').files[0];
        if(file[index]) {
            fileUrl[index] = 'uploads/' + file[index].name;
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
							var filenamee=document.getElementById("attach5").value;
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
								$("#attach5").focus();
								$("#attach5").val('');
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
							$("#attach5").focus();
							$("#attach5").val('');
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
    $('#attach6').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('attach6').files[0];
        if(file[index]) {
            fileUrl[index] = 'uploads/' + file[index].name;
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
							var filenamee=document.getElementById("attach6").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
								/*alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
								document.getElementById("attach6").value="";
								return false;*/
								$('.myalignbuild').html('ERR : Invalid File Extension, Only (pdf, gif, jpg, png) Are Allowed');
								$('#errormsgbuild').css('display','block');
								setTimeout(function() {
									$('#errormsgbuild').hide();
								},5000);
								$("#attach6").focus();
								$("#attach6").val('');
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							/*alert("The file name already exits");
							document.getElementById("attach6").value="";
                            return false;*/
							$('.myalignbuild').html('ERR : This Filename Already Exits');
							$('#errormsgbuild').css('display','block');
							setTimeout(function() {
								$('#errormsgbuild').hide();
							},5000);
							$("#attach6").focus();
							$("#attach6").val('');
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
    $('#attach7').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('attach7').files[0];
        if(file[index]) {
            fileUrl[index] = 'uploads/' + file[index].name;
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
							var filenamee=document.getElementById("attach7").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
								return true;
							}
							else
							{
								/*alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
								document.getElementById("attach7").value="";
								return false;*/
								$('.myalignbuild').html('ERR : Invalid File Extension, Only (pdf, gif, jpg, png) Are Allowed');
								$('#errormsgbuild').css('display','block');
								setTimeout(function() {
									$('#errormsgbuild').hide();
								},5000);
								$("#attach7").focus();
								$("#attach7").val('');
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							/*alert("The file name already exits");
							document.getElementById("attach7").value="";
                            return false;*/
							$('.myalignbuild').html('ERR : This Filename Already Exits');
							$('#errormsgbuild').css('display','block');
							setTimeout(function() {
								$('#errormsgbuild').hide();
							},5000);
							$("#attach7").focus();
							$("#attach7").val('');
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
    $('#attach8').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('attach8').files[0];
        if(file[index]) {
            fileUrl[index] = 'uploads/' + file[index].name;
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
							var filenamee=document.getElementById("attach8").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
								/*alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
								document.getElementById("attach8").value="";
								return false;*/
								$('.myalignbuild').html('ERR : Invalid File Extension, Only (pdf, gif, jpg, png) Are Allowed');
								$('#errormsgbuild').css('display','block');
								setTimeout(function() {
									$('#errormsgbuild').hide();
								},5000);
								$("#attach8").focus();
								$("#attach8").val('');
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							/*alert("The file name already exits");
							document.getElementById("attach8").value="";
                            return false;*/
							$('.myalignbuild').html('ERR : This Filename Already Exits');
							$('#errormsgbuild').css('display','block');
							setTimeout(function() {
								$('#errormsgbuild').hide();
							},5000);
							$("#attach8").focus();
							$("#attach8").val('');
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
			//$('#display_empname').load('ajax_building.php?selvalue_empcode='+selvalue_empcode);
			$("#empname").val(selvalue_empcode);
		}
		else {
			document.getElementById("empname").value = "";	
		}
    });		
	$("#incharge_empcode").change(function(event) {
		var selvalue_incharge_empcode=document.getElementById("incharge_empcode").value;
		if (selvalue_incharge_empcode != 0) {
			$('#leadername').val(selvalue_incharge_empcode);
			//$('#display_inchargename').load('ajax_building.php?selvalue_incharge_empcode='+selvalue_incharge_empcode);
		}
		else
		{
			document.getElementById("leadername").value = "";
		}
    });
	$("#landlord").change(function(event) {
		var landlord_val	=	$(this).val();
		if (landlord_val != 0) {
			$.ajax({
				url				:	"ajax_building.php",
				type				:	"post",
				dataType			:	"text",
				cache				:	false,
				data				:	{ "landlordval" : landlord_val },
				success				:	function(ajaxval) {
					//alert(ajaxval);
					var splitval	=	ajaxval.split("~");
					$("#land_add1").val(splitval[0]);
					$("#land_add2").val(splitval[1]);
					$("#land_add3").val(splitval[2]);
					$("#contactnumber").val(splitval[3]);
					$("#alternatenumber").val(splitval[4]);
					$("#city_landlord").val(splitval[5]);
					$("#state_landlord").val(splitval[6]);
				}
			});
		} else {
			document.getElementById("landlord").value = "";
		}
    });		
});
</script>
<?php
if(isset($_POST['formsaveval']) && $_POST[formsaveval] == 800) {
	if(isset($_FILES["saleagreement"]["name"])) {
	$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
	$temp = explode(".", $_FILES["saleagreement"]["name"]);
	$extension = end($temp);
	if (in_array($extension, $allowedExts)) {
		if ($_FILES["saleagreement"]["error"] > 0) {
			echo "Return Code: " . $_FILES["saleagreement"]["error"] . "<br>";
		} else {
			if (file_exists("uploads/" . $_FILES["saleagreement"]["name"])) {
				//echo $_FILES["saleagreement"]["name"] . " already exists. ";
				$saleagreement="";
			} else {
				$saleagreement=$_FILES["saleagreement"]["name"];
				move_uploaded_file($_FILES["saleagreement"]["tmp_name"],"uploads/" . $_FILES["saleagreement"]["name"]);
				//echo "Stored in: " . "uploads/" . $_FILES["saleagreement"]["name"];
			}
		}
	}	else {
			$saleagreement="";
		}
	}
//
	if(isset($_FILES["leasedeed"]["name"])) {
		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["leasedeed"]["name"]);
		$extension = end($temp);
		if(in_array($extension, $allowedExts))
		{
			if ($_FILES["leasedeed"]["error"] > 0) {
				echo "Return Code: " . $_FILES["leasedeed"]["error"] . "<br>";
			}
			else {
				if (file_exists("uploads/" . $_FILES["leasedeed"]["name"])) {
				  //echo $_FILES["leasedeed"]["name"] . " already exists. ";
				  $leasedeed="";
				}
				else {
				  $leasedeed=$_FILES["leasedeed"]["name"];
				  move_uploaded_file($_FILES["leasedeed"]["tmp_name"],
				  "uploads/" . $_FILES["leasedeed"]["name"]);
				 // echo "Stored in: " . "uploads/" . $_FILES["leasedeed"]["name"];
				  }
			}
		} else {
			$leasedeed="";
		}
	}

	if(isset($_FILES["attach4"]["name"])) {

		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["attach4"]["name"]);
		$extension = end($temp);
		if (in_array($extension, $allowedExts)) {
			if($_FILES["attach4"]["error"] > 0) {
				echo "Return Code: " . $_FILES["attach4"]["error"] . "<br>";
			} else {
				if(file_exists("uploads/" . $_FILES["attach4"]["name"])) {
					//echo $_FILES["attach4"]["name"] . " already exists. ";
					$attach4="";
				} else {
					$attach4=$_FILES["attach4"]["name"];
					move_uploaded_file($_FILES["attach4"]["tmp_name"],"uploads/" . $_FILES["attach4"]["name"]);
					//echo "Stored in: " . "uploads/" . $_FILES["attach4"]["name"];
				}
			}
		} else {
			$attach4="";
		}
	}
	//
	//
	if(isset($_FILES["attach5"]["name"])) {
		$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
		$temp = explode(".", $_FILES["attach5"]["name"]);
		$extension = end($temp);
		if (in_array($extension, $allowedExts)) {
			if ($_FILES["attach5"]["error"] > 0) {
				echo "Return Code: " . $_FILES["attach5"]["error"] . "<br>";
			} else {
				if (file_exists("uploads/" . $_FILES["attach5"]["name"])) {
					//echo $_FILES["attach5"]["name"] . " already exists. ";
					$attach5="";
				} else {
					$attach5=$_FILES["attach5"]["name"];
					move_uploaded_file($_FILES["attach5"]["tmp_name"],"uploads/" . $_FILES["attach5"]["name"]);
					//echo "Stored in: " . "uploads/" . $_FILES["attach5"]["name"];
				}
			}
		} else {
				$attach5="";
		}
	}
	//
	//
	if(isset($_FILES["attach6"]["name"]))
	{
	$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
	$temp = explode(".", $_FILES["attach6"]["name"]);
	$extension = end($temp);
	if (in_array($extension, $allowedExts))
	  {
	  if ($_FILES["attach6"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["attach6"]["error"] . "<br>";
		}
	  else
		{
		if (file_exists("uploads/" . $_FILES["attach6"]["name"]))
		  {
		  //echo $_FILES["attach6"]["name"] . " already exists. ";
		  $attach6="";
		  }
		else
		  {
		  $attach6=$_FILES["attach6"]["name"];
		  move_uploaded_file($_FILES["attach6"]["tmp_name"],
		  "uploads/" . $_FILES["attach6"]["name"]);
		 // echo "Stored in: " . "uploads/" . $_FILES["attach6"]["name"];
		  }
		}
	  }
		else
		{
		 $attach6="";
		}
	}
	//
	//
	if(isset($_FILES["attach7"]["name"]))
	{
	$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
	$temp = explode(".", $_FILES["attach7"]["name"]);
	$extension = end($temp);
	if (in_array($extension, $allowedExts))
	  {
	  if ($_FILES["attach7"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["attach7"]["error"] . "<br>";
		}
	  else
		{
		if (file_exists("uploads/" . $_FILES["attach7"]["name"]))
		  {
		  //echo $_FILES["attach7"]["name"] . " already exists. ";
		  $attach7="";
		  }
		else
		  {
		  $attach7=$_FILES["attach7"]["name"];
		  move_uploaded_file($_FILES["attach7"]["tmp_name"],
		  "uploads/" . $_FILES["attach7"]["name"]);
		 // echo "Stored in: " . "uploads/" . $_FILES["attach7"]["name"];
		  }
		}
	  }
		else
		{
		 $attach7="";
		}
	}
	//
	//
	if(isset($_FILES["attach8"]["name"]))
	{
	$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
	$temp = explode(".", $_FILES["attach8"]["name"]);
	$extension = end($temp);
	if (in_array($extension, $allowedExts))
	  {
	  if ($_FILES["attach8"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["attach8"]["error"] . "<br>";
		}
	  else
		{
		if (file_exists("uploads/" . $_FILES["attach8"]["name"]))
		  {
		  //echo $_FILES["attach8"]["name"] . " already exists. ";
		  $attach8="";
		  }
		else
		  {
		  $attach8=$_FILES["attach8"]["name"];
		  move_uploaded_file($_FILES["attach8"]["tmp_name"],
		  "uploads/" . $_FILES["attach8"]["name"]);
		 // echo "Stored in: " . "uploads/" . $_FILES["attach8"]["name"];
		  }
		}
	  }
		else
		{
		 $attach8="";
		}
	}
	//
	//
	if(isset($_FILES["insuranceagreement"]["name"]))
	{
	$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
	$temp = explode(".", $_FILES["insuranceagreement"]["name"]);
	$extension = end($temp);
	if (in_array($extension, $allowedExts))
	  {
	  if ($_FILES["insuranceagreement"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["insuranceagreement"]["error"] . "<br>";
		}
	  else
		{
		if (file_exists("uploads/" . $_FILES["insuranceagreement"]["name"]))
		  {
		  //echo $_FILES["insuranceagreement"]["name"] . " already exists. ";
		  $insuranceagreement="";
		  }
		else
		  {
		  $insuranceagreement=$_FILES["insuranceagreement"]["name"];
		  move_uploaded_file($_FILES["insuranceagreement"]["tmp_name"],
		  "uploads/" . $_FILES["insuranceagreement"]["name"]);
		 // echo "Stored in: " . "uploads/" . $_FILES["insuranceagreement"]["name"];
		  }
		}
	  }
		else
		{
		 $insuranceagreement="";
		}
	}
	//
	$user_id					=	$_SESSION['user_id'];
	$building_code				=	$_POST['code'];
	$buildingname				=	$_POST['buildingname'];
	$building_type				=	$_POST['building_type'];
	$city						=	$_POST['city'];
	$state						=	$_POST['state'];
	$building_status			=	$_POST['building_status'];
	$address1					=	$_POST['address1'];
	$address2					=	$_POST['address2'];
	$address3					=	$_POST['address3'];
	$edit_id					=	$_POST['edit_id'];

	$datepurchase				=	'';
	$datelease					=	'';
	$cost						=	'';
	$purchasefrom				=	'';
	$rent						=	'';
	$periodfrom					=	'';
	$landlord					=	'';
	$contactperson				=	'';
	$landlod_address1			=	'';
	$landlod_address2			=	'';
	$landlod_address3			=	'';
	$city_landlord				=	'';
	$state_landlord				=	'';
	$contactnumber				=	'';
	$emailid					=	'';
	$alternatenumber			=	'';
	$altperson					=	'';
	$altpersonnumber			=	'';
	$renewaldate				=	'';
	$purcurrency				=	'';
	$rentcurrency				=	'';
	$insurancenumber			=	'';
	$insurancedate				=	'';
	$insurancerenewaldue		=	'';
	$effectivedate				=	'';

	if($building_status == 1) {
		$datepurchase			=	$_POST['datepurchase'];
		//$cost					=	$fgmembersite->remcom($fgmembersite->remdot($_POST['cost']));
		$cost					=	$_POST['cost'];
		$purchasefrom			=	$_POST['purchasefrom'];
		$saleagreement			=	$saleagreement;
		$purcurrency			=	$fgmembersite->getdbval($_POST['purcurrency'],'id','name','currency');
		$insurancenumber		=	$_POST['insurancenumber'];
		$insurancedate			=	$_POST['insurancedate'];
		$attach9				=	$insuranceagreement;
		$insurancerenewaldue	=	$_POST['insurancerenewaldue'];

	} else if($building_status == 2) {
		$datelease				=	$_POST['datelease'];
		//$rent					=	$fgmembersite->remcom($fgmembersite->remdot($_POST['rent']));
		$rent					=	$_POST['rent'];
		$periodfrom				=	$_POST['periodfrom'];
		$landlord				=	$_POST['landlord'];
		$contactperson			=	$_POST['contactperson'];
		$landlod_address1		=	$_POST['land_add1'];
		$landlod_address2		=	$_POST['land_add2'];
		$landlod_address3		=	$_POST['land_add3'];
		$city_landlord			=	$fgmembersite->getdbval($_POST['city_landlord'],'id','name','city');
		$state_landlord			=	$_POST['state_landlord'];
		$contactnumber			=	$_POST['contactnumber'];
		$emailid				=	$_POST['emailid'];
		$alternatenumber		=	$_POST['alternatenumber'];
		$altperson				=	$_POST['altperson'];
		$altpersonnumber		=	$_POST['altpersonnumber'];
		$leasedeed				=	$leasedeed;
		$renewaldate			=	$_POST['renewaldate'];
		$effectivedate			=	$_POST['effectivedate'];
		$rentcurrency			=	$fgmembersite->getdbval($_POST['rentcurrency'],'id','name','currency');
	}
	$currency					=	$fgmembersite->getdbval($_POST['currency'],'id','name','currency');
	
	$emp_code					=	$_POST['emp_code'];
	$empname					=	$_POST['empname'];
	//$buildingdesc				=	$_POST['buildingdesc'];
	$attach4					=	$attach4;
	$attach5					=	$attach5;
	$attach6					=	$attach6;
	$attach7					=	$attach7;
	$attach8					=	$attach8;
	$marker_id					=	$_POST['marker_id'];
	$incharge_empcode			=	$_POST['incharge_empcode'];
	$leadername					=	$_POST['leadername'];
	$totalemployee				=	$_POST['totalemployee'];	
	//$maintenancecost			=	$fgmembersite->remcom($fgmembersite->remdot($_POST['maintenancecost']));
	$maintenancecost			=	$_POST['maintenancecost'];
	$total_currency				=	$fgmembersite->getdbval($_POST['total_currency'],'id','name','currency');

	
	//$sql=('INSERT INTO building (building_name,building_code,building_type,building_city,building_state,address1,address2,address3,building_status,building_purchase,datelease,building_currency,rentcurrency,building_cost,building_rent,building_period,building_purchasefrom,building_saleagreement,building_landlord,landlord_contactperson,landlod_address1,landlod_address2,landlod_address3,landlord_city,landlord_state,landlord_contactno,landlord_email,landlord_alternateno,landlord_altperson,landlord_altpersonno,leasedead,leaserenewaldate,companyliason_empcode,companyliason_empname,build_desc,attach4,attach5,attach6,attach7,attach8,incharge_empcode,incharge_empname,total_employess,insurance_number,insurance_date,attach9,renewal_due,total_maintain_cost,total_currency,created_by)VALUES ("'.$buildingname.'","'.$building_code.'","'.$building_type.'","'.$city.'","'.$state.'","'.$address1.'","'.$address2.'","'.$address3.'","'.$building_status.'","'.$datepurchase.'","'.$datelease.'","'.$purcurrency.'","'.$rentcurrency.'","'.$cost.'","'.$rent.'","'.$periodfrom.'","'.$purchasefrom.'","'.$saleagreement.'","'.$landlord.'","'.$contactperson.'","'.$landlod_address1.'","'.$landlod_address2.'","'.$landlod_address3.'","'.$city_landlord.'","'.$state_landlord.'","'.$contactnumber.'","'.$emailid.'","'.$alternatenumber.'","'.$altperson.'","'.$altpersonnumber.'","'.$leasedeed.'","'.$renewaldate.'","'.$emp_code.'","'.$empname.'","'.$buildingdesc.'","'.$attach4.'","'.$attach5.'","'.$attach6.'","'.$attach7.'","'.$attach8.'","'.$incharge_empcode.'","'.$leadername.'","'.$totalemployee.'","'.$insurancenumber.'","'.$insurancedate.'","'.$attach9.'","'.$insurancerenewaldue.'","'.$maintenancecost.'","'.$total_currency.'","'.$user_id.'")');

	//echo $sql;
	//exit;
	
	if($edit_id == '') {
		if(!mysql_query('INSERT INTO building (building_name,building_code,building_type,building_city,building_state,address1,address2,address3,building_status,building_purchase,datelease,building_currency,rentcurrency,building_cost,building_rent,building_period,building_purchasefrom,building_saleagreement,building_landlord,landlord_contactperson,landlod_address1,landlod_address2,landlod_address3,landlord_city,landlord_state,landlord_contactno,landlord_email,landlord_alternateno,landlord_altperson,landlord_altpersonno,leasedead,effectivedate,leaserenewaldate,companyliason_empcode,companyliason_empname,build_desc,attach4,attach5,attach6,attach7,attach8,incharge_empcode,incharge_empname,total_employess,insurance_number,insurance_date,attach9,renewal_due,marker_id,total_maintain_cost,total_currency,created_by) VALUES ("'.$buildingname.'","'.$building_code.'","'.$building_type.'","'.$city.'","'.$state.'","'.$address1.'","'.$address2.'","'.$address3.'","'.$building_status.'","'.$datepurchase.'","'.$datelease.'","'.$purcurrency.'","'.$rentcurrency.'","'.$cost.'","'.$rent.'","'.$periodfrom.'","'.$purchasefrom.'","'.$saleagreement.'","'.$landlord.'","'.$contactperson.'","'.$landlod_address1.'","'.$landlod_address2.'","'.$landlod_address3.'","'.$city_landlord.'","'.$state_landlord.'","'.$contactnumber.'","'.$emailid.'","'.$alternatenumber.'","'.$altperson.'","'.$altpersonnumber.'","'.$leasedeed.'","'.$effectivedate.'","'.$renewaldate.'","'.$emp_code.'","'.$empname.'","'.$buildingdesc.'","'.$attach4.'","'.$attach5.'","'.$attach6.'","'.$attach7.'","'.$attach8.'","'.$incharge_empcode.'","'.$leadername.'","'.$totalemployee.'","'.$insurancenumber.'","'.$insurancedate.'","'.$attach9.'","'.$insurancerenewaldue.'","'.$marker_id.'","'.$maintenancecost.'","'.$total_currency.'","'.$user_id.'")')) {
			die('Error: ' . mysql_error());
		}
		$fgmembersite->RedirectToURL("view_building.php?success=create");
		echo "&nbsp;";
	} elseif($edit_id != '') {
		if(!mysql_query('INSERT INTO building (building_name,building_code,building_type,building_city,building_state,address1,address2,address3,building_status,building_purchase,datelease,building_currency,rentcurrency,building_cost,building_rent,building_period,building_purchasefrom,building_saleagreement,building_landlord,landlord_contactperson,landlod_address1,landlod_address2,landlod_address3,landlord_city,landlord_state,landlord_contactno,landlord_email,landlord_alternateno,landlord_altperson,landlord_altpersonno,leasedead,effectivedate,leaserenewaldate,companyliason_empcode,companyliason_empname,build_desc,attach4,attach5,attach6,attach7,attach8,incharge_empcode,incharge_empname,total_employess,insurance_number,insurance_date,attach9,renewal_due,marker_id,total_maintain_cost,total_currency,created_by)VALUES ("'.$buildingname.'","'.$building_code.'","'.$building_type.'","'.$city.'","'.$state.'","'.$address1.'","'.$address2.'","'.$address3.'","'.$building_status.'","'.$datepurchase.'","'.$datelease.'","'.$purcurrency.'","'.$rentcurrency.'","'.$cost.'","'.$rent.'","'.$periodfrom.'","'.$purchasefrom.'","'.$saleagreement.'","'.$landlord.'","'.$contactperson.'","'.$landlod_address1.'","'.$landlod_address2.'","'.$landlod_address3.'","'.$city_landlord.'","'.$state_landlord.'","'.$contactnumber.'","'.$emailid.'","'.$alternatenumber.'","'.$altperson.'","'.$altpersonnumber.'","'.$leasedeed.'","'.$effectivedate.'","'.$renewaldate.'","'.$emp_code.'","'.$empname.'","'.$buildingdesc.'","'.$attach4.'","'.$attach5.'","'.$attach6.'","'.$attach7.'","'.$attach8.'","'.$incharge_empcode.'","'.$leadername.'","'.$totalemployee.'","'.$insurancenumber.'","'.$insurancedate.'","'.$attach9.'","'.$insurancerenewaldue.'","'.$marker_id.'","'.$maintenancecost.'","'.$total_currency.'","'.$user_id.'")')) {
			die('Error: ' . mysql_error());
		}
		$id = mysql_insert_id();
		?>
		<script type="text/javascript">
			alert("Data Saved Successfully");
		</script>
		<?php
		$fgmembersite->RedirectToURL("edit_building.php?id=$id&secpage=1");
		echo "&nbsp;";
	}
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
	height:528px;
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
	height:419px;
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

function closeMapEnquiry() {
	$('#showingmap').remove();
	$('#showingmap').css('display','none');
	$('#backgroundChatPopup').fadeOut('slow');
}

/*  GOOGLE MAP LOCATION STORING STARTS HERE */
var marker;
var infowindow;

function initialize(latval,longval) {
	//alert(latval);
	//alert(longval);
 var latvalue =  $("#latbox").val();
 var longvalue =  $("#lngbox").val();
 var latlngval	= ''; 
 if(latvalue != '' && longvalue != '') {
	latval	=	latvalue;
	longval	=	longvalue;
	latlngval	=	$("#latlongbox").val();
 }
 //alert(latlngval);
  var latlng = new google.maps.LatLng(latval, longval);
  var options = {
    zoom: 13,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map_canvas"), options);

  if(latlngval != '') {
	  var myLatlng = new google.maps.LatLng(latval, longval);
	  var marker1 = new google.maps.Marker({
	      position: myLatlng,
	      map: map
	    });
	    google.maps.event.addListener(marker1, "click", function() {
	        //alert(event.latLng);
	    	//document.getElementById("latbox").value = event.latLng.lat();
	    	//document.getElementById("lngbox").value = event.latLng.lng();
	        infowindow.open(map, marker1);
	    });
  }
  
  var html = "<table style='background-color:#A09E9E' >" +
             "<tr><td>Name:</td> <td><input type='text' id='name'/> </td> </tr>" +
             "<tr><td>Address:</td> <td><input type='text' id='address'/></td> </tr>" +             
             "<tr><td></td><td><input type='button' class='buttons' style='width:75px;' value='Save & Close' onclick='saveData()'/></td></tr>";

google.maps.event.addListenerOnce(map, 'idle', function(){
    google.maps.event.trigger(map, 'resize');
    map.setCenter(latlng);
});
infowindow = new google.maps.InfoWindow({
 content: html
});

google.maps.event.addListener(map, "click", function(event) {
	//alert(event.latLng);
    marker = new google.maps.Marker({
      position: event.latLng,
      map: map
    });
    google.maps.event.addListener(marker, "click", function() {
    	//document.getElementById("latbox").value = event.latLng.lat();
    	//document.getElementById("lngbox").value = event.latLng.lng();
        infowindow.open(map, marker);
    });    
});
}

function saveData() {
  var name			=	escape(document.getElementById("name").value);
  var address		=	escape(document.getElementById("address").value);
  var type			=	'';
  var building_code =	$("#code").val();
  var latlng		=	marker.getPosition();
  //alert(latlng);

  if(name == '') {
	$('.myalignbuild').html('ERR : Enter Name');
	$('#errormsgbuild').css('display','block');
	setTimeout(function() {
			$('#errormsgbuild').hide();
	},5000);
	return false;
  }
  if(address == '') {
	$('.myalignbuild').html('ERR : Enter Address');
	$('#errormsgbuild').css('display','block');
	setTimeout(function() {
			$('#errormsgbuild').hide();
	},5000);
	return false;
  }
  //alert(latlng);
  document.getElementById("latbox").value = latlng.lat();
  document.getElementById("lngbox").value = latlng.lng();
  document.getElementById("latlongbox").value = latlng;
  
	
  var url = "savemap.php?name=" + name + "&address=" + address +
            "&type=" + type + "&lat=" + latlng.lat() + "&lng=" + latlng.lng()+"&building_code="+building_code;
  downloadUrl(url, function(data, responseCode) {
    if (responseCode == 200 && data.length <= 1) {
      alert("35");
	  infowindow.close();
      //document.getElementById("message").innerHTML = "Location Saved.";
		$('.myalignbuild').html('ERR : Location Saved.');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		$('#showingmap').remove();
		$('#showingmap').css('display','none');
		$('#backgroundChatPopup').fadeOut('slow');
			//$("#city").focus();
		//return false;
    }
  });
}

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
		//alert(request.responseText);
		//return false;
		//alert('dyrt');
		$("#marker_id").val(request.responseText);
		alert("Location Saved");
		$("#mapval").html("Location Map");
		infowindow.close();
		
		$('#showingmap').remove();
		$('#showingmap').css('display','none');
		$('#backgroundChatPopup').fadeOut('slow');
      request.onreadystatechange = doNothing;
      callback(request.responseText, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
}

/*  GOOGLE MAP LOCATION STORING ENDS HERE */

$(document).ready(function() {
	$(window).load(function() {

		$("#buildingname").focus();
		
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

	$("#city").on('change',function() {
		$("#latbox").val('');
		$("#longbox").val('');
		$("#latlongbox").val('');
		$("#mapval").html('Select Map');
	});
	$("#mapval").on('click',function() {
		var cityval		=	$("#city option:selected").text();
		var buildcode	=	$("#code").val();

		if(cityval == '--Select--') {
			$('.myalignbuild').html('ERR : Select City');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#city").focus();
			return false;
		}
		$.ajax({
			"url"		:	"latlong.php",
			"type"		:	"post",
			"dataType"	:	"text",
			"data"		:	{ "cityval" : cityval, "buildcode" : buildcode },
			"async"		:	false,
			"cache"		:	false,
			"success"	:	function(dataval) {
				//alert(dataval);
				if($.trim(dataval) == 'fail') {
					$('.myalignbuild').html('ERR : Network Error');
					$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
					return false;
				} else if (dataval != '') { 
					var splitval	=	dataval.split('~');
					//alert(dataval);
					//return false;
					$(" <div />" ).attr("id","showingmap").addClass("confirmMAp").html('<p class="closepboxa"><label class="closexbox"><a class="closelink" href="javascript:void(0)" onclick="javascript:return closeMapEnquiry();"><b><img border="0" src="images/close_button2.png" /></b></a></label></p><p style="font-size:15px;padding-left:30px;" class="addcolor"><div id="map_canvas" class="ShowMap" align="left" valin="top"></div></p>').appendTo($( "body" ));	

					initialize(splitval[0],splitval[1]);
					$("#backgroundChatPopup").css({"opacity": "0.7"});
					$("#backgroundChatPopup").fadeIn("slow");

					$('#showingmap').css("display","block");
					$('.ShowMap').css("display","block");
					//return false;
				}
			},
			"error"	:	function(errval) {
				alert(errval);
			}
		});		
	});
	
	$("#rent").on('blur',function() {

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

	$("#cost").on('blur',function() {

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

	$("#maintenancecost").on('blur',function() {

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
	
	$(".buil_stat").on('click',function() {
		//alert(32);
		//alert($("#building_status:checked").val());
		if($("#building_status:checked").val() == 2) {
			//alert(223);
			$("#leaserendiv").css('display','block');
		} else if ($("#building_status:checked").val() == 1) {
			$("#leaserendiv").css('display','none');
		}
	});

	$("#prevfirsta").on("click",function() {

		//alert(232);		 
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
		$("#buildingname").focus();		
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

		if($("#building_status").val() == 1) {
			$("#owneddiv").css('display','block');
			$("#rentdiv").css('display','none');
			//alert(232);
			$("#purchasefrom").focus();
			
		} if($("#building_status").val() == 2) {
			$("#owneddiv").css('display','none');
			$("#rentdiv").css('display','block');

			//alert(454);
			$("#periodfrom").focus();
			
		} else if($("#building_status").val() == 0) { 
			$("#owneddiv").css('display','none');
			$("#rentdiv").css('display','none');
		}
	});

	$("#fivea").on("click",function() {

		$("#firstdiv").css('display','none');
		$("#secdiv").css('display','none');
		$("#thirddiv").css('display','block');
		$("#fourdiv").css('display','none');

		$("#prev_span").css('display','none');
		$("#sec_span").css('display','none');
		$("#first_span").css('display','none');
		$("#third_span").css('display','inline');
		$("#four_span").css('display','inline');
		$("#five_span").css('display','none');
		$("#six_span").css('display','none');
	});

	$("#firsta").on("click", function() {
		//alert("232");
		var bu_type		=	$("#building_type").val();
		var bu_name		=	$("#buildingname").val();
		var inc_emp		=	$("#incharge_empcode").val();
		//var add1		=	$("#address1").val();
		var cityval		=	$("#city").val();

		/*if(bu_name == '') {
			$('.myalignbuild').html('ERR : Enter Building Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#buildingname").focus();
			return false;
		} else if(bu_type == '0') {
			$('.myalignbuild').html('ERR : Select Building Type');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#building_type").focus();
			return false;
		} else if(inc_emp == '0') {
			$('.myalignbuild').html('ERR : Select In-Charge');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#incharge_empcode").focus();
			return false;
		}  else if(cityval == '0') {
			$('.myalignbuild').html('ERR : Select City');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#city").focus();
			return false;
		} */

		if($("#building_status:checked").length <= 0) {
			$('.myalignbuild').html('ERR : Select Ownership');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#building_status").focus();
			return false;
		}
		
		/*if($("#building_status:checked").val() == 2) {
			
			var eff_date			=	$("#effectivedate").val();
			var ren_date			=	$("#renewaldate").val();

			var	currentdate			=	new Date();

			//alert(currentdate);
			//return false;

			var eff_dateval 		=	new Date(eff_date.substring(6,10)+"/"+eff_date.substring(3,5)+"/"+eff_date.substring(0,2)).getTime();
				
			var ren_dateval 		=	new Date(ren_date.substring(6,10)+"/"+ren_date.substring(3,5)+"/"+ren_date.substring(0,2)).getTime();

			var currentdatevalue	=	new Date(currentdate.getFullYear()+"/"+(parseInt(currentdate.getMonth())+1)+"/"+currentdate.getDate()).getTime();

			//alert(currentdate.getFullYear());
			//alert(currentdate.getMonth());
			//alert(currentdate.getDate());
			//alert(eff_dateval);
			//alert(currentdatevalue);
			
			if(eff_date == '') {
				$('.myalignbuild').html('ERR : Select Effective Date');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#effectivedate").focus();
				return false;
			} else if (eff_dateval > currentdatevalue){
				$('.myalignbuild').html('ERR : Date greater than today!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#effectivedate").focus();
				return false;
			} else if(ren_date == '') {
				$('.myalignbuild').html('ERR : Select Renewal Date');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#renewaldate").focus();
				return false;
			} else if (ren_dateval < currentdatevalue){
				$('.myalignbuild').html('ERR : Date Less than today!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#renewaldate").focus();
				return false;
			}
		}
		*/
		
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

		if($("#building_status:checked").val() == 1) {
			$("#owneddiv").css('display','block');
			$("#rentdiv").css('display','none');
			$("#purchasefrom").focus();
		} if($("#building_status:checked").val() == 2) {
			$("#owneddiv").css('display','none');
			$("#rentdiv").css('display','block');
			$("#periodfrom").focus();
		} else if($("#building_status").val() == 0) { 
			$("#owneddiv").css('display','none');
			$("#rentdiv").css('display','none');
		}
	});

	$("#building_status").on('change',function() {
		var bu_status		=	$(this).val();
		if(bu_status == '1') {
			$("#owneddiv").css('display','block');
			$("#rentdiv").css('display','none');
		} else if(bu_status == '2') {
			$("#owneddiv").css('display','none');
			$("#rentdiv").css('display','block');
		} else {
			$("#owneddiv").css('display','none');
			$("#rentdiv").css('display','none');
		}
		
	});

	$("#part_save").on("click", function() {
		//alert("232");
		var bu_type		=	$("#building_type").val();
		var bu_name		=	$("#buildingname").val();
		var inc_emp		=	$("#incharge_empcode").val();
		var add1		=	$("#address1").val();
		var cityval		=	$("#city").val();

		if(bu_name == '') {						
			$('.myalignbuild').html('ERR : Enter Building Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#buildingname").focus();
			return false;
		} else if(bu_type == '0') {
			$('.myalignbuild').html('ERR : Select Building Type');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#building_type").focus();
			return false;
		} else if(inc_emp == '0') {
			$('.myalignbuild').html('ERR : Select In-Charge');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#incharge_empcode").focus();
			return false;
		}  else if(add1 == '') {
			$('.myalignbuild').html('ERR : Enter Address');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#address1").focus();
			return false;
		}  else if(cityval == '0') {
			$('.myalignbuild').html('ERR : Select City');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#city").focus();
			return false;
		} else if($("#building_status:checked").length <= 0) {
			$('.myalignbuild').html('ERR : Select Ownership');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#building_status").focus();
			return false;
		}
		
		if($("#building_status:checked").val() == 2) {
			
			var eff_date		=	$("#effectivedate").val();
			var ren_date		=	$("#renewaldate").val();

			var	currentdate			=	new Date();

			//alert(currentdate);
			//return false;

			var eff_dateval 		=	new Date(eff_date.substring(6,10)+"/"+eff_date.substring(3,5)+"/"+eff_date.substring(0,2)).getTime();
				
			var ren_dateval 		=	new Date(ren_date.substring(6,10)+"/"+ren_date.substring(3,5)+"/"+ren_date.substring(0,2)).getTime();

			var currentdatevalue	=	new Date(currentdate.getFullYear()+"/"+(parseInt(currentdate.getMonth())+1)+"/"+currentdate.getDate()).getTime();
				
			if(eff_date == '') {
				$('.myalignbuild').html('ERR : Select Effective Date');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#effectivedate").focus();
				return false;
			} else if (eff_dateval > currentdatevalue){
				$('.myalignbuild').html('ERR : Date greater than today!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#effectivedate").focus();
				return false;
			} else if(ren_date == '') {
				$('.myalignbuild').html('ERR : Select Renewal Date');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#renewaldate").focus();
				return false;
			} else if (ren_dateval < currentdatevalue){
				$('.myalignbuild').html('ERR : Date Less than today!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#renewaldate").focus();
				return false;
			}  
			//alert(eff_dateval);
			//alert(ren_dateval);
			if (eff_dateval > ren_dateval || eff_dateval == ren_dateval){
				$('.myalignbuild').html('ERR : Eff. Date Should be Less Than Renewal Date!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#effectivedate").focus();
				return false;
			}
		}
		
		$("#edit_id").val('123');
		$("#formsaveval").val('800');
		$("#building_save").submit();
		//return false;
	});

	$("#seca").on("click", function() {
		//alert("232");
		
		var bu_type		=	$("#building_type").val();
		var bu_name		=	$("#buildingname").val();
		var inc_emp		=	$("#incharge_empcode").val();
		var add1		=	$("#address1").val();
		var cityval		=	$("#city").val();

		if(bu_name == '') {
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
			
			$('.myalignbuild').html('ERR : Enter Building Name');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#buildingname").focus();
			return false;
		} else if(bu_type == '0') {
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
			
			$('.myalignbuild').html('ERR : Select Building Type');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#building_type").focus();
			return false;
		} else if(inc_emp == '0') {

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
			
			$('.myalignbuild').html('ERR : Select In-Charge');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#incharge_empcode").focus();
			return false;
		}  else if(add1 == '') {

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
			
			$('.myalignbuild').html('ERR : Enter Address');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#address1").focus();
			return false;
		}  else if(cityval == '0') {

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
			
			$('.myalignbuild').html('ERR : Select City');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#city").focus();
			return false;
		} else if($("#building_status:checked").length <= 0) {
			$('.myalignbuild').html('ERR : Select Ownership');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#building_status").focus();
			return false;
		}
		
		if($("#building_status:checked").val() == 1) {
			var pur_from				=	$("#purchasefrom").val();
			var datepurchase			=	$("#datepurchase").val();			
			var costval					=	$("#cost").val();
			var curval					=	$("#purcurrency").val();
			var insurancenumber			=	$("#insurancenumber").val();
			var insurancedate			=	$("#insurancedate").val();
			var insurancerenewaldue		=	$("#insurancerenewaldue").val();			

			var currentdate				=	new Date();

			var datepurchaseval			=	new Date(datepurchase.substring(6,10)+"/"+datepurchase.substring(3,5)+"/"+datepurchase.substring(0,2)).getTime();

			var insurancedateval		=	new Date(insurancedate.substring(6,10)+"/"+insurancedate.substring(3,5)+"/"+insurancedate.substring(0,2)).getTime();

			var insurancerenewaldueval	=	new Date(insurancerenewaldue.substring(6,10)+"/"+insurancerenewaldue.substring(3,5)+"/"+insurancerenewaldue.substring(0,2)).getTime();
			var currentdateval			=	new Date(currentdate.getFullYear()+"/"+(parseInt(currentdate.getMonth())+1)+"/"+currentdate.getDate()).getTime();

			//alert(currentdateval);
			//alert(datepurchaseval);
			if(pur_from == '0') {
				$('.myalignbuild').html('ERR : Select Purchased From');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#purchasefrom").focus();
				return false;
			} else if(datepurchase == '') {
				$('.myalignbuild').html('ERR : Enter Purchased Date');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#datepurchase").focus();
				return false;
			} else if(datepurchaseval > currentdateval) {
				$('.myalignbuild').html('ERR : Date Greater Than Today');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#datepurchase").focus();
				return false;
			} else if(curval == '') {
				$('.myalignbuild').html('ERR : Add Currency');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#purcurrency").focus();
				return false;
			} else if(costval == '') {
				$('.myalignbuild').html('ERR : Enter Cost');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#cost").focus();
				return false;
			}
			if(insurancenumber != '') {
				if (insurancedateval > currentdateval){
					$('.myalignbuild').html('ERR : Date Greater Than Today!');
					$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
					$("#insurancedate").focus();
					return false;
				} else if (insurancerenewaldueval < currentdateval){
					$('.myalignbuild').html('ERR : Date Less than Today!');
					$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
					$("#insurancerenewaldue").focus();
					return false;
				}  
				//alert(eff_dateval);
				//alert(ren_dateval);
				if (insurancedateval > insurancerenewaldueval || insurancedateval == insurancerenewaldueval){
					$('.myalignbuild').html('ERR : Ins. Eff. Date Should be Less Than Renewal Date!');
					$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
					$("#insurancedate").focus();
					return false;
				}
			}
			
		} else if($("#building_status:checked").val() == 2) {
			var Dateval			=	$("#datelease").val();
			var per_from		=	$("#periodfrom").val();
			var rent			=	$("#rent").val();
			var curval			=	$("#rentcurrency").val();
			var landlord		=	$("#landlord").val();
			var land_add1		=	$("#land_add1").val();
			var city_land		=	$("#city_landlord").val();
			var emailid			=	$("#emailid").val();
			var con_per			=	$("#contactperson").val();
			var con_num			=	$("#contactnumber").val();
			var leasedeed		=	$("#leasedeed").val();
			var ren_date		=	$("#renewaldate").val();
			var liaison_emp		=	$("#emp_code").val();
			
			var	currentdate		=	new Date();

			var Datevalval 		=	new Date(Dateval.substring(6,10)+"/"+Dateval.substring(3,5)+"/"+Dateval.substring(0,2)).getTime();

			var currentdatevalue			=	new Date(currentdate.getFullYear()+"/"+(parseInt(currentdate.getMonth())+1)+"/"+currentdate.getDate()).getTime();


			var eff_date		=	$("#effectivedate").val();
			var ren_date		=	$("#renewaldate").val();

			//alert(currentdate);
			//return false;

			var eff_dateval 		=	new Date(eff_date.substring(6,10)+"/"+eff_date.substring(3,5)+"/"+eff_date.substring(0,2)).getTime();
				
			var ren_dateval 		=	new Date(ren_date.substring(6,10)+"/"+ren_date.substring(3,5)+"/"+ren_date.substring(0,2)).getTime();

			if(eff_date == '') {
				
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
				
				$('.myalignbuild').html('ERR : Select Effective Date');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#effectivedate").focus();
				return false;
			} else if (eff_dateval > currentdatevalue){
				
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
								
				$('.myalignbuild').html('ERR : Date greater than today!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#effectivedate").focus();
				return false;
			} else if(ren_date == '') {

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
				
				$('.myalignbuild').html('ERR : Select Renewal Date');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#renewaldate").focus();
				return false;
			} else if (ren_dateval < currentdatevalue){

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

				$('.myalignbuild').html('ERR : Date Less than today!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#renewaldate").focus();
				return false;
			}  
			//alert(eff_dateval);
			//alert(ren_dateval);
			if (eff_dateval > ren_dateval || eff_dateval == ren_dateval){

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

				$('.myalignbuild').html('ERR : Eff. Date Should be Less Than Renewal Date!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#effectivedate").focus();
				return false;
			}
			
			if (Datevalval > currentdatevalue){
				$('.myalignbuild').html('ERR : Date greater than today!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#datelease").focus();
				return false;
			}

			if(per_from == '0') {
				$('.myalignbuild').html('ERR : Select Period');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#periodfrom").focus();
				return false;
			} else if(curval == '') {
				$('.myalignbuild').html('ERR : Add Currency');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#rentcurrency").focus();
				return false;
			} else if(rent == '') {
				$('.myalignbuild').html('ERR : Enter Rent');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#rent").focus();
				return false;
			} else if(landlord == '0') {
				$('.myalignbuild').html('ERR : Select Landlord');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#landlord").focus();
				return false;
			} else if(con_per == '') {
				$('.myalignbuild').html('ERR : Enter Contact Person');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#contactperson").focus();
				return false;
			} /*else if(con_num == '') {
				$('.myalignbuild').html('ERR : Enter Contact Number');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#contactnumber").focus();
				return false;
			} else if(emailid == '') {
				$('.myalignbuild').html('ERR : Enter Email');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#emailid").focus();
				return false;
			} else {
				var reg				=	/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				var email_to_lower	=	$("#emailid").val();
				var address			=	email_to_lower.toLowerCase();
				if(reg.test(address) == false) {
					$('.myalignbuild').html('ERR : Invalid Email Address');
					$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
					$("#emailid").focus();
					return false;							
				}
			} 			
			if(city_land == '0') {
				$('.myalignbuild').html('ERR : Select City');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#city_landlord").focus();
				return false;
			}*/
			if(liaison_emp == '0') {
				$('.myalignbuild').html('ERR : Select Company Liaison');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#emp_code").focus();
				return false;
			} 
		}
		
		$("#formsaveval").val('800');
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
  <legend ><strong>Identification</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Code</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
	<?php
		 if(!isset($_GET[id]) && $_GET[id] == '') {
			$cusid					=	"SELECT building_code FROM  building ORDER BY id DESC";			
			$cusold					=	mysql_query($cusid) or die(mysql_error());
			$cuscnt					=	mysql_num_rows($cusold);
			//$cuscnt					=	0; // comment if live
			if($cuscnt > 0) {
				$row_cus					  =	 mysql_fetch_array($cusold);
				$cusnumber	  =	$row_cus['building_code'];

				$getcusno						=	abs(str_replace("BU",'',strstr($cusnumber,"BU")));
				$getcusno++;
				if($getcusno < 10) {
					$createdcode	=	"00".$getcusno;
				} else if($getcusno < 100) {
					$createdcode	=	"0".$getcusno;
				} else {
					$createdcode	=	$getcusno;
				}

				$customer_code				=	"BU".$createdcode;
			} else {
				$customer_code				=	"BU001";
			}
		}
	?>
   <input type='text' name='code' id='code' tabindex="1" style="width:60px;" class="textbox" value="<?php echo $customer_code;?>" readonly="true"/>	
	</td>
    </tr>
    
	<tr height="30">
     <td width="120">Type*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
			$result_state=mysql_query("SELECT * FROM building_type");
			echo '<select name="building_type" id="building_type" tabindex="3" class="selectbox">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state)) {
				echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
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
		 <td width="120" nowrap="nowrap">Name*</td>
		 <td><input type='text' name='buildingname' id='buildingname' autocomplete="off" maxlength="35" size="46" tabindex="2" class="textbox"/></td>
	</tr>
     
	<tr height="30">
		<td width="120">In-Charge*</td>
		<td>
		<?php
			$fgmembersite->DBLogin();
			$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
			or die("Opps some thing went wrong");
			mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
			$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
			echo '<select name="incharge_empcode" id="incharge_empcode" size="1" position="absolute" onclick="size=(size!=1)?2:1;" style="width:244px;" tabindex="4" class="selectbox">';
			echo '<option value="0">--Employee--</option>';
			while($row=mysql_fetch_array($result_emp_id))
			{
				echo '<option value="'.$row['emp_code'].'">'.$row['first_name'].'</option>';
			}
			echo '</select>';
			?>
			&nbsp;
			<span id="display_inchargename"><input type='text' name='leadername' id='leadername' size="4" readonly class="textbox"/></span>
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
  <legend><strong>Location</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="50" align="left">Address Line 1*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type="text" id="address1" name="address1" size="35" autocomplete="off" maxlength="20" tabindex="5" class="areatext" /></td>
    </tr>
    
	<tr height="30">
     <td width="50" align="left"><span style="padding-left:55px;">Line 2</span></td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="address2" name="address2" size="35" autocomplete="off" tabindex="6" class="areatext" /></td>
	</tr>

	<tr height="30">
     <td width="50" ><span style="padding-left:55px;">Line 3</span></td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type="text" id="address3" name="address3" size="35" autocomplete="off" tabindex="7" class="areatext" /></td>
	</tr>
	
	<tr height="30">
		<td width="120">City*</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id");
			echo '<select name="city" id="city" tabindex="8" >';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state)) {
				echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
			}
			echo '</select>';
			?>
		</td>
    </tr>

	<tr height="30">
     <td width="120">State</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><div id="display_state"><input type="text" name='state' id='state' tabindex="9" readonly class="textbox" /></div></td>
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
     <td width="120" nowrap="nowrap">Map</td>
     <td><button type="button" name="mapval" id="mapval" tabindex="10" style="width:93px;" class="areatext" >Select Map</button>
	 <input type='hidden' name='marker_id' id='marker_id' />
	 <input type='hidden' name='lngbox' id='lngbox' value="" />
	 <input type='hidden' name='latbox' id='latbox' value=""/>
	 <input type='hidden' name='latlongbox' id='latlongbox' value=""/>
	 </td>
	</tr>
     
	<tr height="30">
    <td width="120">Floor Drawing 1</td>
    <td><input type='file' name='attach4' id='attach4' tabindex="11" class="textbox"/></td>
    </tr>
    
	<tr height="30">
     <td width="100" nowrap="nowrap" ><span style="padding-left:36px;">Drawing 2</span></td>
     <td><input type='file' name='attach5' id='attach5' tabindex="12" class="textbox"/></td>
	</tr>

	<tr height="40">
     <td width="100" ><span style="padding-left:36px;">Drawing 3</span></td>
     <td><input type='file' name='attach6' id='attach6' tabindex="13" class="textbox"/></td>
	</tr>
	
	<tr height="30">
		<td width="100" ><span style="padding-left:36px;">Drawing 4</span></td>
		<td><input type='file' name='attach7' id='attach7' tabindex="14" class="textbox"/></td>
    </tr>
	
	<tr height="30">
     <td width="100" ><span style="padding-left:36px;">Drawing 5</span></td>
     <td><input type='file' name='attach8' id='attach8' tabindex="15" class="textbox"/></td>
	</tr>	
      </table>
       </td>
     </tr>
</table>
</fieldset>
</td>
</tr>
</table>


<table width="50%" align="left">
 <tr>
  <td>
 <fieldset class="alignment">
  <legend><strong>Ownership</strong></legend>
  <table>
  <tr height="25">
    <td>Owned <input type="radio" name="building_status" id="building_status" value="1" class="buil_stat" tabindex="16" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lease <input type="radio" name="building_status" id="building_status" value="2" class="buil_stat" tabindex="17" />		
		<!-- <select name="building_status" id="building_status" tabindex="0" class="selectbox">
			<option value="0">--Select--</option>
			<option value="1">Owned</option>
			<option value="2">Rented/Lease</option>
			<option value="3">Lease</option>
		</select> -->
    </tr>
   </table>
 </fieldset>
</td>
</tr>
</table>

<div id="leaserendiv" style="display:none;"> 
<table width="50%" align="right">
 <tr>
  <td>
   <fieldset class="alignment">
  <legend><strong>Date</strong></legend>
  <table>
  <tr height="25">
     <td width="65">Effective*</td>
     <td><input type="text" name="effectivedate" id="effectivedate" size="10" value="<?php echo date('d-m-Y'); ?>" tabindex="18" autocomplete='off' maxlength="10" class="datepicker"/></td>
	<td width="130" nowrap="nowrap" >&nbsp;&nbsp;&nbsp;&nbsp;Renewal Date*</td>
	<td><input type='text' name='renewaldate' id='renewaldate' size="10" value="" tabindex="19" autocomplete='off' maxlength="10" class="datepicker textbox"/></td>
     </tr>
   </table>
 </fieldset>
</td>
</tr>
</table>
</div>


</div>


<div id="secdiv">

<div id="owneddiv"> 
 <table width="100%" align="right">
 <tr>
  <td>
 <fieldset align="left" class="alignment2">
  <legend><strong>Purchase Details</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120" nowrap="nowrap">Purchased From*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
				$result_state=mysql_query("select id,name,vendor_code from vendor_bms");
				echo '<select name="purchasefrom" id="purchasefrom" tabindex="1" style="width:291px;">';
				echo '<option value="0">--Select--</option>';
				while($row=mysql_fetch_array($result_state))
				{
					echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
				}
				echo '</select>';
	      ?>         
     <!-- <input type='text' name='purchasefrom' id='purchasefrom' size="45" maxlength="45" autocomplete="off" tabindex="1" class="textbox"/>-->
     
     </td>
	</tr>
	
	<tr height="30">
		<?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT * FROM currency");
			$row=mysql_fetch_array($result_state);
		?>
		<td width="120" >Currency </td>
		<td><img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<td><input type='text' name='purcurrency' id='purcurrency' tabindex="3" size="4" value="<?php echo $row['name']; ?>" readonly class="textbox"/></td>
    </tr>
	<tr height="30">
     <td width="120">Sale Deed Agmt.</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='file' name='saleagreement' id='saleagreement' style="width:250px;" tabindex="5" class="textbox"/></td>
	</tr>

   </table>
   </td>
 </tr>
</table>

<table width="50%" align="left">
 <tr>
  <td>
  <table>
	<tr height="30">
     <td width="120" nowrap="nowrap">Purchased Date*</td>
     <td><input type='text' name='datepurchase' id='datepurchase' size="10" value="<?php echo date('d-m-Y'); ?> " tabindex="2" class="datepicker textbox"/></td>
	</tr>
     
	<tr height="30">
     <td width="120">Cost*</td>	 
     <td><input type='text' name='cost' id='cost' autocomplete="off" style="text-align:right;" tabindex="4" class="textbox"/></td>
	</tr>

       </table>
       </td>
     </tr>
</table>
</fieldset>
</td>
</tr>
</table>

<table width="100%" align="right">
<tr>
<td>
<fieldset align="left" class="alignment2">
  <legend><strong>Insurance</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Number</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='insurancenumber' id='insurancenumber' autocomplete="off" tabindex="6" class="textbox"/></td>
    </tr>
    
	<tr height="40">
     <td width="120">Agreement</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='file' name='insuranceagreement' id='insuranceagreement' tabindex="8" class="textbox"/></td>
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
	<tr height="32">
     <td width="120" nowrap="nowrap">Date</td>
     <td><input type='text' name='insurancedate' id='insurancedate'	size="10" value="<?php echo date('d-m-Y'); ?>" tabindex="7" class="datepicker textbox"/></td>
	</tr>
	
	<tr height="32">
     <td width="120" nowrap="nowrap">Renewal Date</td>
     <td><input type='text' name='insurancerenewaldue' id='insurancerenewaldue' size="10" value="" tabindex="9" class="datepicker textbox"/></td>
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


<div id="rentdiv">
 <table width="100%" align="right">
 <tr>
  <td>
 <fieldset align="left" class="alignment2">
  <legend><strong>Lease Details</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
        
    <tr height="30">
     <td width="120">Agreement</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td>
     	<input type='file' name='leasedeed' id='leasedeed' style="width:230px;" tabindex="1" class="textbox" />
     </td>
	</tr>
	
	<tr height="30">
		<?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT * FROM currency");
			$row=mysql_fetch_array($result_state);
		?>
		<td width="120">Currency</td>
		<td>
			<img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" />
		</td>
		<td>
			<input type='text' name='rentcurrency' id='rentcurrency' tabindex="3" size="4" value="<?php echo $row['name']; ?>" readonly class="textbox" />
		</td>
    </tr>

   </table>
   </td>
 </tr>
</table>

<table width="50%" align="left">
 <tr>
  <td>
  <table>

	<tr height="30">
     <td width="167" nowrap="nowrap">Period*</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><select name="periodfrom" id="periodfrom" tabindex="2" class="selectbox">
			<option value="0">--Select--</option>
			<option value="1">Monthly</option>
			<option value="2">Quarterly</option>
			<option value="3">Halfyearly</option>
			<option value="4">Yearly</option>
		</select></td>
	</tr>
    
	<tr height="30">
     <td width="167">Rent*</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='rent' id='rent' style="text-align:right;" tabindex="4" class="textbox"/></td>
	</tr>

      </table>
       </td>
     </tr>
</table>
</fieldset>
</td>
</tr>
</table>


<table width="100%" align="right">
<tr>
<td>
<fieldset align="left" class="alignment2">
  <legend><strong>Landlord</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
     <td width="120">Name*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
			$result_state=mysql_query("select id,name,vendor_code from vendor_bms");
			echo '<select name="landlord" id="landlord" tabindex="5" style="width:291px;">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state)) {
				echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
			}
			echo '</select>';
	    ?>
     <!-- <input type='text' name='landlord' id='landlord' size="35" autocomplete="off" tabindex="5" class="textbox"/>-->
     </td>
	</tr>
    
	<tr height="30">
		<td width="120">Address Line 1</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type="text" id="land_add1" name="land_add1" size="43" readonly autocomplete="off" tabindex="6" class="areatext" /></td>
    </tr>

	<tr height="30">
		 <td width="100"><span style="padding-left:55px;">Line 2</span></td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><input type="text" id="land_add2" name="land_add2" size="43" readonly autocomplete="off" tabindex="7" class="areatext" /></td>
	</tr>

	<tr height="30">
		<td width="100"><span style="padding-left:55px;">Line 3</span></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type="text" id="land_add3" name="land_add3" size="43" readonly autocomplete="off" tabindex="8" class="areatext" /></td>
    </tr>
	
	<tr height="30">
     <td width="120">City</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td>
     	<input type='text' name='city_landlord' id='city_landlord' tabindex="9" readonly class="textbox" />
		<?php
		/*$result_state=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id");
		echo '<select name="city_landlord" id="city_landlord" tabindex="9" >';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state))
		{
			echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
		}
		echo '</select>';*/
	?></td>
	</tr>

	<tr height="30">
		<td width="120">State</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><div id="display_state_landlord"><input type='text' name='state_landlord' id='state_landlord' tabindex="10" readonly class="textbox" /></div></td>
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
		<td width="120">Contact Person*</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='contactperson' id='contactperson' size="35" tabindex="11" class="textbox"/></td>
    </tr>

	<tr height="30">
     <td width="120">Contact Number</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='contactnumber' id='contactnumber' size="35" readonly tabindex="12" class="textbox"/></td>
	</tr>

	<tr height="30">
		<td width="120">Alternate Number</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='alternatenumber' id='alternatenumber' size="35" readonly tabindex="13" class="textbox"/></td>
    </tr>

	<tr height="30">
     <td width="120">Email ID</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='emailid' id='emailid' size="35" tabindex="14" class="textbox"/></td>
	</tr>

	<tr height="30">
     <td width="120">Alternate Person</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='altperson' id='altperson' size="35" tabindex="15" class="textbox"/></td>
	</tr>

	<tr height="30">
		<td width="120" nowrap="nowrap" style="white-space:nowrap;" >Alternate Person Number</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='altpersonnumber' id='altpersonnumber' size="35" tabindex="16" class="textbox"/></td>
    </tr>

	<!--<tr height="30">
		<td width="120">Lease Renewal Date*</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='renewaldate' id='renewaldate' value="<?php echo date('d-m-Y'); ?>" tabindex="18" class="datepicker textbox"/></td>
	    </tr>-->
    </table>
   </td>
  </tr>
</table>
</fieldset>
</td>
</tr>
</table>




<table width="100%" align="right">
 <tr>
  <td>
 <fieldset align="left" class="alignment2">
  <legend ><strong>Company Liaison</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Employee Name*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
		echo '<select name="emp_code" id="emp_code" tabindex="17" style="width:291px;" class="selectbox">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_emp_id))
		{
		echo '<option value="'.$row['emp_code'].'">'.$row['first_name'].'</option>';

		}
		echo '</select>';
		?>
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
		 <td width="164" >Employee Code</td>
		 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td>
		 	<div id="display_empname">
		 		<input type='text' name='empname' id='empname' tabindex="18" size="3" readonly class="textbox" />
		 	</div>
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

</div>

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
	  
	  <input type="submit" name="sixa" id="sixa" class="buttons" value="Save" />

	  <!-- <a href="#" id="sixa"      style="width:80px;" class="buttons" >Save</a> -->
	  
	  &nbsp;&nbsp;&nbsp;&nbsp;</div>
	 <input type="hidden" name="formsaveval" id="formsaveval" /> <!-- This will give the value when form is submitted, otherwise it will empty -->
	 <input type="hidden" name="edit_id" id="edit_id" /> <!-- This is the partial saved id of the building table when partial save is completed, it will get the id from the db (ajax) -->
     <input type="reset" name="reset" class="buttons" value="Clear" id="clear" />&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=2'"/>&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_building.php'"/></td>
	 </td>
     </tr>
  </table>
	<div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
</form>
<!-- </div> -->
</div>

<div id="backgroundChatPopup"></div>
<!-- <div id="map-canvas" style="width: 500px; height: 300px"></div> -->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> <!-- THIS IS FOR GOOGLE MAP LOCATION SHOWING GOOGLE API -->
<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile)) {
	include_once($footerfile);
} else {
	echo _FILENOTFOUNT.$footerfile;
}
?>