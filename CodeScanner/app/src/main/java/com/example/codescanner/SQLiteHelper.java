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
                "name VARCHAR(255), " +
                "lastname VARCHAR(255))");
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS Utilisateurs");
        onCreate(db);
    }

    public Cursor getUsers(int id){
        SQLiteDatabase db = this.getWritableDatabase();

        Cursor res = db.rawQuery("select id, name, lastname from Utilisateurs WHERE id ="+id,null);

        return res;
    }

    public void setInfos() {
        SQLiteDatabase db = this.getWritableDatabase();

        db.execSQL("INSERT into UTILISATEURS (name, lastname) VALUES ('tom', 'tam')");
    }
}