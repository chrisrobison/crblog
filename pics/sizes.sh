#!/bin/bash

for img in "$@"
do
    SZ=`identify -format "%wx%h" $img`
    echo "$img [$SZ]"

done
