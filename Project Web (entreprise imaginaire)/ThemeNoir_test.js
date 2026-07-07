const body_Element = document.body;
const buttonTheme = document.getElementById('theme');
const main_Element = document.getElementById('main_content');
const head_Element = document.getElementById('head');
const foot_Element = document.getElementById('foot');
const a_Element = document.getElementsByClassName('navigation_a');
const buttonRemonter = document.getElementById('remonter');
const decuvrir = document.getElementById('decuvrir');
const exemple = document.getElementsByClassName('ex');
const burger = document.getElementById("burger");
const menu = document.getElementById("nav_menu");


/* change de theme */
buttonTheme.onclick = function () {
    if (body_Element.classList.contains("black_b")) {
        body_Element.classList.remove("black_b");
        main_Element.classList.remove("black_m");
        head_Element.classList.remove("black_h");
        foot_Element.classList.remove("black_f");
        buttonRemonter.classList.remove("remonter_black");
        buttonTheme.classList.remove("b_theme_noir");
        decuvrir.classList.remove("decuvrir_black");
        menu.classList.remove('navigation_partie_balck');
        

        for (let b of exemple){
            b.classList.remove('ex_black');
        };


        for (let a of a_Element){
            a.classList.remove('black_a');
        };
       
    } 
    
    else {
        body_Element.classList.add("black_b");
        main_Element.classList.add("black_m");
        head_Element.classList.add("black_h");
        foot_Element.classList.add("black_f");
        buttonRemonter.classList.add("remonter_black");
        buttonTheme.classList.add("b_theme_noir");
        decuvrir.classList.add("decuvrir_black");
        menu.classList.add('navigation_partie_balck');
      

        for (let b of exemple){
            b.classList.add('ex_black');
        };

        for (let a of a_Element){
            a.classList.add('black_a');
        };
        
    }
};

/*remonter en hout*/
buttonRemonter.onclick = function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
}


/*menu burger*/
burger.addEventListener("click", () => {
    menu.classList.toggle("active");
});
