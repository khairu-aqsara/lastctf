## solve
https://www.geeksforgeeks.org/quine-in-python/
https://towardsdatascience.com/how-to-write-your-first-quine-program-947f2b7e4a6f
https://www.cs.cornell.edu/~kt/post/quine/

### soal
sebuah service rasa buah Quine untuk kita semua :)

```
nc 103.147.32.234 9001
```

<a href="https://mega.nz/file/vipEQI4Z#8ss1daIi4RSIU7sHT9satwrN_n0MIY4T6bv9GZlcMOY" target="_blank">Source Code</a>

source code
```python
import subprocess
import hashlib

if __name__ == "__main__":
    print("Quine Executor")
    code = input("masukan 1 baris kode untuk dijalankan oleh exec(): ")
    print()
    if not code:
        print("Kodenya masih kosong!")
        exit(-1)
    p = subprocess.run(
        ["su", "nobody", "-s", "/bin/sh", "-c", "python run.py"], #exec(input())
        input=code.encode(),
        stdout=subprocess.PIPE,
    )

    if p.returncode != 0:
        print()
        print("Ane ga bisa jalanin itu bang...")
        exit(-1)

    output = p.stdout.decode()

    print("Kode yang anda masukan:")
    print(repr(code))
    print("\n")
    print("hasilnya:")
    print(repr(output))
    print("\n")
    
    print("Memeriksa sha256(code) == output")
    if hashlib.sha256(code.encode()).hexdigest() == output:
        print(open("/root/flag").read())
    else:
        print("Masih gagal bang!")
    
    exit(-1)
```

### build
```
docker build -t lastctfchal .
docker run -d -p 9001:9001 --name quinechal lastctfchal
```

versi 1
```python
code='''(lambda s:print(__import__('hashlib').sha256(('code='+"'"*3+s+"'"*3+';'+s).encode()).hexdigest(),end=''))(code)''';(lambda s:print(__import__('hashlib').sha256(('code='+"'"*3+s+"'"*3+';'+s).encode()).hexdigest(),end=''))(code)
```

versi 2
```python
import hashlib;s='import hashlib;s=%r;print(hashlib.sha256((s%%s).encode()).hexdigest(),end="")';print(hashlib.sha256((s%s).encode()).hexdigest(),end="")
```


