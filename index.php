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
	$keymap_text[$k1][$k2][$k3] = $s1;
} } } 
# end of php keymap handling
$keymap_json = json_encode($keymap);
$keymap_text_json = json_encode($keymap_text);
# function
function to_html($s1) {
	return htmlentities($s1);
}
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
	global $vibrate;
	$s1 = 'l';
	if ($side == '1')
		$s1 = 'r';
	$s2 = str_pad(bindec($key), 2, '0', STR_PAD_LEFT); ?> 
	did('<?= $s1; ?>i<?= $s2; ?>').addEventListener('touchstart', function(e){
		if (vibrate == 1)
			navigator.vibrate(<?= $vibrate; ?>);
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
function ptmeta($button, $meta) {
	global $vibrate; ?> 
	did('<?= $button; ?>').addEventListener('touchstart', function(e){
		if (vibrate == 1)
			navigator.vibrate(<?= $vibrate; ?>);
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
function ptswap($id) {
	global $vibrate; ?> 
	did('<?= $id; ?>').addEventListener('touchstart', function(e){
		if (vibrate == 1)
			navigator.vibrate(<?= $vibrate; ?>);
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
function ptclear($s1) { ?> 
	did('<?= to_html($s1); ?>').addEventListener('touchstart', function(e){
		if (vibrate == 1)
			navigator.vibrate(<?= $vibrate; ?>);
	}, false)
	did('<?= to_html($s1); ?>').addEventListener('touchend', function(e){
		// opera requires textarea for copy operations?
		if (did('output_text').innerHTML) {
			did('output_text').select();
			document.execCommand('cut');
			did('output_text').innerHTML = '';
		}
		did('output').innerHTML = '';
		e.preventDefault()
	}, false) <?
}
function ptoption($s1) { ?> 
	did('<?= to_html($s1); ?>').addEventListener('touchstart', function(e){
		if (vibrate == 1)
			navigator.vibrate(<?= $vibrate; ?>);
	}, false)
	did('<?= to_html($s1); ?>').addEventListener('touchend', function(e){
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
	}, false) <?
}
?><!doctype html>
<html id="html">
<head> 
	<meta charset="utf-8"><?
	# 480px is the smallest screen that can fit the 64px by 64px keys but want to accomodate 320px
	# 320/480 = 2/3
	# rounding up seems to work fine
	?>
	<meta name="viewport" content="width=device-width, initial-scale=.7">
	<title>Symmetric Keyboard</title><?
	# php to use php variables
	include('style.php'); ?> 
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
	var keymap_text = <?= ($keymap_text_json); ?>;<?
	if (!empty($default['vibrate'])) {
	switch ($default['vibrate']) {
		case 'on': ?> 
			var vibrate = 1; <?
		break;
		default: ?> 
			var vibrate = 2; <?
		break;
	} } ?> 
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
			var s1 = keymap_text[meta][side][key];
			switch (s1) {
				case '\u00a0':
					s1 = ' '; // breakable spaces for cutting
				break;
			}
			var o3 = document.createTextNode(s1);
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
	<div id="left_base">
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
		<div id="ml16"><img src="vhex/export/01.png" /></div>
		<div id="ml17"><img src="vhex/export/02.png" /></div>
		<div id="ml18"><img src="vhex/export/03.png" /></div>
		<div id="lswap">swap</div>
		<div id="lclear">cut</div>
		<div id="loption">option</div>
	</div>
	</div><?/*
	<div id="extra">
		<div id="clear">Cut</div>
		<!-- <div id="cswap">Swap</div> -->
		<div id="option">Option</div>
	</div>
	*/?><div id="right_base">
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
		<div id="mr16"><img src="vhex/export/01.png" /></div>
		<div id="mr17"><img src="vhex/export/02.png" /></div>
		<div id="mr18"><img src="vhex/export/03.png" /></div>
		<div id="rswap">swap</div>
		<div id="rclear">cut</div>
		<div id="roption">option</div>
	</div>
	</div>
</div>
<!-- <br clear="all" /> -->
<script>
	var i1 = (window.innerWidth - 800)/2;
	if (i1 > 0) {
		document.getElementById('both').style.left = i1 + 'px';
	}
</script>

<span id="option_block" style="margin-top: 30px; margin-bottom: 30px; display: block;">
	<script>
		function choose_keyboard($mode) {
			switch ($mode) {
				case 'left':
					did('left_base').style.display = 'inline-block';
					did('right_base').style.display = 'none';
					// did('both').style.width = '352px'
					did('both').style.width = '465px'
				break;
				case 'right':
					did('left_base').style.display = 'none';
					did('right_base').style.display = 'inline-block';
					// did('both').style.width = '352px'
					did('both').style.width = '465px'
				break;
				case 'both':
					did('left_base').style.display = 'inline-block';
					did('right_base').style.display = 'inline-block';
					did('both').style.width = '1000px'
				break;
			}
		}
		function choose_theme(s1) {
			o1 = did('html');
			switch (s1) {
				case 'dark':
					o1.style.background = 'black';
					o1.style.filter = 'invert(100%)';
					o1.style.webkitFilter = 'invert(100%)';
				break;
				case 'light':
					o1.style.background = 'white';
					o1.style.filter = 'invert(0%)';
					o1.style.webkitFilter = 'invert(0%)';
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
	<p id="choose_theme">
		change theme:
		<a href="javascript: choose_theme('dark')">dark</a>
		<a href="javascript: choose_theme('light')">light</a>
	</p>
	<p id="choose_keymap">
		change keymap: <?
		foreach ($config['keymap'] as $k1 => $v1) { ?> 
			<a href="<?= htmlentities($_SERVER['PHP_SELF']); ?>?keymap=<?= htmlentities($v1); ?>"><?= htmlentities($v1); ?></a><?
		} ?> 
	</p>
	<p id="choose_vibrate">
		change vibrate:
		<a href="javascript: vibrate = 1;">on</a>
		<a href="javascript: vibrate = 2;">off</a>
	</p>
	<p id="choose_mode">
		change mode:
		<a href="javascript: alert('insert mode is currently the only available mode');">insert</a>
		<a href="javascript: alert('command mode not yet implemented')">command</a>
	</p>
	<p><small>not intended for hardware design: "cut" and "option"</small></p>
	<p><small>supported browsers are in green at: <nobr><a href="http://caniuse.com/touch">http://caniuse.com/touch</a></nobr></small></p>
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
		ptswap('lswap');
		ptswap('rswap');
		ptclear('lclear');
		ptclear('rclear');
		ptoption('loption');
		ptoption('roption'); ?> 
		// dont hide typing output
		document.body.scrollTop = document.documentElement.scrollTop = 0;
	}, false)
</script>
<script>
	if (screen.width <= 940) {
		choose_keyboard('left');
	}
</script>
</body>
</html>
