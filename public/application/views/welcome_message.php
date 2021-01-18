<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="first-row" class="row w-100 m-0">

    <div class="container mt-5 pt-5 pb-5">
        <div class="row">
            <div class="col-md-4 mx-auto text-center font-weight-bold">
                <h3 class="text-muted text-uppercase">System rezerwacji i&nbsp;wgrywania projektów</h3>
            </div>
        </div>
        <div class="row mx-auto mt-5 justify-content-center text-center">
            <div class="col-md-2">
                <a href="<?php echo site_url('topics') ?>" class="no-decoration">
                    <p id="index-steps">Wybierz temat</p>
                </a>
            </div>
            <div class="col-md-1"><i class="fas fa-angle-double-right"></i></div>

            <div class="col-md-2">
                <a href="<?php echo site_url('topics') ?>" class="no-decoration">
                    <p id="index-steps">Dokonaj rezerwacji</p>
                </a>
            </div>
            <div class="col-md-1"><i class="fas fa-angle-double-right"></i></div>

            <div class="col-md-2">
                <a href="<?php echo site_url('upload') ?>" class="no-decoration">
                    <p id="index-steps">Wgraj projekt</p>
                </a>
            </div>

        </div>
        <div class="row mt-5">

            <div class="col-md-6 mx-auto text-center">
                <h4>Zarezerwować temat oraz wgrać projekt można dopiero po zalogowaniu</h2>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 mx-auto text-center">
                <h5>Data zamknięcia systemu rezerwacji: <?php echo $closeDate; ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto text-center">
                <h5 class="text-center">Data zamknięcia systemu oddawania projektów: <?php echo $closeFileDate; ?></h5>
            </div>
        </div>

    </div>
</div>
<div id="second-row" class="row w-100 mt-5 ml-0 mr-0">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto  mb-3">
                <h5 class="text-center text-md-left">Technologie jakie można użyć w projekcie są dyktowane przez
                    materiał przerabiany w
                    związku z przedmiotem. Strona serwera powinna być napisana w&nbsp;PHP lub w frameworkach
                    przeznaczonych do tego języka, natomiast strona klienta - w&nbsp;HTML, CSS, JS, przy czym
                    również można używać odpowiednich frameworków dla tych technologii.
                </h5>
            </div>
            <div class="col-md-2 text-center my-auto">
                <i class="fas fa-info-circle fa-7x"></i>
            </div>

            <div class="col-md-4 mx-auto  mb-3">
                <!-- <div class="mobile-margin-t visible-sm"></div> -->
                <h5 class="text-center text-md-right mt-3">Oddawany projekt powinien być spakowany w archiwum ZIP oraz
                    powinien zawierać
                    cały kod źródłowy, który potrzebny jest do uruchomienia projektu. Specjalne nazewnictwo
                    plików nie jest wymagane.
                </h5>
            </div>
        </div>
    </div>
</div>
<div id="third-row" class="row w-100 mt-5 ml-0 mr-0 mb-0">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4 my-auto ml-auto d-none d-md-block">
                <i class="far fa-7x fa-arrow-alt-circle-right arrow-right-animate"></i>
            </div>
            <div class="col-md-4 ml-auto border-left text-left py-3">
                <h3>Poza predefiniowanymi tematami istnieje możliwość
                    zaproponowania własnego, który musi zostać zaakceptowany
                    przez prowadzącego</h3>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 border-right text-right py-3">

                <h3>W przypadku chęci utworzenia projektu z&nbsp;kategorią,
                    która nie została podana przez prowadzącego należy zanaczyć ten fakt
                    podczas rezerwacji</h3>
            </div>
            <div class="col-md-4 my-auto ml-auto d-none d-md-block">
                <i class="far fa-7x fa-arrow-alt-circle-left arrow-left-animate"></i>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-4 my-auto ml-auto d-none d-md-block">
                <i class="far fa-7x fa-arrow-alt-circle-right arrow-right-animate"></i>
            </div>
            <div class="col-md-4 ml-auto border-left text-left py-3">

                <h3>Przy wgrywaniu projektu należy wysłać ostateczną, sprawdzoną wersję,
                    ponieważ nie ma możliwości zmiany wysłanych plików</h3>
            </div>
        </div>
    </div>
</div>
