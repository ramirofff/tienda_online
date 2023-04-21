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
            border: 4px double white;
            margin: 14px;
            padding: 20px;
            text-align: center;
            background: url("https://images.pexels.com/photos/937980/pexels-photo-937980.jpeg?cs=srgb&dl=pexels-tetyana-kovyrina-937980.jpg&fm=jpg") no-repeat center fixed;
            background-size: cover;
            border-radius: 14px;
            font-size: 20px;
        }

        h1, h2, p {
            color: white;
            text-shadow: 7px 4px 5px blue;
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

        .carrito-imagen, .logo {
            max-width: 50px;
            border-radius: 30px;
        }

        .row {
            margin: auto;
            border-collapse: separate;
            border-spacing: 10px 5px;
            color: white;
        }

        .footerFlex {
            display: flex;
            justify-content: space-around;
            font-size: 15px;
            list-style: none;
            color: white;
        }

        strong, hr {
            color: white;
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
        <?php
        include "sesion.php";
        include "conexion.php";
        $query="SELECT * FROM productos WHERE cantidad > 0 ORDER BY tipo";
        $consulta=mysqli_query($conexion,$query);
        $cantidad=mysqli_num_rows($consulta);
        if($cantidad > 0){?>
            <h1>Carrito:</h1>
            <br/><hr/>
            <div class="row container">
                <div class="col-6">
                    <p>Producto</p>
                </div>
                <div class="col-3">
                    <p>Precio</p>
                </div>
                <div class="col-3">
                    <p>Cantidad</p>
                </div>
            </div>
            <hr/>
            <?php while($obj=mysqli_fetch_object($consulta)){ ?>
                <div class="row">
                    <div class="col-2">
                        <div class="d-flex align-items-center justify-content-around h-100 border-bottom pb-2 pt-3 tab">
                            <img src="<?php echo $obj->imagen?>" class="carrito-imagen" alt="...">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-items-center justify-content-around h-100 border-bottom pb-2 pt-3 tab">
                            <h5><?php echo $obj->nombre?></h5>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="d-flex align-items-center justify-content-center h-100 border-bottom pb-2 pt-3">
                            <h5>$ <?php echo $obj->precio * $obj->cantidad?></h5>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="d-flex align-items-center justify-content-evenly h-100 border-bottom pb-2 pt-3">
                            <h5><?php echo $obj->cantidad?></h5>
                            <a href="eliminarCarrito.php?nombre=<?php echo $obj->nombre?>" class="btn btn-danger btn-sm">X</a>
                        </div>
                    </div>
                </div>
		    <?php }
        }else{ ?>
            <img src="https://www.mercadomate.com.ar/images/carritovacio.png" alt="...">
        <?php } ?>
        <br/><br/>
        <?php
            $query="SELECT * FROM productos WHERE cantidad > 0";
            $consulta=mysqli_query($conexion,$query);
            $total=0;
            while($obj=mysqli_fetch_object($consulta)){
                $total = $total + ($obj->cantidad * $obj->precio);
            }
            $_SESSION['total_carrito'] = $total;
            echo '<p>El total es: $ '.$total.'<p>';
        ?>
        <a href="pago.php" class="btn btn-primary btn-lg" onclick="return <?php echo $total?> > 0">
            <i class="bi bi-cart-check"></i> Comprar
        </a>
        <br/><br/>
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