
<

<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />

<link rel="stylesheet" href="assets/css/1.css">

<body>
    <div class="main">
        <div class="navbar">
            <div class="right">
                <img src="assets/img/3.png" alt="" class="logo">
                <ul>
                    <li><a href="allMenu.php" class="highlightbtn">All</a></li>
                    <li><a href="koreanMenu.php">Korean</a></li>
                    <li><a href="filipinoMenu.php">Filipino</a></li>
                </ul>
            </div>
            <div class="left">
                <button id="cartButton" class="iconbtn"  ><i class="ri-shopping-cart-line"></i></button>
                <button id="userBtn" class="iconbtn" ><i class="ri-user-line"></i></button>
            </div>
        </div>

        <div class="sidebar" id="userside">
            <a href="Userinfo.php" class="active">Account Info</a>
            <a href="Orders.php">Orders</a>
            <a href="Transactions.php">Transaction</a>
            <a href="#" class="logout">Log out</a>
        </div>
        
        <div class="cartside" id="cardside">
            <h1 class="txt">Add to Cart</h1>
            <ul class="carthead">
                <li>Qty</li>
                <li>Size</li>
                <li>Product</li>
                <li>Price</li>
            </ul>

            <div id="cartItems">

            </div>

            <p id="totalPrice">Total: ₱0.00</p>
            <button class="btn1">Place order</button>
        </div>

        <!-- KIMCHI  FAMILY -->
        <div class="Container">
            <span class="label">KIMCHI FAMILY </span>

            <div class="menubox">

                <img src="assets/img/radishkimchi.jpg" alt="Product Image">
                <h3>Radish Kimchi</h3>
                <p id="priceDisplay"> ₱95.00 </p>

                <div class="controls">

                    <div class="controlbox">
                        <div class="quant">


                            <div class="btnbox">
                                <button class="qty-btn" id="decrease">-</button>
                                <input type="text" class="qty-input" value="1">
                                <button class="qty-btn" id="increase">+</button>

                            </div>


                            
                        </div>
                    </div>



                    <button class="atcbtn">Add to Cart</button>
                </div>


            </div>

            <div class="menubox">

                <img src="assets/img/napa.jpg" alt="Product Image">
                <h3>Napa Kimchi</h3>
                <p id="priceDisplay"> ₱ 95.00 </p>

                <div class="controls">

                    <div class="controlbox">
                        <div class="quant">


                            <div class="btnbox">
                                <button class="qty-btn" id="decrease">-</button>
                                <input type="text" class="qty-input" value="1">
                                <button class="qty-btn" id="increase">+</button>

                            </div>


                           
                        </div>
                    </div>



                    <button class="atcbtn">Add to Cart</button>
                </div>


            </div>

            <div class="menubox">
                <img src="assets/img/sauce.jpg" alt="Product Image">
                <h3>Kimchi Sauce</h3>
                <p id="priceDisplay">₱ 95.00 </p>

                <div class="controls">

                    <div class="controlbox">
                        <div class="quant">
                            <div class="btnbox">
                                <button class="qty-btn" id="decrease">-</button>
                                <input type="text" class="qty-input" value="1">
                                <button class="qty-btn" id="increase">+</button>
                            </div>

                          
                        </div>
                    </div>
                </div>
                <button class="atcbtn">Add to Cart</button>
            </div>
        </div>



        <!-- Kimchi Combo -->

        <div class="Container">
            <span class="label">KIMCHI COMBO</span>

            <div class="menubox">
                <img src="assets/img/rice.jpg" alt="Product Image">
                <h3><span style="color: #e21d70;">KC1</span> Kimchi Rice</h3>
                <p id="priceDisplay">₱ 40.00 </p>

                <div class="controls">

                    <div class="controlbox">
                        <div class="quant">
                            <div class="btnbox">
                                <button class="qty-btn" id="decrease">-</button>
                                <input type="text" class="qty-input" value="1">
                                <button class="qty-btn" id="increase">+</button>
                            </div>

                         
                        </div>
                    </div>
                </div>
                <button class="atcbtn">Add to Cart</button>
            </div>


            <div class="menubox">
                <img src="assets/img/weggrice.jpg" alt="Product Image">
                <h3><span style="color: #e21d70;">KC2</span> Kimchi Rice w/ egg </h3>
                <p id="priceDisplay">₱ 75.00 </p>

                <div class="controls">

                    <div class="controlbox">
                        <div class="quant">
                            <div class="btnbox">
                                <button class="qty-btn" id="decrease">-</button>
                                <input type="text" class="qty-input" value="1">
                                <button class="qty-btn" id="increase">+</button>
                            </div>

                        </div>
                    </div>
                </div>
                <button class="atcbtn">Add to Cart</button>
            </div>


            <div class="menubox">
                <img src="assets/img/porkwegg.jpg" alt="Product Image">
                <h3><span style="color: #e21d70;">KC3</span> Pork Kimchi Rice w/egg</h3>
                <p id="priceDisplay">₱ 160.00 </p>

                <div class="controls">

                    <div class="controlbox">
                        <div class="quant">
                            <div class="btnbox">
                                <button class="qty-btn" id="decrease">-</button>
                                <input type="text" class="qty-input" value="1">
                                <button class="qty-btn" id="increase">+</button>
                            </div>

                         
                        </div>
                    </div>
                </div>
                <button class="atcbtn">Add to Cart</button>
            </div>

            <div class="container">

            </div>
           



        </div>

        <!-- BRB -->

        <div class="Container">
            <span class="label">KIMCHI RAMEN</span>

            <div class="menubox">
                <img src="assets/img/RAMEN.jpg" alt="Product Image">
                <h3>Kimchi Ramen </h3>
                <p id="priceDisplay">₱ 150.00 </p>

                <div class="controls">

                    <div class="controlbox">
                        <div class="quant">
                            <div class="btnbox">
                                <button class="qty-btn" id="decrease">-</button>
                                <input type="text" class="qty-input" value="1">
                                <button class="qty-btn" id="increase">+</button>
                            </div>

                            <select class="size" id="addons">
                                <option value="N/A" data-price="150">N/A</option>
                                <option value="Pork" data-price="190">Pork</option>
                                <option value="Beef" data-price="200">Beef</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="atcbtn">Add to Cart</button>
            </div>
            </div>

            

            <!-- BHENGS HOMEMADE SPECIALS -->

            <div class="Container">
                <span class="label">BHENGS HOMEMADE SPECIALS</span>
    
                <div class="menubox">
                    <img src="assets/img/product_k1.png" alt="Product Image">
                    <h3><span style="color: #e21d70;">BHS1</span> Pork</h3>
                    <p id="priceDisplay">₱ 220.00</p>
    
                    <div class="controls">
    
                        <div class="controlbox">
                            <div class="quant">
                                <div class="btnbox">
                                    <button class="qty-btn" id="decrease">-</button>
                                    <input type="text" class="qty-input" value="1">
                                    <button class="qty-btn" id="increase">+</button>
                                </div>
    
                               
                            </div>
                        </div>
                    </div>
                    <button class="atcbtn">Add to Cart</button>
                </div>

                <div class="menubox">
                    <img src="assets/img/product_k1.png" alt="Product Image">
                    <h3><span style="color: #e21d70;">BHS2</span> Beef</h3>
                    <p id="priceDisplay">₱ 235.00</p>
    
                    <div class="controls">
    
                        <div class="controlbox">
                            <div class="quant">
                                <div class="btnbox">
                                    <button class="qty-btn" id="decrease">-</button>
                                    <input type="text" class="qty-input" value="1">
                                    <button class="qty-btn" id="increase">+</button>
                                </div>
    
                
                            </div>
                        </div>
                    </div>
                    <button class="atcbtn">Add to Cart</button>
                </div>


                </div>


                <!-- TTEOKBOKI -->
                <!-- brb2 -->
                <div class="Container">
                    <span class="label">TTEOKBOKI FAMILY</span>
        
                    <div class="menubox">
                        <img src="assets/img/TTEOK.jpg" alt="Product Image">
                        <h3><span style="color: #e21d70;"></span>TTEOKBOKI</h3>
                        <p id="priceDisplay">₱ 80.00</p>
        
                        <div class="controls">
        
                            <div class="controlbox">
                                <div class="quant">
                                    <div class="btnbox">
                                        <button class="qty-btn" id="decrease">-</button>
                                        <input type="text" class="qty-input" value="1">
                                        <button class="qty-btn" id="increase">+</button>
                                    </div>
        
                                 
                                </div>
                            </div>
                        </div>
                        <button class="atcbtn">Add to Cart</button>
                    </div>

                    <div class="menubox">
                        <img src="assets/img/ODEN.jpg" alt="Product Image">
                        <h3><span style="color: #e21d70;"></span>ODENG/STICK</h3>
                        <p id="priceDisplay">₱ 50.00</p>
        
                        <div class="controls">
        
                            <div class="controlbox">
                                <div class="quant">
                                    <div class="btnbox">
                                        <button class="qty-btn" id="decrease">-</button>
                                        <input type="text" class="qty-input" value="1">
                                        <button class="qty-btn" id="increase">+</button>
                                    </div>
        
                                    
                                </div>
                            </div>
                        </div>
                        <button class="atcbtn">Add to Cart</button>
                    </div>


                    <div class="menubox">
                        <img src="assets/img/RABOK.jpg" alt="Product Image">
                        <h3><span style="color: #e21d70;"></span>RABOKKI</h3>
                        <p id="priceDisplay">₱ 150.00</p>
        
                        <div class="controls">
        
                            <div class="controlbox">
                                <div class="quant">
                                    <div class="btnbox">
                                        <button class="qty-btn" id="decrease">-</button>
                                        <input type="text" class="qty-input" value="1">
                                        <button class="qty-btn" id="increase">+</button>
                                    </div>
        
          
                                </div>
                            </div>
                        </div>
                        <button class="atcbtn">Add to Cart</button>
                    </div>

                    </div>


                    <div class="Container">
                        <span class="label">KIMBAP FAMILY</span>
            
                        <div class="menubox">
                            <img src="assets/img/kimbap.jpg" alt="Product Image">
                            <h3><span style="color: #e21d70;"></span>REGULAR KIMBAP</h3>
                            <p id="priceDisplay">₱ 140.00</p>
            
                            <div class="controls">
            
                                <div class="controlbox">
                                    <div class="quant">
                                        <div class="btnbox">
                                            <button class="qty-btn" id="decrease">-</button>
                                            <input type="text" class="qty-input" value="1">
                                            <button class="qty-btn" id="increase">+</button>
                                        </div>
            
                                      
                                    </div>
                                </div>
                            </div>
                            <button class="atcbtn">Add to Cart</button>
                        </div>

                        <div class="menubox">
                            <img src="assets/img/kimchibap.jpg" alt="Product Image">
                            <h3><span style="color: #e21d70;"></span>KIMCHI KIMBAP</h3>
                            <p id="priceDisplay">₱ 140.00</p>
            
                            <div class="controls">
            
                                <div class="controlbox">
                                    <div class="quant">
                                        <div class="btnbox">
                                            <button class="qty-btn" id="decrease">-</button>
                                            <input type="text" class="qty-input" value="1">
                                            <button class="qty-btn" id="increase">+</button>
                                        </div>
            
                                      
                                    </div>
                                </div>
                            </div>
                            <button class="atcbtn">Add to Cart</button>
                        </div>
                        </div>
          
            
            <div class="Container">
                <span class="label">SWEET BUTTERED GARLIC BABY POTATO</span>
    
                <div class="menubox">
    
                    <img src="assets/img/potato.webp" alt="Product Image">
                    <h3>Baby Potato</h3>
                    <p id="priceDisplay"> ₱100.00 </p>
    
                    <div class="controls">
    
                        <div class="controlbox">
                            <div class="quant">
    
    
                                <div class="btnbox">
                                    <button class="qty-btn" id="decrease">-</button>
                                    <input type="text" class="qty-input" value="1">
                                    <button class="qty-btn" id="increase">+</button>
    
                                </div>
    
    
                               
                            </div>
                        </div>
                        <button class="atcbtn">Add to Cart</button>
                    </div>
    
    
                </div>
                </div>
    

                <!-- FILIPINO -->

                <div class="Container">
                    <span class="label1">FILIPINO </span>
                    <span class="label">BILAO SPECIALS</span>
        
                    <div class="menubox">
        
                        <img src="assets/img/palabok.jpg" alt="Product Image">
                        <h3>Palabok</h3>
                        <p id="priceDisplay"> ₱280.00 </p>
        
                        <div class="controls">
        
                            <div class="controlbox">
                                <div class="quant">
        
        
                                    <div class="btnbox">
                                        <button class="qty-btn" id="decrease">-</button>
                                        <input type="text" class="qty-input" value="1">
                                        <button class="qty-btn" id="increase">+</button>
        
                                    </div>
        
        
                                    
                                </div>
                            </div>
                            </div>
                            <button class="atcbtn">Add to Cart</button>
                            </div>

                            <div class="menubox">
        
                                <img src="assets/img/palabok.jpg" alt="Product Image">
                                <h3>Pansit</h3>
                                <p id="priceDisplay"> ₱250.00 </p>
                
                                <div class="controls">
                
                                    <div class="controlbox">
                                        <div class="quant">
                
                
                                            <div class="btnbox">
                                                <button class="qty-btn" id="decrease">-</button>
                                                <input type="text" class="qty-input" value="1">
                                                <button class="qty-btn" id="increase">+</button>
                
                                            </div>
                
                
                                           
                                        </div>
                                    </div>
                                    </div>
                                    <button class="atcbtn">Add to Cart</button>
                                    </div>

                                    <div class="menubox">
        
                                        <img src="assets/img/malabon.jpg" alt="Product Image">
                                        <h3>Malabon</h3>
                                        <p id="priceDisplay"> ₱270.00 </p>
                        
                                        <div class="controls">
                        
                                            <div class="controlbox">
                                                <div class="quant">
                        
                        
                                                    <div class="btnbox">
                                                        <button class="qty-btn" id="decrease">-</button>
                                                        <input type="text" class="qty-input" value="1">
                                                        <button class="qty-btn" id="increase">+</button>
                        
                                                    </div>
                        
                        
                                                    
                                                </div>
                                            </div>
                                            </div>
                                            <button class="atcbtn">Add to Cart</button>
                                            </div>

                                           

                            </div>

                            <div class="Container">
                               
                                <span class="label">KAKANIN SPEICIALS</span>
                    
                                <div class="menubox">
                    
                                    <img src="assets/img/maja.jpg" alt="Product Image">
                                    <h3>Maja</h3>
                                    <p id="priceDisplay"> ₱350.00 </p>
                    
                                    <div class="controls">
                    
                                        <div class="controlbox">
                                            <div class="quant">
                    
                    
                                                <div class="btnbox">
                                                    <button class="qty-btn" id="decrease">-</button>
                                                    <input type="text" class="qty-input" value="1">
                                                    <button class="qty-btn" id="increase">+</button>
                    
                                                </div>
                    
                    
                                               
                                            </div>
                                        </div>
                                        </div>
                                        <button class="atcbtn">Add to Cart</button>
                                        </div>

                                        <div class="menubox">
                    
                                            <img src="assets/img/sapin.jpg" alt="Product Image">
                                            <h3>Sapin-Sapin</h3>
                                            <p id="priceDisplay"> ₱350.00 </p>
                            
                                            <div class="controls">
                            
                                                <div class="controlbox">
                                                    <div class="quant">
                            
                            
                                                        <div class="btnbox">
                                                            <button class="qty-btn" id="decrease">-</button>
                                                            <input type="text" class="qty-input" value="1">
                                                            <button class="qty-btn" id="increase">+</button>
                            
                                                        </div>
                            
                            
                                                        
                                                    </div>
                                                </div>
                                                </div>
                                                <button class="atcbtn">Add to Cart</button>
                                                </div>

                                                <div class="menubox">
                    
                                                    <img src="assets/img/pichi.jpg" alt="Product Image">
                                                    <h3>Pichi-Pichi</h3>
                                                    <p id="priceDisplay"> ₱300.00 </p>
                                    
                                                    <div class="controls">
                                    
                                                        <div class="controlbox">
                                                            <div class="quant">
                                    
                                    
                                                                <div class="btnbox">
                                                                    <button class="qty-btn" id="decrease">-</button>
                                                                    <input type="text" class="qty-input" value="1">
                                                                    <button class="qty-btn" id="increase">+</button>
                                    
                                                                </div>
                                    
                                    
                                                                
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <button class="atcbtn">Add to Cart</button>
                                                        </div>
                                                   
                                    </div>


    </div>


    <script src="assets/js/proj.js"></script>
</body>

