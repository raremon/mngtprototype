<html>
    <head>
        <link rel="icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/gif">
        <title>Star8 | Login</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/login_style.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">

        <script src="<?php echo base_url('assets/js/jquery-2.2.3.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    </head>
    <body>
        <div class="comp_logo">
            <img src="<?php echo base_url('assets/public/star8logo.png') ?>" height="210px" width="305px"/>
        </div>
        <div class="info_text">
            MEDIA<br/>
            BROADCAST<br/>
            SOLUTIONS
        </div>
        <div class="green_dia">
            <div class="neg_rotate">
            <p class="sign_p">Login:</p>
            <?php echo form_open('', array('id'=>'login')); ?>  
                <input class="user_form" type="text" name="username" value="" placeholder="Username">
                <input class="user_form" type="password" name="password" value="" placeholder="Password"><br/>
                <div id="login-message" class="" style="width:565px;"></div>
                <a class="pass_text" href="#modalwindow">Forgot your password?</a>
                <label for="loginbutton" class="loginlabel">LOGIN</label>
                <input type="button" name="loginbtn" id="loginbutton" onclick="user_Login()" value="Login">
            <?php echo form_close(); ?>
            </div>
        </div>
        <div id="modalwindow" class="modal_effect">
	        <div class="modal_content">
                <a href="#" class="closebtn">X</a>
                <form action="" method="POST">
                    <p>A new password will be sent to your email.</p>
                    <input class="reset_form" type="email" name="login" value="" placeholder="Email Address">
                    <label for="resetbutton" class="resetlabel">RESET</label>
                    <input type="submit" formaction="#" name="resetbtn" id="resetbutton" value="Reset">
                </form>
	        </div>
        </div>
        <script type="text/javascript">
            $(document).keypress(function (e) {
                if (e.which == 13 || event.keyCode == 13) {
                    user_Login();
                }
            });
            function user_Login() {
                $.ajax({
                    url: "<?php echo site_url('login/login') ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: $('#login').serialize(),
                    encode:true,
                    success:function(data) {
                        if(!data.success){
                            if(data.errors){
                                $(window).scrollTop(0);
                                $("#login-message").fadeIn("slow");
                                $('#login-message').html(data.errors).addClass('alert alert-danger');
                                setTimeout(function() {
                                $('#login-message').fadeOut('slow');
                                }, 3000);
                            }
                        }else {
                            window.location.href="<?php echo base_url('dashboard') ?>";
                        }
                    }
                })
            }
        </script>
    </body>
</html>