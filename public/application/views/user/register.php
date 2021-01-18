<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>
<div class="container mt-4 mb-4 pl-4 pr-4">
    <div class="d-flex h-100">

        <div class="m-auto text-center">
            <h2>Rejestracja</h2>
            <form action="" method="post" class="align-items-center  justify-content-center">
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="text-danger"><?php echo validation_errors(); ?></div>
                <div class="form-group row">
                    <input type="text" name="first_name" id="first_name" class="form-control col-md-6"
                        placeholder="Imię" required="">
                    <input type="text" name="last_name" id="last_name" class="form-control col-md-6"
                        placeholder="Nazwisko" required="">
                </div>
                <div class="form-group w-100">
                    <input type="text" name="email" placeholder="E-mail" required="" class="form-control">
                </div>
                <div class="form-group row">
                    <input type="password" name="password" placeholder="Hasło (min. 6 znaków)" required=""
                        class="form-control col-md-6">
                    <input type="password" name="confpassword" placeholder="Potwierdź hasło" required=""
                        class="form-control col-md-6">
                </div>
                <input type="submit" name="registerSubmit" value="Zarejestruj się" class="btn btn-success mb-3">
            </form>
            <p>Posiadasz już konto? <a href="<?php echo base_url('users/login'); ?>">Zaloguj się</a></p>
        </div>
    </div>
</div>
