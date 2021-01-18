<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>
<div class="container mt-4 mb-4 pl-4 pr-4">

    <div class="d-flex h-100">

        <div class="m-auto text-center">
            <h2>Zmiana hasła</h2>
            <form action="" method="post" class="align-items-center  justify-content-center">
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="text-danger"><?php echo validation_errors(); ?></div>
                <div class="form-group w-100">
                    <label for="passwd">Hasło:</label>
                    <input type="password" name="passwd" placeholder="Hasło..." required="" class="form-control">

                </div>
                <div class="form-group">
                    <label for="confPasswd">Potwierdź hasło:</label>
                    <input type="password" name="confPasswd" placeholder="Potwierdź hasło..." required=""
                        class="form-control">
                </div>
                <input type="submit" name="changePassword" class="btn btn-success">
            </form>
        </div>
    </div>
</div>