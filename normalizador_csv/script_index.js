// Nota adicional: Futuramente, com tempo, adicionar um loop for para cada arquivo uplodado, isso vai fazer resetar a cada arquivo e dai a pessoa não precisa resetar a página
const upload = document.querySelector(".espaco");
const imagem = upload.querySelector(".imagem");
const input_arquivo = document.querySelector("#input_arquivo");
const arquivo_importado1 = document.querySelector("#arquivo_importado1");
const inputinvisivel = document.querySelector("#arquivo");

function abrirseletor() {
    input_arquivo.click();
}

function extrairArquivo(event) {
    return event.dataTransfer
        ? event.dataTransfer.files[0]
        : event.target.files[0];
}

function processarArquivo(file) {
    if (!file.name.endsWith(".csv")) {
        alert("Coloque apenas arquivos csv, por favor");
        return null;
    } else {
        arquivo_importado1.textContent = `${file.name}`;
    }
    if (file.size >= 104857600) {
        alert("Arquivo é muito grande!");
        console.clear();
        return null;
    } else {
        console.log("Arquivo aceito!");
    }
    console.log(file);
    console.log("Você fez upload do arquivo:", file.name);
    let envelope_para_php = new FormData();
    envelope_para_php.append("arquivo", file);
    fetch("./php/normalizador.php", {
        method: "POST",
        body: envelope_para_php,
    })
        .then((response) => response.text())
}

function handleDrop(event) {
    processarArquivo(extrairArquivo(event));
}

function handleInput(event) {
    processarArquivo(extrairArquivo(event));
}

function aoarrastarsobre(event) {
    event.preventDefault();
    console.log("O arquivo está pairando sobre a div");
}

upload.addEventListener("dragover", (event) => {
    event.preventDefault();
    imagem.classList.add("dragging");
});

upload.addEventListener("dragleave", () => {
    imagem.classList.remove("dragging");
});

upload.addEventListener("drop", (event) => {
    event.preventDefault();
    imagem.classList.remove("dragging");
});

upload.addEventListener("click", abrirseletor);
input_arquivo.addEventListener("change", handleInput);
upload.addEventListener("dragover", aoarrastarsobre);
upload.addEventListener("drop", handleDrop);
