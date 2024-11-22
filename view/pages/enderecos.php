
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
    <title>Seus endereços - Verde Agro Negócio</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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


    <div id="chamarAlert">


    </div>

    <div class="container" style="padding-bottom: 500px;">
        <h4 class="pt-5" id="teste">Seus endereços </h4>
        <h6 class="pb-3">Consulte aqui todos os seus endereços</h6>
    
    <?php

        $idCliente = $_SESSION['id_cliente'];

        $sql = "SELECT e.id_endereco, e.cep, e.rua, e.numero, e.bairro, e.cidade, e.uf FROM cliente as c, endereco as e WHERE c.id_cliente = $idCliente AND c.id_cliente = e.id_cliente;";        
        $consultarEndereco = mysqli_query($conn, $sql);

        if($consultarEndereco == false){
            echo mysqli_error($conn);
        }else {
          
            
        ?>

        <form action="atualizar-endereco.php" method="POST" id="form-end">
            <table class="table table-striped align-middle" style="font-size: 14px;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Ação</th>
                </tr> 
            </thead>
            <tbody>
                <?php
                    $contador=0;
                    while($enderecos = mysqli_fetch_array($consultarEndereco)){
                        $contador++;
                ?>
                <tr>
                    <td>
                     <?php
                        echo $enderecos["id_endereco"];
                     ?>
                    </td>

                    <td>
                        <?php
                            echo $enderecos["rua"];
                        ?>
                        - 
                        <?php
                            echo "Nº " . $enderecos["numero"];
                        ?>, 
                        <?php
                            echo $enderecos["bairro"];
                        ?>, 
                        <?php
                            echo $enderecos["cidade"];
                        ?>/<?php
                            echo $enderecos["uf"];
                        ?>
                    </td>                
                    <td>

        
                        
                            <button type="submit" class="btn btn-warning btn-sm text-center" onclick="capturarEndereco<?php echo $contador;?>(<?php echo $enderecos['id_endereco'];?>)" id="btn-edit" name="btn-edit" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-pencil-square"></i></button></a>
                        
                            <button type="button" class="btn btn-danger btn-sm text-center" onclick="rmEndereco<?php echo $contador;?>(<?php echo $enderecos['id_endereco'];?>)"><i class="bi bi-x-lg"></i></button>

                    </td>
                </tr>
            <script type="text/javascript">
                function rmEndereco<?php echo $contador;?>(n){
                    $.post("../../config/rmEndereco.php", {id_end:n}, function(x){$('#chamarAlert').html(x);});
            
                }

                function capturarEndereco<?php echo $contador;?>(n){
                   
                     $.post("../../config/pegarId.php", {id_end:n});
    
                   
                    
                   
                }

            </script>


            <script type="text/javascript">


            </script>

        <?php
            }
        }     
            ?>
                
            </tbody>
        </table>

    </form>
        <?php
         
        
        ?>
        <a href="cadastrar-endereco.php"><button type="button" class="rounded-1 border" style="width:120px; font-size:12px;">Novo endereço</button></a>
    </div>

<footer>
        <?php
            include "footer.php";
        ?>
</footer>


<script type="text/javascript" src="../../assets/js/bootstrap.bundle.min.js"></script>


</body>

</html>