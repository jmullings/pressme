<?php
/**
 * Created by PhpStorm.
 * User: jlmconsulting
 * Date: 6/21/18
 * Time: 5:01 PM
 */
require __DIR__ . '/../src/pressme.php';
$file_name = '';

if(isset($_FILES['text'])){
    $errors= array();
    $file_name = $_FILES['text']['name'];
    $file_size =$_FILES['text']['size'];
    $file_tmp =$_FILES['text']['tmp_name'];
    $file_type=$_FILES['text']['type'];
    $file_ext=  $_FILES['text']['name'];
    $file_ext=strtolower(end(explode('.',$file_ext)));

    $expensions= array("txt");

    if(in_array($file_ext,$expensions)=== false){
        $errors[]="extension not allowed, please choose a TXT file.";
    }

    if($file_size > 2097152){
        $errors[]='File size must be less than 2 MB';
    }

    if(empty($errors)==true){
        if(move_uploaded_file($file_tmp,"files/".$file_name)){
            $pressMe = new pressme();
            $file = preg_replace('/(\\.\\d+\\.)/', '.', $file_name);
            if ($file_name == $file)
                $data = $pressMe->fileCompressor($file_name);
            else{
                $data = $pressMe->fileDecompressor($file_name);
            }
            $converted = "files/".$data['filename'];
            if (file_exists($converted)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($converted).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($converted));
                readfile($converted);
                exit;
            }
        }
    }else{
        print_r($errors);
    }
}
?>
<html>
<body>
<br />
<h2>Decompress / Compress File</h2>
<br /><br />
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="text" />
    <input type="submit"/>
</form>
<?php
if ($file_name !== $file)
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

