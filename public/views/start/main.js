$(window).on("load", function() {
	"use strict";

	//lorenzo
	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
	});

	$('.btn-file :file').on('fileselect', function(event, label) {

		var input = $(this).parents('.input-group').find(':text'),
		log = label;

		if( input.length ) {
			input.val(log);
		} else {
			if( log ) alert(log);
		}

	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img-upload').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#imgInp").change(function(){
		readURL(this);
	});

	$(".submit-post").on("click", function(){
		var content = $("#newPost-description").val();
		var imagemB64 = $("#img-upload").attr("src");

		if(typeof imagemB64 == "undefined"){
			alert("Sem imagem!");
			return;
		}

		$.post("",{
			postId : 0,
			content: content,
			image: imagemB64
		},function(data){
			console.log(data);
		});

		$(".post-popup.job_post").removeClass("active");
		$(".wrapper").removeClass("overlay");
	});

	$(".btn-comment").on("click", function(){
		if($(".comment-sec").is(":hidden")){
			$(".comment-sec").attr("hidden",false);;
		} else {
			$(".comment-sec").attr("hidden",true);;
		}
	});

	$(".submit-comment").on("click", function(){
		var network_posts_id = $(this).parent().prop('id');
		var content = $(this).parent().children('.text_comment').val();
		if(content.length == 0){
			alert("Escreva um comentario.");
		} else {
			$.post("",{
				postId: 1,
				network_posts_id: network_posts_id,
				content: content
			},function(data){
				// console.log(data);
			});
		}
		$(this).parent().children('.text_comment').val("");
	});

	$(".btn-like").on("click", function(){
		var network_posts_id = $(".submit-comment").parent().prop('id');
	console.log(network_posts_id);
		$.post("",{
			postId: 2,
			network_posts_id: network_posts_id,
		},function(data){
			console.log(data);
		});
	});

	$(".btn-logOut").on("click", function(){
		$.post("",{
			postId: -1
		},function(data){
			console.log(data);
		});
	});
	//endlorenzo

	//  ============= POST PROJECT POPUP FUNCTION =========

	// $(".post_project").on("click", function(){
	//     $(".post-popup.pst-pj").addClass("active");
	//     $(".wrapper").addClass("overlay");
	//     return false;
	// });
	// $(".post-project > a").on("click", function(){
	//     $(".post-popup.pst-pj").removeClass("active");
	//     $(".wrapper").removeClass("overlay");
	//     return false;
	// });

	//  ============= POST JOB POPUP FUNCTION =========

	$(".post-jb").on("click", function(){
		$(".post-popup.job_post").find('input:text').val('');
		$("#img-upload").removeAttr("src");
		$(".post-popup.job_post").addClass("active");
		$(".wrapper").addClass("overlay");
		return false;
	});
	$(".post-project > a").on("click", function(){
		$(".post-popup.job_post").removeClass("active");
		$(".wrapper").removeClass("overlay");
		return false;
	});

	$(".cancel-post").on("click", function(){
		$(".post-popup.job_post").removeClass("active");
		$(".wrapper").removeClass("overlay");
		return false;
	});

	//  ============= SIGNIN CONTROL FUNCTION =========

	$('.sign-control li').on("click", function(){
		var tab_id = $(this).attr('data-tab');
		$('.sign-control li').removeClass('current');
		$('.sign_in_sec').removeClass('current');
		$(this).addClass('current animated fadeIn');
		$("#"+tab_id).addClass('current animated fadeIn');
		return false;
	});

	//  ============= SIGNIN TAB FUNCTIONALITY =========

	$('.signup-tab ul li').on("click", function(){
		var tab_id = $(this).attr('data-tab');
		$('.signup-tab ul li').removeClass('current');
		$('.dff-tab').removeClass('current');
		$(this).addClass('current animated fadeIn');
		$("#"+tab_id).addClass('current animated fadeIn');
		return false;
	});

	//  ============= SIGNIN SWITCH TAB FUNCTIONALITY =========

	$('.tab-feed ul li').on("click", function(){
		var tab_id = $(this).attr('data-tab');
		$('.tab-feed ul li').removeClass('active');
		$('.product-feed-tab').removeClass('current');
		$(this).addClass('active animated fadeIn');
		$("#"+tab_id).addClass('current animated fadeIn');
		return false;
	});

	//  ============= COVER GAP FUNCTION =========

	var gap = $(".container").offset().left;
	$(".cover-sec > a, .chatbox-list").css({
		"right": gap
	});

	//  ============= OVERVIEW EDIT FUNCTION =========

	$(".overview-open").on("click", function(){
		$("#overview-box").addClass("open");
		$(".wrapper").addClass("overlay");
		return false;
	});
	$(".close-box").on("click", function(){
		$("#overview-box").removeClass("open");
		$(".wrapper").removeClass("overlay");
		return false;
	});

	//  ============= EXPERIENCE EDIT FUNCTION =========

	$(".exp-bx-open").on("click", function(){
		$("#experience-box").addClass("open");
		$(".wrapper").addClass("overlay");
		return false;
	});
	$(".close-box").on("click", function(){
		$("#experience-box").removeClass("open");
		$(".wrapper").removeClass("overlay");
		return false;
	});

	//  ============= EDUCATION EDIT FUNCTION =========

	$(".ed-box-open").on("click", function(){
		$("#education-box").addClass("open");
		$(".wrapper").addClass("overlay");
		return false;
	});
	$(".close-box").on("click", function(){
		$("#education-box").removeClass("open");
		$(".wrapper").removeClass("overlay");
		return false;
	});

	//  ============= LOCATION EDIT FUNCTION =========

	$(".lct-box-open").on("click", function(){
		$("#location-box").addClass("open");
		$(".wrapper").addClass("overlay");
		return false;
	});
	$(".close-box").on("click", function(){
		$("#location-box").removeClass("open");
		$(".wrapper").removeClass("overlay");
		return false;
	});

	//  ============= SKILLS EDIT FUNCTION =========

	$(".skills-open").on("click", function(){
		$("#skills-box").addClass("open");
		$(".wrapper").addClass("overlay");
		return false;
	});
	$(".close-box").on("click", function(){
		$("#skills-box").removeClass("open");
		$(".wrapper").removeClass("overlay");
		return false;
	});

	//  ============= ESTABLISH EDIT FUNCTION =========

	$(".esp-bx-open").on("click", function(){
		$("#establish-box").addClass("open");
		$(".wrapper").addClass("overlay");
		return false;
	});
	$(".close-box").on("click", function(){
		$("#establish-box").removeClass("open");
		$(".wrapper").removeClass("overlay");
		return false;
	});

	//  ============= CREATE PORTFOLIO FUNCTION =========

	$(".gallery_pt > a").on("click", function(){
		$("#create-portfolio").addClass("open");
		$(".wrapper").addClass("overlay");
		return false;
	});
	$(".close-box").on("click", function(){
		$("#create-portfolio").removeClass("open");
		$(".wrapper").removeClass("overlay");
		return false;
	});

	//  ============= EMPLOYEE EDIT FUNCTION =========

	$(".emp-open").on("click", function(){
		$("#total-employes").addClass("open");
		$(".wrapper").addClass("overlay");
		return false;
	});
	$(".close-box").on("click", function(){
		$("#total-employes").removeClass("open");
		$(".wrapper").removeClass("overlay");
		return false;
	});

	//  =============== Ask a Question Popup ============

	$(".ask-question").on("click", function(){
		$("#question-box").addClass("open");
		$(".wrapper").addClass("overlay");
		return false;
	});
	$(".close-box").on("click", function(){
		$("#question-box").removeClass("open");
		$(".wrapper").removeClass("overlay");
		return false;
	});


	//  ============== ChatBox ==============


	$(".chat-mg").on("click", function(){
		$(this).next(".conversation-box").toggleClass("active");
		return false;
	});
	$(".close-chat").on("click", function(){
		$(".conversation-box").removeClass("active");
		return false;
	});

	//  ================== Edit Options Function =================


	$(".ed-opts-open").on("click", function(){
		$(this).next(".ed-options").toggleClass("active");
		return false;
	});


	// ============== Menu Script =============

	$(".menu-btn > a").on("click", function(){
		$("nav").toggleClass("active");
		return false;
	});


	//  ============ Notifications Open =============

	$(".not-box-open").on("click", function(){
		$(this).next(".notification-box").toggleClass("active");
	});

	// ============= User Account Setting Open ===========

	$(".user-info").on("click", function(){
		$(this).next(".user-account-settingss").toggleClass("active");
	});

	//  ============= FORUM LINKS MOBILE MENU FUNCTION =========

	$(".forum-links-btn > a").on("click", function(){
		$(".forum-links").toggleClass("active");
		return false;
	});
	$("html").on("click", function(){
		$(".forum-links").removeClass("active");
	});
	$(".forum-links-btn > a, .forum-links").on("click", function(){
		e.stopPropagation();
	});
});
