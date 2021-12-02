#define MAXTRY 3000
#include<stdio.h>
#include<stdlib.h>
#include<time.h>
#include <sys/types.h>
#include<sys/wait.h>
#include <unistd.h>

int sort(const void *x, const void *y){
    return (*(int*)x - *(int*)y);
}

int main(int argc, char *argv[]){
    int groupsize,i,j;
    struct timespec tps, tpe;
    unsigned long long int count,pid,delta,totaldelta2;
    unsigned long long int bucket[MAXTRY];

    for(count = 0; count < MAXTRY; count++){
        clock_gettime(CLOCK_REALTIME, &tps);
        pid = fork();
        if(pid == 0){
            execl("./chal","./chal", argv[1], NULL);
        }else{
            wait(NULL);
            clock_gettime(CLOCK_REALTIME, &tpe);
            delta = tpe.tv_nsec - tps.tv_nsec;
            bucket[count] = delta;
        }
    }

    qsort(bucket, MAXTRY, sizeof(long long int), sort);
    totaldelta2 = 0;
    count = 0;
    groupsize = MAXTRY / 100;
    for(j=15; j<= 84; j++){
        for(i=0; i< groupsize; i++){
            totaldelta2 += bucket[j*groupsize+i];
            count++;
        }
    }

    printf("%s ; %llu\n", argv[1], totaldelta2/count);
}