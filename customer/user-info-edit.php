<?php include 'includes/header.php' ?>

<link rel="stylesheet" href="assets/css/user-info.css">

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
                function BackToUserInfo() {
                    window.location.href = 'userinfo.php';
                }
            </script>
            <button type="submit">save</button>
        </form>
    </div>
</div>
</body>