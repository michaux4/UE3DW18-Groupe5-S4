<?php

    define('DB_HOST', getenv('MYSQL_SERVER'));
    define('DB_USER', getenv('MYSQL_USER'));
    define('DB_PASS', getenv('MYSQL_PASSWORD'));
    define('DB_BASE', getenv('MYSQL_DATABASE'));
    define('DB_CONN', 'mysql:host='.DB_HOST.';dbname='.DB_BASE);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LAMP STACK</title>
        <link rel="stylesheet" href="/assets/css/bulma.min.css">
    </head>
    <body>
        <section class="hero is-medium is-info is-bold">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        LAMP STACK
                    </h1>
                    <h2 class="subtitle">
                        Your local development environment
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <h3 class="title is-3 has-text-centered">Environment</h3>
                        <hr>
                        <div class="content">
                            <ul>
                                <li><?= apache_get_version(); ?></li>
                                <li>PHP <?= phpversion(); ?></li>
                                <li>


                                    <?php

                                        try{
                                            $pdo = new PDO(DB_CONN, DB_USER, DB_PASS);
                                            echo "MySQL Server ".$pdo->getAttribute(PDO::ATTR_SERVER_VERSION );     
                                        } catch (PDOException $e){
                                            echo 'Datebase error : '.$e->getMessage();
                                        }

                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="column">
                        <h3 class="title is-3 has-text-centered">Quick Links</h3>
                        <hr>
                        <div class="content">
                            <ul>
                                <li><a href="http://localhost:<?php echo getenv('HTTP_PORT');?>/phpinfo.php">phpinfo()</a></li>
                                <li><a href="http://localhost:8080">phpMyAdmin</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>