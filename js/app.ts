interface obvInit {
    more_text: any;
    loading_text: any;
    now_text: any;
    copy_success_text(copy_success_text: any): unknown;
    archive_id: any;
    post_view: boolean;
    no_more_posts_message(no_more_posts_message: any, arg1: string): unknown;
    success_message(success_message: any, arg1: string): unknown;
    hide_home_cover: boolean;
    restfulBase: string;
    nonce: string;
    comment_submit_success_text(comment_submit_success_text: any, arg1: string): unknown;
    is_single: boolean;
    post_id: number;
    is_archive: boolean;
    darkmode: boolean;
    version: string;
}

class farallonBase {
    is_single: boolean = false;
    post_id: number = 0;
    is_archive: boolean = false;
    darkmode: any = false;
    VERSION: string;
    obvInit: obvInit;

    constructor() {
        const obvInit = (window as any).obvInit as obvInit;
        this.is_single = obvInit.is_single;
        this.post_id = obvInit.post_id;
        this.is_archive = obvInit.is_archive;
        this.darkmode = obvInit.darkmode;
        this.VERSION = obvInit.version;
        this.obvInit = obvInit;
    }

    getCookie(t: any) {
        if (0 < document.cookie.length) {
            var e = document.cookie.indexOf(t + '=');

            if (-1 != e) {
                e = e + t.length + 1;
                var n = document.cookie.indexOf(';', e);
                return -1 == n && (n = document.cookie.length), document.cookie.substring(e, n);
            }
        }
        return '';
    }

    setCookie(t: any, e: any, n: any) {
        var o = new Date();
        o.setTime(o.getTime() + 24 * n * 60 * 60 * 1e3);
        var i = 'expires=' + o.toUTCString();
        document.cookie = t + '=' + e + ';' + i + ';path=/';
    }

    showNotice(message: any, type: any = 'success') {
        const html = `<div class="notice--wrapper">${message}</div>`;

        document.querySelector('body')!.insertAdjacentHTML('beforeend', html);
        document.querySelector('.notice--wrapper')!.classList.add('is-active');
        setTimeout(() => {
            document.querySelector('.notice--wrapper')!.remove();
        }, 3000);
    }
}
