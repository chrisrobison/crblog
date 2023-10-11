#!/bin/bash

jpegtopnm "$1" | pnmscale -xsize 1024 | ppmtojpeg > "$1.new.jpg"

