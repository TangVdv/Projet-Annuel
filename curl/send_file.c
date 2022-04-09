#include <curl/curl.h>
#include <stdio.h>
#include <string.h>
#include <sqlite3.h>
#include <sys/stat.h>


#define UPLOAD_FILE_AS "data.yaml"
#define REMOTE_URL "file:///home/tangvdv/Documents/receive_data/" UPLOAD_FILE_AS

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
    yaml_file = fopen("data.yaml", "r");

    CURL *curl = curl_easy_init();
    CURLcode res;
    struct stat file_info;
    curl_off_t speed_upload, total_time;

    if(curl){
   
      // Dis à curl d'envoyer un fichier à un url donné
      curl_easy_setopt(curl, CURLOPT_UPLOAD, 1L);
   
      // Enverra le fichier à cette url
      curl_easy_setopt(curl, CURLOPT_URL, REMOTE_URL);

      // Le fichier qui va être envoyé
      curl_easy_setopt(curl, CURLOPT_READDATA, yaml_file);

      // Taille du fichier à envoyer
      curl_easy_setopt(curl, CURLOPT_INFILESIZE_LARGE,
                     (curl_off_t)file_info.st_size);
   
      res = curl_easy_perform(curl);
      // Regarde s'il y a des erreurs
      if(res != CURLE_OK) {
        fprintf(stderr, "curl_easy_perform() failed: %s\n",
                curl_easy_strerror(res));
      }
      // Nettoie curl à la fin de son utilisation
      curl_easy_cleanup(curl);
    }
    fclose(yaml_file);

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

  // CLOSE
  fclose(yaml_file);

  //CURL
  curl();


  sqlite3_finalize(res); // Supprime le "statement" de la base de donnée
  sqlite3_close(db); // Ferme la base de donnée
  return 0;
}