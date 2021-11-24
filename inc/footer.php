<footer id="footer">
    <div class="footer__wave">
        <div class="wave"></div>
        <div class="wave"></div>
    </div>


    <div class="footer__container">
        <div class="footer__logo">
            <a href="index.php"><img src="asset/img/logo_vactolib.png" alt="logo vactolib"></a>
        </div>
        <?php if(!empty($_SESSION)){ ?>
            <div class="footer__services">
                <h3>Nos services</h3>
                <ul>
                    <li><a href="moncarnet.php">Mon carnet</a></li>
                    <li><a href="profil.php">Mon profil</a></li>
                    <li><a href="#">Ajouter un vaccin</a></li>
                </ul>
            </div>
        <?php } else { ?>

        <?php } ?>

        <div class="footer__donnees">
            <h3>Données</h3>
            <ul>
                <li><a href="donnees-personnelles-et-cookies.php">Données personnelles et cookies</a></li>
                <li><a href="mentionslegal.php">Mentions légales</a></li>
            </ul>
        </div>

        <div class="footer__contact">
            <h3>Contact</h3>
            <ul>
                <li><a href="contact.php">Nous contacter</a></li>
            </ul>
        </div>
    </div>

    <div class="footer__separation"></div>

    <div class="footer__copyright">
        <div class="copyright">
            <p>Copyright 2021 - tous droits réservés</p>
        </div>

        <div class="social">
            <ul>
                <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</footer>

</body>
</html>