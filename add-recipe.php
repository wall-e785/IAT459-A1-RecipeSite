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
    <form>
    <label>Recipe Title</label>
    <input type="text" name="title">
    <label>Recipe Description</label>
    <input type="text" name="description">
    <label>This recipe:</label>
    <input type="radio" name="portion" value="serves">
    <label>serves</label>
    <input type="radio" name="portion" value="makes">
    <label>makes</label>
    <input type="text" name="size">
    <label>Prep time</label>
    <input type="text" name="prep_hrs">
    <input type="text" name="prep_mins">
    <label>Cook time</label>
    <input type="text" name="cook_hrs">
    <input type="text" name="cook_mins">
    <label>List your Ingredients:</label>
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
            echo "<input type=\"text\" name=\"" . "iquantity" . $i . "\">\n";
            //referenced this for the unit selector: https://www.w3schools.com/tags/tag_select.asp
            echo "<select name=\"" . "iunit" . $i . "\">\n";
            unit_options();
            echo "</select>";
            echo "<input type=\"text\" name=\"" . "iname" . $i . "\">\n";
        }
    ?>
    <input type="submit">
    </form>
</body>
</html>