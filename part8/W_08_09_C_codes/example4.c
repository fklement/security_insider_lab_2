// File: example4.c
// The classic buffer overflow example.

#include <stdio.h>
#include <string.h>

void usage(const char *pname) {
	fprintf(stderr, "Usage: %s <tocopy>\n", pname);
	fprintf(stderr, "  where <tocopy> is the data to copy in the buffer\n");
}
//________________________________________________________
int main(int argc, char **argv) {
	char buffer[256];

	if(argc != 2) {
		fprintf(stderr, "Error: wrong number of arguments.\n");
		usage(argv[0]);
		return -1;
	}

	strcpy(buffer, argv[1]);

	return 0;
}