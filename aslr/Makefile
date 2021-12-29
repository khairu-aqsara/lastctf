CC=gcc
CFLAGS=-std=c99 -Wall -fno-stack-protector -z execstack -m32 -no-pie

all: chal

chal: chal.o
	$(CC) $(CFLAGS) -o $@ $^
	chown 0:0 $@
	chmod u+s $@

chal.o: chal.c

clean:
	rm chal.o chal