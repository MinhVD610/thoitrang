<?php
    class Hinhthucthanhtoan extends controller
    {
        function show()
        {
            self::view("master",[
                "page" => "Hinhthucthanhtoan",
                "title" => "Hình Thức Thanh Toán"
            ]);
        }
    }
