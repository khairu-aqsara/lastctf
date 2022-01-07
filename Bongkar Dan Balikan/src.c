#include <stdio.h>
const char *str = "q1s/m/*f0Ul((_P!$M   c";
int main(int i){
   putchar(str[i-1]+i);
   i++;
   if (i!=23) {
      main(i);
   }   
}