function clickDelButton(e, formid) {
	if(confirm('Удалить запись?')){
		e.preventDefault();
		document.getElementById(formid).submit();
	}
}

