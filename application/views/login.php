<html>

    <head>

        <title>Star8 | Login</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/login_style.css') ?>"/>

    </head>

    <body>

        <div class="comp_logo">
            <img src="<?php echo base_url('assets/public/star8logo.png') ?>" height="210px" width="305px"/>
        </div>

        <div class="info_text">
            DIGITAL<br/>
            BROADCAST<br/>
            SOLUTIONS
        </div>

        <div class="green_dia">
            <div class="neg_rotate">
            <p class="sign_p">Login:</p>
            <?php echo form_open(); ?>  
                <input class="user_form" type="text" name="username" value="" placeholder="Username">
                <input class="user_form" type="password" name="password" value="" placeholder="Password"><br/>
                <a class="pass_text" href="#modalwindow">Forgot your password?</a>
                <label for="loginbutton" class="loginlabel">LOGIN</label>
                <input type="submit" name="loginbtn" id="loginbutton" value="Login">
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

    </body>

</html>