document.querySelectorAll('.leftpanel li').forEach((element, index) => {
    element.addEventListener('click', (event) => {
        document.querySelectorAll('.leftpanel li').forEach((element) => {
            element.classList.remove('active');
        });
        element.classList.add('active');
        document.querySelectorAll('.div-tab').forEach((element) => {
            element.classList.add('hidden');
        });
        document.querySelectorAll('.div-tab')[index].classList.remove('hidden');
    });
});
