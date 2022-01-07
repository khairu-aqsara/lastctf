## Not Found

### Deskripsi
Kak kok website ku Not Found ya kak, sepertinya ada hal yang tidak biasa, bantuin cek dong kak.

[http://103.147.32.214:9005/](http://103.147.32.214:9005/)

### Solusi

```
curl -v http://103.147.32.214:9005 | head
```

hasilnya halaman notfound tetapi dengan status code `200` yang artinya seharusnya tidak Not Found, setelah melihat-lihat source codenya ternyata ada bagian yang tidak biasa

```html
<link rel="alternate" type="application/hash" title="Not Found Page" href="#" content="2db95e8e1a9267b7a1188556b2013b33"/>
```

setelah mencoba hasnya [2db95e8e1a9267b7a1188556b2013b33](https://md5hashing.net/hash/md5/2db95e8e1a9267b7a1188556b2013b33) ternyata hasilnya adalah hash `md5` dari huruf `l`. mencoba beberapa kali ternyata semuanya adalah hash dari huruf yang menyusun flag nya

```bash
2db95e8e1a9267b7a1188556b2013b33 = l
0cc175b9c0f1b6a831c399e269772661 = a
...
...
...
...
dst
```

hasil akhirnya

```
lastctf{m4t4_4nd4_sun99uh_j3l1}
```