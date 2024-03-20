
// Select both elements by their class names
var div1 = document.querySelector('.div1');
var div2 = document.querySelector('.div2');

// Get the width of the "div2" element
var div2Width = div2.offsetWidth;

// Set the width of "div1" to the width of "div2"
div1.style.width = div2Width + 'px';

document.addEventListener("DOMContentLoaded", function () {
    var wrapper1 = document.querySelector(".wrapper1");
    var wrapper2 = document.querySelector(".wrapper2");

    wrapper1.addEventListener("scroll", function () {
        wrapper2.scrollLeft = wrapper1.scrollLeft;
    });

    wrapper2.addEventListener("scroll", function () {
        wrapper1.scrollLeft = wrapper2.scrollLeft;
    });
});



// #######################################
// fix side bar
$('.menubar').on("click", function () {
    $('.side_bar_title').toggleClass('disp-none', 'disp-block')
})

