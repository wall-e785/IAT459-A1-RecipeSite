<!-- ADD RECIPE FORM PAGE -->
<!DOCTYPE html>
<html lang="en">
    <?php
        require 'header.php';
    ?>

    <!--referenced this link for form att{ributes: https://www.w3schools.com/html/html_forms.asp -->
    <form method="post" action="process-recipe.php">
        <table id="recipe-form">
            <?php
                if(!empty($_GET['err_one'])){
                    echo "<tr><strong class=\"err-msg\">Error! Incomplete form. Please make sure you fill in all required values!</strong></tr>";
                }
                if(!empty($_GET['err_two'])){
                    echo "<tr><strong class=\"err-msg\">Error! Serving size, prep time and cook time can only contain numerical values!</strong></tr>";
                }
            ?>
            <tr>
            <td><label>Recipe Title</label></td>
            <?php
                if(!empty($_GET['title'])){
                    echo "<td><input type=\"text\" name=\"title\" value=" . $_GET['title'] . "></td>";
                }else{
                    echo "<td><input type=\"text\" name=\"title\" placeholder=\"Recipe Title\"></td>";
                }
            ?>
            </tr>

            <tr>
            <td><label>Recipe Description</label></td>
            <?php
                if(!empty($_GET['description'])){
                    echo "<td><input type=\"text\" name=\"description\" value=" . $_GET['description'] . "></td>";
                }else{
                    echo "<td><input type=\"text\" name=\"description\" placeholder=\"A Short Description\"></td>";
                }
            ?>
            </tr>

            <tr>
            <td><label>This recipe:</label></td>
            <?php
                //to make a highlighted radio button, i referenced this: https://stackoverflow.com/questions/5592345/how-to-select-a-radio-button-by-default
                if(!empty($_GET['portion'])){
                    if($_GET['portion'] == "serves"){
                        echo "<td><input type=\"radio\" name=\"portion\" value=\"serves\" checked>";
                        echo "<label>serves</label></td>";
                        echo "<td><input type=\"radio\" name=\"portion\" value=\"makes\">";
                        echo "<label>makes</label></td>";
                    }else if($_GET['portion'] == "makes"){
                        echo "<td><input type=\"radio\" name=\"portion\" value=\"serves\">";
                        echo "<label>serves</label></td>";
                        echo "<td><input type=\"radio\" name=\"portion\" value=\"makes\" checked>";
                        echo "<label>makes</label></td>";
                    }
                }else{
                    echo "<td><input type=\"radio\" name=\"portion\" value=\"serves\">";
                    echo "<label>serves</label></td>";
                    echo "<td><input type=\"radio\" name=\"portion\" value=\"makes\">";
                    echo "<label>makes</label></td>";
                }

                if(!empty($_GET['size'])){
                    echo "<td><input type=\"text\" name=\"size\" value=" . $_GET['size'] . "></td>";
                }else{
                    echo "<td><input type=\"text\" name=\"size\" placeholder=\"# of people or servings\"></td>";
                }
            ?>
            </tr>

            <tr>
            <td><label>Prep time</label></td>
            <td><input type="text" name="prep_hrs" placeholder="Hours"></td>
            <td><p>:</p></td>
            <td><input type="text" name="prep_mins" placeholder="Minutes"></td>
            </tr>

            <tr>
            <td><label>Cook time</label></td>
            <td><input type="text" name="cook_hrs" placeholder="Hours"></td>
            <td><p>:</p></td>
            <td><input type="text" name="cook_mins" placeholder="Minutes"></td>
            </tr>

            <tr>
            <td> <label>List your Ingredients (min. one ingredient):</label> <td>
            <tr>

            <tr>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Name</th>
            </tr>

        <?php
        function unit_options(){
            echo "<option value=\"pound\">Pound(s)</option>";
            echo "<option value=\"gram\">Gram(s)</option>";
            echo "<option value=\"ounce\">Ounce(s)</option>";
            echo "<option value=\"piece\">Piece(s)</option>";
            echo "<option value=\"ml\">mL(s)</option>";
            echo "<option value=\"tbsp\">Tablespoon(s)</option>";
            echo "<option value=\"tsp\">Teaspoon(s)</option>";
            echo "<option value=\"cup\">Cup(s)</option>";
        }
            
        //referenced this for for loops: https://www.w3schools.com/php/php_looping_for.asp
        for($i=1;$i<=10;$i++){
            echo "<tr>";
            echo "<td><input type=\"text\" name=\"" . "iquantity" . $i . "\" placeholder=\"#\"></td>";
            //referenced this for the unit selector: https://www.w3schools.com/tags/tag_select.asp
            echo "<td><select name=\"" . "iunit" . $i . "\">";
            unit_options();
            echo "</select></td>";
            echo "<td><input type=\"text\" name=\"" . "iname" . $i . "\" placeholder=\"Ingredient\"></td>";
            echo "</tr>";
        }
        ?>

        <tr>
        <td><label>Instructions</label></td>
        </tr>

        <!--referenced from https://www.w3schools.com/tags/tag_textarea.asp-->
        <tr>
        <td><textarea name="instructions"></textarea></td>
        </tr>

        <tr>
        <td><label>Tags (separated by commas):</label></td>
        <td><input type="text" name="tags"></td>
        </tr>
        
        <tr>
        <td><input type="submit"></tr>
        </tr>
        
        </table>
    </form>


</body>
</html>