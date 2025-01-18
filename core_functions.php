<!-- This file holds some common functions used by multiple pages -->

<?php
    //open the recipe text file
    function open_recipes(){
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $recipes = @fopen("/Applications/XAMPP/xamppfiles/data/recipes.txt", 'r');
        if(!$recipes){
            echo "<p>Error loading recipes! Try again later.</p>";
        }
    }
    
?>