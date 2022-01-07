## Unshiftable

## Deksripsi

Kak temenku bikin tools untuk enkripsi, katanya bagus kak buat kirim-kirim pesan,[Download](https://mega.nz/file/qrBgyLLB#3I6eYXxMTmi_XSMgcTf7UnyLQXi72LIpbDsIBpwMmqg)

```
HwB0YUUZZW0OG2t1TgBuaUEDYW0YD3lhSRZpdEgaaGkPGmluA0VkZQ8JYW5PCm9yTlRidFdFIGlODyBmCw9nbkNBOiAfFXN0BQ9meztJX3lvHl9rGW93XyhQX2NcEWxkNwRoMVcaMW5MMXVuBA4xZhZYYmwzfQAA
```

### Solusi

String yang diberkan mirip dengan base64, tapi suda pasti bukan, decompile file miyabi_crypter.pc untuk melihat source code enkripsi

```python
uncompyle6 miyabi_crypter.pyc
# uncompyle6 version 3.8.0
# Python bytecode 2.7 (62211)
# Decompiled from: Python 2.7.18 (default, Mar  8 2021, 13:02:45)
# [GCC 9.3.0]
# Warning: this version of Python has problems handling the Python 3 byte type in constants properly.

# Embedded file name: xor.py
# Compiled at: 2021-12-29 15:45:43
import struct, sys, base64
if len(sys.argv) != 2:
    print 'Usage: %s data' % sys.argv[0]
    exit(0)
data = sys.argv[1]
padding = 4 - len(data) % 4
if padding != 0:
    data = data + '\x00' * padding
result = []
blocks = struct.unpack('I' * (len(data) / 4), data)
for block in blocks:
    result += [block ^ block >> 16]

output = ''
for block in result:
    d = struct.pack('I', block)
    output += d

d = base64.b64encode(output)
print d
# okay decompiling miyabi_crypter.pyc
```

setelah melihat source dan logika enkripsi, seharusnya tidak susah untuk membuat decripsinya

```python
import struct
import sys
import base64

old_data = base64.b64decode("HwB0YUUZZW0OG2t1TgBuaUEDYW0YD3lhSRZpdEgaaGkPGmluA0VkZQ8JYW5PCm9yTlRidFdFIGlODyBmCw9nbkNBOiAfFXN0BQ9meztJX3lvHl9rGW93XyhQX2NcEWxkNwRoMVcaMW5MMXVuBA4xZhZYYmwzfQAA")

chunks, chunk_size = len(old_data), 4
packs = [ old_data[i:i+chunk_size] for i in range(0, chunks, chunk_size) ]

result = []
for pack in packs:
    result += struct.unpack("I",pack)
print(result)

mres = []
for res in result:
    mres += [res ^ res >> 16]

out = ''
I = len(mres)
for m in mres:
    out += struct.pack("I",m)
print(out)
```

dan hasilnya adalah

```bash
$ python solve.py
[1634992159, 1835342149, 1969953550, 1768816718, 1835074369, 1635323672, 1953044041, 1768430152, 1852381711, 1701070083, 1851853071, 1919879759, 1952601166, 1763722583, 1713377102, 1852247819, 540688707, 1953699103, 2070286085, 2036287803, 1801395823, 1601662745, 1667190824, 1684803932, 828900407, 1848711767, 1853174092, 1714490884, 1818384406, 32051]
kata temenku ini namanya bit shifting dengan xor, btw, ini flagnya: lastctf{d0_y0u_kn0w_w3_c0uld_5h1ft1n9_un5h1ft4bl3}
```
