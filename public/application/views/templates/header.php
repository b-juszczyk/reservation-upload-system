<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniter</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="<?php echo assets_url().'script.js' ?>"></script>
    <link rel="stylesheet" href="<?php echo assets_url().'style.css' ?>">



</head>

<body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <a href="<?php echo base_url(); ?>" class="navbar-brand mr-auto">Reservations&Upload System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?php echo site_url('topics'); ?>" class="btn nav-link">Tematy</a>
                </li>
                <?php if(isset($logged) OR isset($loggedAdmin)){ ?>
                <li class="nav-item">
                    <a href="<?php echo site_url('upload');?>" class="btn nav-link">Wgraj projekt
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('users/account') ?>" class="btn nav-link">
                        <?php if(isset($loggedAdmin)){echo 'Panel administracyjny';}else{echo 'Moje konto';} ?>
                    </a>
                </li>

                <?php } 
				else{
					?>
                <li class="nav-item">
                    <a href="<?php echo site_url('users/login') ?>" class="btn nav-link">Zaloguj</a>
                </li>
                <?php } ?>
            </ul>

        </div>
    </nav>


    <main class="pt-5">
        <?php  
	if(!empty($msgType) AND !empty($msgText)){ ?>
        <div class="row mt-2" id="message">
            <div class="text-center w-100">
                <span class="badge badge-pill <?php echo 'badge-'.$msgType; ?>"><?php echo $msgText; ?></span>
            </div>
        </div>





        <?php } ?>