window.addEventListener("message", receiveMessage, false); 
function receiveMessage(event){ 
    if(event.data.substring(0,12) == 'iframe_click'){ 
        jQuery('.iframe-wrapper').height(50 + (1* event.data.substring(13))); 
    }
}