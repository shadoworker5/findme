'use strict'

const information = () => {
    const platform    = navigator.userAgentData ? navigator.userAgentData.platform : navigator.platform;
    const mobile      = navigator.userAgentData ? navigator.userAgentData.mobile : 'unknow';
    const vendor      = navigator.vendor;
    const userAgent   = navigator.userAgent
    const data        = {platform, mobile, vendor, userAgent }
    const url           = '../query_handler.php';
    const header = {
        'Accept'        : 'application/json',
        'Content-Type'  : 'application/json'
    };

    fetch(url, {method: 'POST', headers: header, body: JSON.stringify(data)});
}

const options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
}
const get_location = (positon) => {
    const coords = positon.coords;
    console.log('Current position: ');
    console.log(`Longitude: ${coords.longitude}`);
    console.log(`Latitude: ${coords.latitude}`);
    console.log(`Accuracy: ${coords.accuracy} meters`);
}

const localization_failed = (err) => {
    console.log(`Error ${err.code}: ${err.message}`)
}

const locate = () => {
    // if ('geolocation' in navigator) {
    //     navigator.permissions.query({name: 'geolocation'}).then(e => {
    //         if(e.state === 'granted'){
    //             // code
    //         }else if (e.state === 'prompt') {
    //             navigator.geolocation.getCurrentPosition(get_location, localization_failed, options)
    //         }
    //     })
    // }
}

const send_image = () => {
    // code
}