<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-md-2 mt-1">
    <a class="btn btn-info" href="<?php echo site_url('users/account'); ?>">Powrót do listy tematów</a>
</div>
<div class="container pr-4 pl-4 mb-4 mt-4">

    <div class="row">

        <div class="col-md-8">
            <div class="card w-100">
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                        <h2>
                            <label for="title">Tytuł:</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Tytuł..."
                                required>
                        </h2>
                        <hr />
                        <article class="card-text">
                            <label for="description">Opis:</label>
                            <textarea name="description" id="description" rows="5" class="form-control"
                                placeholder="Opis..." required></textarea>
                        </article>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <input type="submit" value="Zatwierdź" id="addSubmit" name="addSubmit" class="btn btn-success btn-block">
            </form>
        </div>
    </div>
</div>
</div>