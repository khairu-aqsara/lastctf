#!/bin/bash

PANJANG=5
PREFIX=$1
LEN=${#PREFIX}
let UNKNOW=$PANJANG-$LEN-1

for ch in {a..z}; do
	for j in {1..3}; do
		POSTFIX=$(for i in `seq 1 $UNKNOW`; do echo -n '#'; done)
		GUESS=$(echo -n "$PREFIX$ch$POSTFIX")
		./timingattack $GUESS
	done
done
