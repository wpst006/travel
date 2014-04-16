<?php include ('includes/includefiles.php'); ?>

<?php include ('includes/header.php'); ?>

<link href="css/galleriffic-2.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.galleriffic.js" type="text/javascript"></script>    
<script type="text/javascript" src="js/jquery.opacityrollover.js"></script>

<style>
    ul.thumbs img {
        width: 75px;
    }
    
    div.slideshow a.advance-link {
        line-height: 350px;
    }
    
    #caption{
        display:none;
    }
</style>

<div id="page">
    <div id="container">				
        <!-- Start Advanced Gallery Html Containers -->
        <div id="gallery" class="content">
            <div id="controls" class="controls"></div>
            <div class="slideshow-container">
                <div id="loading" class="loader"></div>
                <div id="slideshow" class="slideshow"></div>
            </div>
            <div id="caption" class="caption-container"></div>
        </div>
        <div id="thumbs" class="navigation">
            <ul class="thumbs noscript">
                <li>
                    <a class="thumb" name="leaf" href="slideshow/gallery/gallery01.gif" title="Title #0">
                        <img src="slideshow/gallery/gallery01.gif" alt="Title #0" />
                    </a>
                    <div class="caption">
                        <div class="download">
                            <a href="slideshow/gallery/gallery01.gif">Download Original</a>
                        </div>
                        <div class="image-title">Title #0</div>
                        <div class="image-desc">Description</div>
                    </div>
                </li>

                <li>
                    <a class="thumb" name="leaf" href="slideshow/gallery/gallery02.gif" title="Title #0">
                        <img src="slideshow/gallery/gallery02.gif" alt="Title #0" />
                    </a>
                    <div class="caption">
                        <div class="download">
                            <a href="slideshow/gallery/gallery02.gif">Download Original</a>
                        </div>
                        <div class="image-title">Title #0</div>
                        <div class="image-desc">Description</div>
                    </div>
                </li>

                <li>
                    <a class="thumb" name="leaf" href="slideshow/gallery/gallery03.gif" title="Title #0">
                        <img src="slideshow/gallery/gallery03.gif" alt="Title #0" />
                    </a>
                    <div class="caption">
                        <div class="download">
                            <a href="slideshow/gallery/gallery03.gif">Download Original</a>
                        </div>
                        <div class="image-title">Title #0</div>
                        <div class="image-desc">Description</div>
                    </div>
                </li>

                <li>
                    <a class="thumb" name="leaf" href="slideshow/gallery/gallery04.gif" title="Title #0">
                        <img src="slideshow/gallery/gallery04.gif" alt="Title #0" />
                    </a>
                    <div class="caption">
                        <div class="download">
                            <a href="slideshow/gallery/gallery04.gif">Download Original</a>
                        </div>
                        <div class="image-title">Title #0</div>
                        <div class="image-desc">Description</div>
                    </div>
                </li>

                <li>
                    <a class="thumb" name="leaf" href="slideshow/gallery/gallery05.gif" title="Title #0">
                        <img src="slideshow/gallery/gallery05.gif" alt="Title #0" />
                    </a>
                    <div class="caption">
                        <div class="download">
                            <a href="slideshow/gallery/gallery05.gif">Download Original</a>
                        </div>
                        <div class="image-title">Title #0</div>
                        <div class="image-desc">Description</div>
                    </div>
                </li>

                <li>
                    <a class="thumb" name="leaf" href="slideshow/gallery/gallery06.gif" title="Title #0">
                        <img src="slideshow/gallery/gallery06.gif" alt="Title #0" />
                    </a>
                    <div class="caption">
                        <div class="download">
                            <a href="slideshow/gallery/gallery06.gif">Download Original</a>
                        </div>
                        <div class="image-title">Title #0</div>
                        <div class="image-desc">Description</div>
                    </div>
                </li>
                
            </ul>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // We only want these styles applied when javascript is enabled
        $('div.navigation').css({'width' : '200px', 'float' : 'left'});
        $('div.content').css('display', 'block');

        // Initially set opacity on thumbs and add
        // additional styling for hover effect on thumbs
        var onMouseOutOpacity = 0.67;
        $('#thumbs ul.thumbs li').opacityrollover({
            mouseOutOpacity:   onMouseOutOpacity,
            mouseOverOpacity:  1.0,
            fadeSpeed:         'fast',
            exemptionSelector: '.selected'
        });
				
        // Initialize Advanced Galleriffic Gallery
        var gallery = $('#thumbs').galleriffic({
            delay:                     2000,
            numThumbs:                 15,
            preloadAhead:              10,
            enableTopPager:            true,
            enableBottomPager:         true,
            maxPagesToShow:            7,
            imageContainerSel:         '#slideshow',
            controlsContainerSel:      '#controls',
            captionContainerSel:       '#caption',
            loadingContainerSel:       '#loading',
            renderSSControls:          true,
            renderNavControls:         true,
            playLinkText:              'Play Slideshow',
            pauseLinkText:             'Pause Slideshow',
            prevLinkText:              '&lsaquo; Previous Photo',
            nextLinkText:              'Next Photo &rsaquo;',
            nextPageLinkText:          'Next &rsaquo;',
            prevPageLinkText:          '&lsaquo; Prev',
            enableHistory:             false,
            autoStart:                 true,
            syncTransitions:           true,
            defaultTransitionDuration: 900,
            onSlideChange:             function(prevIndex, nextIndex) {
                // 'this' refers to the gallery, which is an extension of $('#thumbs')
                this.find('ul.thumbs').children()
                .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                .eq(nextIndex).fadeTo('fast', 1.0);
            },
            onPageTransitionOut:       function(callback) {
                this.fadeTo('fast', 0.0, callback);
            },
            onPageTransitionIn:        function() {
                this.fadeTo('fast', 1.0);
            }
        });
    });
</script>
<?php include ('includes/footer.php'); ?>