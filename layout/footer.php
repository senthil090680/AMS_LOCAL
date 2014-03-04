<!------------------------------- Footer ------------------------------------------------->

<script type="text/javascript"> 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var strcount
var x = new Date()
var month=new Array();
month[0]="Jan";
month[1]="Feb";
month[2]="Mar";
month[3]="Apr";
month[4]="May";
month[5]="June";
month[6]="July";
month[7]="Aug";
month[8]="Sep";
month[9]="Oct";
month[10]="Nov";
month[11]="Dec";
var x1=x.getDate()+ "-" + month[x.getMonth()] + "-" + x.getFullYear(); 

var hours = new Date().getHours();
    var hours = (hours+24-2)%24; 
    var mid='AM';
    if(hours==0){ //At 00 hours we need to show 12 am
    hours=12;
    }
    else if(hours>12){
    hours=hours%12;
    mid='PM';
    }
	
var minutes = x.getMinutes();
minutes = minutes > 9 ? minutes : '0' + minutes;

var sec = x.getSeconds();
sec = sec > 9 ? sec : '0' + sec;

var hou = x.getHours();
hou = hou > 9 ? hou : '0' + hou;

	
x1 = x1 + " / " +  hou + ":" +  minutes + ":" +  sec  + " " +mid;
document.getElementById('ct').innerHTML = x1;
tt=display_c();
 }
</script>


<body onload="display_ct()">


</body>
</html>
<div id="footer">

<div class="left"><a href="#">...a solution from KCS</a></div>
<div class="right"><a href="#">

<?php 
/*
$time_now=mktime(date('g')+4,date('i')-30,date('s')); 
$time = date('d-M-Y / h:i A',$time_now); 
echo $time;
*/
?>
<span id='ct' ></span></a></div>
</div>

<!------------------------------- Wrapper End ---------------------------------------->
</div>
</body>
</html>
