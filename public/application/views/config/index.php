<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-4 mb-4 pl-4 pr-4">
    <div class="row">

        <div class="col-md-8">
            <div class="card w-100">
                <div class="card-header">Ustawienia systemu</div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                        <div class="form-group">
                            <label for="closeDate">Data zamknięcia systemu rezerwacji:</label>
                            <input type="date" name="closeDate" id="closeDate" class="form-control"
                                value="<?php echo $date; ?>">
                        </div>
                        <div class="form-group">
                            <label for="closeFileDate">Data zamknięcia systemu oddawania projektu:</label>
                            <input type="date" name="closeFileDate" id="closeFileDate" class="form-control"
                                value="<?php echo $dateFile; ?>">
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h6 class="mt-2 text-center text-uppercase text-secondary">
                Ustawienia
            </h6>
            <input type="submit" value="Zatwierdź" id="configSubmit" name="configSubmit"
                class="btn btn-success btn-block">
            </form>
        </div>
    </div>

</div>