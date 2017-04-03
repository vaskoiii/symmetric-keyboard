<style>
html {
	margin: 0px;
	padding: 0px; }
body {
	margin: 0px;
	padding: 0px;
	text-align: center; }
div {
	border-radius: 10%;
	border: 1px solid #000;
	width: 58px;
	height: 58px;
	line-height: 28px; }
img {
	margin-top: 16px;
	width: 24px;
	height: 24px; }
#choose_position,
#choose_vibrate,
#choose_theme,
#choose_mode,
#choose_keyboard,
#choose_keymap {
	border: none;
	text-align: center;
	width: 100%; }
	#choose_position a,
	#choose_vibrate a,
	#choose_theme a,
	#choose_mode a,
	#choose_keyboard a,
	#choose_keymap a {
		margin: 0px 5px; }
#extra {
	display: inline-block;
	display: none;
	position: relative;
	margin-left: -32px;
	margin-right: -32px;
	border: none;
	width: 64px;
	height: 448px;
	text-align: center; }
	#clear ,
	#option {
		border: 1px dotted;
		color: #777;
		background: #ccc;
		position: absolute;
		left: 50%;
		margin-left: -32px; }
	#clear {
		top: 64px; }
	#lclear,
	#rclear,
	#loption,
	#roption {
		line-height: 56px;
		border: none;
		text-decoration: overline;
		color: #777; }
	#loption {
		position: absolute;
		top: 320px;
		left: 320px;
		}
	#lclear {
		position: absolute;
		top: 64px;
		left: 320px;
		}
	#ltm1, #ltm2, #ltm3, #ltm4, #lcm1, #lcm2, #lcm3, #lcm4 {
		position: absolute;
	}
	#lkm4 {
		border: 1px dotted;
		position: absolute;
		background: #ddd;
		top: 192px;
		left: 320px;	
		}
		#ltm4 { <?
			if ($_GET['texture'] == 'vhex') { ?> 
				background: #ccc;<?
			}
			else { ?> 
				background: url('/vfence/export/m4.png');
				background-size: 56px 56px;
				background-position: 5% -5%;
				opacity: .2; <?
			} ?> 
			position: absolute; }
		#lcm4 {
			margin-top: 12px;
			/* make sure width and height are contained on the key */
			height: auto;
			border: none;
			position: absolute; }
	#roption {
		position: absolute;
		top: 320px;
		left: 0px;
		}
	#rclear {
		position: absolute;
		top: 64px;
		left: 0px;
		}
	#rtm1, #rtm2, #rtm3, #rtm4, #rcm1, #rcm2, #rcm3, #rcm4 {
		position: absolute;
	}
	#rkm4 {
		border: 1px dotted;
		position: absolute;
		top: 192px;
		left: 0px;
		background: #ddd;
		}
		#rtm4 { <?
			if ($_GET['texture'] == 'vhex') { ?> 
				background: #ccc;<?
			}
			else { ?> 
				background: url('/vfence/export/m4.png');
				background-size: 56px 56px;
				background-position: 5% -5%;
				transform: scaleX(-1);
				opacity: .2; <?
			} ?> 
			position: absolute; }
		#rcm4 {
			margin-top: 12px;
			border: none;
			height: auto;
			position: absolute; }
	#option {
		top: 320px;
		margin-bottom: 20px; }
#both {
	border: 1px;
	margin: 0px auto;
	height: 498px;
	/* controls the separation in between left and right keypad */
	width: 1000px; }
#output_anchor {
	width: 100%;
	height: auto;
	white-space: nowrap;
	border-radius: 0px;	
	border-right: 0px;
	border-left: 0px;
	overflow: hidden; }
#output {
	float: right;
	border: 0px;
	border-radius: 0px;	
	/* needed for #output_anchor hack */
	width: auto;
	padding-right: 50%;
	text-align: right;
	min-height: 30px;
	height: auto; }
	#output img {
		width: 24px;
		height: 24px;
		margin-left: 4px;
		margin-right: 4px;
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
	#rkm1, #mri16, #lkm1, #mli16,
	#rkm2, #mri17, #lkm2, #mli17,
	#rkm3, #mri18, #lkm3, #mli18,
	#rlmxx {
		position: absolute; }
#right_base {
	margin: 8px;
	margin-top: 32px;
	border: none;
	display: inline-block;
	width: 396px;
	height: 448px;
	padding: 25px; }
#right {
	border: none;
	position: relative;
	width: 384px;
	height: 448px;
	display: inline-block; } <?
	print_akey(256, 64, '1', '0001');
	print_akey(192, 64, '1', '0010');
	print_akey(128, 64, '1', '0011');
	print_akey(96, 128, '1', '0100');
	print_akey(128, 192, '1', '0101');
	print_akey(160, 128, '1', '0110');
	print_akey(224, 128, '1', '0111');
	print_akey(288, 128, '1', '1000');
	print_akey(320, 64, '1', '1001');
	print_akey(288, 0, '1', '1010');
	print_akey(224, 0, '1', '1011');
	print_akey(160, 0, '1', '1100');
	print_akey(96, 0, '1', '1101');
	print_akey(64, 64, '1', '1110');
	print_akey(32, 128, '1', '1111');
	print_akey(64, 192, '1', '0000'); ?> 
	#rkm1 {
		left: 96px;
		top: 256px; }
	#rkm2 {
		left: 64px;
		top: 320px; }
	#rkm3 {
		left: 32px;
		top: 384px; }
	#r01, #r02, #r03, #r04,
	#r05, #r06, #r07, #r08,
	#r09, #r10, #r11, #r12,
	#r13, #r14, #r15, #r00,
	#rkm1, #rkm2, #rkm3, #rlmxx {
		transform: scaleX(-1);
		opacity: .2;
	} 
	<? # todo dry ?>
	#rkm1 { <?
		if ($_GET['texture'] != 'vhex') { ?> 
			background: url('/vfence/export/m1.png');<?
		} ?> 
	}
	#rkm2 { <?
		if ($_GET['texture'] != 'vhex') { ?> 
			background: url('/vfence/export/m2.png');<?
		} ?> 
	}
	#rkm3 { <?
		if ($_GET['texture'] != 'vhex') { ?> 
			background: url('/vfence/export/m3.png');<?
		} ?> 
	}
#left_base {
	margin: 8px;
	margin-top: 32px;
	border: none;
	display: inline-block;
	width: 396px;
	height: 448px;
	padding: 25px; }
#left {
	border: none;
	position: relative;
	width: 384px; /* width of 6 squares */
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
	#lkm1 {
		left: 224px;
		top: 256px; }
	#lkm2 {
		left: 256px;
		top: 320px; }
	#lkm3 {
		left: 288px;
		top: 384px; }
	<? # todo dry ?>
	#lkm1 { <?
		if ($_GET['texture'] != 'vhex') { ?> 
			background: url('/vfence/export/m1.png');<?
		} ?> 
	}
	#lkm2 { <?
		if ($_GET['texture'] != 'vhex') { ?> 
			background: url('/vfence/export/m2.png');<?
		} ?> 
	}
	#lkm3 { <?
		if ($_GET['texture'] != 'vhex') { ?> 
			background: url('/vfence/export/m3.png');<?
		} ?> 
	}
	#lkm1, #lkm2, #lkm3 {
		opacity: .2;
	} 
/* mix */
	#r01, #l01, #r02, #l02, #r03, #l03, #r04, #l04,
	#r05, #l05, #r06, #l06, #r07, #l07, #r08, #l08,
	#r09, #l09, #r10, #l10, #r11, #l11, #r12, #l12,
	#r13, #l13, #r14, #l14, #r15, #l15, #r00, #l00,
	#rkm1, #lkm1, #rkm2, #lkm2, #rkm3, #lkm3, #rlmxx {
		opacity: .2; <?
		if ($_GET['texture'] == 'vhex') { ?> 
			background-size: 24px 24px;
			background-position:  50% 75%;<?
		}
		else { ?> 
			background-size: 56px 56px;
			background-position: 5% -5%;<?
		}
		if (in_array($_GET['keymap'], $config['nobraille']))
			echo "\n" . 'display: none;'; ?> }
	#mri16, #mli16,
	#mri17, #mli17,
	#mri18, #mli18 {
		opacity: 1; } 
	#rkm1, #lkm1,
	#rkm2, #lkm2,
	#rkm3, #lkm3,
	#rlmxx {
		display: block; }
/* maintain borders on android 320px width devices */
	@media only screen and (max-width:480px) {
		div {
			border: 2px solid #000;
			}
	}
</style>
