<script>
function validation()
{
var filenamee=document.getElementById("file").value;
var abc=filenamee.split('.').pop();
	alert(abc);
}
</script>
<?php
if(isset($_POST['submit']))
{
$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
$temp = explode(".", $_FILES["file1"]["name"]);
$extension = end($temp);
if (in_array($extension, $allowedExts))
  {
  if ($_FILES["file1"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file1"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("uploads/" . $_FILES["file1"]["name"]))
      {
      echo $_FILES["file1"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file1"]["tmp_name"],
      "uploads/" . $_FILES["file1"]["name"]);
     // echo "Stored in: " . "uploads/" . $_FILES["file"]["name"];
      }
    }
  }
	else
	{
	echo "Invalid file";
	}
		
  }
?>
<html>
<body>

<form action="file_upload.php" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file1" id="file1"><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>