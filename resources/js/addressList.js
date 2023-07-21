import axios from 'axios';

let addressList = document.getElementById('address-list');
const input = document.getElementById('address');

input.addEventListener("keyup", function () {
    let userInput = document.getElementById('address').value;
    if (userInput.trim().length < 3) {
        return;
    }
    // Rimuovi l'evento 'input' per evitare duplicazioni
    input.removeEventListener("input", clearAddressList);

    const apiUrl = 'https://api.tomtom.com/search/2/geocode/';
    delete axios.defaults.headers.common['X-Requested-With'];
    axios.get(apiUrl + userInput + '.json', {
        params: {
            key: 'asb5Pwh7kCfYH2ak33Rwa7ebLVG3P4GF',
            typeahead: true,
            countrySet: 'IT'
        }
    }).then(handleResponse).catch(function (error) {
        console.log(error);
    });
});

function handleResponse(response) {
    const results = response.data.results;
    const addresses = results.map(result => result.address.freeformAddress);

    // Aggiorna la lista degli indirizzi suggeriti nel div con id "address-list"
    const addressList = document.getElementById('address-list');
    addressList.innerHTML = '';

    addresses.forEach(address => {
        const addressElement = document.createElement('li');
        addressElement.textContent = address;

        // Aggiungi gli attributi e le classi agli elementi "li"
        addressElement.classList.add('list-group-item');
        addressElement.classList.add('list-group-item-action');
        addressElement.style.cursor = 'pointer';

        // Aggiungi un evento di click a ciascun elemento "li"
        addressElement.addEventListener('click', function () {
            input.value = address;
            addressList.classList.add('d-none'); // Nascondi la lista degli indirizzi suggeriti dopo la selezione
        });

        addressList.appendChild(addressElement);
    });

    console.log(addresses);
}

function clearAddressList() {
    addressList.innerHTML = '';
}



