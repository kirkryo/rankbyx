<?php
/**
 * Kirk Youngdahl
 * Takes in list of words and generates profiles for each word (ID, word
 *
 *
 *
*/

$words = $_POST['words'];
$word_array = explode("\r\n", $words);
errorCheck($word_array);
generateWordProfile($word_array, $profile);

function generateWordProfile($array, &$profile ) {
    foreach ($array as $key => $word) {

        countSimpleX($key, $word, $array, $s_x);
        countAdvancedX($key, $word, $array, $a_x);
        simplePairs($key, $word, $array, $s_pairs);
        advancedPairs($key, $word, $array, $a_pairs);

        $profile[$key]['word'] = $word;
        $profile[$key]['simpleX'] = $s_x;
        $profile[$key]['advancedX'] = $a_x;
        $profile[$key]['simplepairs'] = $s_pairs;
        $profile[$key]['advancedpairs'] = $a_pairs;
    }
}



function errorCheck($array) {   /* Checks user input for errors. Creates copy for case sensitivity.) */
    foreach ($array as $word) {
        $length = strlen($word);
        if (strlen($word) > 20) {
            echo "Error: cannot enter word that exceeds 20 characters!";
            exit;
        }
        if (strlen($word) == 0) {
            echo "Error: cannot have blank lines!";
            exit;
        }
        for ($i=0; $i<$length; $i++) {
            if ($word[$i] != " ") {
                $i++;
            }
            else {
                echo "Error: cannot have spaces inside word!";
                exit;
            }
        }
    }
}






function countSimpleX($key, $word, $word_array, &$s_x) {
    $s_x=0;
    $str = implode(array_unique(str_split(strtolower($word))));
    foreach ($word_array as $key2 => $word2) {
        $str2 = implode(array_unique(str_split(strtolower($word2))));
        if ($key != $key2) {
            checkLength($str, $str2, $length);
            for ($i=0; $i<$length; $i++) {
                if ($str[$i] == $str2[$i]) {
                    $s_x++;
                    $i=$length;
                }
            }
        }
    }
}

function countAdvancedX($key, $word, $word_array, &$a_x) {
    $a_x=0;
    $str = implode(array_unique(str_split(strtolower($word))));
    foreach ($word_array as $key2 => $word2) {
        $str2 = implode(array_unique(str_split(strtolower($word2))));
        if ($key != $key2) {
            checkLength($str, $str2, $length);
            for ($i=0; $i<$length; $i++) {
                if ($str[$i] == $str2[$i]) {
                    $a_x++;
                }
            }
        }
    }
}


function simplePairs($key, $word, $word_array, &$s_pairs) {
    $pair="None";
    $type="s";
    foreach ($word_array as $key2 => $word2){ //about here
        if ($key != $key2) {
            createPairing($word,$word2,$pair,$type);
            $s_pairs = $pair;
        }
    }
}


function advancedPairs($key, $word, $word_array, &$a_pairs) {
    $pair="None";
    $type="a";
    foreach ($word_array as $key2 => $word2){ //about here
        if ($key != $key2) {
            createPairing($word,$word2,$pair,$type);
            $a_pairs = $pair;
            }
        }
}


function createPairing(&$word,&$word2,&$pair,$type) {   //This function will create the "intersections" highlighted with red
    $i=0;
    $arr = str_split($word);    //These arrays are the ones that will be edited and displayed
    $arr2 = str_split($word2);
    $word = strtolower($word);
    $word2 = strtolower($word2);
    $larr = str_split($word);   //lowercase version of the display array for comparing
    $larr2 = str_split($word2);
    $uniq = array_unique($larr);
    $uniq2 = array_unique($larr2);
    $helper_array = array();
    $helper_array2 = array();
    pairHelper($uniq,$uniq2,$helper_array,$helper_array2);


    foreach ($uniq as $key => $letter) {
        if ($type == 's') { //for simple intersections
            if ($i == 0) {
                foreach ($uniq2 as $key2 => $letter2) {
                    if ($letter == $letter2 && $key == $key2) {
                        $key = $helper_array[$key];
                        $key2 = $helper_array2[$key2];
                        $arr[$key] = "<font color=\"red\"><b>$arr[$key]</b></font>";
                        $arr2[$key2] = "<font color=\"red\"><b>$arr2[$key2]</b></font>";
                        if ($pair == "None") {
                            $pair = implode("", $arr) . "-" . implode("", $arr2);
                            $i++;
                        } else {
                            $pair .= ", " . implode("", $arr) . "-" . implode("", $arr2);
                            $i++;
                        }
                    }
                }
            }
        }
        else { //for advanced intersections
            foreach ($uniq2 as $key2 => $letter2) {
                $temp = $arr;
                $temp2 = $arr2;
                if ($letter == $letter2 && $key == $key2) {
                    $key = $helper_array[$key];
                    $key2 = $helper_array2[$key2];
                    $temp[$key] = "<font color=\"red\"><b>$temp[$key]</b></font>";
                    $temp2[$key2] = "<font color=\"red\"><b>$temp2[$key2]</b></font>";
                    if ($pair == "None") {
                        $pair = implode("",$temp)."-".implode("",$temp2);
                        $i++;
                    }
                    else {
                        $pair .= ", ".implode("",$temp)."-".implode("",$temp2);
                        $i++;
                    }
                }
            }
        }
    }
}

function pairHelper(&$array, &$array2, &$helper_array, &$helper_array2) {
    $i=0;
    foreach($array as $key => $letter) {
        $helper_array[$i] = $key;
        if ($key != $i) {
            $array[$i] = $array[$key];
            unset($array[$key]);
            $i++;
        }
        else {
            $array[$i] = $array[$key];
            $i++;
        }
    }
    $i=0;
    foreach($array2 as $key2 => $letter2) {
        $helper_array2[$i] = $key2;
        if ($key2 != $i) {
            $array2[$i] = $array2[$key2];
            unset($array2[$key2]);
            $i++;
        }
        else {
            $array2[$i] = $array2[$key2];
            $i++;
        }
    }

}


function checkLength($word, $word2, &$length) { //sets length. Helps when comparing two string of different lengths
    if (strlen($word)>(strlen($word2))) {
        $length = (strlen($word2));
    }
    else {
        $length = (strlen($word));
    }
    return $length;
}






?>

