package com.example.codescanner;

import android.annotation.SuppressLint;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.widget.TextView;

import java.util.ArrayList;

public class SQLiteHelper extends SQLiteOpenHelper {
    public static final String DATABASE_NAME = "loyaltycard.db";

    public SQLiteHelper(Context context) {
        super(context, DATABASE_NAME, null, 1);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL("create table if not exists Utilisateurs(" +
                "id INTEGER PRIMARY KEY AUTOINCREMENT," +
                "hash_id VARCHAR(255)," +
                "nom VARCHAR(255), " +
                "prenom VARCHAR(255))");
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS Utilisateurs");
        onCreate(db);
    }

    public Cursor getUsers(String id){
        SQLiteDatabase db = this.getWritableDatabase();

        Cursor res = db.rawQuery("select id, nom, prenom from Utilisateurs WHERE hash_id ='"+id+"'",null);

        return res;
    }

    public void setInfos() {
        SQLiteDatabase db = this.getWritableDatabase();

        onUpgrade(db, 0, 1);

        db.execSQL("INSERT into UTILISATEURS (id, hash_id, nom, prenom) VALUES (7, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', 'Vandevoorde', 'Tanguy')");
    }
}