#include <curl/curl.h>
#include <stdio.h>
#include <string.h>
#include <sqlite3.h>

sqlite3 *db;
sqlite3_stmt *res;
char *err_msg = 0;
FILE *yaml_file;


int getData(void *NotUsed, int rowCount, char **rowValue, char **rowName){
  for (int i = 0; i < rowCount; i++){
    fprintf(yaml_file, "%s: %s\n", rowName[i], rowValue[i]);
  }

}

void getSupply(){
  fprintf(yaml_file, "approvisionnement:\n");

  //sql = "SELECT nom, prix FROM PRODUIT INNER JOIN STOCK ON stock.id_produit = produit.id_produit WHERE CAST(stock.date_ajout AS DATE) = CAST( GETDATE() AS DATE)";
  //sqlite3_exec(db, sql, getData, 0,&err_msg);

  char *sql = "SELECT nom, prenom FROM utilisateur";
  sqlite3_exec(db, sql, getData, 0,&err_msg);
}

void getSale(){
  fprintf(yaml_file, "vente:\n");

  //char *sql = "SELECT nom, prix FROM PRODUIT INNER JOIN HISTORIQUE_ACHAT ON historique_achat.id_produit  = produit.id_produit WHERE CAST(date_achat AS DATE) = CAST( GETDATE() AS DATE)";
  //sqlite3_exec(db, sql, getData, 0,&err_msg);

  char *sql = "SELECT nom, description, prix FROM produit";
  sqlite3_exec(db, sql, getData, 0,&err_msg);
}

void curl(){
    CURL *curl = curl_easy_init();

    if(curl){

        curl_easy_perform(curl);
        curl_easy_cleanup(curl);
    }

    //upload to this place 
    curl_easy_setopt(curl, CURLOPT_URL,"../../receive_data/");
 
    //tell it to "upload" to the URL 
    curl_easy_setopt(curl, CURLOPT_UPLOAD, 1L);
 
    //set where to read from (on Windows you need to use READFUNCTION too)
    curl_easy_setopt(curl, CURLOPT_READDATA, yaml_file);
 
    //enable verbose for easier tracing
    curl_easy_setopt(curl, CURLOPT_VERBOSE, 1L);
 
    curl_easy_perform(curl);
}

int main(int argc, char * argv[]){

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