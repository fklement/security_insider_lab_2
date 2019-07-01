// File: example2.c
// A simple buffer overflow example.
 
#include <stdio.h>

void readInput(char *buf) {
	int offset = 0;
	int ch = 0;

	while((ch = getchar()) != '\ņ' && offset < 19) {
		if( ch == EOF) break;
		buf[offset++] = (char)ch;
	}
}
//___________________________________________
int main() {
	int pivot  = 1234;
	// ensure that result is null terminated
	char buffer[20] = {0};

	// write the address of buffer and pivot
	printf("buffer: %8p pivot: %8p\n", (void*)&buffer, (void*)&pivot);

	// read some input
	readInput(buffer);

	
	printf("pivot: %d", pivot);
	// test for pivot element
	if (pivot == 0x10204030)  printf("Congratulations! You win!\n");

	return 0;
}
