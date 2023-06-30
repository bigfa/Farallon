class farallonAction extends farallonBase {
    like_btn: any;
    selctor: string = '.like-btn';
    constructor() {
        super();
        this.like_btn = document.querySelector(this.selctor);
        if (this.like_btn) {
            this.like_btn.addEventListener('click', () => {
                this.handleLike();
            });
        }
        console.log('init');

        document.querySelector('[data-action="show-search"]')!.addEventListener('click', () => {
            document
                .querySelector('.site--header__center .inner')!
                .classList.toggle('search--active');
        });
    }

    handleLike() {
        if (this.getCookie('like_' + this.post_id)) {
            return;
        }
        // @ts-ignore
        const url = obvInit.restfulBase + 'farallon/v1/post/view';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
                id: this.post_id,
            }),
        });
        this.like_btn.classList.add('is-active');
    }

    refresh() {}
}

new farallonAction();
