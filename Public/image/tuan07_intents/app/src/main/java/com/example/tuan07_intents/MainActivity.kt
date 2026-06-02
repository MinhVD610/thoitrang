package com.example.tuan07_intents

import android.annotation.SuppressLint
import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.tuan07_intents.databinding.ActivityMainBinding

@SuppressLint("StaticFieldLeak")
private lateinit var binding: ActivityMainBinding

class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        enableEdgeToEdge()
        setContentView(binding.root)
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        binding.btnGo.setOnClickListener {
            val i = Intent(this, ketQua::class.java)
            var soA: Int
            var soB: Int

            try {
                soA = binding.edtSoA.text.toString().toInt()
                soB = binding.edtSoB.text.toString().toInt()
            } catch (e: NumberFormatException) {
                Toast.makeText(this, "Vui lòng nhập số hợp lệ", Toast.LENGTH_SHORT).show()
                return@setOnClickListener
            }

            val kq = soA + soB
            val bundle = Bundle()
            bundle.putInt("ketQua", kq)
            i.putExtras(bundle)
            startActivity(i)
        }
    }
}