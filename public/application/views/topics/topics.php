<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>
<div class="container mt-4 mb-4 pl-4 pr-4">
    <div class="row mb-3">
        <h2>Dostępne tematy: </h1>
            <a name="addNew" id="addNew" class="btn btn-success ml-auto"
                href="<?php echo site_url('reservations/custom'); ?>" role="button">
                <i class="fa fa-plus-circle"></i>
                Zaproponuj swój temat
            </a>

    </div>



    <?php foreach($topics as $topic){ ?>

    <div class="card w-100" id="topicCard">
        <div class="card-body">
            <h5 class="card-title"><?php echo $topic['title']; ?></h5>

            <p class="card-text"><?php echo $topic['topicDescription']; ?></p>
        </div>
        <div class="card-footer">
            <div class="row">
                <a href="<?php echo site_url('topics/view/').$topic['id']; ?>">
                    <button class="btn btn-sm btn-info ml-3">
                        Pokaż więcej
                    </button>

                </a>
                <p class="ml-auto mr-2">Liczba rezerwacji:
                    <?php if(!empty($topic['reservationsCount'])){echo $topic['reservationsCount'].' ('.round($topic['reservationsCount']*100/$allReservationsCounter).'%)';} else {echo '0 (0%)';} ?>
                </p>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
