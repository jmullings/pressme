<?php
/**
 * Created by PhpStorm.
 * User: jlmconsulting
 * Date: 6/21/18
 * Time: 5:01 PM
 */
require __DIR__ . '/../src/pressme.php';

if(isset($_FILES['text'])||isset($_FILES['zip'])){
    $errors= array();
    $file_name = $_FILES['text']['name'] || $_FILES['zip']['name'];
    $file_size =$_FILES['text']['size'] || $_FILES['zip']['size'];;
    $file_tmp =$_FILES['text']['tmp_name'] || $_FILES['zip']['tmp_name'];
    $file_type=$_FILES['text']['type'] ||  $_FILES['zip']['type'];;
    $file_ext=strtolower(end(explode('.',$_FILES['text']['name'] || $_FILES['zip']['name'])));

    $expensions= array("txt");

    if(in_array($file_ext,$expensions)=== false){
        $errors[]="extension not allowed, please choose a TXT file.";
    }

    if($file_size > 2097152){
        $errors[]='File size must be less than 2 MB';
    }

    if(empty($errors)==true){
        $pressMe = new pressme();
        if(isset($_FILES['text']))
        $data = $pressMe->fileCompressor($file_name);
        if(isset($_FILES['zip'])){
            $data = $pressMe->fileDecompressor($file_name);
        }
        if (file_exists($data['filename'])) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($data['filename']).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($data['filename']));
            readfile($data['filename']);
            exit;
        }
    }else{
        print_r($errors);
    }
}

?>
<html>
<body>
<br />
<h2>Compress File</h2>
<br /><br />
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="text" />
    <input type="submit"/>
</form>
<?php
if(isset($_FILES['text']))
    print_r($data)
?>
<hr />
<h2>Decompress File</h2>
<br /><br />
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="zip" />
    <input type="submit"/>
</form>
<?php
if(isset($_FILES['zip']))
    print_r($data)
?>
<hr />
<h2>Input fizzbazz number:</h2>
<br /><br />
<form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="fizzbazz" typeof="number" />
    <input type="submit"/>
</form>
<?php
if($_POST["fizzbazz"])
for ($i=1;$i<=$_POST["fizzbazz"];$i++)
    echo ['fizz'][$i%3].['bazz'][$i%5]." ";
?>
<br />
</body>
</html>

