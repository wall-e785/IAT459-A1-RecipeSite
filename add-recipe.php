<!-- ADD RECIPE FORM PAGE -->
<!DOCTYPE html>
<html lang="en">
    <?php
        //import the header
        require 'header.php';
    ?>

    <!--referenced this link for form attributes: https://www.w3schools.com/html/html_forms.asp -->
    <form method="post" action="process-recipe.php">
        <table id="recipe-form">
            <tr><h2 class="pg-header">Add a New Recipe</h2><tr>
            <?php
                //check if there are any error codes in the URL, if so, display the proper message to the user.
                if(!empty($_GET['err_one'])){
                    //column span referenced from https://www.w3schools.com/tags/att_td_colspan.asp
                    echo "<tr><td colspan=\"3\"><strong class=\"err-msg\">Error! Incomplete form. Please make sure you fill in all required values!</strong></td></tr>";
                }
                if(!empty($_GET['err_two'])){
                    echo "<tr><td colspan=\"3\"><strong class=\"err-msg\">Error! Serving size, prep time and cook time can only contain numerical values!</strong></td></tr>";
                }
            ?>
            <tr>
            <td><label>Recipe Title:</label></td>
            <?php
                //if this is a resubmission, redisplay any filled in title
                if(!empty($_GET['title'])){
                    echo "<td class=\"fill-row-input\" colspan=\"2\"><input type=\"text\" name=\"title\" value=\"" . $_GET['title'] . "\"></td>";
                }else{
                    echo "<td class=\"fill-row-input\" colspan=\"2\"><input type=\"text\" name=\"title\" placeholder=\"Recipe Title\"></td>";
                }
            ?>
            </tr>

            <tr>
            <td><label>Recipe Description:</label></td>
            <?php
                //if this is a resubmission, redisplay any filled in description                
                if(!empty($_GET['description'])){
                    echo "<td class=\"fill-row-input\" colspan=\"2\"><input type=\"text\" name=\"description\" value=\"" . $_GET['description'] . "\"></td>";
                }else{
                    echo "<td class=\"fill-row-input\" colspan=\"2\"><input type=\"text\" name=\"description\" placeholder=\"A Short Description (No Commas Permitted!)\"></td>";
                }
            ?>
            </tr>

            <tr>
            <td><label>This Recipe:</label></td>
            <?php
                //to make a highlighted radio button, i referenced this: https://stackoverflow.com/questions/5592345/how-to-select-a-radio-button-by-default
                if(!empty($_GET['portion'])){ //if there is a saved value for the portion type
                    if($_GET['portion'] == "serves"){ //if the portion type was serves
                        echo "<td><input type=\"radio\" name=\"portion\" value=\"serves\" class=\"radio-input\" checked>";
                        echo "<label>serves</label></td>";
                        echo "<td><input type=\"radio\" name=\"portion\" value=\"makes\" class=\"radio-input\">";
                        echo "<label>makes</label></td>";
                    }else if($_GET['portion'] == "makes"){ //if the portion type was makes
                        echo "<td><input type=\"radio\" name=\"portion\" value=\"serves\" class=\"radio-input\">";
                        echo "<label>serves</label></td>";
                        echo "<td><input type=\"radio\" name=\"portion\" value=\"makes\" class=\"radio-input\" checked>";
                        echo "<label>makes</label></td>";
                    }
                }else{ //else if there was no saved portion value, leave both radio buttons unhighlighted
                    echo "<td><input type=\"radio\" name=\"portion\" value=\"serves\" class=\"radio-input\">";
                    echo "<label>serves</label></td>";
                    echo "<td><input type=\"radio\" name=\"portion\" value=\"makes\" class=\"radio-input\">";
                    echo "<label>makes</label></td>";
                }
                echo "</tr><tr><td></td>";

                //if this is a resubmission, redisplay any filled in size
                if(!empty($_GET['size'])){
                    echo "<td><input type=\"text\" name=\"size\" value=\"" . $_GET['size'] . "\"></td>";
                }else{
                    echo "<td><input type=\"text\" name=\"size\" placeholder=\"# of people or servings\"></td>";
                }
            ?>
            </tr>

            <tr>
            <td><label>Prep Time:</label></td>
            <td><input type="text" name="prep_hrs" placeholder="Hours"></td>
            <td><input type="text" name="prep_mins" placeholder="Minutes"></td>
            </tr>

            <tr>
            <td><label>Cook Time:</label></td>
            <td><input type="text" name="cook_hrs" placeholder="Hours"></td>
            <td><input type="text" name="cook_mins" placeholder="Minutes"></td>
            </tr>

            <tr>
            <td class="fill-row-label" colspan="3"> <label>List Your Ingredients (min. one ingredient):</label> <td>
            <tr>

            <tr>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Name</th>
            </tr>

        <?php

        //this function creates the options for the unit selector
        function unit_options(){
            echo "<option value=\"pound(s)\">Pound(s)</option>";
            echo "<option value=\"gram(s)\">Gram(s)</option>";
            echo "<option value=\"ounce(s)\">Ounce(s)</option>";
            echo "<option value=\"piece(s)\">Piece(s)</option>";
            echo "<option value=\"mL(s)\">mL(s)</option>";
            echo "<option value=\"tbsp(s)\">Tablespoon(s)</option>";
            echo "<option value=\"tsp(s)\">Teaspoon(s)</option>";
            echo "<option value=\"cup(s)\">Cup(s)</option>";
        }
            
        //referenced this for for loops: https://www.w3schools.com/php/php_looping_for.asp
        for($i=1;$i<=10;$i++){
            echo "<tr>";
            echo "<td class=\"center-input\"><input type=\"text\" name=\"" . "iquantity" . $i . "\" placeholder=\"#\"></td>";
            //referenced this for the unit selector: https://www.w3schools.com/tags/tag_select.asp
            echo "<td class=\"center-input\"><select name=\"" . "iunit" . $i . "\">";
            unit_options();
            echo "</select></td>";
            echo "<td class=\"center-input\"><input type=\"text\" name=\"" . "iname" . $i . "\" placeholder=\"Ingredient\"></td>";
            echo "</tr>";
        }
        ?>

        <tr>
        <td><label>Instructions:</label></td>
        </tr>

        <!--referenced from https://www.w3schools.com/tags/tag_textarea.asp-->
        <tr>
        <!--Prompt user to not use commas so the CSV file will save properly -->
        <td colspan="3"><textarea name="instructions" placeholder="Enter your step by step instructions here in one paragraph... Please do not include any commas!"></textarea></td>
        </tr>

        <tr>
        <td class="fill-row-label" colspan="3"><label>Tags (separated by commas):</label></td>
        </tr>

        <tr>
        <td class="fill-row-input" colspan="3"><input type="text" name="tags"></td>
        </tr>
        
        <tr>
        <td></td>
        <td><input type="submit"></td>
        </tr>
        
        </table>
    </form>


</body>
</html>