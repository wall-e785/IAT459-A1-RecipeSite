<!--HOME PAGE FOR RECIPE SITE-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
</head>

<body>
    <header>
        <h1>Wallace's Recipes</h1>
        <nav>
            <a href="index.php">All Recipes</a>
            <a href="add-recipe.php">Add a New Recipe</a>
        </nav>
    </header>
    <?php
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $recipes = @fopen("/Applications/XAMPP/xamppfiles/data/recipes.txt", 'r');
        if(!$recipes){
            echo "<p>Error loading recipes! Try again later.</p>";
        }
        
        while($arr = fgetcsv($recipes)){
            for($i=0; $i<sizeof($arr); $i++){
                echo "<p>$arr[$i]</p>";
            }
        }

        fclose($recipes);

    ?>
</body>
</html>
