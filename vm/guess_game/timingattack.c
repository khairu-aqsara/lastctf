#include <unistd.h>
#include <time.h>
#include <stdio.h>
#include <stdlib.h>

#define MAXTRY 10000

int sort(const void *x, const void *y) {
	return (*(int*)x - *(int*)y);
}


int main(int argc, char* argv[]){
	int groupsize,i,j;
	struct timespec tps, tpe;
	unsigned long long int count,pid,delta,totaldelta2;
	unsigned long long int bucket[MAXTRY];

	for (count = 0; count < MAXTRY; count++){
		clock_gettime(CLOCK_REALTIME, &tps);
		if(fork() == 0) {
			execl("./guessme","./guessme", argv[1], NULL);
		}else{
			wait(NULL);
			clock_gettime(CLOCK_REALTIME, &tpe);
			delta = tpe.tv_nsec-tps.tv_nsec;
			bucket[count] = delta;
		}
	}
	qsort(bucket, MAXTRY, sizeof(long long int), sort);
	totaldelta2 = 0;
	count = 0;
	groupsize = MAXTRY / 100;
	for (j=15; j<=84; j++){
		for(i=0; i< groupsize; i++) {
			totaldelta2 += bucket[j*groupsize+1];
			count++;
		}
	}

	printf("%s ; %llu\n", argv[1], totaldelta2/count);
	return 0;
}
