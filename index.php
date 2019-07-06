<?php
/**
 * Welcome to Localhost!
 *
 * Installation:
 * - Place this file and the "assets" folder
 *   at the root of your local server.
 *   Example
 *   /var/www/html/
 *     - index.php (this current file)
 *     - assets/
 *
 * Thanks at Juliette for the wonderful design
 * - Juliette Rousseaux - Web designer https://www.malt.fr/profile/julietterousseaux
 *
 * Credits & thanks at:
 * - Tachyons: CSS functional framework https://tachyons.io/
 * - Dracula: Color palette https://draculatheme.com/
 *
 * @version 2.0.0
 * @link https://github.com/Junscuzzy/localhost
 */

// Config
$title = 'Localhost'; // string required
$description = 'A nice darkly localhost home page'; // string required
$menu = array(
  array("label" => "Phpmyadmin", "path" => "http://localhost/phpmyadmin", "class" => "pma"),
  array("label" => "Github", "path" => "https://github.com/", "class" => "github"),
  array("label" => "PHP info", "path" => "http://localhost/assets/utils/phpinfo.php", "class" => "php")
);
$theme = 'default'; // 'default' | 'dracula'
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <meta name="description" content="<?php echo $description; ?>">

  <link rel="stylesheet" href="./assets/css/tachyons-v4.11.02.css">
  <link rel="stylesheet" href="./assets/css/<?php echo $theme; ?>-theme-vars.css">
  <link rel="stylesheet" href="./assets/css/theme.css">
</head>

<body class="bg min-vh-100 w-100 h-100 ma0 ph0 pt4 monoxil">
  <main class="w-90 center" style="max-width: 1200px;">

      <!-- header -->
      <header class="w-100 w-60-ns center tc mb4 mb5-ns">
        <h1 class="f3 f2-ns ttu white fw4 ma2">
            <?php echo $title; ?>
        </h1>
        <h2 class="white f6 f5-ns fw4">
            <?php echo $description; ?>
        </h2>
      </header>

      <!-- Buttons section -->
      <?php if ( !empty( $menu ) ) { ?>
          <section class="w-100 w-80-m w-60-l center mb3 mb4-ns">
              <div class="flex flex-wrap justify-center">
                  <?php foreach ( $menu as $item ) { ?>
                      <a href="<?php echo $item['path']; ?>"
                         class="<?php echo $item['class']; ?> f6 f5-ns shadow-5 link grow ba br-pill ttu tc ph4 pv3 mh3 mv2">
                          <?php echo $item['label']; ?>
                      </a>
                  <?php } ?>
              </div>
          </section>
      <?php } ?>

      <!-- Projects list section -->
      <section class="w-100">
        <?php

        // Create CSS classes for project background colors from a array of colors
        function getColor($number) {
            $colors = array(
                "red", "blue", "yellow", "orange",
                "light-blue", "light-green",
                "pink", "navy", "grey", "brown"
            );
            return (string) "bg-" . $colors[$number % count($colors)];
        }

        // Create pretty project name from folder name
        function cleanString($string) {
            $str = str_replace('-', ' ', $string);
            $str = str_replace('_', ' ', $str);
            return (string) $str;
        }

        // Keep only folder (not files.ext or .hiddenFolder)
        $files = array();
        $iterator = new DirectoryIterator(dirname(__FILE__));
        foreach ($iterator as $fileinfo) {
            $isHidden = substr($filename, 0, 1) === '.';
            $isDot = $fileinfo->isDot();
            $isDir = $fileinfo->isDir();
            $isExclude = in_array($filename,array('assets'));

            if ( !$isDot && $isDir && !$isHidden && !$isExclude ) {
                $filename = $fileinfo->getFilename();
                $files[$fileinfo->getMTime()] = array(
                    "name" => cleanString($filename),
                    "path" => './' . $filename,
                    "date" => gmdate('d|m|y', $fileinfo->getMTime())
                );
            }
        }
        // Then sort by modified date
        ksort($files);

        // List each files in current directory
        $i = 0;
        foreach ($files as $file) { ?>

                <article class="fl w-100 w-50-m w-25-l pa4">
                    <a href="<?php echo $file["path"]; ?>">
                        <div class="relative square grow link">
                            <div class="<?php echo getColor($i); ?> shadow-5 absolute top-0 bottom-0 left-0 right-0 flex flex-column justify-end">
                                <div class="ph3">
                                    <h3 class="f4 black fw7 ttu" style="word-break: break-all;">
                                        <?php echo $file["name"]; ?>
                                    </h3>
                                    <p class="f6 black">
                                        <?php echo $file["date"]; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>

                <?php $i++; // Increment used by getColors() ?>
            <?php } ?>
      </section>
  </main>
</body>
</html>
