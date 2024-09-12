class imgZoom {
    selector: string;
    selectorAttr: string;
    currentIndex: number;
    images: string[];
    constructor() {
        this.selector = '[data-action="imageZoomIn"]';
        this.selectorAttr = 'href';
        this.currentIndex = 0;
        this.images = [];
        this.getZoomImages();
        window.addEventListener('resize', () => {
            if (document.querySelector('.overlay')) {
                this.loadImage(this.images[this.currentIndex]);
            }
        });
    }

    getZoomImages() {
        const images = Array.from(document.querySelectorAll(this.selector));
        this.images = [...images]
            .map((image) => image.getAttribute(this.selectorAttr))
            .filter((url) => url !== null) as string[];
        images.forEach((image) => {
            image.addEventListener('click', (e: any) => {
                e.preventDefault();
                const url = image.getAttribute(this.selectorAttr) as string;
                this.showOverlay(url);
            });
        });
    }

    renderNav() {
        const nav = `${this.currentIndex + 1}/${this.images.length}`;
        const imageNav = document.querySelector('.image--nav');
        if (imageNav) {
            imageNav.innerHTML = nav;
        }
    }

    prevImage() {
        if (this.currentIndex === 0) {
            return;
        }
        this.currentIndex = this.currentIndex - 1;
        this.loadImage(this.images[this.currentIndex]);
        this.renderNav();
    }

    nextImage() {
        if (this.currentIndex === this.images.length - 1) {
            return;
        }
        this.currentIndex = this.currentIndex + 1;
        this.loadImage(this.images[this.currentIndex]);
        this.renderNav();
    }

    showOverlay(url: string) {
        const self = this;
        let currentIndex = this.images.indexOf(url);
        this.currentIndex = currentIndex;
        let nav =
            this.images.length > 1
                ? `<div class="image--nav">${currentIndex + 1}/${
                      this.images.length
                  }</div><button title="Prev" type="button" class="mfp-arrow mfp-arrow-left mfp-prevent-close"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
            <path d="M14.4998 7.80903C14.4742 7.74825 14.4372 7.69292 14.3908 7.64603L8.68084 1.93803C8.58696 1.84427 8.45967 1.79165 8.32699 1.79175C8.19431 1.79184 8.0671 1.84464 7.97334 1.93853C7.87959 2.03241 7.82697 2.1597 7.82707 2.29238C7.82716 2.42506 7.87996 2.55227 7.97384 2.64603L12.8278 7.50003H1.96484C1.83224 7.50003 1.70506 7.5527 1.61129 7.64647C1.51752 7.74024 1.46484 7.86742 1.46484 8.00003C1.46484 8.13263 1.51752 8.25981 1.61129 8.35358C1.70506 8.44735 1.83224 8.50003 1.96484 8.50003H12.8278L7.97384 13.354C7.87996 13.4478 7.82716 13.575 7.82707 13.7077C7.82697 13.8404 7.87959 13.9676 7.97334 14.0615C8.0671 14.1554 8.19431 14.2082 8.32699 14.2083C8.45967 14.2084 8.58696 14.1558 8.68084 14.062L14.3878 8.35403C14.4342 8.30713 14.4712 8.2518 14.4968 8.19103C14.5478 8.069 14.5489 7.93184 14.4998 7.80903Z"></path>
        </svg></button><button title="Next (Right arrow key)" type="button" class="mfp-arrow mfp-arrow-right mfp-prevent-close"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
            <path d="M14.4998 7.80903C14.4742 7.74825 14.4372 7.69292 14.3908 7.64603L8.68084 1.93803C8.58696 1.84427 8.45967 1.79165 8.32699 1.79175C8.19431 1.79184 8.0671 1.84464 7.97334 1.93853C7.87959 2.03241 7.82697 2.1597 7.82707 2.29238C7.82716 2.42506 7.87996 2.55227 7.97384 2.64603L12.8278 7.50003H1.96484C1.83224 7.50003 1.70506 7.5527 1.61129 7.64647C1.51752 7.74024 1.46484 7.86742 1.46484 8.00003C1.46484 8.13263 1.51752 8.25981 1.61129 8.35358C1.70506 8.44735 1.83224 8.50003 1.96484 8.50003H12.8278L7.97384 13.354C7.87996 13.4478 7.82716 13.575 7.82707 13.7077C7.82697 13.8404 7.87959 13.9676 7.97334 14.0615C8.0671 14.1554 8.19431 14.2082 8.32699 14.2083C8.45967 14.2084 8.58696 14.1558 8.68084 14.062L14.3878 8.35403C14.4342 8.30713 14.4712 8.2518 14.4968 8.19103C14.5478 8.069 14.5489 7.93184 14.4998 7.80903Z"></path>
        </svg></button>`
                : '';
        let html = `<div class="overlay"><button class="zoomImgClose"><svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg" class="q"><path d="M18.13 6.11l-5.61 5.61-5.6-5.61-.81.8 5.61 5.61-5.61 5.61.8.8 5.61-5.6 5.61 5.6.8-.8-5.6-5.6 5.6-5.62"/></svg></button><div class="overlay-img-wrap"><img class="overlay-image"><div class="lds-ripple"></div></div>${nav}</div>`;
        const body = document.querySelector('body');
        if (body) {
            body.insertAdjacentHTML('beforeend', html);
            body.classList.add('u-overflowYHidden');
        }
        this.loadImage(url);
        document.querySelector('.zoomImgClose')?.addEventListener('click', () => {
            self.overlayRemove();
        });
        document.querySelector('.mfp-arrow-right')?.addEventListener('click', () => {
            self.nextImage();
        });
        document.querySelector('.mfp-arrow-left')?.addEventListener('click', () => {
            self.prevImage();
        });
    }

    loadImage(o: any) {
        let s = new Image();
        const loading = document.querySelector('.lds-ripple') as HTMLElement;
        if (loading) {
            loading.style.display = 'inline-block';
        }
        const i = document.querySelector('.overlay-image') as HTMLPreElement;
        const nav = document.querySelector('.image--nav');
        nav?.classList.add('u-hide');
        i.style.display = 'none';
        s.onload = () => {
            var t = s.width,
                e = s.height,
                n = window.innerHeight - 140,
                a = window.innerWidth - 80;
            a < t
                ? ((e *= a / t), (t = a), n < e && ((t *= n / e), (e = n)))
                : n < e && ((t *= n / e), (e = n), a < t && ((e *= a / t), (t = a)));
            i.setAttribute('src', o),
                (i.style.width = t + 'px'),
                (i.style.height = e + 'px'),
                (i.style.display = 'block'),
                nav?.classList.remove('u-hide');

            document.querySelector('.overlay-img-wrap')?.classList.add('is-finieshed');
            loading.style.display = 'none';
        };
        s.src = o;
    }

    overlayRemove() {
        this._remove(document.querySelector('.overlay'));
        const body = document.querySelector('body');
        if (body) {
            body.classList.remove('u-overflowYHidden');
        }
    }

    _remove(t: any) {
        var e: any = t.parentNode;
        e && e.removeChild(t);
    }
}

new imgZoom();
