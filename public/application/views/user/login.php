<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>
<div class="container mt-4 mb-4 pl-4 pr-4">
    <div class="d-flex h-100">

        <div class="m-auto text-center">
            <h2>Logowanie</h2>
            <form action="" method="post" class="align-items-center  justify-content-center">
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="text-danger"><?php echo validation_errors(); ?></div>
                <div class="form-group w-100">
                    <input type="text" name="email" placeholder="E-mail" required="" class="form-control">

                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required="" class="form-control">
                    <?php echo form_error('password','<p class="alert-warning">','</p>'); ?>
                </div>
                <input type="submit" name="loginSubmit" value="Zaloguj się" class="btn btn-dark mb-3">
            </form>
            <a href="<?php echo site_url('users/showResetForm') ?>">
                <p>Zapomniałem hasła</p>
            </a>
            <p>Nie masz konta? <a href="<?php echo base_url('users/registration'); ?>">Zarejestruj się!</a></p>
        </div>
    </div>
</div>