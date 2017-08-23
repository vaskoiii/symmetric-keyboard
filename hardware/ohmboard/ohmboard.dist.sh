#!/bin/bash
# author: vaskoiii
# description: use command line to build for teensyduino instead of arduino ide

# config
ohmboard_path=/path/to/ohmboard
teensyduino_path=/path/to/teensyduino

$teensyduino_path/arduino-builder -build-path $ohmboard_path/build -hardware $teensyduino_path/hardware -tools $teensyduino_path/hardware/tools/avr -tools $teensyduino_path/tools-builder -libraries $teensyduino_path/libraries -fqbn teensy:avr:teensy31 $ohmboard_path/ohmboard.ino

# requires adding the following lines at the top of the teensy31 section in $teensyduino_path/hardware/teensy/avr/boards.txt
# teensy31.build.fcpu=48000000
# teensy31.build.flags.optimize=-O2
# teensy31.build.flags.ldspecs=
# teensy31.build.keylayout=US_ENGLISH
# teensy31.build.usbtype=USB_SERIAL
# teensy31.build.usbtype=USB_KEYBOARDONLY
