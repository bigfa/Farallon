class farallonScroll {
    is_single: boolean = false;
    constructor() {
        //@ts-ignore
        this.is_single = obvInit.is_single;
        this.init();

        if (document.querySelector('.fBackTop')) {
            const backToTop = document.querySelector('.fBackTop') as HTMLElement;
            window.addEventListener('scroll', () => {
                const t = window.scrollY || window.pageYOffset;
                // console.log(t);
                // const documentHeight = document.body.clientHeight;
                //const windowHeight = window.innerHeight;
                // const percent = Math.ceil((t / (documentHeight - windowHeight)) * 100);

                t > 200
                    ? backToTop!.classList.add('is-active')
                    : backToTop!.classList.remove('is-active');
            });

            backToTop.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
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
