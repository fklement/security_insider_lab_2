// File: example1.c
#include <stdio.h>
#include <stdlib.h>

void printHello() {
	char *hello = "Hello world!";
	int i = 32;

	printf("A string: %s followed by an int %d\n", hello, i);
}
//___________________________________________
void printSurprise() {
	printf("Surprise, surprise!\n");
	exit(99);
}
//___________________________________________
int mult(int  factA, int factB) {
	int i, result = factA;

	for (i = 0; i < factB; i++)
		result += factA;

	return result;
}
//___________________________________________
int main() {
	int val = 5;
	int res = 0;

	res = mult(val, 22);
	printf("%d multiplied with 22 is: %d\n", val, res);
	printHello();
	return 0;
}
