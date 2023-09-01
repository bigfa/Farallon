class farallonComment extends farallonBase {
    loading = false;
    constructor() {
        super();
        this.init();
    }

    private init() {
        console.log('farallonComment');
        if (document.querySelector('.comment-form')) {
            document.querySelector('.comment-form')?.addEventListener('submit', (e) => {
                e.preventDefault();
                if (this.loading) return;
                const form = document.querySelector('.comment-form') as HTMLFormElement;
                // @ts-ignore
                const formData = new FormData(form);
                // @ts-ignore
                const formDataObj: { [index: string]: any } = {};
                formData.forEach((value, key: any) => (formDataObj[key] = value));
                this.loading = true;
                // @ts-ignore
                fetch(obvInit.restfulBase + 'farallon/v1/comment', {
                    method: 'POST',
                    body: JSON.stringify(formDataObj),
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
                        }
                        let a = document.getElementById('cancel-comment-reply-link'),
                            i = document.getElementById('respond'),
                            n = document.getElementById('wp-temp-form-div');
                        const comment = data.data;
                        const html = `<li class="comment byuser comment-author-bigfa bypostauthor odd alt thread-even depth-1">
                    <article class="comment-body">
                        <footer class="comment-meta">
                            <div class="comment-author vcard">
                                <img alt="" src="${comment.author_avatar_urls}" class="avatar avatar-48 photo" height="48" width="48" />						<b class="fn">${comment.comment_author}</b><span class="says">说道：</span>					</div><!-- .comment-author -->
        
                            <div class="comment-metadata">
                               <time>${comment.comment_date}</time></div><!-- .comment-metadata -->
        
                                            </footer><!-- .comment-meta -->
        
                        <div class="comment-content">
                            ${comment.comment_content}
                        </div><!-- .comment-content -->
        
                        </article><!-- .comment-body -->
                </li>`; // @ts-ignore
                        const parent_id = document.querySelector('#comment_parent')?.value;
                        console.log(!parent_id);
                        // @ts-ignore
                        (a.style.display = 'none'), // @ts-ignore
                            (a.onclick = null), // @ts-ignore
                            (document.getElementById('comment_parent').value = '0'),
                            n && // @ts-ignore
                                i && // @ts-ignore
                                (n.parentNode.insertBefore(i, n), n.parentNode.removeChild(n));
                        // @ts-ignore
                        document.getElementById('comment').value = '';
                        // @ts-ignore
                        if (parent_id) {
                            document
                                .querySelector(
                                    // @ts-ignore
                                    '#comment-' + parent_id
                                )
                                ?.insertAdjacentHTML(
                                    'beforeend',
                                    '<ol class="children">' + html + '</ol>'
                                );
                            console.log(parent_id);
                        } else {
                            document
                                .querySelector('.commentlist')
                                ?.insertAdjacentHTML('beforeend', html);
                            console.log(2);
                        }
                        this.showNotice('评论成功');
                    });
            });
        }
    }
}

new farallonComment();
