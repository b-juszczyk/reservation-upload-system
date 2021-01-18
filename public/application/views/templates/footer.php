<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</main>
<footer class="bg-dark">
    <div class="container w-100 pt-3 pb-3">
        <div class="row">
            <div class="col-md-3 mx-auto">
                <h5 class="text-uppercase">Kontakt</h5>
                <p>Dr hab. inż. Jak Prokop, prof. PRz<br>
                    Wydział Elektrotechniki i Informatyki<br>
                    ul. W. Pola 2 (bud. B, pok. 101)<br>
                    35-959 Rzeszów<br>
                    Telefon: <a class="no-decoration" href="tel:0048178651384">+48 17 865 13 84</a><br>
                    E-mail: <a class="no-decoration" href="mailto:jprokop@prz.edu.pl">jprokop@prz.edu.pl</a><br>
                    WWW: <a class="no-decoration" href="http://jprokop.prz.edu.pl"
                        target="blank">http://jprokop.prz.edu.pl</a>

                </p>
            </div>

            <div class="col-md-3 mx-auto">
                <h5 class="text-uppercase text-center">Linki</h5>
                <ul class="list-group">
                    <li class="list-group-item bg-dark footer-list-item"><a class="no-decoration"
                            href="http://web.prz.edu.pl">Technologie Sieci
                            Web</a></li>
                    <li class="list-group-item bg-dark footer-list-item"><a href="http://java.prz.edu.pl"
                            class="no-decoration">Programowanie w języku JAVA</a></li>
                    <li class="list-group-item bg-dark footer-list-item">Lorem ipsum</li>
                </ul>
            </div>
            <div class="col-md-3 mx-auto text-right">
                <h5 class="text-uppercase">Informacje</h5>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore dolor fugit recusandae, in, aut nam
                    id at adipisci laudantium consequuntur cupiditate sit laboriosam molestiae repellendus. Amet
                    explicabo a dicta distinctio.
                </p>
            </div>
        </div>
    </div>
    <div class="bg-black w-100 py-1 my-auto text-center" id="copyright">
        <p>Copyright &copy;
            <?php if(date('Y')>2021){echo '2021-'.date('Y');}else{echo '2021';} ?> Bartosz Juszczyk. All Rights
            Reserved.</p>
    </div>

</footer>
</body>




</html>