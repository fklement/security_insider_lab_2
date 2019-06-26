// File: example3.c
// A buffer overflow example which allows the manipulation of function pointers.

#include <stdio.h>
#include <string.h>

void printChar(const char *buf) {
	printf("Character: %c\n", buf[0]);
}
//________________________________________________________
void printStr(const char *buf) {
	printf("String: %s\n", buf);
}
//________________________________________________________
void usage(const char *pname) {
	fprintf(stderr, "Usage: %s <tocopy> <toprint>\n", pname);
	fprintf(stderr, "  <tocopy> is the data to copy in the buffer\n");
	fprintf(stderr, "  <toprint> is the data to be printed.\n");
}
//________________________________________________________
int main(int argc, char **argv) {
	extern int  system(char *);
	void (*fctPtr)(char*) = (void(*)(char*))&system;
	char buffer[256];

	if(argc != 3) {
		fprintf(stderr, "Error: wrong number of arguments.\n");
		usage(argv[0]);
		exit(-1);
	}

	if(strlen(argv[2]) > 1)
		fctPtr = (void(*)(char*))&printStr;
	else
		fctPtr = (void(*)(char*))&printChar;

	strcpy(buffer, argv[1]);
	fctPtr(argv[2]);
	return 0;
}