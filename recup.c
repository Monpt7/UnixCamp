#include<stdio.h>
#include <sys/types.h>
#include<string.h>
#include <unistd.h>
#include <regex.h>
#include <dirent.h>
#include <stdlib.h>

char *concatener(char *path, char *initNbr)
{
  char *str;
  str = malloc(60 * sizeof(char));
  strcpy(str, path);

  strcat(str, "rc");
  strcat(str, initNbr);
  strcat(str, ".d/");
  return (str);
}

void tab(char *file, int i, int j, int k)
{
  char ***array;
  int reg1;
  int reg2;
  regex_t regex1;
  regex_t regex2;
  struct dirent *read;
  DIR *dir;

  dir = opendir(file);
  reg1 = regcomp(&regex1, "[S][0-9]{2}[0-9]?(.*)", 0);
  reg2 = regcomp(&regex2, "[K][0-9]{2}[0-9]?(.*)", 0);
  array = malloc(100 * sizeof(char));

  while ((read = readdir(dir))) {
      reg1 = regexec(&regex1, read->d_name, 0, NULL, 0);
      reg2 = regexec(&regex2, read->d_name, 0, NULL, 0);

      if (!reg1) {
        array[0][i] = read->d_name;
        printf("%s\n", array[0][i]);
        i++;
      }
      else if (!reg2) {
        array[1][j] = read->d_name;
        printf("%s\n", array[1][j]);
        j++;
      }


  }




  closedir(dir);
}



void recup(char *initNbr, char  *path)
{
  int i;
  int j;
  int k;
  char *file;
  char ***array;
  i = 0;
  j = 0;
  k = 0;
  file = concatener(path, initNbr);

  if (access(file, F_OK | R_OK) == 0)
  {
    tab(file, i, j, k);
  }
}

int main(int argc, char *argv[]) {
  char *initNbr;
  char *path;
  initNbr = argv[1];
  path = "/Users/perrin_l/unix_camp/UnixCamp/";
  recup(initNbr, path);
  return 0;
}
