package com.example.codescanner;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.widget.TextView;

public class InfoActivity extends AppCompatActivity {
    SQLiteHelper myDb;
    Cursor resultQuery;
    int idR;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        myDb = new SQLiteHelper(this);
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_info);

        Intent intent = getIntent();
        idR = intent.getIntExtra("id", -1);

        if (idR >= 0) {
            resultQuery = myDb.getUsers(idR);
            printInfos();
            getInfos();
        }

    }

    public void printInfos() {
        while (resultQuery.moveToNext()) {
            System.out.println("Id : " + resultQuery.getInt(0));
            System.out.println("Nom : " + resultQuery.getString(1));
            System.out.println("Prénom : " + resultQuery.getString(2));
        }
    }

    public void getInfos() {
        resultQuery.moveToFirst();

        TextView id = findViewById(R.id.tv_id);
        id.setText(id.getText() +  " " + resultQuery.getInt(0));

        TextView name = findViewById(R.id.tv_nom);
        name.setText(name.getText() +  " " + resultQuery.getString(1));

        TextView lastname = findViewById(R.id.tv_prenom);
        lastname.setText(lastname.getText() +  " " + resultQuery.getString(2));
    }

}