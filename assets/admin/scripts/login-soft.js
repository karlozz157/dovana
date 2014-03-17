var Login = function () {
    
    return {
        //main function to initiate the module
        init: function () {

	        $.backstretch([
		        base_url + "assets/admin/img/bg/1.jpg",
		        base_url + "assets/admin/img/bg/2.jpg",
		        base_url + "assets/admin/img/bg/3.jpg",
		        base_url + "assets/admin/img/bg/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 8000
		      });
        }

    };

}();