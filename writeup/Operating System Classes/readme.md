## Operating System Classes

### Deskripsi

Kakak tolong dong balikin hardisk ku yang rusak [Download](https://mega.nz/file/u3QXjIqS#cqXFfumXsS3izEEcRCNJqUnWQDVsMeDe5u9QpztAJtI)


### Solusi

kita cek filenya

```
disk-1.img: data
disk-2.img: DOS/MBR boot sector; partition 1 : ID=0xee, start-CHS (0x0,0,2), end-CHS (0x3ff,255,63), startsector 1, 262143 sectors, extended partition table (last)
disk-3.img: data
disk-4.img: data
disk-5.img: DOS/MBR boot sector; partition 1 : ID=0xee, start-CHS (0x0,0,2), end-CHS (0x3ff,255,63), startsector 1, 262143 sectors, extended partition table (last)
```

coba cek isinya, siapa tau tanpa harus pake teknik forensic bisa dapat, (asumsi selama flag tidak di encode/compress), dan kita tau jika format flagnya pasti ada kata `lastctf` di masing-masing disk

```
hexdump -C disk-4.img | grep "lastctf"
00250c00  6c 61 73 74 63 74 66 7b  72 34 31 64 5f 6c 33 76  |lastctf{r41d_l3v|
```

ketemu di `disk-4.img`, tapi ga lengkap, tinggal baca dari offset `0x00250c00`

```
hexdump -C -n 64 -s 0x0250c00 disk-4.img
00250c00  6c 61 73 74 63 74 66 7b  72 34 31 64 5f 6c 33 76  |lastctf{r41d_l3v|
00250c10  33 6c 5f 6c 31 6d 34 5f  35 74 35 74 33 6d 5f 63  |3l_l1m4_5t5t3m_c|
00250c20  6c 34 35 35 7d 00 00 00  00 00 00 00 00 00 00 00  |l455}...........|
00250c30  00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00  |................|
00250c40
```
