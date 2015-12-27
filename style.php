<style>
html {
	margin: 0px;
	padding: 0px; }
body {
	margin: 0px 10px;
	padding: 0px;
	text-align: center; }
div {
	border-radius: 25%;
	border: 1px solid #000;
	width: 58px;
	height: 58px;
	line-height: 28px; }
img {
	margin-top: 16px;
	width: 24px;
	height: 24px; }
#choose_vibrate,
#choose_theme,
#choose_mode,
#choose_keyboard,
#choose_keymap {
	border: none;
	text-align: center;
	width: 100%; }
	#choose_vibrate a,
	#choose_theme a,
	#choose_mode a,
	#choose_keyboard a,
	#choose_keymap a {
		margin: 0px 5px; }
#extra {
	display: inline-block;
	position: relative;
	border: none;
	width: 64px;
	height: 448px;
	text-align: center; }
	#clear ,
	#option ,
	#cswap {
		border: 1px dotted;
		color: #777;
		background: #ccc;
		position: absolute;
		left: 50%;
		margin-left: -32px; }
	#clear {
		top: 64px; }
	#cswap {
		top: 192px;
		border: 1px solid; }
	#option {
		top: 320px;
		margin-bottom: 20px; }
#both {
	border: 1px;
	margin: 0px auto;
	width: 352px; /* width of 5.5 squares */
	height: 448px; /* height  of 7 squares */
	/* controls the separation in between left and right keypad */
	width: 800px; }
#output {
	border-radius: 0px;	
	text-align: center;
	width: 100%;
	max-width: 800px;
	margin: 20px auto;
	min-height: 30px;
	height: auto; }
	#output img {
		width: 24px;
		height: 24px;
		margin-top: 0px;
		margin-bottom: -8px; }

	#ro01, #r01, #ri01, #l01, #li01, #lo01,
	#ro02, #r02, #ri02, #l02, #li02, #lo02,
	#ro03, #r03, #ri03, #l03, #li03, #lo03,
	#ro04, #r04, #ri04, #l04, #li04, #lo04,
	#ro05, #r05, #ri05, #l05, #li05, #lo05,
	#ro06, #r06, #ri06, #l06, #li06, #lo06,
	#ro07, #r07, #ri07, #l07, #li07, #lo07,
	#ro08, #r08, #ri08, #l08, #li08, #lo08,
	#ro09, #r09, #ri09, #l09, #li09, #lo09,
	#ro10, #r10, #ri10, #l10, #li10, #lo10,
	#ro11, #r11, #ri11, #l11, #li11, #lo11,
	#ro12, #r12, #ri12, #l12, #li12, #lo12,
	#ro13, #r13, #ri13, #l13, #li13, #lo13,
	#ro14, #r14, #ri14, #l14, #li14, #lo14,
	#ro15, #r15, #ri15, #l15, #li15, #lo15,
	#ro00, #r00, #ri00, #l00, #li00, #lo00,
	#mr16, #mri16, #ml16, #mli16,
	#mr17, #mri17, #ml17, #mli17,
	#mr18, #mri18, #ml18, #mli18,
	#rlmxx {
		position: absolute; }
#right {
	border: none;
	position: relative;
	width: 352px;
	height: 448px;
	display: inline-block; } <?
	print_akey(224, 64, '1', '0001');
	print_akey(160, 64, '1', '0010');
	print_akey(96, 64, '1', '0011');
	print_akey(64, 128, '1', '0100');
	print_akey(96, 192, '1', '0101');
	print_akey(128, 128, '1', '0110');
	print_akey(192, 128, '1', '0111');
	print_akey(256, 128, '1', '1000');
	print_akey(288, 64, '1', '1001');
	print_akey(256, 0, '1', '1010');
	print_akey(192, 0, '1', '1011');
	print_akey(128, 0, '1', '1100');
	print_akey(64, 0, '1', '1101');
	print_akey(32, 64, '1', '1110');
	print_akey(0, 128, '1', '1111');
	print_akey(32, 192, '1', '0000'); ?> 
	#mr16 {
		left: 64px;
		top: 256px; }
	#mr17 {
		left: 32px;
		top: 320px; }
	#mr18 {
		left: 0px;
		top: 384px; }
	#r01, #r02, #r03, #r04,
	#r05, #r06, #r07, #r08,
	#r09, #r10, #r11, #r12,
	#r13, #r14, #r15, #r00,
	#mr16, #mr17, #mr18, #rlmxx {
		transform: scaleX(-1);
	} 
#left {
	border: none;
	position: relative;
	width: 352px; /* width of 5.5 squares */
	height: 448px; /* height  of 7 squares */
	display: inline-block; } <?
	print_akey(64, 64, '0', '0001');
	print_akey(128, 64, '0', '0010');
	print_akey(192, 64, '0', '0011');
	print_akey(224, 128, '0', '0100');
	print_akey(192, 192, '0', '0101');
	print_akey(160, 128, '0', '0110');
	print_akey(96, 128, '0', '0111');
	print_akey(32, 128, '0', '1000');
	print_akey(0, 64, '0', '1001');
	print_akey(32, 0, '0', '1010');
	print_akey(96, 0, '0', '1011');
	print_akey(160, 0, '0', '1100');
	print_akey(224, 0, '0', '1101');
	print_akey(256, 64, '0', '1110');
	print_akey(288, 128, '0', '1111');
	print_akey(256, 192, '0', '0000'); ?> 
	#ml16 {
		left: 224px;
		top: 256px; }
	#ml17 {
		left: 256px;
		top: 320px; }
	#ml18 {
		left: 288px;
		top: 384px; }
/* mix */
	#r01, #l01, #r02, #l02, #r03, #l03, #r04, #l04,
	#r05, #l05, #r06, #l06, #r07, #l07, #r08, #l08,
	#r09, #l09, #r10, #l10, #r11, #l11, #r12, #l12,
	#r13, #l13, #r14, #l14, #r15, #l15, #r00, #l00,
	#mr16, #ml16, #mr17, #ml17, #mr18, #ml18, #rlmxx {
		opacity: .2;
		background-size: 24px 24px;
		background-position:  50% 75%;<?
		if (in_array($_GET['keymap'], $config['nobraille']))
			echo "\n" . 'display: none;'; ?> }
	#mr16, #ml16,
	#mr17, #ml17,
	#mr18, #ml18,
	#rlmxx {
		display: block; }
/* maintain borders on android 320px width devices */
	@media only screen and (max-width:480px) {
		div {
			border: 2px solid #000;
			}
	}
</style>
