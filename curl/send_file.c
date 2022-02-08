#include <curl/curl.h>
#include <stdio.h>
#include <string.h>
#include <sqlite3.h>

CURL *curl;
sqlite3 *db;
sqlite3_stmt *res;

int getData(void *NotUsed, int rowCount, char **rowValue, char **rowName){
	//TODO : add code
}

int main(){
	yaml_file = fopen("data.yaml", "w");

	int rc = sqlite3_open("Projet.database", &db); // Ouvre la base de donnée

    // Check si la base de donnée existe
    if (rc != SQLITE_OK) {
        fprintf(stderr, "Cannot open database: %s\n", sqlite3_errmsg(db));
        sqlite3_close(db);
        return 1;
    }

    // TODO : Change query
    char *sql = "";
    sqlite3_exec(db, sql, getData, 0,&err_msg);

	curl = curl_easy_init();
    if(curl){
        curl_easy_setopt(curl, CURLOPT_URL, "https://api.github.com/users/TangVdv");
        curl_easy_setopt(curl, CURLOPT_USERAGENT, "Projet-Annuel");
        curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, got_data);

        curl_easy_perform(curl);
        curl_easy_cleanup(curl);
    }
    /* upload to this place */
    curl_easy_setopt(curl, CURLOPT_URL,"./");
 
    /* tell it to "upload" to the URL */
    curl_easy_setopt(curl, CURLOPT_UPLOAD, 1L);
 
    /* set where to read from (on Windows you need to use READFUNCTION too) */
    curl_easy_setopt(curl, CURLOPT_READDATA, yaml_file);
 
    /* and give the size of the upload (optional) */
    curl_easy_setopt(curl, CURLOPT_INFILESIZE_LARGE,
                     (curl_off_t)file_info.st_size);
 
    /* enable verbose for easier tracing */
    curl_easy_setopt(curl, CURLOPT_VERBOSE, 1L);
 
    res = curl_easy_perform(curl);
    /* Check for errors */
    if(res != CURLE_OK) {
      fprintf(stderr, "curl_easy_perform() failed: %s\n",
              curl_easy_strerror(res));
    }

    sqlite3_finalize(res); // Supprime le "statement" de la base de donnée
    sqlite3_close(db); // Ferme la base de donnée
    return 0;
}