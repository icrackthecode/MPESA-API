<?php

$part1 = "Unable to find or open file!";
$part2 = "Please ensure you have a .env file in your the same directory this dovenv.php loader exists";
$ENV_FILE = fopen(".env", "r") or die($part1.' '.$part2);

// Read the file line by line
while(!feof($ENV_FILE)) {
    $ENV_PARAM = fgets($ENV_FILE);
    // echo $ENV_PARAM;
    $META_DATA = split('=', $ENV_PARAM);

    if(sizeof($META_DATA) >= 2) {
        $ENV_PROP = $META_DATA[0];
        $ENV_VALUE = $META_DATA[1];

        // Put the content of the file into ENV
        $quotations = array('\"', '\'');
        $_ENV[$ENV_PROP] = str_replace($quotations, '', $ENV_VALUE);
        // echo $_ENV[$ENV_PROP];
    }
}

fclose($ENV_FILE);

?>
