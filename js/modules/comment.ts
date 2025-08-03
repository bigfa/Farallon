class farallonComment extends farallonBase {
    loading = false;
    constructor() {
        super();
        this.init();
    }

    private init() {
        if (document.querySelector('.comment-form')) {
            document.querySelector('.comment-form')?.addEventListener('submit', (e) => {
                e.preventDefault();
                if (this.loading) return;
                const form = document.querySelector('.comment-form') as HTMLFormElement;
                const formData = new FormData(form);
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
                        const html = `<li class="comment fComment--item" id="comment-${comment.comment_ID}">
                        <div class="fComment--body fComment--body__fresh">
                            <header class="fComment--header">
                                <div class="fComment--avatar">
                                    <img alt="" src="${comment.author_avatar_urls}" class="avatar" height="42" width="42" />
                                </div>
                                <div class="fComment--meta">
                                    ${comment.comment_author}<span class="dot"></span>
                                    <time>Just now</time>
                                </div>
                            </header>
                            <div class="fComment--content">
                                ${comment.comment_content}
                            </div>
                        </div>
                    </li>`;
                        const parent_id = (
                            document.querySelector('#comment_parent') as HTMLInputElement
                        )?.value;
                        if (a) {
                            a.style.display = 'none';
                            a.onclick = null;
                        }
                        ((document.getElementById('comment_parent') as HTMLInputElement).value =
                            '0'),
                            n &&
                                i &&
                                n.parentNode &&
                                (n.parentNode.insertBefore(i, n), n.parentNode.removeChild(n));
                        if (document.querySelector('.fComment--body__fresh'))
                            document
                                .querySelector('.fComment--body__fresh')
                                ?.classList.remove('fComment--body__fresh');
                        const commentInput = document.getElementById(
                            'comment'
                        ) as HTMLInputElement | null;
                        if (commentInput) {
                            commentInput.value = '';
                        }
                        if (parent_id != '0') {
                            document
                                .querySelector('#comment-' + parent_id)
                                ?.insertAdjacentHTML(
                                    'beforeend',
                                    '<ol class="children">' + html + '</ol>'
                                );
                        } else {
                            if (document.querySelector('.fComment--placeholder')) {
                                document.querySelector('.fComment--placeholder')?.remove();
                            }
                            document
                                .querySelector('.fComment--list')
                                ?.insertAdjacentHTML('beforeend', html);
                        }

                        const newComment = document.querySelector(
                            `#comment-${comment.comment_ID}`
                        ) as HTMLElement;

                        if (newComment) {
                            newComment.scrollIntoView({ behavior: 'smooth' });
                        }

                        this.showNotice('评论成功');
                    });
            });
        }
    }
}

new farallonComment();
