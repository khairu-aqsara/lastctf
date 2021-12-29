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