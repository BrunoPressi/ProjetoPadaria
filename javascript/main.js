function pesquisar() {
    const input = document.getElementById("barra_Pesquisa").value.toLowerCase();
    const tabela = document.getElementById("tabela_Clientes");
    const linhas = tabela.getElementsByTagName("tr");

    for (let i = 1; i < linhas.length; i++) {
        const conteudoNome = linhas[i].getElementsByTagName("td");
        const conteudoID = linhas[i].getElementsByTagName("th");

        //const id = conteudo[0].innerText.toLowerCase();
        const nome = conteudoNome[0].innerText.toLowerCase();
        const id = conteudoID[0].innerText.toLowerCase();

        if (nome.includes(input) || id.includes(input)) {
            linhas[i].style.display = "";
        } else {
            linhas[i].style.display = "none";
        }
    }
}
