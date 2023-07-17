import axios from 'axios';

let addressList = document.getElementById('address-list');
const input = document.getElementById('address');

input.addEventListener("keyup", function () {
    let userInput = document.getElementById('address').value;
    if (userInput.trim().length < 3) {
        return;
    }
    input.addEventListener("input", function () {
        if (input.value === '') {
            addressList.innerHTML = '';
        }
    });
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
    console.log(response.data.results);
    const results = response.data.results;
    addressList.innerHTML = '';
    for (let i = 0; i < results.length; i++) {
        const resultList = results[i].address.freeformAddress;
        const address = document.createElement('li');
        address.innerHTML = resultList;
        address.classList.add('list-group-item');
        address.classList.add('list-group-item-action');
        address.style = 'cursor: pointer';
        address.addEventListener('click', function () {
            input.value = resultList;
            addressList.innerHTML = '';
        });
        addressList.appendChild(address);
    }
}