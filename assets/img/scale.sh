#!/bin/bash

jpegtopnm "$1" | pnmscale -xsize 1000 | ppmtojpeg > "$1.new.jpg"

