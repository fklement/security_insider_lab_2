#include <unistd.h>

int main()
{
    //execve requires a command and a string that starts with the command + the command parameters. as we just want to spawn a shell we do not need any command parameters and tehrefore set getshell[1] to NULL. Furthermore we do not want envp. 
    char *getshell[2];
    getshell[0]="/bin/sh";
    getshell[1]=NULL;
    execve(getshell[0], getshell, NULL);
}
