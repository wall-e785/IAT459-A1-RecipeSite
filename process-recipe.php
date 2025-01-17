<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Recipe...</title>
</head>
<body>
    <?php
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        print $document_root;

        if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['portion']) && isset($_POST['size']) && isset($_POST['prep_hrs']) && isset($_POST['prep_mins']) && isset($_POST['cook_hrs']) && isset($_POST['cook_mins'])){
            $file = @fopen("/Applications/XAMPP/xamppfiles/data/recipes.txt", 'a');
            $recipe = array($_POST['title'],$_POST['description'],$_POST['portion'],$_POST['size'],$_POST['prep_hrs'],$_POST['prep_mins'],$_POST['cook_hrs'],$_POST['cook_mins'] . "\n");
            if(!$file){
                echo "<p>Error submitting recipe! Please try again.</p>";
                exit;
            }
            fwrite($file, implode(",",$recipe));
            fclose($file);

            header('Location: index.php');
            exit;
        }   

    ?>
</body>
</html>