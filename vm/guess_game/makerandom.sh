#!/bin/bash

LEN=$(cat /dev/urandom|tr -dc '4-9' | head -c 1)
SECRET=$(cat /dev/urandom|tr -dc 'a-z'|head -c $LEN)
echo -n $SECRET
