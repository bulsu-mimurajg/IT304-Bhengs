
 <?php   
  echo '<link rel="stylesheet" href="./assets/css/1.css">'
 ?>  
   <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />

<body>

    <div class="main">
        <div class="navbar">
            <div class="right">
                <img src="./assets/img/3.png" alt="" class="logo">
                <ul>
                <li><a href="allMenu.php">All</a></li>
                    <li><a href="koreanMenu.php">Korean</a></li>
                    <li><a href="filipinoMenu.php" class="highlightbtn">Filipino</a></li>
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


                <!-- FILIPINO -->

                <div class="Container">
                   
                    <span class="label">BILAO SPECIALS</span>
        
                    <div class="menubox">
        
                        <img src="./assets/img/palabok.jpg" alt="Product Image">
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
        
                                <img src="./assets/img/palabok.jpg" alt="Product Image">
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
        
                                        <img src="./assets/img/malabon.jpg" alt="Product Image">
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
                    
                                    <img src="./assets/img/maja.jpg" alt="Product Image">
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
                    
                                            <img src="./assets/img/sapin.jpg" alt="Product Image">
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
                    
                                                    <img src="./assets/img/pichi.jpg" alt="Product Image">
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


    <script src="./assets/js/proj.js"></script>
</body>
