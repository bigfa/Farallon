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
                const thumbnail =
                    this.obvInit.hide_home_cover || !post.has_image
                        ? ''
                        : `<a href="${post.permalink}" aria-label="${post.post_title}" class="fBlock--coverLink">
                <img src="${post.thumbnail}" class="fBlock--cover" alt="${post.post_title}">
                        </a>`;
                return post.post_format && post.post_format == 'status'
                    ? `<article class="fStatus--item" itemtype="http://schema.org/Article" itemscope="itemscope">
        <header class="fStatus--header">
            <img alt="" src="${post.author_avatar_urls}" class="avatar avatar-48 photo" height="48" width="48" decoding="async"> <a itemprop="datePublished" datetime="" href="${post.permalink}" aria-label="${post.post_title}">${post.date}</a>
        </header>
                    <div class="fStatus--snippet" itemprop="about"><p>${post.excerpt}</p>
</div>
</article>`
                    : `<article class="fBlock--item" itemtype="http://schema.org/Article" itemscope="itemscope">
            <div class="fBlock--content">
                <h2 class="fBlock--title" itemprop="headline">
                    <a href="${post.permalink}" aria-label="${post.post_title}">
                        ${post.post_title}</a>
                </h2>
                <div class="fBlock--snippet" itemprop="about">${post.excerpt}</div>
                <div class="fBlock--meta">
                    <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                        <path d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z"></path>
                    </svg>
                    <time itemprop="datePublished" datetime="" class="humane--time">${post.date}</time>
                                                    </div>
            </div>${thumbnail}
            </article>`;
            })
            .join('');
        const postsList = document.querySelector('.js-post-list');
        if (postsList) {
            postsList.innerHTML += html;
        }
    }

    randerCardPosts(data: any) {
        let html = data
            .map((post: any) => {
                return `<article class="fCard--item" itemtype="http://schema.org/Article" itemscope="itemscope">
            <a href="${post.permalink}" title="${post.post_title}" aria-label="${post.post_title}" class="fCard--coverLink">
            <img src="${post.thumbnail}" class="fCard--cover" alt="${post.post_title}">
        </a>
        <div class="fCard--content">
        <div class="date">${post.day}</div>
        <h2 class="fCard--title" itemprop="headline">
            <a href="${post.permalink}" title="${post.post_title}" aria-label="${post.post_title}">${post.post_title}</a>
        </h2>
                    <div class="fCard--snippet" itemprop="about">
                    ${post.excerpt}
            </div>
                <div class="fCard--meta">
            <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z"></path>
            </svg>
            <time itemprop="datePublished" datetime="" class="humane--time">${post.date}</time>
            <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path d="M669.013333 596.21181l194.389334 226.791619A77.433905 77.433905 0 0 1 804.59581 950.857143H212.016762a77.433905 77.433905 0 0 1-58.782476-127.853714l194.413714-226.791619c22.918095 13.897143 47.737905 24.941714 74.044952 32.597333l-209.67619 244.614095h592.579048l-209.676191-244.614095a308.102095 308.102095 0 0 0 74.069333-32.597333zM508.294095 73.142857c142.57981 0 258.145524 115.565714 258.145524 258.145524 0 142.57981-115.565714 258.145524-258.145524 258.145524-142.57981 0-258.145524-115.565714-258.145524-258.145524C250.148571 188.732952 365.714286 73.142857 508.318476 73.142857z m0 77.433905a180.711619 180.711619 0 1 0 0 361.423238 180.711619 180.711619 0 0 0 0-361.423238z"></path>
            </svg>
            <a href="${post.author_posts_url}">${post.author}</a>
                    </div>
    </div>
</article>`;
            })
            .join('');
        const cardList = document.querySelector('.js-post-list');
        if (cardList) {
            cardList.innerHTML += html;
        }
    }

    fetchPosts() {
        const obvInit = (window as any).obvInit as obvInit;

        this.button.innerHTML = this.obvInit.loading_text;
        let params: any = {
            page: this.page,
            category: '',
            tag: '',
            author: '',
        };
        if (this.button.dataset.category) {
            params.category = this.button.dataset.category;
        }

        if (this.button.dataset.tag) {
            params.tag = this.button.dataset.tag;
        }

        if (this.button.dataset.author) {
            params.author = this.button.dataset.author;
        }

        const fecthParmas = new URLSearchParams(params).toString();

        fetch(obvInit.restfulBase + 'farallon/v1/posts?' + fecthParmas, {
            method: 'get',
            headers: {
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
                        this.showNotice(this.obvInit.no_more_posts_message, 'error');
                    } else {
                        if (document.querySelector('.fBlock--list')) {
                            this.randerPosts(data.data);
                        } else {
                            this.randerCardPosts(data.data);
                        }
                        this.showNotice(this.obvInit.success_message, 'success');
                    }
                    this.button.innerHTML = this.obvInit.more_text;
                }
            });
    }
}
new farallonPost();
