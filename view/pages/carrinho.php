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
    <title>Seu carrinho - Verde Agro Negócio</title>
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

    <div class="container" style="padding-top:38px;padding-bottom: 500px;">
        <h4 class="pt-5">Seu carrinho de compras</h4>
        <h6 class="pb-3">Itens do seu carrinho</h6>

        <h6 class="teste"></h6>
        <?php
            if(!isset($_SESSION['itens'])){
        ?>
            <h5>Sem produtos no carrinho.</h5>

         <?php
            }else{
                if(count($_SESSION['itens'])==0){
                    ?>
                    <h5>Sem produtos no carrinho.</h5>
                    <?php
                 }else{
         ?>

    <form action="finalizar-pedido.php" method="POST">
        <table class="table table-striped align-middle" style="font-size: 14px;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Café</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Ação</th>
                </tr> 
            </thead>
            <tbody>

            <?php
                $totalCarrinho = 0;
                $contador = 0;
               foreach ($_SESSION['itens'] as $chave => $subchave) {

                $contador++;
            ?>
                    <tr>
                        <th scope="row"><?php echo $_SESSION['itens'][$chave]["id_produto"]; ?></th>
                        <td><?php echo $_SESSION['itens'][$chave]["nome"] . " - " . $_SESSION['itens'][$chave]["descricao"]; ?></td>
                        <td><?php echo $_SESSION['itens'][$chave]["quantidade"]; ?></td>
                        <td><?php echo "R$ " . number_format($_SESSION['itens'][$chave]["total"],2,",","."); ?></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm text-center" onclick="rmCarrinho<?php echo $contador;?>(<?php echo $_SESSION['itens'][$chave]['id_produto'];?>)"><i class="bi bi-x-lg"></i></button>

                        </td>

                        <?php 
                           $totalCarrinho += $_SESSION['itens'][$chave]["total"];
                                      
                        ?>
                        

                
               
              <?php
               }

               $_SESSION['totalCarrinho'] = $totalCarrinho;
               

            

               

               
              ?>

                </tr>
                
                <tr>
                <th>Total: </th>
                <td></td>
                <td></td>
                <th>
            <?php
                echo "R$ " . number_format($totalCarrinho,2,",",".");

                ?>
                
                </th>
                <td></td>
                </tr>
            </tbody>
        </table>
       
        <button type="submit" class="btn btn-success btn-sm text-center w-25" name="bt_fazer_pedido">Fazer pedido</button>
       
        </form>
        <?php
            }
        }
        ?>
    </div>

    <script type="text/javascript" src="../../assets/js/bootstrap.bundle.min.js"></script>
    

     <?php
      $contador2=0;

      if(isset($_SESSION['itens'])){
        foreach ($_SESSION['itens'] as $chave => $subchave) {

            $contador2++;
    
            ?>
                    <script type="text/javascript">
                        function rmCarrinho<?php echo $contador2;?>(n){
                            $.post("../../config/rmCarrinho.php", {id_prd:n}, function(x){$('.teste').html(x)});
                            console.log(n)
                        }
                    </script>
    
    <?php
          }

      }
      
     ?>
    <footer>
            <?php
                include "footer.php";
            ?>
    </footer>


    <script type="text/javascript" src="../../assets/js/bootstrap.bundle.min.js"></script>
    
    
</body>

</html>