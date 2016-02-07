#include <stdio.h>
#include <sys/types.h>
#include <string.h>
#include <unistd.h>
#include <regex.h>
#include <dirent.h>
#include <stdlib.h>
#include <sys/stat.h>

char *parseConf(char *argv)
{
  char *file;
  char *str;
  char path[100];
  char defaut[30];
  char *previous;
  char *initNbr;
  char *write;
  int i;
  int j;
  int k;
  int reg1;
  int reg2;
  int reg3;
  regex_t regex1;
  regex_t regex2;
  regex_t regex3;
  FILE *f;
  FILE *newFile;

  file = "process.conf";
  initNbr = malloc(10);
  previous = malloc(30);
  reg1 = regcomp(&regex1, "previous=[:digit:]*", 0);
  reg2 = regcomp(&regex2, "path=[.]*", 0);
  reg3 = regcomp(&regex3, "default=[:digit:]*", 0);
  i = 0;
  j = 0;
  k = 0;
  if (access(file, F_OK | R_OK) == 0) {
      f = fopen(file, "rw");
      str = malloc(sizeof(char) * 100);
      while (fgets(str, 100, f) != NULL) {
        reg1 = regexec(&regex1, str, 0, NULL, 0);
        reg2 = regexec(&regex2, str, 0, NULL, 0);
        reg3 = regexec(&regex3, str, 0, NULL, 0);

        if (!reg1) {
          previous = str;
          while (*str != '\n') {
            if (j == 1) {
              initNbr[k] = *str;
              k++;
            }
            if (*str == '=')
              j = 1;
            str++;
          }
        }
        if (!reg2)
          strcat(path, str);
        if (!reg3)
          strcat(defaut, str);
      }
      fclose(f);
      remove(file);
      newFile = fopen(file, "w+");
      strcat(path, defaut);
      puts(defaut);
      strcat(path, "previous=");
      strcat(path, initNbr);
      fprintf(newFile, path, NULL);
      //fwrite(defaut, 1, sizeof(defaut), newFile);
  }
  else
  puts("No file or no permission denied");
//  free(&regex1);
  return (initNbr);

}

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
  closedir(dir);
  return (array);
  free(array);

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
  else {
    //putstr("No such file or permission denied");
  }
}

int main(int argc, char *argv[]) {
  //char *initNbr;
  char *path;
  //initNbr = argv[1];
  //path = "/Users/perrin_l/unix_camp/UnixCamp/";
  //recup(initNbr, path);*/
  parseConf(argv[1]);
  return 0;
}
