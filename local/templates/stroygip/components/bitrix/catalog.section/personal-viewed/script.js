function catalogSort() {
    var sort = document.getElementById("catalog-sort-select").value;
	
	const url = new URL(document.location.href);
	var current_url = url.href;
	
	if( current_url.indexOf("sort=") !== -1 ){
		var new_url = current_url.replace(/(sort=).*?(&|$)/,'$1' + sort + '$2');

		document.location.href = new_url;
	}else{
		url.searchParams.append('sort', sort);
		document.location.href = url.toString();
	}
}

function catalogPageSize() {
    var pageSize = document.getElementById("catalog-pagesize-select").value;
	
	const url = new URL(document.location.href);
	var current_url = url.href;
	
	if( current_url.indexOf("pageSize=") !== -1 ){
		var new_url = current_url.replace(/(pageSize=).*?(&|$)/,'$1' + pageSize + '$2');

		document.location.href = new_url;
	}else{
		url.searchParams.append('pageSize', pageSize);
		document.location.href = url.toString();
	}
}
