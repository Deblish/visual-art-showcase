<?php
require_once('../config/cargador.php');
use Controladores\Router;

use Modelos\WeeklyShowcase;
use Modelos\Artist;
use Modelos\Artwork;
use Modelos\ShowcaseArtwork;
use Modelos\Category;

include Router::direccion('/plantillas/header.php');
?>

<!-- <div class="container mt-5"> -->
    <!-- year -->
    <!-- <p>
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseYear" role="button" aria-expanded="false" aria-controls="collapseYear">
            year (current)
        </a>
    </p> -->
    <!-- <div class="collapse" id="collapseYear"> -->
        <!-- all weeks -->
        <!-- <div class="card card-body"> -->
            <!-- week 1 -->
            <?php
            //loop starts
            $day = WeeklyShowcase::convertToDate("now");//starting day
            $dayID = WeeklyShowcase::whichID($day); // which week is $day
            while ($dayID > 0) {
                $weeklyShowcaseOBJ = WeeklyShowcase::consultar($dayID);
                $weekStartDate = $weeklyShowcaseOBJ->weekStartDate;
                $weekEndDate = $weeklyShowcaseOBJ->weekEndDate;
                $featuredArtistID = $weeklyShowcaseOBJ->featuredArtistID;
                $artistOBJ = Artist::consultar($featuredArtistID);
                $artistName = $artistOBJ->artistName;
                $artistBio = $artistOBJ->bio;
                $weekNumber = $weeklyShowcaseOBJ->weeklyShowcaseID;
                if($weekNumber >= 53){
                    $weekNumber -= 52;
                }
            ?>
            <div class="card mb-2">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $artistName;?></h2>
                    <h6 class="card-subtitle mb-2 text-muted"> from <?php echo $weekStartDate?> to <?php echo $weekEndDate?></h6>

                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseWeek<?php echo $weekNumber; ?>" role="button" aria-expanded="false" aria-controls="collapseWeek<?php echo $weekNumber; ?>"> Showcase <?php echo $weekNumber; ?> </a>

                    <div class="collapse" id="collapseWeek<?php echo $weekNumber; ?>">
                        <!-- Artworks -->
                        <div class="card card-body">
                        <?php
                            $showcaseArtworks = ShowcaseArtwork::consultar($dayID);
                            foreach ($showcaseArtworks as $week) {
                                $artworkOBJ = Artwork::consultar($week['artwork_id']);
                                $artworkID = $artworkOBJ->artworkID;
                                $artworkTitle = $artworkOBJ->title;
                                $technicalSheet = $artworkOBJ->technicalSheet;
                                $imageURL = $artworkOBJ->imageURL;
                                $categoryID = Category::consultar($artworkOBJ->categoryID);
                                ?>
                                
                                <?php
                                ?>
                                <div class="card mb-1">
                                    <img src="<?php Router::rutaImagenWeb($imageURL);?>" class="card-img-top previewable-image zoomable-image" alt="<?php echo $artworkTitle; ?>"> 

                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $artworkTitle; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $technicalSheet; ?> </h6>
                                        <p class="card-text">Category: <?php echo $categoryID['category_name']; ?></p>
                                        <a href="#artwork<?php echo $artworkID;?>" class="card-link">Go to artwork: <?php echo $artworkID;?> </a>
                                        <a href="#artist<?php echo $featuredArtistID;?>" class="card-link">Go to artist: <?php echo $featuredArtistID;?> </a>
                                    </div>
                                </div>
                                <?php
                            }
                            $dayID--;
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
            <!-- n weeks -->
        <!-- </div> -->
    <!-- </div> -->
    <!-- n years -->
<!-- </div> -->
<?php
include Router::direccion('/plantillas/footer.php');
?>




