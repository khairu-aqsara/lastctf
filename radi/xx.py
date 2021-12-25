import os, string

s = []
for x in os.listdir('.'):
    if x.endswith('img'):
        s.append(x)

s = sorted(s)

f = []
for x in s:
    f.append(open(x, 'rb').read())

perm = [2, 4, 0, 3, 1][::-1]

cnt  =  0 
o  = []
for  i  in  range ( 0 , len ( f [ 0 ]), 0x10000 ):
     for  j  in  range ( 4 ):
         o . append ( f [ perm [( j  -  cnt ) %  5 ]] [ i : i  +  0x10000 ])
     cnt  +=  1 
open ( 'out3.bin', 'wb').write(b''.join(o))