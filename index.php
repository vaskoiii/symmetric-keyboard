<?
# author: vaskoiii
# description: software implementation of symmetric keyboard
include('config.php');
$keymap = array();
$keymap_text = array();
if (empty($_GET['keymap']))
	$_GET['keymap'] = $config['keymap'][0];
if (in_array($_GET['keymap'], $config['keymap']))
	include('keymap/' . $_GET['keymap'] . '.php');
foreach ($keymap as $k1 => $v1) {
foreach ($v1 as $k2 => $v2) {
foreach ($v2 as $k3 => $v3) {
	$s1 = strip_tags($v3);
	$s1 = html_entity_decode($s1);
	$keymap_text[$k1][$k2][$k3] = strip_tags($s1);
} } } 
# end of php keymap handling
$keymap_json = json_encode($keymap);
$keymap_text_json = json_encode($keymap_text);
# function
function print_key($side, $key) {
	$s1 = 'l';
	if ($side == '1')
		$s1 = 'r';
	$s2 = str_pad(bindec($key), 2, '0', STR_PAD_LEFT); ?> 
	<div id="<?= $s1; ?>o<?= $s2; ?>"></div>
	<div id="<?= $s1; ?><?= $s2; ?>"></div>
	<div id="<?= $s1; ?>i<?= $s2; ?>"></div><?
	/*  onclick="pout(current, '<?= $side; ?>', '<?= $key; ?>', keymap, mirror);" */
}
function print_akey($left, $top, $side, $key) {
	$s1 = 'l';
	if ($side == '1')
		$s1 = 'r';
	$s2 = str_pad(bindec($key), 2, '0', STR_PAD_LEFT); ?> 
	#<?= $s1; ?>o<?= $s2; ?>, #<?= $s1 . $s2; ?>, #<?= $s1; ?>i<?= $s2; ?> { 
		left: <?= $left; ?>px;
		top: <?= $top; ?>px;
		}
		#<?= $s1 . $s2; ?> {
			background: url('vhex/export/<?= $s2; ?>.png') no-repeat center;
		}<?
}
function ptkey($side, $key) {
	$s1 = 'l';
	if ($side == '1')
		$s1 = 'r';
	$s2 = str_pad(bindec($key), 2, '0', STR_PAD_LEFT); ?> 
	did('<?= $s1; ?>i<?= $s2; ?>').addEventListener('touchstart', function(e){
		if (did('<?= $s1; ?>i<?= $s2; ?>').innerHTML == '<small>bs</small>')
			delete_output();
		else
			pout(current, '<?= $side; ?>', '<?= $key; ?>', keymap, keymap_text, mirror);
		e.preventDefault()
	}, false)
	did('<?= $s1; ?>i<?= $s2; ?>').addEventListener('touchend', function(e){
		e.preventDefault()
	}, false)<?
}
function ptmeta($button, $meta) { ?> 
	did('<?= $button; ?>').addEventListener('touchstart', function(e){
		current = '<?= $meta; ?>';
		meta_mod(current, keymap, mirror);
		e.preventDefault()
	}, false)
	did('<?= $button; ?>').addEventListener('touchend', function(e){
		current = '00';
		meta_mod(current, keymap, mirror);
		e.preventDefault()
	}, false)<?
}
function ptswap($id) { ?> 
	did('<?= $id; ?>').addEventListener('touchstart', function(e){
		mirror = 1;
		// current = '00';
		meta_mod(current, keymap, mirror);
		e.preventDefault()
	}, false)
	did('<?= $id; ?>').addEventListener('touchend', function(e){
		mirror = 2;
		// current = '00'
		meta_mod(current, keymap, mirror);
		e.preventDefault()
	}, false) <?
}
?><!doctype html>
<html>
<head> 
	<meta charset="utf-8"><?
	# 480px is the smallest screen that can fit the 64px by 64px keys but want to accomodate 320px
	# 320/480 = 2/3
	# rounding up seems to work fine
	?>
	<meta name="viewport" content="width=device-width, initial-scale=.7">
	<title>Symmetric Keyboard</title>
<style>
	#choose_mode,
	#choose_keyboard,
	#choose_keymap {
		border: none;
		text-align: center;
		width: 100%;
		}
		#choose_mode a,
		#choose_keyboard a,
		#choose_keymap a {
			margin: 0px 5px;
			}
	#extra {
		display: inline-block;
		position: relative;
		border: none;
		width: 64px;
		height: 448px;
		text-align: center;
		}
		#clear ,
		#option ,
		#cswap {
			border: 1px dotted;
			color: #777;
			background: #ccc;
			position: absolute;
			left: 50%;
			margin-left: -32px;
			}
		#clear {
			top: 64px;
			}
		#cswap {
			top: 192px;
			border: 1px solid;
			}
		#option {
			top: 320px;
			margin-bottom: 20px;
			}
</style>
<script>
	function delete_output() {
		var elem = document.getElementById('output').lastChild;
		elem.parentNode.removeChild(elem);
		var elem_text = document.getElementById('output_text').lastChild;
		elem_text.parentNode.removeChild(elem_text);
	}
	// global scope for keymap
	<? # cant encode because already should be html ?>
	var keymap = <?= ($keymap_json); ?>;
	var keymap_text = <?= ($keymap_text_json); ?>;
	var mirror = 2;
	var current = '00';
	function did(s1) {
		return document.getElementById(s1);
	}
	function poutput(s1) {
		var o1 = document.createElement('img');
		var o2 = document.getElementById('output');
		o1.src = 'vhex/export/' + s1 + '.png';
		o2.appendChild(o1);
	}
	function pout(meta, side, key, keymap, keymap_text, invert) {
		var o1 = document.createElement('span');
		var o2 = document.getElementById('output');
		if (invert == 1)
		switch(side) {
			case '0':
				side = '1';
			break;
			case '1':
				side = '0';
			break;
		}
		o1.innerHTML = keymap[meta][side][key];
		o2.appendChild(o1);
		if (1) { 
			// enable ouptut cutting on opera
			var o3 = document.createTextNode(keymap_text[meta][side][key]);
			did('output_text').appendChild(o3);
		}
	}
	function pad(num, size) {
		var s1 = num + '';
		while (s1.length < size)
			s1 = '0' + s1;
		return s1;
	}
	function meta_mod(meta, keymap, invert) {
		for (var k1 in keymap) {
		if (keymap.hasOwnProperty(k1)) {
			for (var k2 in keymap[k1]) {
			if (keymap[k1].hasOwnProperty(k2)) {
				for (var k3 in keymap[k1][k2]) {
				if (keymap[k1][k2].hasOwnProperty(k3)) {
					// console.log(k1 + ' ' + k2 + ' ' + k3 + " -> " + keymap[k1][k2][k3]);
					if (k1 == meta)
					switch(meta) {
						case '00':
						case '01':
						case '10':
						case '11':
							var side;
							switch(k2) {
								case '0':
									side = 'li';
								break;
								case '1':
									side = 'ri';
								break;
							}
							if (invert == 1)
							switch (side) {
								case 'li':
									side = 'ri';
								break;
								case 'ri':
									side = 'li';
								break;
							}
							did(side + pad(parseInt(k3, 2), 2)).innerHTML = keymap[k1][k2][k3];
						break;
						default:
						break;	
					}
				} }
			} }
		} }
	}
	// console.log(keymap);
	// meta_mod('00', keymap, 2);
	// meta_mod('01', keymap, 2);
	// meta_mod('10', keymap, 2);
	// meta_mod('11', keymap, 2);
</script>
<style>
	html {
		margin: 0px;
		padding: 0px;
		}
	body {
		margin: 0px 10px;
		padding: 0px;
		text-align: center;
		}
	div {
		border-radius: 25%;
		border: 1px solid #000;
		width: 58px;
		height: 58px;
		line-height: 28px;
		}
	img {
		margin-top: 16px;
		width: 24px;
		height: 24px;
		}
	#both {
		border: 1px;
		margin: 0px auto;
		width: 352px; /* width of 12.5 squares */
		height: 448px; /* height  of 8 squares */
		/* controls the separation in between left and right keypad */
		width: 800px;
		}
	#output {
		border-radius: 0px;	
		text-align: center;
		width: 100%;
		max-width: 800px;
		margin: 20px auto;
		min-height: 30px;
		height: auto;
		}
		#output img {
			width: 24px;
			height: 24px;
			margin-top: 0px;
			margin-bottom: -8px;
			}
	#right {
		/* border: 1px solid red; */
		border: none;
		position: relative;
		width: 352px;
		height: 448px;
		display: inline-block;
		}
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
			position: absolute;
			} <?
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
		print_akey(32, 192, '1', '0000');
		?> 
		#mr16 {
			position: absolute;
			left: 64px;
			top: 256px;
			}
		#mr17 {
			position: absolute;
			left: 32px;
			top: 320px;
			}
		#mr18 {
			position: absolute;
			left: 0px;
			top: 384px;
			}
	#left {
		/* border: 1px solid blue; */
		border: none;
		position: relative;
		width: 352px; /* width of 12.5 squares */
		height: 448px; /* height  of 8 squares */
		display: inline-block;
		} <?
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
		print_akey(256, 192, '0', '0000');
		?> 
		#ml16 {
			left: 224px;
			top: 256px;
			}
		#ml17 {
			left: 256px;
			top: 320px;
			}
		#ml18 {
			left: 288px;
			top: 384px;
			}
	/* mix */
		#r01, #l01,
		#r02, #l02,
		#r03, #l03,
		#r04, #l04,
		#r05, #l05,
		#r06, #l06,
		#r07, #l07,
		#r08, #l08,
		#r09, #l09,
		#r10, #l10,
		#r11, #l11,
		#r12, #l12,
		#r13, #l13,
		#r14, #l14,
		#r15, #l15,
		#r00, #l00,
		#mr16, #ml16,
		#mr17, #ml17,
		#mr18, #ml18,
		#rlmxx {
			opacity: .2;
			background-size: 24px 24px;
			background-position:  50% 75%;<?
			if (in_array($_GET['keymap'], $config['nobraille']))
				echo "\n" . 'display: none;'; ?> 
			}
		#mr16, #ml16,
		#mr17, #ml17,
		#mr18, #ml18,
		#rlmxx {
			display: block;
			}
</style>
</head>
<body><?
if ($debug != 1)
	$s1 = ' position: absolute; margin-top: -999px;';
else
	$s1 = ''; ?> 
<span style="display: block;<?= $s1; ?>">
	<textarea id="output_text"></textarea>
</span>
<div id="output"></div>
<div id="both">
	<div id="left"><?
		print_key('0', '0000');
		print_key('0', '0001');
		print_key('0', '0010');
		print_key('0', '0011');
		print_key('0', '0100');
		print_key('0', '0101');
		print_key('0', '0110');
		print_key('0', '0111');
		print_key('0', '1000');
		print_key('0', '1001');
		print_key('0', '1010');
		print_key('0', '1011');
		print_key('0', '1100');
		print_key('0', '1101');
		print_key('0', '1110');
		print_key('0', '1111'); ?> 
		<!-- meta -->
		<div id="ml16"><img src="vhex/export/00.png" /><img src="vhex/export/01.png" /></div>
		<div id="ml17"><img src="vhex/export/00.png" /><img src="vhex/export/02.png" /></div>
		<div id="ml18"><img src="vhex/export/00.png" /><img src="vhex/export/03.png" /></div>
	</div>
	<div id="extra">
		<div id="clear">Cut</div>
		<div id="cswap">Swap</div>
		<div id="option">Option</div>
	</div>
	<div id="right"><?
		print_key('1', '0000');
		print_key('1', '0001');
		print_key('1', '0010');
		print_key('1', '0011');
		print_key('1', '0100');
		print_key('1', '0101');
		print_key('1', '0110');
		print_key('1', '0111');
		print_key('1', '1000');
		print_key('1', '1001');
		print_key('1', '1010');
		print_key('1', '1011');
		print_key('1', '1100');
		print_key('1', '1101');
		print_key('1', '1110');
		print_key('1', '1111'); ?> 
		<!-- meta -->
		<div id="mr16"><img src="vhex/export/00.png" /><img src="vhex/export/01.png" /></div>
		<div id="mr17"><img src="vhex/export/00.png" /><img src="vhex/export/02.png" /></div>
		<div id="mr18"><img src="vhex/export/00.png" /><img src="vhex/export/03.png" /></div>
	</div>
</div>
<br clear="all" />
<script>
	var i1 = (window.innerWidth - 800)/2;
	if (i1 > 0) {
		document.getElementById('both').style.left = i1 + 'px';
	}
</script>

<span id="option_block" style="display: block;">
	<script>
		function choose_keyboard($mode) {
			switch ($mode) {
				case 'left':
					did('left').style.display = 'inline-block';
					did('right').style.display = 'none';
					// did('both').style.width = '352px'
					did('both').style.width = '440px'
				break;
				case 'right':
					did('left').style.display = 'none';
					did('right').style.display = 'inline-block';
					// did('both').style.width = '352px'
					did('both').style.width = '440px'
				break;
				case 'both':
					did('left').style.display = 'inline-block';
					did('right').style.display = 'inline-block';
					did('both').style.width = '800px'
				break;
			}
		}
	</script>
	<p id="choose_keyboard">
		change keyboard:
		<a href="javascript: choose_keyboard('left')">left_only</a>
		<a href="javascript: choose_keyboard('right')">right_only</a>
		<a href="javascript: choose_keyboard('both')">both</a>
	</p>
	<p id="choose_keymap">
		change keymap: <?
		foreach ($config['keymap'] as $k1 => $v1) { ?> 
			<a href="<?= htmlentities($_SERVER['PHP_SELF']); ?>?keymap=<?= htmlentities($v1); ?>"><?= htmlentities($v1); ?></a><?
		} ?> 
	</p>
	<p id="choose_mode">
		change mode:
		<a href="javascript: alert('insert mode is currently the only available mode');">insert</a>
		<a href="javascript: alert('command mode not yet implemented')">command</a>
	</p>
	<p><small>Supported Browsers are in Green at: <nobr><a href="http://caniuse.com/touch">http://caniuse.com/touch</a></nobr></small></p>
</span>
<script>
	// dont get keymap asynchronously (with ajax)
	// keep keymap always loaded into local memory
	meta_mod('00', keymap, mirror); 
	window.addEventListener('load', function() { <?
		# left
		ptkey('0', '0000');
		ptkey('0', '0001');
		ptkey('0', '0010');
		ptkey('0', '0011');
		ptkey('0', '0100');
		ptkey('0', '0101');
		ptkey('0', '0110');
		ptkey('0', '0111');
		ptkey('0', '1000');
		ptkey('0', '1001');
		ptkey('0', '1010');
		ptkey('0', '1011');
		ptkey('0', '1100');
		ptkey('0', '1101');
		ptkey('0', '1110');
		ptkey('0', '1111');
		# right
		ptkey('1', '0000');
		ptkey('1', '0001');
		ptkey('1', '0010');
		ptkey('1', '0011');
		ptkey('1', '0100');
		ptkey('1', '0101');
		ptkey('1', '0110');
		ptkey('1', '0111');
		ptkey('1', '1000');
		ptkey('1', '1001');
		ptkey('1', '1010'); # special case added for delete
		ptkey('1', '1011');
		ptkey('1', '1100');
		ptkey('1', '1101');
		ptkey('1', '1110');
		ptkey('1', '1111');
		# meta
		ptmeta('ml16', '01');
		ptmeta('ml17', '10');
		ptmeta('ml18', '11');
		ptmeta('mr16', '01');
		ptmeta('mr17', '10');
		ptmeta('mr18', '11');
		# swap
		ptswap('cswap');
		?> 
		did('clear').addEventListener('touchend', function(e){
			// opera requires textarea for copy operations?
			if (did('output_text').innerHTML) {
				did('output_text').select();
				document.execCommand('cut');
				did('output_text').innerHTML = '';
			}
			did('output').innerHTML = '';
			e.preventDefault()
		}, false)
		did('option').addEventListener('touchend', function(e){
			o1 = did('option_block');
			switch (o1.style.display) {
				case 'block':
					o1.style.display = 'none';
				break;
				default:
					o1.style.display = 'block';
				break;
			}
			e.preventDefault()
		}, false)
	}, false)
</script>
<script>
	if (screen.width <= 840) {
		choose_keyboard('left');
	}
</script>
<style>
	/* maintain borders on android 320px width devices */
	@media only screen and (max-width:480px) {
		div {
			border: 2px solid #000;
			}
	}
</style>
</body>
</html>
