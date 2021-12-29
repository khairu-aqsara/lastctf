FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y socat
WORKDIR /home/ctf
COPY brankas .
COPY flag.txt .
COPY ynetd .
EXPOSE 10001
CMD ./ynetd -p 10001 ./brankas