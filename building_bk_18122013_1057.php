<?PHP
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

ini_set("display_errors",true);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
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
								alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
								document.getElementById("saleagreement").value="";
								return false;
							}
							//return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("saleagreement").value="";
                            return false;
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
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("leasedeed").value="";
							return false;
							}
							//return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("leasedeed").value="";
                            return false;
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
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("insuranceagreement").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("insuranceagreement").value="";
                            return false;
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
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("attach4").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("attach4").value="";
                            return false;
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
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("attach5").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("attach5").value="";
                            return false;
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
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("attach6").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("attach6").value="";
                            return false;
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
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("attach7").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("attach7").value="";
                            return false;
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
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("attach8").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("attach8").value="";
                            return false;
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

function validateForm()
{
	var buildingname=document.getElementById("buildingname");
	if(buildingname.value=="")
	{
	alert("Please enter the building name");
	document.getElementById("buildingname").focus();
	return false;
	}
	
	var building_type=document.getElementById("building_type");
	if(building_type.value==0)
	{
	alert("Please select the building type");
	document.getElementById("building_type").focus();
	return false;
	}
	
	var city=document.getElementById("city");
	if(city.value==0)
	{
	alert("Please select the city");
	document.getElementById("city").focus();
	return false;
	}
	var building_status=document.getElementById("building_status");
	if(building_status.value==0)
	{
	alert("Please select owned/rented/lease ");
	document.getElementById("building_status").focus();
	return false;
	}
	
	var datepurchase=document.getElementById("datepurchase").value;
	if(datepurchase==""||datepurchase==0 || !datepurchase)
	{
	alert("Please select the datepurchase");
	document.getElementById("datepurchase").focus();
	return false;
	}
	
	var currency=document.getElementById("currency");
	if(currency.value==0)
	{
	alert("Please select currency ");
	document.getElementById("currency").focus();
	return false;
	}
	
	if(building_status.value==1||building_status.value==3)
	{
	var cost=document.getElementById("cost");
	if(cost.value=="")
	{
	alert("Please enter the cost");
	document.getElementById("cost").focus();
	return false;
	}
	}
	
	if(building_status.value==2)
	{
	var rent=document.getElementById("rent");
	if(rent.value=="")
	{
	alert("Please enter the rent");
	document.getElementById("rent").focus();
	return false;
	}
	}
	
	if(building_status.value==2)
	{
	var periodfrom=document.getElementById("periodfrom");
	if(periodfrom.value==0)
	{
	alert("Please select the period");
	document.getElementById("periodfrom").focus();
	return false;
	}
	}
	
	if(building_status.value==1)
	{
	var purchasefrom=document.getElementById("purchasefrom");
	if(purchasefrom.value=="")
	{
	alert("Please enter the purchasefrom");
	document.getElementById("purchasefrom").focus();
	return false;
	}
	}

	
	if(building_status.value==2||building_status.value==3)
	{
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
	if(renewaldate==""||renewaldate==0 || !renewaldate)
	{
	alert("Please select the renewal date");
	document.getElementById("renewaldate").focus();
	return false;
	}
	}
	
	var emp_code=document.getElementById("emp_code");
	if(emp_code.value==0)
	{
	alert("Please select the employee code");
	document.getElementById("emp_code").focus();
	return false;
	}
	var incharge_empcode=document.getElementById("incharge_empcode");
	if(incharge_empcode.value==0)
	{
	alert("Please select the incharge employeecode");
	document.getElementById("incharge_empcode").focus();
	return false;
	}
	
	var totalemployee=document.getElementById("totalemployee");
	if(totalemployee.value=="")
	{
	alert("Please enter the total employees");
	document.getElementById("totalemployee").focus();
	return false;
	}
	
	var maintenancecost=document.getElementById("maintenancecost");
	if(maintenancecost.value=="")
	{
	alert("Please enter  the maintenancecost");
	document.getElementById("maintenancecost").focus();
	return false;
	}
	var total_currency=document.getElementById("total_currency");
	if(total_currency.value==0)
	{
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
<script src="scripts/date.js"></script>
<link rel="stylesheet" href="style/date.css" media="screen">
<script type="text/javascript" language="javascript">
   $(document).ready(function() {
	$("#city").change(function(event){
	var selvalue=document.getElementById("city").value;
	if (selvalue != 0)
	{
          $('#display_state').load('ajax_building.php?selvalue='+selvalue);
	}
	else
	{
	document.getElementById("state").value = "";
	
	}
      });		
   });
   </script>
   <script type="text/javascript" language="javascript">
   $(document).ready(function() {
	$("#city_landlord").change(function(event){
	var selvalue_landlord=document.getElementById("city_landlord").value;
	if (selvalue_landlord != 0)
	{
          $('#display_state_landlord').load('ajax_building.php?selvalue_landlord='+selvalue_landlord);
	}
	else
	{
	document.getElementById("state_landlord").value = "";
	
	}
      });		
   });

$(document).ready(function() {
	$("#building_status").change(function(event){
	var selvalue_status=document.getElementById("building_status").value;
	//alert(selvalue_status);
	if (selvalue_status == 1 )
	{
	$("#rent").attr("disabled", "disabled"); 
	$("#cost").removeAttr("disabled"); 
	$("#periodfrom").attr("disabled", "disabled");
	$("#purchasefrom").removeAttr("disabled"); 
	$("#saleagreement").removeAttr("disabled"); 
	$("#landlord").attr("disabled", "disabled"); 
	$("#contactperson").attr("disabled", "disabled"); 
	$("#address1").attr("disabled", "disabled");  
	$("#address2").attr("disabled", "disabled");  
	$("#address3").attr("disabled", "disabled"); 
	$("#city_landlord").attr("disabled", "disabled"); 
	$("#state_landlord").attr("disabled", "disabled"); 
	$("#contactnumber").attr("disabled", "disabled"); 	
	$("#emailid").attr("disabled", "disabled");  	
	$("#alternatenumber").attr("disabled", "disabled"); 
    $("#altperson").attr("disabled", "disabled"); 
	$("#altpersonnumber").attr("disabled", "disabled"); 
	$("#leasedeed").attr("disabled", "disabled");
	$("#renewaldate").attr("disabled", "disabled");   
	
	}
	if (selvalue_status == 2)
	{
	$("#rent").removeAttr("disabled"); 
	$("#cost").attr("disabled", "disabled"); 
	$("#periodfrom").removeAttr("disabled"); 
	$("#purchasefrom").attr("disabled", "disabled");
	$("#saleagreement").attr("disabled", "disabled");
	
	$("#landlord").removeAttr("disabled");
	$("#contactperson").removeAttr("disabled"); 
	$("#address1").removeAttr("disabled"); 
	$("#address2").removeAttr("disabled"); 
	$("#address3").removeAttr("disabled");
	$("#city_landlord").removeAttr("disabled"); 	
	$("#state_landlord").removeAttr("disabled"); 	
	$("#contactnumber").removeAttr("disabled"); 	
	$("#emailid").removeAttr("disabled"); 	
	$("#alternatenumber").removeAttr("disabled");
    $("#altperson").removeAttr("disabled");
	$("#altpersonnumber").removeAttr("disabled");
	$("#leasedeed").attr("disabled", "disabled");
	$("#renewaldate").attr("disabled", "disabled");   	
	
	}
	if (selvalue_status == 3)
	{
	$("#rent").attr("disabled", "disabled"); 
	$("#cost").removeAttr("disabled"); 
	$("#periodfrom").attr("disabled", "disabled");
	$("#purchasefrom").attr("disabled", "disabled");
	$("#saleagreement").attr("disabled", "disabled");
	$("#landlord").removeAttr("disabled");
	$("#contactperson").removeAttr("disabled"); 
	$("#address1").removeAttr("disabled"); 
	$("#address2").removeAttr("disabled"); 
	$("#address3").removeAttr("disabled");
	$("#city_landlord").removeAttr("disabled"); 	
	$("#state_landlord").removeAttr("disabled"); 	
	$("#contactnumber").removeAttr("disabled"); 	
	$("#emailid").removeAttr("disabled"); 	
	$("#alternatenumber").removeAttr("disabled");
    $("#altperson").removeAttr("disabled");
	$("#altpersonnumber").removeAttr("disabled");
	$("#leasedeed").removeAttr("disabled");
	$("#renewaldate").removeAttr("disabled");
	}
	if (selvalue_status == 0)
	{
	$("#rent").removeAttr("disabled"); 
	$("#cost").removeAttr("disabled");
	$("#periodfrom").removeAttr("disabled");
	$("#purchasefrom").removeAttr("disabled"); 
	$("#saleagreement").removeAttr("disabled"); 
	$("#landlord").removeAttr("disabled");
	$("#contactperson").removeAttr("disabled"); 
	$("#address1").removeAttr("disabled"); 
	$("#address2").removeAttr("disabled"); 
	$("#address3").removeAttr("disabled");
	$("#city_landlord").removeAttr("disabled"); 	
	$("#state_landlord").removeAttr("disabled"); 	
	$("#contactnumber").removeAttr("disabled"); 	
	$("#emailid").removeAttr("disabled"); 	
	$("#alternatenumber").removeAttr("disabled");
    $("#altperson").removeAttr("disabled");
	$("#altpersonnumber").removeAttr("disabled");
	$("#leasedeed").removeAttr("disabled");
	$("#renewaldate").removeAttr("disabled");	
	
	}


      });		
   });
window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"datepurchase",
			dateFormat:"%Y-%m-%d"
		});		
		new JsDatePick({
			useMode:2,
			target:"insurancerenewaldue",
			dateFormat:"%Y-%m-%d"

		});
					  new JsDatePick({
			useMode:2,
			target:"insurancedate",
			dateFormat:"%Y-%m-%d"

		});
			  new JsDatePick({
			useMode:2,
			target:"renewaldate",
			dateFormat:"%Y-%m-%d"

		});
	};

$(document).ready(function() {
	$("#emp_code").change(function(event){
	var selvalue_empcode=document.getElementById("emp_code").value;
	if (selvalue_empcode != 0)
	{
          $('#display_empname').load('ajax_building.php?selvalue_empcode='+selvalue_empcode);
	}
	else
	{
	document.getElementById("empname").value = "";
	
	}
      });		
   });

$(document).ready(function() {
	$("#incharge_empcode").change(function(event){
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
if(isset($_POST['save'])) {
	if(isset($_FILES["saleagreement"]["name"])) {
	$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
	$temp = explode(".", $_FILES["saleagreement"]["name"]);
	$extension = end($temp);
	if (in_array($extension, $allowedExts))
	  {
	  if ($_FILES["saleagreement"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["saleagreement"]["error"] . "<br>";
		}
	  else
		{
		if (file_exists("uploads/" . $_FILES["saleagreement"]["name"]))
		  {
		  //echo $_FILES["saleagreement"]["name"] . " already exists. ";
		  $saleagreement="";
		  }
		else
		  {
		  $saleagreement=$_FILES["saleagreement"]["name"];
		  move_uploaded_file($_FILES["saleagreement"]["tmp_name"],
		  "uploads/" . $_FILES["saleagreement"]["name"]);
		 // echo "Stored in: " . "uploads/" . $_FILES["saleagreement"]["name"];
		  }
		}
	  }
		else
		{
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
		  if ($_FILES["leasedeed"]["error"] > 0)
			{
			echo "Return Code: " . $_FILES["leasedeed"]["error"] . "<br>";
			}
		  else
			{
			if (file_exists("uploads/" . $_FILES["leasedeed"]["name"]))
			  {
			  //echo $_FILES["leasedeed"]["name"] . " already exists. ";
			  $leasedeed="";
			  }
			else
			  {
			  $leasedeed=$_FILES["leasedeed"]["name"];
			  move_uploaded_file($_FILES["leasedeed"]["tmp_name"],
			  "uploads/" . $_FILES["leasedeed"]["name"]);
			 // echo "Stored in: " . "uploads/" . $_FILES["leasedeed"]["name"];
			  }
			}
		}
		else {
			$leasedeed="";
		}
	}

if(isset($_FILES["attach4"]["name"])) {

$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
$temp = explode(".", $_FILES["attach4"]["name"]);
$extension = end($temp);
if (in_array($extension, $allowedExts))
  {
  if ($_FILES["attach4"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["attach4"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("uploads/" . $_FILES["attach4"]["name"]))
      {
      //echo $_FILES["attach4"]["name"] . " already exists. ";
	  $attach4="";
      }
    else
      {
	  $attach4=$_FILES["attach4"]["name"];
      move_uploaded_file($_FILES["attach4"]["tmp_name"],
      "uploads/" . $_FILES["attach4"]["name"]);
     // echo "Stored in: " . "uploads/" . $_FILES["attach4"]["name"];
      }
    }
  }
	else
	{
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
$user_id=$_SESSION['user_id'];
$building_code=$_POST['code'];
$buildingname=$_POST['buildingname'];
$building_type=$_POST['building_type'];
$city=$_POST['city'];
$state=$_POST['state'];
$building_status=$_POST['building_status'];
$datepurchase=$_POST['datepurchase'];
$currency=$_POST['currency'];
$cost=$_POST['cost'];
$rent=$_POST['rent'];
$periodfrom=$_POST['periodfrom'];
$purchasefrom=$_POST['purchasefrom'];
$saleagreement=$saleagreement;
$landlord=$_POST['landlord'];
$contactperson=$_POST['contactperson'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$address3=$_POST['address3'];
$city_landlord=$_POST['city_landlord'];
$state_landlord=$_POST['state_landlord'];
$contactnumber=$_POST['contactnumber'];
$emailid=$_POST['emailid'];
$alternatenumber=$_POST['alternatenumber'];
$altperson=$_POST['altperson'];
$altpersonnumber=$_POST['altpersonnumber'];
$leasedeed=$leasedeed;
$renewaldate=$_POST['renewaldate'];
$emp_code=$_POST['emp_code'];
$empname=$_POST['empname'];
$buildingdesc=$_POST['buildingdesc'];
$attach4=$attach4;
$attach5=$attach5;
$attach6=$attach6;
$attach7=$attach7;
$attach8=$attach8;
$incharge_empcode=$_POST['incharge_empcode'];
$leadername=$_POST['leadername'];
$totalemployee=$_POST['totalemployee'];
$insurancenumber=$_POST['insurancenumber'];
$insurancedate=$_POST['insurancedate'];
$attach9=$insuranceagreement;
$insurancerenewaldue=$_POST['insurancerenewaldue'];
$maintenancecost=$_POST['maintenancecost'];
$total_currency=$_POST['total_currency'];

/*
ca
$sql=('INSERT INTO building (building_name,building_code,building_type,building_city,building_state,building_status,building_purchase,building_currency,building_cost,building_rent,building_period,building_purchasefrom,building_saleagreement,building_landlord,landlord_contactperson,landlod_address1,landlod_address2,landlod_address3,landlord_city,landlord_state,landlord_contactno,landlord_email,landlord_alternateno,landlord_altperson,landlord_altpersonno,leasedead,leaserenewaldate,companyliason_empcode,companyliason_empname,build_desc,attach4,attach5,attach6,attach7,attach8,incharge_empcode,incharge_empname,total_employess,insurance_number,insurance_date,attach9,renewal_due,total_maintain_cost,total_currency,created_by)VALUES ("'.$buildingname.'","'.$building_code.'","'.$building_type.'","'.$city.'","'.$state.'","'.$building_status.'","'.$datepurchase.'","'.$currency.'","'.$cost.'","'.$rent.'","'.$periodfrom.'","'.$purchasefrom.'","'.$saleagreement.'","'.$landlord.'","'.$contactperson.'","'.$address1.'","'.$address2.'","'.$address3.'","'.$city_landlord.'","'.$state_landlord.'","'.$contactnumber.'","'.$emailid.'","'.$alternatenumber.'","'.$altperson.'","'.$altpersonnumber.'","'.$leasedeed.'","'.$renewaldate.'","'.$emp_code.'","'.$empname.'","'.$buildingdesc.'","'.$attach4.'","'.$attach5.'","'.$attach6.'","'.$attach7.'","'.$attach8.'","'.$incharge_empcode.'","'.$leadername.'","'.$totalemployee.'","'.$insurancenumber.'","'.$insurancedate.'","'.$attach9.'","'.$insurancerenewaldue.'","'.$maintenancecost.'","'.$total_currency.'","'.$user_id.'")');

echo $sql;
exit;
*/

if(!mysql_query('INSERT INTO building (building_name,building_code,building_type,building_city,building_state,building_status,building_purchase,building_currency,building_cost,building_rent,building_period,building_purchasefrom,building_saleagreement,building_landlord,landlord_contactperson,landlod_address1,landlod_address2,landlod_address3,landlord_city,landlord_state,landlord_contactno,landlord_email,landlord_alternateno,landlord_altperson,landlord_altpersonno,leasedead,leaserenewaldate,companyliason_empcode,companyliason_empname,build_desc,attach4,attach5,attach6,attach7,attach8,incharge_empcode,incharge_empname,total_employess,insurance_number,insurance_date,attach9,renewal_due,total_maintain_cost,total_currency,created_by)VALUES ("'.$buildingname.'","'.$building_code.'","'.$building_type.'","'.$city.'","'.$state.'","'.$building_status.'","'.$datepurchase.'","'.$currency.'","'.$cost.'","'.$rent.'","'.$periodfrom.'","'.$purchasefrom.'","'.$saleagreement.'","'.$landlord.'","'.$contactperson.'","'.$address1.'","'.$address2.'","'.$address3.'","'.$city_landlord.'","'.$state_landlord.'","'.$contactnumber.'","'.$emailid.'","'.$alternatenumber.'","'.$altperson.'","'.$altpersonnumber.'","'.$leasedeed.'","'.$renewaldate.'","'.$emp_code.'","'.$empname.'","'.$buildingdesc.'","'.$attach4.'","'.$attach5.'","'.$attach6.'","'.$attach7.'","'.$attach8.'","'.$incharge_empcode.'","'.$leadername.'","'.$totalemployee.'","'.$insurancenumber.'","'.$insurancedate.'","'.$attach9.'","'.$insurancerenewaldue.'","'.$maintenancecost.'","'.$total_currency.'","'.$user_id.'")'))
{
die('Error: ' . mysql_error());
}
$fgmembersite->RedirectToURL("building.php?success=true");
echo "&nbsp;";

}
?>
<!-- <div id="inside_content"> -->
&nbsp;
<?php
if(isset($_GET['success']))
{
	if ($_GET['success']=="true") { ?>
		<span class="success_message">Building created successfully</span>
		<?php
	}
}
?>
&nbsp;
<div id="mainareastockstatic">
<div class="mcf"></div>
<div align="center" class="headingsgr">BUILDING</div>
<div id="mytableformreceipt" align="center">

<!-- <div class="header_bold">BUILDING</div>
<div class="scroll">
 -->

<form id='building_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">

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
			$result_state=mysql_query("select * from building_type");
			echo '<select name="building_type" id="building_type" class="selectbox">';
			echo '<option value="0">--Select--</option>';
			while($row=mysql_fetch_array($result_state))
			{
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
     <td><input type='text' name='buildingname' id='buildingname' class="textbox"/></td>
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
  <legend><strong>Address</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Address Line 1*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><textarea id="address1" name="address1" class="areatext"></textarea></td>
    </tr>
    
	<tr height="40">
     <td width="120">Address Line 3</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><textarea id="address1" name="address1" class="areatext"></textarea></td>
	</tr>

	<tr height="40">
     <td width="120">State</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><div id="display_state"><input type='text' name='state' id='state' class="textbox" /></div></td>
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
     <td><textarea id="address1" name="address1" class="areatext"></textarea></td>
	</tr>
     
	<tr height="40">
		<td width="120">City*</td>
		<td><?php
			$result_state=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id");
			echo '<select name="city" id="city" >';
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

<!----------------------------------------------- Right Table End -------------------------------------->

</fieldset>


<fieldset align="left" class="alignment">
  <legend><strong>Owned/Rented/Lease</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
    <td width="120">Owned/Rented/Lease*</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><select name="building_status" id="building_status" class="selectbox">
			<option value="0">--Select--</option>
			<option value="1">Owned</option>
			<option value="2">Rented</option>
			<option value="3">Lease</option>
		</select></td>
    </tr>
    
	

   </table>
   </td>
 </tr>
</table>

</fieldset>


<table id="building_class" align="center" width="90%"CELLPADDING="3" CELLSPACING="0"  style=" border: 0px solid #00BFFF; border-top:0px;font-family: Arial;
    font-size: 12px;"      >
  <!--<tr>
    <th style="background: url('images/th.png'); height: 29px;color:#ffffff;text-align: left;font-size: 14px;text-align:center">
Building
    </th
<th style=" height: 29px;text-align: left;font-size: 14px;text-align:center">
Building
    </th>
  </tr>-->
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">
<input type='hidden' name='submitted' id='submitted' value='1'/>
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">

                    <tr>
						<td  width="150px"><label style="margin-left:0px;">Building code<em style="font-style:normal;color:red;">*</em></label></td>
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
						<td  width="150px"><label style="margin-left:0px;">Building Name<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='buildingname' id='buildingname' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Building Type<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$result_state=mysql_query("select * from building_type");
							echo '<select name="building_type" id="building_type" class="selectbox">';
							echo '<option value="0">Please select a  Building type</option>';
							while($row=mysql_fetch_array($result_state))
							{
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

							}
							echo '</select>';
							?>
							</td>
						
						
                    </tr>
					
					<tr>
						<td  width="150px"><label style="margin-left:0px;">City<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$result_state=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id");
							echo '<select name="city" id="city" >';
							echo '<option value="0">Please select a  City</option>';
							while($row=mysql_fetch_array($result_state))
							{
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

							}
							echo '</select>';
							?>
							</td>
						
						<td  width="150px">
						
						<label style="margin-left:0px;">State<em style="font-style:normal;color:red;">*</em></label>
						
						</td>
                        <td>
						
						<div id="display_state">
						
						<input type='text' name='state' id='state' class="textbox" />
						
						</div>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Owned/rented/lease<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<select name="building_status" id="building_status" class="selectbox">
							<option value="0">Please select</option>
							<option value="1">owned</option>
							<option value="2">rented</option>
							<option value="3">lease</option>
							</select>
				
							</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Date of Purchase<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='datepurchase' id='datepurchase' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Currency<em style="font-style:normal;color:red;">*</em></label></td>
                     
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="currency" id="currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

							}
							echo '</select>';
							?>
							</td>
						
						<td  width="150px"><label style="margin-left:0px;">Cost<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='cost' id='cost' class="textbox"/>
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Rent<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='rent' id='rent' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Period<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<select name="periodfrom" id="periodfrom" class="selectbox">
							<option value="0">Please select</option>
							<option value="1">monthly</option>
							<option value="2">quarterly</option>
							<option value="3">halfyearly</option>
							<option value="4">yearly</option>
							</select>
							</td>
						<td  width="150px"><label style="margin-left:0px;">Purchase from<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='purchasefrom' id='purchasefrom' class="textbox"/>
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">attach purchase/sale deed agreement<em style="font-style:normal;color:red;"></em></label></td>
                        <td>
						<input type='file' name='saleagreement' id='saleagreement' class="textbox"/>
						</td>
			
						<td  width="150px"><label style="margin-left:0px;">Landlord<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='landlord' id='landlord' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Contact person<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='contactperson' id='contactperson' class="textbox"/>
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Address line 1<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea id="address1" name="address1" class="areatext"></textarea>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Address line 2<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea id="address2" name="address2" class="areatext"></textarea>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Address line 3<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea id="address3" name="address3" class="areatext"></textarea>
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">City<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$result_state=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id");
							echo '<select name="city_landlord" id="city_landlord" >';
							echo '<option value="0">Please select a  City</option>';
							while($row=mysql_fetch_array($result_state))
							{
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

							}
							echo '</select>';
							?>
							</td>
						
						<td  width="150px"><label style="margin-left:0px;">State<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<div id="display_state_landlord">
						
						<input type='text' name='state_landlord' id='state_landlord' class="textbox" />
						
						</div>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Contact number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='contactnumber' id='contactnumber' class="textbox"/>
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Email ID<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='emailid' id='emailid' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Alternate number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='alternatenumber' id='alternatenumber' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Alternate person<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='altperson' id='altperson' class="textbox"/>
						</td>
			
					</tr>
					
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Alternate person number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='altpersonnumber' id='altpersonnumber' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Attachments 2 (lease deed)<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='file' name='leasedeed' id='leasedeed' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">lease renewal date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='renewaldate' id='renewaldate' class="textbox"/>
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Emp code<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
				echo '<select name="emp_code" id="emp_code" class="selectbox">';
				echo '<option value="0">Please select a emp code</option>';
				while($row=mysql_fetch_array($result_emp_id))
				{
				echo '<option value="'.$row['emp_code'].'">'.$row['emp_code'].'</option>';

				}
				echo '</select>';
				?>
							</td>
						<td  width="150px"><label style="margin-left:0px;">Emp name<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<div id="display_empname">
						<input type='text' name='empname' id='empname' class="textbox"/>
						</div>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Building description<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea id="buildingdesc" name="buildingdesc" class="areatext"></textarea>
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Attachments 4 <em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='file' name='attach4' id='attach4' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Attachments 5 <em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='file' name='attach5' id='attach5' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Attachments 6 <em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='file' name='attach6' id='attach6' class="textbox"/>
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Attachments 7 <em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='file' name='attach7' id='attach7' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Attachments 8 <em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='file' name='attach8' id='attach8' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Building in charge emp code<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
				$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
				echo '<select name="incharge_empcode" id="incharge_empcode" class="selectbox">';
				echo '<option value="0">Please select a emp code</option>';
				while($row=mysql_fetch_array($result_emp_id))
				{
				echo '<option value="'.$row['emp_code'].'">'.$row['emp_code'].'</option>';

				}
				echo '</select>';
				?>
							</td>
			
					</tr>
					
						<tr>
						<td  width="150px"><label style="margin-left:0px;">Building in charge leader name<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<div id="display_inchargename">
						<input type='text' name='leadername' id='leadername' class="textbox"/>
						</div>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Total number of employee/members in building<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='totalemployee' id='totalemployee' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Insurance number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='insurancenumber' id='insurancenumber' class="textbox"/>
						</td>
					     </tr>
						 
						 <tr>
						<td  width="150px"><label style="margin-left:0px;">Insurance Date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='insurancedate' id='insurancedate' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Attachment 9(Insurance Agreement)<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='file' name='insuranceagreement' id='insuranceagreement' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Insurance renewal Due<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='insurancerenewaldue' id='insurancerenewaldue' class="textbox"/>
						</td>
					     </tr>
						 
						 	 <tr>
						<td  width="150px"><label style="margin-left:0px;">Total maintenance costs<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='maintenancecost' id='maintenancecost' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Currency<em style="font-style:normal;color:red;">*</em></label></td>
                       
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="total_currency" id="total_currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

							}
							echo '</select>';
							?>
							</td>
						
						<td  width="150px">&nbsp;</td>
                        <td>
						&nbsp;
						</td>
					     </tr>
					
					
					
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="center" colspan="5">
	
			<input type='submit'  class="flatbutton" name='save' id="save" value='Save'/>
			<input type='button'  class="flatbutton" name='view' id="view" value='View' onclick="location.href='view_building.php'"/>
		
        

            </td>
        </tr>
		
		
                </table>
                </form>            </td>

        </tr>




    </table>
	</form>



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