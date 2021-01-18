<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>
<div class="col-md-2 mt-1">
    <a class="btn btn-info" href="<?php echo site_url('users/account'); ?>">Powrót do listy rezerwacji</a>
</div>
<div class="container pr-4 pl-4 mb-4 mt-4">

    <div class="row">

        <div class="col-md-8">
            <div class="card w-100">
                <div class="card-body">
                    <h2>Rezerwacja nr <?php echo $reservation->reservation_id; ?></h2>
                    <hr />
                    <article class="card-text">
                        <p>Imię i nazwisko: <?php echo $reservation->first_name.' '.$reservation->last_name ?>
                        </p>
                        <p>Temat
                            projektu<?php if($reservation->custom){echo ' (temat własny): '.$reservation->title;}else{echo ': '.$reservation->title;} ?>
                        </p>
                        <?php
						
						if($reservation->custom){
							echo '<p>Opis tematu: '.$reservation->topicDescription.'</p>';
						}
						
						?>
                        <p>Kategoria: <?php echo $reservation->category ?>
                        </p>
                        <?php if($reservation->category == 'Inna'){?>
                        <p>Opis technologii: <?php echo $reservation->description ?></p>
                        <?php } ?>
                        <p>Data rezerwacji: <?php echo $reservation->reservation_created_at ?>
                        </p>
                        <p>Zaakceptowany?:
                            <?php if($reservation->accepted==1){echo 'Tak';}else{echo 'Nie';} ?>
                        </p>
                        <?php if($reservation->comments!=NULL){ ?>
                        <p>Komentarz: <?php echo $reservation->comments; ?></p>
                        <?php } ?>


                    </article>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h6 class="mt-2 text-center text-uppercase text-secondary">
                Działania z rezerwacją
            </h6>
            <?php if($reservation->custom){ ?>
            <a href="<?php echo site_url('reservations/accept/'.$reservation->reservation_id) ?>"
                class='btn btn-block btn-success <?php if($reservation->accepted){echo 'disabled';} ?>'><i
                    class="far fa-check-circle mr-1"></i><?php if($reservation->accepted){echo 'Zaakceptowano';}else{echo 'Zaakceptuj';} ?></a>
            <?php } ?>
            <a href="#" class='mb-2 btn btn-block btn-warning' id="commentsBtn"><i
                    class="far fa-edit mr-1"></i><?php if($reservation->comments==NULL){echo 'Dodaj';}else{echo 'Edytuj';} ?>
                komentarz</a>
            <div class="row text-center justify-content-center" id="comments" style="display:none;">
                <form method="post"
                    action="<?php echo site_url('reservations/comment/'.$reservation->reservation_id) ?>">
                    <?php echo validation_errors(); ?>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <textarea rows=5 class="form-control  w-100" name="comments" id="comments"
                        placeholder="Komentarz..." required></textarea>
                    <button type="submit" class="btn btn-warning mt-2 mb-2">Wyślij</button>
                </form>
            </div>

            <a href="#" class='btn btn-block btn-danger' id="deleteBtn"><i class="far fa-times-circle mr-1"></i>Usuń
                rezerwację</a>
            <div class="row text-center justify-content-center" id="delete" style="display:none;">
                <form>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <p class="form-text">Czy na pewno chcesz usunąć rezerwację?</p>

                    <a href="<?php echo site_url('reservations/delete/'.$reservation->reservation_id) ?>"
                        class="btn btn-danger">Usuń</a>

                </form>

            </div>
        </div>
        </ div>
    </div>
</div>