function openPix() {
    
    document.getElementById('form_pix').scrollIntoView();
}

function copyPix() {
    var copyText = document.getElementById("pixNumber");
    var textArea = document.createElement("textarea");
    textArea.value = copyText.textContent;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
    document.getElementById('btn_copy').style.backgroundColor = "#090";
    document.getElementById('btn_copy').innerHTML = '<i class="material-icons">check_circle</i> Copiado!';
    setTimeout(function () {
        document.getElementById('btn_copy').style.backgroundColor = "#c00";
        document.getElementById('btn_copy').innerHTML = '<i class="material-icons">content_copy</i> COPIAR';
    }, 2500);
}

function validateCPF(cpf) {
    var cpfRegex = /^(?:(\d{3}).(\d{3}).(\d{3})-(\d{2}))$/;
    if (!cpfRegex.test(cpf)) {
        return false;
    }

    var numeros = cpf.match(/\d/g).map(Number);
    var soma = numeros.reduce((acc, cur, idx) => {
        if (idx < 9) {
            return acc + cur * (10 - idx);
        }
        return acc;
    }, 0);

    var resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) {
        resto = 0;
    }

    if (resto !== numeros[9]) {
        return false;
    }

    soma = numeros.reduce((acc, cur, idx) => {
        if (idx < 10) {
            return acc + cur * (11 - idx);
        }
        return acc;
    }, 0);

    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) {
        resto = 0;
    }

    if (resto !== numeros[10]) {
        return false;
    }

    return true;
}

/*==============================

    MASKS

==============================*/

form = document.getElementById('form_data')

/**
 * 
 * CPF
 * 
 */
form.fcpf.addEventListener('input', () => {
    v = form.fcpf.value.replace(/\D/g, "")
    if (v.length <= 3) {
        fv = v
    }
    if (v.length > 3 && v.length <= 6) {
        fv = v.slice(0, 3) + '.' + v.slice(3)
    }
    if (v.length > 6 && v.length <= 9) {
        fv = v.slice(0, 3) + '.' + v.slice(3, 6) + '.' + v.slice(6)
    }
    if (v.length > 9) {
        fv = v.slice(0, 3) + '.' + v.slice(3, 6) + '.' + v.slice(6, 9) + '-' + v.slice(9, 11)
    }
    form.fcpf.value = fv
})

/**
 * 
 * Phone
 * 
 */
form.fphone.addEventListener('input', () => {
    v = form.fphone.value.replace(/\D/g, "")
    if (v.length <= 2) {
        fv = v
    }
    if (v.length > 2 && v.length <= 6) {
        fv = '(' + v.slice(0, 2) + ') ' + v.slice(2)
    }
    if (v.length > 6 && v.length <= 10) {
        fv = '(' + v.slice(0, 2) + ') ' + v.slice(2, 6) + '-' + v.slice(6)
    }
    if (v.length > 10) {
        fv = '(' + v.slice(0, 2) + ') ' + v.slice(2, 3) + '.' + v.slice(3, 7) + '-' + v.slice(7, 11)
    }
    form.fphone.value = fv

})

/**
 * 
 * Value
 * 
 */
form.fvalue.addEventListener('input', () => {

    v = form.fvalue.value.replace(/\R\$|(\,00)|(\,0)|\D/g, '')
    v = v.replace(/^0+/, '')
    if (v == '') { v = 0 }
    v = parseInt(v).toLocaleString('pt-BR')
    fv = 'R$' + v + ',00';
    form.fvalue.value = fv
    form.fvalue.selectionStart = (fv.length - 3)
    form.fvalue.selectionEnd = (fv.length - 3)
    /*
    if(v.includes('R')){
        v = v.match(/(?<=R\$)(.*)(?=\,00)/)[0]
    }
    form.fvalue.value = 'R$'+v+',00'
    */
})

document.querySelectorAll('.pill-container input').forEach(input => {
    input.addEventListener('click', () => {
        nv = event.target.value
        form.fvalue.value = 'R$' + nv + ',00'

        if (nv == 0) {
            document.querySelector('.custom-value').style.display = 'block';
        } else {
            document.querySelector('.custom-value').style.display = 'none';
        }
    })
})


/*==============================

    FORM SUBMIT

==============================*/

function validatePixForm() {
    event.preventDefault()
    form = document.getElementById('form_data')
    isValidate = true

    name = form.fname.value
    cpf = form.fcpf.value
    phone = form.fphone.value.replace(/\D/g, '')
    address = form.faddress.value
    value = form.fvalue.value.replace(/\R\$|(\,00)|(\,0)|\D/g, '')

    if (name.length < 3) {
        defineFormError(form.fname, 'É prpeciso inserir um nome válido')
        isValidate = false
    }
    if (!validateCPF(cpf)) {
        defineFormError(form.fcpf, 'É prpeciso inserir um documento válido')
        isValidate = false
    }
    if (phone.length < 10 || phone.length > 11) {
        defineFormError(form.fphone, 'É prpeciso inserir um telefone válido')
        isValidate = false
    }
    if (address.length < 6) {
        defineFormError(form.faddress, 'É prpeciso inserir um endereço válido')
        isValidate = false
    }
    if (value == '0') {
        defineFormError(form.fvalue, 'É prpeciso inserir um valor válido')
        isValidate = false
    }

    if (isValidate == true) {
        fdata = new FormData
        fdata.append('name', name)
        fdata.append('cpf', cpf.replace(/\D/g, ""))
        fdata.append('phone', phone)
        fdata.append('address', address)
        fdata.append('amount', value)
        fdata.append('local', 'OS')

        try {
            submitPixCad(fdata)

        } catch (e) {
            window.alert('Ops! Houve um erro. Tente novamente')
        }

    }
}

function submitPixCad(data) {
    button = document.querySelector('#form_data input[type=submit]')
    button.disabled = true 
    button.value = 'Carregando...'
    button.style.backgroundColor = "#ccc";
    button.style.color = "#000"
    url = 'https://doe.pstu.org.br/src/Controller/Register.php'
    fetch(url, {
        method: "POST",
        body: fdata,
    }).then(resp => {
        if (resp.ok) {
            fetchQrCode(name, value)
        }
    })
}
function defineFormError(input, message) {
    icon = '<i class="fa fa-exclamation-triangle"></i>'
    input.className = 'error'
    input.nextElementSibling.style.display = "block"
    input.nextElementSibling.innerHTML = icon + ' ' + message
    input.addEventListener('change', () => {
        event.target.classList.remove('error')
        event.target.nextElementSibling.style.display = 'none'
        adjustHeight('etapa1')
    })
}

async function fetchQrCode(name, value) {
    fdata = new FormData
    fdata.append('name', name)
    fdata.append('amount', value)
    fdata.append('local', 'OS')

    await fetch("https://doe.pstu.org.br/src/Utils/QRCode.php", {
        method: "POST",
        body: fdata,
    })
        .then(response => response.json())
        .then((data) => {
            modal = document.querySelector('.pix-modal')
            document.querySelector('#backdrop').style.display = "block"
            modal.style.display = "block"
            qr = document.createElement('img')
            qr.src = 'data:image/png;base64, ' + data['image'];
            modal.querySelector('.image').append(qr)
            modal.querySelector('input').value = data['code'];
        })
}

function copyQRCode(){
    navigator.clipboard.writeText(document.getElementById('qrcode-number').value)
    button = event.target
    button.innerText = 'Copiado!'
    button.classList.add('active')
    setTimeout(()=>{
        button = document.querySelector('.pix-modal .btn')
        button.innerText = 'Copiar'
        button.classList.remove('active')
    },2000)
}

function closeModal(){
    document.querySelector('#backdrop').style.display = "none"
    location.reload()
}