#!/bin/bash
for j in {4..9}; do
    for k in {1..3}; do
        GUESS=$(for i in `seq 1 $j`; do echo -n "$j"; done)
        ./attack $GUESS
    done
done