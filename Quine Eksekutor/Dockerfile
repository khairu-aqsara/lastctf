FROM python:3-alpine
RUN apk add --no-cache socat
COPY flag /root
COPY periksa.py /
COPY run.py /
EXPOSE 9001
CMD ["socat", "TCP-LISTEN:9001,fork,reuseaddr", "EXEC:\"python periksa.py\",pty,stderr"] 