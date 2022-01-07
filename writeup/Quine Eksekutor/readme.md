## Quine Eksekutor

### Deskripsi

sebuah service rasa buah Quine untuk kita semua :), silahkan konek menggunakan `nc 103.147.32.214` dengan port `9001` [Source Code](https://mega.nz/file/vipEQI4Z#8ss1daIi4RSIU7sHT9satwrN_n0MIY4T6bv9GZlcMOY)

### Solusi

Quine adalah program yang mencetak salinannya sendiri sebagai satu-satunya output. Sebuah quine tidak membutuhkan masukan, dari source code terlihat jika inputan akan di eksekusi oleh file `run.py` dengan perintah `exec(input())` point-nya diminta untuk memasukan script python yang bisa digunakan untuk mendapatkan flag tetapi tidak bisa menggunakan `print(open(__file__).read())` 

menginputkan `import os; os.system('cat /root/flag')` secara langsung juga tidak bisa karena aplikasi dijalankan dibawah low privileges. dan adalagi pemeriksaan yang mengharuskan hash signature dari inputan sama dengan keluaran 

```python
if hashlib.sha256(code.encode()).hexdigest() == output:
```

jika di-urut kan inputan = repr(code) = repr(output), jadi harus memasukan sebuah scrypt python untuk mencetak hasil sha256 yang sama dengan yang di-inputkan tanpa ada newline

```python
import hashlib;s='import hashlib;s=%r;print(hashlib.sha256((s%%s).encode()).hexdigest(),end="")';print(hashlib.sha256((s%s).encode()).hexdigest(),end="")
```

hasilnya

```bash
$ nc 103.147.32.214 9001
Quine Executor
masukan 1 baris kode untuk dijalankan oleh exec(): import hashlib;s='import hashlib;s=%r;print(hashlib.sha256((s%%s).encode()).hexdigest(),end="")';print(hashlib.sha256((s%s).encode()).hexdigest(),end="")
import hashlib;s='import hashlib;s=%r;print(hashlib.sha256((s%%s).encode()).hexdigest(),end="")';print(hashlib.sha256((s%s).encode()).hexdigest(),end="")

Kode yang anda masukan:
'import hashlib;s=\'import hashlib;s=%r;print(hashlib.sha256((s%%s).encode()).hexdigest(),end="")\';print(hashlib.sha256((s%s).encode()).hexdigest(),end="")'


hasilnya:
'c4a3cb81aafa3577c00d70ba24a0cd8301554c659f18c4e5ca29e5d56df002d7'


Memeriksa sha256(code) == output
lastctf{0utput_y0ur_0wn_pr09r4m_w1th_pyth0n}
```

Ref: https://www.cs.cornell.edu/~kt/post/quine/

