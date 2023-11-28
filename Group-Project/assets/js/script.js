function notificationRegister(){
    document.getElementById("register-notification").style.display = "none";
    window.location.assign("register.php");
}

function notificationLogin(){
    document.getElementById("login-notification").style.display = "none";
    window.location.assign("login.php");
}

function userProfile(){
    document.getElementById("user-profile").style.display = "block";
    document.getElementById("change-password").style.display = "none";
    document.getElementById("insert-article").style.display = "none";
    document.getElementById("update-article").style.display = "none";
    document.getElementById("list-users").style.display = "none";
    document.getElementById("insert-committe").style.display = "none";
    document.getElementById("list-committes").style.display = "none";
    document.getElementById("list-program").style.display = "none";
    document.getElementById("list-division").style.display = "none";
    document.getElementById("sidebarProfile").classList.add("active");
    document.getElementById("sidebarPassword").classList.remove("active");
    document.getElementById("sidebarInsert").classList.remove("active");
    document.getElementById("sidebarArticle").classList.remove("active");
    document.getElementById("sidebarInsertCommitte").classList.remove("active");
    document.getElementById("sidebarCommittes").classList.remove("active");
    document.getElementById("sidebarUsers").classList.remove("active");
    document.getElementById("sidebarProgram").classList.remove("active");
    document.getElementById("sidebarDivision").classList.remove("active");
}

function changePassword(){
    document.getElementById("user-profile").style.display = "none";
    document.getElementById("change-password").style.display = "block";
    document.getElementById("insert-article").style.display = "none";
    document.getElementById("update-article").style.display = "none";
    document.getElementById("list-users").style.display = "none";
    document.getElementById("insert-committe").style.display = "none";
    document.getElementById("list-committes").style.display = "none";
    document.getElementById("list-program").style.display = "none";
    document.getElementById("list-division").style.display = "none";
    document.getElementById("sidebarProfile").classList.remove("active");
    document.getElementById("sidebarPassword").classList.add("active");
    document.getElementById("sidebarInsert").classList.remove("active");
    document.getElementById("sidebarArticle").classList.remove("active");
    document.getElementById("sidebarInsertCommitte").classList.remove("active");
    document.getElementById("sidebarCommittes").classList.remove("active");
    document.getElementById("sidebarUsers").classList.remove("active");
    document.getElementById("sidebarProgram").classList.remove("active");
    document.getElementById("sidebarDivision").classList.remove("active");
}

function insertArticle(){
    document.getElementById("user-profile").style.display = "none";
    document.getElementById("change-password").style.display = "none";
    document.getElementById("insert-article").style.display = "block";
    document.getElementById("update-article").style.display = "none";
    document.getElementById("list-users").style.display = "none";
    document.getElementById("insert-committe").style.display = "none";
    document.getElementById("list-committes").style.display = "none";
    document.getElementById("list-program").style.display = "none";
    document.getElementById("list-division").style.display = "none";
    document.getElementById("sidebarProfile").classList.remove("active");
    document.getElementById("sidebarPassword").classList.remove("active");
    document.getElementById("sidebarInsert").classList.add("active");
    document.getElementById("sidebarArticle").classList.remove("active");
    document.getElementById("sidebarInsertCommitte").classList.remove("active");
    document.getElementById("sidebarCommittes").classList.remove("active");
    document.getElementById("sidebarUsers").classList.remove("active");
    document.getElementById("sidebarProgram").classList.remove("active");
    document.getElementById("sidebarDivision").classList.remove("active");
}

function listArticle(){
    document.getElementById("user-profile").style.display = "none";
    document.getElementById("change-password").style.display = "none";
    document.getElementById("insert-article").style.display = "none";
    document.getElementById("update-article").style.display = "block";
    document.getElementById("list-users").style.display = "none";
    document.getElementById("insert-committe").style.display = "none";
    document.getElementById("list-committes").style.display = "none";
    document.getElementById("list-program").style.display = "none";
    document.getElementById("list-division").style.display = "none";
    document.getElementById("sidebarProfile").classList.remove("active");
    document.getElementById("sidebarPassword").classList.remove("active");
    document.getElementById("sidebarInsert").classList.remove("active");
    document.getElementById("sidebarArticle").classList.add("active");
    document.getElementById("sidebarInsertCommitte").classList.remove("active");
    document.getElementById("sidebarCommittes").classList.remove("active");
    document.getElementById("sidebarUsers").classList.remove("active");
    document.getElementById("sidebarProgram").classList.remove("active");
    document.getElementById("sidebarDivision").classList.remove("active");
}

function insertCommitte(){
    document.getElementById("user-profile").style.display = "none";
    document.getElementById("change-password").style.display = "none";
    document.getElementById("insert-committe").style.display = "block";
    document.getElementById("sidebarInsertCommitte").classList.add("active");
    document.getElementById("insert-article").style.display = "none";
    document.getElementById("update-article").style.display = "none";
    document.getElementById("list-users").style.display = "none";
    document.getElementById("list-committes").style.display = "none";
    document.getElementById("list-program").style.display = "none";
    document.getElementById("list-division").style.display = "none";
    document.getElementById("sidebarProfile").classList.remove("active");
    document.getElementById("sidebarPassword").classList.remove("active");
    document.getElementById("sidebarInsert").classList.remove("active");
    document.getElementById("sidebarArticle").classList.remove("active");
    document.getElementById("sidebarCommittes").classList.remove("active");
    document.getElementById("sidebarUsers").classList.remove("active");
    document.getElementById("sidebarProgram").classList.remove("active");
    document.getElementById("sidebarDivision").classList.remove("active");
}

function listCommittes(){
    document.getElementById("user-profile").style.display = "none";
    document.getElementById("change-password").style.display = "none";
    document.getElementById("insert-article").style.display = "none";
    document.getElementById("update-article").style.display = "none";
    document.getElementById("list-users").style.display = "none";
    document.getElementById("insert-committe").style.display = "none";
    document.getElementById("list-committes").style.display = "block";
    document.getElementById("list-program").style.display = "none";
    document.getElementById("list-division").style.display = "none";
    document.getElementById("sidebarProfile").classList.remove("active");
    document.getElementById("sidebarPassword").classList.remove("active");
    document.getElementById("sidebarInsert").classList.remove("active");
    document.getElementById("sidebarArticle").classList.remove("active");
    document.getElementById("sidebarInsertCommitte").classList.remove("active");
    document.getElementById("sidebarCommittes").classList.add("active");
    document.getElementById("sidebarUsers").classList.remove("active");
    document.getElementById("sidebarProgram").classList.remove("active");
    document.getElementById("sidebarDivision").classList.remove("active");
}

function listUsers(){
    document.getElementById("user-profile").style.display = "none";
    document.getElementById("change-password").style.display = "none";
    document.getElementById("insert-article").style.display = "none";
    document.getElementById("update-article").style.display = "none";
    document.getElementById("list-users").style.display = "block";
    document.getElementById("insert-committe").style.display = "none";
    document.getElementById("list-committes").style.display = "none";
    document.getElementById("list-program").style.display = "none";
    document.getElementById("list-division").style.display = "none";
    document.getElementById("sidebarProfile").classList.remove("active");
    document.getElementById("sidebarPassword").classList.remove("active");
    document.getElementById("sidebarInsert").classList.remove("active");
    document.getElementById("sidebarArticle").classList.remove("active");
    document.getElementById("sidebarInsertCommitte").classList.remove("active");
    document.getElementById("sidebarCommittes").classList.remove("active");
    document.getElementById("sidebarUsers").classList.add("active");
    document.getElementById("sidebarProgram").classList.remove("active");
    document.getElementById("sidebarDivision").classList.remove("active");
}

function listProgram(){
    document.getElementById("user-profile").style.display = "none";
    document.getElementById("change-password").style.display = "none";
    document.getElementById("insert-article").style.display = "none";
    document.getElementById("update-article").style.display = "none";
    document.getElementById("list-users").style.display = "none";
    document.getElementById("insert-committe").style.display = "none";
    document.getElementById("list-committes").style.display = "none";
    document.getElementById("list-program").style.display = "block";
    document.getElementById("list-division").style.display = "none";
    document.getElementById("sidebarProfile").classList.remove("active");
    document.getElementById("sidebarPassword").classList.remove("active");
    document.getElementById("sidebarInsert").classList.remove("active");
    document.getElementById("sidebarArticle").classList.remove("active");
    document.getElementById("sidebarInsertCommitte").classList.remove("active");
    document.getElementById("sidebarCommittes").classList.remove("active");
    document.getElementById("sidebarUsers").classList.remove("active");
    document.getElementById("sidebarProgram").classList.add("active");
    document.getElementById("sidebarDivision").classList.remove("active");
}

function listDivision(){
    document.getElementById("user-profile").style.display = "none";
    document.getElementById("change-password").style.display = "none";
    document.getElementById("insert-article").style.display = "none";
    document.getElementById("update-article").style.display = "none";
    document.getElementById("list-users").style.display = "none";
    document.getElementById("insert-committe").style.display = "none";
    document.getElementById("list-committes").style.display = "none";
    document.getElementById("list-program").style.display = "none";
    document.getElementById("list-division").style.display = "block";
    document.getElementById("sidebarProfile").classList.remove("active");
    document.getElementById("sidebarPassword").classList.remove("active");
    document.getElementById("sidebarInsert").classList.remove("active");
    document.getElementById("sidebarArticle").classList.remove("active");
    document.getElementById("sidebarInsertCommitte").classList.remove("active");
    document.getElementById("sidebarCommittes").classList.remove("active");
    document.getElementById("sidebarUsers").classList.remove("active");
    document.getElementById("sidebarProgram").classList.remove("active");
    document.getElementById("sidebarDivision").classList.add("active");
}

window.onclick = function(e) {
    if (!e.target.matches('.dropbtn')) {
        let myDropdown = document.getElementById("myDropdown");
        if (myDropdown.classList.contains('show')) {
            myDropdown.classList.remove('show');
        }
    }
  }
