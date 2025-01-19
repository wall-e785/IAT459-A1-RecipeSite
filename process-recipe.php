<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Recipe...</title>
</head>
<body>
    <?php

        //this function will setup the URL by insertting variables into the GET array so the form can be refilled if there is an error.
        $return_url = "add-recipe.php?";

        function return_to_form(){
            //grab the global variable $return_url
            global $return_url;

            $var_array = array();

            if(!empty($_POST['title'])){
                $var_array[] = "title=" . $_POST['title'];
            }

            if(!empty($_POST['description'])){
                $var_array[] = "description=" . $_POST['description'];
            }

            if(!empty($_POST['portion'])){
                $var_array[] = "portion=" . $_POST['portion'];
            }

            if(!empty($_POST['size'])){
                $var_array[] = "size=" . $_POST['size'];
            }

            if(sizeof($var_array)==1){
                $return_url .= $var_array[0];
            }else if(sizeof($var_array)>1){
                for($i=0;$i<sizeof($var_array);$i++){
                    if($i!=0){
                        $return_url .= "&" . $var_array[$i];
                    }else{
                        $return_url .= $var_array[$i];
                    }
                }
            }
                
        }

        //require all fields to be filled. Special case: ensure there is a minimum of one ingredient.
        if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['portion']) && !empty($_POST['size']) && !empty($_POST['prep_hrs']) && !empty($_POST['prep_mins']) && !empty($_POST['cook_hrs']) && !empty($_POST['cook_mins']) && !empty($_POST['iquantity1']) && !empty($_POST['iunit1']) && !empty($_POST['iname1']) && !empty($_POST['instructions']) && !empty($_POST['tags'])){
            
            //nested if for clarity, also ensure that numerical fields only contain numbers.
            //referenced from https://www.php.net/manual/en/function.ctype-digit.php
            if(ctype_digit($_POST['size']) && ctype_digit($_POST['prep_hrs']) && ctype_digit($_POST['prep_mins']) && ctype_digit($_POST['cook_hrs']) && ctype_digit($_POST['cook_mins'])){
                 //create an array which will hold each entry from the user
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
                $document_root = $_SERVER['DOCUMENT_ROOT'];
                $file = @fopen("$document_root/../recipes/recipes.txt", 'a');
                if(!$file){
                    echo "<p>Error submitting recipe! Please try again.</p>";
                    exit;
                }
                fwrite($file, implode(",",$recipe));
                fclose($file);

                return_to_form();
                header('Location: ' . $return_url);
                exit;
            }
        }else{
            return_to_form();
            header('Location: ' . $return_url);
            exit;
        }   

    ?>
</body>
</html>