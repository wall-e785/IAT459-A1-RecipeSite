<!DOCTYPE html>
<html lang="en">
    <?php
        require 'header.php';
    ?>
    <?php
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $recipes = @fopen("$document_root/../recipes/recipes.txt", 'r');
        if(!$recipes){
            echo "<p>Error loading recipes! Try again later.</p>";
        }else{
            //get the recipe id from the URL
            $recipe_id = $_GET['recipe_id'];
            $line_num = 0;

            //loop to read file
            while($info_array = fgetcsv($recipes)){
                $line_num++;
                //once you reach the desired line
                if($line_num == $recipe_id){ 
                    //start displaying info
                    //check the number of ingredients by subtracting the 10 guaranteed values, then divided by 3 (number of parts to each ingredient).
                    $num_of_ingredients = (sizeof($info_array) - 10)/3; 
                    print $num_of_ingredients;

                    //start table
                    echo "<table><tr>";

                    //display the title, tags, description, serving size, prep and cook time.
                    echo "<h2>" . $info_array[0] . "</h2>";

                    //tags need to be reformatted by their delimiter for proper visual display to the user
                    $tags_arr = explode('^',$info_array[sizeof($info_array) - 1]);
                    $tags = implode(', ', $tags_arr);
                    echo "<p>" . $tags . "</p>";
                    
                    echo "<p>" . $info_array[1] . "</p>";
                    if($info_array[2] == 'makes') echo "<p>Makes: ";
                    if($info_array[2] == 'serves') echo "<p>Serves: ";
                    echo $info_array[3] . "</p>";
                    echo "<p>Prep Time: " . $info_array[4] . " hrs " . $info_array[5] . " mins</p>";
                    echo "<p>Cook Time: " . $info_array[6] . " hrs " . $info_array[7] . " mins</p>";

                    //display ingredients
                    echo "<h3>Ingredients:</h3>";
                    
                    //keep track of the array pos of the first value for the first ingredient
                    $array_pos = 8;

                    //now iterate over the number of ingredeints specific earlier based on the array size
                    for($i=0;$i<$num_of_ingredients;$i++){
                        //display the quantity, unit, and ingredient name
                        echo "<p>" . $info_array[$array_pos] . " " . $info_array[$array_pos+1] . " " . $info_array[$array_pos+2];
                        //add 3 to the array pos so the next ingredient can be displayed in the next loop iteration
                        $array_pos+=3;
                    }

                    //display the instructions, its array position is relative to how many ingredients there were
                    echo "<h3>Instructions:</h3><p>" . $info_array[$array_pos] . "</p>";
                    
                    // for($i=0; $i<sizeof($info_array); $i++){
                    //     echo "<td><p>$info_array[$i]</p><td>";
                    // }
                    echo "</tr></table>";
                    fclose($recipes);
                    exit;
                }
            }

            fclose($recipes);
            echo "<table><tr><strong>Error! Recipe ID not found!</strong></tr></table>";
        }          
    ?>
</body>
</html>