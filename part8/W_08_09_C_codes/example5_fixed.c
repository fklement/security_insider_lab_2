// File: example5.c
// An integer overflow can crash this program

#include <stdlib.h>
#include <stdio.h>

void usage(const char *pname);
//________________________________________________________
int main(int argc, char **argv) {
	short s;
	char buf[100];

	if(argc != 3) {
		fprintf(stderr, "Error: wrong number of arguments.\n");
		usage(argv[0]);
		return -1;
	}

	s = atoi(argv[1]);

	printf("atoi(argv[1]) = %d, 0x%08x\n", atoi(argv[1]), atoi(argv[1]));
	printf("s = %hd, 0x%hx\n", s, s);

	if(s > sizeof(buf) - 1 || atoi(argv[1]) > 65535) {
		printf("Error: Input is too large\n");
		return -1;
	}

	snprintf(buf, atoi(argv[1])+1, "%s", argv[2]);
	printf("Buffer = '%s'\n", buf);

	return 0;
}
//________________________________________________________
void usage(const char *pname) {
	fprintf(stderr, "Usage: %s <numbytes> <tocopy>\n", pname);
	fprintf(stderr, "  where <numbytes> is the number of bytes to copy in the buffer\n");
	fprintf(stderr, "  and <tocopy> is the data to be copied and printed.\n");
}
