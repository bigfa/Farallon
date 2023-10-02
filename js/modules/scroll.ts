class farallonScroll {
    is_single: boolean = false;
    constructor() {
        //@ts-ignore
        this.is_single = obvInit.is_single;
        this.init();
    }

    init() {
        this.scroll();
    }

    scroll() {
        const endScroll = document.querySelector('.post-navigation') as HTMLElement;
        const endScrollTop: any = endScroll ? endScroll.offsetTop : 0;

        const windowHeight = window.innerHeight;

        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                document.querySelector('.site--header')?.classList.add('is-active');
            } else {
                document.querySelector('.site--header')?.classList.remove('is-active');
            }
            if (this.is_single) {
                if (window.scrollY > endScrollTop - windowHeight) {
                    document.querySelector('.post-navigation')?.classList.add('is-active');
                } else {
                    document.querySelector('.post-navigation')?.classList.remove('is-active');
                }
            }
        });
    }
}

new farallonScroll();
