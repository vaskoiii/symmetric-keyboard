<?
# author: vaskoiii
# description: available keymaps

$debug = 2; # 1=true or 2=false

$config['keymap'] = array(
	# first keymap listed is the default
	'qwerty',
	'base',
	# to create a new keymap copy keymap/template.php to keymap/mY_kEyMaP.php edit and add below with:
	# 'mY_kEyMaP',
);
$config['nobraille'] = array(
	# "displaying" braille can overlap keys if using images
	# braille is still intended be used on a hardware implementation to feel the keys
	'base',
	# to hide the braille your keymap can be added below with:
	# 'mY_kEyMaP',
);
