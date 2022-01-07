## Docker Rescue
### Deskripsi

Teman-teman tolongin saya dong, flag nya ada didalam docker tapi pas dijalanin flagnya otomatis kehapus, gimana cara dapetin flagnya ya ?

```
docker pull wenkhairu/lastctf
```

### Solusi

Setelah pull docker image, jangan dijalanin, gunakan perintah 

```
$ docker save wenkhairu/lastctf -o lasctf.tar

$ tar -xvf lasctf.tar
$ grep -rnw . -e 'lastctf'

"WorkingDir":"/var/lastctf"

```

cari folder `/var/lastctf` disetiap folder dan hasilnya

```
lastctf{b4sic_kn0wl4d93_f0r_d0ck3r}
```