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

        //require all fields to be filled. Special case: ensure there is a minimum of one ingredient.
        if(!empty($_POST['title']) && !empty($_POST['description']) && isset($_POST['portion']) && !empty($_POST['size']) && !empty($_POST['prep_hrs']) && !empty($_POST['prep_mins']) && !empty($_POST['cook_hrs']) && !empty($_POST['cook_mins']) && !empty($_POST['iquantity1']) && isset($_POST['iunit1']) && !empty($_POST['iname1']) && !empty($_POST['instructions']) && !empty($_POST['tags'])){
            $file = @fopen("/Applications/XAMPP/xamppfiles/data/recipes.txt", 'a');
            $recipe = array($_POST['title'],$_POST['description'],$_POST['portion'],$_POST['size'],$_POST['prep_hrs'],$_POST['prep_mins'],$_POST['cook_hrs'],$_POST['cook_mins'],$_POST['iquantity1'],$_POST['iunit1'], $_POST['iname1']);
            
            //check if there are any other ingredients to process
            //this starts from ingredient 2, as we have already checked if 1 is filled in the first if statement
            for($i=2;$i<=10;$i++){
                $quantname = 'iquantity' . $i;
                $unitname = 'iunit' . $i;
                $namename = 'iname' . $i;
                //check if all fields of the next ingredient is set, if it is add it to the recipe array
                if(!empty($_POST[$quantname] && isset($_POST[$unitname]) && !empty($_POST[$namename]))){
                    $recipe[] = $_POST[$quantname];
                    $recipe[] = $_POST[$unitname];
                    $recipe[] = $_POST[$namename];
                }else{ //otherwise, if there is not another ingredient break out of the loop.
                    break;
                }
            }

            //add the remaining parts of the data
            $recipe[] = $_POST['instructions'];
            $recipe[] = $_POST['tags'] . "\n";

            //try writing to the file
            if(!$file){
                echo "<p>Error submitting recipe! Please try again.</p>";
                exit;
            }
            fwrite($file, implode(",",$recipe));
            fclose($file);

            header('Location: index.php');
            exit;
        }else{
            header('Location: add-recipe.php');
            exit;
        }   

    ?>
</body>
</html>