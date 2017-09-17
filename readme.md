Touchscreen and hardware code for the ohmboard (One Handed Mirror Board): a universal symmetric-keyboard (across all languages) by modeling the symmetry of the human hands.

Using one hand and a mirror key that acts as an accessibility button (ie. foot pedal), one can type all printable ASCII characters. This 20 key implementation has 84 less keys than a standard 104-key Windows keyboard (about 80% less keys).

Pairing 2 ohmboards facilitates 2-handed typing for faster operation and does not require use of the mirror key. If pairing 2 hardware ohmboards, the mirror keys can still be implemented as foot pedals for more flexible typing.

Ohmboard Demo
-------------
See: (http://keyboard.vaskos.com)

![Paired One-Handed Symmetric Keyboards with Hexagonal Keys](/vhex/export/hexboard.png)

### Finger Placement
* pinky = .
* ring = ..
* middle = ...
* pointer = __
* thumb = (bottom 3 keys)

Touchscreen Version
-------------------
Ideally this implentation would be 100% js but it also requires: 
* php
* apache

### Install
cp config.sample.php config.php

### Custom Keymaps
Create your own keymap design from:
* keymap/template.php

Any html can be used for the individual keys including 24px by 24px images.

Hardware Version
----------------
To be practical on existing operating systems the hardware version implements additional functionality with:
* control / shift / alt / gui
* arrow keys / pgup / pgdn

See: ./hardware/ohmboard/
