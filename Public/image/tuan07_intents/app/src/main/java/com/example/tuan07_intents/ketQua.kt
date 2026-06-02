package com.example.tuan07_intents

import android.annotation.SuppressLint
import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.tuan07_intents.databinding.ActivityKetQuaBinding

@SuppressLint("StaticFieldLeak")
private lateinit var binding: ActivityKetQuaBinding

class ketQua : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityKetQuaBinding.inflate(layoutInflater)
        enableEdgeToEdge()
        setContentView(binding.root)
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        //get du lieu tu intents
        val i = intent
        val bundle = i.extras
        if (bundle != null) {
            val kq = bundle.getInt("ketQua")
            binding.edtKQ.setText(kq.toString())
        }


        binding.btnReturn.setOnClickListener {
            val i2 = Intent(this, MainActivity::class.java)
            Toast.makeText(this, "Thuc hien thanh cong phep toan!", Toast.LENGTH_LONG).show()
            startActivity(i2)
        }
    }
}