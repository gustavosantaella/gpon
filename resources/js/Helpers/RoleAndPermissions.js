 function role(role, key){
 	
 	
		if(window.Laravel.roleAndPermissions[key] == 0 ){
    		return false
    	}

		let permissions = window.Laravel.roleAndPermissions[key]
		let data = JSON.parse(permissions)
		ss = data.permissions
		alert(typeof permissions)
		let _return = false
		if(!Array.isArray(permissions)){
			return false
		}
		if(role.includes('|')){
			role.split('|').forEach(function (item) {
				if(permissions.includes(item.trim())){
					_return = true
				}
			})
		}else if(role.includes('&')){
			_return = true
			role.split('&').forEach(function (item) {
				if(!permissions.includes(item.trim())){
					_return = false
				}
			})
		}else{
			_return = permissions.includes(role.trim())
		}
		return _return
}

function permission(permission, key){
	if(window.Laravel.roleAndPermissions[key] == 0){
    		return false
    	}
		let roles = window.Laravel.roleAndPermissions[key].roles
		let _return = false
		if(!Array.isArray(roles)){
			return false
		}
		if(permission.includes('|')){
			permission.split('|').forEach(function (item) {
				if(roles.includes(item.trim())){
					_return = true
				}
			})
		}else if(permission.includes('&')){
			_return = true
			permission.split('&').forEach(function (item) {
				if(!roles.includes(item.trim())){
					_return = false
				}
			})
		}else{
			_return = roles.includes(permission.trim())
		}
		return _return
}

export {
	role,
	permission
}