
<dive class="Main">
    
    <section class="section__1">
        <i class="fa-solid fa-angle-left left left__Banner"></i>

        <div class="section__1--slide">
            <div class="slide--subItem">
                <div class="section__1--Title">
                    
                </div>
            </div>
            <div class="slide--subItem">
                <div class="section__1--Title">
                  
                </div>
            </div>
            <div class="slide--subItem">
                <div class="section__1--Title">
                  
                </div>
            </div>
        </div>

        <i class="fa-solid fa-angle-right right right__Banner"></i>
    </section>

    <input type="checkbox" id="modal-cart__overplay" class="modal-cart__Input">
    <input type="checkbox" id="quickView__overplay" class="quickView__Input">

    <label for="modal-cart__overplay" class="cart-overplay"></label>
    <label for="quickView__overplay" class="quickView-overplay"></label>

    <input hidden checked="true" type="checkbox" id="check-event">
    <label for="check-event" class="label-event"></label>

    <div class="event">
        <i class="fa-regular fa-circle-xmark close-banner__event"></i>
        <img class="event-image" src="" alt="" >
    </div>

    <div class="modal-cart"></div>

    <div class="quickView"></div>

    <div class="notifyFavourite"></div>

    <section class="section__2">
        <div class="section__2__Brand">
            <div class="section__2__Brand__Name Title__All">
                <div class="Title__Name">
                    <span>Thời Trang</span>
                    <h2>BRAND</h2>
                </div>
            </div>

            <div class="section__2__Brand__Contain">

                <i class="fa-solid fa-angle-left left leftBrand"></i>

                <div class="Iteams__Brand">
                    <div class="subItem__Brand">
                        <img src="./Public/image/br1.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/br2.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/br3.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/br4.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/br55.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/br6.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/b7.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/br8.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/br9.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/br8.png.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/br11.png"
                            alt="">
                    </div>
                    <div class="subItem__Brand">
                        <img src="./Public/image/br12.png"
                            alt="">
                    </div>
                </div>

                <i class="fa-solid fa-angle-right right rigthBrand"></i>

            </div>
        </div>
    </section>

   
            <div class="section__3__Contain__Right">
                <i class="fa-solid fa-angle-left left left__Sale"></i>

                <div class="Contain__ProductSale Contain__ProductSale--Mobile">
                    <?php
                    while ($row =  mysqli_fetch_array($data['product'])) {
                        $giaGiam = $row["giaSP"] * ($row["giaGiam"] / 100);
                        $total = $row["giaSP"] - $giaGiam;
                    ?>
                    <div class="prodDuct__sale prodDuct__sale--PageMain">
                        <div class="User__Choose">
                            <div class="Choose User__Choose__Cart">
                                <a data-value='<?php echo $row["IDSP"] ?>'
                                    data-size='<?php echo $row["size"] ?>'
                                    class='Cart--shopping'>
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </div>

                            <div class="Choose User__Choose__Look">
                                <a data-idsp='<?php echo $row["IDSP"] ?>'
                                    class='Cart--Look'>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </div>
                            <div class="Choose User__Choose__Love">
                                <a data-id="<?php echo $row["IDSP"] ?>"
                                    class="choose--Love">
                                    <i class="fa-solid fa-heart"></i>
                                </a>
                            </div>
                        </div>
                        <?php
                            if ($row["giaGiam"] > 0) { ?>
                        <div id="total__Sale--Hot" class="total__Sale">
                            <?php echo $row["giaGiam"]; ?>%</div>
                        <?php } ?>

                        <div class="product-Contain">
                            <div class="product-Contain__Image">
                                <a
                                    href="ChiTietSanPham&IDLoai=<?php echo $row["IDLoai"] ?>&ID=<?php echo $row["IDSP"] ?>">
                                    <img class="prodDuct__sale__Image"
                                        src="<?php echo $row['image'] ?>" alt="">
                                </a>
                            </div>

                            <div class="product-Contain__Content">
                                <a class="product-Contain__Content--Top"
                                    href="ChiTietSanPham&IDLoai=<?php echo $row["IDLoai"] ?>&ID=<?php echo $row["IDSP"] ?>">
                                    <?php echo $row['tenSP'] ?>
                                </a>
                                <div
                                    class="product__Total product-Contain__Content--Bottom">
                                    <div class="reduce__Price">
                                        <?php echo number_format($total, 0, ',', '.'); ?><span
                                            class="total">đ</span></div>
                                    <?php
                                        if ($row["giaGiam"] > 0) { ?>
                                    <div class="original__price">
                                        <?php if ($row["giaGiam"] > 0) {
                                                    echo number_format($row['giaSP'], 0, ',', '.');
                                                } ?><span class="total">đ</span></div>
                                    <?php } ?>
                                </div>

                                <div class="product-Contain__Review">
                                    <div class="stars">
                                        <input checked=true
                                            class='star-show star-show__Review star-show-0'
                                            id='star-show-0' type='radio' />
                                        <label
                                            class='star-show star-show__Review star-show-0'
                                            for='star-show-0'></label>
                                        <input checked=true
                                            class='star-show star-show__Review star-show-1'
                                            id='star-show-1' type='radio' />
                                        <label
                                            class='star-show star-show__Review star-show-1'
                                            for='star-show-1'></label>
                                        <input checked=true
                                            class='star-show star-show__Review star-show-2'
                                            id='star-show-2' type='radio' />
                                        <label
                                            class='star-show star-show__Review star-show-2'
                                            for='star-show-2'></label>
                                        <input checked=true
                                            class='star-show star-show__Review star-show-3'
                                            id='star-show-3' type='radio' />
                                        <label
                                            class='star-show star-show__Review star-show-3'
                                            for='star-show-3'></label>
                                        <input checked=true
                                            class='star-show star-show__Review star-show-4'
                                            id='star-show-4' type='radio' />
                                        <label
                                            class='star-show star-show__Review star-show-4'
                                            for='star-show-4'></label>
                                    </div>
                                    <div class="amount-Stars">
                                        <?php
                                            foreach ($data["star"] as $item) {
                                                if ($row["ID"] == $item["IDSP"]) { ?>
                                        <p>( <?php echo $item["amountStar"] ?> )</p>
                                        <?php }
                                            } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <i class="fa-solid fa-angle-right right right--new right__Sale"></i>
            </div>
        </div>
    </section>
   

    <section class="section__5">
        <div class="section__5__Contain">
            <div class="Title__All Title__All--title">
                <div class="Title__Name">
                    <span>Khuyến mãi</span>
                    <h2>FLASH SALE</h2>
                </div>
            </div>

            <div class="section__5__Product__Sale">
                <div class="section__5__Items section__7__Items">
                    <i class="fa-solid fa-angle-left left product__Left"></i>
                    <div class="Item__Sale">
                        <?php
                        while ($row =  mysqli_fetch_array($data['productSale'])) {
                            $giaGiam = $row["giaSP"] * ($row["giaGiam"] / 100);
                            $total = $row["giaSP"] - $giaGiam;
                        ?>
                        <div class="prodDuct__sale proDuct__Lenght">
                            <div class="User__Choose">
                                <div class="Choose User__Choose__Cart">
                                    <a data-value='<?php echo $row["IDSP"] ?>'
                                        data-size='<?php echo $row["size"] ?>'
                                        class='Cart--shopping'>
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </a>
                                </div>

                                <div class="Choose User__Choose__Look">
                                    <a data-idsp='<?php echo $row["IDSP"] ?>'
                                        class='Cart--Look'>
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                </div>
                                <div class="Choose User__Choose__Love">
                                    <a class='choose--Love'
                                        data-id='<?php echo $row["IDSP"] ?>'>
                                        <i class="fa-solid fa-heart"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="total__Sale total__Sale--newTotal">
                                <?php echo $row["giaGiam"] . "%" ?></div>

                            <div class="product-Contain product-Contain__Sale">
                                <div class="product-Contain__Image">
                                    <a
                                        href="ChiTietSanPham&IDLoai=<?php echo $row["IDLoai"] ?>&ID=<?php echo $row["IDSP"] ?>">
                                        <img class="prodDuct__sale__Image prodDuct__sale__Image--sale prodDuct__sale__Image--new"
                                            src="<?php echo $row['image'] ?>" alt="">
                                    </a>
                                </div>

                                <div class="product-Contain__Content">
                                    <a class="product-Contain__Content--Top"
                                        href="ChiTietSanPham&IDLoai=<?php echo $row["IDLoai"] ?>&ID=<?php echo $row["IDSP"] ?>">
                                        <?php echo $row['tenSP'] ?>
                                    </a>

                                    <div class="product__Total">
                                        <div class="reduce__Price">
                                            <?php echo number_format($total, 0, ',', '.'); ?><span
                                                class="total">đ</span>
                                        </div>
                                        <div class="original__price">
                                            <?php echo number_format($row['giaSP'], 0, ',', '.'); ?><span
                                                class="total">đ</span></div>
                                    </div>

                                    <div class="product-Contain__Review">
                                        <div class="stars">
                                            <input checked=true
                                                class='star-show star-show__Review star-show-0'
                                                id='star-show-0' type='radio' />
                                            <label
                                                class='star-show star-show__Review star-show-0'
                                                for='star-show-0'></label>
                                            <input checked=true
                                                class='star-show star-show__Review star-show-1'
                                                id='star-show-1' type='radio' />
                                            <label
                                                class='star-show star-show__Review star-show-1'
                                                for='star-show-1'></label>
                                            <input checked=true
                                                class='star-show star-show__Review star-show-2'
                                                id='star-show-2' type='radio' />
                                            <label
                                                class='star-show star-show__Review star-show-2'
                                                for='star-show-2'></label>
                                            <input checked=true
                                                class='star-show star-show__Review star-show-3'
                                                id='star-show-3' type='radio' />
                                            <label
                                                class='star-show star-show__Review star-show-3'
                                                for='star-show-3'></label>
                                            <input checked=true
                                                class='star-show star-show__Review star-show-4'
                                                id='star-show-4' type='radio' />
                                            <label
                                                class='star-show star-show__Review star-show-4'
                                                for='star-show-4'></label>
                                        </div>
                                        <div class="amount-Stars">
                                            <?php
                                                foreach ($data["star"] as $item) {
                                                    if ($row["ID"] == $item["IDSP"]) { ?>
                                            <p>( <?php echo $item["amountStar"] ?> )</p>
                                            <?php }
                                                }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php    } ?>
                    </div>

                    <i class="fa-solid fa-angle-right right product__Right"></i>

                </div>
            </div>
        </div>
    </section>

    
   


    <section class="section__8">
        <div class="section__8__News">
            <div class="Title__All Title__All--title">
                <div class="Title__Name">
                    <span>Hữu ích</span>
                    <h2>BLOG TIPS & HINT</h2>
                </div>
            </div>
            <i class="fa-solid fa-angle-left newLeft"></i>

            <div class="section__8__News__Contain">
                <div class="Contain__New">
                    <?php
                    foreach ($data["news"] as $item) { ?>
                    <div class="NewItem">
                        <div class="NewItem__Image">
                            <a href="">
                                <img src="<?php echo $item["image"] ?>" alt="">
                            </a>
                        </div>
                        <div class="NewItem__Content">
                            <h3><a href=""><?php echo $item["title"] ?></a></h3>
                            <span><?php echo $item["date_at"] ?></span>
                            <p><?php echo $item["content"] ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <i class="fa-solid fa-angle-right newRight "></i>
        </div>
    </section>

    <section class="section__11">
        <div class="section__11__AboutUs">
            <div class="Title__All Title__All--title">
                <div class="Title__Name">
                    <span>Về Chúng Tôi</span>
                    <h2>VIETSTALL</h2>
                </div>
            </div>

            <div class="About">
                <div class="About_slider">
                    <div class="About_item">
                        <div class="About_item-desc">
                            <p></p>
                        </div>
                        <img src="https://bizweb.dktcdn.net/100/302/551/themes/758295/assets/testimonial1.jpg?1699007615400"
                            alt="">
                        <div class="About_item-title">
                            <h4>Đạt 100.000+ khách hàng</h4>
                        </div>
                    </div>

                    <div class="About_item">
                        <div class="About_item-desc">
                            <p></p>
                        </div>
                        <img src="https://bizweb.dktcdn.net/100/302/551/themes/758295/assets/testimonial3.jpg?1699007615400"
                            alt="">
                        <div class="About_item-title">
                            <h4>10 năm hoạt động</h4>
                        </div>
                    </div>

                    <div class="About_item">
                        <div class="About_item-desc">
                            <p></p>
                        </div>
                        <img src="https://bizweb.dktcdn.net/100/302/551/themes/758295/assets/testimonial2.jpg?1699007615400"
                            alt="">
                        <div class="About_item-title">
                            <h4>15 Cửa hàng toàn quốc</h4>
                        </div>
                    </div>

                    <ul class="dots">
                        <li class="dots_active"></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section__12">
        <div class="section__12__Follow">
            <div class="Title__All Title__All--title">
                <div class="Title__Name">
                    <span>Follow On Instagram</span>
                   
                </div>
            </div>
            <div class="Follow">
                <div class="Follow_item">
                    <div class="Follow_item_img">
                        <img src="./Public/image/q1.png"
                            alt="">
                    </div>
                    <div class="Follow_item_img">
                    <img src="./Public/image/q2.png"
                            alt="">
                    </div>
                    <div class="Follow_item_img">
                    <img src="./Public/image/q3.png"
                            alt="">
                    </div>
                    <div class="Follow_item_img">
                    <img src="./Public/image/q4.png"
                            alt="">
                    </div>
                    <div class="Follow_item_img">
                    <img src="./Public/image/q5.png"
                            alt="">
                    </div>
                    <div class="Follow_item_img">
                    <img src="./Public/image/q6.png"
                            alt="">
                    </div>
                    <div class="Follow_item_img">
                    <img src="./Public/image/q7.png"
                            alt="">
                    </div>
                    <div class="Follow_item_img">
                    <img src="./Public/image/q8.png"
                            alt="">
                    </div>
                    <div class="Follow_item_img">
                    <img src="./Public/image/q9.png"
                            alt="">
                </div>
            </div>


        </div>
    </section>
    

    <section class="section__10">
        <div class="section__10__Support">
            <div class="Support">
                <div>
                    <i class="fa-solid fa-truck-moving"></i>
                </div>
                <div class="Support__Content">
                    <h3>MIỄN PHÍ VẬN CHUYỂN</h3>
                    <p>Nhận hàng trong vòng 3 ngày</p>
                </div>
            </div>

            <div class="Support">
                <div>
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <div class="Support__Content">
                    <h3>CHẤT LƯỢNG ĐẢM BẢO</h3>
                    <p>Top 10 thương hiệu uy tín 2017</p>
                </div>
            </div>

            <div class="Support">
                <div>
                    <i class="fa-solid fa-headphones-simple"></i>
                </div>
                <div class="Support__Content">
                    <h3>HỖ TRỢ 24/7</h3>
                    <p>Gọi điện - Zalo - iMessage - SMS</p>
                </div>
            </div>

            <div class="Support">
                <div>
                    <i class="fa-solid fa-rotate-left"></i>
                </div>
                <div class="Support__Content">
                    <h3>ĐỔI TRẢ DỄ DÀNG</h3>
                    <p>Trả lại hàng nếu không ưng ý</p>
                </div>
            </div>
        </div>
    </section>
</dive>