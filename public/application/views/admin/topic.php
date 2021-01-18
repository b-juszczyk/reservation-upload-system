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
                    <h2><?php echo $topic->title; ?></h2>
                    <hr />
                    <article class="card-text">
                        <p><?php echo $topic->topicDescription; ?>
                        </p>
                    </article>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h6 class="mt-2 text-center text-uppercase text-secondary">
                Edycja tematu
            </h6>
            <a href="<?php echo site_url('admin/editTopic/'.$topic->id); ?>" class='btn btn-block btn-warning'><i
                    class="far fa-check-circle mr-1"></i>Edytuj temat</a>

            <a href="#" class='btn btn-block btn-danger' id="deleteBtn"><i class="far fa-times-circle mr-1"></i>Usuń
                temat</a>
            <div class="row text-center justify-content-center" id="delete" style="display:none;">
                <form>
                    <p class="form-text">Czy na pewno chcesz usunąć temat?</p>

                    <a href="<?php echo site_url('admin/deleteTopic/'.$topic->id) ?>" class="btn btn-danger">Usuń</a>

                </form>

            </div>
        </div>
    </div>
</div>
</div>