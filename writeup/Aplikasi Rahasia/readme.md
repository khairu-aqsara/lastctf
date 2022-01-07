## Aplikasi Rahasia

### Deskripsi

Temenku bikin Aplikasi Rahasia, katanya keren sih [Download Aplikasinya](https://mega.nz/file/D7BnFIjZ#aEVlebpiO4c74ZnUWhUL1LOK3OEsd7nB8-J4rB-Z5Qs)

### Solusi

```
Arch:     amd64-64-little
RELRO:    Full RELRO
Stack:    Canary found
NX:       NX enabled
PIE:      PIE enabled
```

setelah dicoba aplikasi hanya menerima inputan kata kunci dan mengembalikan pesan kesalahan jika password tidak benar.

```bash
$ ./aplikasi_rahasia
Masukan Kata Kunci Anda: AAAA
Kata kunci yang anda masukan : [AAAA]
Kata Kunci tidak valid!
```

dicoba di-decompiler pada fungsi `cGVyaWtzYV9rYXRhX2t1bmNp` dan hasilnya

```c
uint64_t cGVyaWtzYV9rYXRhX2t1bmNp(char *arg1)
{
    bool bVar1;
    uint64_t uVar2;
    char *var_18h;
    uint64_t var_4h;
    
    bVar1 = false;
    if (((((*arg1 == 'r') && (arg1[1] == '3')) && (arg1[2] == 'v')) &&
        (((arg1[3] == '3' && (arg1[4] == 'r')) && ((arg1[5] == '5' && ((arg1[6] == '1' && (arg1[7] == 'n')))))))) &&
       (((((arg1[8] == '9' &&
           ((((arg1[9] == '_' && (arg1[10] == '3')) && (arg1[0xb] == 'l')) && ((arg1[0xc] == 'f' && (arg1[0xd] == '_')))
            ))) && ((arg1[0xe] == 'f' && ((arg1[0xf] == '1' && (arg1[0x10] == 'l')))))) && (arg1[0x11] == '3')) &&
        (arg1[0x12] == '_')))) {
        bVar1 = true;
    }
    if (bVar1) {
        uVar2 = (uint64_t)(uint8_t)arg1[0x13];
        if (((((((arg1[0x13] == 0x31) && (uVar2 = (uint64_t)(uint8_t)arg1[0x14], arg1[0x14] == 0x35)) &&
               (uVar2 = (uint64_t)(uint8_t)arg1[0x15], arg1[0x15] == 0x5f)) &&
              ((uVar2 = (uint64_t)(uint8_t)arg1[0x16], arg1[0x16] == 0x74 &&
               (uVar2 = (uint64_t)(uint8_t)arg1[0x17], arg1[0x17] == 0x30)))) &&
             (((uVar2 = (uint64_t)(uint8_t)arg1[0x18], arg1[0x18] == 0x5f &&
               ((uVar2 = (uint64_t)(uint8_t)arg1[0x19], arg1[0x19] == 0x74 &&
                (uVar2 = (uint64_t)(uint8_t)arg1[0x1a], arg1[0x1a] == 0x33)))) &&
              (uVar2 = (uint64_t)(uint8_t)arg1[0x1b], arg1[0x1b] == 0x35)))) &&
            (((uVar2 = (uint64_t)(uint8_t)arg1[0x1c], arg1[0x1c] == 0x74 &&
              (uVar2 = (uint64_t)(uint8_t)arg1[0x1d], arg1[0x1d] == 0x5f)) &&
             (uVar2 = (uint64_t)(uint8_t)arg1[0x1e], arg1[0x1e] == 0x79)))) &&
           ((((uVar2 = (uint64_t)(uint8_t)arg1[0x1f], arg1[0x1f] == 0x30 &&
              (uVar2 = (uint64_t)(uint8_t)arg1[0x20], arg1[0x20] == 0x75)) &&
             ((uVar2 = (uint64_t)(uint8_t)arg1[0x21], arg1[0x21] == 0x72 &&
              ((uVar2 = (uint64_t)(uint8_t)arg1[0x22], arg1[0x22] == 0x5f &&
               (uVar2 = (uint64_t)(uint8_t)arg1[0x23], arg1[0x23] == 0x6b)))))) &&
            ((uVar2 = (uint64_t)(uint8_t)arg1[0x24], arg1[0x24] == 0x6e &&
             (((((uVar2 = (uint64_t)(uint8_t)arg1[0x25], arg1[0x25] == 0x30 &&
                 (uVar2 = (uint64_t)(uint8_t)arg1[0x26], arg1[0x26] == 0x77)) &&
                (uVar2 = (uint64_t)(uint8_t)arg1[0x27], arg1[0x27] == 0x6c)) &&
               ((uVar2 = (uint64_t)(uint8_t)arg1[0x28], arg1[0x28] == 0x34 &&
                (uVar2 = (uint64_t)(uint8_t)arg1[0x29], arg1[0x29] == 100)))) &&
              ((uVar2 = (uint64_t)(uint8_t)arg1[0x2a], arg1[0x2a] == 0x39 &&
               (uVar2 = (uint64_t)(uint8_t)arg1[0x2b], arg1[0x2b] == 0x33)))))))))) {
            uVar2 = 0;
        }
    } else {
        uVar2 = 0xffffffff;
    }
    return uVar2;
}
```

jika diperhatikan, terjadi kompari string yang cukup panjang, dari potongan kode

```c
    if (((((*arg1 == 'r') && (arg1[1] == '3')) && (arg1[2] == 'v')) &&
        (((arg1[3] == '3' && (arg1[4] == 'r')) && ((arg1[5] == '5' && ((arg1[6] == '1' && (arg1[7] == 'n')))))))) &&
       (((((arg1[8] == '9' &&
           ((((arg1[9] == '_' && (arg1[10] == '3')) && (arg1[0xb] == 'l')) && ((arg1[0xc] == 'f' && (arg1[0xd] == '_')))
            ))) && ((arg1[0xe] == 'f' && ((arg1[0xf] == '1' && (arg1[0x10] == 'l')))))) && (arg1[0x11] == '3')) &&
        (arg1[0x12] == '_')))) {
        bVar1 = true;
    }
```

sudah bisa ditebak jika flagnya sebagian adalah `r3v3r51n9_3lf_f1l3_` bagian berikutnya ada pada `if (bVar1) {...}`, jika diperhatikan dengan seksama bagian `arg1[0x13] == 0x31` sama dengan `arg1[x] = 1` karena `0x31` adalah kode hex untuk ascii `1`, jika dilanjutkan 

```bash
0x31 = 1
0x35 = 5
0x5f = _
0x74 = t
...
...
0x39 = 9
0x33 = 3
```

sehingga flagnya adalah `r3v3r51n9_3lf_f1l3_15_t0_t35t_y0ur_kn0wl4d93`