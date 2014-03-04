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
echo "</pre>";
exit;*/

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
if ($fgmembersite->usertype() == 1)	{
	$header_file='./layout/admin_header.php';
}
if(file_exists($header_file))	{
	include_once($header_file);
}
else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}
?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#saleagreement').change(function() {
	
var existing = new Array();
var checkFile = new Array();
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

function validateForm() {
	var buildingname=document.getElementById("buildingname");
	if(buildingname.value=="") {
		alert("Please enter the building name");
		document.getElementById("buildingname").focus();
		return false;
	}
	
	var building_type=document.getElementById("building_type");
	if(building_type.value==0) {
		alert("Please select the building type");
		document.getElementById("building_type").focus();
		return false;
	}
	
	var city=document.getElementById("city");
	if(city.value==0) {
		alert("Please select the city");
		document.getElementById("city").focus();
		return false;
	}
	var building_status=document.getElementById("building_status");
	if(building_status.value==0) {
		alert("Please select owned/rented/lease ");
		document.getElementById("building_status").focus();
		return false;
	}
	
	var datepurchase=document.getElementById("datepurchase").value;
	if(datepurchase==""||datepurchase==0 || !datepurchase) {
		alert("Please select the datepurchase");
		document.getElementById("datepurchase").focus();
		return false;
	}
	
	var currency=document.getElementById("currency");
	if(currency.value==0) {
		alert("Please select currency ");
		document.getElementById("currency").focus();
		return false;
	}
	
	if(building_status.value==1||building_status.value==3) {
		var cost=document.getElementById("cost");
		if(cost.value=="")
		{
			alert("Please enter the cost");
			document.getElementById("cost").focus();
			return false;
		}
	}
	
	if(building_status.value==2) {
		var rent=document.getElementById("rent");
		if(rent.value=="")
		{
			alert("Please enter the rent");
			document.getElementById("rent").focus();
			return false;
		}
	}
	
	if(building_status.value==2) {
		var periodfrom=document.getElementById("periodfrom");
		if(periodfrom.value==0)
		{
			alert("Please select the period");
			document.getElementById("periodfrom").focus();
			return false;
		}
	}
	
	if(building_status.value==1) {
		var purchasefrom=document.getElementById("purchasefrom");
		if(purchasefrom.value=="") {
			alert("Please enter the purchasefrom");
			document.getElementById("purchasefrom").focus();
			return false;
		}
	}
	
	if(building_status.value==2||building_status.value==3) {
		var landlord=document.getElementById("landlord");
		if(landlord.value=="")
		{
			alert("Please enter the landlord");
			document.getElementById("landlord").focus();
			return false;
		}
		
		var contactperson=document.getElementById("contactperson");
		if(contactperson.value=="")
		{
			alert("Please enter the contactperson");
			document.getElementById("contactperson").focus();
			return false;
		}
		
		var address1=document.getElementById("address1");
		if(address1.value=="")
		{
			alert("Please enter the address1");
			document.getElementById("address1").focus();
			return false;
		}
		
		
		var city_landlord=document.getElementById("city_landlord");
		if(city_landlord.value==0)
		{
			alert("Please select the city");
			document.getElementById("city_landlord").focus();
			return false;
		}
		
		
		var contactnumber=document.getElementById("contactnumber");
		if(contactnumber.value=="")
		{
			alert("Please enter the contactnumber");
			document.getElementById("contactnumber").focus();
			return false;
		}
		
		
		var emailid=document.getElementById("emailid");
		if(emailid.value=="")
		{
			alert("Please enter the emailid");
			document.getElementById("emailid").focus();
			return false;
		}
		
		
		var alternatenumber=document.getElementById("alternatenumber");
		if(alternatenumber.value=="")
		{
			alert("Please enter the alternatenumber");
			document.getElementById("alternatenumber").focus();
			return false;
		}
		
		var altperson=document.getElementById("altperson");
		if(altperson.value=="")
		{
			alert("Please enter the alternate person");
			document.getElementById("altpersont").focus();
			return false;
		}
		
		var altpersonnumber=document.getElementById("altpersonnumber");
		if(altpersonnumber.value=="")
		{
			alert("Please enter the alternate person number");
			document.getElementById("altpersonnumber").focus();
			return false;
		}
	}
	if(building_status.value==3)
	{
		var renewaldate=document.getElementById("renewaldate");
		if(renewaldate==""||renewaldate==0 || !renewaldate) {
			alert("Please select the renewal date");
			document.getElementById("renewaldate").focus();
			return false;
		}
	}
	
	var emp_code=document.getElementById("emp_code");
	if(emp_code.value==0) {
		alert("Please select the employee code");
		document.getElementById("emp_code").focus();
		return false;
	}
	var incharge_empcode=document.getElementById("incharge_empcode");
	if(incharge_empcode.value==0) {
		alert("Please select the incharge employeecode");
		document.getElementById("incharge_empcode").focus();
		return false;
	}
	
	var totalemployee=document.getElementById("totalemployee");
	if(totalemployee.value=="") {
		alert("Please enter the total employees");
		document.getElementById("totalemployee").focus();
		return false;
	}
	
	var maintenancecost=document.getElementById("maintenancecost");
	if(maintenancecost.value=="") {
		alert("Please enter  the maintenancecost");
		document.getElementById("maintenancecost").focus();
		return false;
	}
	var total_currency=document.getElementById("total_currency");
	if(total_currency.value==0) {
		alert("Please select  the total currency");
		document.getElementById("total_currency").focus();
		return false;
	}	
}

function myFunction() {
	document.getElementById("city").value="";
	document.getElementById("city").focus();
	return false;
}
</script>
<!-- <script src="scripts/date.js"></script> 
<link rel="stylesheet" href="style/date.css" media="screen">-->
<script type="text/javascript" language="javascript">
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
   });

   $(document).ready(function() {
		$("#city_landlord").change(function(event) {
			var selvalue_landlord=document.getElementById("city_landlord").value;
			if (selvalue_landlord != 0) {
				  $('#display_state_landlord').load('ajax_building.php?selvalue_landlord='+selvalue_landlord);
			}
			else {
				document.getElementById("state_landlord").value = "";		
			}
		});		
   });

$(document).ready(function() {
	$("#emp_code").change(function(event){
		var selvalue_empcode=document.getElementById("emp_code").value;
		if (selvalue_empcode != 0) {
			  $('#display_empname').load('ajax_building.php?selvalue_empcode='+selvalue_empcode);
		}
		else {
			document.getElementById("empname").value = "";	
		}
    });		
});

$(document).ready(function() {
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
if(isset($_POST['sixa']) && $_POST['sixa'] == 'Save') {
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
	if(isset($_FILES["attach5"]["name"]))
	{
	$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
	$temp = explode(".", $_FILES["attach5"]["name"]);
	$extension = end($temp);
	if (in_array($extension, $allowedExts))
	  {
	  if ($_FILES["attach5"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["attach5"]["error"] . "<br>";
		}
	  else
		{
		if (file_exists("uploads/" . $_FILES["attach5"]["name"]))
		  {
		  //echo $_FILES["attach5"]["name"] . " already exists. ";
		  $attach5="";
		  }
		else
		  {
		  $attach5=$_FILES["attach5"]["name"];
		  move_uploaded_file($_FILES["attach5"]["tmp_name"],
		  "uploads/" . $_FILES["attach5"]["name"]);
		 // echo "Stored in: " . "uploads/" . $_FILES["attach5"]["name"];
		  }
		}
	  }
		else
		{
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

	if($building_status == 1) {
		$datepurchase			=	$_POST['datepurchase'];
		//$cost					=	$fgmembersite->remcom($fgmembersite->remdot($_POST['cost']));
		$cost					=	$_POST['cost'];
		$purchasefrom			=	$_POST['purchasefrom'];
		$saleagreement			=	$saleagreement;
		$purcurrency			=	$_POST['purcurrency'];

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
		$city_landlord			=	$_POST['city_landlord'];
		$state_landlord			=	$_POST['state_landlord'];
		$contactnumber			=	$_POST['contactnumber'];
		$emailid				=	$_POST['emailid'];
		$alternatenumber		=	$_POST['alternatenumber'];
		$altperson				=	$_POST['altperson'];
		$altpersonnumber		=	$_POST['altpersonnumber'];
		$leasedeed				=	$leasedeed;
		$renewaldate			=	$_POST['renewaldate'];
		$rentcurrency			=	$_POST['rentcurrency'];
	}
	$currency					=	$_POST['currency'];
	
	$emp_code					=	$_POST['emp_code'];
	$empname					=	$_POST['empname'];
	//$buildingdesc				=	$_POST['buildingdesc'];
	$attach4					=	$attach4;
	$attach5					=	$attach5;
	$attach6					=	$attach6;
	$attach7					=	$attach7;
	$attach8					=	$attach8;
	$incharge_empcode			=	$_POST['incharge_empcode'];
	$leadername					=	$_POST['leadername'];
	$totalemployee				=	$_POST['totalemployee'];
	$insurancenumber			=	$_POST['insurancenumber'];
	$insurancedate				=	$_POST['insurancedate'];
	$attach9					=	$insuranceagreement;
	$insurancerenewaldue		=	$_POST['insurancerenewaldue'];
	//$maintenancecost			=	$fgmembersite->remcom($fgmembersite->remdot($_POST['maintenancecost']));
	$maintenancecost			=	$_POST['maintenancecost'];
	$total_currency				=	$_POST['total_currency'];

	
	//$sql=('INSERT INTO building (building_name,building_code,building_type,building_city,building_state,address1,address2,address3,building_status,building_purchase,datelease,building_currency,rentcurrency,building_cost,building_rent,building_period,building_purchasefrom,building_saleagreement,building_landlord,landlord_contactperson,landlod_address1,landlod_address2,landlod_address3,landlord_city,landlord_state,landlord_contactno,landlord_email,landlord_alternateno,landlord_altperson,landlord_altpersonno,leasedead,leaserenewaldate,companyliason_empcode,companyliason_empname,build_desc,attach4,attach5,attach6,attach7,attach8,incharge_empcode,incharge_empname,total_employess,insurance_number,insurance_date,attach9,renewal_due,total_maintain_cost,total_currency,created_by)VALUES ("'.$buildingname.'","'.$building_code.'","'.$building_type.'","'.$city.'","'.$state.'","'.$address1.'","'.$address2.'","'.$address3.'","'.$building_status.'","'.$datepurchase.'","'.$datelease.'","'.$purcurrency.'","'.$rentcurrency.'","'.$cost.'","'.$rent.'","'.$periodfrom.'","'.$purchasefrom.'","'.$saleagreement.'","'.$landlord.'","'.$contactperson.'","'.$landlod_address1.'","'.$landlod_address2.'","'.$landlod_address3.'","'.$city_landlord.'","'.$state_landlord.'","'.$contactnumber.'","'.$emailid.'","'.$alternatenumber.'","'.$altperson.'","'.$altpersonnumber.'","'.$leasedeed.'","'.$renewaldate.'","'.$emp_code.'","'.$empname.'","'.$buildingdesc.'","'.$attach4.'","'.$attach5.'","'.$attach6.'","'.$attach7.'","'.$attach8.'","'.$incharge_empcode.'","'.$leadername.'","'.$totalemployee.'","'.$insurancenumber.'","'.$insurancedate.'","'.$attach9.'","'.$insurancerenewaldue.'","'.$maintenancecost.'","'.$total_currency.'","'.$user_id.'")');

	//echo $sql;
	//exit;
	

	if(!mysql_query('INSERT INTO building (building_name,building_code,building_type,building_city,building_state,address1,address2,address3,building_status,building_purchase,datelease,building_currency,rentcurrency,building_cost,building_rent,building_period,building_purchasefrom,building_saleagreement,building_landlord,landlord_contactperson,landlod_address1,landlod_address2,landlod_address3,landlord_city,landlord_state,landlord_contactno,landlord_email,landlord_alternateno,landlord_altperson,landlord_altpersonno,leasedead,leaserenewaldate,companyliason_empcode,companyliason_empname,build_desc,attach4,attach5,attach6,attach7,attach8,incharge_empcode,incharge_empname,total_employess,insurance_number,insurance_date,attach9,renewal_due,total_maintain_cost,total_currency,created_by)VALUES ("'.$buildingname.'","'.$building_code.'","'.$building_type.'","'.$city.'","'.$state.'","'.$address1.'","'.$address2.'","'.$address3.'","'.$building_status.'","'.$datepurchase.'","'.$datelease.'","'.$purcurrency.'","'.$rentcurrency.'","'.$cost.'","'.$rent.'","'.$periodfrom.'","'.$purchasefrom.'","'.$saleagreement.'","'.$landlord.'","'.$contactperson.'","'.$landlod_address1.'","'.$landlod_address2.'","'.$landlod_address3.'","'.$city_landlord.'","'.$state_landlord.'","'.$contactnumber.'","'.$emailid.'","'.$alternatenumber.'","'.$altperson.'","'.$altpersonnumber.'","'.$leasedeed.'","'.$renewaldate.'","'.$emp_code.'","'.$empname.'","'.$buildingdesc.'","'.$attach4.'","'.$attach5.'","'.$attach6.'","'.$attach7.'","'.$attach8.'","'.$incharge_empcode.'","'.$leadername.'","'.$totalemployee.'","'.$insurancenumber.'","'.$insurancedate.'","'.$attach9.'","'.$insurancerenewaldue.'","'.$maintenancecost.'","'.$total_currency.'","'.$user_id.'")')) {
		die('Error: ' . mysql_error());
	}
	$fgmembersite->RedirectToURL("view_building.php?success=create");
	echo "&nbsp;";
}
?>
<!-- <div id="inside_content"> -->
<?php
if(isset($_GET['success']))
{
	if ($_GET['success']=="true") { ?>
		<span class="success_message">Building created successfully</span>
		<?php
	}
}
?>
<style type="text/css">
#mainareabuild {
	width:100%;
	height:500px;
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
  background:url(../images/close_pop.png) no-repeat;
  color:transparent;
}
.scroll_box {
	height:380px;
	overflow:auto;
}
</style>
<script type="text/javascript" language="javascript">
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
		
	$("#prevfirsta").on("click",function() {
		$("#firstdiv").css('display','block');
		$("#secdiv").css('display','none');
		$("#thirddiv").css('display','none');
		$("#fourdiv").css('display','none');

		$("#first_span").css('display','inline');
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

		if($("#building_status").val() == 1) {
			$("#owneddiv").css('display','block');
			$("#rentdiv").css('display','none');
		} if($("#building_status").val() == 2) {
			$("#owneddiv").css('display','none');
			$("#rentdiv").css('display','block');
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
		} else if(add1 == '') {
			$('.myalignbuild').html('ERR : Enter Address');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#address1").focus();
			return false;
		} else if(cityval == '0') {
			$('.myalignbuild').html('ERR : Select City');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#city").focus();
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
		$("#third_span").css('display','none');
		$("#four_span").css('display','none');
		$("#five_span").css('display','none');
		$("#six_span").css('display','none');

		if($("#building_status").val() == 1) {
			$("#owneddiv").css('display','block');
			$("#rentdiv").css('display','none');
		} if($("#building_status").val() == 2) {
			$("#owneddiv").css('display','none');
			$("#rentdiv").css('display','block');
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

	$("#seca").on("click", function() {
		//alert("232");
		var bu_sta		=	$("#building_status").val();

		//alert(Dateval);
		
		var currentdate				=	new Date();

		if(bu_sta == 0) {
			$('.myalignbuild').html('ERR : Select Building Status');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#building_status").focus();
			return false;
		}
		
		if(bu_sta == 1) {

			var Dateval		=	$("#datepurchase").val();
			var pur_from	=	$("#purchasefrom").val();
			var costval		=	$("#cost").val();
			var curval		=	$("#purcurrency").val();
			var sal_agr		=	$("#saleagreement").val();

			var dte2		=	parseInt(Dateval.substring(0,2),10);
			var mont2		=	(parseInt(Dateval.substring(3,5), 10)) -1;
			var year2		=	parseInt(Dateval.substring(6,10),10);

			var date2		=	new Date(year2,mont2,dte2);

			//alert(date2);
			//alert(currentdate);

			if (date2 > currentdate){
				$('.myalignbuild').html('ERR : Date greater than today!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#datepurchase").focus();
				return false;
			}

			if(pur_from == '') {
				$('.myalignbuild').html('ERR : Enter Purchased From');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#purchasefrom").focus();
				return false;
			} else if(costval == '') {
				$('.myalignbuild').html('ERR : Enter Cost');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#cost").focus();
				return false;
			} else if(curval == '') {
				$('.myalignbuild').html('ERR : Add Currency');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#purcurrency").focus();
				return false;
			} else if(sal_agr == '') {
				$('.myalignbuild').html('ERR : Choose Sale Deed');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#saleagreement").focus();
				return false;
			}
		} else if(bu_sta == 2) {

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

			var dte2			=	parseInt(Dateval.substring(0,2),10);
			var mont2			=	(parseInt(Dateval.substring(3,5), 10)) -1;
			var year2			=	parseInt(Dateval.substring(6,10),10);

			var ren_dte2		=	parseInt(ren_date.substring(0,2),10);
			var ren_mont2		=	(parseInt(ren_date.substring(3,5), 10)) -1;
			var ren_year2		=	parseInt(ren_date.substring(6,10),10);

			var date2			=	new Date(year2,mont2,dte2);
			var ren_date2		=	new Date(ren_year2,ren_mont2,ren_dte2);

			if (date2 > currentdate){
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
			} else if(rent == '') {
				$('.myalignbuild').html('ERR : Enter Rent');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#rent").focus();
				return false;
			} else if(curval == '') {
				$('.myalignbuild').html('ERR : Add Currency');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#rentcurrency").focus();
				return false;
			} else if(landlord == '') {
				$('.myalignbuild').html('ERR : Enter Landlord');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#landlord").focus();
				return false;
			} else if(land_add1 == '') {
				$('.myalignbuild').html('ERR : Enter Address Line 1');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#land_add1").focus();
				return false;
			} else if(city_land == '0') {
				$('.myalignbuild').html('ERR : Select City');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#city_landlord").focus();
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
					/*alert('Invalid Email Address');
					document.getElementById("email").focus();
					return false;*/
					$('.myalignbuild').html('ERR : Invalid Email Address');
					$('#errormsgbuild').css('display','block');
					setTimeout(function() {
						$('#errormsgbuild').hide();
					},5000);
					$("#emailid").focus();
					return false;							
				}
			}
			
			if(con_per == '') {
				$('.myalignbuild').html('ERR : Enter Contact Person');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#contactperson").focus();
				return false;
			} else if(con_num == '') {
				$('.myalignbuild').html('ERR : Enter Contact Number');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#contactnumber").focus();
				return false;
			} else if(leasedeed == '') {
				$('.myalignbuild').html('ERR : Choose Lease Deed');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#leasedeed").focus();
				return false;
			} else if(ren_date == '') {
				$('.myalignbuild').html('ERR : Select Renewal Date');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#renewaldate").focus();
				return false;
			} else if (ren_date2 < currentdate){
				$('.myalignbuild').html('ERR : Date Less than today!');
				$('#errormsgbuild').css('display','block');
				setTimeout(function() {
					$('#errormsgbuild').hide();
				},5000);
				$("#renewaldate").focus();
				return false;
			}
		}
		
		$("#firstdiv").css('display','none');
		$("#secdiv").css('display','none');
		$("#thirddiv").css('display','block');
		$("#fourdiv").css('display','none');

		$("#prev_span").css('display','none');
		$("#sec_span").css('display','none');
		$("#first_span").css('display','none');
		$("#five_span").css('display','none');
		$("#six_span").css('display','none');

		$("#third_span").css('display','inline');
		$("#four_span").css('display','inline');
	});

	$("#foura").on("click", function() {
		//alert("232");
	
		var liaison_emp		=	$("#emp_code").val();
		var attach4			=	$("#attach4").val();
		var inc_emp			=	$("#incharge_empcode").val();
		var totemp			=	$("#totalemployee").val();

		//alert(date2);
		//alert(currentdate);

		if(liaison_emp == '0') {
			$('.myalignbuild').html('ERR : Select Liaison Employee Code');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#emp_code").focus();
			return false;
		} else if(attach4 == '') {
			$('.myalignbuild').html('ERR : Choose Floor Drawings');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#attach4").focus();
			return false;
		} else if(inc_emp == '0') {
			$('.myalignbuild').html('ERR : Select In-Charge Employee Code');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#incharge_empcode").focus();
			return false;
		} else if(totemp == '') {
			$('.myalignbuild').html('ERR : Enter Total Count');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#totalemployee").focus();
			return false;
		} else if(isNaN(totemp)) {
			$('.myalignbuild').html('ERR : Only Numerals');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#totalemployee").focus();
			return false;
		}
		
		$("#firstdiv").css('display','none');
		$("#secdiv").css('display','none');
		$("#thirddiv").css('display','none');
		$("#fourdiv").css('display','block');

		$("#prev_span").css('display','none');
		$("#sec_span").css('display','none');
		$("#first_span").css('display','none');
		$("#five_span").css('display','inline');
		$("#six_span").css('display','inline');

		$("#third_span").css('display','none');
		$("#four_span").css('display','none');
	});

	//$("#sixa").on("click", function() {	
});

function submitBuildForm () {
	//alert("232");

	var ins_num			=	$("#insurancenumber").val();
	var ins_date		=	$("#insurancedate").val();
	var ins_agr			=	$("#insuranceagreement").val();
	var ins_ren			=	$("#insurancerenewaldue").val();
	var main_cost		=	$("#maintenancecost").val();
	var tot_cur			=	$("#total_currency").val();
	//alert(date2);
	//alert(currentdate);
	
	var	currentdate		=	new Date();
	var dte2			=	parseInt(ins_date.substring(0,2),10);
	var mont2			=	(parseInt(ins_date.substring(3,5), 10)) -1;
	var year2			=	parseInt(ins_date.substring(6,10),10);

	var ren_dte2		=	parseInt(ins_ren.substring(0,2),10);
	var ren_mont2		=	(parseInt(ins_ren.substring(3,5), 10)) -1;
	var ren_year2		=	parseInt(ins_ren.substring(6,10),10);

	var date2			=	new Date(year2,mont2,dte2);
	var ren_date2		=	new Date(ren_year2,ren_mont2,ren_dte2);


	if(ins_num == '') {
		$('.myalignbuild').html('ERR : Enter Insurance No.');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		$("#insurancenumber").focus();
		return false;
	} else if(date2 > currentdate) {
		$('.myalignbuild').html('ERR : Date Greater Than Today');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		$("#insurancedate").focus();
		return false;
	} else if(ins_agr == '') {
		$('.myalignbuild').html('ERR : Choose Insurance Agreement');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		$("#insuranceagreement").focus();
		return false;
	} else if(ins_ren == '') {
		$('.myalignbuild').html('ERR : Select Date');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		$("#insurancerenewaldue").focus();
		return false;
	} else if(ren_date2 < currentdate) {
		$('.myalignbuild').html('ERR : Date Less Than Today');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		$("#insurancerenewaldue").focus();
		return false;
	} else if(main_cost == '') {
		$('.myalignbuild').html('ERR : Enter Maintenance Cost');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		$("#maintenancecost").focus();
		return false;
	} else if(tot_cur == '') {
		$('.myalignbuild').html('ERR : Add Currency');
		$('#errormsgbuild').css('display','block');
		setTimeout(function() {
			$('#errormsgbuild').hide();
		},5000);
		$("#total_currency").focus();
		return false;
	}
	
	//alert($("#building_save").serialize());
	//return false;
	
	/*$("#firstdiv").css('display','block');
	$("#secdiv").css('display','block');
	$("#thirddiv").css('display','block');
	$("#fourdiv").css('display','block');

	if($("#building_status").val() == 1) {
		$("#owneddiv").css('display','block');
		$("#rentdiv").css('display','none');
	} else if($("#building_status").val() == 2) {
		$("#owneddiv").css('display','none');
		$("#rentdiv").css('display','block');
	}*/
	
	return true;
	/*$("#building_save").submit(function() {
		//alert($("#building_save").serialize());			
	});	*/
}
</script>
<div id="mainareabuild">
<div class="mcf"></div>
<div align="center" class="headingsgr">BUILDING</div>
<div id="mytableformbuild" align="center">

<!-- <div class="header_bold">BUILDING</div>
<div class="scroll">
 -->

<form id='building_save' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' onSubmit="return submitBuildForm();" enctype="multipart/form-data">


<div class="scroll_box">
<div id="firstdiv">
<fieldset align="left" class="alignment">
  <legend ><strong>Building</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Building Code</td>
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
   <input type='text' name='code' id='code' class="textbox" value="<?php echo $customer_code;?>" readonly="true"/>
	</td>
    </tr>
    
	<tr height="40">
     <td width="120">Building Type*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
			$result_state=mysql_query("SELECT * FROM building_type");
			echo '<select name="building_type" id="building_type" tabindex="2" class="selectbox">';
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
	<tr height="32">
		 <td width="120" nowrap="nowrap">Building Name*</td>
		 <td><input type='text' name='buildingname' id='buildingname' tabindex="1" style="width:200px;" class="textbox"/></td>
	</tr>
     
	<tr height="40">
		<td width="120"></td>
		<td></td>
    </tr>
   </table>
  </td>
 </tr>
</table>

<!----------------------------------------------- Right Table End -------------------------------------->

</fieldset>


<fieldset align="left" class="alignment">
  <legend><strong>Building Address</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Address Line 1*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><textarea id="address1" name="address1" tabindex="3" class="areatext"></textarea></td>
    </tr>
    
	<tr height="40">
     <td width="120">Address Line 3</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><textarea id="address3" name="address3" tabindex="5" class="areatext"></textarea></td>
	</tr>

	<tr height="40">
     <td width="120">State</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><div id="display_state"><input type='text' name='state' id='state' readonly tabindex="7" class="textbox" /></div></td>
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
     <td width="120" nowrap="nowrap">Address Line 2</td>
     <td><textarea id="address2" name="address2" tabindex="4" class="areatext"></textarea></td>
	</tr>
     
	<tr height="40">
		<td width="120">City*</td>
		<td><?php
			$result_state=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id");
			echo '<select name="city" id="city" tabindex="6" >';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state))
			{
			echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';

			}
			echo '</select>';
			?>
		</td>
    </tr>
       </table>
       </td>
     </tr>
</table>

</fieldset>
</div>


<div id="secdiv">
<fieldset align="left" class="alignment">
  <legend><strong>Owned/Rented/Lease</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="150" nowrap="nowrap">Owned/Rented/Lease*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><select name="building_status" id="building_status" tabindex="0" class="selectbox">
			<option value="0">--Select--</option>
			<option value="1">Owned</option>
			<option value="2">Rented/Lease</option>
			<!-- <option value="3">Lease</option> -->
		</select></td>
    </tr>
    </table>
    </td>
  </tr>
 </table>
 </fieldset>


<div id="owneddiv">
 <fieldset align="left" class="alignment">
  <legend><strong>Owned</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="150" >Date of Purchase (Reg.)*</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='datepurchase' id='datepurchase' value="<?php echo date('d-m-Y'); ?>" tabindex="1" class="datepicker textbox"/></td>
    </tr>
    
	<tr height="40">
     <td width="120">Cost*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='cost' id='cost' style="text-align:right;" tabindex="3" class="textbox"/></td>
	</tr>

	<tr height="40">
     <td width="120">Purchase/Sale Deed Agreement*</td>
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
	<tr height="32">
     <td width="120" nowrap="nowrap">Purchased From</td>
     <td><input type='text' name='purchasefrom' id='purchasefrom' style="width:200px;" tabindex="2" class="textbox"/></td>
	</tr>
     
	<tr height="40">
		<?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT * FROM currency");
			$row=mysql_fetch_array($result_state);
		?>
		<td width="120" >Currency &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<!-- <td><img width="15px" height="15px" src="images/currency.gif"></td> -->
		<td><input type='text' name='purcurrency' id='purcurrency' value="<?php echo $row['name']; ?>" tabindex="4" readonly class="textbox"/></td>
    </tr>
       </table>
       </td>
     </tr>
</table>
</fieldset>
</div>


<div id="rentdiv">
 <fieldset align="left" class="alignment">
  <legend><strong>Rented/Lease</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="150">Date of Lease Agreement*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='datelease' id='datelease' value="<?php echo date('d-m-Y'); ?>" tabindex="1" class="datepicker textbox"/></td>
    </tr>
    
	<tr height="40">
     <td width="120">Rent*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='rent' id='rent' style="text-align:right;" tabindex="3" class="textbox"/></td>
	</tr>

	<tr height="40">
     <td width="120">Landlord*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='landlord' id='landlord' tabindex="5" class="textbox"/></td>
	</tr>

	<tr height="40">
     <td width="120">Address Line 2</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><textarea id="land_add2" name="land_add2" tabindex="7" class="areatext"></textarea></td>
	</tr>

	<tr height="40">
     <td width="120">City*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><?php
		$result_state=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id");
		echo '<select name="city_landlord" id="city_landlord" tabindex="9" >';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state))
		{
			echo '<option value="'.$row['id'].'">'.$fgmembersite->upperstate($row['name']).'</option>';
		}
		echo '</select>';
	?></td>
	</tr>

	<tr height="40">
     <td width="120">Email ID*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='emailid' id='emailid' tabindex="11" class="textbox"/></td>
	</tr>

	<tr height="40">
     <td width="120">Contact Number*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='contactnumber' id='contactnumber' tabindex="13" class="textbox"/></td>
	</tr>

	<tr height="40">
     <td width="120">Alternate Person</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='altperson' id='altperson' tabindex="15" class="textbox"/></td>
	</tr>

	<tr height="40">
     <td width="120">Rent/Lease Deed*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='file' name='leasedeed' id='leasedeed' style="width:230px;" tabindex="17" class="textbox"/></td>
	</tr>



   </table>
   </td>
 </tr>
</table>

<table width="50%" align="left">
 <tr>
  <td>
  <table>

	<tr height="32">
     <td width="120" nowrap="nowrap">Period*</td>
     <td><select name="periodfrom" id="periodfrom" tabindex="2" class="selectbox">
			<option value="0">--Select--</option>
			<option value="1">Monthly</option>
			<option value="2">Quarterly</option>
			<option value="3">Halfyearly</option>
			<option value="4">Yearly</option>
		</select></td>
	</tr>
     
	<tr height="40">
		<?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT * FROM currency");
			$row=mysql_fetch_array($result_state);
		?>
		<td width="120">Currency&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<td><input type='text' name='rentcurrency' id='rentcurrency' value="<?php echo $row['name']; ?>" tabindex="4" readonly class="textbox"/></td>
    </tr>

	<tr height="40">
		<td width="120">Address Line 1*</td>
		<td><textarea id="land_add1" name="land_add1" tabindex="6" class="areatext"></textarea></td>
    </tr>

	<tr height="40">
		<td width="120">Address Line 3</td>
		<td><textarea id="land_add3" name="land_add3" tabindex="8" class="areatext"></textarea></td>
    </tr>

	<tr height="40">
		<td width="120">State</td>
		<td><div id="display_state_landlord"><input type='text' name='state_landlord' id='state_landlord' tabindex="10" class="textbox" /></div></td>
    </tr>

	<tr height="40">
		<td width="120">Contact Person*</td>
		<td><input type='text' name='contactperson' id='contactperson' tabindex="12" class="textbox"/></td>
    </tr>

	<tr height="40">
		<td width="120">Alternate Number</td>
		<td><input type='text' name='alternatenumber' id='alternatenumber' tabindex="14" class="textbox"/></td>
    </tr>

	<tr height="40">
		<td width="120">Alternate Person Number</td>
		<td><input type='text' name='altpersonnumber' id='altpersonnumber' tabindex="16" class="textbox"/></td>
    </tr>

	<tr height="40">
		<td width="120">Lease Renewal Date*</td>
		<td><input type='text' name='renewaldate' id='renewaldate' value="<?php echo date('d-m-Y'); ?>" tabindex="18" class="datepicker textbox"/></td>
    </tr>

       </table>
       </td>
     </tr>
</table>
</fieldset>
</div>

</div>

<div id="thirddiv">
<fieldset align="left" class="alignment">
  <legend ><strong>Company Liaison</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Employee Code*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
		echo '<select name="emp_code" id="emp_code" tabindex="1" class="selectbox">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_emp_id))
		{
		echo '<option value="'.$row['emp_code'].'">'.$row['emp_code'].'</option>';

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
	<tr height="32">
		 <td width="120" nowrap="nowrap">Employee Name</td>
		 <td><div id="display_empname"><input type='text' name='empname' tabindex="2" id='empname' readonly class="textbox"/></div></td>
	</tr>     
   </table>
  </td>
 </tr>
</table>

<!----------------------------------------------- Right Table End -------------------------------------->

</fieldset>


<fieldset align="left" class="alignment">
  <legend><strong>Building Image</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Floor Drawings 1*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='file' name='attach4' id='attach4' tabindex="3" class="textbox"/></td>
    </tr>
    
	<tr height="40">
     <td width="120">Floor Drawings 3</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='file' name='attach6' id='attach6' tabindex="5" class="textbox"/></td>
	</tr>

	<tr height="40">
     <td width="120">Floor Drawings 5</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='file' name='attach8' id='attach8' tabindex="7" class="textbox"/></td>
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
     <td width="120" nowrap="nowrap">Floor Drawings 2</td>
     <td><input type='file' name='attach5' id='attach5' tabindex="4" class="textbox"/></td>
	</tr>
     
	<tr height="40">
		<td width="120">Floor Drawings 4</td>
		<td><input type='file' name='attach7' id='attach7' tabindex="6" class="textbox"/></td>
    </tr>
       </table>
       </td>
     </tr>
</table>
</fieldset>

<fieldset align="left" class="alignment">
  <legend><strong>Building In-Charge/Leader & Total Members in Bldg.</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">In-Charge EMP Code*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
		echo '<select name="incharge_empcode" id="incharge_empcode" tabindex="8" class="selectbox">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_emp_id))
		{
		echo '<option value="'.$row['emp_code'].'">'.$row['emp_code'].'</option>';

		}
		echo '</select>';
		?>
	</td>
    </tr>
    
	<tr height="40">
     <td width="120">Total No. Of Emp/Mem in Bldg.*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='totalemployee' id='totalemployee' tabindex="10" class="textbox"/></td>
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
     <td width="120" nowrap="nowrap">In-Charge EMP Name</td>
     <td><div id="display_inchargename"><input type='text' name='leadername' id='leadername' readonly tabindex="9" class="textbox"/></div></td>
	</tr>     
    </table>
   </td>
  </tr>
</table>
</fieldset>
</div>

<div id="fourdiv">
<fieldset align="left" class="alignment">
  <legend><strong>Insurance</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Insurance No.*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='insurancenumber' id='insurancenumber' tabindex="1" class="textbox"/></td>
    </tr>
    
	<tr height="40">
     <td width="120">Insurance Agree. (Upload)*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='file' name='insuranceagreement' id='insuranceagreement' tabindex="3" class="textbox"/></td>
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
     <td width="120" nowrap="nowrap">Insurance Date*</td>
     <td><input type='text' name='insurancedate' id='insurancedate'	value="<?php echo date('d-m-Y'); ?>" tabindex="2" class="datepicker textbox"/></td>
	</tr>
	
	<tr height="32">
     <td width="120" nowrap="nowrap">Insurance Renewal Due*</td>
     <td><input type='text' name='insurancerenewaldue' id='insurancerenewaldue' value="<?php echo date('d-m-Y'); ?>" tabindex="4" class="datepicker textbox"/></td>
	</tr> 

    </table>
   </td>
  </tr>
</table>
</fieldset>


<fieldset align="left" class="alignment">
  <legend><strong>Maintenance</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Total Maint. Costs*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type='text' name='maintenancecost' id='maintenancecost' tabindex="5" class="textbox"/></td>
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
	<?php
		$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT * FROM currency");
		$row=mysql_fetch_array($result_state);
	?>
     <td width="156" >Currency&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
     <td><input type='text' name='total_currency' id='total_currency' value="<?php echo $row['name']; ?>" tabindex="6" readonly class="textbox"/></td>
	</tr>
   </table>
   </td>
  </tr>
</table>
</fieldset>
</div>

</div>
</div>
 <table width="100%" style="clear:both">
      <tr align="center" height="50px;">
      <td nowrap="nowrap">
	  
	  <div id="prev_span"  style="display:inline;"><a href="#" id="prevfirsta" style="width:80px;" class="buttons" >Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
	  <div id="first_span" style="display:inline;"><a href="#" id="firsta"	style="width:80px;" class="buttons" >Continue</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
	  <div id="sec_span"   style="display:inline;"><a href="#" id="seca"	style="width:80px;" class="buttons" >Next    </a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

	  <div id="third_span" style="display:inline;"><a href="#" id="thirda"     style="width:80px;" class="buttons" >Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
	  <div id="four_span"  style="display:inline;"><a href="#" id="foura"      style="width:80px;" class="buttons" >Next</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>

	  <div id="five_span"  style="display:inline;"><a href="#" id="fivea"      style="width:80px;" class="buttons" >Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
	  <div id="six_span"  style="display:inline;">
	  
	  <input type="submit" name="sixa" id="sixa" class="buttons" value="Save" />

	  <!-- <a href="#" id="sixa"      style="width:80px;" class="buttons" >Save</a> -->
	  
	  &nbsp;&nbsp;&nbsp;&nbsp;</div>
	  	  
     <input type="reset" name="reset" class="buttons" value="Clear" id="clear" />&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='include/empty.php'"/>&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_building.php'"/></td>
	 </td>
     </tr>
  </table>
	<div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>

</form>
<!-- </div> -->
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