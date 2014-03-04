<?php
ob_start();
ini_set("display_errors",false);
error_reporting(E_ALL & ~E_NOTICE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AMS</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/menu.css" type="text/css" />
<link rel="stylesheet" href="css/facebox.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<link rel="stylesheet" href="css/editbox.css" type="text/css" />
<script type="text/javascript" src="js/jquery1.js"></script>
<script type="text/javascript" src="js/jquery2.js"></script>
<script type="text/javascript" src="js/facebox.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/validator.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
</head>

<body>
<div id="wrapper">
 <!------------------------------- Header Start ---------------------------------------->
 <div id="header">
    <div id="logo">
      <div class="left"><img src="images/logo_fmcl.png" width=60 height="70"/></div>
      <div class="left">
      <h1 align="center">ADMINISTRATION SYSTEM</h1>
	  <span style="padding-left:60px;font-family:Calibri;font-size:19px;"><strong>Fleet Management</strong></span>
      </div>
      <div class="left"><img src="images/logo_tts.png" width="60" height="72" style="padding-left:300px;"/></div> 
      </div>
      <div id="menuleft">
<li><a href="#"><span style="padding-left:10px;">VALUE SETS</span></a>
       <ul>
           <li><a href="allocation_type.php">Allocation Type</a>
		   <li><a href="assignment_type.php">Assignment Type</a>
		   <li><a href="status.php">Status</a>
		   <li><a href="transaction_type.php">Transaction Type</a>
		   <li><a href="department.php">Division/Department</a>
		   <li><a href="uom.php">UOM</a>
      </ul>
</li>
          <!--  <li><a href="../valueSets/branch.php">Branch</a></li>
            <li><a href="../valueSets/province.php">Zone</a></li>
            <li><a href="../valueSets/state.php">State</a></li>
            <li><a href="../valueSets/city.php">City</a></li>
            <li><a href="../valueSets/lga.php">LGA</a></li>
            <li><a href="../valueSets/location.php">Location</a></li>
            <li><a href="#">KD Categories</a>  
          </ul>
        </li>
	    <li><a href="#" title="">Master Data</a></li>
     <li><a href="../valueSets/branch.php">Branch</a></li>
            <li><a href="../valueSets/province.php">Zone</a></li>
            <li><a href="../valueSets/state.php">State</a></li>
            <li><a href="../valueSets/city.php">City</a></li>
            <li><a href="../valueSets/lga.php">LGA</a></li>
            <li><a href="../valueSets/location.php">Location</a></li>
            <li><a href="#">KD Categories</a>  -->   
		


  
 <li><a href="#"><span style="padding-left:10px;">MASTER DATA</span></a>
    <ul>
           <li><a href="vehicle.php">Vehicle</a></li>            
            <li><a href="driver.php">Driver</a></li>
			<li><a href="vendor.php">Vendor</a></li>
		
         </ul>
		   
  </li>
      <!--  <li><a href="state.php">State</a></li>
            <li><a href="city.php">City</a></li>
            <li><a href="building_type.php">Building Type</a></li>
            <li><a href="currency.php">Currency</a></li> 
			<li><a href="vendor.php">Vendor</a></li> 
          </ul>
        </li>
	    <li><a href="#" title="">Master Data</a>
		<ul>
       <li><a href="building.php">Building</a></li>
            <li><a href="generator.php">Generator</a></li>
            <li><a href="generator_maintain.php">Generator Maintenance</a></li>
            <li><a href="diesel.php">Diesel</a></li>
			<li><a href="nepa.php">Nepa</a></li>
			</ul>
			</li>-->


                  	<li><a href="#"><span style="padding-left:70px;">TRANSACTION</span></a>
					
				<ul>
					<li><a href="vehicle_allocation_type.php">Vehicle Allocation</a></li>
				   <li><a href="driver_allocate.php">Driver Allocation</a></li>
			<li><a href="vehicle_assignment.php">Vehicle Assignment</a></li>	
				<li><a href="vehicle_transaction.php">Vehicle Transactions</a></li>
			<li><a href="vehicle_log.php">Vehicle Log</a></li>
			<li><a href="vehicle_status.php">Vehicle Status Update</a></li>
         <!--	  <li><a href="#">Value Sets </a>
          <ul>
        <li><a href="allocation_type.php">Allocation Type</a></li>
            <li><a href="assignment_type.php">Assignment Type</a></li>
            <li><a href="status.php">Status</a></li>
            <li><a href="transaction_type.php">Transaction Type</a></li> 
			<li><a href="department.php">Division/Department</a></li> 
          </ul>
        </li>
	    <li><a href="#" title="">Master Data</a>
		<ul>
       <li><a href="vehicle.php">Vehicle</a></li>
            <li><a href="vehicle_allocation_type.php">Vehicle Allocation Type </a></li>
			 <li><a href="driver.php">Driver</a></li>
            <li><a href="driver_allocate.php">Driver Allocation </a></li>
			 <li><a href="vehicle_assignment.php">Vehicle Assignment</a></li>
			  <li><a href="vehicle_status.php">Vehicle Status</a></li>
            <li><a href="vendor.php">Vendor</a></li>
			</ul>
			</li>-->
</ul>
					
					</li>
						<li><a href="#"> <span style="padding-left:10px;"><?php echo $_SESSION['username'];?></span></a>
					<ul>
					<li><a href="logout.php" title="">Logout</a></li>
					</ul>
					
					</li>
						<li><a href="admin_temp.php"> <span style="padding-left:10px;">HOME</span></a>
					<ul>
					<li></li>
					</ul>
					
					</li>
					
</div>