<?php
include 'resources\php\DbConnection.php';
$dbCon = new DbConnection();


if($_POST['action']=='DISPLAY'){
$specialization=$_POST['spec'];
$promotion=$_POST['promo'];
$pdfs=scandir('resources/pi/'.$promotion.'/'.$specialization);
$pdfs=array_slice($pdfs,2);

while(strpos($pdfs[count($pdfs)-1],'PI')===0){
    array_unshift($pdfs,$pdfs[count($pdfs)-1]);
    array_pop($pdfs);
}
echo(json_encode($pdfs));}




if($_POST['action']=='DOWNLOAD') {
    $specialization = $_POST['spec'];
    $year = $_POST['year'];
    $promotion = $_POST['promo'];

    $zip = new ZipArchive();
    $filename = $specialization.$promotion.".zip";



    if (file_exists($filename)){
        unlink($filename);
    }

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit("cannot open <$filename>\n");
    }

//    $pdfs=scandir('resources/pi/'.$promotion.'/'.$specialization);
//
//    for($i=2;$i<count($pdfs);$i++){
//        $zip->addFile($pdfs[$i]);
//
//    }

    $dir = 'resources/pi/'.$promotion.'/'.$specialization.'/';

// Create zip
    if (is_dir($dir)){

        if ($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false){

                // If file
                if (is_file($dir.$file)) {
                    if($file != '' && $file != '.' && $file != '..'){

                        $zip->addFile($dir.$file,$file);
                    }
                }

            }
            closedir($dh);
        }
    }

    $zip->close();

    echo json_encode($filename);
}

if(isset($_POST['fileName'])){

$filename=$_POST['fileName'];
    if (file_exists($filename)){
        unlink($filename);
    }
}


?>

