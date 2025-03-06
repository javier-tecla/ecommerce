<footer>
  <div class="container-fluid bg-dark small footerBlock">

    <div class="container py-5 text-light">

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

        <div class="col row">

          <div class="col-12 col-sm-4 col-md-3 col-lg-4">

            <h4 class="lead">

              <a href="#" class="text-uppercase">Ropa</a>

            </h4>

            <hr class="border-white">

            <ul>

              <li>
                <a href="#">Ropa para dama</a>
              </li>
              <li>
                <a href="#">Ropa para hombre</a>
              </li>
              <li>
                <a href="#">Ropa deportiva</a>
              </li>
              <li>
                <a href="#">Ropa infantil</a>
              </li>

            </ul>

          </div>

          <div class="col-12 col-sm-4 col-md-3 col-lg-4">

            <h4 class="lead">

              <a href="#" class="text-uppercase">Calzado</a>

            </h4>

            <hr class="border-white">

            <ul>

              <li>
                <a href="#">Calzado para dama</a>
              </li>
              <li>
                <a href="#">Calzado para hombre</a>
              </li>
              <li>
                <a href="#">Calzado deportiva</a>
              </li>
              <li>
                <a href="#">Calzado infantil</a>
              </li>

            </ul>

          </div>

          <div class="col-12 col-sm-4 col-md-3 col-lg-4">

            <h4 class="lead">

              <a href="#" class="text-uppercase">Tecnología</a>

            </h4>

            <hr class="border-white">

            <ul>

              <li>
                <a href="#">Telefonía móvil</a>
              </li>
              <li>
                <a href="#">Tabletas electrónicas</a>
              </li>
              <li>
                <a href="#">Computadoras</a>
              </li>
              <li>
                <a href="#">Auriculares</a>
              </li>

            </ul>

          </div>

          <div class="col-12 col-sm-4 col-md-3 col-lg-4">

            <h4 class="lead">

              <a href="#" class="text-uppercase">Cursos</a>

            </h4>

            <hr class="border-white">

            <ul>

              <li>
                <a href="#">Desarrollo web</a>
              </li>
              <li>
                <a href="#">Aplicaciones móviles</a>
              </li>
              <li>
                <a href="#">Diseño gráfico</a>
              </li>
              <li>
                <a href="#">Marketing digital</a>
              </li>

            </ul>

          </div>

        </div>

        <div class="col my-3 my-lg-0 px-lg-5 text-light">

          <h1 class="lead small">Dudas e inquietudes, contáctenos en:</h1>

          <br>

          <h1 class="lead small">

            <i class="fa fa-phone-square pe-2"></i> (555) 555-55-55

            <br><br>

            <i class="fa fa-envelope pe-2"></i> soporte@tiendavirtual.com

            <br><br>

            <i class="fa fa-map-marker pe-2"></i> Av. Amancio Alcorta 2184, C1283

            <br><br>

            Cdad. Autónoma de Buenos Aires | Argentina

          </h1>

          <iframe class="mt-3" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d532.1138458116545!2d-58.392357539025426!3d-34.64139663638223!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccb2ecf3628c3%3A0xe28ee532a82b3259!2sSanta%20Planta%20Distribuidora%20de%20Grow%20Shops!5e0!3m2!1ses!2sar!4v1735357551037!5m2!1ses!2sar" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>

        <div class="col small my-3 my-lg-0">

          <h4>RESUELVA SU INQUIETUD</h4>

          <form role="form" method="post">

            <input type="text" id="nombreContactenos" name="nombreContactenos" class="form-control" placeholder="Escriba su nombre" required>

            <br>

            <input type="email" id="emailContactenos" name="emailContactenos" class="form-control" placeholder="Escriba su correo electrónico" required>

            <br>

            <textarea name="mensajeContactenos" id="mensajeContactenos" class="form-control" placeholder="Escriba su mensaje" rows="5" required></textarea>

            <br>

            <input type="submit" value="Enviar" class="btn btn-default float-end border-0 templateColor">

          </form>

        </div>

      </div>

    </div>

  </div>

  <!-- Main Footer -->
  <footer class="main-footer topColor">

    <div class="container">
      <!-- To the right -->
      <div class="float-end">

        <div class="d-flex justify-content-center" style="line-height:0px">

          <?php foreach ($socials as $key => $value): ?>

            <div class="p-2">

              <a href="<?php echo $value->url_social ?>" target="_blank">

                <i class="<?php echo $value->icon_social ?> <?php echo $value->color_social ?>"></i>

              </a>

            </div>


          <?php endforeach ?>







        </div>

      </div>
      <!-- Default to the left -->
      <small>&copy; <?php echo date("Y") ?> Todos los derechos reservados. Sitio elaborado por la Compañia.</small>
    </div>
  </footer>