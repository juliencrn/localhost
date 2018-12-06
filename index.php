<!doctype html>
<html lang="fr">
<head>
    <title>localhost</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
</head>

<body>
<div id="page">
    <nav class="navbar navbar-dark bg-primary navbar-expand-sm">
        <div class="container">
            <a class="navbar-brand" href="http://localhost/">Localhost</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="http://localhost/phpmyadmin">PhpMyAdmin</a></li>
                    <li class="nav-item"><a class="nav-link" href="info.php">PHP Info</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="https://developers.google.com/speed/pagespeed/insights/" class="nav-link">
                            PageSpeed
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://github.com/login" class="nav-link">
                            Github
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header>
        <div class="container">
            <h1 class="d-flex justify-content-between" style="height: 150px; line-height: 150px; white-space: nowrap;">
                Sites
                <div>
                    <span class="badge badge-primary badge-pill"></span>
                </div>
            </h1>
        </div>
    </header>

    <section id="liste-projets">
        <div class="container">
            <div class="row">
                <?php
                $nb_fichier = 0;
                $hostname = $_SERVER['HTTP_HOST'];
                if ( $dossier = opendir( dirname( __FILE__ ) ) ) {
                    while (false !== ($fichier = readdir( $dossier ))) {
                        if ( $fichier != '.' && $fichier != '..' && !preg_match( '#^localhost$|^phpmyadmin$|\.ico$|\.txt$|\.md|^lab$|\.gzip$|\.rar$|\.sql$|\.zip$|\.html$|\.php$|\.jpeg$|\.jpg$|\.css$|\.js$|\.sass$|\.scss$|\.json$|\.git$|\^.|\.py$|\.sh$|\.gif$|\.DS_Store$#', $fichier ) ) {
                            $nb_fichier++;
                            $fichierName = str_replace( ['-', '_'], ' ', $fichier );

                            echo '
                            <div class="col-xs-12 col-md-6 col-lg-4">
                              <div class="card mb-3">
                                <div class="card-body">
                                  <h3 class="card-title text-capitalize">' . $fichierName . '</h3>
                                  <p class="card-text"></p>
                                  <a href="http://' . $hostname . '/' . $fichier . '/index.php" class="btn btn-primary">Enter</a>
                                </div>
                              </div>
                            </div>';
                        }
                    }
                    echo '<input type="hidden" id="nbr_site" value="' . $nb_fichier . '">';
                } else {
                    echo 'Le dossier n\' a pas pu être ouvert';
                } ?>
            </div>
        </div>
    </section>

</div><!-- /page -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script type='text/javascript'>
    // Update project count
    jQuery(function($) {
        $('header span.badge').html(
            $('input#nbr_site').val()
        )
    })
</script>
</body>
</html>
