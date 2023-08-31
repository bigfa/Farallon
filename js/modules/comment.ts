class farallonComment {
    constructor() {
        this.init();
    }

    private init() {
        console.log('farallonComment');
        if (document.querySelector('.comment-form')) {
            document.querySelector('.comment-form')?.addEventListener('submit', (e) => {
                e.preventDefault();

                const form = document.querySelector('.comment-form') as HTMLFormElement;
                // @ts-ignore
                const formData = new FormData(form);
                // @ts-ignore
                const formDataObj: { [index: string]: any } = {};
                formData.forEach((value, key: any) => (formDataObj[key] = value));
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
                        if (data.code != 200) {
                            return;
                        }
                        const comment = data.data;
                        const html = `<li class="comment byuser comment-author-bigfa bypostauthor odd alt thread-even depth-1">
                    <article class="comment-body">
                        <footer class="comment-meta">
                            <div class="comment-author vcard">
                                <img alt="" src="http://2.gravatar.com/avatar/5ba655c9abcbd5f81a3ce0d1a88dc568?s=48&amp;d=mm&amp;r=x" srcset="http://2.gravatar.com/avatar/5ba655c9abcbd5f81a3ce0d1a88dc568?s=96&amp;d=mm&amp;r=x 2x" class="avatar avatar-48 photo" height="48" width="48" loading="lazy" decoding="async">						<b class="fn">${comment.comment_author}</b><span class="says">说道：</span>					</div><!-- .comment-author -->
        
                            <div class="comment-metadata">
                               <time>${comment.comment_date}</time></div><!-- .comment-metadata -->
        
                                            </footer><!-- .comment-meta -->
        
                        <div class="comment-content">
                            ${comment.comment_content}
                        </div><!-- .comment-content -->
        
                        </article><!-- .comment-body -->
                </li>`;
                        // @ts-ignore
                        if (document.querySelector('#comment_parent')?.value) {
                            document
                                .querySelector(
                                    // @ts-ignore
                                    '#comment-' + document.querySelector('#comment_parent')?.value
                                )
                                ?.insertAdjacentHTML(
                                    'beforeend',
                                    '<ol class="children">' + html + '</ol>'
                                );
                        } else {
                            document
                                .querySelector('.commentlist')
                                ?.insertAdjacentHTML('beforeend', html);
                        }
                    });
            });
        }
    }
}

new farallonComment();
