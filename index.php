<?php

require_once __DIR__.'/functions.php';
$i=0;
$list = get_cat();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>ARUCATS v1.0.0</title>
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css"  type="text/css">
        <script src="/vendor/jquery/jquery.js" charset="utf-8"></script>
        <script src="/main.js" charset="utf-8"></script>
    </head>
    <body>
        <div class="container">
            <h1>Ananta's Remote Upload and CATalog System</h1>

            <form action="handle.php" method="post">
                <p class="text-info">Complete this form to start Upload!</p>
                <div class="form-group">
                    <label for="url">Remote Link: *</label>
                    <input class="form-control" type="text" id="url" placeholder="http://example.com/file.zip" name="url" required>
                </div>
                <div class="form-group">
                    <label for="fname">Movie Name: *</label>
                    <input class="form-control" type="text" id="fname" placeholder="Avengers:Endgame.mkv" name="fname" required>
                </div>
 <!--               <div class="form-group">
                    <label for="release">Release Year: *</label>
                    <input class="form-control" type="number" id="release" placeholder="1990" name="release" required>
                </div>
-->
                <!--
                    <div class="form-group">
                    <label for="s">Is this a series?</label>
                    <input class="form-control" type="checkbox" id="s" name="s"> This is a Series (additional info needed!)
                </div>
                -->


                <div class="form-group">
                    <label for="cat">Select Category: *</label>
                    <select id="cat" name="cat" class="form-control">
                    <option value="" selected>Select</option>
                    <?php foreach($list as $l){
                        echo "<option value=\"$i\">$l</option>";
                        $i++;
                    }
                    ?>
                    </select>
                </div>
                <!--<div class="form-group">
                    <label for="lang">Select File Lang: *</label>
                    <select id="lang" name="lang" class="form-control">
                    <option value="" selected>Select</option>
                    <option value="Arabic">Arabic</option>
                    <option value="Bengali">Bengali</option>
                    <option value="English">English</option>
                    <option value="Hindi">Hindi</option>
                    <option value="Korean">Korean</option>
                    <option value="Chinese">Chinese</option>
                    <option value="South-Indian">South-Indian</option>
                    <option value="Other">Other</option>
                    </select>
                </div>-->
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-lg btn-success">Submit</button>
                </div>
            </form>
        </div>
    </body>
</html>
