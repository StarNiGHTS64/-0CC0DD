<?php
    error_reporting(0);
?>
<html>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="uploadfile" value=""/>
            <input type="submit" name="submit" value="Upload File"/>
        </form>
        <!--<iframe src="Test.pdf" width="500" height="500" frameborder="2"></iframe>-->
    </body>
</html>
<?php

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];

    $folder = "entregas/".$filename;
    
    echo $folder;

    move_uploaded_file($tempname,$folder);
    
    echo "<img src='$folder' height='100' width='100'";

?>

<!--<img src="personajes/ConejaPNG.png" height="100" width="100"/>-->
