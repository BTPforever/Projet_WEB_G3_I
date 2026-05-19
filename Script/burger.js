let burger =$('#burger');
let menu = $('#menu');
burger.click(function(){
    menu.toggle()
});

let dropdown =$('#dropdown');
let sous_menu = $('#sous-menu');
dropdown.click(function(){
    sous_menu.toggle();
});