<!--Add a recipe page-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Recipe</title>
</head>

<body>
    <header>
    <h1>Add a New Recipe</h1>
        <nav>
            <a href="index.php">All Recipes</a>
            <a href="add-recipe.php">Add a New Recipe</a>
        </nav>
    </header>

    <!--referenced this link for form attributes: https://www.w3schools.com/html/html_forms.asp -->
    <form method="post" action="process-recipe.php">
        <table>
            <tr>
            <td><label>Recipe Title</label></td>
            <td><input type="text" name="title" placeholder="Recipe Title"></td>
            </tr>

            <tr>
            <td><label>Recipe Description</label></td>
            <td><input type="text" name="description" placeholder="A Short Description"></td>
            </tr>

            <tr>
            <td><label>This recipe:</label></td>
            <td><input type="radio" name="portion" value="serves">
            <label>serves</label></td>
            <td><input type="radio" name="portion" value="makes">
            <label>makes</label></td>
            <td><input type="text" name="size" placeholder="# of people/servings"></td>
            </tr>

            <tr>
            <td><label>Prep time</label></td>
            <td><input type="text" name="prep_hrs"></td>
            <td><p>:</p></td>
            <td><input type="text" name="prep_mins"></td>
            </tr>

            <tr>
            <td><label>Cook time</label></td>
            <td><input type="text" name="cook_hrs"></td>
            <td><p>:</p></td>
            <td><input type="text" name="cook_mins"></td>
            </tr>

            <tr>
            <td> <label>List your Ingredients:</label> <td>
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
            echo "<td><input type=\"text\" name=\"" . "iquantity" . $i . "\"></td>";
            //referenced this for the unit selector: https://www.w3schools.com/tags/tag_select.asp
            echo "<td><select name=\"" . "iunit" . $i . "\">";
            unit_options();
            echo "</select></td>";
            echo "<td><input type=\"text\" name=\"" . "iname" . $i . "\"></td>";
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
        <td><label>Tags</label></td>
        <td><input type="text" name="tags"></td>
        </tr>
        
        <tr>
        <td><input type="submit"></tr>
        </tr>
        
        </table>
    </form>

</body>
</html>