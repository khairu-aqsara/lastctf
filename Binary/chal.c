#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(int agrc, char* argv[]){
    int i, panjang_tebakan, j;
    char *tebakan_saya;
    char isi_flag_nya[64];
    FILE *file_flag = fopen("flag.txt", "r");
    fgets(isi_flag_nya, 64, file_flag);
    fclose(file_flag);

    tebakan_saya = argv[1];
    panjang_tebakan = strlen(tebakan_saya);
    if(strlen(isi_flag_nya) != panjang_tebakan){
        exit(1);
    }
    for(j = 0; j < 20000; j++);
    for(i = 0; i < panjang_tebakan; i++){
        if(tebakan_saya[i] != isi_flag_nya[i]){
            exit(1);
        }
        for(j=0; j<20000;j++);
    }
    printf("Congrats Anda berhasil\n");
}