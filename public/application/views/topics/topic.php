<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-4 mb-4 pl-4 pr-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card w-100">
                <div class="card-body">
                    <h2><?php echo $topic->title; ?></h2>
                    <hr />
                    <article class="card-text">
                        <?php echo $topic->topicDescription; ?>
                    </article>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h6 class="mt-2 text-center text-uppercase text-secondary">
                Rezerwacja
            </h6>
            <form action="<?php echo site_url('reservations/create/').$topic->id; ?>" method="post">
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="form-row mb-3">
                    <label for="category">Kategoria:</label>
                    <select name="category" id="category" class="form-control">
                        <option value="PWA">PWA</option>
                        <option value="SPA">SPA</option>
                        <option value="RWA">RWA</option>
                        <option value="RIA">RIA</option>
                        <option value="REST">REST</option>
                        <option value="PHP-REST">PHP REST</option>
                        <option value="Inna">Inna</option>
                    </select>
                </div>
                <div class="form-row mb-3" id="description" style="display:none">
                    <label for="desc">Opis technologii:</label>
                    <input type="text" name="desc" id="desc" class="form-control" />
                </div>
                <div class="form-row">
                    <input class="btn btn-success btn-sm btn-block" type="submit" value="Zarezerwuj">
                </div>
            </form>
        </div>
    </div>
</div>