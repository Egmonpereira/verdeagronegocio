<?php
    include_once "../../config/conexao.php";
    include_once "../../config/protecao-sessao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/favicon.png" type="image/x-icon">
    <title>Seus pedidos - Verde Agro Negócio</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-icons.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/estilo.css" media="screen" />
    <link href="https://fonts.cdnfonts.com/css/inknut-antiqua" rel="stylesheet">

    <header>
            <?php
            include "header_pagina.php";
            ?>
    </header>

</head>

<body>

    <!-- Button trigger modal -->
    <div class="container"  style="padding-bottom: 500px;">
        <h4 class="pt-5">Seus pedidos</h4>
        <h6 class="pb-3">Consulte aqui todos os seus pedidos</h6>
        <?php
            $idCliente = $_SESSION['id_cliente'];
            $sql = "SELECT pdd.id_pedido, pdd.pagamento, pdd.valor, pdd.data_pedido FROM pedido as pdd, pedido_produto as pp WHERE pdd.id_cliente = '$idCliente' AND pp.id_cliente = pdd.id_cliente GROUP BY id_pedido;";        
            $consultarPedidos = mysqli_query($conn, $sql);

           if($consultarPedidos == false){
            echo mysqli_error($conn);
           }else {
                if(mysqli_num_rows($consultarPedidos)==0){

                    ?>

                    <h5>Não há pedidos realizados.</h5>

                    <?php

                }else{
                    ?>
                        <form>
                        <table class="table table-striped align-middle" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th scope="col">Pedido</th>
                                <th scope="col">Pagamento</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Data</th>
                            </tr> 
                        </thead>
                        <tbody>

            
                
            <?php
            $contador = 0;
            $pedidos = 0;
          
                while($pedidos = mysqli_fetch_assoc($consultarPedidos)){
                    $contador++;
            ?>

                <tr>
                    <th scope="row">
                     <button onclick="carregarPedido<?php echo $contador;?>(<?php echo $pedidos['id_pedido'];?>)" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php  echo $pedidos['id_pedido'];?></button>
                    </th>
                    <td><?php echo $pedidos['pagamento'];?></td>
                    <td><?php echo 'R$ ' . number_format($pedidos['valor'],2,",",".");?></td>
                    <td><?php echo $pedidos['data_pedido'];?></td>
                </tr>
           
       
        </form>
        <script type="text/javascript">
         function carregarPedido<?php echo $contador;?>(n){
            $.post("../../config/carregar-pedido.php", {id_pedido:n}, function(x){$('.retorno').html(x); $('#exampleModalLabel').html("Pedido " + n)});
            }
        </script>

                    <?php
                    
                }

                ?>
 </tbody>
        </table>
                <?php
           }
        }


        ?>
        
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">
        
     </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span class="retorno"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>



<footer>
            <?php
                include "footer.php";
            ?>
    </footer>


    <script type="text/javascript" src="../../assets/js/bootstrap.bundle.min.js"></script>
    
    
</body>

</html>