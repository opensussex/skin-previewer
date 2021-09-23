<?php

function output($string, $colour = "none")
{
    switch ($colour) {
        case "red":
            $string = "\033[31m" . $string . "\033[0m";
            break;
        case "green":
            $string = "\033[32m" . $string . "\033[0m";
            break;
        case "yellow":
            $string = "\033[33m" . $string . "\033[0m";
            break;
        case "blue":
            $string = "\033[34m" . $string . "\033[0m";
            break;
        case "magenta":
            $string = "\033[35m" . $string . "\033[0m";
            break;
        case "cyan":
            $string = "\033[36m" . $string . "\033[0m";
            break;
        case "gray":
            $string = "\033[37m" . $string . "\033[0m";
            break;
        default:
            $string = $string;
            break;
    }

    print ($string . "\n");
}


function create_skin($file, $name)
{
    $file_explode = explode('.', $file);
    $preview = $name . '-preview' . '.png';
    $original_skin = imagecreatefromstring(file_get_contents($file));
    $cropped_skin = imagecreatetruecolor(64, 32);
    $preview_skin = imagecreatetruecolor(16, 32);
    // sort out the transparent bg.
    imagesavealpha($cropped_skin, true);
    imagefill($cropped_skin, 0, 0, imagecolorallocatealpha($cropped_skin, 0, 0, 0, 127));
    imagesavealpha($preview_skin, true);
    imagefill($preview_skin, 0, 0, imagecolorallocatealpha($preview_skin, 0, 0, 0, 127));

    imagecopyresized($cropped_skin, $original_skin, 0, 0, 0, 0, 64, 32, 64, 32);
    imagepng($cropped_skin, "skins_out/" . $name . ".png");

    //head
    imagecopyresized($preview_skin, $original_skin, 4, 0, 8, 8, 8, 8, 8, 8);

    //body
    imagecopyresized($preview_skin, $original_skin, 4, 8, 20, 20, 8, 12, 8, 12);

    //left arm
    $left_arm = imagecreatetruecolor(4, 12);
    imagesavealpha($left_arm, true);
    imagefill($left_arm, 0, 0, imagecolorallocatealpha($cropped_skin, 0, 0, 0, 127));


    imagecopyresized($left_arm, $original_skin, 0, 0, 44, 20, 4, 12, 4, 12);
    imageflip($left_arm, IMG_FLIP_HORIZONTAL);
    imagecopyresized($preview_skin, $left_arm, 0, 8, 0, 0, 4, 12, 4, 12);

    //right arm flip the left arm
    imageflip($left_arm, IMG_FLIP_HORIZONTAL);
    imagecopyresized($preview_skin, $left_arm, 12, 8, 0, 0, 4, 12, 4, 12);

    //left leg
    $left_leg = imagecreatetruecolor(4, 12);
    imagesavealpha($left_leg, true);
    imagefill($left_leg, 0, 0, imagecolorallocatealpha($cropped_skin, 0, 0, 0, 127));

    imagecopyresized($left_leg, $original_skin, 0, 0, 4, 20, 4, 12, 4, 12);
    imageflip($left_leg, IMG_FLIP_HORIZONTAL);
    imagecopyresized($preview_skin, $left_leg, 4, 20, 0, 0, 4, 12, 4, 12);

    //right leg - flip the left leg.
    imageflip($left_leg, IMG_FLIP_HORIZONTAL);
    imagecopyresized($preview_skin, $left_leg, 8, 20, 0, 0, 4, 12, 4, 12);

    imagepng($preview_skin, "skins_out/" . $preview);

    imagedestroy($cropped_skin);
    imagedestroy($original_skin);
    imagedestroy($preview_skin);
    imagedestroy($left_arm);
    imagedestroy($left_leg);
}
