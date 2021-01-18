<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid h-100">
    <div class="row">
        <div id="sidebar-wrapper flex-sm-column">
            <div class="col-12 col-sm-2 text-center mt-2" id="sidebar">
                <h3 class="text-uppercase font-weight-light " style="font-size:1.2em">Panel
                    administracyjny
                </h3>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item ">
                        <a class="nav-link active" href="#" id="reservationsNav">Rezerwacje</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#" id="usersNav">Użytkownicy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="topicsNav">Tematy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-5" href="<?php echo site_url('config/') ?>"
                            id="settingsNav">Ustawienia</a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?php echo(base_url().'uploads') ?>" class="nav-link" target="_blank">Pobierz
                            projekty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-0" href="<?php echo site_url('users/changePassword/')?>">Zmień
                            hasło</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger pt-0" href="<?php echo site_url('users/logout') ?>">Wyloguj
                            się</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col mt-4 mb-4 pl-4 pr-4" id="reservations">
            <h2>Rezerwacje</h2>

            <div class="table-responsive-md">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Imię i nazwisko</th>
                            <th scope="col">Temat</th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Opis technologii</th>
                            <th scope="col">Data rezerwacji</th>
                            <th scope="col">Zaakceptowano?</th>
                            <th scope="col">Oddano?</th>
                            <th scope="col">Szczegóły</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
				foreach($reservations as $item){ ?>
                        <tr>
                            <td scope="row"><?php echo $item['reservation_id']; ?></td>
                            <td scope="row"><?php echo $item['first_name'].' '.$item['last_name']; ?></td>

                            <td scope="row"><?php echo $item['title']; ?></td>
                            <td scope="row"><?php echo $item['category']; ?></td>
                            <td scope="row">
                                <?php if(!empty($item['description'])){echo $item['description'];}else{echo '---';}?>
                            </td>
                            <td scope="row"><?php echo $item['reservation_created_at']; ?></td>
                            <td scope="row">
                                <?php if($item['accepted']==1){echo '<i class="fas fa-check-circle"></i>';}else{echo '<i class="fas fa-times-circle"></i>';}?>
                            </td>
                            <td scope="row">
                                <?php if($item['filename']!=NULL){echo '<i class="fas fa-check-circle"></i>';}else{echo '<i class="fas fa-times-circle"></i>';}?>
                            </td>
                            <td scope="row"><a class="btn btn-info"
                                    href="<?php echo site_url('reservations/show/').$item['reservation_id'] ?>">Szczegóły</a>
                            </td>
                        </tr>
                        <?php 
				}
				?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mt-4 mb-4 pl-4 pr-4" id="users" style="display:none;">
            <h2>Użytkownicy</h2>
            <div class="table-responsive-md">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Imię i nazwisko</th>
                            <th scope="col">Adres e-mail</th>
                            <th scope="col">Aktywny?</th>
                            <th scope="col">Działania</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
				$nr = 1;
				foreach($users as $item){ ?>
                        <tr>
                            <td scope="row"><?php echo $item['id']; ?></th>
                            <td scope="row"><?php echo $item['first_name'].' '.$item['last_name']; ?></td>

                            <td scope="row"><?php echo $item['email']; ?></td>
                            <td scope="row">
                                <?php if($item['status']==1){echo '<i class="fas fa-check-circle"></i>';}elseif($item['status']==0){echo '<i class="fas fa-times-circle"></i>';}?>
                            </td>
                            <td scope="row">
                                <a class="btn btn-danger"
                                    href="<?php echo site_url('admin/deleteUser/'.$item['id']) ?>">
                                    Usuń
                                </a>
                            </td>
                        </tr>
                        <?php $nr++;
				}
				?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mt-4 mb-4 pl-4 pr-4" id="topics" style="display:none;">
            <div class="row">
                <h2>Tematy</h2>
                <div class="ml-auto"><a href="<?php echo site_url('admin/addTopic') ?>" class="btn btn-success">Dodaj
                        nowy temat</a></div>
            </div>
            <div class="table-responsive-md">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Temat</th>
                            <th scope="col">Opis</th>

                            <th scope="col">Szczegóły</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
				$nr = 1;
				foreach($topics as $item){ ?>
                        <tr>
                            <td scope="row"><?php echo $item['id']; ?></td>
                            <td scope="row"><?php echo $item['title']; ?></td>
                            <td scope="row"><?php echo $item['topicDescription']; ?></td>

                            <td scope="row"><a href="<?php echo site_url('admin/topic/'.$item['id']); ?>"><button
                                        class="btn btn-info">Szczegóły</button></a></td>
                        </tr>
                        <?php $nr++;
				}
				?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>