# sudo docker build -t reversme .
# sudo docker run -d -p 10001:10001 --rm -it reversme

FROM ubuntu:latest

RUN apt-get update

RUN useradd -d /home/ctf/ -m -p ctf -s /bin/bash ctf
RUN echo "ctf:ctf" | chpasswd

WORKDIR /home/ctf

COPY reversme .
COPY flag.txt .
COPY main.sh .
COPY ynetd .

RUN chown -R root:root /home/ctf

USER ctf
EXPOSE 10001
CMD ./ynetd -p 10001 ./main.sh