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
    }

    handleLike() {
        if (this.getCookie('like_' + this.post_id)) {
            return;
        }
        const url = '/api/post' + this.post_id + '/like';
        fetch(url);
        this.like_btn.classList.add('is-active');
    }

    refresh() {}
}

new farallonAction();
