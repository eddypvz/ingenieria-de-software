<?php
if( isset($_POST['uploadFile'])) {

    include_once ('inc/main.php');

    $saveFilesFolder = 'uploads';
    $serverFiles = dirname( __FILE__ );
    $targetPath = $serverFiles. '/' . $saveFilesFolder; //C:\wServer\ingenieria-de-software/uploads

    $uploadStatus = false;

    if (!empty($_FILES)) {

        $tempFile = $_FILES['file']['tmp_name'];
        $newFileName = time().'_'.$_FILES['file']['name'];
        $targetFile =  "{$targetPath}/{$newFileName}";
        $targetFileToDownload =  "{$saveFilesFolder}/{$newFileName}";

        $fileName = $db->escape($_FILES['file']['name']);
        $targetFileToDownload = $db->escape(str_replace('\\', '/', $targetFileToDownload));

        // insert to db
        $strQuery = "INSERT INTO file (name, id_user, status, file_url) VALUES ('{$fileName}', '{$_SESSION['login_data']['id']}', 'saved', '{$targetFileToDownload}')";

        if (move_uploaded_file($tempFile, $targetFile) && $db->query($strQuery)) {
            $uploadStatus = true;
        }
    }
    print $uploadStatus;
    die();
}

if( isset($_POST['deleteFile'])) {

    include_once ('inc/main.php');

    $idFile = intval($_POST['deleteFile']);

    // insert to db
    $strQuery = "UPDATE file SET status = 'deleted' WHERE id_file = '{$idFile}'";

    if ($db->query($strQuery)) {
        print 1;
    }
    else {
        print 0;
    }
    die();
}

include_once ('header.php');
?>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">Subir un archivo</h3>
            <div>
                <div class='content'>
                    <form action="upload.php" class="dropzone" id="dropzonewidget">
                        <input type="hidden" name="uploadFile" value="1"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once ('footer.php');