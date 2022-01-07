#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <signal.h>
#include <string.h>

// gcc chal.c -o chal -no-pie -fno-stack-protector
// gcc chal.c -o chal -fno-stack-protector
// gcc chal.c -o chal
// --------------------------------------------------- SETUP

void init_buffering() {
	setvbuf(stdout, NULL, _IONBF, 0);
	setvbuf(stdin, NULL, _IONBF, 0);
	setvbuf(stderr, NULL, _IONBF, 0);
}

void kill_on_timeout(int sig) {
  if (sig == SIGALRM) {
    _exit(0);
  }
}

void init_signal() {
	signal(SIGALRM, kill_on_timeout);
	alarm(60);
}

void run_me_from_main() {
    system("/bin/sh");
}

void simple_say() {
    char read_buf[0xff];
    puts("Masukan kata sandi anda:\n");
    gets(read_buf);
    if(strcmp(read_buf, "th15_i5_n0t_4_fl4g") == 0) {
        puts("Access Granted\n");
        system("echo 'welcome...' | figlet");
    } else {
        puts("Kata sandi masih salah!\n");
        _exit(0);
    }
}

void main(int argc, char* argv[]) {
	init_buffering();
	init_signal();
  simple_say();
}
