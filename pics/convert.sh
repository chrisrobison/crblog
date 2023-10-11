#!/bin/bash

for img in "$@"
do
    convert "$img" -resize 1024x1024 "$img" 

done
