#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(int argc, char* argv[]) {
	int i, lenguess, j;
	char* guess;
	char secret[10];
	FILE* kunci = fopen("secretkey.txt","r");
	
	fgets(secret, 10, kunci);
	fclose(kunci);

	guess = argv[1];

	lenguess = strlen(guess);
	if(strlen(secret) != lenguess) {
		exit(1);
	}

	for (j=0; j<20000;j++);
	for (i=0; i<lenguess; i++){
		if(guess[i] != secret[i]) {
			exit(1);
		}
		for(j=0; j<20000; j++);
	}
	printf("Silahkan login ke SSH dengan Akun : miyabi:QNSGd4!bNL9mH\n");
	return 0;
}
