<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container mt-4 mb-4 pl-4 pr-4">
    <div class="card w-100">
        <div class="card-header">
            <h1>Wgraj projekt</h1>
        </div>
        <div class="card-body">
            <?php if(!$didUserUploadFile){ ?>
            <form action="<?php echo site_url('upload'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="form-group">
                    <label for="file" class="form-text">Dodaj plik:</label>
                    <input type="file" name="file" id="file" class="form-control w-25 border-0">
                </div>
                <div class="form-group">
                    <input type="submit" value="Wgraj" class="btn btn-success" id="uploadSubmit" name="uploadSubmit">
                </div>
            </form>
            <?php } else{ ?>
            <h3>Projekt został już wgrany!</h3>
            <?php } ?>
        </div>
        <div class="card-footer">
            <p>Projekt należy spakować w archiwum i przesłać w formacie zip.</p>
        </div>
    </div>
</div>
