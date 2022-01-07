## Bongkar Dan Balikan

### Deskripsi

kak kata temenku flagnya ada didalam file ini, tapi aku ga tau ini file mau diapain, katanya sih harus di riper enjinering gitu kak, bantuin ya kak. [Download](https://mega.nz/file/jnpgCYTa#4II3H1Jjtg03FhITYp2FPRY7rDKUo3Fg21saD2kloeI)

### Solusi

```
root@d3228e764aa5:/playground/wasm# file program.wasm
program.wasm: WebAssembly (wasm) binary module version 0x1 (MVP)
```

diberikan 1 program WebAssembly (wasm), dengan menggunakan tools WABT: The WebAssembly Binary Toolkit isinya bisa dibaca

```
(module
  (type $t0 (func (result i32)))
  (type $t1 (func (param i32) (result i32)))
  (import "env" "putchar" (func $env.putchar (type $t1)))
  (func $main (export "main") (type $t1) (param $p0 i32) (result i32)
    (local $l1 i32)
    (local.set $p0
      (i32.add
        (local.get $p0)
        (i32.const -22)))
    (block $B0
      (loop $L1
        (local.set $l1
          (call $env.putchar
            (i32.add
              (i32.add
                (local.get $p0)
                (i32.load8_s
                  (i32.add
                    (local.get $p0)
                    (i32.const 37))))
              (i32.const 22))))
        (br_if $B0
          (i32.eqz
            (local.get $p0)))
        (local.set $p0
          (i32.add
            (local.get $p0)
            (i32.const 1)))
        (br_if $L1
          (local.get $l1))))
    (i32.const 0))
  (table $T0 0 funcref)
  (memory $memory (export "memory") 1)
  (data $d0 (i32.const 16) "q1s/m/*f0Ul((_P!$M   c\00"))
```

atau bisa juga menggunakan wasm-decompile untuk mendapatkan readable C-like syntax, 

```
sudo apt install wabt
wasm-decompile program.wasm -o test.dcmp
```

dan hasil decompilenya

```
export memory memory(initial: 1, max: 0);
table T_a:funcref(min: 0, max: 0);
data d_a(offset: 16) = "q1s/m/*f0Ul((_P!$M   c\00";
import function env_putchar(a:int):int;
export function main(a:int):int {
  a = a + -22;
  loop L_b {
    var b:int = env_putchar(a + (a + 37)[0]:byte + 22);
    if (eqz(a)) goto B_a;
    a = a + 1;
    if (b) continue L_b;
  }
  label B_a:
  return 0;
}
```
jika dilihat dari hasil decompilenya, merupakan sebuah aplikasi yang menggunakan perintah putchar dalam bahasa c untuk melakukan sebuah proses kalkulasi pada string `q1s/m/*f0Ul((_P!$M   c` Di C, sebuah array adalah sebuah pointer dan sebuah string adalah array of characters

dan menurut dokumentasi C

> fputc(), putc() and putchar() return the character written as an unsigned char cast to an int or EOF on
error

dalam kasus diatas putchar ini akan selalu mengembalikan 1 fungsi `var b:int = env_putchar(a + (a + 37)[0]:byte + 22);` akan sama dengan `putchar(str[i-1]+i)`

Di sistem operasi Windows, Linux atau POSIX yang lain, ketika program dijalankan, maka program dalam C akan menerima jumlah parameter dan isi parameternya

```
int main(int argc, char *argv[])
```

Jika kita deklarasikan tanpa argv, maka hanya jumlah parameternya yang kita dapatkan. Meskipun biasanya namanya argc dan argv, nama parameternya tentunya boleh apa saja

```
int main(int jumlah_argumen)
```

Jika program dijalankan tanpa parameter, maka jumlah argumennya adalah 1, yaitu nama program saat ini (yang tidak kita pedulikan di program ini). Jadi sebenarnya program tersebut dipanggil dengan

```
main(1)
```

`main` adalah sebuah fungsi di C, dan seperti fungsi apapun, bisa dipanggil bebas. Dalam kasus ini, memanggil (rekursif) main, dengan nilai i yang ditambahkan terus, jika dikonversikan kedalam bahasa C

```
#include <stdio.h>
const char *str = "q1s/m/*f0Ul((_P!$M   c";
int main(int i){
   putchar(str[i-1]+i);
   i++;
   if (i!=23) {
      main(i);
   }   
}
```

dan jika dijalankan hasilnya

```
$ gcc src.c -o test
$ ./test
r3v3r51n9_w45m_15_345y
```