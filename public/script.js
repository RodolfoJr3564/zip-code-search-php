document.getElementById('cepForm').addEventListener('submit', searchCEP);

function searchCEP(event) {
    event.preventDefault();
    if (!validCep()) {
        return;
    }
    const cep = document.getElementById('cepInput').value;
    const url = `https://viacep.com.br/ws/${cep}/json/`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.erro) {
                invalidZip('CEP não encontrado.');
                return;
            }
            renderAddressContainer(data);
        })
        .catch(error => {
            invalidZip('Erro ao buscar o CEP.');
        });
}

function validCep() {
    const cep = document.getElementById('cepInput').value;
    const regex = /^\d{5}-?\d{3}$/;
    if (!regex.test(cep)) {
        alert('Por favor, digite um CEP válido.');
        return false;
    }
    return true;
}

function renderAddressContainer(data) {
    renderTemplate('address-result.html').then(() => {
        document.getElementById('cep').value = data.cep;
        document.getElementById('street').value = data.logradouro;
        document.getElementById('district').value = data.bairro;
        document.getElementById('city').value = data.localidade;
        document.getElementById('state-uf').value = data.uf;
        document.getElementById('complement').value = data.complemento ?? '';

        document.getElementById('address-result-cep').textContent = data.cep;
        document.getElementById('address-result-street').textContent = data.logradouro;
        document.getElementById('address-result-district').textContent = data.bairro;
        document.getElementById('address-result-city').textContent = data.localidade;
        document.getElementById('address-result-state-uf').textContent = data.uf;
        document.getElementById('address-result-complement').textContent = data.complemento ?? '';

        document.getElementById('save-address-form').addEventListener('submit', saveAddress);
    });
}

function invalidZip(mensagem) {
    renderTemplate('invalid_zip.html').then(() => {
        document.getElementById('error-message').textContent = mensagem;
    });
}
function serverError() {
    renderTemplate('server_erro.html').then(() => {
        document.getElementById('error-message').textContent = mensagem;
    });
}

function renderTemplate(url) {
    return fetch(url)
        .then(response => response.text())
        .then(html => {
            document.getElementById('templateContainer').innerHTML = html;
        })
        .catch(error => console.error('Erro ao carregar o template:', error));
}

function removeTemplate() {
    document.getElementById('templateContainer').innerHTML = '';
}

function saveAddress(event) {
    event.preventDefault();

    const endereco = {
        zipCode: document.getElementById('cep').value,
        street: document.getElementById('street').value,
        district: document.getElementById('district').value,
        city: document.getElementById('city').value,
        stateUF: document.getElementById('state-uf').value,
        complement: document.getElementById('complement')?.value ?? '',
    };

    fetch('/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(endereco)
    })
        .then((response) => {
            const statusRegex = /^2\d{2}$/;
            const statusCode = response.status.toString();

            if (!statusRegex.test(statusCode)) {
                throw new Error('Falha ao salvar o endereço');
            }
            window.location.href = '/';
        })
        .catch(error => {
            removeTemplate()
            serverError()
        });

}
