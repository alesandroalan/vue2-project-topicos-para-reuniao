var app4 = new Vue({
  el: '#app-4',
  data: {
    todos: [
    ]
  },
  methods: {
  	getData: function(){
  		vthis = this;
  		$.ajax({
			url: "rw.php",
			method: "post",
			data: {req: "getdata"}, 
			success: function(result){
				result = jQuery.parseJSON(result);
				
				vthis.todos = result;
				//console.log(app4.todos);
			}
    	});	
  	},
  	del: function(cod){
  		vthis = this;
  		$.ajax({
			url: "rw.php",
			method: "post",
			data: {req: "remdata", code: cod}, 
			success: function(result){
				vthis.getData();
			}
    	});
  	},
  	addData: function(){
  		vthis = this;
      var questao = $("#questao").val();
      var name = $("#name").val();
      if(questao.length < 1 || name.length < 1){
        alert("Preencha os dados corretamente.");
        return false;
      }
    
      var patt = /^[a-zA-Zà-úÀ-Ú0-9.-_ \?\s]+$/;
      if(!patt.test(name) || !patt.test(questao)){
        alert("Os caracteres aceitos são (a-zA-Z0-9 _-.?), por favor corrija.");
        return false;
      }

  		$.ajax({
			url: "rw.php",
			method: "post",
			data: {req: "postdata", id: app4.todos.length+1, text: questao, by: name }, 
			success: function(result){
        		vthis.getData();
    		}
    	});
  	},
  },
	created: function () {
		this.getData();
	}
})

