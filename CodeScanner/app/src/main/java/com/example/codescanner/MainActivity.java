package com.example.codescanner;

import androidx.annotation.NonNull;
import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import android.Manifest;
import android.annotation.SuppressLint;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Build;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.budiyev.android.codescanner.CodeScanner;
import com.budiyev.android.codescanner.CodeScannerView;
import com.budiyev.android.codescanner.DecodeCallback;
import com.google.zxing.Result;

@SuppressLint("NewApi")
public class MainActivity extends AppCompatActivity {
    private CodeScanner mCodeScanner;
    private static final int MY_CAMERA_REQUEST_CODE = 100;
    private Button btn_test;

    SQLiteHelper myDb;
    Cursor resultQuery;

    // Demande de permission
    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == MY_CAMERA_REQUEST_CODE) {
            if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                Toast.makeText(this, "Camera permission granted", Toast.LENGTH_LONG).show();
            } else {
                Toast.makeText(this, "Camera permission denied", Toast.LENGTH_LONG).show();
            }
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        myDb = new SQLiteHelper(this);
        //myDb.setInfos();

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        CodeScannerView scannerView = findViewById(R.id.scanner_view);
        mCodeScanner = new CodeScanner(this, scannerView);

        // Demande d'utilisation de caméra, si la permission a été accordé
        if (checkSelfPermission(Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {
            requestPermissions(new String[]{Manifest.permission.CAMERA}, MY_CAMERA_REQUEST_CODE);
        }

        // Decode puis affiche le message dans un Toast
        mCodeScanner.setDecodeCallback(new DecodeCallback() {
            @Override
            public void onDecoded(@NonNull final Result result) {
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {

                        Cursor test = myDb.getUsers(Integer.parseInt(result.getText()));

                            if (test.getCount() == 0) {
                                Toast.makeText(MainActivity.this, "Ce n'est pas un client de LoyaltyCard !", Toast.LENGTH_SHORT).show();
                                //Toast.makeText(MainActivity.this, "Decode "+result.getText() +"|"+ "Db "+resultQuery.getString(0), Toast.LENGTH_SHORT).show();
                            } else {
                                Toast.makeText(MainActivity.this, "Client d'Id n°"+result.getText(), Toast.LENGTH_SHORT).show();
                                Intent i = new Intent(MainActivity.this,InfoActivity.class);
                                i.putExtra("id", Integer.parseInt(result.getText()));
                                startActivity(i);
                            }

                    }
                });
            }
        });
        scannerView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mCodeScanner.startPreview();
            }
        });

    }

    // Enlève la pause avec interraction avec l'app
    @Override
    protected void onResume() {
        super.onResume();
        mCodeScanner.startPreview();
    }

    // Mets en pause l'app une fois un code scanner
    @Override
    protected void onPause() {
        mCodeScanner.releaseResources();
        super.onPause();
    }

}