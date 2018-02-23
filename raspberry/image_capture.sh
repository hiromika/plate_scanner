#!/bin/bash

tanggal=`date '+%d%m%Y_%H%M%S'`

fswebcam -S 17 -r 800x600 --no-banner /home/pi/script/capture/$tanggal.jpg

printf "%s" "$tanggal"

