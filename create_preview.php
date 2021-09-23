<?php

include('functions.php');
    
$args = $argv;



if (count($argv) < 3) {
        output("Please add a file name and skin name", "yellow");
        output("php create_preview.php Dude.png NewDude", "green");
        exit();
}

create_skin($argv[1], $argv[2]);
output("New Skin and Preview created", "green");
exit();
