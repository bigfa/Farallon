class farallonScroll {
    constructor() {
        this.init();
    }

    init() {
        this.scroll();
    }

    scroll() {
        // let scroll = new SmoothScroll('a[href*="#"]', {
        //     speed: 500,
        //     speedAsDuration: true
        // });

        const endScroll = document.querySelector('.author--card') as HTMLElement;
        const endScrollTop = endScroll.offsetTop;

        const windowHeight = window.innerHeight;

        window.addEventListener('scroll', function () {
            if (window.scrollY > 10) {
                document.querySelector('.site--header')?.classList.add('is-active');
            } else {
                document.querySelector('.site--header')?.classList.remove('is-active');
            }

            if (window.scrollY > endScrollTop - windowHeight) {
                document.querySelector('.post-navigation')?.classList.add('is-active');
            } else {
                document.querySelector('.post-navigation')?.classList.remove('is-active');
            }
        });
    }
}

new farallonScroll();
