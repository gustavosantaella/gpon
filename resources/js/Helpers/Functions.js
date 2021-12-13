const access = (url, storage = false) => {


     let storageFolder = storage ? 'storage/' : '';
    return `${window.location.origin}/${storageFolder}${url}`
}


export  {
    access
}
