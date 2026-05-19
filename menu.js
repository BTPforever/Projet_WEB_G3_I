$(document).ready(function () {

    $("#mondiv").hide();

    $("#btn").click(function (event) { 
        event.stopPropagation();
        event.preventDefault();
        $("#mondiv").slideToggle(300); // ← glissement vertical
        $("#btn").toggleClass("active");
        $("#burgerr").toggleClass("active");
        
        setTimeout(function(){
            $(document).one("click", function(){
                $("#mondiv").slideUp(300); // ← fermeture avec glissement aussi
                $("#btn").removeClass("active");
                $("#burgerr").removeClass("active");
            });
        }, 100);
    });

});