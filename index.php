<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action ="" method="post" enctype="multipart/form-data">
        <label for="uploadedFileInput">
            Wybierz plik do wgrania na serwer:
        </label>
        <input type="file" name="uploadedFile" id="uploadedFileInput">
        <input type="submit" value="Wyślij plik" name="submit">
    </form>
    <?php
    if(isset($_POST['submit']))
    {
        $fileName = $_FILES['uploadedFile']['name'];
        $targetDir = "img/";
        $imageInfo = getimagesize($_FILES["uploadedFile"]["tmp_name"]);
        if(!is_array($imageInfo)){
            die("BŁĄD :  Nieprawidłowy format obrazu");
        }
        $targetExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $targetExtension = strtolower($targetExtension);
        $targetFileName = $fileName . hrtime(true);
        $targetFileName = hash("sha256", $targetFileName);
        $targetUrl = $targetDir . $targetFileName . "." . $targetExtension;
        if(file_exists($targetUrl))
            die(" BŁĄD:  Plik o tej nazwie już istnieje");
        move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $targetUrl);
    }
    ?>
</body>
</html>