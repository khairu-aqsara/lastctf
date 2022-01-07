## Transmisi APRS

### Deskripsi

Sebuah transmisi radio berbasis APRS dengan pesan rahasia dari planet namek untuk Son Goku

[Download](https://mega.nz/file/zvhwnTgL#DsLM6aTcyOBl8UGuvQ3Z4eAqdLkbT8Ka0PIta8s4-zc)

### Solusi


```
$ file chal.wav
chal.wav: RIFF (little-endian) data, WAVE audio, mono 48000 Hz
```

file merupakan file audio wav, `48000` Hz atau sama dengan `24000 Bps` karena `1 Hz=2 Bps` atau biasa disebut dengan Protokol AX.25 yang digunakan untuk transmisi radio yang bersifat modulasi (modulation) untuk itu perlu dilakukan demodulation karena Modulasi adalah suatu proses dimana sinyal Audio Frequency (AF) diubah menjadi sinyal Radio Frequency (RF) sebelum dipancarkan. Proses sebaliknya yaitu perubahan sinyal RF mernjadi sinyal AF (dinamakan dengan demodulasi), sebelum dilaukan proses demodulasi, file wav harus di konversi dulu kedalam format raw, kemudian dilakukan proses demodulasi dengan menggunakan tools `multimon-ng`


```
$ sox -t wav chal.wav -esigned-integer -b16 -r 22050 -t raw - | multimon-ng -A -
multimon-ng 1.1.8
  (C) 1996/1997 by Tom Sailer HB9JNX/AE4WA
  (C) 2012-2019 by Elias Oenal
Available demodulators: POCSAG512 POCSAG1200 POCSAG2400 FLEX EAS UFSK1200 CLIPFSK FMSFSK AFSK1200 AFSK2400 AFSK2400_2 AFSK2400_3 HAPN4800 FSK9600 DTMF ZVEI1 ZVEI2 ZVEI3 DZVEI PZVEI EEA EIA CCIR MORSE_CW DUMPCSV X10 SCOPE
Enabled demodulators: AFSK1200
APRS: WDPX01>APRS:!/RH3=jFPpO   /A=000000lastctf{d0_y0u_kn0w_4b0ut_f1l3_54f3_c0mm5?}
```



