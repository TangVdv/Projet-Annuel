#include <stdio.h>
#include <stdlib.h>
#include "xlsxwriter.h"

int main(int argc, char **argv) {
  FILE *fp = fopen("data.yaml", "r");
    if(fp == NULL) {
       perror("Unable to open file!");
        exit(1);
      }

  /* Create a new workbook and add a worksheet. */
  lxw_workbook  *workbook  = workbook_new("rapport.xlsx");
  lxw_worksheet *worksheet = workbook_add_worksheet(workbook, NULL);
  /* Change the column width for clarity. */
  worksheet_set_column(worksheet, 0, 0, 20, NULL);
  

  char line[128];
  //Indique la ligne sur laquelle écrire dans la feuille excel
  int counter = 0;
  char *ptr;

   while(fgets(line, sizeof(line), fp) != NULL) {
      //Détermine la séparation entre les deux cases
      ptr = strchr(line, ':');
      //Coupe la string en 2 au niveau des ":" en les supprimant
      *ptr = '\0';
      worksheet_write_string(worksheet, counter, 0, line, NULL);
      //String temporaire qui récupère la 2ème partie de la string "line"
      char *temp = ptr + 2;
      //Vérifie la taille réelle de la string (sans les espaces) et les supprime
      temp[strlen(temp)] = '\0';
      worksheet_write_string(worksheet, counter, 1, temp, NULL);
      ++counter;
      //printf("%s", line);
   }

   workbook_close(workbook);
   fclose(fp);
 }