<?php
require 'class.iCalReader.php';

$ical1 = new ical('https://calendar.google.com/calendar/ical/uhkgcnq9s9ajhe1jgbped7ktpihg4j7c%40import.calendar.google.com/public/basic.ics');
$ical2 = new ical('https://calendar.google.com/calendar/ical/uvq1j499sbqgp6ii2rti895gqiog8pd7%40import.calendar.google.com/public/basic.ics');
$array1= $ical1->events();
$array2= $ical2->events();

$timestamps = [];

function Between($start, $end){
    $dates = [];
    for ($i = 0; $i <= ($end-$start)/86400; $i++){
        $date = $start + $i * 86400;
        array_push($dates, $date);
    }
    return $dates;
}

foreach($array1 as $event){
    $datebegin = $ical1->iCalDateToUnixTimestamp($event['DTSTART']);
    $dateend = $ical1->iCalDateToUnixTimestamp($event['DTEND']);
    $range = Between($datebegin, $dateend);
    foreach($range as $x){
        array_push($timestamps, $x);
    } 
}
foreach($array2 as $event){
    $datebegin = $ical2->iCalDateToUnixTimestamp($event['DTSTART']);
    $dateend = $ical2->iCalDateToUnixTimestamp($event['DTEND']);
    $range = Between($datebegin, $dateend);
    foreach($range as $x){
        array_push($timestamps, $x);
    } 
}

function getData($dataurl){
    
  $curl = curl_init($dataurl);
  curl_setopt($curl, CURLOPT_URL, $dataurl);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  //for debug only!
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  $resp = curl_exec($curl);
  curl_close($curl);
  return($resp);

}

$tekst = json_decode(getData("http://vakantiewolfheze.nl/admin/api/collections/get/maincontent?token=ae65b98efa82723b2166ed29191b5a"))->entries[0];
$shared = json_decode(getData("http://vakantiewolfheze.nl/admin/api/singletons/get/sharedcontent?token=ae65b98efa82723b2166ed29191b5a"));
$gallery = json_decode(getData("http://vakantiewolfheze.nl/admin/api/singletons/get/sharedcontent?token=ae65b98efa82723b2166ed29191b5a"))->galerij;

$activiteiten = json_decode(getData("http://vakantiewolfheze.nl/admin/api/collections/get/activiteit?token=ae65b98efa82723b2166ed29191b5a"))->entries;

$reviews = json_decode(getData("http://vakantiewolfheze.nl/admin/api/collections/get/reviews?token=ae65b98efa82723b2166ed29191b5a"))->entries;


?>

<!DOCTYPE html>
<html>
  <head>
    <style>
      :root{
        --landing-background: url(<?php echo($shared->landing_achtergrond->path) ?>);
        --parallax-background: url(<?php echo($shared->parallax_achtergrond->path) ?>);
      }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">
    <link rel="stylesheet" href="mobilenav.css">
  </head>
  <body>
    <div class="page">

      <div class="navigation-mobile">
        <nav role="navigation">
          <div id="menuToggle">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
            <ul id="menu">
              <li><a href="#">Home</a></li>
              <li><a href="#beschikbaarheid"><?php echo($tekst->beschikbaarheid_titel) ?></a></li>
              <li><a href="#inventaris"><?php echo($tekst->voorzieningen_titel) ?></a></li>
              <li><a href="#tarieven"><?php echo($tekst->tarieven_titel) ?></a></li>
              <li><a href="#reviews"><?php echo($tekst->reviews_titel) ?></a></li>
              <li><a href="#contact"><?php echo($tekst->contact_titel) ?></a></li>
              <li>
              <div class="langicon">
                <a href="#"><p>NL</p><img src="icons/netherlands.png"></a>
                <div class="dropdown-content">
                  <a href="index.php"><p>NL</p><img src="icons/netherlands.png" alt="NL"></a>
                  <a href="en.php"><p>EN</p><img src="icons/united-kingdom.png" alt="EN"></a>
                </div>
              </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>

      <div class="navigation navigation_clear" id="Nav">
        <a class="logo" href="#">Chalet Bosrust</a>
        <a href="#">Home</a>
        <a href="#beschikbaarheid"><?php echo($tekst->beschikbaarheid_titel) ?></a>
        <a href="#inventaris"><?php echo($tekst->voorzieningen_titel) ?></a>
        <a href="#tarieven"><?php echo($tekst->tarieven_titel) ?></a>
        <a href="#reviews"><?php echo($tekst->reviews_titel) ?></a>
        <a href="#contact"><?php echo($tekst->contact_titel) ?></a>
        <div class="langicon">
          <a href="en.php"><p>NL</p><img src="icons/netherlands.png"></a>
          <div class="dropdown-content">
            <a href="index.php"><p>NL</p><img src="icons/netherlands.png" alt="NL"></a>
            <a href="en.php"><p>EN</p><img src="icons/united-kingdom.png" alt="EN"></a>
          </div>
        </div>
      </div><!--navigation-->
      <div class="anchor" id="home"></div>
      <div class="header" id="landing">
        <div class="heading">
          <h1><?php echo($tekst->header_tekst) ?></h1>
          <a href="#lees-meer" class="btn"><?php echo($tekst->header_knop) ?></a>
        </div>
      </div><!--header-->
      <div class="anchor" id="lees-meer" ></div>
      <div class="section-light">
        <div class="content">
          <div class="rust-en-ruimte-grid">
            <div class="rust-en-ruimte-01">
              <h1><?php echo($tekst->lees_meer_titel_1) ?></h1>
              <p><?php echo($tekst->lees_meer_1) ?></p>
            </div>
            <div class="rust-en-ruimte-02">
              <img src="<?php echo($shared->lees_meer_afbeelding_1->path) ?>" alt="img">
            </div>
          </div>
          <div class="rust-en-ruimte-grid">
            <div class="rust-en-ruimte-01">
              <h1><?php echo($tekst->lees_meer_titel_2) ?></h1>
              <p><?php echo($tekst->lees_meer_2) ?></p>
            </div>
            <div class="rust-en-ruimte-02">
              <img src="<?php echo($shared->lees_meer_afbeelding_2->path) ?>" alt="img">
            </div>
          </div>
        </div>
      </div><!--lees meer-->

      <div class="parallax">
      </div><!--parallax-->

      <div class="section-dark">
        <div class="content">
          <h1>Galerij</h1>
          <div class="gallery">
            <?php
            $galleryarray = [];
            $i = 0;
            foreach($gallery as $image){
              array_push($galleryarray, $image->path);
              echo(
                  '<div class="gallerycard">
                    <button onclick="galleryToggle('. $i .')">
                      <img src="'. ($image->path) .'" alt="img">
                    </button>
                  </div><!--gallerycard-->'
              );
              $i = $i + 1;
            }
            ?>
          </div>
        </div>
      </div><!--gallery section-->

      <div class="parallax">
      </div><!--parallax-->

      <div class="anchor" id="beschikbaarheid"></div>
      <div class="section-dark">
        <div class="content">
          <h1><?php echo($tekst->beschikbaarheid_titel) ?></h1>
          <div class="beschikbaarheid-wrapper">
            <div id="litepicker1" class="cal"></div>
            <button onclick="res_popup(1)" class="btn">Reserveer</button>
          </div>   
        </div>
      </div><!--availability section-->

      <div class="parallax">
      </div><!--parallax-->

      <div class="anchor" id="inventaris"></div>
      <div class="section-dark">
        <div class="content">
          <div id="inv-grid">
            <div id="inv-list">
              <h1><?php echo($tekst->voorzieningen_titel) ?></h1>
              <ul>
                <?php
                $voorzieningen_array = preg_split("/\r\n|\n|\r/", $tekst->voorzieningen_lijst);
                foreach($voorzieningen_array as $voorziening){
                  echo('<li>'.$voorziening.'</li>');
                }
                ?>
              </ul>
            </div>
            <img id="inv-img-01" src="<?php echo($shared->voorzieningen_afbeelding_1->path) ?>" alt="img">
            <img id="inv-img-02" src="<?php echo($shared->voorzieningen_afbeelding_2)->path ?>" alt="img">
          </div>
        </div>
      </div>

      <div class="parallax">
      </div><!--parallax-->

      <div class="anchor" id="tarieven"></div>
      <div class="section-dark">
        <div class="content">
          <h1><?php echo($tekst->tarieven_titel) ?></h1>
          <div class="tarieven-wrapper">
            <div class="tarieven-tekst">
              <ul>
                <?php
                $tarieven_array = preg_split("/\r\n|\n|\r/", $tekst->tarieven_tekst);
                foreach($tarieven_array as $tarief_line){
                  echo('<li>'.$tarief_line.'</li>');
                }
                ?>
              </ul>
            </div>
            <div id="tarieven-tabel">
              <div id="midweek-label">
                <h3>Midweek</h3>
              </div>
              <div id="weekend-label">
                <h3>Weekend</h3>
              </div>
              <div id="dag-label">
                <h3>Day</h3>
              </div>
              <div id="laagseizoen-label">
                <h3>Low season<h3>
              </div>
              <div id="hoogseizoen-label">
                <h3>High season</h3>
              </div>
              <div id="mid-laag">
                <h4 id="mid-laag-l"><?php echo($shared->laagseizoen_midweek) ?></h4>
              </div>
              <div id="wend-laag">
                <h4 id="wend-laag-l"><?php echo($shared->laagseizoen_weekend) ?></h4>
              </div>
              <div id="dag-laag">
                <h4 id="dag-laag-l"><?php echo($shared->laagseizoen_dag) ?></h4>
              </div>
              <div id="mid-hoog">
                <h4><?php echo($shared->hoogseizoen_midweek) ?></h4>
              </div>
              <div id="wend-hoog">
                <h4><?php echo($shared->hoogseizoen_weekend) ?></h4>
              </div>
              <div id="dag-hoog">
                <h4><?php echo($shared->hoogseizoen_dag) ?></h4>
              </div>
            </div><!--tarieven tabel-->
          </div><!--tarieven wrapper-->

          <p class="hidden" id="Ccost"><?php echo($shared->schoonmaakkosten) ?></p>
          <p class="hidden" id="Tcost"><?php echo($shared->toeristenbelasting) ?></p>

        </div><!--content-->
      </div><!--tarieven-->

      <div class="parallax">
      </div><!--parallax-->

      <div id="activiteiten" class="section-light">
        <div class="content">
          <h1><?php echo($tekst->activiteiten_titel) ?></h1>
          
          <div class="activiteiten_container">
            <div class="activiteit-categorie">
              <img src="<?php echo($shared->activiteit_restaurants_afbeelding->path) ?>">
              <div id="restaurants-list" class="activiteiten-lijst">
                <?php
                foreach($activiteiten as $act){
                  if($act->categorie == "Restaurants"){
                    echo('
                    <a href="'.$act->link.'" class="activiteit">
                      <img src="'.($act->afbeelding->path).'">
                      <p>'.$act->titel.'</p>
                    </a><!--activiteit-->
                  ');
                  }
                }
                ?>
              </div>
              <div class="activiteit-categorie-onderschrift">
                <p><?php echo($tekst->activiteit_restaurants_titel) ?></p>
                <button id="restaurants-btn" onClick="toggleActivity(0)" class="btn">Lees meer</button>
              </div>
            </div><!--activiteit-categorie-->
            <div class="activiteit-categorie">
              <img src="<?php echo($shared->activiteit_steden_afbeelding->path) ?>">
              <div id="steden-list" class="activiteiten-lijst">
              <?php
                foreach($activiteiten as $act){
                  if($act->categorie == "Steden"){
                    echo('
                    <a href="'.$act->link.'" class="activiteit">
                      <img src="'.($act->afbeelding->path).'">
                      <p>'.$act->titel.'</p>
                    </a><!--activiteit-->
                  ');
                  }
                }
                ?>
              </div>
              <div class="activiteit-categorie-onderschrift">
                <p><?php echo($tekst->activiteit_steden_titel) ?></p>
                <button id="steden-btn" onClick="toggleActivity(1)" class="btn">Lees meer</button>
              </div>
            </div><!--activiteit-categorie-->
            <div class="activiteit-categorie">
              <img src="<?php echo($shared->activiteit_musea_afbeelding->path) ?>">
              <div id="musea-list" class="activiteiten-lijst">
              <?php
                foreach($activiteiten as $act){
                  if($act->categorie == "Musea"){
                    echo('
                    <a href="'.$act->link.'" class="activiteit">
                      <img src="'.($act->afbeelding->path).'">
                      <p>'.$act->titel.'</p>
                    </a><!--activiteit-->
                  ');
                  }
                }
                ?>
              </div>
              <div class="activiteit-categorie-onderschrift">
                <p><?php echo($tekst->activiteit_musea_titel) ?></p>
                <button id="musea-btn" onClick="toggleActivity(2)" class="btn">Lees meer</button>
              </div>
            </div><!--activiteit-categorie-->
            <div class="activiteit-categorie">
              <img src="<?php echo($shared->activiteit_natuur_afbeelding->path) ?>">
              <div id="natuur-list" class="activiteiten-lijst">
                <p>fietskaarten en wandelkaarten beschikbaar in het chalet</p>
                <?php
                foreach($activiteiten as $act){
                  if($act->categorie == "Natuur"){
                    echo('
                    <a href="'.$act->link.'" class="activiteit">
                      <img src="'.($act->afbeelding->path).'">
                      <p>'.$act->titel.'</p>
                    </a><!--activiteit-->
                  ');
                  }
                }
                ?>
              </div>
              <div class="activiteit-categorie-onderschrift">
                <p><?php echo($tekst->activiteit_natuur_titel) ?></p>
                <button id="natuur-btn" onClick="toggleActivity(3)" class="btn">Lees meer</button>
              </div>
            </div><!--activiteit-categorie-->
          </div>
        </div>
      </div>

      <div class="parallax">
      </div><!--parallax-->

      <div class="anchor" id="reviews"></div>
      <div class="section-dark">
        <div class="content">
          <h1><?php echo($tekst->reviews_titel) ?></h1>
          <?php
          $r = 0;
          foreach($reviews as $review){
            if($review->taal == "Nederlands"){
              if($r <= 2){
                echo('
                <div class="review">
                  <img src="'.($review->avatar->path).'" alt="avatar" class="review_avatar">
                  <div class="review_card">
                    <p class="name">'.$review->naam.'</p>
                    <p>'.$review->review.'</p>
                    <p>'.$review->datum_bron.'</p>
                  </div>
                </div><!--review-->
                ');
              }else{
                echo('
                <div class="review hidden-review hidrev">
                  <img src="'.($review->avatar->path).'" alt="avatar" class="review_avatar">
                  <div class="review_card">
                    <p class="name">'.$review->naam.'</p>
                    <p>'.$review->review.'</p>
                    <p>'.$review->datum_bron.'</p>
                  </div>
                </div><!--review-->
                ');
              }
              $r = $r + 1;
            }
          }
          if($r > 2){
            echo(
              '<button id="reviewbtn" onClick="reviewToggle()" class="btn">Lees meer</button>'
            );
          }
          ?>
        </div>
      </div>

      <div class="parallax">
      </div><!--parallax-->

      <div class="anchor" id="contact"></div>
      <div class="section-light">
        <div class="content">
          <h1><?php echo($tekst->contact_titel) ?></h1>
          <div class="split">
            <div id="contact_info">
              <div class="contact_info_inner">
                <h2>Info</h2>
                <ul>
                  <?php
                  $contact_array = preg_split("/\r\n|\n|\r/", $tekst->contact_tekst);
                  foreach($contact_array as $contact){
                    echo('<li>'.$contact.'</li>');
                  }
                  ?>
                </ul>
                <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q=Wolfhezerweg%20111%20wolfheze&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><style>.mapouter{position:relative;text-align:right;height:250px;width:100%;} .gmap_canvas {overflow:hidden;background:none!important;height:250px;width:100%;}</style></div></div>
              </div>
            </div><!--contact_info-->
            <div id="contact_form">
              <div class="contact_form_inner">
              <h2>Stuur een bericht</h2>
              <form action="handler.php" method="post">
                <input type="text" placeholder="Naam" class="forminput" required name="name">
                <input type="email" placeholder="E-mail" class="forminput" required name="email">
                <textarea name="message" id="" cols="30" rows="5" class="forminput" placeholder="Bericht" required></textarea name="message">
                <input type="submit" value="Stuur" class="forminput btn" id="formsubmit1">
              </form>
              </div>
            </div><!--contact_form-->
          </div><!--class split-->
        </div>
      </div><!--contact-->

      <div id="footer">
        <div id="footer_col_1">
        <?php
        $contact_array = preg_split("/\r\n|\n|\r/", $tekst->contact_tekst);
        foreach($contact_array as $contact){
          echo('<p>'.$contact.'</p>');
        }
        ?>
        </div><!--col1-->
        <div id="footer_col_2">
          <a href="#"><p>Home</p></a>
          <a href="#reviews"><p><?php echo($tekst->reviews_titel) ?></p></a>
          <a href="#beschikbaarheid"><p><?php echo($tekst->beschikbaarheid_titel) ?></p></a>
          <a href="#inventaris"><p><?php echo($tekst->voorzieningen_titel) ?></p></a>
          <a href="#contact"><p><?php echo($tekst->contact_titel) ?></p></a>
          <a href="#contact"><p><?php echo($tekst->tarieven_titel) ?></p></a>
        </div><!--col2-->
      </div><!--footer-->
      <div class="reservation-card" id="res-card">
        <div id="res-btn-wrapper">
          <button id="reservation-up-button" onClick="res_popup(1)">Reserveren</button>
        </div>
        <div id="res-form-wrapper">
          <form action="#" onsubmit="return false">
            <input autocomplete="off" type="daterange" name="date" id="litepicker2" class="forminput res-form-input-wide" placeholder="Van - Tot" required>
            <label for="peopleamount" class="formlabel res-form-label">Aantal personen:</label>
            <select class="forminput res-form-input" name="peopleamount" id="peopleamount">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
            <br>
            <label class="formlabel res-form-label" for="pricetag">Prijs:</label>
            <input class="forminput res-form-input" type="text" id="pricetag" disabled>
            <p>*prijs inclusief schoonmaakkosten en toeristenbelasting</p>
            <input type="submit" onClick="bookingModalToggle(1)" class="forminput btn" value="Reserveer"></input>
          </form>
        </div>
      </div>
    </div><!--page--> 
    <div class="modals">
        <div class="gallerymodal" id="gallerymodal">
          <div class="modalinner">
              <button class="modalclose" onclick="galleryToggle(-3)">
                <img src="icons/close.png" alt="close">
              </button>
            <div class="mainimg-wrapper">
              <button class="arrowbutton" onclick="galleryToggle(-1)">
                <img src="icons/left.png" alt="">
              </button>
              <img class="mainimg" src="" alt="img" id="galleryimg">
              <button class="arrowbutton" onclick="galleryToggle(-2)">
                <img src="icons/right.png" alt="">
              </button>
            </div>
          </div>
        </div><!--gallerymodal-->
        <div class="bookingmodal" id="bookingmodal">
          <div class="modalinner">
              <button class="modalclose" onclick="bookingModalToggle(0)">
                <img src="icons/close.png" alt="close">
              </button>
            <div class="main-wrapper">
              <p>Na het indienen van uw reservering ontvangt u van ons een rekening. Annuleren kan kosteloos tot 14 dagen voor aankomst.</p>
              <form action="bookinghandler.php" method="post" id="main-booking-form">
                <input name="pr" class="hidden" type="text" id="pr">
                <input type="text" name="fname" id="fname" class="forminput res-form-input" placeholder="Voornaam" required>
                <input type="text" name="sname" id="sname" class="forminput res-form-input" placeholder="Achternaam" required>
                <input type="email" name="email" id="email" class="forminput res-form-input-wide" placeholder="E-mail" required>
                <input type="daterange" name="date" id="litepicker3" class="forminput res-form-input-wide" placeholder="DD-MM-YYYY - DD-MM-YYYY" required>
                <input type="text" name="straat" id="straat" class="forminput res-form-input-small" placeholder="Straat" required>
                <input type="number" name="huisnr" id="huisnr" class="forminput res-form-input-small" placeholder="Huisnummer" required>
                <input type="text" name="postcode" id="postcode" class="forminput res-form-input-small" placeholder="Postcode" required>
                <input type="text" name="land" id="land" class="forminput res-form-input-small" placeholder="Land" required>
                <input type="text" name="telnr" id="telnr" class="forminput res-form-input-small" placeholder="Telefoon nummer" required>
                <select class="forminput res-form-input-small" name="peopleamount2" id="peopleamount2">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
                <textarea name="message" id="res-message" cols="30" rows="5" class="forminput res-form-input" placeholder="Bericht"></textarea>
                <div id="formdiv1">
                  <label class="formlabel res-form-label" for="pricetag2">Prijs:</label>
                  <input name="pricetag2" class="forminput res-form-input" type="text" id="pricetag2" disabled>
                  <p>*prijs inclusief schoonmaakkosten en toeristenbelasting</p>
                  <input type="submit" value="Reserveer" class="btn" id="btn3">
                </div>
              </form>
            </div>
          </div>
        </div><!--bookingmodal-->
    </div><!--modals-->
    <script type="text/javascript">
    var timestamps =<?php echo json_encode($timestamps); ?>;
    var galleryarray =<?php echo json_encode($galleryarray); ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/plugins/mobilefriendly.js"></script>
    <script src="calendars.js"></script>
    <script src="script.js"></script>
  </body>
</html>