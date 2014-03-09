<div class="flexslider">
  <ul class="slides">
    <li>
      <img src="slideshow/slide1.png" />
    </li>
    <li>
      <img src="slideshow/slide2.png" />
    </li>
    <li>
      <img src="slideshow/slide3.png" />
    </li>
    <li>
      <img src="slideshow/slide4.png" />
    </li>
    <li>
      <img src="slideshow/slide5.png" />
    </li>
  </ul>
</div>

<style>
    .flexslider{
        width:784px;
        height:300px;
        border:none !important;
        margin:0px;
    }
    
    .flexslider img{
        width:784px;
        height:300px;
    }
</style>

<script type="text/javascript">
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshowSpeed: 5000,
    pauseOnAction:false
  });
});
</script>