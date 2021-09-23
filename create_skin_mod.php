<?php

include('functions.php');
    
$args = $argv;


if (count($argv) < 3) {
        output("* Please add a directory of skins and an output directory", "yellow");
        output("php create_skin_mod.php skins skin_mode", "green");
        exit();
}

//create_skin($argv[1], $argv[2]);
output("* New Skin Mod created in " . $argv[2] . " directory", "green");
exit();
