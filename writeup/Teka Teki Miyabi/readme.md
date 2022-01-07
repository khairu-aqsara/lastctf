## Teka Teki Miyabi

### Deskripsi

kak aku punya teka-teki nih. Letaknya paling kanan dan mempunyai nilai paling kecil, apakah aku ? [Download](https://mega.nz/file/L74UhBpA#F_3yHqcPqGLLCH6ztPDeap1rIBOpaz_rFvvadJrY9qU)

### Solusi

dari Deskripsi sudah jelas ini berkaitan dengan LSB (Least Significat Bit) , sebenarnya ini lebih cocok masuk dalam Steganography dari pada masuk dalam Kategori Miscellaneous, tapi biarlah.

Least significant bit adalah bagian dari barisan data biner (basis dua) yang mempunyai nilai paling tidak berarti/paling kecil. Letaknya adalah paling kanan dari barisan bit. Sedangkan most significant bit adalah sebaliknya, yaitu angka yang paling berarti/paling besar dan letaknya disebelah paling kiri.

setiap huruf direpresentasikan menggunakan 8bit atau 1 byte, pada gambar setiap pixel memiliki 3 chanel masing-masing untuk RGB frames. perhitungan LSB biasanya dalam bentuk bilangan biner, jika ada bilangan biner 010101110001 Bit LSB adalah bit yang terletak paling kanan yaitu 1

secara teori jika ingin menyisipkan pesan kedalam gambar dengan metode LSB diharuskan mencari LSB dari masing-masing chanel dalam gambar, misalnya sebuah gambar dengan chanel `RGB(#640000, #009000, #0000F1)` jika di representasikan dalam bilangan biner

```bash
0x640000 = 01100100 = 8bit
0x009000 = 10010000 = 8bit
0x0000F1 = 11110001 = 8bit
```

dan pesan yang akan dimasukan adalah karakter `l` atau dalam binary `01101100` maka saat LSB diterapkan akan menjadi

```bash
NO LSB     LSB
-------------------
01100100 = 01100100
10010000 = 10010001
11110001 = 11110001
R.....   = .......0
G.....   = .......1
B.....   = .......1
R.....   = .......0
G.....   = .......0
```

jika diperhatikan `01100100` bernilai sama sebelum dan sesudah  diterapkan, ini karena 1bit pertama pada data yang akan disimpan sama dengan nilai LSB yaitu `0`

berdasarkan informasi tersebut bisa dibuatkan tools untuk mengembalikan pesan yang tersimpan 


```python
img = cv2.imread("image_miyabi.png")
data = []
stop = False
for index_i, i in enumerate(img):
    i.tolist()
    for index_j, j in enumerate(i):
      if((index_j) % 3 == 2):
        # RED pixel
        data.append(bin(j[0])[-1])
        # GREEN pixel
        data.append(bin(j[1])[-1])

        if(bin(j[2])[-1] == '1'):
          stop = True
          break
      else:
        # RED pixel
        data.append(bin(j[0])[-1])
        # GREEN pixel
        data.append(bin(j[1])[-1])
        # BLUE pixel
        data.append(bin(j[2])[-1])
    if(stop):
        break
print(data) 

```

hasilnya adalah

```bash
['0', '1', '1', '0', '1', '1', '0', '0', '0', '1', '1', '0', '0', '0', '0', '1', '0', '1', '1', '1', '0', '0', '1', '1', '0', '1', '1', '1', '0', '1', '0', '0', '0', '1', '1', '0', '0', '0', '1', '1', '0', '1', '1', '1', '0', '1', '0', '0', '0', '1', '1', '0', '0', '1', '1', '0', '0', '1', '1', '1', '1', '0', '1', '1', '0', '0', '1', '1', '0', '0', '0', '1', '0', '1', '1', '0', '1', '1', '1', '0', '0', '0', '1', '1', '0', '0', '0', '1', '0', '1', '0', '1', '1', '1', '1', '1', '0', '1', '1', '0', '1', '1', '1', '0', '0', '0', '1', '1', '0', '1', '0', '0', '0', '1', '1', '0', '1', '1', '0', '1', '0', '0', '1', '1', '0', '1', '0', '0', '0', '1', '1', '0', '1', '1', '1', '0', '0', '1', '1', '1', '1', '0', '0', '1', '0', '0', '1', '1', '0', '1', '0', '0', '0', '1', '0', '1', '1', '1', '1', '1', '0', '1', '1', '0', '1', '1', '0', '0', '0', '0', '1', '1', '0', '0', '1', '1', '0', '0', '1', '1', '0', '1', '0', '0', '0', '0', '1', '1', '0', '1', '0', '1', '0', '1', '1', '1', '0', '1', '0', '0', '0', '1', '0', '1', '1', '1', '1', '1', '0', '0', '1', '1', '0', '1', '0', '1', '0', '0', '1', '1', '0', '0', '0', '1', '0', '0', '1', '1', '1', '0', '0', '1', '0', '1', '1', '0', '1', '1', '1', '0', '0', '0', '1', '1', '0', '0', '0', '1', '0', '1', '1', '0', '0', '1', '1', '0', '0', '0', '1', '1', '0', '0', '0', '1', '0', '1', '1', '0', '0', '0', '1', '1', '0', '0', '1', '1', '0', '1', '0', '0', '0', '1', '1', '0', '1', '1', '1', '0', '0', '1', '1', '1', '0', '1', '0', '0', '0', '1', '0', '1', '1', '1', '1', '1', '0', '1', '1', '0', '0', '0', '1', '0', '0', '0', '1', '1', '0', '0', '0', '1', '0', '1', '1', '1', '0', '1', '0', '0', '0', '1', '1', '1', '1', '1', '0', '1']
```

selanjutnya data hasil extract tersebut harus di group per 8bit 

```python
message = []
for i in range(int((len(data)+1)/8)):
    message.append(data[i*8:(i*8+8)])

message =[''.join(i) for i in message]
print(message)
```

hasilnya

```python
['01101100', '01100001', '01110011', '01110100', '01100011', '01110100', '01100110', '01111011', '00110001', '01101110', '00110001', '01011111', '01101110', '00110100', '01101101', '00110100', '01101110', '01111001', '00110100', '01011111', '01101100', '00110011', '00110100', '00110101', '01110100', '01011111', '00110101', '00110001', '00111001', '01101110', '00110001', '01100110', '00110001', '01100011', '00110100', '01101110', '01110100', '01011111', '01100010', '00110001', '01110100', '01111101']
```

dengan demikian tinggal merubah bilangan biner tersebut menjadi huruf yang bisa dibaca

```bash
message = [chr(int(''.join(i), 2)) for i in message]
message = ''.join(message)
print(message)
lastctf{1n1_n4m4ny4_l345t_519n1f1c4nt_b1t}
```