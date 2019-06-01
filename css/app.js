window.onload = function(){
	let writers = document.querySelectorAll(".table_writer");
	writers.forEach((writer)=>{
		if(writer.innerHTML == "관리자"){
			writer.style.color = "#cc3311";
			writer.style.fontWeight = "bolder";
		}
	});
}

function log(c){
	console.log(c);
}
