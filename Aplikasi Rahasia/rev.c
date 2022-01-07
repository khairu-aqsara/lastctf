#include <stdio.h>
#include <string.h>

int cGVyaWtzYV9rYXRhX2t1bmNp(char * pass) {
  int dGFoYXBfc2VsYW5qdXRueWFf = 0;
  if (pass[0] == 'r') {
    if (pass[1] == '3') {
      if (pass[2] == 'v') {
        if (pass[3] == '3') {
          if (pass[4] == 'r') {
            if(pass[5] == '5'){
                if(pass[6] == '1'){
                    if(pass[7] == 'n'){
                        if(pass[8] == '9'){
                            if(pass[9] == '_'){
                                if(pass[10] == '3'){
                                    if(pass[11] == 'l'){
                                        if(pass[12] == 'f'){
                                            if(pass[13] == '_'){
                                                if(pass[14] == 'f'){
                                                    if(pass[15] =='1'){
                                                        if(pass[16] == 'l'){
                                                            if(pass[17] == '3'){
                                                                if(pass[18] == '_'){
                                                                  dGFoYXBfc2VsYW5qdXRueWFf = 1;
                                                                }
                                                            } 
                                                        }
                                                    }
                                                }
                                            }
                                        } 
                                    }
                                }
                            }
                        }
                    }
                }
            }
          }
        }
      }
    }
  }

  if (dGFoYXBfc2VsYW5qdXRueWFf) {
    if (pass[19] == '1') {
      if (pass[20] == '5') {
        if (pass[21] == '_') {
          if (pass[22] == 't') {
            if (pass[23] == '0') {
              if(pass[24] == '_'){
                  if(pass[25] == 't'){
                      if(pass[26] == '3'){
                          if(pass[27] == '5'){
                              if(pass[28] == 't'){
                                  if(pass[29] == '_'){
                                      if(pass[30] == 'y'){
                                          if(pass[31] == '0'){
                                              if(pass[32] == 'u'){
                                                  if(pass[33] == 'r'){
                                                      if(pass[34] == '_'){
                                                          if(pass[35] == 'k'){
                                                              if(pass[36] == 'n'){
                                                                  if(pass[37] == '0'){
                                                                      if(pass[38] == 'w'){
                                                                          if(pass[39] == 'l'){
                                                                              if(pass[40] == '4'){
                                                                                  if(pass[41] == 'd'){
                                                                                      if(pass[42] == '9'){
                                                                                          if(pass[43] == '3'){
                                                                                              return 0;
                                                                                          }
                                                                                      }
                                                                                  }
                                                                              }
                                                                          }
                                                                      }
                                                                  }
                                                              }
                                                          }
                                                      }
                                                  }
                                              }
                                          }
                                      }
                                  }
                              }
                          }
                      }
                  }
              }
            }
          }
        }
      }
    }
  } else {
    return -1;
  }
}

int cGVyaWtzYV9wYW5qYW5nX2thdGFfa3VuY2lueWFf(char * pass) {
  int i = 0;
  while (pass[i] != '\0') {
    i++;
  }
  return i;
}

int YXNjaWlWYWx1ZVRvQmluYXJ5(int cGFy)
{
	int res = 0, i = 1, rem;
        
	while (cGFy > 0)
	{
		rem = cGFy % 2;
		res = res + (i * rem);
		cGFy = cGFy / 2;
		i = i * 10;
	}
	return(res);
}

int main(int argc, char * argv[]) {
  char pass[44];
  int dGFoYXBfc2VsYW5qdXRueWFf = 0;

  printf("Masukan Kata Kunci Anda: ");
  scanf("%s", pass);
  printf("Kata kunci yang anda masukan : [%s]\n", pass);

  if ((cGVyaWtzYV9wYW5qYW5nX2thdGFfa3VuY2lueWFf(pass) == 44) &&
    (cGVyaWtzYV9rYXRhX2t1bmNp(pass) == 0)) {
    printf("Selamat, sekarang anda tau flagnya kan ?!\n");
    printf("Sebenarnya ini bukan Aplikasi rahasia, jangan marah ya :D !\n");
  } else {
    printf("Kata Kunci tidak valid!\n");
  }
  return 0;
}