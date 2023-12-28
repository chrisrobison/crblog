#!/bin/bash

jpegtopnm "$1" | pnmscale -xsize 600 | ppmtojpeg > "$1.new.jpg"

