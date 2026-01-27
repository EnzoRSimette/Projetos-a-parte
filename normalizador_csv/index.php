<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" type="image/svg" href="favicon.svg">
    <title>Faça um upload</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="fundo
    bg-[url(fundo.png)]
    bg-cover bg-center bg-no-repeat min-h-screen">
        <div class="container">
            <h2>Arraste um documento aqui</h2>
            <!-- <p id="ou_clique"><i>Ou clique para abrir a janela de upload</i></p> -->
            <div class="espaco">
                <input
                    type="file"
                    id="input_arquivo"
                    style="display: none"
                    accept=".csv" />
                <img src="upload.png" class="imagem" />
                <p id="arquivo_importado1">
                    <i>O documento só é aceito em .csv</i>
                </p>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>