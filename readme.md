About
-----
Intended to be a universal keyboard (across all languages) by modeling the symmetry of the human hands.

A 20 key one-handed keyboard (16 finger keys 3 thumb keys and 1 swap key).

Allows typing of all printable ASCII characters (with room to spare) and has 84 less keys than a standard 104-key Windows keyboard (about 80% less keys).

Pairing 2 "1 Handed" keyboards facilitates 2 handed typing for faster operation. 2 handed typing utilizes 32 finger keys 6 thumb keys and does not require a swap key.

![Paired One-Handed Symmetric Keyboards with Hexagonal Keys](/vhex/export/hexboard.png)

Custom Keymaps
--------------
Create your own design from:
* keymap/template.php

Any html can be used for the individual keys including 24px by 24px images.

Finger Placement
----------------
* pinky = .
* ring = ..
* middle = ...
* pointer = __
* thumb = ..O

Design
------
Intended to be used with "insert mode" and "command mode" like "vi editor"

Additional locking modes are intended to be removed in favor of a constant thumb press including:
* caps lock
* num lock
* scroll lock

Some keys are intended to be replaced by "command mode" (not yet implemented) including:
* control
* shift
* alt
* meta

"Spacebar" was changed to a normal key to increase key combination mobility.

Sales Pitch
-----------
How often do you make a handprint on something and think that it looks like your keyboard?

Requirements
------------
* php
* apache

Install
-------
cp config.sample.php config.php
