from PIL import Image

gbr = Image.open('download.png')
pixel = gbr.load()
lebar,tinggi = gbr.size
flag = "lastctf{h0w_c4n_you_r34d_m3}"
pos=0
for x in range(lebar):
    pos2=0
    for y in range(tinggi):
        if pos >= 0 and pos <= 27 and pos2 > 27 and pos2 <=(27 + 28):
            newl = list(pixel[x,y])
            newl[3] = ord(flag[pos])
            gbr.putpixel((x,y), tuple(newl))
        pos2+=1
    pos+=1
gbr.save("download2.png")
"""

gbr2 = Image.open('download2.png')
pixel = gbr2.load()
lebar,tinggi = gbr2.size
for x in range(lebar):
    for y in range(tinggi):
        if pixel[x,y][3] != 100:
            print(pixel[x,y])
"""