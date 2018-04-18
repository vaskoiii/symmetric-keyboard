<?
# author: vaskoiii
# description: qwerty keymap that mimics the hardware keyboard version using only ascii characters

# previously desired keys that do not work with the hardware keyboard
# '&#8580;', # copyleft
# '&infin;', # infinty
# '&deg;', # degree
# '&#928;', # pi
# '/&divide;', # obelus
# '&radic;', # radical

$keymap = array(
	# 00
	# alphabetical with key order
	'00' => array(
		'0' => array(
			'0000' => 'g',
			'0001' => 'a',
			'0010' => 's',
			'0011' => 'd',
			'0100' => 'f',
			'0101' => 'c',
			'0110' => 'x',
			'0111' => 'z',
			'1000' => '<small>res</small>', # reserved/unused
			'1001' => '<small>esc</small>', # escape,
			'1010' => '<small>bs</small>', # backspace
			'1011' => 'q',
			'1100' => 'w',
			'1101' => 'e',
			'1110' => 'r',
			'1111' => 't',
		),
		'1' => array(
			'0000' => 'h',
			'0001' => 'm',
			'0010' => 'l',
			'0011' => 'k',
			'0100' => 'j',
			'0101' => 'v',
			'0110' => 'b',
			'0111' => 'n',
			'1000' => '<small>res</small>',
			'1001' => '<small>ent</small>', # enter
			'1010' => '<small>sp</small>', #space,
			'1011' => 'p',
			'1100' => 'o',
			'1101' => 'i',
			'1110' => 'u',
			'1111' => 'y',
		),
	),
	# 01
	# todo update to releft new keymap
	#  @#$&   |_\/
	#  ;:!?   X`'"
	#    ~X   XX
	'01' => array(
		'0' => array(
			'0000' => '<small>res</small>',
			'0001' => '`',
			'0010' => '=',
			'0011' => '\'',
			'0100' => ':',
			'0101' => '[',
			'0110' => '&lt;', # <
			'0111' => '<small>res</small>',
			'1000' => '<small>res</small>',
			'1001' => '<small>up</small>',
			'1010' => '<small>lt</small>',
			'1011' => '<small>res</small>',
			'1100' => '#',
			'1101' => '$',
			'1110' => '!',
			'1111' => '%',
		),
		'1' => array(
			'0000' => '<small>res</small>',
			'0001' => '~',
			'0010' => '_',
			'0011' => '"',
			'0100' => ';',
			'0101' => ']',
			'0110' => '&gt;', # >
			'0111' => '<small>res</small>',
			'1000' => '<small>res</small>',
			'1001' => '<small>dn</small>',
			'1010' => '<small>rt</small>',
			'1011' => '<small>res</small>',
			'1100' => '@',
			'1101' => '&amp;',
			'1110' => '?',
			'1111' => '|',
		),
	),
	# 10
	# todo update to releft new keymap
	#  .+*^= %XX-,
	#  12345 09876
	#  }])>   <([{
	'10' => array(
		'0' => array(
			'0000' => '<small>res</small>',
			'0001' => '0',
			'0010' => '2',
			'0011' => '4',
			'0100' => '6',
			'0101' => '(',
			'0110' => '{',
			'0111' => '<small>res</small>',
			'1000' => '<small>res</small>',
			'1001' => '<small>pgup</small>',
			'1010' => '<small>tabs</small>',
			'1011' => '\\',
			'1100' => '/',
			'1101' => '-',
			'1110' => '.',
			'1111' => '8',
		),
		'1' => array(
			'0000' => '<small>res</small>',
			'0001' => '1',
			'0010' => '3',
			'0011' => '5',
			'0100' => '7',
			'0101' => ')',
			'0110' => '}',
			'0111' => '<small>res</small>',
			'1000' => '<small>res</small>',
			'1001' => '<small>pgdn</small>',
			'1010' => '<small>tab</small>',
			'1011' => '^',
			'1100' => '*',
			'1101' => '+',
			'1110' => ',',
			'1111' => '9',
		),
	),
	# 11
	# alphabetical with key order
	'11' => array(
		'0' => ARRAY(
			'0000' => 'G',
			'0001' => 'A',
			'0010' => 'S',
			'0011' => 'D',
			'0100' => 'F',
			'0101' => 'C',
			'0110' => 'X',
			'0111' => 'Z',
			'1000' => '<small>res</small>',
			'1001' => '<small>dns</small>',
			'1010' => '<small>rts</small>',
			'1011' => 'Q',
			'1100' => 'W',
			'1101' => 'E',
			'1110' => 'R',
			'1111' => 'T',
		),
		'1' => ARRAY(
			'0000' => 'H',
			'0001' => 'M',
			'0010' => 'L',
			'0011' => 'K',
			'0100' => 'J',
			'0101' => 'V',
			'0110' => 'B',
			'0111' => 'N',
			'1000' => '<small>res</small>',
			'1001' => '',
			'1010' => '',
			'1001' => '<small>ups</small>',
			'1010' => '<small>lts</small>',
			'1011' => 'P',
			'1100' => 'O',
			'1101' => 'I',
			'1110' => 'U',
			'1111' => 'Y',
		),
	),
);
