"use strict"

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
    if ('geolocation' in navigator) {
        const options = { enableHighAccuracy: true, timeout: 30000, maximumage: 0 };
        navigator.geolocation.getCurrentPosition(get_location, localization_failed, options)
    }
}