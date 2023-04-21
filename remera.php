<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" href="https://img.icons8.com/ios-glyphs/480/clothes.png" type="image/ico"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css"/>
  <link rel="stylesheet" href="https://bootswatch.com/5/lumen/bootstrap.min.css">
  <title>Tienda Online UNO</title>
  <style>
    body {
      border: 4px double navy;
      margin: 14px;
      padding: 20px;
      text-align: center;
      background-color: Honeydew;
      border-radius: 14px;
      font-size: 20px;
    }

    h1, h2 {
      color: black;
      text-shadow: 7px 4px 5px grey;
      text-transform: uppercase;
    }

    p {
      color: green;
    }

    nav {
      border: 2px solid black;
      padding: 50px;
      background-image: url('https://img.freepik.com/free-vector/blue-curve-frame-template_53876-116707.jpg?w=740&t=st=1674014146~exp=1674014746~hmac=2453ccec99191cab7fa36639ccf88a498df2d802b26a2fb45f0fd61a1f592d9e');
      background-size: 100% 100%;
    }

    .menu {
      display: flex;
      justify-content: space-around;
    }

    .menu a {
      display: inline-block;
      padding: 10px 30px;
    }

    @media (max-width: 700px) {
      .menu {
        flex-direction: column;
      }

      .menu a {
        margin: 10px 0;
      }
    }

    .header-section {
      display: flex;
      justify-content: space-between;
      margin: auto;
      position: relative;
    }

    .logo {
      max-width: 50px;
      border-radius: 30px;
    }

    .container {
      justify-content: center;
      width: auto;
      height: auto;
      display: flex;
      flex-wrap: wrap;
      overflow: hidden;
    }

    .card {
      max-width: 420px;
      box-shadow: 0 2px 2px rgba(0,0,0,0.2);
      transition: all 0.25s;
      float: left;
      margin: 15px;
    }

    .card:hover {
      transform: translate(-10px);
      box-shadow: 0 12px 16px rgba(0,0,0,0.2);
    }

    .card-img-top {
      width: 100%;
      height: 100%;
      border-radius: 6px;
      transition: all 0.5s linear;
    }

    .card-img-top:hover {
      transform: scale(1.1);
    }

    .footerFlex {
      display: flex;
      justify-content: space-around;
      font-size: 15px;
      list-style: none;
    }
  </style>
</head>
<body>
  <div id="app">
    <header id="header"></header>
    <h1>{{titulo}}</h1>
    <br/>
    <h2>Ropa de moda</h2>
    <br/><br/>
    <nav id="nav"></nav>
    <br/><br/>
    <section>
      <p>Descubrí las ultimas tendencias de moda en la tienda online UNO!</p>
      <br/>
      <h3 class="bg-info">Remeras</h3>
      <br/>
      <div class="container">
        <?php
        include "sesion.php";
        include "conexion.php";

        $query="SELECT * FROM productos WHERE tipo = 'remera' ORDER BY precio";
        $consulta=mysqli_query($conexion,$query);
        $cantidad=mysqli_num_rows($consulta);
        
        if($cantidad > 0){
		      while($obj=mysqli_fetch_object($consulta)){ ?>
            <div class="card border-success">
              <div class="row">
                <div class="col-md-7">
                  <img src="<?php echo $obj->imagen?>" class="card-img-top" alt="..."/>
                </div>
                <div class="col-md-5">
                  <div class="card-body">
                    <h3><?php echo $obj->nombre?></h3>
                    <p>$ <?php echo $obj->precio?></p>
                    <span v-if="<?php echo $obj->cantidad?> > 1">Has comprado <?php echo $obj->cantidad?> remeras</span>
                    <span v-if="<?php echo $obj->cantidad?> === 1">Has comprado 1 remera</span>
                    <span v-if="<?php echo $obj->cantidad?> === 0"><br/></span>
                    <br/>
                    <span v-if="<?php echo $obj->stock?> > 0">stock disponible: <?php echo $obj->stock?></span>
                    <span v-if="<?php echo $obj->stock?> === 0">Se ha agotado esta remeras</span>
                    <br/><br/>
                    <form action="añadirCarrito.php" method="post">
                      <input name="nombre" type="hidden" value="<?php echo $obj->nombre?>"/>
                      <button type="submit" class="btn btn-success" :disabled="<?php echo $obj->stock?> === 0">
                        <i class="bi bi-cart-plus"></i> Añadir al carrito
                      </button>
                    </form>
                    <br/>
                    <form action="sacarCarrito.php" method="post">
                      <input name="nombre" type="hidden" value="<?php echo $obj->nombre?>"/>
                      <button type="submit" class="btn btn-danger" :disabled="<?php echo $obj->cantidad?> === 0">
                        <i class="bi bi-cart-x"></i> Sacar del carrito
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <br/>
		      <?php }
        } ?>
      </div>
    </section>
    <br/>
    <footer id="footer"></footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="header-nav-footer.js"></script>
  <script>
    const app = new Vue({
      el: '#app',
      data: {
        titulo: 'Tienda Online UNO',
      },
    });
  </script>
</body>
</html>