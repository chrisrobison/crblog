#!/bin/bash

for img in "$@"
do
    basename=`basename -s .png $img`
    echo "$basename"
    pngtopnm $img > "${basename}.pnm"
    pnmscale -width=400 "${basename}.pnm" | pnmtojpeg > "${basename}.jpg"
    pnmscale -width=400 "${basename}.pnm" | pnmtopng > "${basename}_small.png"
done

# pngtopnm 
