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
        }else{
            //keep track of which line in the file you're on
            $line_num = 0;
            while($arr = fgetcsv($recipes)){
                $line_num++;
                echo "<table><tr>";
                // for($i=0; $i<sizeof($arr); $i++){
                //     echo "<td><p>$arr[$i]</p><td>";
                // }
                //to pass the ID of the recipe to HREF I will use its line number (array position)
                //in order to be able to use $_GET on the details.php page, I need to add the line number to the URL
                //referenced from: https://stackoverflow.com/questions/47304899/php-a-href-how-to-pass-value-to-another-page-when-click-the-href-and-how-to-r#:~:text=You%20simply%20add%20your%20data,by%20using%20the%20GET%20Method.&text=%24_GET%5B'id'%5D%3B
                $link = "details.php?recipe_id=" . $line_num;
                echo "<td><a href=" . $link .  ">" . $arr[0] . "</a><td>";
                echo "</tr></table>";
            }
        }

        fclose($recipes);
        

    ?>
</body>
</html>
