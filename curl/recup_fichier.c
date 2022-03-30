#include <stdio.h>
#include <stdlib.h>
#include "xlsxwriter.h"

lxw_worksheet *worksheet;
lxw_format *format;
FILE *fp;

void write(){
  char line[128];
  //Indique la ligne sur laquelle écrire dans la feuille excel
  int row = 0;
  int write = 0;

  while(fgets(line, sizeof(line), fp) != NULL) {
    if(line[strlen(line) -1] == '\n'){
          line[strlen(line) -1] = '\0';
    }

    //Détermine la séparation entre les deux cases
    char *ptr = strchr(line, ':');
    //Coupe la string en 2 au niveau des ":" en les supprimant
    *ptr = '\0';
    //String temporaire qui récupère la 2ème partie de la string "line"
    char *temp = ptr + 2;
    //Vérifie la taille réelle de la string (sans les espaces) et les supprime
    temp[strlen(temp)] = '\0';

    if(line[0] == '\t'){
      if(line[1] == '\t'){
        if (write == 0)
        {
          worksheet_write_string(worksheet, --row, 2, line, format);
          write = 1;
        }
        else
          --row;
        worksheet_write_string(worksheet, ++row, 2, temp, NULL);
      }
      else{
        if(write == 0){
          worksheet_write_string(worksheet, ++row, 1, line, format);
        }
        worksheet_write_string(worksheet, ++row, 1, temp, NULL);
      }
    }
    else{
      worksheet_write_string(worksheet, ++row, 0, "\n", NULL);
      worksheet_write_string(worksheet, ++row, 0, line, NULL);
      write = 0;
    }
  }
}

int main() {
  fp = fopen("data.yaml", "r");
  if(fp == NULL) {
    perror("Unable to open file!");
    exit(1);
  }

  /* Create a new workbook and add a worksheet. */
  lxw_workbook  *workbook  = workbook_new("rapport.xlsx");
  worksheet = workbook_add_worksheet(workbook, NULL);

  /* Ajoute un format */
  format = workbook_add_format(workbook);
  /* Paramètre la propriété du format en "gras" */
  format_set_bold(format);
  /* Change the column width for clarity. */
  worksheet_set_column(worksheet, 0, 0, 30, NULL);
  worksheet_set_column(worksheet, 0, 1, 30, NULL);
  worksheet_set_column(worksheet, 0, 2, 30, NULL);

  // WRITE
  write();

  // CLOSE
  workbook_close(workbook);
  fclose(fp);
}