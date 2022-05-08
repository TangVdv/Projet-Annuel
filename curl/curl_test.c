#include <curl/curl.h>
#include <stdio.h>
#include <string.h>
#include<json-c/json.h>
#include <sqlite3.h>

CURL *curl;
sqlite3 *db;
sqlite3_stmt *res;

void read_json(){
	FILE *yaml_file;
	FILE *json_file;
	yaml_file = fopen("data.yaml", "w");
	json_file = fopen("curl.json", "r");
	char *key;
	char buffer[5000];
	struct json_object *parsed_json;
	struct json_object *value;
	fread(buffer, 5000, 1, json_file);
	parsed_json = json_tokener_parse(buffer);
	printf("json : %s\n\n", json_object_get_string(parsed_json));

		for(struct lh_entry *entry = json_object_get_object(parsed_json)->head;
		({
			if (entry){
				key = ( char * ) entry->k;
				value = ( struct json_object * ) entry->v;
			}entry -> v;
		}); entry = entry->next)
		{
			fprintf(yaml_file, "%s: %s\n", key, json_object_get_string(value));
		}


	fclose(json_file);
	fclose(yaml_file);
}

size_t got_data(char *buffer, size_t itemsize, size_t nitems, void* ignorethis){
	FILE *json_file;
	json_file = fopen("curl.json", "a");
    size_t bytes = itemsize * nitems;
    for (int i = 0; i < bytes; ++i)
    {
    	if(buffer[i] == ','){
    		fprintf(json_file, ",\n");
    	}
    	else{
    		fprintf(json_file, "%c", buffer[i]);
    	}
    }
    fclose(json_file);
    return bytes;
}


int main(){
	remove("curl.json");

	int rc = sqlite3_open("Projet.database", &db); // Ouvre la base de donnée

    // Check si la base de donnée existe
    if (rc != SQLITE_OK) {
        fprintf(stderr, "Cannot open database: %s\n", sqlite3_errmsg(db));
        sqlite3_close(db);
        return 1;
    }

	curl = curl_easy_init();
    if(curl){
        curl_easy_setopt(curl, CURLOPT_URL, "https://api.github.com/users/TangVdv");
        curl_easy_setopt(curl, CURLOPT_USERAGENT, "Projet-Annuel");
        curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, got_data);

        curl_easy_perform(curl);
        curl_easy_cleanup(curl);
    }

    sqlite3_finalize(res); // Supprime le "statement" de la base de donnée
    sqlite3_close(db); // Ferme la base de donnée

    read_json();
    return 0;
}
