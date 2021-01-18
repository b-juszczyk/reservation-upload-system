<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container mt-4 mb-4 pl-4 pr-4">
    <form class="col-md-6 mx-auto" method="post" action="<?php echo site_url('topics/store'); ?>">
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        <div class="form-group">
            <label for="title">Tytuł:</label>
            <input class="form-control" type="text" id="title" name="title" placeholder="Podaj tytuł tematu...">
        </div>
        <div class="form-group">
            <label for="description">Opis tematu:</label>
            <textarea class="form-control" id="topicDescription" name="topicDescription"
                placeholder="Podaj opis tematu..."></textarea>
        </div>
        <div class="form-group">

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

            <div class="mt-3" id="description" style="display:none">
                <label for="desc">Opis technologii:</label>
                <input type="text" name="desc" id="desc" class="form-control" placeholder="Podaj opis technologii..." />
            </div>
        </div>
        <input type="submit" class="btn btn-success btn-block">
    </form>
</div>