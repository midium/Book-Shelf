function show_view(view_name) {
	 var p = {};
	 p[view] = view_name;
	 $('#content').load('/main/showView',p,function(str){

	 });
}