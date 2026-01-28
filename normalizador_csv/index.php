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
    bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center">
        <div id="espaco_maior" class="container grid justify-self-center w-150 h-75 bg-[#ececec] rounded-[10px] shadow-lg">
            <div id="Titulo_arrastar" class="container grid place-self-center size-auto translate-y-3">
                <h2 class="font-[Franklin_Gothic_Medium] text-center text-[40px]">
                    Arraste um documento aqui
                </h2>
            </div>
            <!-- <p id="ou_clique"><i>Ou clique para abrir a janela de upload</i></p> -->
            <div id="espaco" class="w-100 h-30 grid place-self-center rounded-[1vw] bg-white outline-dashed outline-gray-400 mb-2">
                <input
                    type="file"
                    id="input_arquivo"
                    style="display: none"
                    accept=".csv" />
                <img src="upload.png" id="imagem" class="w-15  grid place-self-center translate-y-2 opacity-95 animate-pulse" />
                <p id="arquivo_importado1" class="italic grid place-self-center opacity-30">
                    O documento só é aceito em .csv
                </p>
            </div>
        </div>
    </div>
    <script src="script_index.js"></script>
</body>

</html>