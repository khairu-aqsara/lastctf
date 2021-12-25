import os, string

s = []
for x in os.listdir('.'):
    if x.endswith('img'):
        s.append(x)

s = sorted(s)

print(s)
f = []
for x in s:
    f.append(open(x, 'rb').read())

chars = string.printable.encode()

for _addr in range(0x69, 0x70):
    addr = _addr * 0x10000
    o = []
    for i in range(5):
        t = f[i][addr:addr + 10]
        if any(x not in chars for x in t):
            o.append(i)
    print(hex(_addr), o)

for _addr in range(0x69, 0x6b):
    addr = _addr * 0x10000
    print('=' * 10, hex(addr))
    for i in range(5):
        print(i, f[i][addr:addr + 20], f[i][addr + 0x10000 - 20:addr + 0x10000])