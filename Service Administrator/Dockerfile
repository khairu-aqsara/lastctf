FROM ubuntu:latest

RUN apt-get update
RUN apt-get install figlet
RUN useradd -d /home/ctf/ -m -p ctf -s /bin/bash ctf
RUN echo "ctf:ctf" | chpasswd

WORKDIR /home/ctf

COPY chal .
COPY flag .
COPY ynetd .

RUN chown -R root:root /home/ctf

USER ctf
EXPOSE 9006
CMD ./ynetd -p 9006 ./chal