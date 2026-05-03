function sanitize(str){
    const map ={'&': '&amp;','<': '&lt;','>': '&gt;', '"': '&quot;',
        "'": '&#x27;',
        "/": '&#x2F',
    };

    const reg = /[&<>"'/]/ig;
    return str.replace(reg, (el) => map[el]);
}

async function handleInput() {
    const inputElement = document.getElementById("userInput");
    const rawData = inputElement.value;
    const cleanData = sanitize(rawData);
}