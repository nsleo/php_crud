// function clearFields() {
//   // document.getElementById('nome').value = ""
//     // document.getElementById("telefone").value = ""
//     // document.getElementById("email").value = ""
//     // document.getElementById("cpf").value = ""

//     var campos = {
//       name: document.getElementById("nome"),
//       phone: document.getElementById("telefone"),
//       email: document.getElementById("email"),
//       cpf: document.getElementById("cpf")
//     }
//     for (const field in campos) {
//       campos[field].value = ""
//     }
// }






// BLOQUEAR BOTAO DE SUBMIT SE HOUVER CAMPOS EM BRANCO E BOTAO DE LIMPAR (USELESS)

var campos = {
  name: document.getElementById("nome"),
  phone: document.getElementById("telefone"),
  email: document.getElementById("email"),
  cpf: document.getElementById("cpf")
  }

var botaoSalvar = document.getElementById("save")

function clearFields() {
document.getElementById('nome').value = ""
document.getElementById("telefone").value = ""
document.getElementById("email").value = ""
document.getElementById("cpf").value = ""

for (const field in campos) {
  campos[field].value = ""
  }
}



function checkFields() {
  // checar numero de digitos cpf e se houver letras
  // console.log("teste")
  var cpf = document.getElementById("cpf")
  if (cpf.value.length < 11) {
      console.log("cpf menor que 11")
  } else if (cpf.value.length > 11) {
      cpf.value = cpf.value.substring(0, 11)
  }
  
  // ^^^^^

  if (document.getElementById("nome").value.length > 0 &&
      document.getElementById("telefone").value.length > 0 &&
      document.getElementById("email").value.length > 0 &&
      document.getElementById("cpf").value.length > 0) {
      console.log("campo preenchido")
      document.getElementById("save").disabled = false
     } else {
      console.log("campo em branco")
      document.getElementById("save").disabled = true
      document.getElementById("save").setAttribute
     }
  // if (campos.name.value.length === "") {
  //     console.log("campo em branco")
  // }
  // for (const field in campos) {
  //     if(campos[field].value == "") {
  //         return true
  //         console.log("campo em branco")
  //     } else {
  //     return false
  //     }
  // }
}


// function blockSave() {
//     var botaoSalvar = document.getElementById("save")

//     // botaoSalvar.disabled = false

//     if (name.value === "" || phone.value === "" || email.value === "" || cpf.value === "") {
//         botaoSalvar.disabled = false
//     } else {
//         botaoSalvar.disabled = false
//     }

//     botaoSalvar.disabled = false
// }