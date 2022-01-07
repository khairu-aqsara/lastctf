FROM alpine:latest
LABEL org.opencontainers.image.authors="wenkhairu@gmail.com"

RUN apk update
RUN mkdir -p /var/lastctf
WORKDIR /var/lastctf
COPY flag.txt /var/lastctf/flag.txt
RUN rm /var/lastctf/flag.txt