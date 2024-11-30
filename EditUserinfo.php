
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="stylesheet" href="assets/css/1.css">
<link rel="stylesheet" href="assets/css/userinfo.css">

    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    
   

<body>
    
    <div class="navbar">
        <div class="right">
            <img src="./assets/img/3.png" alt="" class="logo">
            <ul>
                <li><a href="allMenu.php">All</a></li>
                <li><a href="koreanMenu.php">Korean</a></li>
                <li><a href="filipinoMenu.php">Filipino</a></li>
            </ul>
        </div>
        <div class="left">
            <button id="cartButton" class="iconbtn"><i class="ri-shopping-cart-line"></i></button>
            <button class="iconbtn"><i class="ri-user-line"></i></button>
        </div>
    </div>

    <div class="sidebar1" id="userside">
        <a href="Userinfo.php" class="active">Account Info</a>
        <a href="Orders.php">Orders</a>
        <a href="Transactions.php">Transaction</a>
        <a href="#" class="logout1">Log out</a>
    </div>


    <div class="main-content">
        <div class="form-container">
            <h2>Account Info</h2>
            <form>
                <div class="form-row side-by-side">
                    <div class="form-group">
                        <label for="surname">Surname:</label>
                        <input type="text" id="surname" name="surname" placeholder="Enter surname">
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" placeholder="Enter first name">
                    </div>
                </div>

                <label for="contact-no">Contact No.:</label>
                <input type="text" id="contact-no" name="contact-no" placeholder="Enter contact no.">

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter address">

                <label for="email">E-mail Address:</label>
                <input type="email" id="email" name="email" placeholder="Enter email">

               
                <button type="button" onclick="BackToUserInfo()">back</button>
                <script>
                        function BackToUserInfo(){
                            window.location.href = 'userinfo.php';
                        }
                </script>
                 <button type="submit">save</button> 
            </form>
        </div>
    </div>
    </body>