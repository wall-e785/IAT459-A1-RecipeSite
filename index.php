<!--HOME PAGE FOR RECIPE SITE-->
<!DOCTYPE html>
<html lang="en">
    <?php
        require 'header.php';
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $recipes = @fopen("$document_root/../recipes/recipes.txt", 'r');
        if(!$recipes){
            echo "<p>Error loading recipes! Try again later.</p>";
        }else{
            //keep track of which line in the file you're on
            $line_num = 0;
            echo "<table id=\"recipe-table\">";
            while($arr = fgetcsv($recipes)){
                $line_num++;
                if($line_num%2 == 0){
                    echo "<tr class=\"dark-row\">";
                }else{
                    echo "<tr class=\"light-row\">";
                }
                // for($i=0; $i<sizeof($arr); $i++){
                //     echo "<td><p>$arr[$i]</p><td>";
                // }
                //to pass the ID of the recipe to HREF I will use its line number (array position)
                //in order to be able to use $_GET on the details.php page, I need to add the line number to the URL
                //referenced from: https://stackoverflow.com/questions/47304899/php-a-href-how-to-pass-value-to-another-page-when-click-the-href-and-how-to-r#:~:text=You%20simply%20add%20your%20data,by%20using%20the%20GET%20Method.&text=%24_GET%5B'id'%5D%3B
                $link = "details.php?recipe_id=" . $line_num;
                if($line_num%2 == 0){
                    echo "<td><a href=" . $link .  " class=\"recipe-nav\">" . $arr[0] . "</a></td>";
                }else{
                    echo "<td><a href=" . $link .  " class=\"recipe-nav\">" . $arr[0] . "</a></td>";
                }
                echo "<td><p>Prep Time: " . $arr[4] . " hrs " . $arr[5] . " mins</p></td>";
                echo "<td><p>Cook Time: " . $arr[6] . " hrs " . $arr[7] . " mins</p></td>";
                if($arr[2] == 'makes'){
                    echo "<td><p>Makes: " . $arr[3] . "</p></td>";
                }else if($arr[2] == 'serves'){
                    echo "<td><p>Serves: " . $arr[3] . "</p></td>";
                }
                echo "</tr>";
            }
            if($line_num == 0){
                echo "<tr><strong>No recipes available!</strong></tr>";
            }
            echo "</table>";
        }

        fclose($recipes);
        

    ?>
</body>
</html>
