<?php
include '../../tpgdata/stops.php';

if (!preg_match('/^\d{6}$/', $_GET['id'])) {
    http_response_code(404);
    die('Erreur : Aucun arrêt spécifié');
}

require '../../tpgdata/db.php';
require '../../tpgdata/apikey.php';

// Get the widget from the database
$req = $bdd->prepare('SELECT * FROM widgets WHERE id = ?');
$req->execute([$_GET['id']]);
$widget = $req->fetch();

if (empty($widget)) {
    http_response_code(404);
    die('Erreur : Widget inconnu');
}

$stopW = $widget['stop'];
$nameW = $widget['name'];

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?= $nameW ?>">

    <title>TPGwidget</title>

    <link rel="stylesheet" href="/resources/css/framework7.ios.min.css?142">
    <link rel="stylesheet" href="/resources/css/tpgwidget.min.css?xa">

    <!-- Icônes -->
    <link href="http://www.nicolapps.ch/tpgicon/<?= urlencode($stopW) ?>/152.png" sizes="152x152" rel="apple-touch-icon">
    <link href="http://www.nicolapps.ch/tpgicon/<?= urlencode($stopW) ?>/144.png" sizes="144x144" rel="apple-touch-icon">
    <link href="http://www.nicolapps.ch/tpgicon/<?= urlencode($stopW) ?>/120.png" sizes="120x120" rel="apple-touch-icon">
    <link href="http://www.nicolapps.ch/tpgicon/<?= urlencode($stopW) ?>/114.png" sizes="114x114" rel="apple-touch-icon">
    <link href="http://www.nicolapps.ch/tpgicon/<?= urlencode($stopW) ?>/76.png" sizes="76x76" rel="apple-touch-icon">
    <link href="http://www.nicolapps.ch/tpgicon/<?= urlencode($stopW) ?>/72.png" sizes="72x72" rel="apple-touch-icon">
    <link href="http://www.nicolapps.ch/tpgicon/<?= urlencode($stopW) ?>/57.png" sizes="57x57" rel="apple-touch-icon">
  </head>
  <body>
    <div class="panel-overlay"></div>
    <div class="panel panel-right panel-reveal layout-dark">
        <h1>TPG<span>widget</span></h1>

        <div class="list-block">
            <ul>
              <li>
                 <a href="/itineraire/?departure=<?= htmlspecialchars($nameW) ?>" class="item-link close-panel">
                    <div class="item-content">
                        <div class="item-media">
                            <i class="icon i-itineraire"></i>
                        </div>
                       <div class="item-inner">
                          <div class="item-title">Itinéraire</div>
                       </div>
                    </div>
                 </a>
              </li>
              <li>
                 <a href="/arrets/arrets.php" class="item-link close-panel">
                    <div class="item-content">
                        <div class="item-media">
                            <i class="icon i-stops"></i>
                        </div>
                       <div class="item-inner">
                          <div class="item-title">Liste des arrêts</div>
                       </div>
                    </div>
                 </a>
              </li>
              <li>
                 <a href="/infotrafic.php" class="item-link close-panel">
                    <div class="item-content">
                        <div class="item-media">
                            <i class="icon i-infotrafic"></i>
                        </div>
                       <div class="item-inner">
                          <div class="item-title">Info trafic</div>
                       </div>
                    </div>
                 </a>
              </li>
              <li>
                 <a href="/plans.php" class="item-link close-panel">
                    <div class="item-content">
                        <div class="item-media">
                            <i class="icon i-plans"></i>
                        </div>
                       <div class="item-inner">
                          <div class="item-title">Plans</div>
                       </div>
                    </div>
                 </a>
              </li>
              <li>
                 <a href="/about.php" class="item-link close-panel">
                    <div class="item-content">
                        <div class="item-media">
                            <i class="icon i-about"></i>
                        </div>
                       <div class="item-inner">
                          <div class="item-title">À propos</div>
                       </div>
                    </div>
                 </a>
              </li>
           </ul>
    </div>

    </div>
    <div class="views">
      <div class="view view-main" data-stop="<? echo $stopW; ?>">
        <div class="navbar theme-white">
          <div class="navbar-inner">
            <div class="center sliding"><? echo $nameW; ?></div>
            <div class="right">
              <a href="#" class="open-panel link icon-only"><i class="icon icon-panel"></i></a>
            </div>
          </div>
        </div>
        <div class="pages navbar-through toolbar-through">
          <div data-page="index-<?= $stopW ?>" class="page page-index layout-dark">
            <div class="page-content">
                <section class="graym">
                    <span class="preloader preloader-white"></span>
                    <h2>Chargement...</h2>
                </section>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="/resources/js/framework7.min.js?1.4.2"></script>
    <script type="text/javascript" src="/resources/js/tpgwidget.min.js?cache"></script>
  </body>
</html>
