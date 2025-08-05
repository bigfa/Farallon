class farallonAction extends farallonBase {
    like_btn: any;
    selctor: string = '.like-btn';
    is_single: boolean = false;
    post_id: number = 0;
    is_archive: boolean = false;

    constructor() {
        super();
        this.is_single = this.obvInit.is_single;
        this.post_id = this.obvInit.post_id;
        this.is_archive = this.obvInit.is_archive;
        this.like_btn = document.querySelector(this.selctor);

        if (this.like_btn) {
            this.like_btn.addEventListener('click', () => {
                this.handleLike();
            });

            if (this.getCookie('like_' + this.post_id)) {
                this.like_btn.classList.add('is-active');
            }
        }

        const theme = localStorage.getItem('theme') ? localStorage.getItem('theme') : 'auto';

        const html = `<div class="fThemeSwitcher">
        <span class="${theme == 'dark' ? 'is-active' : ''}" data-action-value="dark">
            <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                style="color: currentcolor; width: 16px; height: 16px;">
                <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
            </svg>
        </span>
        <span class="${theme == 'light' ? 'is-active' : ''}" data-action-value="light">
            <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                style="color: currentcolor; width: 16px; height: 16px;">
                <circle cx="12" cy="12" r="5"></circle>
                <path d="M12 1v2"></path>
                <path d="M12 21v2"></path>
                <path d="M4.22 4.22l1.42 1.42"></path>
                <path d="M18.36 18.36l1.42 1.42"></path>
                <path d="M1 12h2"></path>
                <path d="M21 12h2"></path>
                <path d="M4.22 19.78l1.42-1.42"></path>
                <path d="M18.36 5.64l1.42-1.42"></path>
            </svg>
        </span>
        <span class="${theme == 'auto' ? 'is-active' : ''}"  data-action-value="auto">
            <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                style="color: currentcolor; width: 16px; height: 16px;">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                <path d="M8 21h8"></path>
                <path d="M12 17v4"></path>
            </svg>
        </span>
    </div>`;

        if (this.darkmode) {
            document.querySelector('body')!.insertAdjacentHTML('beforeend', html);
        }

        document.querySelectorAll('.fThemeSwitcher span').forEach((item) => {
            item.addEventListener('click', () => {
                if (item.classList.contains('is-active')) return;

                document.querySelectorAll('.fThemeSwitcher span').forEach((item) => {
                    item.classList.remove('is-active');
                });

                if ((item as HTMLElement).dataset.actionValue == 'dark') {
                    localStorage.setItem('theme', 'dark');
                    document.querySelector('body')!.classList.remove('auto');
                    document.querySelector('body')!.classList.add('dark');
                    item.classList.add('is-active');
                } else if ((item as HTMLElement).dataset.actionValue == 'light') {
                    localStorage.setItem('theme', 'light');
                    document.querySelector('body')!.classList.remove('auto');
                    document.querySelector('body')!.classList.remove('dark');
                    item.classList.add('is-active');
                } else if ((item as HTMLElement).dataset.actionValue == 'auto') {
                    localStorage.setItem('theme', 'auto');
                    document.querySelector('body')!.classList.remove('dark');
                    document.querySelector('body')!.classList.add('auto');
                    item.classList.add('is-active');
                }
            });
        });

        if (document.querySelector('.fArticle--share')) {
            document.querySelector('.fArticle--share')!.addEventListener('click', () => {
                navigator.clipboard.writeText(document.location.href).then(() => {
                    this.showNotice(this.obvInit.copy_success_text);
                });
            });
        }

        document.querySelector('[data-action="show-search"]')!.addEventListener('click', () => {
            document.querySelector('.fHeader--content .inner')!.classList.toggle('search--active');
        });
        if (this.is_single && this.obvInit.post_view) {
            this.trackPostView();
        }

        if (this.is_archive) {
            this.trackArchiveView();
        }

        console.log(`theme version: ${this.VERSION} init success!`);

        const copyright = `<div class="fFooter--info">
        Theme <a href="https://fatesinger.com/101971" target="_blank">farallon</a> by bigfa / version ${this.VERSION}
    </div>`;

        document.querySelector('.fFooter--content')!.insertAdjacentHTML('afterend', copyright);

        document.querySelector('.icon--copryrights')!.addEventListener('click', () => {
            document.querySelector('.fFooter--info')!.classList.toggle('active');
        });
    }

    trackPostView() {
        const id = this.obvInit.post_id;
        const url = this.obvInit.restfulBase + 'farallon/v1/view?id=' + id;
        fetch(url, {
            headers: {
                'X-WP-Nonce': this.obvInit.nonce,
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
            const id = this.obvInit.archive_id;
            fetch(`${this.obvInit.restfulBase}farallon/v1/archive/${id}`, {
                method: 'POST',
                headers: {
                    'X-WP-Nonce': this.obvInit.nonce,
                    'Content-Type': 'application/json',
                },
            }).then((response) => {
                return response.json();
            });
        }
    }

    handleLike() {
        if (this.getCookie('like_' + this.post_id)) {
            return this.showNotice('You have already liked this post');
        }
        const url = this.obvInit.restfulBase + 'farallon/v1/like';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
                id: this.post_id,
            }),
            headers: {
                'X-WP-Nonce': this.obvInit.nonce,
                'Content-Type': 'application/json',
            },
        })
            .then((response) => {
                return response.json();
            })
            .then(() => {
                this.showNotice(this.obvInit.like_success_message, 'success');
                this.setCookie('like_' + this.post_id, '1', 1);
            });
        this.like_btn.classList.add('is-active');
    }

    refresh() {}
}

new farallonAction();
