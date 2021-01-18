<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container pr-4 pl-4 mb-4 mt-4">

    <div class="card w-100">
        <div class="card-header">
            <h2>Zarządzanie kontem</h1>
        </div>
        <div class="card-body">
            <div class="row ml-1">
                <p><b>Imię i nazwisko:</b> <?php echo $user['first_name'].' '.$user['last_name']; ?></p>
            </div>
            <div class="row ml-1">
                <p><b>Adres e-mail:</b> <?php echo $user['email']; ?></p>
            </div>

            <div class="row ml-1">


                <p class="my-auto"><b>Aktualna rezerwacja:</b>
                    <?php if(!empty($reservation->title)){echo $reservation->title;}else{echo 'brak';} ?></p>
                <?php if(!empty($reservation->title)){echo '<a class="btn btn-danger ml-auto" href="'.site_url('reservations/delete/').$reservation->id.'">Usuń rezerwację</a>';}?>
            </div>
            <div class="row ml-2">


                <?php if(!empty($reservation->custom)){ ?><p>
                    <?php if($reservation->accepted){echo '<b>Zaakceptowano?</b> <i class="fas fa-check ml-1"></i>';}else{echo '<b>Zaakceptowano?</b> <i class="far fa-times-circle"></i>';} ?>
                </p><?php } ?>
            </div>
            <div class="row ml-1 mt-2">
                <p>
                    <?php if(!empty($reservation->filename)){echo '<b>Projekt oddany?</b> <i class="fas fa-check ml-1"></i>';}else{echo '<b>Projekt oddany?</b> <i class="far fa-times-circle"></i>';} ?>
                </p>
            </div>
        </div>


    </div>
    <div class="card-footer">
        <div class="row">
            <a href="<?php echo site_url('users/changePassword/')?>" class="btn btn-info mr-1">
                Zmień hasło
            </a>
            <a href="<?php echo site_url('users/logout/')?>" class="btn btn-danger ml-1">
                Wyloguj
            </a>
        </div>
    </div>
</div>





</div>
