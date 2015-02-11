        <?php
            $attributes = array('class' => 'form-signin', 'role' => 'form');

            echo form_open('login', $attributes);
        ?>

            <h2 class="form-signin-heading">EvSystem · Sign in</h2>

            <?php echo validation_errors(); ?>

            <?php if (!empty($login_failed)) echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ' . $login_failed . '</div>'; ?>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" required>
            <input type="submit" name="submit_login" class="btn btn-lg btn-primary btn-block" value="Sign in" />


        <?php echo form_close()?>
