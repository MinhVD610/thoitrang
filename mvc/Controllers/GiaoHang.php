<?php
    class GiaoHang extends controller
    {
        function show()
        {
            self::view("master",[
                "page" => "GiaoHang",
                "title" => "Giao Hàng & Đổi Hàng"
            ]);
        }
    }
