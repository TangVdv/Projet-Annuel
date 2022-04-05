#include <curl/curl.h>
#include <stdio.h>
#include <string.h>
#include <sqlite3.h>
#include <sys/stat.h>

sqlite3 *db;
sqlite3_stmt *res;
char *err_msg = 0;
FILE *yaml_file;


int getData(void *NotUsed, int rowCount, char **rowValue, char **rowName){
  char tab = '\t';
  for (int i = 0; i < rowCount; i++){
    if (i%2 == 0){
      fprintf(yaml_file, "%c%s: %s\n", tab, rowName[i], rowValue[i]);
    }
    else
      fprintf(yaml_file, "%c%c%s: %s\n", tab, tab, rowName[i], rowValue[i]);
  }

  return 0;
}

void getSupply(){
  fprintf(yaml_file, "approvisionnement:\n");

  //sql = "SELECT nom, prix FROM PRODUIT INNER JOIN STOCK ON stock.id_produit = produit.id_produit WHERE CAST(stock.date_ajout AS DATE) = CAST( GETDATE() AS DATE)";
  //sqlite3_exec(db, sql, getData, 0,&err_msg);

  char *sql = "SELECT date_achat, prix_achat FROM historique_achat";
  sqlite3_exec(db, sql, getData, 0,&err_msg);
}

void getSale(){
  fprintf(yaml_file, "vente:\n");

  //char *sql = "SELECT nom, prix FROM PRODUIT INNER JOIN HISTORIQUE_ACHAT ON historique_achat.id_produit  = produit.id_produit WHERE CAST(date_achat AS DATE) = CAST( GETDATE() AS DATE)";
  //sqlite3_exec(db, sql, getData, 0,&err_msg);

  char *sql = "SELECT nom, prix FROM produit";
  sqlite3_exec(db, sql, getData, 0,&err_msg);
}

int curl(){
    CURL *curl = curl_easy_init();
    CURLcode res;
    struct stat file_info;
    curl_off_t speed_upload, total_time;


    if(!yaml_file){
      printf("error cannot open file");
      return 1; /* cannot continue */
    }

    if(fstat(fileno(yaml_file), &file_info) != 0){
      printf("error file size");
      return 1; /* cannot continue */
    }

    if(curl){

      //upload to this place 
      curl_easy_setopt(curl, CURLOPT_URL,"file:///home/tangvdv/Documents/receive_data");
   
      //tell it to "upload" to the URL 
      curl_easy_setopt(curl, CURLOPT_UPLOAD, 1L);
   
      //set where to read from (on Windows you need to use READFUNCTION too)
      curl_easy_setopt(curl, CURLOPT_READDATA, yaml_file);

      /* and give the size of the upload (optional) */
      curl_easy_setopt(curl, CURLOPT_INFILESIZE_LARGE,
                     (curl_off_t)file_info.st_size);
   
      //enable verbose for easier tracing
      curl_easy_setopt(curl, CURLOPT_VERBOSE, 1L);
   
      res = curl_easy_perform(curl);
      /* Check for errors */
      if(res != CURLE_OK) {
        fprintf(stderr, "curl_easy_perform() failed: %s\n",
                curl_easy_strerror(res));
      }
      else {
        /* now extract transfer info */
        curl_easy_getinfo(curl, CURLINFO_SPEED_UPLOAD_T, &speed_upload);
        curl_easy_getinfo(curl, CURLINFO_TOTAL_TIME_T, &total_time);
   
        fprintf(stderr, "Speed: %lu bytes/sec during %lu.%06lu seconds\n",
                (unsigned long)speed_upload,
                (unsigned long)(total_time / 1000000),
                (unsigned long)(total_time % 1000000));
      }
      /* always cleanup */
      curl_easy_cleanup(curl);
    }
    return 0;
}

int main(int argc, char **argv){

  // OPEN
  yaml_file = fopen("data.yaml", "w");

	int rc = sqlite3_open("loyaltycard", &db); // Ouvre la base de donnée
	// Check si la base de donnée existe
  if (rc != SQLITE_OK) {
      fprintf(stderr, "Cannot open database: %s\n", sqlite3_errmsg(db));
      sqlite3_close(db);
      return 1;
  }


	//VENTE
	getSale();


  //APPROVISIONNEMENT
  getSupply();

  //CURL
  curl();


  // CLOSE
  fclose(yaml_file);

  sqlite3_finalize(res); // Supprime le "statement" de la base de donnée
  sqlite3_close(db); // Ferme la base de donnée
  return 0;
}