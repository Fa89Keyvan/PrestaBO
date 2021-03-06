<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery-3.3.1.min.js"></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        *{
            direction: rtl;
        }
        /* Full-width input fields */
        input[type=email], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Set a style for all buttons */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

            button:hover {
                opacity: 0.8;
            }

        /* Extra styles for the cancel button */
        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        /* Center the image and position the close button */
        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
            position: relative;
        }

        img.avatar {
            width: 14%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: left;
            padding-top: 16px;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 45%; /* Could be more or less, depending on screen size */
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes animatezoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div id="id01" class="modal">

        <form class="modal-content animate" id="frmLogin" action="../Server/Api/Api.php?q=login" method="post">
            <div class="imgcontainer">
                <img src="images/login.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="email"><b>ایمیل</b></label>
                <input type="email" placeholder="ایمیل" name="email" required>

                <label for="password"><b>کلمه عبور</b></label>
                <input type="password" placeholder="کلمه عبور" name="password" required>

                <button type="submit">ورود</button>
            </div>

        </form>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('id01');
        modal.style.display = 'block';
        
        $("#frmLogin").submit(function (e) {
            
            var frmLogin = $(this);
            var url = frmLogin.attr('action');
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                data: frmLogin.serialize(),
                success: function (data) {
                    var tokenData = JSON.parse(data);
                    //alert(data);
                    if (tokenData.HasError) {
                        localStorage.clear();
                        //TODO: showMessage(wrong login);
                        return;
                    }
                    else {
                        setLocalToken(data);
                        window.location = 'index.php';
                    }
                }
            });

                
        });

        /**
         * @returns TokenObject
         */
        function getLocalToken() {

            return JSON.parse(window.localStorage.getItem('token'));

        }

        /**
         * @returns void
         * @param string jsonString
         */
        function setLocalToken(jsonString) {
            window.localStorage.setItem('token', jsonString);
        }

        /**
         * @returns void
         */
        function removeLocalToken() {
            window.localStorage.setItem('token', undefined);
            window.localStorage.clear();
        }
    </script>

</body>
</html>
