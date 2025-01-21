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
                    echo "<table id=\"details-page\"><tr>";

                    //display the title, tags, description, serving size, prep and cook time.
                    echo "<td><h2>" . $info_array[0] . "</h2></td>";

                    //tags need to be reformatted by their delimiter for proper visual display to the user
                    $tags_arr = explode('^',$info_array[sizeof($info_array) - 1]);
                    $tags = implode(', ', $tags_arr);
                    echo "<td><p>" . $tags . "</p></td></tr>";
                    
                    echo "<tr><td><p>" . $info_array[1] . "</p></td>";
                    if($info_array[2] == 'makes') echo "<td><p>Makes: ";
                    if($info_array[2] == 'serves') echo "<td><p>Serves: ";
                    echo $info_array[3] . "</p></td>";
                    echo "<tr><td><p>Prep Time: " . $info_array[4] . " hrs " . $info_array[5] . " mins</p></td>";
                    echo "<td><p>Cook Time: " . $info_array[6] . " hrs " . $info_array[7] . " mins</p></td></tr>";

                    //display ingredients
                    echo "<tr><td><h3>Ingredients:</h3></td></tr>";
                    
                    //keep track of the array pos of the first value for the first ingredient
                    $array_pos = 8;

                    //now iterate over the number of ingredeints specific earlier based on the array size
                    for($i=0;$i<$num_of_ingredients;$i++){
                        //display the quantity, unit, and ingredient name
                        echo "<tr><td><p>" . $info_array[$array_pos] . " " . $info_array[$array_pos+1] . " " . $info_array[$array_pos+2] . "</p></td></tr>";
                        //add 3 to the array pos so the next ingredient can be displayed in the next loop iteration
                        $array_pos+=3;
                    }

                    //display the instructions, its array position is relative to how many ingredients there were
                    echo "<tr><td><h3>Instructions:</h3></td></tr><tr><td colspan=\"2\"><p>" . $info_array[$array_pos] . "</p></td></tr>";
                    
                    // for($i=0; $i<sizeof($info_array); $i++){
                    //     echo "<td><p>$info_array[$i]</p><td>";
                    // }
                    echo "</table>";
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