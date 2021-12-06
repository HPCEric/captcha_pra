<?php
//$_FILES['file']['error']==0
if (!empty($_FILES['csv']['tmp_name'])) {
    $filename = md5(time());
    /* $subname=$_FILES['csv']['name'];
    $subname=explode(".",$subname); */

    $subname = explode(".", $_FILES['csv']['name'])[1];

    $newFileName = $filename . "." . $subname;

    echo "new=>" . $newFileName . "<br>";
    echo "tmp_name=>" . $_FILES['csv']['tmp_name'] . "<br>";
    echo "fileOrignName=>" . $_FILES['csv']['name'] . "<br>";

    move_uploaded_file($_FILES['csv']['tmp_name'], "file/" . $newFileName);

    // echo "<a href='file/{$newFileName}'>{$_FILES['csv']['name']}</a>";

    if ($subname == 'txt' || $subname == "csv") {
        saveToDB("file/" . $newFileName);
    }
}

function saveToDB($file)
{
    echo "get file" . $file . "<br>";
    echo "preparing..." . "<br>";

    $resourse = fopen($file, 'a+');
    while (!feof($resourse)) {
        echo fgets($resourse) . "<br>";
    }
    fwrite($resourse,"6,amy,女,2\r\n");
    
    fclose($resourse);
}
