<?php
    include_once "../../config/protecao-sessao.php";
    include_once "../../config/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/favicon.png" type="image/x-icon">
    <title>Fazer pedido - Verde Agro Negócio</title>
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

    <div class="container">
        <h4 class="pt-4">Faça seu pedido</h4>
        <h6 class="pb-3">Escolha um dos nossos fertilizantes</h6>
    </div>
    <div class="container row mx-auto g-1" style="padding-bottom: 500px;">
   <?php

   if(!isset($_GET['busca'])){
    $sql = "SELECT * FROM produto;";
$buscaProdutos = mysqli_query($conn, $sql);


if($buscaProdutos == false){
    echo "Erro ao realizar a busca de produtos no banco de dados. Tente novamente mais tarde.";
} else if (mysqli_num_rows($buscaProdutos)==0){
    ?> <h5> <?php echo "Sem produtos cadastrados no banco de dados";?></h5><?php
} else {
    $contador=0;
    while($produtos = mysqli_fetch_array($buscaProdutos)){
        $contador++;
    
        ?>
        <div class="col-4 col-md-3 col-xxl-2">

        
            <div class="card text-center">
       
                    <img src = "../../assets/img/produtos/<?php echo $produtos["img"];?>" width="150px" class="pt-3 mx-auto"/>
                  
   
                <div class="card-body">
                    <p class="card-text">
                        <?php echo $produtos["nome"]?> - <?php echo $produtos["descricao"] ?>
                    </p>
                    <p class="card-text">
                        R$ <?php echo number_format($produtos["preco"],2,",",".");?>
                    </p>
                    
                    <div class="input-group justify-content-center">
                        <select class="text-center rounded-start-3" name="qtd_produto" id="qtd<?php echo $contador?>">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                        <button onclick="addCarrinho<?php echo $contador;?>(<?php echo $produtos['id_produto']?>)" class="btn btn-success rounded-end-3" name="bt_comprar"><i class="bi bi-cart-fill fs-6" style="margin-right:7px;"></i>Comprar</button>
                
                    </div>
                </div>
            </div>
        </div>
      
       


        <script type="text/javascript">
        function addCarrinho<?php echo $contador;?>(n){
            var qtdProduto = document.getElementById("qtd<?php echo $contador;?>").value;
            $.post("../../config/addCarrinho.php", {id_produto:n, nome_produto:'<?php echo $produtos["nome"]; ?>', desc_produto: '<?php echo $produtos["descricao"]; ?>', qtd_produto:qtdProduto, preco:<?php echo $produtos["preco"]; ?>});
            alert("Produto adicionado/atualizado no carrinho");
            }
        </script>

        <?php
    }
}
   } else{

    $pesquisa = $_GET['busca'];

    $sqlPesquisa = "SELECT p.id_produto, p.nome, p.preco, p.descricao, p.img FROM produto p WHERE p.nome LIKE '%$pesquisa%' OR p.descricao LIKE '%$pesquisa%';";
    $resultadoBusca = mysqli_query($conn, $sqlPesquisa);

    if($resultadoBusca == false){
        ?>
            <script>
                alert("Erro de conexão com o banco de dados. Tente novamente mais tarde.");
            </script>
        <?php
        exit();   
    } else {
        if(mysqli_num_rows($resultadoBusca) == 0){
           echo "<h5>Produto não encontrado. Clique <a href='fazer-pedido.php'>aqui</a> para ver todos os produtos.</h5>" ;
        }else{
            $contador2=0;
            while($encontrados = mysqli_fetch_array($resultadoBusca)){
                $contador2++;
            ?>
             <div class="col-4 col-md-3 col-xxl-2">

        
            <div class="card text-center">

                <img src = "../../assets/img/produtos/<?php echo $encontrados["img"];?>" width="150px" class="pt-3 mx-auto"/>
      

                    <div class="card-body">
                        <p class="card-text">
                            <?php echo $encontrados["nome"]?> - <?php echo $encontrados["descricao"] ?>
                        </p>
                        <p class="card-text">
                            R$ <?php echo number_format($encontrados["preco"],2,",",".");?>
                        </p>
                        
                        <div class="input-group justify-content-center">
                            <select class="text-center rounded-start-3" name="qtd_produto" id="qtd<?php echo $contador2?>">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                            <button onclick="addCarrinho<?php echo $contador2;?>(<?php echo $encontrados['id_produto']?>)" class="btn btn-success rounded-end-3" name="bt_comprar"><i class="bi bi-cart-fill fs-6" style="margin-right:7px;"></i>Comprar</button>
                    
                        </div>
                    </div>
            </div>
            </div>
            




<script type="text/javascript">
function addCarrinho<?php echo $contador2;?>(n){
var qtdProduto = document.getElementById("qtd<?php echo $contador2;?>").value;
$.post("../../config/addCarrinho.php", {id_produto:n, nome_produto:'<?php echo $encontrados["nome"]; ?>', desc_produto: '<?php echo $encontrados["descricao"]; ?>', qtd_produto:qtdProduto, preco:<?php echo $encontrados["preco"]; ?>});
alert("Produto adicionado/atualizado no carrinho");
}
</script>



            <?php

            }
       

    }

        ?>


<?php
   }
}
?>
</div>
    <footer>
            <?php
                include "footer.php";
            ?>
    </footer>
    <script type="text/javascript" src="../../assets/js/bootstrap.bundle.min.js"></script>
    
    
</body>

</html>