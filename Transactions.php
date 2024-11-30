<link rel="stylesheet" href="./assets/css/Transaction.css">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    
    <link rel="stylesheet" href="./assets/css/1.css">


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
          <a href="allMenu.php"><button id="cartButton" class="iconbtn"><i class="ri-shopping-cart-line"></i></button></a>
            <button class="iconbtn"><i class="ri-user-line"></i></button>
        </div>
    </div>

    <div class="sidebar1" id="userside">
      <a href="Userinfo.php">Account Info</a>
      <a href="Orders.php">Orders</a>
      <a href="Transactions.php" class="active">Transaction</a>
      <a href="#" class="logout1">Log out</a>
  </div>

    <div class="main-content">
        <section class="content">
            <h2>Transaction History</h2>
            <table class="transaction-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Transaction ID</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>2024-11-19</td>
                  <td>TX1234567890</td>
                  <td>$50.00</td>
                  <td>Completed</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>2024-11-18</td>
                  <td>TX0987654321</td>
                  <td>$75.00</td>
                  <td>Pending</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>2024-11-17</td>
                  <td>TX5678901234</td>
                  <td>$100.00</td>
                  <td>Failed</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>2024-11-16</td>
                  <td>TX3456789012</td>
                  <td>$150.00</td>
                  <td>Completed</td>
                </tr>
              </tbody>
            </table>
          </section>
    </div>
</body>

