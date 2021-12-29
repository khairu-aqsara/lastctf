#include <stdio.h>
#include <stdlib.h>

int main() {

    char operator;
    double first, second;

    printf("Masukan PIN Pertama: ");
    scanf("%lf", &first);

    printf("Masukan PIN Ke-Dua: ");
    scanf("%lf", &second);

    if (first + second == 1208 && first * second == 261775) {
        FILE * fptr;
        fptr = fopen("flag.txt", "r");
        printf ("Selamat, Ini Flag Anda: ");
        char c = fgetc(fptr);
        while (c != EOF)
        {
            printf ("%c", c);
            c = fgetc(fptr);
        }

        fclose(fptr);
    } else {
        printf("Goodbye, Sayonara, dan sampai Jumpa!\n");
        exit(0);
    }

    return 0;
}