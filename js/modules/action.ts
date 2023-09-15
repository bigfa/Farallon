class farallonAction extends farallonBase {
    like_btn: any;
    selctor: string = '.like-btn';
    is_single: boolean = false;
    post_id: number = 0;
    is_archive: boolean = false;
    constructor() {
        super();
        //@ts-ignore
        this.is_single = obvInit.is_single;
        //@ts-ignore
        this.post_id = obvInit.post_id;
        //@ts-ignore
        this.is_archive = obvInit.is_archive;
        this.like_btn = document.querySelector(this.selctor);
        if (this.like_btn) {
            this.like_btn.addEventListener('click', () => {
                this.handleLike();
            });
            if (this.getCookie('like_' + this.post_id)) {
                this.like_btn.classList.add('is-active');
            }
        }

        if (document.querySelector('.post--share')) {
            document.querySelector('.post--share')!.addEventListener('click', () => {
                navigator.clipboard.writeText(document.location.href).then(() => {
                    this.showNotice('复制成功');
                });
            });
        }

        document.querySelector('[data-action="show-search"]')!.addEventListener('click', () => {
            document
                .querySelector('.site--header__center .inner')!
                .classList.toggle('search--active');
        });

        document.querySelectorAll('.fixed--theme span').forEach((item) => {
            item.addEventListener('click', () => {
                document.querySelector('body')!.classList.toggle('dark--theme');
                item.classList.toggle('is-active');
            });
        });

        if (this.is_single) {
            this.trackPostView();
        }

        if (this.is_archive) {
            //this.trackArchiveView();
        }

        console.log(`theme version: ${this.VERSION} init success!`);

        const copyright = `<div class="site--footer__info">
        Theme <a href="https://fatesinger.com/101971" target="_blank">farallon</a> by bigfa / version ${this.VERSION}
    </div>`;

        document.querySelector('.site--footer__content')!.insertAdjacentHTML('afterend', copyright);

        document.querySelector('.icon--copryrights')!.addEventListener('click', () => {
            document.querySelector('.site--footer__info')!.classList.toggle('active');
        });
    }

    trackPostView() {
        //@ts-ignore
        const id = obvInit.post_id;
        //@ts-ignore

        const url = obvInit.restfulBase + 'farallon/v1/view?id=' + id;
        fetch(url, {
            headers: {
                // @ts-ignore
                'X-WP-Nonce': obvInit.nonce,
                'Content-Type': 'application/json',
            },
        })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                console.log(data);
            });
    }

    trackArchiveView() {
        if (document.querySelector('.archive-header')) {
            const self: any = document.querySelector('.archive-header');
            const id = self.dataset.id;
            fetch(`/api/archive/${id}`);
        }
    }

    handleLike() {
        // @ts-ignore
        if (this.getCookie('like_' + this.post_id)) {
            return this.showNotice('You have already liked this post');
        }
        // @ts-ignore
        const url = obvInit.restfulBase + 'farallon/v1/like';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
                // @ts-ignore
                id: this.post_id,
            }),
            headers: {
                // @ts-ignore
                'X-WP-Nonce': obvInit.nonce,
                'Content-Type': 'application/json',
            },
        })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                this.showNotice('Thanks for your like');
                // @ts-ignore
                this.setCookie('like_' + this.post_id, '1', 1);
            });
        this.like_btn.classList.add('is-active');
    }

    refresh() {}
}

new farallonAction();
