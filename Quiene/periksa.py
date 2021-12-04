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
        ["su", "nobody", "-s", "/bin/sh", "-c", "python run.py"],
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