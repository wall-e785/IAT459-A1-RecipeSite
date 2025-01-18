<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $recipes = @fopen("$document_root/../recipes/recipes.txt", 'r');
        if(!$recipes){
            echo "<p>Error loading recipes! Try again later.</p>";
        }  
        //get the recipe id from the URL
        $recipe_id = $_GET['recipe_id'];
        $line_num = 0;
        while($info_array = fgetcsv($recipes)){
            $line_num++;
            if($line_num == $recipe_id){
                echo "<table><tr>";
                for($i=0; $i<sizeof($info_array); $i++){
                    echo "<td><p>$info_array[$i]</p><td>";
                }
                echo "</tr></table>";
                fclose($recipes);
                exit;
            }
        }

        fclose($recipes);
        echo "<strong>Error! Recipe ID not found!</strong>";
        

    ?>
</body>
</html>