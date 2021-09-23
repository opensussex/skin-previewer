<?php

include('functions.php');
    
$args = $argv;


if (count($argv) < 4) {
        output("* Please add a directory of skins and an output mod directory", "yellow");
        output("php create_skin_mod.php <source_dir> <out_dir> <name> ", "green");
        exit();
}



$skins_directory = $argv[1];
$output_directory = $argv[2];
$mod_name = $argv[3];

if (!file_exists($skins_directory)) {
    output("skins directory " . $skins_directory . " does not exist", "yellow");
    exit();
}

if (file_exists($output_directory)) {
    rrmdir($output_directory);
}

copy_dir("skin_mod_template", $output_directory);

$initial_skins = array_slice(scandir($skins_directory), 2);
$skins_list = [];
$skins_output_directory = $output_directory . "/" . "textures/";
foreach ($initial_skins as $skin) {
    $skin_name = explode('.', $skin)[0];
    output("* Creating Skin " . $skin_name . " " . $skins_output_directory, "cyan");

    create_skin($skins_directory . "/" . $skin, $skin_name, $skins_output_directory);
    $skins_list[] = '"' . $skin_name . '"';
}

//replace string in init.lua

$init_lua=file_get_contents($output_directory . "/init.lua");

$init_lua=str_replace("|skin_list|", implode($skins_list, ','), $init_lua);

file_put_contents($output_directory . "/init.lua", $init_lua);


//update mod.conf
$mod_conf=file_get_contents($output_directory . "/mod.conf");

$mod_conf=str_replace("|mod_name|", $mod_name, $mod_conf);

file_put_contents($output_directory . "/mod.conf", $mod_conf);

output("* New Skin Mod created in " . $argv[2] . " directory", "green");
exit();
