function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return null;
}

function createModal() {
    let modal = document.createElement('div')
    modal.className = 'cookie-modal'
    modal.innerHTML = `
        <div class="icon">
            <i class="fa fa-cookie-bite"></i>
        </div>
        <div class="text">
            <h3>Ei camarada, usamos cookies</h3>
        <p>Os cookies são usados para oferecer conteúdo mais apropriado para você.</p> 
        </div>
        <div class="actions">
            <button class="btn primary outlined" onclick="acceptCookies('true')">Ok</button>
            <button class="btn secondary outlined" onclick="acceptCookies('false')">Rejeitar</button>
        </div>`
    document.body.prepend(modal)
}

function destroyCookieModal(){
    document.querySelector('.cookie-modal').remove();
}

function acceptCookies(value){
    days = 28
    setCookie('osAllowCookies', value, days);
    value == true
        ? setCookie('osContent', JSON.stringify(getPostInfo()), 15 )
        : ''
    destroyCookieModal();
}


/*==================================================

        THE COOKIE LOOP

==================================================*/

if (getCookie('osAllowCookies') === null) {
    createModal()
} else if (getCookie('osAllowCookies') === "true") {
    
} else {
    console.log('Cookies não são permitidos')
}
