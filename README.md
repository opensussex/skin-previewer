# skin-previewer / convertor 
convert minecraft skin to a version usable for minetest wardrobe mod

A simple command line tool to take a skin and make it a 64x32 skin and then make a 16x32 front facing preview.

This preview is not "True" - as we use the right arm for both left and right and just flip.

BUT it's enough for what we need.

To create a minetest skin and preview just run `php create_preview.php Dude.png` for example.

To batch convert a whole load of skins and then create a minetest mod that uses the wardrobe mod 

`php create_skin_mod.php skins_temp/Newskins mod_outputs/newMod n00b`

this tool was inspired by https://wiki.minetest.net/Mods/Wardrobe#Skins_File_Syntax
