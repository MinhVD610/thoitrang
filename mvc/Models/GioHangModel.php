<?php
    class GioHangModel extends Database
    {
        function increaseCart($IDKH, $IDSP,$amount,$size, $dateIncrease, $status)
        {
            $queryProduct = "SELECT * FROM sanpham as sp join giamgia as gg on gg.IDSP = sp.ID WHERE sp.ID = '".$IDSP."' GROUP BY sp.ID";
            
            $result = mysqli_query(self::$connect,$queryProduct);
            
            $total = 0;

            while ($row = mysqli_fetch_array($result))
            {
                $reduce = $row["giaSP"] - ($row["giaSP"] * ($row["giaGiam"] * 0.01));
                $total = $amount * $reduce;
            }
            
            $checkProduct = $this->checkProductInCart($IDKH,$IDSP);

            if(!empty($checkProduct) && $checkProduct["status"] == 1)
            {
                $total = ($checkProduct["soLuong"] + $amount) * $reduce;

                $query = "UPDATE giohang SET soLuong = '".($checkProduct["soLuong"] + $amount)."', tongTien = '".$total."' WHERE IDSP = '".$IDSP."' AND IDKH = '".$IDKH."' AND status = 1";
            }
            else 
            {
                $query = "INSERT INTO `giohang`(`IDKH`, `IDSP`, `soLuong`, `size`, `tongTien`, `thoiGian`,`status`) 
                VALUES ('".$IDKH."','".$IDSP."','".$amount."', '".$size."' ,'".$total."','".$dateIncrease->format('Y-m-d H:i:s')."','".$status."')";
            }
 
            mysqli_query(self::$connect,$query);
        }


        function checkProductInCart($IDKH, $IDSP)
        {   
            $query = "SELECT * FROM giohang WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' ORDER BY id DESC LIMIT 1";

            $result = mysqli_query(self::$connect, $query);

            $numRow = mysqli_fetch_assoc($result);

            return $numRow;
        }

        function loadCart($IDKH)
        {
            $query = "SELECT gh.ID,gh.IDKH,gh.IDSP,sp.IDLoai,br.tenBrand,sp.image,sp.tenSP,
                             gh.tongTien as total, gg.giaGiam,sp.giaSP,gh.size,gh.thoiGian,
                             sum(gh.soLuong) as soLuong, sum(gh.tongTien) as tongTien 
                      FROM giohang as gh 
                      join sanpham as sp on gh.IDSP = sp.ID 
                      join giamgia as gg on gg.IDSP = sp.ID
                      join brand as br on sp.IDBrand = br.ID
                      where IDKH = '".$IDKH."' && gh.status = 1
                      GROUP BY gh.IDSP";

            $result = mysqli_query(self::$connect,$query);
            $arr = array();

            while($rows = mysqli_fetch_array($result))
            {
                $arr[] = $rows;
            }

            return json_encode($arr);
        }

        function updateCart($IDCart,$amount,$IDKH,$IDSP)
        {
            $querySP = "SELECT * FROM `giohang` as gh 
                        join sanpham as sp on gh.IDSP = sp.ID 
                        join giamgia as gg on gg.IDSP = sp.ID
                        WHERE gg.IDSP = '".$IDSP."'
                        GROUP BY gh.IDSP";

            $result = mysqli_query(self::$connect,$querySP);
            $total = "";

            while ($row = mysqli_fetch_array($result))
            {
                $reduce = $row["giaSP"] - ($row["giaSP"] * ($row["giaGiam"] * 0.01));
                $total = $amount * $reduce;
            }

            $query = "UPDATE giohang SET soLuong = '".$amount."', tongTien = '".$total."' WHERE ID = '".$IDCart."' AND IDKH = '".$IDKH."'";

            mysqli_query(self::$connect,$query);
        }

        function deleteCart($IDSP,$IDKH,$status)
        {
            // $query = "DELETE FROM `giohang` WHERE IDSP = '".$IDSP."' AND IDKH = '".$IDKH."'";

            $query = "UPDATE giohang SET status = '".$status."' WHERE IDSP = '".$IDSP."' AND IDKH = '".$IDKH."'";
            mysqli_query(self::$connect,$query);
        }

        // UNDO ITEM

        function undoItem($IDKH){
            // Tổng của thằng status 0
            $sumQuantity = 0;
            // Tổng status 0 + status 1
            $maxSumQuantity = 0;
            $IDProducts = $this->getIDProducts($IDKH); // Lấy tất cả IDSP với status = 0

            // Vì không lấy được IDSP trên user nên phải truy vấn ra từ thằng IDKH để lấy được từng IDSP của khác hàng đó

            foreach ($IDProducts as $IDSP) {
                // Lấy ra tổng số lượng của mấy thằng status = 0
                $queryQuantity = "SELECT SUM(soluong) as sumSoLuong FROM giohang WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' AND status = 0";
                $resultQuantity = mysqli_query(self::$connect, $queryQuantity);
                $rowQuantity = mysqli_fetch_assoc($resultQuantity);
                $sumQuantity = $rowQuantity['sumSoLuong'];
                $checkStatusItem = $this->checkStatusItem($IDKH,$IDSP);

                // Lấy ra số lượng của thằng có status = 1 để tính maxSumQuantity
                $queryProduct = "SELECT soluong FROM giohang WHERE IDSP = '".$IDSP."' AND IDKH = '".$IDKH."' AND status = 1";
                $resultProduct = mysqli_query(self::$connect, $queryProduct);
                $rowProduct = mysqli_fetch_assoc($resultProduct);

                // maxSumQuantity là TỔNG số lượng của thằng status 1 với status 0
                $maxSumQuantity = $sumQuantity + (isset($rowProduct['soluong']) ? $rowProduct['soluong'] : 0);
                
                // giỏ hàng không có thằng nào trùng với thằng xóa mềm
                if (empty($checkStatusItem)) {
                    $updateQuery = "UPDATE giohang SET soluong = '".$sumQuantity."', status = 1 WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' AND status = 0 LIMIT 1";
                    $deleteQuery = "DELETE FROM giohang WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' AND status = 0";
                } else {
                    // giỏ hàng có thằng trùng với thằng xóa mềm
                    $updateQuery = "UPDATE giohang SET soluong = '".$maxSumQuantity."' WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' AND status = 1 LIMIT 1";
                    $deleteQuery = "DELETE FROM giohang WHERE IDKH = '".$IDKH."' AND IDSP = '".$IDSP."' AND status = 0";               
                }
                mysqli_query(self::$connect, $updateQuery);
                mysqli_query(self::$connect, $deleteQuery);

                // reset số lượng
                $sumQuantity = 0;
                $maxSumQuantity = 0;
            }
        }

        function checkStatusItem($IDKH, $IDSP){
            $query = "SELECT * FROM giohang WHERE IDSP = '".$IDSP."' AND IDKH = '".$IDKH."' AND status = 1";

            $result = mysqli_query(self::$connect, $query);

            $numRow = mysqli_fetch_assoc($result);

            return $numRow;
        }

        function getIDProducts($IDKH){
            $query = "SELECT IDSP FROM giohang WHERE status = 0 AND IDKH = '".$IDKH."'";
            $result = mysqli_query(self::$connect, $query);
            $idArray = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $idArray[] = $row['IDSP'];
            }

            return $idArray;
        }

        function placeAnOrder($IDKH, $methodPay, $name, $address, $phone, $email, $noted, $IDSP, $reduce, $totalPrice)
        {
            $dateOrder = new DateTime();

            $insertDH = "INSERT INTO `donhang`(`IDKH`, `ngayDat`, `tinhTrang`, `phiGD`, `giamGia` , `tongTien`) 
            VALUES ('".$IDKH."','".$dateOrder->format('Y-m-d H:i:s')."','Đang xử lý', 29000, '".$reduce."', '".$totalPrice."')";
            mysqli_query(self::$connect,$insertDH);

            $selectDH = "SELECT max(dh.ID) as ID from donhang as dh WHERE dh.IDKH = '".$IDKH."'";
            $resultInsertDH = mysqli_query(self::$connect,$selectDH);
            $rowInsertDH = mysqli_fetch_array($resultInsertDH);

            $IDDH = $rowInsertDH["ID"];

            $selectCart = "SELECT gh.ID,gh.IDKH,gh.IDSP,sp.IDLoai,br.tenBrand,sp.image,sp.tenSP,gh.tongTien as total, gg.giaGiam,sp.giaSP,gh.size,gh.thoiGian,sum(gh.soLuong) as soLuong, sum(gh.tongTien) as tongTien 
                           FROM `giohang` as gh 
                           join sanpham as sp on gh.IDSP = sp.ID 
                           join giamgia as gg on gg.IDSP = sp.ID
                           join brand as br on sp.IDBrand = br.ID
                           where IDKH = '".$IDKH."' and gh.status = 1 GROUP BY gh.IDSP";

            $resultCart = mysqli_query(self::$connect,$selectCart);

            $arrDH = array();

            while($rowCart = mysqli_fetch_array($resultCart))
            {
                $IDSP = $rowCart["IDSP"];
                $amount = $rowCart["soLuong"];
                $Size = $rowCart["size"];
                $totalDetailPrice = $rowCart["tongTien"];

                $insertDetailDH = "INSERT INTO `chitietdonhang`(`IDDH`, `IDSP`, `soLuong`, `Size`, `tongTien`, `cachThanhToan`, `ten`, `diaChi`, `sdt`, `email`, `ghiChu`) 
                VALUES ('".$IDDH."','".$IDSP."','".$amount."','".$Size."','".$totalDetailPrice."','".$methodPay."','".$name."','".$address."','".$phone."','".$email."','".$noted."')";
                mysqli_query(self::$connect,$insertDetailDH);

                $arrDH[] = $rowCart;
            }

            $query = "DELETE FROM `giohang` WHERE IDKH = '".$IDKH."' and status = 1";
            mysqli_query(self::$connect,$query);

            return json_encode($arrDH);
        }

    }
