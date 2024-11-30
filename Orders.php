
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    
  <link rel="stylesheet" href="assets/css/1.css">
  <link rel="stylesheet" href="assets/css/orders.css">
</head>

<body>
    
    <div class="navbar">
        <div class="right">
            <img src="assets/img/3.png" alt="" class="logo">
            <ul>
              <li><a href="allMenu.php">All</a></li>
              <li><a href="koreanMenu.php">Korean</a></li>
              <li><a href="filipinoMenu.php">Filipino</a></li>
            </ul>
        </div>
        <div class="left">
          <a href="allMenu.php"><button id="cartButton" class="iconbtn"><i class="ri-shopping-cart-line"></i></button></a>
            <button class="iconbtn"><i class="ri-user-line"></i></button>
        </div>
    </div>


    <div class="sidebar1" id="userside">
      <a href="Userinfo.php" >Account Info</a>
      <a href="Orders.php" class="active">Orders</a>
      <a href="Transactions.php">Transaction</a>
      <a href="#" class="logout1">Log out</a>
  </div>

    <div class="main-content">
        <section class="content">
            <h2>My Orders</h2>
      
            <!-- Customer-friendly info box -->
            <div class="info-box">
              <h3>Hello, John Doe!</h3>
              <p>Here’s a summary of your recent orders. You can view the details of each order or check their status below.</p>
            </div>
      
            <!-- Orders Table -->
            <table class="orders-table">
              <thead>
                <tr>
                  <th>Order #</th>
                  <th>Date</th>
                  <th>Items</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- Placeholder rows -->
                <tr>
                  <td>001</td>
                  <td>2024-11-19</td>
                  <td>Item 1, Item 2</td>
                  <td>₱100.00</td>
                  <td><span style="color: green;">Delivered</span></td>
                  <td>
                    <a href="#" class="view-details">View Details</a>
                  </td>
                </tr>
                <tr>
                  <td>002</td>
                  <td>2024-11-18</td>
                  <td>Item 3</td>
                  <td>₱50.00</td>
                  <td><span style="color: orange;">Pending</span></td>
                  <td>
                    <a href="#" class="view-details">View Details</a>
                  </td>
                </tr>
                <tr>
                  <td>003</td>
                  <td>2024-11-17</td>
                  <td>Item 4, Item 5</td>
                  <td>₱200.00</td>
                  <td><span style="color: red;">Cancelled</span></td>
                  <td>
                    <a href="#" class="view-details">View Details</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </section>
    </div>

    
</body>

