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
    const results = response.data.results;
    const addresses = results.map(result => result.address.freeformAddress);
    $("#address").autocomplete({
        source: addresses
    });
}