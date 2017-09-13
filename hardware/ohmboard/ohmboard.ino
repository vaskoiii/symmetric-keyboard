// author: vaskoiii
// description: one handed mirror board (ohmboard) - aka vaskos diy keyboard - standalone and pairable, right or left usb keyboard with only 20 scissor keys supporting all ascii characters - hardware is created separately

// TODO ability to repeat keys including meta ie) for gaming

// previous thoughts
// TODO double thumb press ie. kupfer ctrl space?
// TODO mod keys should be able to be vi <leader> keys?
// TODO setup i2c to accept modifiers from the other half of the keyboard?

// utf-8 keystrokes not possible with the usb keyboard standard?

// teensyduino: You must select Keyboard from the "Tools > USB Type" menu
// or you can hack boards.txt with the build menu options you want and use arduino-builder from command line. see: ohmboard.sh

#include <Bounce.h>

// modifier
int m1 = 0;
int m2 = 0;
int m3 = 0;

unsigned int timeout = 2000;
elapsedMillis timer;

int b1 = 2;

// TODO test times on the gmyle keys
// times below are for the aluminum sandwitched keys (maybe boxcave keys)
// crappy keys need a pretty high debounce time
// debounce time start at 10 (ms) and increase if a button is too "sensitive"
int dt = 80;
// 160 too slow feels like keys are heavy and unresponsive
// 080 works happy spot
// 040 maybe the max
// 020 too many double keypresses
// most accuracy seems to be in the range of 20 - 80

const int bp0 = 0; 
const int bp1 = 1; 
const int bp2 = 2; 
const int bp3 = 3; 
const int bp4 = 4;
const int bp5 = 5;
const int bp6 = 6;
const int bp7 = 7;
const int bp8 = 8;
const int bp9 = 9;
const int bp10 = 10;
const int bp11 = 11;
const int bp12 = 12;
const int bp13 = 15;
const int bp14 = 16;
const int bp15 = 17; // s1
const int bp16 = 20;
const int bp17 = 21; // m1
const int bp18 = 22; // m2
const int bp19 = 23; // m3
// pins saved for SCL0 SDA0 (i2c expansion)
// 18
// 19

// TODO easy left/right toggle for mod keys

// comment out the corresponding section (can only have 1 global definition)
// TODO better way?
// map button press to spiral numbering for use with keymap array

// left
/*
	int left = 1;
	const int bi0 = 5; 
	const int bi1 = 6; 
	const int bi2 = 7; 
	const int bi3 = 8; 
	const int bi4 = 9;
	const int bi5 = 10;
	const int bi6 = 1;
	const int bi7 = 11;
	const int bi8 = 2;
	const int bi9 = 12;
	const int bi10 = 3;
	const int bi11 = 13;
	const int bi12 = 14;
	const int bi13 = 15;
	const int bi14 = 4;
	const int bi15 = 0; // s1
	const int bi16 = 0; // non-dummy 0
	const int bi17 = 0; // m1
	const int bi18 = 0; // m2
	const int bi19 = 0; // m3
// */

// right
// /*
	int left = 2;
	const int bi0 = 0; // m3 
	const int bi1 = 0;  // m2
	const int bi2 = 0;  // m1
	const int bi3 = 0; // non-dummy 0
	const int bi4 = 0; // s1
	const int bi5 = 4;
	const int bi6 = 15;
	const int bi7 = 14;
	const int bi8 = 13;
	const int bi9 = 3;

	const int bi10 = 12;
	const int bi11 = 2;
	const int bi12 = 11;
	const int bi13 = 1;
	const int bi14 = 10;
	const int bi15 = 9;
	const int bi16 = 8;

	const int bi17 = 7;
	const int bi18 = 6;
	const int bi19 = 5;
// */

Bounce button0 = Bounce(bp0, dt);
Bounce button1 = Bounce(bp1, dt);
Bounce button2 = Bounce(bp2, dt);
Bounce button3 = Bounce(bp3, dt);
Bounce button4 = Bounce(bp4, dt);
Bounce button5 = Bounce(bp5, dt);
Bounce button6 = Bounce(bp6, dt);
Bounce button7 = Bounce(bp7, dt);
Bounce button8 = Bounce(bp8, dt);
Bounce button9 = Bounce(bp9, dt);
Bounce button10 = Bounce(bp10, dt);
Bounce button11 = Bounce(bp11, dt);
Bounce button12 = Bounce(bp12, dt);
Bounce button13 = Bounce(bp13, dt);
Bounce button14 = Bounce(bp14, dt);
Bounce button15 = Bounce(bp15, dt);
Bounce button16 = Bounce(bp16, dt);
Bounce button17 = Bounce(bp17, dt);
Bounce button18 = Bounce(bp18, dt);
Bounce button19 = Bounce(bp19, dt);

// mapping: some shift key potential combinations were eliminated as well as:
// del
// ins
// home
// end

// invisibles: desired mappings/navigationability
// main
//  space/backspace
//  escape/enter
// alternate (reversed)
//  tab/shift-tab
//  pgdn/pgup
// arrows
//  right/left
//  down/up
// arrows shifted
//  shift-right/shift-left
//  shift-down/shift-up

// TODO better solution that putting KEY_X in the available mappings?

// https://www.pjrc.com/teensy/td_keyboard.html
const uint16_t keymap[4][2][16] = {
	{ // 00 
		{ // 0
			KEY_G, // 0000
			KEY_A, // 0001
			KEY_S, // 0010
			KEY_D, // 0011
			KEY_F, // 0100
			KEY_C, // 0101
			KEY_X, // 0110
			KEY_Z, // 0111
			KEY_X, // 1000
			KEY_ESC, // 1001
			KEY_SPACE, // 1010
			KEY_Q, // 1011
			KEY_W, // 1100
			KEY_E, // 1101
			KEY_R, // 1110
			KEY_T // 1111
		},
		{ // 1
			KEY_H, // 0000
			KEY_M, // 0001
			KEY_L, // 0010
			KEY_K, // 0011
			KEY_J, // 0100
			KEY_V, // 0101
			KEY_B, // 0110
			KEY_N, // 0111
			KEY_X, // 1000
			KEY_ENTER, // 1001
			KEY_BACKSPACE, // 1010
			KEY_P, // 1011
			KEY_O, // 1100
			KEY_I, // 1101
			KEY_U, // 1110
			KEY_Y // 1111
		}
	},

	// .+*^= %XX-,
	// 13579 86420
	// {[(<   >)]}
	{ // 01
		{ // 0
			KEY_9, // 0000
			KEY_1, // 0001
			KEY_3, // 0010
			KEY_5, // 0011
			KEY_7, // 0100
			KEY_COMMA, // shifted to < // 0110
			KEY_9, // shifted to ( // 0101
			KEY_LEFT_BRACE, // 0111
			KEY_LEFT_BRACE, // shifted to { // 1000
			KEY_PAGE_DOWN, // 1001
			KEY_TAB, //  1010
			KEY_PERIOD, // 1011
			KEY_EQUAL, // shifted to + // 1100
			KEY_8, // shifted to * // 1101
			KEY_6, // shifted to ^ // 1110
			KEY_EQUAL // 1111
		},
		{ // 1
			KEY_8, // 0000
			KEY_0, // 0001
			KEY_2, // 0010
			KEY_4, // 0011
			KEY_6, // 0100
			KEY_PERIOD, // shifted to > // 0110
			KEY_0, // shifted to ) // 0101
			KEY_RIGHT_BRACE, // 0111
			KEY_RIGHT_BRACE, // shifted to } // 1000
			KEY_PAGE_UP, // 1001
			KEY_TAB, // shifted to "shift tab" // TODO reverse tab possible? // 1010
			KEY_COMMA, // 1011
			KEY_MINUS, // 1100
			KEY_X, // TODO &divide; // 1101
			KEY_X, // TODO &radic; // 1110
			KEY_5 // shifted to % // 1111
		}
	},

	// TODO finalize keymap
	// x#$_x x|&@x
	// ;'?\x x/!":
	//  xx`x x~xx
	{ // 10
		{ // 0
			KEY_X, // 0000
			KEY_SEMICOLON, // 0001
			KEY_QUOTE, // 0010
			KEY_SLASH, // shifted to ? // 0011
			KEY_BACKSLASH, // 0100
			KEY_X, // TODO copyleft // 0101
			KEY_TILDE, // pjrc mislabelled (should be KEY_GRAVE) // shifted to get ~ // 0110
			KEY_X, // 0111
			KEY_X, // 1000
			KEY_DOWN, //  1001
			KEY_RIGHT, // 1010
			KEY_X, // TODO pi // 1011
			KEY_3, // shifted to # // 1100
			KEY_4, // shifted to $ // 1101
			KEY_MINUS, // shifted to _ // 1110
			KEY_X // 1111
		},
		{ // 1
			KEY_X, // 0000
			KEY_SEMICOLON, // shifted to : // 0001
			KEY_QUOTE, // shifted to " // 0010
			KEY_1, // shifted to ! // 0011
			KEY_SLASH, // 0100
			KEY_X, // TODO infinty // 0101
			KEY_TILDE, // pjrc mislabelled (should be KEY_GRAVE) // actually ` // 0110
			KEY_X, // 0111
			KEY_X, // 1000
			KEY_UP, //  1001
			KEY_LEFT, // 1010
			KEY_X, // TODO degree // 1011
			KEY_2, // shifted to @ // 1100
			KEY_7, // shifted to & // 1101
			KEY_BACKSLASH, // shifted to | // 1110
			KEY_X // 1111
		}
	},

	// all this section is shifted for capitalization
	{ // 11
		{ // 0
			KEY_G, // 0000
			KEY_A, // 0001
			KEY_S, // 0010
			KEY_D, // 0011
			KEY_F, // 0100
			KEY_C, // 0101
			KEY_X, // 0110 // actual X
			KEY_Z, // 0111
			KEY_X, // 1000
			KEY_DOWN, //  1001
			KEY_RIGHT, // 1010
			KEY_Q, // 1011
			KEY_W, // 1100
			KEY_E, // 1101
			KEY_R, // 1110
			KEY_T // 1111
		},
		{ // 1
			KEY_H, // 0000
			KEY_M, // 0001
			KEY_L, // 0010
			KEY_K, // 0011
			KEY_J, // 0100
			KEY_V, // 0101
			KEY_B, // 0110
			KEY_N, // 0111
			KEY_X, // 1000
			KEY_UP, //  1001
			KEY_LEFT, // 1010
			KEY_P, // 1011
			KEY_O, // 1100
			KEY_I, // 1101
			KEY_U, // 1110
			KEY_Y // 1111
		}
	}
};

// 1 means shift
// array is annoyingly decoupled from the keymap
const int shiftmap[4][2][16] = {
	{ // 00 
		{ // 0
			2, // 0000
			2, // 0001
			2, // 0010
			2, // 0011
			2, // 0100
			2, // 0101
			2, // 0110
			2, // 0111
			2, // 1000
			2, // 1001
			2, // 1010
			2, // 1011
			2, // 1100
			2, // 1101
			2, // 1110
			2 // 1111
		},
		{ // 1
			2, // 0000
			2, // 0001
			2, // 0010
			2, // 0011
			2, // 0100
			2, // 0101
			2, // 0110
			2, // 0111
			2, // 1000
			2, // 1001
			2, // 1010
			2, // 1011
			2, // 1100
			2, // 1101
			2, // 1110
			2 // 1111
		}
	},

	{ // 01
		{ // 0
			2, // 0000
			2, // 0001
			2, // 0010
			2, // 0011
			2, // 0100
			1, // 0101
			1, // 0110
			2, // 0111
			1, // 1000
			2, // 1001
			2, // 1010
			2, // 1011
			1, // 1100
			1, // 1101
			1, // 1110
			2 // 1111
		},
		{ // 1
			2, // 0000
			2, // 0001
			2, // 0010
			2, // 0011
			2, // 0100
			1, // 0101
			1, // 0110
			2, // 0111
			1, // 1000
			2, // 1001
			1, // 1010
			2, // 1011
			2, // 1100
			2, // 1101
			2, // 1110
			1 // 1111
		}
	},

	{ // 10
		{ // 0
			2, // 0000
			2, // 0001
			2, // 0010
			1, // 0011
			2, // 0100
			2, // 0101
			1, // 0110
			2, // 0111
			2, // 1000
			2, // 1001
			2, // 1010
			2, // 1011
			1, // 1100
			1, // 1101
			1, // 1110
			2 // 1111
		},
		{ // 1
			2, // 0000
			1, // 0001
			1, // 0010
			1, // 0011
			2, // 0100
			2, // 0101
			2, // 0110
			2, // 0111
			2, // 1000
			2, // 1001
			2, // 1010
			2, // 1011
			1, // 1100
			1, // 1101
			1, // 1110
			2 // 1111
		}
	},

	{ // 11
		{ // 0
			1, // 0000
			1, // 0001
			1, // 0010
			1, // 0011
			1, // 0100
			1, // 0101
			1, // 0110
			1, // 0111
			1, // 1000
			1, // 1001
			1, // 1010
			1, // 1011
			1, // 1100
			1, // 1101
			1, // 1110
			1 // 1111
		},
		{ // 1
			1, // 0000
			1, // 0001
			1, // 0010
			1, // 0011
			1, // 0100
			1, // 0101
			1, // 0110
			1, // 0111
			1, // 1000
			1, // 1001
			1, // 1010
			1, // 1011
			1, // 1100
			1, // 1101
			1, // 1110
			1 // 1111
		}
	}
};

void setup() {
	// "active low"
	// TODO use the same wiring for left and right to the circuitboad but have a jumper to indicate which board is which
	pinMode(bp0, INPUT_PULLUP); // rmod
	pinMode(bp1, INPUT_PULLUP); // rmod
	pinMode(bp2, INPUT_PULLUP); // rmod
	pinMode(bp3, INPUT_PULLUP);
	pinMode(bp4, INPUT_PULLUP); // rswap
	pinMode(bp5, INPUT_PULLUP);
	pinMode(bp6, INPUT_PULLUP);
	pinMode(bp7, INPUT_PULLUP);
	pinMode(bp8, INPUT_PULLUP);
	pinMode(bp9, INPUT_PULLUP);
	pinMode(bp10, INPUT_PULLUP);
	pinMode(bp11, INPUT_PULLUP);
	pinMode(bp12, INPUT_PULLUP);
	pinMode(bp13, INPUT_PULLUP);
	pinMode(bp14, INPUT_PULLUP);
	pinMode(bp15, INPUT_PULLUP); // lswap
	pinMode(bp16, INPUT_PULLUP);
	pinMode(bp17, INPUT_PULLUP); // lmod
	pinMode(bp18, INPUT_PULLUP); // lmod
	pinMode(bp19, INPUT_PULLUP); // lmod
}

void chord_mod(const int &bpx) {
	// limits 1 mod key to be valid at a time (swap does not count as a mod key)
	int i1 = 0;
	int i2 = 0;
	// dominance hierarchy
	if (left == 1) {
		if (LOW == digitalRead(bp17))
			i1 += 3;
		else if (LOW == digitalRead(bp18))
			i1 += 2;
		else if (LOW == digitalRead(bp19))
			i1 += 1;

		if (LOW == digitalRead(bp15))
			i2 += 1;
	}
	else {
		if (LOW == digitalRead(bp2))
			i1 += 3;
		else if (LOW == digitalRead(bp1))
			i1 += 2;
		else if (LOW == digitalRead(bp0))
			i1 += 1;

		// swap reversed with !=
		if (LOW != digitalRead(bp4))
			i2 += 1;
	}

	// MODIFIER_SHIFT is set here because shift is not associated with the leader keys
	// MODIFIER_CTRL, MODIFIER_ALT, and MODIFIER_GUI are set elsewhere
	// fgrep ' set_mod' . -R
	// to find where "keyboard_modifier_keys" comes from
	// TODO better way to get current modifier keys?
	if (shiftmap[i1][i2][bpx] == 1)
		Keyboard.set_modifier(MODIFIERKEY_SHIFT | keyboard_modifier_keys);

	if  (1) {
		// setup a hardcode on the function to avoid the warning! see:
		// ../arduino-1.8.2/hardware/teensy/avr/cores/teensy3/usb_keyboard.h
		Keyboard.set_key1(keymap[i1][i2][bpx]);

		Keyboard.send_now();
		// reset
		Keyboard.set_modifier(0);
		Keyboard.set_key1(0);
		Keyboard.send_now();
	}
}

// calls chord mod
void leader_mod(const int &bpx) {
	int bnb = 2;
	// TODO make it so no need to remap things backward
	if (left == 1) {
		switch (bpx) {
			// bi0 (bpx) does not correspond to button0
			case 0: if (button16.fallingEdge()) bnb = 1; break;
			case 1: if (button6.fallingEdge()) bnb = 1; break;
			case 2: if (button8.fallingEdge()) bnb = 1; break;
			case 3: if (button10.fallingEdge()) bnb = 1; break;
			case 4: if (button14.fallingEdge()) bnb = 1; break;
			case 5: if (button0.fallingEdge()) bnb = 1; break;
			case 6: if (button1.fallingEdge()) bnb = 1; break;
			case 7: if (button2.fallingEdge()) bnb = 1; break;
			case 8: if (button3.fallingEdge()) bnb = 1; break;
			case 9: if (button4.fallingEdge()) bnb = 1; break;
			case 10: if (button5.fallingEdge()) bnb = 1; break;
			case 11: if (button7.fallingEdge()) bnb = 1; break;
			case 12: if (button9.fallingEdge()) bnb = 1; break;
			case 13: if (button11.fallingEdge()) bnb = 1; break;
			case 14: if (button12.fallingEdge()) bnb = 1; break;
			case 15: if (button13.fallingEdge()) bnb = 1; break;
		}
	}
	else {
		switch (bpx) {
			// bi0 (bpx = 0) does not correspond to button0
			case 0: if (button3.fallingEdge()) bnb = 1; break;
			case 1: if (button13.fallingEdge()) bnb = 1; break;
			case 2: if (button11.fallingEdge()) bnb = 1; break;
			case 3: if (button9.fallingEdge()) bnb = 1; break;
			case 4: if (button5.fallingEdge()) bnb = 1; break;
			case 5: if (button19.fallingEdge()) bnb = 1; break;
			case 6: if (button18.fallingEdge()) bnb = 1; break;
			case 7: if (button17.fallingEdge()) bnb = 1; break;
			case 8: if (button16.fallingEdge()) bnb = 1; break;
			case 9: if (button15.fallingEdge()) bnb = 1; break;
			case 10: if (button14.fallingEdge()) bnb = 1; break;
			case 11: if (button12.fallingEdge()) bnb = 1; break;
			case 12: if (button10.fallingEdge()) bnb = 1; break;
			case 13: if (button8.fallingEdge()) bnb = 1; break;
			case 14: if (button7.fallingEdge()) bnb = 1; break;
			case 15: if (button6.fallingEdge()) bnb = 1; break;
		}
	}

	if (bnb == 1) {
		// if testing may want to:
		// Keyboard.set_modifier(MODIFIERKEY_SHIFT);
		int b1 = 2;
		if (
			m1 > 1 &&
			timer < timeout
		) {
			Keyboard.set_modifier(MODIFIERKEY_GUI);
			b1 = 1;
		}
		if (
			m2 > 1 &&
			timer < timeout
		) {
			Keyboard.set_modifier(MODIFIERKEY_CTRL);
			b1 = 1;
		}
		if (
			m3 > 1 &&
			timer < timeout
		) {
			Keyboard.set_modifier(MODIFIERKEY_ALT);
			b1 = 1;
		}
		// placeholder for s1 
		// may not need to correspond with a mod key)

		if (b1 == 2) {
			Keyboard.set_modifier(0);
		}

		if (1) {
			chord_mod(bpx);

			// reset the leader timer
			timer = 0;
			m1 = 0;
			m2 = 0;
			m3 = 0;
		}
	}

	// placeholder
	if (button0.risingEdge()) {
		// can this happen?
		// if (m1 == 1) m1 = 2;
	}

	if (left == 1) {
		// TODO setup references to these buttons so that all logic does not have to be repeated with if else?
		if (button17.fallingEdge()) {
			if (m1 != 2)
				m1 = 1;
			timer = 1;
		}
		if (button17.risingEdge()) {
			if (m1 == 1)
				m1 = 2;
		}
		if (button18.fallingEdge()) {
			if (m2 != 2)
				m2 = 1;
			timer = 1;
		}
		if (button18.risingEdge()) {
			if (m2 == 1)
				m2 = 2;
		}
		if (button19.fallingEdge()) {
			if (m3 != 2)
				m3 = 1;
			timer = 1;
		}
		if (button19.risingEdge()) {
			if (m3 == 1)
				m3 = 2;
		}
		// placehoder for s1
		// really do something with s1?
	}
	else {
		// TODO setup references to these buttons so that all logic does not have to be repeated with if else?
		if (button2.fallingEdge()) {
			if (m1 != 2)
				m1 = 1;
			timer = 1;
		}
		if (button2.risingEdge()) {
			if (m1 == 1)
				m1 = 2;
		}
		if (button1.fallingEdge()) {
			if (m2 != 2)
				m2 = 1;
			timer = 1;
		}
		if (button1.risingEdge()) {
			if (m2 == 1)
				m2 = 2;
		}
		if (button0.fallingEdge()) {
			if (m3 != 2)
				m3 = 1;
			timer = 1;
		}
		if (button0.risingEdge()) {
			if (m3 == 1)
				m3 = 2;
		}
		// placehoder for s1
		// do something with s1?
	}

	if (timer >= timeout) {
		timer = 0;
		m1 = 0;
		// do not Keyboard.print() here!
		// it will never stop printing and will be hard to reprogram
	}
}

void multi_mod(const int &bpx) {
	// calls all modifiers to determine what to output
	// TODO separate function calls?
	leader_mod(bpx); // calls chord_mod(bpx)
}

void loop() {
	button0.update();
	button1.update();
	button2.update();
	button3.update();
	button4.update();
	button5.update();
	button6.update();
	button7.update();
	button8.update();
	button9.update();
	button10.update();
	button11.update();
	button12.update();
	button13.update();
	button14.update();
	button15.update();
	button16.update();
	button17.update();
	button18.update();
	button19.update();
	if (b1 == 2) {
		delay(4444); // seems to help for some reason
		b1 = 1;
	}

	// for debugging mod/swap keys
	// TODO setup debug placeholder for the right side too
	// keep to enable when testing keys on a brand new keyboard make
	if (0) {
		// troublesome key placeholder
		// if (button0.fallingEdge())
		// 	Keyboard.print('o');
		// if (button0.risingEdge())
		// 	Keyboard.print('O');

		// danger: infinite output:
		// if (LOW == digitalRead(bp15))

		// do not read every time only on change
		if (left == 1) {
			if (button15.fallingEdge())
				Keyboard.print('s');
			if (button15.risingEdge())
				Keyboard.print('S');
			if (button17.fallingEdge())
				Keyboard.print('c');
			if (button17.risingEdge())
				Keyboard.print('C');
			if (button18.fallingEdge())
				Keyboard.print('b');
			if (button18.risingEdge())
				Keyboard.print('B');
			if (button19.fallingEdge())
				Keyboard.print('a');
			if (button19.risingEdge())
				Keyboard.print('A');
		}
		else {
			if (button4.fallingEdge())
				Keyboard.print('s');
			if (button4.risingEdge())
				Keyboard.print('S');
			if (button2.fallingEdge())
				Keyboard.print('c');
			if (button2.risingEdge())
				Keyboard.print('C');
			if (button1.fallingEdge())
				Keyboard.print('b');
			if (button1.risingEdge())
				Keyboard.print('B');
			if (button0.fallingEdge())
				Keyboard.print('a');
			if (button0.risingEdge())
				Keyboard.print('A');
		}
	}

	if (left == 1) {
		if (button0.fallingEdge()) { multi_mod(bi0); }
		if (button1.fallingEdge()) { multi_mod(bi1); }
		if (button2.fallingEdge()) { multi_mod(bi2); }
		if (button3.fallingEdge()) { multi_mod(bi3); }
		if (button4.fallingEdge()) { multi_mod(bi4); }
		if (button5.fallingEdge()) { multi_mod(bi5); }
		if (button6.fallingEdge()) { multi_mod(bi6); }
		if (button7.fallingEdge()) { multi_mod(bi7); }
		if (button8.fallingEdge()) { multi_mod(bi8); }
		if (button9.fallingEdge()) { multi_mod(bi9); }
		if (button10.fallingEdge()) { multi_mod(bi10); }
		if (button11.fallingEdge()) { multi_mod(bi11); }
		if (button12.fallingEdge()) { multi_mod(bi12); }
		if (button13.fallingEdge()) { multi_mod(bi13); }
		if (button14.fallingEdge()) { multi_mod(bi14); }
		// m1 m2 m3
		if (button16.fallingEdge()) { multi_mod(bi16); }
		// s1
	}
	else {
		// m1 m2 m3
		if (button3.fallingEdge()) { multi_mod(bi3); }
		// s1
		if (button5.fallingEdge()) { multi_mod(bi5); }
		if (button6.fallingEdge()) { multi_mod(bi6); }
		if (button7.fallingEdge()) { multi_mod(bi7); }
		if (button8.fallingEdge()) { multi_mod(bi8); }
		if (button9.fallingEdge()) { multi_mod(bi9); }
		if (button10.fallingEdge()) { multi_mod(bi10); }
		if (button11.fallingEdge()) { multi_mod(bi11); }
		if (button12.fallingEdge()) { multi_mod(bi12); }
		if (button13.fallingEdge()) { multi_mod(bi13); }
		if (button14.fallingEdge()) { multi_mod(bi14); }
		if (button15.fallingEdge()) { multi_mod(bi15); }
		if (button16.fallingEdge()) { multi_mod(bi16); }
		if (button17.fallingEdge()) { multi_mod(bi17); }
		if (button18.fallingEdge()) { multi_mod(bi18); }
		if (button19.fallingEdge()) { multi_mod(bi19); }
	}

	// placeholder if action needed on rising edge

	// TODO just update leader values
	// TODO do not send bi0 (maybe send something that will never be pressed?)
	if (left == 1) {
		if (button15.fallingEdge()) { multi_mod(bi0); }
		if (button15.risingEdge()) { multi_mod(bi0); }

		if (button17.fallingEdge()) { multi_mod(bi0); }
		if (button17.risingEdge()) { multi_mod(bi0); }

		if (button18.fallingEdge()) { multi_mod(bi0); }
		if (button18.risingEdge()) { multi_mod(bi0); }

		if (button19.fallingEdge()) { multi_mod(bi0); }
		if (button19.risingEdge()) { multi_mod(bi0); }
	}
	else {
		if (button4.fallingEdge()) { multi_mod(bi0); }
		if (button4.risingEdge()) { multi_mod(bi0); }

		if (button2.fallingEdge()) { multi_mod(bi0); }
		if (button2.risingEdge()) { multi_mod(bi0); }

		if (button1.fallingEdge()) { multi_mod(bi0); }
		if (button1.risingEdge()) { multi_mod(bi0); }

		if (button0.fallingEdge()) { multi_mod(bi0); }
		if (button0.risingEdge()) { multi_mod(bi0); }
	}
}
