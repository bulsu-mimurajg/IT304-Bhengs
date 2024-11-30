<link rel="stylesheet" href="./assets/css/userinfo.css">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>

    <link rel="stylesheet" href="./assets/css/1.css">
    
</head>
<body>
    <div class="navbar">
        <div class="right">
            <img src="./assets/img/3.png" alt="" class="logo">
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


    <div class="sidebar1" id="userside">
        <a href="Userinfo.php" class="active">Account Info</a>
        <a href="Orders.php">Orders</a>
        <a href="Transactions.php">Transaction</a>
        <a href="#" class="logout1">Log out</a>
    </div>


    <div class="main-content">
        <div class="profile-container">
            <h2>Account Info</h2>
            <div class="details-container">
                <p><strong>First Name:</strong> Fname</p>
                <p><strong>Surname:</strong> Lname</p>
                <p><strong>Contact No:</strong> 123456789</p>
                <p><strong>Address:</strong> Place</p>
                <p><strong>Email Address:</strong> name@example.com</p>
            </div>
            
            <button class="edit-button" onclick="gotoEditForm()">Edit Profile</button>
        </div>   
        <script>
            function gotoEditForm() {
                window.location.href = 'EditUserinfo.php';
            }
        </script>
        </div>
    </div>
</body>

</html>

<!-- <script src="assets/js/proj.js"></script> -->
