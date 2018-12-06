$(window).on("load", function() {
	$("#searchForm").submit(function(e){
		let currentAction = $(this).attr("action");
		let searchVal = $(this).find("#searchInput").val();
		currentAction += searchVal;
		$(this).attr("action", currentAction);
	});
});
