class farallonPost extends farallonBase {
    loading = false;
    page = 1;
    button: any;
    constructor() {
        super();
        this.init();
    }

    init() {
        if (document.querySelector('.loadmore')) {
            this.button = document.querySelector('.loadmore');
            document.querySelector('.loadmore')?.addEventListener('click', (e) => {
                e.preventDefault();
                if (this.loading) return;
                this.loading = true;
                this.page++;
                this.fetchPosts();
            });
        }
    }

    randerPosts(data: any) {
        let html = data
            .map((post: any) => {
                const thumbnail = //@ts-ignore
                    obvInit.hide_home_cover || !post.has_image
                        ? ''
                        : `<a href="${post.permalink}" aria-label="${post.post_title}" class="cover--link">
                <img src="${post.thumbnail}" class="cover" alt="${post.post_title}">
                        </a>`;
                return `<article class="post--item" itemtype="http://schema.org/Article" itemscope="itemscope">
            <div class="content">
                <h2 class="post--title" itemprop="headline">
                    <a href="${post.permalink}" aria-label="${post.post_title}">
                        ${post.post_title}</a>
                </h2>
                <div class="description" itemprop="about">${post.excerpt}</div>
                <div class="meta">
                    <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                        <path d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z"></path>
                    </svg>
                    <time itemprop="datePublished" datetime="" class="humane--time">${post.date}</time>
                                                    </div>
            </div>${thumbnail}
            </article>`;
            })
            .join('');
        // @ts-ignore
        document.querySelector('.posts--list')?.innerHTML += html;
    }

    fetchPosts() {
        this.button.innerHTML = '加载中...';
        // @ts-ignore
        fetch(obvInit.restfulBase + 'farallon/v1/posts?page=' + this.page, {
            method: 'get',
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
                this.loading = false;
                if (data.code != 200) {
                    return this.showNotice(data.message, 'error');
                } else {
                    if (data.data.length == 0) {
                        document.querySelector('.loadmore')?.remove();
                        this.showNotice('没有更多文章了', 'error');
                    } else {
                        this.randerPosts(data.data);
                        this.showNotice('加载成功', 'error');
                    }
                    this.button.innerHTML = '加载更多';
                }
            });
    }
}
new farallonPost();
