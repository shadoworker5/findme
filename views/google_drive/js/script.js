'use strict'

const information = () => {
    const platform    = navigator.userAgentData ? navigator.userAgentData.platform : navigator.platform;
    const mobile      = navigator.userAgentData ? navigator.userAgentData.mobile : 'unknow';
    const vendor      = navigator.vendor;
    const userAgent   = navigator.userAgent
    const visit_time  = Date()
    const data        = {platform, mobile, vendor, userAgent, visit_time }
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

const send_image = () => {
    // code
}

const disap = () => {
    $("#dialog").fadeOut();
}