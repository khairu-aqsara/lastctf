## Prepare

```
apt install libao-dev
apt install sox multimon-ng
git clone https://github.com/fsphil/ax25beacon.git
cd ax25beacon
make 
make install
```

## Chal
```
ax25beacon -s "WDPX01" -o chal.wav -- -7.7869859 110.4576468 0 "lastctf{d0_y0u_kn0w_4b0ut_f1l3_54f3_c0mm5?}"
```

## Solve
```
sox -t wav chal.wav -esigned-integer -b16 -r 22050 -t raw - | multimon-ng -A -
```

## Chal Desc
```
Sebuah transmisi radio berbasis APRS dengan pesan rahasia dari planet namek untuk Son Goku
```

## Miyabi
```
kak aku punya teka-teki nih.
Letaknya paling kanan dan mempunyai nilai paling kecil, apakah aku ?
```