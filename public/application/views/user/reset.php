<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-4 mb-4 pl-4 pr-4">

    <div class="d-flex h-100">

        <div class="m-auto text-center">
            <h2>Reset hasła</h2>
            <form action="<?php echo site_url('users/showResetForm') ?>" method="post"
                class="align-items-center  justify-content-center">
                <div class="text-danger"><?php echo validation_errors(); ?></div>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="form-group w-100">
                    <label for="email">Podaj swój adres e-mail:</label>
                    <input type="email" name="email" placeholder="Adres e-mail..." required="" class="form-control">

                </div>
                <input type="submit" name="resetPassword" class="btn btn-success">
            </form>
        </div>
    </div>
</div>