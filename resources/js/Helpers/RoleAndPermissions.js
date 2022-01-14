 function hasRolesOrPermissions(role, key, search){


		if(window.Laravel.roleAndPermissions[key] == 0 ){
    		return false;
    	}

		let ObjectRoles = window.Laravel.roleAndPermissions[key]
		let data = JSON.parse(ObjectRoles)
		let roles = data[search]
		let _return = false
		if(!Array.isArray(roles)){
			return false
		}
		if(role.includes('|')){
			role.split('|').forEach(function (item) {
				if(roles.includes(item.trim())){
					_return = true
				}
			})
		}else if(role.includes('&')){
			_return = true
			role.split('&').forEach(function (item) {
				if(!roles.includes(item.trim())){
					_return = false
				}
			})
		}else{
			_return = roles.includes(role.trim())
		}
		return _return
}


export {
	hasRolesOrPermissions,

}
