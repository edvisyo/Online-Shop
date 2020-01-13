//Logout button show
$("#user_menu").click(function() {
    $("#hidden_logout_btn").show();
});

$("#login_btn").click(function() {
    $("#loginForm").show();
});

$("#close_login_form").click(function (){
    $("#loginForm").hide();
});

// $("#loginBtn").click(function() {
//     $("#btns").addClass("hide_login_register_btns");
// });

$("#register_btn").click(function() {
    $("#registerForm").show();
});

$("#close_register_form").click(function (){
    $("#registerForm").hide();
});

$("#register_btn").click(function() {
    $("#loginForm").hide();
});

//New admin regist form show
// $("#new_admin").click(function() {
//     $("#new_admin_regist").show();
// });

