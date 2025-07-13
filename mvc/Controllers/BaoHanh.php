<?php
    class BaoHanh extends controller
    {
        function show()
        {
            self::view("master",[
                "page" => "BaoHanh",
                "title" => "Bảo Hành & Bảo Quản"
            ]);
        }
    }
