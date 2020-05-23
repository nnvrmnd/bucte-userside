const keyData = "Chromatica";

const cipher = (text) =>{
    //let textM = new Buffer(text, 'base64').toString()
    let encryptMsg = CryptoJS.AES.encrypt(text , keyData)
    return encryptMsg.toString()
}

const decipher = (text) =>{
    decrypted = CryptoJS.AES.decrypt(text, "Chromatica");
    return decrypted = decrypted.toString(CryptoJS.enc.Utf8) 
}

//var plaintext = bytes.toString(CryptoJS.enc.Utf8);

const getDateFormat = (date_data) =>{
    const months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
    date = date_data.split(' ')[0].split('/');
    newDate = new Date(`${date[0]}-${date[1]}-${date[2]}`),
    formatted_date =  `${months[newDate.getMonth()]} ${newDate.getDate()},${newDate.getFullYear()}`;
    return formatted_date;
}   
