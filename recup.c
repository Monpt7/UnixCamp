#include <stdio.h>
#include <sys/types.h>
#include <string.h>
#include <unistd.h>
#include <regex.h>
#include <dirent.h>
#include <stdlib.h>
#include <sys/stat.h>

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

char ***tab(char *file, int i, int j, int k)
{
  char ***array;
  int reg1;
  int reg2;
  regex_t regex1;
  regex_t regex2;
  struct stat s;
  struct dirent *read;
  DIR *dir;

  dir = opendir(file);
  reg1 = regcomp(&regex1, "^[S][:digit:]*", 0);
  reg2 = regcomp(&regex2, "^[K][:digit:]*", 0);
  array = malloc(s.st_size * sizeof(char));
  array[0] = malloc(s.st_size * sizeof(char));
  array[1] = malloc(s.st_size * sizeof(char));

  while ((read = readdir(dir))) {
      reg1 = regexec(&regex1, read->d_name, 0, NULL, 0);
      reg2 = regexec(&regex2, read->d_name, 0, NULL, 0);
      array[0][i+j] = malloc(strlen(read->d_name) * sizeof(char));
      array[1][i+j] = malloc(strlen(read->d_name) * sizeof(char));

      if (!reg1) {
        array[0][i] = read->d_name;
        i++;
      }
      else if (!reg2) {
        array[1][j] = read->d_name;
        j++;
      }
  }
  return (array);
  free(array);
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
