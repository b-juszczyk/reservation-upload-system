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
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <a href="#" class="navbar-brand mr-auto">System rezerwacji i oddawania projektów</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="http://vue.ci/" class="btn nav-link">System rezerwacji</a>
                </li>
            </ul>
        </div>
    </nav>


    <main class="pt-5">
        <div class="container pr-4 pl-4 mb-4 mt-4">


            <?php
		$allFiles = scandir('.');
		$files = array_diff($allFiles, array('.','..','.htaccess','index.php'));
        foreach($files as $file){ ?>

            <div class="card w-100" id="topicCard">
                <div class="card-body">
                    <div class="row">
                        <h5 class="card-text mr-auto my-auto align-items-center">
                            <?php echo pathinfo($file, PATHINFO_FILENAME); ?></h5>
                        <a href="<?php echo 'http://vue.ci/uploads/'.$file; ?>" class="btn btn-info ml-auto">Pobierz
                            projekt</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </main>

</body>

</html>
