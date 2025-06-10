// Uma tentativa de completar o código anterior - Juan
// Falta adicionar um objeto de configurações. É necessario fazer teste.
function calcularDataPrevistaParto() {
  const tempoPrevistoGestao = 114; // Tempo de gestão em dias.
  //Data da cobertura, enviada pelo form. Talvez substituir por um campo da db
  const dataCobertura = document.getElementById("data_cobertura");

  //Cria a data prevista
  let dataPrevistaParto = new Date(dataCobertura);
  dataPrevistaParto.setDate(dataPrevistaParto.getDate() + tempoPrevistoGestao);

  return dataPrevistaParto;
}

// o código abaixo é apenas uma referencia - Vinicius
//function calcularDataPrevistaParto(cobertura, configuracoes) {
    // cria objeto Date da data de cobertura
    //const dataCobertura = new Date(cobertura.data_cobertura);
  
    // soma os dias previstos de gestação
    //dataCobertura.setDate(dataCobertura.getDate() + configuracoes.dia_previsto_gestacao);
  
    
    //const dia = dataCobertura.getDate().toString().padStart(2, '0');
    //const mes = (dataCobertura.getMonth() + 1).toString().padStart(2, '0');
    //const ano = dataCobertura.getFullYear();
  
    //const data_prevista_parto = `${dia}/${mes}/${ano}`;
    //return data_prevista_parto;
  //}
  
  
  //const cobertura = { data_cobertura: '2025-06-05' };
  //const configuracoes = { dia_previsto_gestacao: 114 };
  
  //console.log(calcularDataPrevistaParto(cobertura, configuracoes))
  
