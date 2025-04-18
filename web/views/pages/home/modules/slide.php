<link rel="stylesheet" href="<?php echo $path ?>views/assets/css/slide/slide.css">

<div class="jd-slider">
    <div class="slide-inner">
        <ul class="slide-area">
            <li>
                <img src="<?php echo $path ?>views/assets/img/slide/1/back_default.jpg" class="img-fluid" alt="Imagen del slider uno">

                <div class="slideOpt opt1">

                    <img src="<?php echo $path ?>views/assets/img/slide/1/calzado.png" style="top:15%; right:10%; width:45%" alt="imagen calzado">

                    <div class="slideText" style="top:20%; left:10%; width:40%">

                        <h1 class="text-uppercase" style="color:#333">Lorem Ipsum</h1>

                        <h2 class="text-uppercase" style="color:#777">Lorem ipsum dolor sit</h2>

                        <h3 class="text-uppercase" style="color:#888">Lorem ipsum dolor sit</h3>

                        <a href="#">

                            <button class="my-lg-3 btn text-uppercase templateColor border-0">

                                VER PRODUCTO

                            </button>

                        </a>

                    </div>

                </div>

            </li>
            <li>
                <img src="<?php echo $path ?>views/assets/img/slide/2/fondo2.jpg" class="img-fluid" alt="Imagen del slider dos">

                <div class="slideOpt opt2">

                    <img src="<?php echo $path ?>views/assets/img/slide/2/iphone.png" style="bottom:0%; left:15%; width:28%" alt="imagen iphone">

                    <div class="slideText" style="top:20%; right:15%; width:40%">

                        <h1 class="text-uppercase" style="color:#333">Lorem Ipsum</h1>

                        <h2 class="text-uppercase" style="color:#777">Lorem ipsum dolor sit</h2>

                        <h3 class="text-uppercase" style="color:#888">Lorem ipsum dolor sit</h3>

                        <a href="#">

                            <button class="my-lg-3 btn text-uppercase templateColor border-0">

                                VER PRODUCTO

                            </button>


                        </a>

                    </div>



                </div>
            </li>
            <li>
                <img src="<?php echo $path ?>views/assets/img/slide/3/fondo3.jpg" class="img-fluid" alt="Imagen del slider tres">

                <div class="slideText" style="top:20%; right:15%; width:40%"></div>


            </li>
        </ul>
    </div>
    <a class="prev d-none d-lg-block" href="#">
        <i class="fas fa-angle-left text-white px-2 py-4 rounded-right" style="background: rgba(0,0,0,.5);"></i>
    </a>
    <a class="next d-none d-lg-block" href="#">
        <i class="fas fa-angle-right text-white px-2 py-4 rounded-left" style="background: rgba(0,0,0,.5);"></i>
    </a>
    <div class="controller py-2">
        <div class="indicate-area"></div>
    </div>
</div>

<div class="d-flex justify-content-center">

    <a id="btnSlide" class="btn border-0 rounded-0 templateColor py-2" style="width: 200px">

        <i class="fa fa-angle-up templateColor"></i>

    </a>

</div>

<script src="<?php echo $path ?>views/assets/js/slide/slide.js"></script>