<?php
    class Home extends controller
    {
        private $model;

        function __construct()
        {
            $this->model = $this->modelAdmin("HomeModel");
        }
        
        function show()
        {
            self::viewAdmin('master',[
                "page" => "Home",
            ]);
            
        }

        function changedAccount($IDKH, $Name)
{
    // Gọi hàm updateUserName để cập nhật tên người dùng
    $result = $this->model->updateUserName($IDKH, $Name);

    // Kiểm tra kết quả của hàm và thực hiện các xử lý phù hợp
    if ($result) {
        // Nếu cập nhật thành công, bạn có thể thực hiện các xử lý khác ở đây
    } else {
        // Nếu cập nhật không thành công, bạn có thể xử lý lỗi ở đây
    }
}

        function amountNewBills()
        {
            $result = $this->model->amountNewBills();

            echo $result;
        }

        function amountAccount()
        {
            $result = $this->model->amountAccount();

            echo $result;
        }

        function amountProductSelled()
        {
            $result = $this->model->amountProductSelled();

            echo $result;
        }

        function amountProduct()
        {
            $result = $this->model->amountProduct();

            echo $result;
        }
        
        function amountLogined()
        {
            $result = $this->model->amountLogined(); 

            echo $result;
        }

        function apiTopProductSellest()
        {
            $result = $this->model->apiTopProductSellest();
            
            echo $result;
        }
        
        function apiNewUser()
        {
            $result = $this->model->apiNewUser();
            
            echo $result; 
        }

        function productSelledOfMonth()
        {
            $result = $this->model->productSelledOfMonth();
            
            echo $result; 
        }

        function productDiscountOfMonth()
        {
            $result = $this->model->productDiscountOfMonth();
            
            echo $result; 
        }

        function revenueOfMonth()
        {
            $result = $this->model->revenueOfMonth();
            
            echo $result; 
        }

        function billOfMonth()
        {
            $result = $this->model->billOfMonth();
            
            echo $result; 
        }

        function topCustomerLoyal()
        {
            $result = $this->model->topCustomerLoyal();
            
            echo $result; 
        }

        function topCustomerRank()
        {
            $result = $this->model->topCustomerRank();
            
            echo $result; 
        }

        function chartProductSelled()
        {
            $result = $this->model->chartProductSelled();
            
            echo $result; 
        }

        function logOut()
        {
            if(isset($_SESSION["logined"]))
            {
                $this->model("TaiKhoanModel")->LogOut($_SESSION["email"]);

                unset($_SESSION["logined"]);
                unset($_SESSION["hoTen"]);
                unset($_SESSION["diachi"]);
                unset($_SESSION["sdt"]);
                unset($_SESSION["email"]);
            }
        }
    }
?>