
<!DOCTYPE html>     <!-- This file generates the layout of the page that the results are displayed on -->
<html>
<head>
    <title>Simple rank results</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?php
    require("process_words.php");
    ?>

    <style>
        body {
            padding: 40px 120px;
        }


    </style>
</head>
<body>
<p>Made by Kirk Youngdahl</p>
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-primary">
                <div class="panel-heading"><h2 class="center">Rank By Intersection (Puzzle)</h2></div>
                <div class="panel-body"><h4>Rank the following words by intersections</h4>
                    <ol >
                        <?php                                       //Lists the words for first section.
                        foreach ($word_array as $word) {
                            echo "<li>".$word;
                        }
                        ?>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading text-center"><h2>Options</h2></div>
                <div class="panel-body text-center">
                    <input class="options" type="radio" name="options" value="s">
                    <label>Simple</label>
                    <input class="options" type="radio" name="options" value="a">
                    <label>Advanced</label>
                    <input class="options" type="radio" name="options" value="h">
                    <label>Hide</label><br><br>
                    <a href="index.php">
                        <button type="button" onclick="goBack()" class="btn btn-primary btn-lg">Go back</button>
                    </a>

                </div>
            </div>
        </div>
    </div>




<div class="panel panel-primary">
    <div class="panel-heading"><h2>Rank By Intersection (Solution)</h2></div>
    <div class="panel-body">
        <!-- Below here are two separate table views (Simple, Advanced)
        <!--Simple solution table view-->
        <div class="simplesolution" style="display: none;">
            <h4>Simple solution</h4>
            <table class="table table-striped">
                <tr>
                    <th>Rank</th>
                    <th>X Count</th>
                    <th>Word</th>
                    <th>Intersections</th>
                </tr>
                <?php
                usort($profile, function ($a, $b) { return $b['simpleX'] - $a['simpleX']; });
                /* adds rank, number of intersections, word to table */
                $num = 1;
                foreach ($profile as $key => $word) {
                        echo "<tr><td>" . $num . "</td><td>" . $profile[$key]['simpleX'] . "</td><td>" . $profile[$key]['word'] . "</td><td>". $profile[$key]['simplepairs'] ."</td></tr>";
                        $count = 0;
                        $num++;
                }


                ?>
            </table>
        </div>


        <!--Advanced solution view-->
        <div class="advancedsolution" style="display: none;">
            <h4>Advanced solution</h4>
            <table class="table table-striped">
                <tr>
                    <th>Rank</th>
                    <th>X Count</th>
                    <th>Word</th>
                    <th>Intersections</th>
                </tr>
                <?php
                usort($profile, function ($a, $b) { return $b['advancedX'] - $a['advancedX']; });
                /* adds rank, number of intersections, word to the advanced table */
                $num = 1;
                foreach ($profile as $key => $word) {
                    echo "<tr><td>" . $num . "</td><td>" . $profile[$key]['advancedX'] . "</td><td>" . $profile[$key]['word'] . "</td><td>". $profile[$key]['advancedpairs'] ."</td></tr>";
                    $count = 0;
                    $num++;
                }
                ?>
            </table>
        </div>
    </div>
</div>





<!-- This javaScript helps the radio buttons (Simple, Advanced) switch switch tables in and out. -->
<script>
    $(document).ready(function() {
        $(".options").change(function() {
            if ($('input[value="s"]').is(':checked')) {
                $(".simplesolution").show();
            }
            else {
                $(".simplesolution").hide();
            }
        });
    });

    $(document).ready(function() {
        $(".options").change(function() {
            if ($('input[value="a"]').is(':checked')) {
                $(".advancedsolution").show();
            }
            else {
                $(".advancedsolution").hide();
            }
        });
    });

    $(document).ready(function() {
        $(".options").change(function() {
            if ($('input[value="s"]').is(':checked')) {
                $(".advancedsolution").hide();
            }
        });
    });


    function goBack() {
        window.history.back();
    }
</script>
<!------------------------------------------------------------------>

</body>
</html>