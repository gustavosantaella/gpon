/**
 *
 * @param {string} url
 * @param {bool} storage
 * @param {bool} fullPath
 * @returns
 */
const access = (url, storage = false, fullPath = false) => {

     let urlPath = '';
     if(fullPath)
     {
       urlPath += `${window.location.origin}`
     }

     if(storage)
     {
        urlPath += '/storage'
     }

    return `${urlPath}/${url}`
}


export  {
    access
}
