<?php
# author: vaskoiii
# description: keymap definition to be used by the keyboard

# bit structure (little endian)
# 1 - reserved
# 2 - meta 1
# 3 - meta 2
# 4 - left/right swap
# 5 - k1
# 6 - k2
# 7 - k3
# 8 - k4

# key order (hex)
# whitespace characters are [9] (1001) and [a] (1010) 
# abcdef fedcba
# 912340 043219
#  8765   5678

# qwerty implementation is still a little off due to the left hand being overloaded with more letters on a standard us keyboard ie) [b]
#  qwert yuiop
#  asdfg hjkl 
#  zxcv   nmb

# modifier keys are intentionally the same on both sides of the keyboard and are intentionally not combined to facilitate 1 handed typing (with a special switch button or pedal)

# anticipated shocker is that the space is no longer a thumb press (because it wastes too many potential other keypress combinations)

# configure your keymap below
# any html within '', is valid ie) '&amp;',
# images can also be created and used
# templates designed with inkscape for super custom keys are at:
# ../vhex/v0.svg
# ../vhex/vhex.svg
$keymap = array(
	# main keys
	'00' => array(
		# left hand
		'0' => array(
			'0000' => '',
			'0001' => '',
			'0010' => '',
			'0011' => '',
			'0100' => '',
			'0101' => '',
			'0110' => '',
			'0111' => '',
			'1000' => '',
			'1001' => '',
			'1010' => '',
			'1011' => '',
			'1100' => '',
			'1101' => '',
			'1110' => '',
			'1111' => '',
		),
		# right hand
		'1' => array(
			'0000' => '',
			'0001' => '',
			'0010' => '',
			'0011' => '',
			'0100' => '',
			'0101' => '',
			'0110' => '',
			'0111' => '',
			'1000' => '',
			'1001' => '',
			'1010' => '',
			'1011' => '',
			'1100' => '',
			'1101' => '',
			'1110' => '',
			'1111' => '',
		),
	),
	'01' => array(
		'0' => array(
			'0000' => '',
			'0001' => '',
			'0010' => '',
			'0011' => '',
			'0100' => '',
			'0101' => '',
			'0110' => '',
			'0111' => '',
			'1000' => '',
			'1001' => '',
			'1010' => '',
			'1011' => '',
			'1100' => '',
			'1101' => '',
			'1110' => '',
			'1111' => '',
		),
		'1' => array(
			'0000' => '',
			'0001' => '',
			'0010' => '',
			'0011' => '',
			'0100' => '',
			'0101' => '',
			'0110' => '',
			'0111' => '',
			'1000' => '',
			'1001' => '',
			'1010' => '',
			'1011' => '',
			'1100' => '',
			'1101' => '',
			'1110' => '',
			'1111' => '',
		),
	),
	'10' => array(
		'0' => array(
			'0000' => '',
			'0001' => '',
			'0010' => '',
			'0011' => '',
			'0100' => '',
			'0101' => '',
			'0110' => '',
			'0111' => '',
			'1000' => '',
			'1001' => '',
			'1010' => '',
			'1011' => '',
			'1100' => '',
			'1101' => '',
			'1110' => '',
			'1111' => '',
		),
		'1' => array(
			'0000' => '',
			'0001' => '',
			'0010' => '',
			'0011' => '',
			'0100' => '',
			'0101' => '',
			'0110' => '',
			'0111' => '',
			'1000' => '',
			'1001' => '',
			'1010' => '',
			'1011' => '',
			'1100' => '',
			'1101' => '',
			'1110' => '',
			'1111' => '',
		),
	),
	'11' => array(
		'0' => array(
			'0000' => '',
			'0001' => '',
			'0010' => '',
			'0011' => '',
			'0100' => '',
			'0101' => '',
			'0110' => '',
			'0111' => '',
			'1000' => '',
			'1001' => '',
			'1010' => '',
			'1011' => '',
			'1100' => '',
			'1101' => '',
			'1110' => '',
			'1111' => '',
		),
		'1' => array(
			'0000' => '',
			'0001' => '',
			'0010' => '',
			'0011' => '',
			'0100' => '',
			'0101' => '',
			'0110' => '',
			'0111' => '',
			'1000' => '',
			'1001' => '',
			'1010' => '',
			'1011' => '',
			'1100' => '',
			'1101' => '',
			'1110' => '',
			'1111' => '',
		),
	),
);
