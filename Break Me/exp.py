from pwn import *
import pytesseract
import base64

p = remote('103.147.32.214', 9002)
p.recvuntil(b' >')
p.sendline(b'Yes')
p.recvline(3)

run = True

def decode(img_str):
    imgdata = base64.b64decode(img_str)
    filename = '_image.png'
    with open(filename, 'wb') as f:
        f.write(imgdata)
    text = pytesseract.image_to_string(filename)
    text = text.replace("\x0c","")
    text = ''.join(c for c in text if c.isdigit())
    p.info(text)
    return text

def send(text):
    p.sendline(text.encode())
    p.recvline()
    res = p.recv(4200)[:-40]
    if 'Congrats You right'.encode() in res:
        b64 = res[71:]
        next = decode(b64)
        send(next)
    elif 'lasctf{'.encode() in res:
        print(res)
        p.close()

b64_image = p.recv(4200)[9:-40]
text = decode(b64_image)
send(text)
p.close()